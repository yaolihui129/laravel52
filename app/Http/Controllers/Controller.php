<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
	
	/**
	 * App接口成功时的返回
	 * @param array $data
	 * @return string
	 */
	public function jsonSuccessData($data=[]){
	
	    return $this->jsonResponse(0, 'ok', $data);
	}
	
	/**
	 * APP接口异常时的返回
	 * @param unknown $code
	 * @param unknown $msg
	 * @param array $data
	 * @return string
	 */
	public function jsonData($code,$msg,$data=[]){
	    return $this->jsonResponse($code, $msg, $data);
	}
	
	/**
	 * 返回一个json
	 * @param unknown $code
	 * @param unknown $msg
	 * @param unknown $data
	 * @return string
	 */
	
	public function jsonResponse($code,$msg,$data){
	    $content = [
	        'code'  => $code,
	        'msg'   => $msg,
	        'data'  => $data
	    ];
	    return json_encode($content);
	}
	/**
	 * 处理上传文件
	 * @param $file
	 * @param string $disk
	 * @return bool
	 */
	function uploadFile($file,$extension=['jpg','jpeg','png'], $disk='public'){
	    // 1.是否上传成功
	    if (! $file->isValid()) {
	        return false;
	    }
	    // 2.是否符合文件类型 getClientOriginalExtension 获得文件后缀名
	    $fileExtension = $file->getClientOriginalExtension();
	    if(! in_array($fileExtension, ['xlsx', 'xls'])) {
	        return false;
	    }
	    // 3.判断大小是否符合 2M
	    $tmpFile = $file->getRealPath();
	    if (filesize($tmpFile) >= 2048000) {
	        return false;
	    }
	    // 4.是否是通过http请求表单提交的文件
	    if (! is_uploaded_file($tmpFile)) {
	        return false;
	    }
	    // 5.每天一个文件夹,分开存储, 生成一个随机文件名
	    $fileName = date('Y_m_d').'/'.md5(time()) .mt_rand(0,9999).'.'. $fileExtension;
	    if (Storage::disk($disk)->put($fileName, file_get_contents($tmpFile)) ){
	        return $fileName;
	    }
	}
}
