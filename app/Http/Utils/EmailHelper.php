<?php

namespace App\Http\Utils;

use Illuminate\Support\Facades\Mail;

class EmailHelper {
	private static $formText = "用友UpCAT";
	public static function sendTextEmail($title, $content, $receiver) {
		Mail::raw ( $content, function ($message) use($title, $receiver) {
			$username = env ( 'MAIL_USERNAME', 'yonyouupu8@yonyou.com' );
			$message->from ( $username, self::$formText );
			$message->to ( $receiver )->subject ( $title );
		} );
	}
	
	/**
	 * EmailHelper::sendEmail ( "emails.report", array (
	 * "user" => array (
	 * "name" => "zhangfj",
	 * "sex" => "男"
	 * )
	 * ), array (
	 * "to" => array (
	 * "zhangfjb@yonyou.com",
	 * "793665131@qq.com"
	 * ),
	 * "subject" => "用友优普云测试报告",
	 * "cc" => array (
	 * "zhangfjb@yonyou.com",
	 * "793665131@qq.com"
	 * ),
	 * "attach" => "D:/ApacheAppServ/www/testworm/public/schemes/report/images/100/1.jpg"
	 * ) );
	 * 详细参数 参考:http://laravelacademy.org/post/213.html
	 *
	 * @param unknown $view        	
	 * @param unknown $pageData        	
	 * @param unknown $emailInfo        	
	 */
	public static function sendEmail($view, $pageData, $emailInfo) {
		Mail::send ( $view, $pageData, function ($message) use($emailInfo) {
			$username = env ( 'MAIL_USERNAME', 'yonyouupu8@yonyou.com' );
			$message->from ( $username, self::$formText );
			if (! empty ( $emailInfo ["subject"] ))
				$message->subject ( $emailInfo ["subject"] );
			$message->to ( $emailInfo ["to"] );
			if (! empty ( $emailInfo ["cc"] ))
				$message->cc ( $emailInfo ["cc"] );
			if (! empty ( $emailInfo ["attach"] ))
				$message->attach ( $emailInfo ["attach"] );
		} );
	}
}
