<?php
/**
 */

namespace helder\std\haxe\crypto;

use \helder\std\php\Boot;
use \helder\std\php\_Boot\HxEnum;

/**
 * Hash methods for Hmac calculation.
 */
class HashMethod extends HxEnum {
	/**
	 * @return HashMethod
	 */
	static public function MD5 () {
		static $inst = null;
		if (!$inst) $inst = new HashMethod('MD5', 0, []);
		return $inst;
	}

	/**
	 * @return HashMethod
	 */
	static public function SHA1 () {
		static $inst = null;
		if (!$inst) $inst = new HashMethod('SHA1', 1, []);
		return $inst;
	}

	/**
	 * @return HashMethod
	 */
	static public function SHA256 () {
		static $inst = null;
		if (!$inst) $inst = new HashMethod('SHA256', 2, []);
		return $inst;
	}

	/**
	 * Returns array of (constructorIndex => constructorName)
	 *
	 * @return string[]
	 */
	static public function __hx__list () {
		return [
			0 => 'MD5',
			1 => 'SHA1',
			2 => 'SHA256',
		];
	}

	/**
	 * Returns array of (constructorName => parametersCount)
	 *
	 * @return int[]
	 */
	static public function __hx__paramsCount () {
		return [
			'MD5' => 0,
			'SHA1' => 0,
			'SHA256' => 0,
		];
	}
}

Boot::registerClass(HashMethod::class, 'haxe.crypto.HashMethod');
