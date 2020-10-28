<?php
/**
 * Generated by Haxe 4.0.0+ef18b627e
 */

namespace helder\std\haxe\io;

use \helder\std\haxe\_Int64\___Int64;
use \helder\std\php\Boot;

class FPHelper {
	/**
	 * @var ___Int64
	 */
	static public $i64tmp;
	/**
	 * @var bool
	 */
	static public $isLittleEndian;

	/**
	 * @param float $v
	 * 
	 * @return ___Int64
	 */
	static public function doubleToI64 ($v) {
		#/home/runner/haxe/versions/4.0.0/std/php/_std/haxe/io/FPHelper.hx:44: characters 3-76
		$a = unpack((FPHelper::$isLittleEndian ? "V2" : "N2"), pack("d", $v));
		#/home/runner/haxe/versions/4.0.0/std/php/_std/haxe/io/FPHelper.hx:45: characters 3-20
		$i64 = FPHelper::$i64tmp;
		#/home/runner/haxe/versions/4.0.0/std/php/_std/haxe/io/FPHelper.hx:46: characters 19-57
		$i64->low = $a[(FPHelper::$isLittleEndian ? 1 : 2)];
		#/home/runner/haxe/versions/4.0.0/std/php/_std/haxe/io/FPHelper.hx:47: characters 19-58
		$i64->high = $a[(FPHelper::$isLittleEndian ? 2 : 1)];
		#/home/runner/haxe/versions/4.0.0/std/php/_std/haxe/io/FPHelper.hx:49: characters 3-13
		return $i64;
	}

	/**
	 * @param float $f
	 * 
	 * @return int
	 */
	static public function floatToI32 ($f) {
		#/home/runner/haxe/versions/4.0.0/std/php/_std/haxe/io/FPHelper.hx:36: characters 3-52
		return unpack("l", pack("f", $f))[1];
	}

	/**
	 * @param int $i
	 * 
	 * @return float
	 */
	static public function i32ToFloat ($i) {
		#/home/runner/haxe/versions/4.0.0/std/php/_std/haxe/io/FPHelper.hx:32: characters 3-52
		return unpack("f", pack("l", $i))[1];
	}

	/**
	 * @param int $low
	 * @param int $high
	 * 
	 * @return float
	 */
	static public function i64ToDouble ($low, $high) {
		#/home/runner/haxe/versions/4.0.0/std/php/_std/haxe/io/FPHelper.hx:40: characters 3-108
		return unpack("d", pack("ii", (FPHelper::$isLittleEndian ? $low : $high), (FPHelper::$isLittleEndian ? $high : $low)))[1];
	}

	/**
	 * @internal
	 * @access private
	 */
	static public function __hx__init ()
	{
		static $called = false;
		if ($called) return;
		$called = true;


		self::$isLittleEndian = Boot::equal(unpack("S", "\x01\x00")[1], 1);
		$this1 = new ___Int64(0, 0);
		self::$i64tmp = $this1;
	}
}

Boot::registerClass(FPHelper::class, 'haxe.io.FPHelper');
FPHelper::__hx__init();
