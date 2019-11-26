<?php

namespace App\Http\Utils;

class HttpHelper {
	/**
	 * 用file_get_contents 以get方式获取内容
	 *
	 * @param  $url        	
	 * @return string
	 */
	public static function http_get_contents($url) {
		return file_get_contents ( $url );
	}

    /**
     * 用fopen打开url, 以get方式获取内容：
     *
     * @param  $url
     * @return string
     */
	public static function http_get_open($url) {
		$result = "";
		$fp = fopen ( $url, 'r' );
		stream_get_meta_data ( $fp );
		while ( ! feof ( $fp ) ) {
			$result .= fgets ( $fp, 1024 );
		}
		fclose ( $fp );
		return $result;
	}

   public static function http_auth_get_open($url, $user = 'yaolh', $password = 'yonyou@1988')
    {
		//1.获取初始化URL
        $ch = curl_init(); 
        //2.设置curl的参数
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 500);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, "$user:$password");
		curl_setopt($ch, CURLOPT_URL, $url);
		//3.采集
        $res = curl_exec($ch);
        if (curl_errno($ch)) {
            $res = curl_errno($ch);
		}
		//4.关闭
        curl_close($ch);
        return $res;
    }

    /**
     * 用file_get_contents函数,以post方式获取url
     *
     * @param  $url
     * @param array $data
     * @return false|string
     */
	public static function http_post_fcontents($url, array $data) {
		
		/*
		 * $data = array ( 'foo' => 'bar', 'baz' => 'boom' );
		 */
		$data = http_build_query ( $data );
		// $postdata = http_build_query($data);
		$options = array (
				'http' => array (
						'method' => 'POST',
						'header' => 'Content-type:application/x-www-form-urlencoded',
						'content' => $data 
				// 'timeout' => 60 * 60 // 超时时间（单位:s）
								) 
		);
		$context = stream_context_create ( $options );
		$result = file_get_contents ( $url, false, $context );
		return $result;
	}

    /**
     * 使用curl库，使用curl库之前，可能需要查看一下php.ini是否已经打开了curl扩展 稳定速度快
     *
     * @param  $url
     * @param array $data
     * @return mixed
     * @throws \Exception
     */
	public static function http_post_curlcontents($url, $data) {
		try {
			$ch = curl_init ();
			$timeout = 5;
			curl_setopt ( $ch, CURLOPT_URL, $url );
			curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
			// curl_setopt ( $ch, CURLOPT_HEADER, 0 ); // 是否显示头文件
			curl_setopt ( $ch, CURLOPT_CONNECTTIMEOUT, $timeout );
			if (! empty ( $data )) {
				curl_setopt ( $ch, CURLOPT_POST, 1 );
				curl_setopt ( $ch, CURLOPT_POSTFIELDS, $data ); // 上传属性http_build_query ( $data )
			}
			// curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file); //cookie存放的文件夹
			// curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); //是否流
			// curl_setopt($ch, CURLOPT_PROXY, '120.9.127.1:6675'); //使用代理
			// curl_setopt($ch, CURLOPT_VERBOSE,1); //出错提示
			// curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0)");//模拟浏览器
			// curl_setopt($ch, CURLOPT_NOBODY,true); //指定了curl抓的内容中包含header头,并且不要body内容
			$file_contents = curl_exec ( $ch );
			// Log::info ( $url );
			curl_close ( $ch );
			return $file_contents;
		} catch ( \Exception $e ) {
			throw $e;
		}
	}


    public static function httpAuthPost($url, $postJson, $user = 'ylh', $password = '123456')
    {
        //1.获取初始化URL
        $ch = curl_init();
        //2.设置curl的参数
        curl_setopt($ch, CURLOPT_TIMEOUT, 500);       //设置超时时间
        curl_setopt($ch, CURLOPT_URL, $url);          //设置抓取的url
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, "$user:$password");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_COOKIESESSION, true);
        curl_setopt($ch, CURLOPT_COOKIEFILE, "cookiefile");
        curl_setopt($ch, CURLOPT_COOKIEJAR, "cookiefile");
        curl_setopt($ch, CURLOPT_COOKIE, session_name() . '=' . session_id);
        curl_setopt($ch, CURLOPT_HEADER, 0);        //设置头文件的信息作为数据流输出
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  //设置获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($ch, CURLOPT_POST, 1);            //设置post方式提交
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postJson);//post变量
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $res = curl_exec($ch);//3.采集
        curl_close($ch);//4.关闭
        if (curl_errno($ch)) {
            $res = curl_errno($ch);
        }
        return $res;
    }
	
	/**
	 * 断点续传下载文件
	 *
	 * @param unknown $filePath        	
	 */
	public static function download($filePath) {
		$filePath = iconv ( 'utf-8', 'gb2312', $filePath );
		// 设置文件最长执行时间和内存
		set_time_limit ( 0 );
		ini_set ( 'memory_limit', '1024M' );
		// 检测文件是否存在
		if (! is_file ( $filePath )) {
			die ( "<b>404 File not found!</b>" );
		}
		$filename = basename ( $filePath ); // 获取文件名字
		                                    // 开始写输出头信息
		header ( "Cache-Control: public" );
		// 设置输出浏览器格式
		header ( "Content-Type: application/octet-stream" );
		header ( "Content-Disposition: attachment; filename=" . $filename );
		header ( "Content-Transfer-Encoding: binary" );
		header ( "Accept-Ranges: bytes" );
		$size = filesize ( $filePath );
		$range = 0;
		// 如果有$_SERVER['HTTP_RANGE']参数
		if (isset ( $_SERVER ['HTTP_RANGE'] )) {
			/*
			 * Range头域 　　Range头域可以请求实体的一个或者多个子范围。 例如， 表示头500个字节：bytes=0-499 表示第二个500字节： bytes=500-999 表示最后500个字节：bytes=-500 表示500字节以后的范围：bytes=500- 第一个和最后一个字节：bytes=0-0,-1 同时指定几个范围：bytes=500-600,601-999 但是服务器可以忽略此请求头，如果无条件GET包含Range请求头，响应会以状态码206（PartialContent）返回而不是以200 （OK）.
			 */
			// 断点后再次连接 $_SERVER['HTTP_RANGE'] 的值 bytes=4390912-
			list ( $a, $range ) = explode ( "=", $_SERVER ['HTTP_RANGE'] );
			// if yes, download missing part
			$size2 = $size - 1; // 文件总字节数
			$new_length = $size2 - $range; // 获取下次下载的长度
			header ( "HTTP/1.1 206 Partial Content" );
			header ( "Content-Length: {$new_length}" ); // 输入总长
			header ( "Content-Range: bytes {$range}-{$size2}/{$size}" ); // Content-Range: bytes 4908618-4988927/4988928 95%的时候
		} else {
			// 第一次连接
			$size2 = $size - 1;
			header ( "Content-Range: bytes 0-{$size2}/{$size}" ); // Content-Range: bytes 0-4988927/4988928
			header ( "Content-Length: " . $size ); // 输出总长
		}
		$buffer = 1024;
		// 打开文件
		$fp = fopen ( "{$filePath}", "rb" );
		// 设置指针位置
		fseek ( $fp, $range );
		// 虚幻输出
		while ( ! feof ( $fp ) ) {
			print (fread ( $fp, $buffer )) ; // 输出文件
			flush (); // 输出缓冲
			ob_flush ();
		}
		fclose ( $fp );
		exit ();
	}
}
