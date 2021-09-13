<?php
/**
 */

namespace helder\std\haxe\crypto;

use \helder\std\haxe\io\_BytesData\Container;
use \helder\std\php\Boot;
use \helder\std\haxe\io\Bytes;

class Md5 {
	/**
	 * @param string $s
	 * 
	 * @return string
	 */
	public static function encode ($s) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/crypto/Md5.hx:30: characters 3-23
		return \md5($s);
	}

	/**
	 * @param Bytes $b
	 * 
	 * @return Bytes
	 */
	public static function make ($b) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/crypto/Md5.hx:34: characters 10-53
		$b1 = new Container(\md5($b->b->s, true));
		return new Bytes(\strlen($b1->s), $b1);
	}
}

Boot::registerClass(Md5::class, 'haxe.crypto.Md5');
