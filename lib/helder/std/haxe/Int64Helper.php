<?php
/**
 */

namespace helder\std\haxe;

use \helder\std\haxe\_Int64\___Int64;
use \helder\std\php\Boot;
use \helder\std\php\_Boot\HxString;
use \helder\std\haxe\_Int32\Int32_Impl_;

/**
 * Helper for parsing to `Int64` instances.
 */
class Int64Helper {
	/**
	 * Create `Int64` from given float.
	 * 
	 * @param float $f
	 * 
	 * @return ___Int64
	 */
	public static function fromFloat ($f) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:80: lines 80-82
		if (\is_nan($f) || !\is_finite($f)) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:81: characters 4-9
			throw Exception::thrown("Number is NaN or Infinite");
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:84: characters 3-33
		$noFractions = $f - fmod($f, 1);
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:90: lines 90-92
		if ($noFractions > 9007199254740991) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:91: characters 4-9
			throw Exception::thrown("Conversion overflow");
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:93: lines 93-95
		if ($noFractions < -9007199254740991) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:94: characters 4-9
			throw Exception::thrown("Conversion underflow");
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:97: characters 16-30
		$this1 = new ___Int64(0, 0);
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:97: characters 3-31
		$result = $this1;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:98: characters 3-29
		$neg = $noFractions < 0;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:99: characters 3-47
		$rest = ($neg ? -$noFractions : $noFractions);
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:101: characters 3-13
		$i = 0;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:102: lines 102-109
		while ($rest >= 1) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:103: characters 4-24
			$curr = fmod($rest, 2);
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:104: characters 4-8
			$rest /= 2;
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:105: lines 105-107
			if ($curr >= 1) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:106: characters 42-56
				$a_high = 0;
				$a_low = 1;
				#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:106: characters 32-60
				$b = $i;
				$b &= 63;
				#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:106: characters 14-61
				$b1 = null;
				#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:106: characters 32-60
				if ($b === 0) {
					$this1 = new ___Int64($a_high, $a_low);
					#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:106: characters 14-61
					$b1 = $this1;
				} else if ($b < 32) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:106: characters 32-60
					$this2 = new ___Int64((((($a_high << $b << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits) | Boot::shiftRightUnsigned($a_low, (32 - $b))) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits, ($a_low << $b << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits);
					#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:106: characters 14-61
					$b1 = $this2;
				} else {
					#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:106: characters 32-60
					$this3 = new ___Int64(($a_low << ($b - 32) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits, 0);
					#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:106: characters 14-61
					$b1 = $this3;
				}
				$high = (($result->high + $b1->high) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
				$low = (($result->low + $b1->low) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
				if (Int32_Impl_::ucompare($low, $result->low) < 0) {
					$ret = $high++;
					#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:264: characters 4-8
					$high = ($high << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
				}
				#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:106: characters 14-61
				$this4 = new ___Int64($high, $low);
				$result = $this4;
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:108: characters 4-7
			++$i;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:111: lines 111-113
		if ($neg) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:112: characters 13-30
			$high = (~$result->high << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
			$low = ((~$result->low + 1) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
			if ($low === 0) {
				$ret = $high++;
				#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:225: characters 4-8
				$high = ($high << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:112: characters 13-30
			$this1 = new ___Int64($high, $low);
			$result = $this1;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:114: characters 3-16
		return $result;
	}

	/**
	 * Create `Int64` from given string.
	 * 
	 * @param string $sParam
	 * 
	 * @return ___Int64
	 */
	public static function parseString ($sParam) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:37: characters 14-29
		$base_high = 0;
		$base_low = 10;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:38: characters 17-31
		$this1 = new ___Int64(0, 0);
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:38: characters 3-32
		$current = $this1;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:39: characters 20-34
		$this1 = new ___Int64(0, 1);
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:39: characters 3-35
		$multiplier = $this1;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:40: characters 3-27
		$sIsNegative = false;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:42: characters 3-36
		$s = \trim($sParam);
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:43: lines 43-46
		if (\mb_substr($s, 0, 1) === "-") {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:44: characters 4-15
			$sIsNegative = true;
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:45: characters 4-5
			$s = HxString::substring($s, 1, mb_strlen($s));
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:47: characters 3-22
		$len = mb_strlen($s);
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:49: characters 13-17
		$_g = 0;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:49: characters 17-20
		$_g1 = $len;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:49: lines 49-72
		while ($_g < $_g1) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:49: characters 13-20
			$i = $_g++;
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:50: characters 4-56
			$digitInt = HxString::charCodeAt($s, $len - 1 - $i) - 48;
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:52: lines 52-54
			if (($digitInt < 0) || ($digitInt > 9)) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:53: characters 5-10
				throw Exception::thrown("NumberFormatError");
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:56: lines 56-69
			if ($digitInt !== 0) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:57: characters 23-44
				$digit_high = $digitInt >> 31;
				$digit_low = $digitInt;
				#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:58: lines 58-68
				if ($sIsNegative) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:59: characters 35-63
					$mask = 65535;
					$al = $multiplier->low & $mask;
					$ah = Boot::shiftRightUnsigned($multiplier->low, 16);
					$bl = $digit_low & $mask;
					$bh = Boot::shiftRightUnsigned($digit_low, 16);
					$p00 = Int32_Impl_::mul($al, $bl);
					$p10 = Int32_Impl_::mul($ah, $bl);
					$p01 = Int32_Impl_::mul($al, $bh);
					$p11 = Int32_Impl_::mul($ah, $bh);
					$low = $p00;
					$high = ((((($p11 + (Boot::shiftRightUnsigned($p01, 16))) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits) + (Boot::shiftRightUnsigned($p10, 16))) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
					#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:302: characters 3-6
					$p01 = ($p01 << 16 << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
					#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:303: characters 3-6
					$low = (($low + $p01) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
					#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:59: characters 35-63
					if (Int32_Impl_::ucompare($low, $p01) < 0) {
						$ret = $high++;
						#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:305: characters 4-8
						$high = ($high << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
					}
					#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:306: characters 3-6
					$p10 = ($p10 << 16 << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
					#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:307: characters 3-6
					$low = (($low + $p10) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
					#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:59: characters 35-63
					if (Int32_Impl_::ucompare($low, $p10) < 0) {
						$ret1 = $high++;
						#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:309: characters 4-8
						$high = ($high << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
					}
					#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:59: characters 35-63
					$high = (($high + (((Int32_Impl_::mul($multiplier->low, $digit_high) + Int32_Impl_::mul($multiplier->high, $digit_low)) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits)) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
					$b_high = $high;
					$b_low = $low;
					#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:59: characters 16-64
					$high1 = (($current->high - $b_high) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
					$low1 = (($current->low - $b_low) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
					if (Int32_Impl_::ucompare($current->low, $b_low) < 0) {
						$ret2 = $high1--;
						#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:278: characters 4-8
						$high1 = ($high1 << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
					}
					#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:59: characters 16-64
					$this1 = new ___Int64($high1, $low1);
					$current = $this1;
					#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:60: lines 60-62
					if (!($current->high < 0)) {
						#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:61: characters 7-12
						throw Exception::thrown("NumberFormatError: Underflow");
					}
				} else {
					#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:64: characters 35-63
					$mask1 = 65535;
					$al1 = $multiplier->low & $mask1;
					$ah1 = Boot::shiftRightUnsigned($multiplier->low, 16);
					$bl1 = $digit_low & $mask1;
					$bh1 = Boot::shiftRightUnsigned($digit_low, 16);
					$p001 = Int32_Impl_::mul($al1, $bl1);
					$p101 = Int32_Impl_::mul($ah1, $bl1);
					$p011 = Int32_Impl_::mul($al1, $bh1);
					$p111 = Int32_Impl_::mul($ah1, $bh1);
					$low2 = $p001;
					$high2 = ((((($p111 + (Boot::shiftRightUnsigned($p011, 16))) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits) + (Boot::shiftRightUnsigned($p101, 16))) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
					#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:302: characters 3-6
					$p011 = ($p011 << 16 << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
					#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:303: characters 3-6
					$low2 = (($low2 + $p011) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
					#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:64: characters 35-63
					if (Int32_Impl_::ucompare($low2, $p011) < 0) {
						$ret3 = $high2++;
						#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:305: characters 4-8
						$high2 = ($high2 << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
					}
					#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:306: characters 3-6
					$p101 = ($p101 << 16 << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
					#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:307: characters 3-6
					$low2 = (($low2 + $p101) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
					#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:64: characters 35-63
					if (Int32_Impl_::ucompare($low2, $p101) < 0) {
						$ret4 = $high2++;
						#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:309: characters 4-8
						$high2 = ($high2 << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
					}
					#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:64: characters 35-63
					$high2 = (($high2 + (((Int32_Impl_::mul($multiplier->low, $digit_high) + Int32_Impl_::mul($multiplier->high, $digit_low)) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits)) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
					$b_high1 = $high2;
					$b_low1 = $low2;
					#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:64: characters 16-64
					$high3 = (($current->high + $b_high1) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
					$low3 = (($current->low + $b_low1) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
					if (Int32_Impl_::ucompare($low3, $current->low) < 0) {
						$ret5 = $high3++;
						#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:264: characters 4-8
						$high3 = ($high3 << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
					}
					#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:64: characters 16-64
					$this2 = new ___Int64($high3, $low3);
					$current = $this2;
					#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:65: lines 65-67
					if ($current->high < 0) {
						#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:66: characters 7-12
						throw Exception::thrown("NumberFormatError: Overflow");
					}
				}
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:71: characters 17-44
			$mask2 = 65535;
			$al2 = $multiplier->low & $mask2;
			$ah2 = Boot::shiftRightUnsigned($multiplier->low, 16);
			$bl2 = $base_low & $mask2;
			$bh2 = Boot::shiftRightUnsigned($base_low, 16);
			$p002 = Int32_Impl_::mul($al2, $bl2);
			$p102 = Int32_Impl_::mul($ah2, $bl2);
			$p012 = Int32_Impl_::mul($al2, $bh2);
			$p112 = Int32_Impl_::mul($ah2, $bh2);
			$low4 = $p002;
			$high4 = ((((($p112 + (Boot::shiftRightUnsigned($p012, 16))) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits) + (Boot::shiftRightUnsigned($p102, 16))) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:302: characters 3-6
			$p012 = ($p012 << 16 << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:303: characters 3-6
			$low4 = (($low4 + $p012) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:71: characters 17-44
			if (Int32_Impl_::ucompare($low4, $p012) < 0) {
				$ret6 = $high4++;
				#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:305: characters 4-8
				$high4 = ($high4 << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:306: characters 3-6
			$p102 = ($p102 << 16 << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:307: characters 3-6
			$low4 = (($low4 + $p102) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:71: characters 17-44
			if (Int32_Impl_::ucompare($low4, $p102) < 0) {
				$ret7 = $high4++;
				#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:309: characters 4-8
				$high4 = ($high4 << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:71: characters 17-44
			$high4 = (($high4 + (((Int32_Impl_::mul($multiplier->low, $base_high) + Int32_Impl_::mul($multiplier->high, $base_low)) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits)) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
			$this3 = new ___Int64($high4, $low4);
			$multiplier = $this3;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64Helper.hx:73: characters 3-17
		return $current;
	}
}

Boot::registerClass(Int64Helper::class, 'haxe.Int64Helper');
