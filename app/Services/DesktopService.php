<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DesktopService {
	
	/**
	 * 获取用户的桌面样式以及主题
	 *
	 * @param unknown $userId        	
	 */
	function getUserDesktop($userId) {
		$res = DB::select ( "select desk.id userid,img.chrdisplaybgpath as userbg,ts.chrthemepath usertheme 
				from sys_desktops as desk
				left join sys_img_details as img on img.id=desk.intImgDetailID
				left join sys_theme_styles as ts on ts.id=desk.intThemeStyleID
				where desk.intuserid=1" );
		return $res [0];
	}
}

?>