<?php
/**
 * Generated by Haxe 4.2.2
 */

namespace helder\std\haxe\crypto;

use \helder\std\haxe\io\_BytesData\Container;
use \helder\std\php\Boot;
use \helder\std\haxe\io\Bytes;

class Sha224 {
	/**
	 * @param string $s
	 * 
	 * @return string
	 */
	public static function encode ($s) {
		#/home/runner/haxe/versions/4.2.2/std/php/_std/haxe/crypto/Sha224.hx:30: characters 3-34
		return \hash("sha224", $s);
	}

	/**
	 * @param Bytes $b
	 * 
	 * @return Bytes
	 */
	public static function make ($b) {
		#/home/runner/haxe/versions/4.2.2/std/php/_std/haxe/crypto/Sha224.hx:34: characters 10-64
		$b1 = new Container(\hash("sha224", $b->b->s, true));
		return new Bytes(\strlen($b1->s), $b1);
	}
}

Boot::registerClass(Sha224::class, 'haxe.crypto.Sha224');
