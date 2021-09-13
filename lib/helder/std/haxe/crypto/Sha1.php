<?php
/**
 */

namespace helder\std\haxe\crypto;

use \helder\std\haxe\io\_BytesData\Container;
use \helder\std\php\Boot;
use \helder\std\haxe\io\Bytes;

class Sha1 {
	/**
	 * @param string $s
	 * 
	 * @return string
	 */
	public static function encode ($s) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/crypto/Sha1.hx:30: characters 3-24
		return \sha1($s);
	}

	/**
	 * @param Bytes $b
	 * 
	 * @return Bytes
	 */
	public static function make ($b) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/crypto/Sha1.hx:34: characters 10-54
		$b1 = new Container(\sha1($b->b->s, true));
		return new Bytes(\strlen($b1->s), $b1);
	}
}

Boot::registerClass(Sha1::class, 'haxe.crypto.Sha1');
