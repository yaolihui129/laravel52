<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Facades\Log;

class UserService {
    /**
     * 判断email是否存在
     *
     * @param  $email
     * @return
     */
	public function uniqueEmail($email) {
		return User::where ( "chrEmail", '=', $email )->count ();
	}

    /**
     * 判断电话号码是否存在
     *
     * @param  $tel
     * @return
     */
	public function uniqueTel($tel) {
		return User::where ( "chrTel", '=', $tel )->count ();
	}

    /**
     * 判断电话号码是否存在
     *
     * @param $username
     * @return
     */
	public function uniqueUserName($username) {
		return User::where ( "chrUserName", '=', $username )->count ();
	}
	
	/**
	 * 重置密码
	 *
	 * @param  $account        	
	 * @param  $reqaccount        	
	 * @param  $password        	
	 * @return 
	 */
	public function resetPWD($account, $reqaccount, $password) {
		$user = User::where ( $account, '=', $reqaccount )->first ();
		$user->password = bcrypt ( $password );
		$user->save ();
		return $user;
	}
	/**
	 * 更改用户系统展示
	 *
	 * @param  $user        	
	 * @param  $osDisplay        	
	 */
	public function updateUserOSDisplay($user, $osDisplay) {
		DB::update ( "update users set intOsDisplay=$osDisplay where id=$user->id" );
	}

    /**
     *
     * @param  $secho
     * @param  $iDisplayStart
     * @param  $iDisplayLength
     * @return string
     */
	public function getUserList($secho, $iDisplayStart, $iDisplayLength, $user) {
		$res = DB::select ( "select count(*) as allCount from users where intFlag=0 and intCompanyID=$user->intCompanyID" );
		$allcount = $res [0]->allCount;
		$users = "{'sEcho': " . $secho . ",'iTotalRecords': " . $allcount . ",'iTotalDisplayRecords':" . $allcount . ",'aaData': ";
		$pagecount = $iDisplayStart;
		$rows = DB::select ( "select id,chrUserCode userCode,chrUserName userName,chrEmail email,chrTel tel,intState state
				from users where intCompanyID=$user->intCompanyID limit ?,?", [ 
				$pagecount,
				$iDisplayLength 
		] );
		$users .= json_encode ( $rows );
		$users .= "}";
		return $users;
	}

    /**
     * 添加员工
     *
     * @param  $employee
     * @param  $user
     * @throws \Exception
     */
	public function insert($employee, $user) {
		DB::beginTransaction ();
		try {
			DB::insert ( "insert into users (chrUserCode,chrUserName,chrEmail,chrTel,intOrgID,password,intCompanyID)
				values (?,?,?,?,?,?,?)", [ 
					$employee ['userCode'],
					$employee ['userName'],
					$employee ['email'],
					$employee ['tel'],
					$employee ['orgId'],
					bcrypt ( $employee ['pwd'] ),
					$user->intCompanyID 
			] );
			$rows = DB::select ( "select @@identity as autoId" );
			$userId = $rows [0]->autoId;
			$roleIds = $employee ['roleIds'];
			foreach ( $roleIds as $roleId ) {
				DB::insert ( "insert into sys_user_roles (intUserID,intRoleID) values (?,?)", [ 
						$userId,
						$roleId 
				] );
			}
			/*
			 * $redis = RedisHelper::getInstance (); $redis->zIncrBy ( "company.users", $user->intCompanyID, 1 );
			 */
			DB::commit ();
		} catch ( \Exception $e ) {
			DB::rollback ();
			throw $e;
		}
	}
	
	/**
	 * 删除角色
	 */
	public function delete($ids, $user) {
		DB::delete ( "delete from users where id in ($ids) and intCompanyID=$user->intCompanyID" );
	}

    /**
     * 查看、编辑
     *
     * @param  $id
     * @return
     */
	public function show($id, $user) {
		$res = DB::select ( "select u.id,chrUserCode userCode,chrUserName userName,chrEmail email,chrTel tel,intOrgID orgId,password pwd, 
				sur.intRoleID roleId from users u
				left join sys_user_roles sur on sur.intUserID=u.id 
				where u.id=$id and u.intCompanyID=$user->intCompanyID" );
		return $res;
	}

    /**
     * 修改
     *
     * @param  $id
     * @param $employee
     * @param $user
     * @throws \Exception
     */
	public function update($id, $employee, $user) {
		DB::beginTransaction ();
		try {
			DB::update ( "update users set chrUserCode=?,chrUserName=?,chrEmail=?,chrTel=?,intOrgID=? where id=? and intCompanyID=?", [ 
					$employee ['userCode'],
					$employee ['userName'],
					$employee ['email'],
					$employee ['tel'],
					$employee ['orgId'],
					$id,
					$user->intCompanyID 
			] );
			
			$roleIds = $employee ["roleIds"];
			$oldRoleIds = empty ( $employee ["oldRoleIds"] ) ? array () : $employee ["oldRoleIds"];
			Log::info ( $roleIds );
			Log::info ( $oldRoleIds );
			foreach ( $roleIds as $idx => $roleId ) {
				if (($key = array_search ( $roleId, $oldRoleIds )) === FALSE) {
					DB::insert ( "insert into sys_user_roles (intUserID,intRoleID) values (?,?)", [ 
							$id,
							$roleId 
					] );
				} else
					array_splice ( $oldRoleIds, $key, 1 ); // 删除存在的
			}
			if (! empty ( $oldRoleIds )) {
				$delIds = implode ( ',', $oldRoleIds );
				DB::delete ( "delete from sys_user_roles where intUserID=$id and intRoleID in ($delIds)" );
			}
			DB::commit ();
		} catch ( \Exception $e ) {
			DB::rollback ();
			throw $e;
		}
	}
}
