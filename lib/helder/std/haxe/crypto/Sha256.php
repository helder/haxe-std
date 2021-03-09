<?php
/**
 * Generated by Haxe 4.1.5
 */

namespace helder\std\haxe\crypto;

use \helder\std\haxe\io\_BytesData\Container;
use \helder\std\php\Boot;
use \helder\std\haxe\io\Bytes;

class Sha256 {
	/**
	 * @param string $s
	 * 
	 * @return string
	 */
	public static function encode ($s) {
		#/home/runner/haxe/versions/4.1.5/std/php/_std/haxe/crypto/Sha256.hx:30: characters 3-34
		return \hash("sha256", $s);
	}

	/**
	 * @param Bytes $b
	 * 
	 * @return Bytes
	 */
	public static function make ($b) {
		#/home/runner/haxe/versions/4.1.5/std/php/_std/haxe/crypto/Sha256.hx:34: characters 10-64
		$b1 = new Container(\hash("sha256", $b->b->s, true));
		return new Bytes(\strlen($b1->s), $b1);
	}
}

Boot::registerClass(Sha256::class, 'haxe.crypto.Sha256');
