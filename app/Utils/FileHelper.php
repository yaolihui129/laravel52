<?php

namespace App\Utils;

use Illuminate\Support\Facades\Log;

class FileHelper {

    /**
     * 如果所要读取的文件不是本地普通文件，而是远程文件或者流文件，不能用这种方法
     * 最大一次性能读取 8k长度的字节数，所以不能一次性读取大文件去作下载。 优势在于，操作更加灵活，每次读取指定字节的内容，用于下载时方便控制服务器的流量。
     *
     * @param  $filename
     * @return false|string
     */
	public static function readfile_fread($filename) {
		try {
			if (file_exists ( $filename )) {
				$fp = fopen ( $filename, 'r' );
				$length = filesize ( $filename );
				$content = fread ( $fp, $length );
				fclose ( $fp );
				return $content;
			}
		} catch ( \Exception $e ) {
			return $e->getMessage ();
		}
	}

    /**
     * 每次读取一行数据 碰到换行符（包括在返回值中）、EOF 或者已经读取了 length - 1 字节后停止（看先碰到那一种情况
     *
     * @param  $filename
     * @param int $length
     * @return string
     */
	public static function readfile_fgets($filename, $length = 1024) {
		$fp = fopen ( $filename, 'r' );
		$content = "";
		while ( ! feof ( $fp ) ) {
			$content .= fgets ( $fp, $length );
		}
		fclose ( $fp );
		return $content;
	}

    /**
     * 每次读取一行数据 碰到换行符（包括在返回值中）、EOF 或者已经读取了 length - 1 字节后停止（看先碰到那一种情况
     * 跟fgets功能一样，但是fgetss会尝试从读取的文本中去掉任何 HTML 和 PHP 标记，可以用可选的第三个参数指定哪些标记不被去掉。
     *
     * @param  $filename
     * @param int $length
     * @param string $allowable
     */
	public static function readfile_fgetss($filename, $length = 1024, $allowable = "") {
		$fp = fopen ( $filename, 'r' );
		while ( ! feof ( $fp ) ) {
			echo fgetss ( $fp, $length, $allowable );
		}
		fclose ( $fp );
	}

    /**
     * 将文件内容读入一个数组中，数组的每一项对应文件中的一行，包括换行符在内。不需要行结束符时可以使用 rtrim() 函数过滤换行符
     *
     * @param  $filename
     * @return array|false
     */
	public static function readfile_file($filename) {
		$linecontent = file ( $filename );
		return $linecontent;
	}

    /**
     * 将文件读入一个字符串。第三个参数$context可以用来设置一些参数，比如访问远程文件时，设置超时等等。
     * 另外，file_get_contents相对于以上几个函数，性能要好得多，所以应该优先考虑使用file_get_contents。
     * 也是没 readfile()快， 因为也是走了php的内存。但是在读取小文本内容到字符串变量时，这个函数最适合使用，简单，更快。
     *
     * @param  $filename
     * @param array|null $ctx
     * @return void :
     */
	public static function readfile_file_get_contents($filename, array $ctx = null) {
		/*
		 * $ctx = stream_context_create ( array ( 'http' => array ( 'timeout' => 1 // 设置超时 ) ) );
		 */
		if (empty ( $ctx ))
			$content = file_get_contents ( $filename, 0 );
		else
			$content = file_get_contents ( $filename, 0, $ctx );
	}
	
	/**
	 * 读取文件大小
	 *
	 * @param unknown $filename        	
	 * @return number
	 */
	public static function readfilesize($filename) {
		$size = readfile ( $filename );
		return $size;
	}

    /**
     * // 返回文件从X行到Y行的内容(支持php5、php4)
     *
     * @param  $filename
     *            文件
     * @param int $startLine
     *            开始行
     * @param int $endLine
     *            结束行
     * @param string $method
     * @return string multitype:
     */
	static function readFileLines($filename, $startLine = 1, $endLine = 50, $method = 'rb') {
		$content = array ();
		$count = $endLine - $startLine;
		if (version_compare ( PHP_VERSION, '5.1.0', '>=' )) { // 判断php版本（因为要用到SplFileObject，PHP>=5.1.0）
			$fp = new \SplFileObject ( $filename, $method );
			$fp->seek ( $startLine - 1 ); // 转到第N行, seek方法参数从0开始计数
			for($i = 0; $i <= $count; ++ $i) {
				$content [] = $fp->current (); // current()获取当前行内容
				$fp->next (); // 下一行
			}
		} else { // PHP<5.1
			$fp = fopen ( $filename, $method );
			if (! $fp)
				return 'error:can not read file';
			for($i = 1; $i < $startLine; ++ $i) { // 跳过前$startLine行
				fgets ( $fp );
			}
			for($i; $i <= $endLine; ++ $i) {
				$content [] = fgets ( $fp ); // 读取文件行内容
			}
			fclose ( $fp );
		}
		return array_filter ( $content ); // array_filter过滤：false,null,''
	}

    /**
     * 写文件
     *
     * @param  $filename
     * @param  $content
     * @param string $mode
     */
	public static function writefile_fopen($filename, $content, $mode = "w") {
		$fp = fopen ( $filename, $mode );
		fwrite ( $fp, $content );
		fclose ( $fp );
	}
	
	/**
	 * 写文件
	 *
	 * @param  $filename
	 * @param  $content
	 */
	public static function writefile_put_contents($filename, $content) {
		file_put_contents ( $filename, $content );
	}

    /**
     * 重命名
     *
     * @param unknown $oldname
     * @param unknown $newname
     * @param bool $over
     */
	public static function rename($oldname, $newname, $over = true) {
		$oldname = iconv ( "utf-8", "gbk", $oldname );
		$newname = iconv ( "utf-8", "gbk", $newname );
		if (file_exists ( $oldname ))
			rename ( $oldname, $newname );
	}

    /**
     * 资源删除
     *
     * @param  $resource
     *            资源文件
     * @param bool $rmt
     * @param bool $rm
     *            是否强制删除（即有）
     */
	public static function resource_remove($resource, $rmt = true, $rm = false) {
		if (file_exists ( $resource )) {
			if (is_file ( $resource )) {
				unlink ( $resource );
				return;
			}
			$dir = opendir ( $resource );
			$dir_null = true;
			while ( false !== ($file = readdir ( $dir )) ) {
				if (($file != '.') && ($file != '..')) {
					$dir_null = false;
					if ($rm) { // 强制删除子文件
						if (is_dir ( $resource . DIRECTORY_SEPARATOR . $file )) {
							self::resource_remove ( $resource . DIRECTORY_SEPARATOR . $file, $rmt, $rm );
							continue;
						} else {
							$filename = $resource . DIRECTORY_SEPARATOR . $file;
							unlink ( $filename );
						}
					}
				}
			}
			closedir ( $dir );
			// 文件夹 且 空文件夹或允许强制删除子文件
			if (is_dir ( $resource ) && ($dir_null || $rm) && $rmt)
				rmdir ( $resource );
		}
	}

    /**
     * 资源拷贝
     *
     * @param  $resource
     * @param  $dest
     * @param array $nodirs
     * @param bool $copysame
     * @param array $nofiles
     */
	public static function resource_copy($resource, $dest, $nodirs = array(), $copysame = false, $nofiles = array()) {
		if (file_exists ( $resource )) {
			if (is_file ( $resource )) { // 若是文件
				copy ( $resource, $dest );
				return;
			}
			$dir = opendir ( $resource );
			@mkdir ( $dest, 0777, true );
			while ( false !== ($file = readdir ( $dir )) ) {
				if (($file != '.') && ($file != '..')) {
					$fullname = $resource . DIRECTORY_SEPARATOR . $file;
					$destfull = $dest . DIRECTORY_SEPARATOR . $file;
					if (is_dir ( $fullname )) {
						if (! in_array ( $file, $nodirs ))
							self::resource_copy ( $fullname, $destfull, $nodirs, $copysame, $nofiles );
						else {
							@mkdir ( $destfull, 0777, true );
						}
						continue;
					} else {
						if (in_array ( $file, $nofiles )) {
							continue;
						}
						if ($copysame)
							copy ( $fullname, $destfull );
						else {
							$copy = true;
							if (file_exists ( $destfull )) {
								if (md5_file ( $destfull ) === md5_file ( $fullname ))
									$copy = false;
							}
							if ($copy)
								copy ( $fullname, $destfull );
						}
					}
				}
			}
			closedir ( $dir );
		}
	}
}

