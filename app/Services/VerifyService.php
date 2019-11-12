<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
class VerifyService {
	/**
	 * 获取图片验证码
	 *
	 * @param  $num        	
	 * @param  $w        	
	 * @param  $h        	
	 */
	function getImageCode($num, $w, $h) {
		/*
		 * 字体文件:注意路径 如果没有字体文件，是无法输入显示图片的
		 */
		$fontface = $this->getFontPath () . 'MSYHBD.TTF';
		Log::info($fontface);
		/* 创建图片 */
		$im = imagecreatetruecolor ( $w, $h );
		$bkcolor = imagecolorallocate ( $im, 250, 250, 250 );
		imagefill ( $im, 0, 0, $bkcolor );
		for($i = 0; $i < 15; $i ++) {
			$fontcolor = imagecolorallocate ( $im, mt_rand ( 0, 255 ), mt_rand ( 0, 255 ), mt_rand ( 0, 255 ) );
			imagearc ( $im, mt_rand ( - 10, $w ), mt_rand ( - 10, $h ), mt_rand ( 30, 300 ), mt_rand ( 20, 200 ), 55, 44, $fontcolor );
		}
		for($i = 0; $i < 255; $i ++) {
			$fontcolor = imagecolorallocate ( $im, mt_rand ( 0, 255 ), mt_rand ( 0, 255 ), mt_rand ( 0, 255 ) );
			imagesetpixel ( $im, mt_rand ( 0, $w ), mt_rand ( 0, $h ), $fontcolor );
		}
		// 生成4位数字
		$vcodes = "";
		$drawCode = "";
		for($i = 0; $i < 4; $i ++) {
			$authcode = rand ( 1, 9 );
			$drawCode .= " " . $authcode;
			$vcodes .= $authcode;
		}
		Session::put ( 'imgcode', $vcodes );

		/* 输入图片 将验证码写入到图片中 */
		$fontcolor = imagecolorallocate ( $im, mt_rand ( 0, 120 ), mt_rand ( 0, 120 ), mt_rand ( 0, 120 ) );
		imagettftext ( $im, mt_rand ( 16, 18 ), mt_rand ( - 5, 5 ), 1, mt_rand ( 20, 25 ), $fontcolor, $fontface, $drawCode );
		ob_clean (); // 去掉bom头 此处关键 add by zhangfj 2016-3-14
		imagepng ( $im );
		imagedestroy ( $im );
	}
	private static function getFontPath() {
		return base_path () . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'fonts' . DIRECTORY_SEPARATOR;
	}

    /**
     * 邮件、手机校验码
     * @param $receiver
     * @return string
     */
	public static function getTelEmailCode($receiver) {
		$code = "";
		for($i = 0; $i < 6; $i ++) {
			$code .= rand ( 1, 9 );
		}
		$checkcode = array (
				"code" => $code,
				"receiver" => $receiver,
				"time" => time () 
		);
		Session::put ( "tscode", $checkcode );
		return $code;
	}
}

