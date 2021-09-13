<?php
/**
 */

namespace helder\std\php;


class SuperGlobal {

	/**
	 * @return array
	 */
	public static function get_GLOBALS () {
		#/home/runner/haxe/versions/4.2.3/std/php/SuperGlobal.hx:32: characters 3-33
		return $GLOBALS;
	}

	/**
	 * @return array
	 */
	public static function get__COOKIE () {
		#/home/runner/haxe/versions/4.2.3/std/php/SuperGlobal.hx:72: characters 3-33
		return $_COOKIE;
	}

	/**
	 * @return array
	 */
	public static function get__ENV () {
		#/home/runner/haxe/versions/4.2.3/std/php/SuperGlobal.hx:96: characters 3-30
		return $_ENV;
	}

	/**
	 * @return array
	 */
	public static function get__FILES () {
		#/home/runner/haxe/versions/4.2.3/std/php/SuperGlobal.hx:64: characters 3-32
		return $_FILES;
	}

	/**
	 * @return array
	 */
	public static function get__GET () {
		#/home/runner/haxe/versions/4.2.3/std/php/SuperGlobal.hx:48: characters 3-30
		return $_GET;
	}

	/**
	 * @return array
	 */
	public static function get__POST () {
		#/home/runner/haxe/versions/4.2.3/std/php/SuperGlobal.hx:56: characters 3-31
		return $_POST;
	}

	/**
	 * @return array
	 */
	public static function get__REQUEST () {
		#/home/runner/haxe/versions/4.2.3/std/php/SuperGlobal.hx:88: characters 3-34
		return $_REQUEST;
	}

	/**
	 * @return array
	 */
	public static function get__SERVER () {
		#/home/runner/haxe/versions/4.2.3/std/php/SuperGlobal.hx:40: characters 3-33
		return $_SERVER;
	}

	/**
	 * @return array
	 */
	public static function get__SESSION () {
		#/home/runner/haxe/versions/4.2.3/std/php/SuperGlobal.hx:80: characters 3-34
		return $_SESSION;
	}
}

Boot::registerClass(SuperGlobal::class, 'php.SuperGlobal');
Boot::registerGetters('helder\\std\\php\\SuperGlobal', [
	'_ENV' => true,
	'_REQUEST' => true,
	'_SESSION' => true,
	'_COOKIE' => true,
	'_FILES' => true,
	'_POST' => true,
	'_GET' => true,
	'_SERVER' => true,
	'GLOBALS' => true
]);
