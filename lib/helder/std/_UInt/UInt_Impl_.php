<?php
/**
 */

namespace helder\std\_UInt;

use \helder\std\php\Boot;
use \helder\std\Std;

final class UInt_Impl_ {
	/**
	 * @param int $a
	 * @param int $b
	 * 
	 * @return int
	 */
	public static function add ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:136: characters 3-31
		return $a + $b;
	}

	/**
	 * @param int $a
	 * @param float $b
	 * 
	 * @return float
	 */
	public static function addWithFloat ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:202: characters 10-21
		$int = $a;
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:202: characters 3-25
		return (($int < 0 ? 4294967296.0 + $int : $int + 0.0)) + $b;
	}

	/**
	 * @param int $a
	 * @param int $b
	 * 
	 * @return int
	 */
	public static function and ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:174: characters 3-31
		return $a & $b;
	}

	/**
	 * @param int $a
	 * @param int $b
	 * 
	 * @return float
	 */
	public static function div ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:140: characters 10-21
		$int = $a;
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:140: characters 24-35
		$int1 = $b;
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:140: characters 3-35
		return (($int < 0 ? 4294967296.0 + $int : $int + 0.0)) / (($int1 < 0 ? 4294967296.0 + $int1 : $int1 + 0.0));
	}

	/**
	 * @param int $a
	 * @param float $b
	 * 
	 * @return float
	 */
	public static function divFloat ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:210: characters 10-21
		$int = $a;
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:210: characters 3-25
		return (($int < 0 ? 4294967296.0 + $int : $int + 0.0)) / $b;
	}

	/**
	 * @param int $a
	 * @param mixed $b
	 * 
	 * @return bool
	 */
	public static function equalsFloat ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:238: characters 10-21
		$int = $a;
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:238: characters 3-26
		return Boot::equal((($int < 0 ? 4294967296.0 + $int : $int + 0.0)), $b);
	}

	/**
	 * @param int $a
	 * @param mixed $b
	 * 
	 * @return bool
	 */
	public static function equalsInt ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:230: characters 3-24
		return Boot::equal($a, $b);
	}

	/**
	 * @param float $a
	 * @param int $b
	 * 
	 * @return float
	 */
	public static function floatDiv ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:214: characters 14-25
		$int = $b;
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:214: characters 3-25
		return $a / (($int < 0 ? 4294967296.0 + $int : $int + 0.0));
	}

	/**
	 * @param float $a
	 * @param int $b
	 * 
	 * @return bool
	 */
	public static function floatGt ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:250: characters 14-25
		$int = $b;
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:250: characters 3-25
		return $a > (($int < 0 ? 4294967296.0 + $int : $int + 0.0));
	}

	/**
	 * @param float $a
	 * @param int $b
	 * 
	 * @return bool
	 */
	public static function floatGte ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:254: characters 15-26
		$int = $b;
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:254: characters 3-26
		return $a >= (($int < 0 ? 4294967296.0 + $int : $int + 0.0));
	}

	/**
	 * @param float $a
	 * @param int $b
	 * 
	 * @return bool
	 */
	public static function floatLt ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:266: characters 14-25
		$int = $b;
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:266: characters 3-25
		return $a < (($int < 0 ? 4294967296.0 + $int : $int + 0.0));
	}

	/**
	 * @param float $a
	 * @param int $b
	 * 
	 * @return bool
	 */
	public static function floatLte ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:270: characters 15-26
		$int = $b;
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:270: characters 3-26
		return $a <= (($int < 0 ? 4294967296.0 + $int : $int + 0.0));
	}

	/**
	 * @param float $a
	 * @param int $b
	 * 
	 * @return float
	 */
	public static function floatMod ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:278: characters 14-25
		$int = $b;
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:278: characters 3-25
		return fmod($a, (($int < 0 ? 4294967296.0 + $int : $int + 0.0)));
	}

	/**
	 * @param float $a
	 * @param int $b
	 * 
	 * @return float
	 */
	public static function floatSub ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:222: characters 14-25
		$int = $b;
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:222: characters 3-25
		return $a - (($int < 0 ? 4294967296.0 + $int : $int + 0.0));
	}

	/**
	 * @param int $a
	 * @param int $b
	 * 
	 * @return bool
	 */
	public static function gt ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:153: characters 3-28
		$aNeg = $a < 0;
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:154: characters 3-28
		$bNeg = $b < 0;
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:155: characters 10-60
		if ($aNeg !== $bNeg) {
			#/home/runner/haxe/versions/4.2.3/std/UInt.hx:155: characters 28-32
			return $aNeg;
		} else {
			#/home/runner/haxe/versions/4.2.3/std/UInt.hx:155: characters 39-60
			return $a > $b;
		}
	}

	/**
	 * @param int $a
	 * @param float $b
	 * 
	 * @return bool
	 */
	public static function gtFloat ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:226: characters 10-21
		$int = $a;
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:226: characters 3-25
		return (($int < 0 ? 4294967296.0 + $int : $int + 0.0)) > $b;
	}

	/**
	 * @param int $a
	 * @param int $b
	 * 
	 * @return bool
	 */
	public static function gte ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:160: characters 3-28
		$aNeg = $a < 0;
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:161: characters 3-28
		$bNeg = $b < 0;
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:162: characters 10-61
		if ($aNeg !== $bNeg) {
			#/home/runner/haxe/versions/4.2.3/std/UInt.hx:162: characters 28-32
			return $aNeg;
		} else {
			#/home/runner/haxe/versions/4.2.3/std/UInt.hx:162: characters 39-61
			return $a >= $b;
		}
	}

	/**
	 * @param int $a
	 * @param float $b
	 * 
	 * @return bool
	 */
	public static function gteFloat ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:246: characters 10-21
		$int = $a;
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:246: characters 3-26
		return (($int < 0 ? 4294967296.0 + $int : $int + 0.0)) >= $b;
	}

	/**
	 * @param int $a
	 * @param int $b
	 * 
	 * @return bool
	 */
	public static function lt ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:166: characters 10-18
		$aNeg = $b < 0;
		$bNeg = $a < 0;
		if ($aNeg !== $bNeg) {
			return $aNeg;
		} else {
			return $b > $a;
		}
	}

	/**
	 * @param int $a
	 * @param float $b
	 * 
	 * @return bool
	 */
	public static function ltFloat ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:258: characters 10-21
		$int = $a;
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:258: characters 3-25
		return (($int < 0 ? 4294967296.0 + $int : $int + 0.0)) < $b;
	}

	/**
	 * @param int $a
	 * @param int $b
	 * 
	 * @return bool
	 */
	public static function lte ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:170: characters 10-19
		$aNeg = $b < 0;
		$bNeg = $a < 0;
		if ($aNeg !== $bNeg) {
			return $aNeg;
		} else {
			return $b >= $a;
		}
	}

	/**
	 * @param int $a
	 * @param float $b
	 * 
	 * @return bool
	 */
	public static function lteFloat ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:262: characters 10-21
		$int = $a;
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:262: characters 3-26
		return (($int < 0 ? 4294967296.0 + $int : $int + 0.0)) <= $b;
	}

	/**
	 * @param int $a
	 * @param int $b
	 * 
	 * @return int
	 */
	public static function mod ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:198: characters 18-29
		$int = $a;
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:198: characters 32-43
		$int1 = $b;
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:198: characters 3-44
		return (int)((fmod((($int < 0 ? 4294967296.0 + $int : $int + 0.0)), (($int1 < 0 ? 4294967296.0 + $int1 : $int1 + 0.0)))));
	}

	/**
	 * @param int $a
	 * @param float $b
	 * 
	 * @return float
	 */
	public static function modFloat ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:274: characters 10-21
		$int = $a;
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:274: characters 3-25
		return fmod((($int < 0 ? 4294967296.0 + $int : $int + 0.0)), $b);
	}

	/**
	 * @param int $a
	 * @param int $b
	 * 
	 * @return int
	 */
	public static function mul ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:144: characters 3-31
		return $a * $b;
	}

	/**
	 * @param int $a
	 * @param float $b
	 * 
	 * @return float
	 */
	public static function mulWithFloat ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:206: characters 10-21
		$int = $a;
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:206: characters 3-25
		return (($int < 0 ? 4294967296.0 + $int : $int + 0.0)) * $b;
	}

	/**
	 * @param int $this
	 * 
	 * @return int
	 */
	public static function negBits ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:282: characters 3-15
		return ~$this1;
	}

	/**
	 * @param int $a
	 * @param mixed $b
	 * 
	 * @return bool
	 */
	public static function notEqualsFloat ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:242: characters 10-21
		$int = $a;
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:242: characters 3-26
		return !Boot::equal((($int < 0 ? 4294967296.0 + $int : $int + 0.0)), $b);
	}

	/**
	 * @param int $a
	 * @param mixed $b
	 * 
	 * @return bool
	 */
	public static function notEqualsInt ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:234: characters 3-24
		return !Boot::equal($a, $b);
	}

	/**
	 * @param int $a
	 * @param int $b
	 * 
	 * @return int
	 */
	public static function or ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:178: characters 3-31
		return $a | $b;
	}

	/**
	 * @param int $this
	 * 
	 * @return int
	 */
	public static function postfixDecrement ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:298: characters 10-16
		return $this1--;
	}

	/**
	 * @param int $this
	 * 
	 * @return int
	 */
	public static function postfixIncrement ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:290: characters 10-16
		return $this1++;
	}

	/**
	 * @param int $this
	 * 
	 * @return int
	 */
	public static function prefixDecrement ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:294: characters 12-16
		return --$this1;
	}

	/**
	 * @param int $this
	 * 
	 * @return int
	 */
	public static function prefixIncrement ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:286: characters 12-16
		return ++$this1;
	}

	/**
	 * @param int $a
	 * @param int $b
	 * 
	 * @return int
	 */
	public static function shl ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:186: characters 3-24
		return $a << $b;
	}

	/**
	 * @param int $a
	 * @param int $b
	 * 
	 * @return int
	 */
	public static function shr ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:190: characters 3-25
		return Boot::shiftRightUnsigned($a, $b);
	}

	/**
	 * @param int $a
	 * @param int $b
	 * 
	 * @return int
	 */
	public static function sub ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:148: characters 3-31
		return $a - $b;
	}

	/**
	 * @param int $a
	 * @param float $b
	 * 
	 * @return float
	 */
	public static function subFloat ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:218: characters 10-21
		$int = $a;
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:218: characters 3-25
		return (($int < 0 ? 4294967296.0 + $int : $int + 0.0)) - $b;
	}

	/**
	 * @param int $this
	 * 
	 * @return float
	 */
	public static function toFloat ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:311: characters 3-21
		$int = $this1;
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:312: lines 312-318
		if ($int < 0) {
			#/home/runner/haxe/versions/4.2.3/std/UInt.hx:313: characters 4-29
			return 4294967296.0 + $int;
		} else {
			#/home/runner/haxe/versions/4.2.3/std/UInt.hx:317: characters 4-20
			return $int + 0.0;
		}
	}

	/**
	 * @param int $this
	 * 
	 * @return int
	 */
	public static function toInt ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:307: characters 3-14
		return $this1;
	}

	/**
	 * @param int $this
	 * @param int $radix
	 * 
	 * @return string
	 */
	public static function toString ($this1, $radix = null) {
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:303: characters 21-30
		$int = $this1;
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:303: characters 3-31
		return Std::string(($int < 0 ? 4294967296.0 + $int : $int + 0.0));
	}

	/**
	 * @param int $a
	 * @param int $b
	 * 
	 * @return int
	 */
	public static function ushr ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:194: characters 3-25
		return Boot::shiftRightUnsigned($a, $b);
	}

	/**
	 * @param int $a
	 * @param int $b
	 * 
	 * @return int
	 */
	public static function xor ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/UInt.hx:182: characters 3-31
		return $a ^ $b;
	}
}

Boot::registerClass(UInt_Impl_::class, '_UInt.UInt_Impl_');
