<?php
/**
 */

namespace helder\std\haxe\_Int32;

use \helder\std\php\Boot;

final class Int32_Impl_ {
	/**
	 * @var int
	 */
	static public $extraBits;

	/**
	 * @param int $a
	 * @param int $b
	 * 
	 * @return int
	 */
	public static function add ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int32.hx:53: characters 3-38
		return (($a + $b) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
	}

	/**
	 * @param int $a
	 * @param int $b
	 * 
	 * @return int
	 */
	public static function addInt ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int32.hx:56: characters 3-38
		return (($a + $b) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
	}

	/**
	 * @param int $x
	 * 
	 * @return int
	 */
	public static function clamp ($x) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int32.hx:273: characters 3-39
		return ($x << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
	}

	/**
	 * @param int $a
	 * 
	 * @return int
	 */
	public static function complement ($a) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int32.hx:174: characters 49-65
		return (~$a << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
	}

	/**
	 * @param int $a
	 * @param int $b
	 * 
	 * @return int
	 */
	public static function intShl ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int32.hx:239: characters 3-31
		return ($a << $b << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
	}

	/**
	 * @param int $a
	 * @param int $b
	 * 
	 * @return int
	 */
	public static function intShr ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int32.hx:215: characters 3-31
		return (($a >> $b) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
	}

	/**
	 * @param int $a
	 * @param int $b
	 * 
	 * @return int
	 */
	public static function intSub ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int32.hx:67: characters 3-38
		return (($a - $b) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
	}

	/**
	 * @param int $a
	 * @param int $b
	 * 
	 * @return int
	 */
	public static function mul ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int32.hx:87: characters 3-95
		return (($a * ($b & 65535) + ((($a * (Boot::shiftRightUnsigned($b, 16))) << 16 << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits)) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
	}

	/**
	 * @param int $a
	 * @param int $b
	 * 
	 * @return int
	 */
	public static function mulInt ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int32.hx:91: characters 3-19
		return Int32_Impl_::mul($a, $b);
	}

	/**
	 * @param int $this
	 * 
	 * @return int
	 */
	public static function negate ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int32.hx:32: characters 3-26
		return ((~$this1 + 1) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
	}

	/**
	 * @param int $a
	 * @param int $b
	 * 
	 * @return int
	 */
	public static function or ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int32.hx:185: characters 3-38
		return (($a | $b) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
	}

	/**
	 * @param int $a
	 * @param int $b
	 * 
	 * @return int
	 */
	public static function orInt ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int32.hx:188: characters 3-30
		return (($a | $b) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
	}

	/**
	 * @param int $this
	 * 
	 * @return int
	 */
	public static function postDecrement ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int32.hx:47: characters 13-19
		$ret = $this1--;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int32.hx:48: characters 3-21
		$this1 = ($this1 << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int32.hx:49: characters 3-13
		return $ret;
	}

	/**
	 * @param int $this
	 * 
	 * @return int
	 */
	public static function postIncrement ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int32.hx:38: characters 13-19
		$ret = $this1++;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int32.hx:39: characters 3-21
		$this1 = ($this1 << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int32.hx:40: characters 3-13
		return $ret;
	}

	/**
	 * @param int $this
	 * 
	 * @return int
	 */
	public static function preDecrement ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int32.hx:44: characters 17-30
		$this1 = (--$this1 << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int32.hx:44: characters 3-30
		return $this1;
	}

	/**
	 * @param int $this
	 * 
	 * @return int
	 */
	public static function preIncrement ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int32.hx:35: characters 17-30
		$this1 = (++$this1 << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int32.hx:35: characters 3-30
		return $this1;
	}

	/**
	 * @param int $a
	 * @param int $b
	 * 
	 * @return int
	 */
	public static function shl ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int32.hx:233: characters 3-39
		return ($a << $b << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
	}

	/**
	 * @param int $a
	 * @param int $b
	 * 
	 * @return int
	 */
	public static function shlInt ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int32.hx:236: characters 3-31
		return ($a << $b << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
	}

	/**
	 * @param int $a
	 * @param int $b
	 * 
	 * @return int
	 */
	public static function shr ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int32.hx:209: characters 3-39
		return (($a >> $b) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
	}

	/**
	 * @param int $a
	 * @param int $b
	 * 
	 * @return int
	 */
	public static function shrInt ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int32.hx:212: characters 3-31
		return (($a >> $b) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
	}

	/**
	 * @param int $a
	 * @param int $b
	 * 
	 * @return int
	 */
	public static function sub ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int32.hx:61: characters 3-38
		return (($a - $b) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
	}

	/**
	 * @param int $a
	 * @param int $b
	 * 
	 * @return int
	 */
	public static function subInt ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int32.hx:64: characters 3-38
		return (($a - $b) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
	}

	/**
	 * @param int $this
	 * 
	 * @return float
	 */
	public static function toFloat ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int32.hx:249: characters 3-14
		return $this1;
	}

	/**
	 * Compare `a` and `b` in unsigned mode.
	 * 
	 * @param int $a
	 * @param int $b
	 * 
	 * @return int
	 */
	public static function ucompare ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int32.hx:255: lines 255-256
		if ($a < 0) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int32.hx:256: characters 11-32
			if ($b < 0) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Int32.hx:256: characters 19-28
				return ((((~$b << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits) - ((~$a << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits)) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
			} else {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Int32.hx:256: characters 31-32
				return 1;
			}
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int32.hx:257: characters 10-30
		if ($b < 0) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int32.hx:257: characters 18-20
			return -1;
		} else {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int32.hx:257: characters 23-30
			return (($a - $b) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		}
	}

	/**
	 * @param int $a
	 * @param int $b
	 * 
	 * @return int
	 */
	public static function xor ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int32.hx:197: characters 3-38
		return (($a ^ $b) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
	}

	/**
	 * @param int $a
	 * @param int $b
	 * 
	 * @return int
	 */
	public static function xorInt ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int32.hx:200: characters 3-30
		return (($a ^ $b) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
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


		self::$extraBits = \PHP_INT_SIZE * 8 - 32;
	}
}

Boot::registerClass(Int32_Impl_::class, 'haxe._Int32.Int32_Impl_');
Int32_Impl_::__hx__init();
