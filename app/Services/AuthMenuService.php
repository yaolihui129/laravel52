<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Utils\StringUtil;

class AuthMenuService {

    /**
     * 获取所有菜单节点
     *
     * @param $user
     * @return
     */
	public function getAllMenus($user) {
		return DB::select ( "select id,chrMenuName from sys_menus where intCreaterID=$user->id" );
	}

    /**
     *
     * @param  $secho
     * @param  $iDisplayStart
     * @param  $iDisplayLength
     * @return string
     */
	public function getMenuList($secho, $iDisplayStart, $iDisplayLength) {
		$res = DB::select ( "select count(*) as allCount from sys_menus where intFlag=0" );
		$allcount = $res [0]->allCount;
		$menus = "{'sEcho': " . $secho . ",'iTotalRecords': " . $allcount . ",'iTotalDisplayRecords':" . $allcount . ",'aaData': ";
		$pagecount = $iDisplayStart; // ($iDisplayStart - 1) * $iDisplayLength; // 开始index
		$rows = DB::select ( 'select id,chrMenuName menuname,intMenuAsc menuasc,chrMenuMethodArgs menuargs 
				from sys_menus order by intMenuAsc,intParentID limit ?,?', [ 
				$pagecount,
				$iDisplayLength 
		] );
		$menus .= json_encode ( $rows );
		$menus .= "}";
		return $menus;
	}

    /**
     * 获取所有的菜单（即菜单权限） 返回数组
     * 数组返回值为：$menus、$ops、$leftMenu
     *
     * @param $user
     * @return array :string |unknown
     */
	public function getAllMenusJson($user) {
		try {
			$res = $this->getMenuAuths ( $user );
			if (! empty ( $res )) { // 判断是否为空
				$ops = array (); // 指定程序是否在桌面显示
				$leftMenu = array (); // 指定程序是否显示在左侧导航
				$topMenus = "menu:[";
				$apps = "app:{";
				$sapps = "sApp:{";
				$tempIds = array ();
				$icon = 1;
				$index = count ( $res ); // 菜单总数
				$parentId = - 1;
				$re = json_decode ( json_encode ( $res ), true );
				for($im = 0; $im < $index; $im ++) {
					$mrow = $res [$im];
					// 上菜单(所有桌面菜单和左菜单都存储在sys_menu表中，sys_menu_types表废弃，所有菜单都属于上菜单)
					if (! in_array ( $mrow->classifyId, $tempIds )) {
						$topMenus .= "{";
						$topMenus .= "menuid: '" . $mrow->classifyId . "',";
						$topMenus .= "name: '" . $mrow->chrClassifyName . "',";
						$topMenus .= "code: '" . $mrow->classifyId . "',";
						$topMenus .= "icon: '" . $mrow->classifyImg . "'";
						$topMenus .= "},";
						$tempIds [] = $mrow->classifyId;
						for($jm = $im; $jm < $index; $jm ++) {
							$row = $res [$jm];
							if (! in_array ( $row->classifyId, $tempIds )) { // 上菜单下的应用
								$icon ++;
								break;
							}
							if ($row->intIsDisplayDesktop) { // 显示在桌面上的应用程序
								$apps .= $this->spellAppJson ( $row );
								$ops ["Icon" . $icon] [] = $row->chrMenuName; // 用户定位桌面菜单显示情况
							}
							if ($row->intIsDisplayLeft) { // 显示在左菜单的应用程序
								$sapps .= $this->spellAppJson ( $row );
								$leftMenu [] = $row->chrMenuName; // 用户定位用户左菜单显示情况
							}
						}
					}
				}
				if (StringUtil::endWith ( $topMenus, ',' ))
					$topMenus = substr ( $topMenus, 0, - 1 );
				if (StringUtil::endWith ( $apps, ',' ))
					$apps = substr ( $apps, 0, - 1 );
				if (StringUtil::endWith ( $sapps, ',' ))
					$sapps = substr ( $sapps, 0, - 1 );
				$topMenus .= "]";
				$apps .= "}";
				$sapps .= "}";
				
				// 所有树形菜单
				$treeMenus = $this->getTreeMenus ( $re, 0 );
				return array (
						"DATA" => "{" . $topMenus . "," . $apps . "," . $sapps . "}",
						"ops" => $ops,
						"leftMenu" => $leftMenu,
						"treeMenus" => json_encode ( $treeMenus ) 
				);
			}
		} catch ( \Exception $e ) {
			// Log::info ( "错误--" . $e->getMessage () );
		}
	}

    /**
     *
     * @param  $row
     * @return string
     */
	private function spellAppJson($row) {
		$app = $row->chrMenuName . ":{";
		$app .= "appid: '" . $row->id . "',";
		$app .= "icon: '" . $row->menuImg . "',";
		$app .= "name: '" . $row->chrMenuName . "',";
		$app .= "url: '" . $row->chrMenuMethodArgs . "',";
		$app .= "sonMenu: '[]',";
		$app .= "asc: '" . $row->intMenuAsc . "'";
		$app .= "},";
		return $app;
	}

    /**
     * 递归获取树形菜单
     *
     * @param  $menus
     * @param $pId
     * @return array
     */
	private function getTreeMenus($menus, $pId) {
		$tree = array ();
		foreach ( $menus as $k => $v ) {
			if ($v ['intParentID'] === $pId) {
				$menu = array ();
				$menu ["appid"] = $v ["id"];
				$menu ["classfiyId"] = $v ["classifyId"];
				$menu ["name"] = $v ["chrMenuName"];
				$menu ["url"] = $v ["chrMenuMethodArgs"];
				$menu ["icon"] = $v ["menuImg"];
				$menu ["className"] = $v ["menuClass"];
				$menu ['sonMenu'] = $this->getTreeMenus ( $menus, $v ['id'] );
				$tree [] = $menu;
			}
		}
		return $tree;
	}
	
	/**
	 * 获取个人用户桌面菜单
	 *
	 * @param unknown $userId        	
	 * @return unknown
	 */
	public function getOpsMenu($userId) {
		$res = DB::select ( "select menus.*,img.chrSmallBGPath,img.chrDisplayBGPath,img.chrImgName,
				img.intIsShare from menus
				left join img_details as img on menus.intImgDetailID=img.id
				left join menu_users as mu on mu.intMenuID=menus.id
				where intIsDisplayDesktop=1 and mu.intUserID=$userId" );
		return $res;
	}
	
	/**
	 * 获取上\左菜单
	 *
	 * @return
	 */
	public function getTopMenu() {
		$res = DB::table ( 'select mcl.ID,mcl.chrClassifyName,mcl.intClassifyType,mcl.intClassifyAsc,mcl.chrClassifyArgs,
			    img.chrSmallBGPath,img.chrDisplayBGPath,img.chrImgName,img.intIsShare
				from menu_classifies as mcl
				left join img_details as img on img.id=mcl.intImgDetailID
				where intClassifyType=0
				ORDER BY intClassifyAsc ' );
		return $res;
	}
	
	/**
	 * 获取所有二级菜单(二级菜单，如如表单管理、报表管理、项目菜单管理等)
	 *
	 * @return
	 */
	public function getSecMenu() {
		$res = DB::table ( 'select mty.*,img.chrSmallBGPath,img.chrDisplayBGPath,img.chrImgName,img.intIsShare 
				from menu_types as mty
				left join img_details as img on img.id=mty.intImgDetailID' );
		return $res;
	}

    /**
     *
     * @param  $user
     * @return
     */
	public function getMenuAuths($user) {
		try {
			$adminSQL = "";
			if ($user->intAdmin == 1)
				$adminSQL = "UNION
				SELECT smenu.intClassifyID,smenu.id,smenu.chrMenuName,smenu.chrMenuMethodArgs,smenu.intMenuAsc,
				smenu.intParentID,sidm.chrDisplayBGPath AS menuImg,1 intIsDisplayDesktop,1 intIsDisplayLeft,
				smenu.chrMenuClass menuClass
				from sys_menus smenu
				LEFT JOIN sys_img_details sidm on sidm.id=smenu.intImgDetailID";
			return DB::select ( "select DISTINCT smc.id as classifyId,smc.chrClassifyName,smc.intClassifyAsc,simg.chrDisplayBGPath AS classifyImg,
					smenu.id,smenu.chrMenuName,smenu.chrMenuMethodArgs,smenu.intMenuAsc,smenu.intParentID,smenu.menuImg,smenu.menuClass,
					smenu.intIsDisplayDesktop,smenu.intIsDisplayLeft
					from sys_menu_classifies smc
					LEFT JOIN sys_img_details simg on simg.id=smc.intImgDetailID
					LEFT JOIN (
					select smenu.intClassifyID,smenu.id,smenu.chrMenuName,smenu.chrMenuMethodArgs,smenu.intMenuAsc,
					smenu.intParentID,sidm.chrDisplayBGPath AS menuImg,1 intIsDisplayDesktop,1 intIsDisplayLeft,
					smenu.chrMenuClass menuClass from users u
					INNER JOIN sys_user_roles sur on sur.intUserID=u.id and sur.intUserID=$user->id
					INNER JOIN sys_priviliges sper on sper.intPriviligeTypeValue=sur.intRoleID and sper.chrPriviligeType='role'
					INNER JOIN sys_menus smenu on smenu.id=sper.chrPriviligeOperationTypeValue and sper.chrPriviligeOperationType='menu'
					LEFT JOIN sys_img_details sidm on sidm.id=smenu.intImgDetailID
					$adminSQL
				)smenu on smenu.intClassifyID=smc.id order by smc.intClassifyAsc,smenu.intMenuAsc" );
		} catch ( \Exception $e ) {
			// Log::info ( "错误--" . $e->getMessage () );
		}
	}

    /**
     * 按钮权限
     *
     * @param  $user
     * @return
     */
	public function getButtonAuths($user) {
		return DB::select ( "select DISTINCT spm.intMenuID,chrPriviligeOperationTypeValue optCode 
				from sys_priviliges sper
				INNER JOIN sys_permissions spm on spm.chrRightCode=sper.chrPriviligeOperationTypeValue
				INNER JOIN sys_menus smenu on smenu.id=spm.intMenuID
				INNER JOIN sys_user_roles sur on sur.intRoleID=sper.intPriviligeTypeValue and sur.intUserID=$user->id
				where chrPriviligeOperationType='button'" );
	}

    /**
     * 数据权限
     *
     * @param  $user
     * @return array
     */
	public function getDataAuths($user) {
		/*
		 * $rows = DB::select ( "select DISTINCT sres.chrResourceCode,sres.chrResourceRule,sro.intObjectID from sys_priviliges sper INNER JOIN sys_resource_objects sro on sro.chrResObjCode=sper.chrPriviligeOperationTypeValue INNER JOIN sys_resources sres on sres.chrResourceCode=sro.chrResourceCode INNER JOIN sys_user_roles sur on sur.intRoleID=sper.intPriviligeTypeValue and sur.intUserID=$user->id where chrPriviligeOperationType='data' ORDER BY sres.chrResourceCode" );
		 */
		$rows = DB::select ( "select DISTINCT sres.chrResourceCode,sres.chrResourceRule,sro.intObjectID from sys_priviliges sper
				INNER JOIN sys_resource_objects sro on sro.chrResObjCode=sper.chrPriviligeOperationTypeValue
				INNER JOIN sys_resources sres on sres.chrResourceCode=sro.chrResourceCode
				INNER JOIN sys_user_roles sur on sur.intRoleID=sper.intPriviligeTypeValue and sur.intUserID=$user->id
				where chrPriviligeOperationType='data' ORDER BY sres.chrResourceCode" );
		$dAuths = array ();
		$code = "";
		foreach ( $rows as $row ) {
			if ($code != $row->chrResourceCode) {
				$code = $row->chrResourceCode;
				$dAuths [$code] = $row->intObjectID;
			} else
				$dAuths [$code] = $dAuths [$code] . "," . $row->intObjectID;
		}
		return $dAuths;
	}
	
	/**
	 * 添加菜单
	 *
	 * @param unknown $menu        	
	 * @param unknown $user        	
	 */
	public function insert($menu, $user) {
		DB::insert ( "insert into sys_menus (chrMenuCode,chrMenuName,chrMemo,intCreaterID,intMenuAsc,intParentID,chrMenuMethodArgs,chrMenuClass)
				values (uuid(),?,?,?,?,?,?,?)", [ 
				$menu ['menuName'],
				$menu ['memo'],
				$user->id,
				$menu ['menuAsc'],
				$menu ['parentId'],
				$menu ['menuArgs'],
				"home-page" 
		] );
	}
	
	/**
	 * 删除
	 */
	public function delete($ids) {
		DB::delete ( "delete from sys_menus where id in ($ids)" );
	}

    /**
     * 查看、编辑
     *
     * @param  $id
     * @return
     */
	public function show($id) {
		$res = DB::select ( "
			select id,chrMenuName menuname,intMenuAsc menuasc,chrMenuMethodArgs menuargs,
			intParentID parentId,chrMemo memo 
			from sys_menus 
			where id=$id
		" );
		return $res [0];
	}
	
	/**
	 * 修改
	 *
	 * @param unknown $id        	
	 */
	public function update($id, $data) {
		DB::update ( "update sys_menus set chrMenuName=?,intMenuAsc=?,chrMenuMethodArgs=?,
		intParentID=?,chrMemo=? where id=?", [ 
				$data ['menuName'],
				$data ['menuAsc'],
				$data ['menuArgs'],
				$data ['parentId'],
				$data ['memo'],
				$id 
		] );
	}
}
