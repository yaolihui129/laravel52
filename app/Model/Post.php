<?php

namespace App\Model;

use App\Model\Model;

class Post extends Model
{
	public function user(){

	  return $this->belongsTo('App\User','user_id','id');
	}
}
