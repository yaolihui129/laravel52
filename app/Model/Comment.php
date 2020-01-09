<?php

namespace App\Model;

use App\Model;

class Comment extends Model
{
    //评论所属文章
	public function post(){
		//
		return belongTo('App\Model\Post');
	}
	
	// 评论所属用户
	public function user(){
		return $this->belongsTo('App\User');
	}
}
