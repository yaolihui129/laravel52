<?php
namespace App;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
	
	//用户的文章列表
	public function posts(){
		return $this->hasMany(\App\Model\Post::class,'user_id','id');
	}
	
	//关注我的Fans
	public function stars(){
		return $this->hasMany(\App\Model\Fan::class,'fan_id','id');
	}
	
	//我关注的
	public function fans(){
		return $this->hasMany(\App\Model\Fan::class,'star_id','id');
	}
	
	//关注某人
	public function doFan($uid){
		$fan = new \App\Model\Fan();
		$fan->star_id = $uid;
		return $this->stars()->save($fan);
	}
	
	//取消关注某人
	public function doUnFan($uid){
		$fan = new \App\Model\Fan();
		$fan->star_id = $uid;
		return $this->stars()->delete($fan);
	}
	
	//当前用户是否被某一个uid关注了
	public function hasFan($uid){
		return $this->hans()->where('fan_id',$uid)->count();
	}
	
	//当前用户是否关注了uid
	public function hasStar($uid){
		return $this->stars()->where('star_id',$uid)->count();
	}
}
