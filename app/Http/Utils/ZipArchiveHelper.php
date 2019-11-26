<?php

namespace App\Http\Utils;

class ZipArchiveHelper {
	private static $instance = null;
	private static $zip = null;
	private static function getInstance() {
		try {
			if (! (self::$instance instanceof self)) {
				self::$instance = new self (); // 绛変环self::$instance=new ZipArchiveHelper();
			}
		} catch ( \Exception $e ) {
			throw $e;
		}
		return self::$zip;
	}
	private function __construct() {
		try {
			self::$zip = new \ZipArchive ();
		} catch ( \Exception $e ) {
			throw $e;
		}
	}

    /**
     * 打开zip
     *
     * @param  $filename
     * @return mixed
     * @throws \Exception
     */
	public static function openZip($filename) {
		self::getInstance ();
		return self::$zip->open ( $filename, \ZipArchive::OVERWRITE );
	}
	/**
	 * 关闭zip
	 */
	public static function closeZip() {
		if (isset ( self::$zip ))
			self::$zip->close ();
	}

    /**
     *
     * @param  $path
     * @param int $exclusiveLength
     */
	public static function addFileToZip($path, $exclusiveLength = 0) {
		if (is_file ( $path )) {
			$localPath = substr ( $path, $exclusiveLength );
			self::$zip->addFile ( $path, $localPath );
			return;
		}
		$handler = opendir ( $path ); // 打开当前文件夹由$path指定。
		while ( ($filename = readdir ( $handler )) !== false ) {
			if ($filename != "." && $filename != "..") { // 文件夹文件名字为'.'和‘..'，不要对他们进行操作
				$fullname = $path . "/" . $filename;
				$localPath = substr ( $fullname, $exclusiveLength );
				if (is_dir ( $fullname )) { // 如果读取的某个对象是文件夹，则递归
					self::addEmptyDir ( $localPath );
					self::addFileToZip ( $fullname, $exclusiveLength );
				} else { // 将文件加入zip对象
					self::$zip->addFile ( $fullname, $localPath );
				}
			}
		}
		@closedir ( $path );
	}
	
	/**
	 *
	 * @param  $dirname
	 */
	public static function addEmptyDir($dirname) {
		self::$zip->addEmptyDir ( $dirname );
	}
	
	/**
	 * 获取zip包中的文件数
	 */
	public static function getZipFileCount() {
		return self::$zip->numFiles;
	}

    /**
     * 获取zip包中指定索引的文件名 index从0开始
     * @param $index
     * @return false|string
     */
	public static function getNameIndex($index) {
		return self::$zip->getNameIndex ( $index );
	}
	public static function getFileContentByIndex($index) {
		return self::$zip->getFromIndex ( $index );
	}
	
	/**
	 * 获取zip包内指定文件的内容
	 *
	 * @param  $filename
	 * @return string
	 */
	public static function getFileContentByName($filename) {
		return self::$zip->getFromName ( $filename );
	}

    /**
     * 解压zip包中指定的文件
     *
     * @param $index
     * @param $newfilename
     */
	public static function createFileFromZip($index, $newfilename) {
		$content = self::getFileContentByIndex ( $index );
		$handle = fopen ( $newfilename, "w+" );
		$str = fwrite ( $handle, $content );
		fclose ( $handle );
	}

    /**
     * 解zip包
     *
     * @param $despath
     * @return boolean
     */
	public static function decZip($despath) {
		return self::$zip->extractTo ( $despath );
	}
}

