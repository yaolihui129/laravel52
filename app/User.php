<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'chrUserCode', 
        'chrUserName', 
        'chrEmail',
        'password',
        'intDeptId',
        'intHeadId',
        'intState' 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    /**
     * 
     */
    public function hasManyUserMenus() {
		return $this->belongsToMany ( 'App\Models\SysMenu', 'menu_users', 'A_UserID', 'A_MenuID' );
	}
}
