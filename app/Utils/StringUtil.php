<?php

namespace App\Utils;

class StringUtil {

    /**
     * 判断字符串开头
     * startWith("abcdef",'a');
     *
     * @param  $string
     * @param  $find
     * @param bool $cps
     * @return boolean
     */
	public static function startWith($string, $find, $cps = false) {
		if ($cps) // 区分大小写
			return strpos ( $string, $find ) === 0;
		return stripos ( $string, $find ) == 0;
	}

    /**
     * 判断字符串结尾
     * startWith("abcdef",'f');
     *
     * @param  $string
     * @param  $find
     * @param bool $cps
     * @return boolean
     */
	public static function endWith($string, $find, $cps = false) {
		if ($cps) // 区分大小写
			return (($pos = strrpos ( $string, $find )) !== false && $pos == strlen ( $string ) - strlen ( $find ));
		return (($pos = strripos ( $string, $find )) !== false && $pos == strlen ( $string ) - strlen ( $find ));
	}

    /**
     *
     * @param  $string
     * @return false|string
     */
	public static function iconv($string) {
		return iconv ( "UTF-8", "gbk", $string );
	}

    /**
     *
     * @param  $string
     * @return false|string
     */
	public static function iconv_UTF($string) {
		return iconv ( "gbk", "UTF-8", $string );
	}
}
