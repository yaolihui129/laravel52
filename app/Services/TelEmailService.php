<?php

namespace App\Services;

use App\Utils\HttpHelper;
use Illuminate\Support\Facades\Session;
use App\Utils\EmailHelper;
use Illuminate\Support\Facades\Log;

class TelEmailService {
	private $minute = 10;
	/**
	 * 发送邮件验证码
	 *
	 * @param  $code        	
	 * @param  $receiver        	
	 */
	public function sendEmailVerify($code, $receiver) {
		$content = "验证码：{$code}，此验证码{$this->minute}分钟内有效，请及时验证。如非本人操作，请忽略此短信！【用友优普】";
		EmailHelper::sendTextEmail ( "UpCAT验证码", $content, $receiver );
	}

    /**
     * 发送手机验证码
     *
     * @param  $code
     * @param  $receiver
     * @return mixed
     * @throws \Exception
     */
	public function sendTelVerify($code, $receiver) {
		try {
			$url = "http://upsms.yonyouup.com/index.php/Srv/Sms/SendMsg";
			$ymd = date ( 'Ymd', time () );
			$post_data = array (
					"appId" => "UYS",
					'billNo' => "UYS" . $ymd . substr ( microtime (), 2, 8 ) . rand ( 10, 100 ),
					'context' => array (
							"code" => "$code",
							"minute" => $this->minute,
							"name" => "【用友优普】" 
					),
					'phone' => "$receiver",
					'enterpriseUserId' => null,
					'optionalData' => array (),
					'templateId' => "2104",
					'token' => 'IjKSeTZmi5ru4zfBFMCqyP1NH37nthEV' 
			);
			// 按ASCII字典排序
			ksort ( $post_data );
			// 获取签名
			$sSign = $this->getSign ( $post_data );
			// 参数加入签名
			$post_data ["sign"] = $sSign;
			// 卸载token
			unset ( $post_data ["token"] );
			// 数组外在包一层
			/*
			 * $data = array ( "data" => json_encode ( $post_data ) );
			 */
			$data = json_encode ( array (
					"data" => $post_data 
			) );
			// 发送请求
			$ResSN = HttpHelper::http_post_curlcontents ( $url, $data );
			// die ( $ResSN . '-----' . json_encode ( $data ) );
			$ret = json_decode ( $ResSN, true );
			if ($ret ["flag"])
				return $ResSN;
			else
				throw new \Exception ( "短信发送失败:" . $ResSN, null, null );
		} catch ( \Exception $e ) {
			throw $e;
		}
	}
	private function getSign($Obj) {
		foreach ( $Obj as $k => $v ) {
			$Parameters [$k] = $v;
		}
		$String = $this->formatBizQueryParaMap ( $Parameters, false );
		$String = md5 ( $String );
		// 签名步骤三：所有字符转为大写
		$result_ = strtoupper ( $String );
		return $result_;
	}
	/*
	 * 作用：格式化参数，签名过程需要使用
	 */
	private function formatBizQueryParaMap($paraMap, $urlencode) {
		$buff = "";
        $reqPar='';
		ksort ( $paraMap );
		foreach ( $paraMap as $k => $v ) {
			if ($urlencode) {
				$v = urlencode ( $v );
			}
			if (is_array ( $v ))
				$buff .= $k . "=Array&";
			else
				$buff .= $k . "=" . $v . "&";
		}
        
		if (strlen ( $buff ) > 0) {
			$reqPar = substr ( $buff, 0, strlen ( $buff ) - 1 );
		}
		return $reqPar;
	}
	
	/**
	 * 验证手机验证码
	 *
	 * @param  $code        	
	 * @return string
	 */
	public function verTelEmailCodeValidate($code, $account) {
		$checkcode = Session::get ( 'tscode' );
		$time = time ();
		$msg = "";
		if (! empty ( $checkcode )) { // 手机、图片验证码
			if ($account == $checkcode ["receiver"]) {
				if (($time - $checkcode ["time"]) < ($this->minute * 60)) { // 有效验证时间为10分钟
					if ($checkcode ["code"] == $code) {
						Session::forget ( 'tscode' );
						return $msg;
					}
					$msg = '验证码不正确';
				} else {
					Session::forget ( "tscode" );
					$msg = "验证码已过期，有效期为{$this->minute}分钟，请重新获取验证码";
				}
			} else {
				$msg = "注册帐号已更改,请重新获取验证码";
			}
		} else
			$msg = "验证码已过期，有效期为{$this->minute}分钟，请重新获取验证码";
		return $msg;
	}

    /**
     * 验证图片验证码
     *
     * @param  $code
     * @return string
     */
	public function verImgCodeValidate($code) {
		$vercode = Session::get ( 'imgcode' );
		if (! empty ( $vercode )) {
			if ($vercode == $code)
				return "";
			Session::forget ( 'imgcode' );
		}
		return "校验码不正确";
	}
}

