<?php

namespace App\Utils;

class RegHelper {
	public static function validateEmail($content) {
		$pattern = "/^[A-Za-z0-9]+([-_.][A-Za-z0-9]+)*@([A-Za-z0-9]+[-.])+[A-Za-z0-9]{2,5}$/";
		return preg_match ( $pattern, $content );
	}
	public static function validateTel($content) {
		$pattern = "/^1\\d{10}$/";
		return preg_match ( $pattern, $content );
	}
}
