<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SysMenu extends Model {
	protected $table = 'menus';

	protected $fillable = [
        'A_MenuName',
        'A_SmallBGPath'
	];
		
}
