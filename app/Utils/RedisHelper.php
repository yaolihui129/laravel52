<?php

namespace App\Utils;

class RedisHelper {
	private static $dest = "10.1.219.19"; // 尽量不要改为localhost 否则每次连接都很慢
	private static $port = "6379";
	private static $pwd = "zhangfj123";
	private static $instance = null;
	private static $redis;
	public static function getInstance() {
		try {
			if (! (self::$instance instanceof self)) {
				self::$instance = new RedisHelper ();
			}
		} catch ( \Exception $e ) {
			throw $e;
		}
		return self::$redis;
	}
	private function __construct() {
		try {
			self::$redis = new \Redis ();
			self::$redis->pconnect ( self::$dest, self::$port );
			self::$redis->auth ( self::$pwd );
		} catch ( \Exception $e ) {
			throw $e;
		}
	}
}
