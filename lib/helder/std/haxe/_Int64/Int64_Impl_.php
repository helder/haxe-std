<?php
/**
 */

namespace helder\std\haxe\_Int64;

use \helder\std\php\_Boot\HxAnon;
use \helder\std\php\Boot;
use \helder\std\haxe\Exception;
use \helder\std\haxe\Int64Helper;
use \helder\std\haxe\_Int32\Int32_Impl_;

final class Int64_Impl_ {

	/**
	 * @param ___Int64 $x
	 * 
	 * @return ___Int64
	 */
	public static function _new ($x) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:36: character 2
		$this1 = $x;
		return $this1;
	}

	/**
	 * Returns the sum of `a` and `b`.
	 * 
	 * @param ___Int64 $a
	 * @param ___Int64 $b
	 * 
	 * @return ___Int64
	 */
	public static function add ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:261: characters 3-30
		$high = (($a->high + $b->high) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:262: characters 3-27
		$low = (($a->low + $b->low) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:263: lines 263-264
		if (Int32_Impl_::ucompare($low, $a->low) < 0) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:264: characters 4-10
			$ret = $high++;
			$high = ($high << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:265: characters 10-25
		$this1 = new ___Int64($high, $low);
		return $this1;
	}

	/**
	 * @param ___Int64 $a
	 * @param int $b
	 * 
	 * @return ___Int64
	 */
	public static function addInt ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:269: characters 17-18
		$b_high = $b >> 31;
		$b_low = $b;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:269: characters 10-19
		$high = (($a->high + $b_high) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		$low = (($a->low + $b_low) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		if (Int32_Impl_::ucompare($low, $a->low) < 0) {
			$ret = $high++;
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:264: characters 4-8
			$high = ($high << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:269: characters 10-19
		$this1 = new ___Int64($high, $low);
		return $this1;
	}

	/**
	 * Returns the bitwise AND of `a` and `b`.
	 * 
	 * @param ___Int64 $a
	 * @param ___Int64 $b
	 * 
	 * @return ___Int64
	 */
	public static function and ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:405: characters 10-46
		$this1 = new ___Int64($a->high & $b->high, $a->low & $b->low);
		return $this1;
	}

	/**
	 * Compares `a` and `b` in signed mode.
	 * Returns a negative value if `a < b`, positive if `a > b`,
	 * or 0 if `a == b`.
	 * 
	 * @param ___Int64 $a
	 * @param ___Int64 $b
	 * 
	 * @return int
	 */
	public static function compare ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:112: characters 3-27
		$v = (($a->high - $b->high) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:113: characters 7-54
		if ($v === 0) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:113: characters 26-54
			$v = Int32_Impl_::ucompare($a->low, $b->low);
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:114: characters 10-68
		if ($a->high < 0) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:114: characters 23-44
			if ($b->high < 0) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:114: characters 37-38
				return $v;
			} else {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:114: characters 41-43
				return -1;
			}
		} else if ($b->high >= 0) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:114: characters 62-63
			return $v;
		} else {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:114: characters 66-67
			return 1;
		}
	}

	/**
	 * Returns the bitwise NOT of `a`.
	 * 
	 * @param ___Int64 $a
	 * 
	 * @return ___Int64
	 */
	public static function complement ($a) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:399: characters 10-31
		$this1 = new ___Int64((~$a->high << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits, (~$a->low << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits);
		return $this1;
	}

	/**
	 * Makes a copy of `this` Int64.
	 * 
	 * @param ___Int64 $this
	 * 
	 * @return ___Int64
	 */
	public static function copy ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:43: characters 10-25
		$this2 = new ___Int64($this1->high, $this1->low);
		return $this2;
	}

	/**
	 * Returns the quotient of `a` divided by `b`.
	 * 
	 * @param ___Int64 $a
	 * @param ___Int64 $b
	 * 
	 * @return ___Int64
	 */
	public static function div ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:321: characters 3-31
		return Int64_Impl_::divMod($a, $b)->quotient;
	}

	/**
	 * @param ___Int64 $a
	 * @param int $b
	 * 
	 * @return ___Int64
	 */
	public static function divInt ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:324: characters 17-18
		$this1 = new ___Int64($b >> 31, $b);
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:324: characters 10-19
		return Int64_Impl_::divMod($a, $this1)->quotient;
	}

	/**
	 * Performs signed integer divison of `dividend` by `divisor`.
	 * Returns `{ quotient : Int64, modulus : Int64 }`.
	 * 
	 * @param ___Int64 $dividend
	 * @param ___Int64 $divisor
	 * 
	 * @return object
	 */
	public static function divMod ($dividend, $divisor) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:173: lines 173-180
		if ($divisor->high === 0) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:174: characters 12-23
			$__hx__switch = ($divisor->low);
			if ($__hx__switch === 0) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:176: characters 6-11
				throw Exception::thrown("divide by zero");
			} else if ($__hx__switch === 1) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:178: characters 24-39
				$this1 = new ___Int64($dividend->high, $dividend->low);
				#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:178: characters 50-51
				$this2 = new ___Int64(0, 0);
				#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:178: characters 6-52
				return new _HxAnon_Int64_Impl_0($this1, $this2);
			}
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:182: characters 3-53
		$divSign = ($dividend->high < 0) !== ($divisor->high < 0);
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:184: characters 3-64
		$modulus = null;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:184: characters 17-63
		if ($dividend->high < 0) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:184: characters 36-45
			$high = (~$dividend->high << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
			$low = ((~$dividend->low + 1) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
			if ($low === 0) {
				$ret = $high++;
				#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:225: characters 4-8
				$high = ($high << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:184: characters 36-45
			$this1 = new ___Int64($high, $low);
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:184: characters 3-64
			$modulus = $this1;
		} else {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:184: characters 48-63
			$this1 = new ___Int64($dividend->high, $dividend->low);
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:184: characters 3-64
			$modulus = $this1;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:185: characters 13-49
		if ($divisor->high < 0) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:185: characters 31-39
			$high = (~$divisor->high << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
			$low = ((~$divisor->low + 1) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
			if ($low === 0) {
				$ret = $high++;
				#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:225: characters 4-8
				$high = ($high << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:185: characters 31-39
			$this1 = new ___Int64($high, $low);
			$divisor = $this1;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:187: characters 3-26
		$this1 = new ___Int64(0, 0);
		$quotient = $this1;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:188: characters 3-22
		$this1 = new ___Int64(0, 1);
		$mask = $this1;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:190: lines 190-196
		while (!($divisor->high < 0)) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:191: characters 14-40
			$v = Int32_Impl_::ucompare($divisor->high, $modulus->high);
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:191: characters 4-41
			$cmp = ($v !== 0 ? $v : Int32_Impl_::ucompare($divisor->low, $modulus->low));
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:192: characters 4-17
			$b = 1;
			$b &= 63;
			if ($b === 0) {
				$this1 = new ___Int64($divisor->high, $divisor->low);
				$divisor = $this1;
			} else if ($b < 32) {
				$this2 = new ___Int64((((($divisor->high << $b << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits) | Boot::shiftRightUnsigned($divisor->low, (32 - $b))) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits, ($divisor->low << $b << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits);
				$divisor = $this2;
			} else {
				$this3 = new ___Int64(($divisor->low << ($b - 32) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits, 0);
				$divisor = $this3;
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:193: characters 4-14
			$b1 = 1;
			$b1 &= 63;
			if ($b1 === 0) {
				$this4 = new ___Int64($mask->high, $mask->low);
				$mask = $this4;
			} else if ($b1 < 32) {
				$this5 = new ___Int64((((($mask->high << $b1 << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits) | Boot::shiftRightUnsigned($mask->low, (32 - $b1))) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits, ($mask->low << $b1 << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits);
				$mask = $this5;
			} else {
				$this6 = new ___Int64(($mask->low << ($b1 - 32) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits, 0);
				$mask = $this6;
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:194: lines 194-195
			if ($cmp >= 0) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:195: characters 5-10
				break;
			}
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:198: lines 198-205
		while (true) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:198: characters 10-19
			$b_high = 0;
			$b_low = 0;
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:198: lines 198-205
			if (!(($mask->high !== $b_high) || ($mask->low !== $b_low))) {
				break;
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:199: characters 8-34
			$v = Int32_Impl_::ucompare($modulus->high, $divisor->high);
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:199: lines 199-202
			if ((($v !== 0 ? $v : Int32_Impl_::ucompare($modulus->low, $divisor->low))) >= 0) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:200: characters 5-21
				$this1 = new ___Int64((($quotient->high | $mask->high) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits, (($quotient->low | $mask->low) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits);
				$quotient = $this1;
				#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:201: characters 5-23
				$high = (($modulus->high - $divisor->high) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
				$low = (($modulus->low - $divisor->low) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
				if (Int32_Impl_::ucompare($modulus->low, $divisor->low) < 0) {
					$ret = $high--;
					#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:278: characters 4-8
					$high = ($high << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
				}
				#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:201: characters 5-23
				$this2 = new ___Int64($high, $low);
				$modulus = $this2;
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:203: characters 4-15
			$b = 1;
			$b &= 63;
			if ($b === 0) {
				$this3 = new ___Int64($mask->high, $mask->low);
				$mask = $this3;
			} else if ($b < 32) {
				$this4 = new ___Int64(Boot::shiftRightUnsigned($mask->high, $b), (((($mask->high << (32 - $b) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits) | Boot::shiftRightUnsigned($mask->low, $b)) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits);
				$mask = $this4;
			} else {
				$this5 = new ___Int64(0, Boot::shiftRightUnsigned($mask->high, ($b - 32)));
				$mask = $this5;
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:204: characters 4-18
			$b1 = 1;
			$b1 &= 63;
			if ($b1 === 0) {
				$this6 = new ___Int64($divisor->high, $divisor->low);
				$divisor = $this6;
			} else if ($b1 < 32) {
				$this7 = new ___Int64(Boot::shiftRightUnsigned($divisor->high, $b1), (((($divisor->high << (32 - $b1) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits) | Boot::shiftRightUnsigned($divisor->low, $b1)) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits);
				$divisor = $this7;
			} else {
				$this8 = new ___Int64(0, Boot::shiftRightUnsigned($divisor->high, ($b1 - 32)));
				$divisor = $this8;
			}
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:207: lines 207-208
		if ($divSign) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:208: characters 15-24
			$high = (~$quotient->high << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
			$low = ((~$quotient->low + 1) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
			if ($low === 0) {
				$ret = $high++;
				#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:225: characters 4-8
				$high = ($high << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:208: characters 15-24
			$this1 = new ___Int64($high, $low);
			$quotient = $this1;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:209: lines 209-210
		if ($dividend->high < 0) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:210: characters 14-22
			$high = (~$modulus->high << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
			$low = ((~$modulus->low + 1) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
			if ($low === 0) {
				$ret = $high++;
				#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:225: characters 4-8
				$high = ($high << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:210: characters 14-22
			$this1 = new ___Int64($high, $low);
			$modulus = $this1;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:212: lines 212-215
		return new _HxAnon_Int64_Impl_0($quotient, $modulus);
	}

	/**
	 * Returns `true` if `a` is equal to `b`.
	 * 
	 * @param ___Int64 $a
	 * @param ___Int64 $b
	 * 
	 * @return bool
	 */
	public static function eq ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:345: characters 10-44
		if ($a->high === $b->high) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:345: characters 30-44
			return $a->low === $b->low;
		} else {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:345: characters 10-44
			return false;
		}
	}

	/**
	 * @param ___Int64 $a
	 * @param int $b
	 * 
	 * @return bool
	 */
	public static function eqInt ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:348: characters 16-17
		$b_high = $b >> 31;
		$b_low = $b;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:348: characters 10-18
		if ($a->high === $b_high) {
			return $a->low === $b_low;
		} else {
			return false;
		}
	}

	/**
	 * @param float $f
	 * 
	 * @return ___Int64
	 */
	public static function fromFloat ($f) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:164: characters 3-34
		return Int64Helper::fromFloat($f);
	}

	/**
	 * Returns the high 32-bit word of `x`.
	 * 
	 * @param ___Int64 $x
	 * 
	 * @return int
	 */
	public static function getHigh ($x) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:85: characters 3-16
		return $x->high;
	}

	/**
	 * Returns the low 32-bit word of `x`.
	 * 
	 * @param ___Int64 $x
	 * 
	 * @return int
	 */
	public static function getLow ($x) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:92: characters 3-15
		return $x->low;
	}

	/**
	 * @param ___Int64 $this
	 * 
	 * @return int
	 */
	public static function get_high ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:448: characters 3-19
		return $this1->high;
	}

	/**
	 * @param ___Int64 $this
	 * 
	 * @return int
	 */
	public static function get_low ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:456: characters 3-18
		return $this1->low;
	}

	/**
	 * @param ___Int64 $a
	 * @param ___Int64 $b
	 * 
	 * @return bool
	 */
	public static function gt ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:378: characters 10-23
		$v = (($a->high - $b->high) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		if ($v === 0) {
			$v = Int32_Impl_::ucompare($a->low, $b->low);
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:378: characters 3-27
		return (($a->high < 0 ? ($b->high < 0 ? $v : -1) : ($b->high >= 0 ? $v : 1))) > 0;
	}

	/**
	 * @param ___Int64 $a
	 * @param int $b
	 * 
	 * @return bool
	 */
	public static function gtInt ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:381: characters 16-17
		$b_high = $b >> 31;
		$b_low = $b;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:381: characters 10-18
		$v = (($a->high - $b_high) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		if ($v === 0) {
			$v = Int32_Impl_::ucompare($a->low, $b_low);
		}
		return (($a->high < 0 ? ($b_high < 0 ? $v : -1) : ($b_high >= 0 ? $v : 1))) > 0;
	}

	/**
	 * @param ___Int64 $a
	 * @param ___Int64 $b
	 * 
	 * @return bool
	 */
	public static function gte ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:387: characters 10-23
		$v = (($a->high - $b->high) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		if ($v === 0) {
			$v = Int32_Impl_::ucompare($a->low, $b->low);
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:387: characters 3-28
		return (($a->high < 0 ? ($b->high < 0 ? $v : -1) : ($b->high >= 0 ? $v : 1))) >= 0;
	}

	/**
	 * @param ___Int64 $a
	 * @param int $b
	 * 
	 * @return bool
	 */
	public static function gteInt ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:390: characters 17-18
		$b_high = $b >> 31;
		$b_low = $b;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:390: characters 10-19
		$v = (($a->high - $b_high) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		if ($v === 0) {
			$v = Int32_Impl_::ucompare($a->low, $b_low);
		}
		return (($a->high < 0 ? ($b_high < 0 ? $v : -1) : ($b_high >= 0 ? $v : 1))) >= 0;
	}

	/**
	 * @param int $a
	 * @param ___Int64 $b
	 * 
	 * @return ___Int64
	 */
	public static function intDiv ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:327: characters 14-15
		$this1 = new ___Int64($a >> 31, $a);
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:327: characters 10-27
		$x = Int64_Impl_::divMod($this1, $b)->quotient;
		if ($x->high !== ((($x->low >> 31) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits)) {
			throw Exception::thrown("Overflow");
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:327: characters 3-27
		$x1 = $x->low;
		$this1 = new ___Int64($x1 >> 31, $x1);
		return $this1;
	}

	/**
	 * @param int $a
	 * @param ___Int64 $b
	 * 
	 * @return bool
	 */
	public static function intGt ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:384: characters 13-14
		$a_high = $a >> 31;
		$a_low = $a;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:384: characters 10-18
		$v = (($a_high - $b->high) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		if ($v === 0) {
			$v = Int32_Impl_::ucompare($a_low, $b->low);
		}
		return (($a_high < 0 ? ($b->high < 0 ? $v : -1) : ($b->high >= 0 ? $v : 1))) > 0;
	}

	/**
	 * @param int $a
	 * @param ___Int64 $b
	 * 
	 * @return bool
	 */
	public static function intGte ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:393: characters 14-15
		$a_high = $a >> 31;
		$a_low = $a;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:393: characters 10-19
		$v = (($a_high - $b->high) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		if ($v === 0) {
			$v = Int32_Impl_::ucompare($a_low, $b->low);
		}
		return (($a_high < 0 ? ($b->high < 0 ? $v : -1) : ($b->high >= 0 ? $v : 1))) >= 0;
	}

	/**
	 * @param int $a
	 * @param ___Int64 $b
	 * 
	 * @return bool
	 */
	public static function intLt ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:366: characters 13-14
		$a_high = $a >> 31;
		$a_low = $a;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:366: characters 10-18
		$v = (($a_high - $b->high) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		if ($v === 0) {
			$v = Int32_Impl_::ucompare($a_low, $b->low);
		}
		return (($a_high < 0 ? ($b->high < 0 ? $v : -1) : ($b->high >= 0 ? $v : 1))) < 0;
	}

	/**
	 * @param int $a
	 * @param ___Int64 $b
	 * 
	 * @return bool
	 */
	public static function intLte ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:375: characters 14-15
		$a_high = $a >> 31;
		$a_low = $a;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:375: characters 10-19
		$v = (($a_high - $b->high) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		if ($v === 0) {
			$v = Int32_Impl_::ucompare($a_low, $b->low);
		}
		return (($a_high < 0 ? ($b->high < 0 ? $v : -1) : ($b->high >= 0 ? $v : 1))) <= 0;
	}

	/**
	 * @param int $a
	 * @param ___Int64 $b
	 * 
	 * @return ___Int64
	 */
	public static function intMod ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:339: characters 14-15
		$this1 = new ___Int64($a >> 31, $a);
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:339: characters 10-27
		$x = Int64_Impl_::divMod($this1, $b)->modulus;
		if ($x->high !== ((($x->low >> 31) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits)) {
			throw Exception::thrown("Overflow");
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:339: characters 3-27
		$x1 = $x->low;
		$this1 = new ___Int64($x1 >> 31, $x1);
		return $this1;
	}

	/**
	 * @param int $a
	 * @param ___Int64 $b
	 * 
	 * @return ___Int64
	 */
	public static function intSub ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:286: characters 14-15
		$a_high = $a >> 31;
		$a_low = $a;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:286: characters 10-19
		$high = (($a_high - $b->high) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		$low = (($a_low - $b->low) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		if (Int32_Impl_::ucompare($a_low, $b->low) < 0) {
			$ret = $high--;
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:278: characters 4-8
			$high = ($high << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:286: characters 10-19
		$this1 = new ___Int64($high, $low);
		return $this1;
	}

	/**
	 * @param mixed $val
	 * 
	 * @return bool
	 */
	public static function is ($val) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:71: characters 3-22
		return ($val instanceof ___Int64);
	}

	/**
	 * Returns whether the value `val` is of type `haxe.Int64`
	 * 
	 * @param mixed $val
	 * 
	 * @return bool
	 */
	public static function isInt64 ($val) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:78: characters 3-36
		return ($val instanceof ___Int64);
	}

	/**
	 * Returns `true` if `x` is less than zero.
	 * 
	 * @param ___Int64 $x
	 * 
	 * @return bool
	 */
	public static function isNeg ($x) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:98: characters 3-20
		return $x->high < 0;
	}

	/**
	 * Returns `true` if `x` is exactly zero.
	 * 
	 * @param ___Int64 $x
	 * 
	 * @return bool
	 */
	public static function isZero ($x) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:104: characters 10-16
		$b_high = 0;
		$b_low = 0;
		if ($x->high === $b_high) {
			return $x->low === $b_low;
		} else {
			return false;
		}
	}

	/**
	 * @param ___Int64 $a
	 * @param ___Int64 $b
	 * 
	 * @return bool
	 */
	public static function lt ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:360: characters 10-23
		$v = (($a->high - $b->high) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		if ($v === 0) {
			$v = Int32_Impl_::ucompare($a->low, $b->low);
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:360: characters 3-27
		return (($a->high < 0 ? ($b->high < 0 ? $v : -1) : ($b->high >= 0 ? $v : 1))) < 0;
	}

	/**
	 * @param ___Int64 $a
	 * @param int $b
	 * 
	 * @return bool
	 */
	public static function ltInt ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:363: characters 16-17
		$b_high = $b >> 31;
		$b_low = $b;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:363: characters 10-18
		$v = (($a->high - $b_high) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		if ($v === 0) {
			$v = Int32_Impl_::ucompare($a->low, $b_low);
		}
		return (($a->high < 0 ? ($b_high < 0 ? $v : -1) : ($b_high >= 0 ? $v : 1))) < 0;
	}

	/**
	 * @param ___Int64 $a
	 * @param ___Int64 $b
	 * 
	 * @return bool
	 */
	public static function lte ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:369: characters 10-23
		$v = (($a->high - $b->high) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		if ($v === 0) {
			$v = Int32_Impl_::ucompare($a->low, $b->low);
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:369: characters 3-28
		return (($a->high < 0 ? ($b->high < 0 ? $v : -1) : ($b->high >= 0 ? $v : 1))) <= 0;
	}

	/**
	 * @param ___Int64 $a
	 * @param int $b
	 * 
	 * @return bool
	 */
	public static function lteInt ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:372: characters 17-18
		$b_high = $b >> 31;
		$b_low = $b;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:372: characters 10-19
		$v = (($a->high - $b_high) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		if ($v === 0) {
			$v = Int32_Impl_::ucompare($a->low, $b_low);
		}
		return (($a->high < 0 ? ($b_high < 0 ? $v : -1) : ($b_high >= 0 ? $v : 1))) <= 0;
	}

	/**
	 * Construct an Int64 from two 32-bit words `high` and `low`.
	 * 
	 * @param int $high
	 * @param int $low
	 * 
	 * @return ___Int64
	 */
	public static function make ($high, $low) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:49: characters 10-43
		$this1 = new ___Int64($high, $low);
		return $this1;
	}

	/**
	 * Returns the modulus of `a` divided by `b`.
	 * 
	 * @param ___Int64 $a
	 * @param ___Int64 $b
	 * 
	 * @return ___Int64
	 */
	public static function mod ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:333: characters 3-30
		return Int64_Impl_::divMod($a, $b)->modulus;
	}

	/**
	 * @param ___Int64 $a
	 * @param int $b
	 * 
	 * @return ___Int64
	 */
	public static function modInt ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:336: characters 17-18
		$this1 = new ___Int64($b >> 31, $b);
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:336: characters 10-27
		$x = Int64_Impl_::divMod($a, $this1)->modulus;
		if ($x->high !== ((($x->low >> 31) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits)) {
			throw Exception::thrown("Overflow");
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:336: characters 3-27
		$x1 = $x->low;
		$this1 = new ___Int64($x1 >> 31, $x1);
		return $this1;
	}

	/**
	 * Returns the product of `a` and `b`.
	 * 
	 * @param ___Int64 $a
	 * @param ___Int64 $b
	 * 
	 * @return ___Int64
	 */
	public static function mul ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:293: characters 3-21
		$mask = 65535;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:294: characters 3-44
		$al = $a->low & $mask;
		$ah = Boot::shiftRightUnsigned($a->low, 16);
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:295: characters 3-44
		$bl = $b->low & $mask;
		$bh = Boot::shiftRightUnsigned($b->low, 16);
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:296: characters 3-21
		$p00 = Int32_Impl_::mul($al, $bl);
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:297: characters 3-21
		$p10 = Int32_Impl_::mul($ah, $bl);
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:298: characters 3-21
		$p01 = Int32_Impl_::mul($al, $bh);
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:299: characters 3-21
		$p11 = Int32_Impl_::mul($ah, $bh);
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:300: characters 3-17
		$low = $p00;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:301: characters 3-48
		$high = ((((($p11 + (Boot::shiftRightUnsigned($p01, 16))) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits) + (Boot::shiftRightUnsigned($p10, 16))) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:302: characters 3-13
		$p01 = ($p01 << 16 << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:303: characters 3-13
		$low = (($low + $p01) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:304: lines 304-305
		if (Int32_Impl_::ucompare($low, $p01) < 0) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:305: characters 4-10
			$ret = $high++;
			$high = ($high << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:306: characters 3-13
		$p10 = ($p10 << 16 << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:307: characters 3-13
		$low = (($low + $p10) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:308: lines 308-309
		if (Int32_Impl_::ucompare($low, $p10) < 0) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:309: characters 4-10
			$ret = $high++;
			$high = ($high << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:310: characters 3-42
		$high = (($high + (((Int32_Impl_::mul($a->low, $b->high) + Int32_Impl_::mul($a->high, $b->low)) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits)) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:311: characters 10-25
		$this1 = new ___Int64($high, $low);
		return $this1;
	}

	/**
	 * @param ___Int64 $a
	 * @param int $b
	 * 
	 * @return ___Int64
	 */
	public static function mulInt ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:315: characters 17-18
		$b_high = $b >> 31;
		$b_low = $b;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:315: characters 10-19
		$mask = 65535;
		$al = $a->low & $mask;
		$ah = Boot::shiftRightUnsigned($a->low, 16);
		$bl = $b_low & $mask;
		$bh = Boot::shiftRightUnsigned($b_low, 16);
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
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:315: characters 10-19
		if (Int32_Impl_::ucompare($low, $p01) < 0) {
			$ret = $high++;
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:305: characters 4-8
			$high = ($high << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:306: characters 3-6
		$p10 = ($p10 << 16 << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:307: characters 3-6
		$low = (($low + $p10) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:315: characters 10-19
		if (Int32_Impl_::ucompare($low, $p10) < 0) {
			$ret = $high++;
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:309: characters 4-8
			$high = ($high << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:315: characters 10-19
		$high = (($high + (((Int32_Impl_::mul($a->low, $b_high) + Int32_Impl_::mul($a->high, $b_low)) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits)) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		$this1 = new ___Int64($high, $low);
		return $this1;
	}

	/**
	 * Returns the negative of `x`.
	 * 
	 * @param ___Int64 $x
	 * 
	 * @return ___Int64
	 */
	public static function neg ($x) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:222: characters 3-22
		$high = (~$x->high << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:223: characters 3-20
		$low = ((~$x->low + 1) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:224: lines 224-225
		if ($low === 0) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:225: characters 4-10
			$ret = $high++;
			$high = ($high << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:226: characters 10-25
		$this1 = new ___Int64($high, $low);
		return $this1;
	}

	/**
	 * Returns `true` if `a` is not equal to `b`.
	 * 
	 * @param ___Int64 $a
	 * @param ___Int64 $b
	 * 
	 * @return bool
	 */
	public static function neq ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:354: characters 10-44
		if ($a->high === $b->high) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:354: characters 30-44
			return $a->low !== $b->low;
		} else {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:354: characters 10-44
			return true;
		}
	}

	/**
	 * @param ___Int64 $a
	 * @param int $b
	 * 
	 * @return bool
	 */
	public static function neqInt ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:357: characters 17-18
		$b_high = $b >> 31;
		$b_low = $b;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:357: characters 10-19
		if ($a->high === $b_high) {
			return $a->low !== $b_low;
		} else {
			return true;
		}
	}

	/**
	 * Returns an Int64 with the value of the Int `x`.
	 * `x` is sign-extended to fill 64 bits.
	 * 
	 * @param int $x
	 * 
	 * @return ___Int64
	 */
	public static function ofInt ($x) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:56: characters 69-85
		$this1 = new ___Int64($x >> 31, $x);
		return $this1;
	}

	/**
	 * Returns the bitwise OR of `a` and `b`.
	 * 
	 * @param ___Int64 $a
	 * @param ___Int64 $b
	 * 
	 * @return ___Int64
	 */
	public static function or ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:411: characters 10-46
		$this1 = new ___Int64((($a->high | $b->high) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits, (($a->low | $b->low) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits);
		return $this1;
	}

	/**
	 * @param string $sParam
	 * 
	 * @return ___Int64
	 */
	public static function parseString ($sParam) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:160: characters 3-41
		return Int64Helper::parseString($sParam);
	}

	/**
	 * @param ___Int64 $this
	 * 
	 * @return ___Int64
	 */
	public static function postDecrement ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:252: characters 3-18
		$ret = $this1;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:253: characters 3-17
		$this2 = new ___Int64($this1->high, $this1->low);
		$this1 = $this2;
		if ($this1->low === 0) {
			$ret1 = $this1->high--;
			$this1->high = ($this1->high << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		}
		$ret1 = $this1->low--;
		$this1->low = ($this1->low << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:254: characters 3-13
		return $ret;
	}

	/**
	 * @param ___Int64 $this
	 * 
	 * @return ___Int64
	 */
	public static function postIncrement ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:238: characters 3-18
		$ret = $this1;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:239: characters 3-17
		$this2 = new ___Int64($this1->high, $this1->low);
		$this1 = $this2;
		$ret1 = $this1->low++;
		$this1->low = ($this1->low << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		if ($this1->low === 0) {
			$ret1 = $this1->high++;
			$this1->high = ($this1->high << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:240: characters 3-13
		return $ret;
	}

	/**
	 * @param ___Int64 $this
	 * 
	 * @return ___Int64
	 */
	public static function preDecrement ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:244: characters 10-16
		$this2 = new ___Int64($this1->high, $this1->low);
		$this1 = $this2;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:245: lines 245-246
		if ($this1->low === 0) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:246: characters 4-15
			$ret = $this1->high--;
			$this1->high = ($this1->high << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:247: characters 3-13
		$ret = $this1->low--;
		$this1->low = ($this1->low << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:248: characters 3-19
		return $this1;
	}

	/**
	 * @param ___Int64 $this
	 * 
	 * @return ___Int64
	 */
	public static function preIncrement ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:230: characters 10-16
		$this2 = new ___Int64($this1->high, $this1->low);
		$this1 = $this2;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:231: characters 3-13
		$ret = $this1->low++;
		$this1->low = ($this1->low << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:232: lines 232-233
		if ($this1->low === 0) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:233: characters 4-15
			$ret = $this1->high++;
			$this1->high = ($this1->high << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:234: characters 3-19
		return $this1;
	}

	/**
	 * @param ___Int64 $this
	 * @param int $x
	 * 
	 * @return int
	 */
	public static function set_high ($this1, $x) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:451: characters 3-23
		return $this1->high = $x;
	}

	/**
	 * @param ___Int64 $this
	 * @param int $x
	 * 
	 * @return int
	 */
	public static function set_low ($this1, $x) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:459: characters 3-22
		return $this1->low = $x;
	}

	/**
	 * Returns `a` left-shifted by `b` bits.
	 * 
	 * @param ___Int64 $a
	 * @param int $b
	 * 
	 * @return ___Int64
	 */
	public static function shl ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:423: characters 3-10
		$b &= 63;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:424: characters 10-134
		if ($b === 0) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:424: characters 22-30
			$this1 = new ___Int64($a->high, $a->low);
			return $this1;
		} else if ($b < 32) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:424: characters 48-102
			$this1 = new ___Int64((((($a->high << $b << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits) | Boot::shiftRightUnsigned($a->low, (32 - $b))) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits, ($a->low << $b << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits);
			return $this1;
		} else {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:424: characters 108-134
			$this1 = new ___Int64(($a->low << ($b - 32) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits, 0);
			return $this1;
		}
	}

	/**
	 * Returns `a` right-shifted by `b` bits in signed mode.
	 * `a` is sign-extended.
	 * 
	 * @param ___Int64 $a
	 * @param int $b
	 * 
	 * @return ___Int64
	 */
	public static function shr ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:432: characters 3-10
		$b &= 63;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:433: characters 10-148
		if ($b === 0) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:433: characters 22-30
			$this1 = new ___Int64($a->high, $a->low);
			return $this1;
		} else if ($b < 32) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:433: characters 48-103
			$this1 = new ___Int64((($a->high >> $b) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits, (((($a->high << (32 - $b) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits) | Boot::shiftRightUnsigned($a->low, $b)) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits);
			return $this1;
		} else {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:433: characters 110-148
			$this1 = new ___Int64((($a->high >> 31) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits, (($a->high >> ($b - 32)) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits);
			return $this1;
		}
	}

	/**
	 * Returns `a` minus `b`.
	 * 
	 * @param ___Int64 $a
	 * @param ___Int64 $b
	 * 
	 * @return ___Int64
	 */
	public static function sub ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:275: characters 3-30
		$high = (($a->high - $b->high) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:276: characters 3-27
		$low = (($a->low - $b->low) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:277: lines 277-278
		if (Int32_Impl_::ucompare($a->low, $b->low) < 0) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:278: characters 4-10
			$ret = $high--;
			$high = ($high << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:279: characters 10-25
		$this1 = new ___Int64($high, $low);
		return $this1;
	}

	/**
	 * @param ___Int64 $a
	 * @param int $b
	 * 
	 * @return ___Int64
	 */
	public static function subInt ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:283: characters 17-18
		$b_high = $b >> 31;
		$b_low = $b;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:283: characters 10-19
		$high = (($a->high - $b_high) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		$low = (($a->low - $b_low) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		if (Int32_Impl_::ucompare($a->low, $b_low) < 0) {
			$ret = $high--;
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:278: characters 4-8
			$high = ($high << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:283: characters 10-19
		$this1 = new ___Int64($high, $low);
		return $this1;
	}

	/**
	 * Returns an Int with the value of the Int64 `x`.
	 * Throws an exception  if `x` cannot be represented in 32 bits.
	 * 
	 * @param ___Int64 $x
	 * 
	 * @return int
	 */
	public static function toInt ($x) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:63: lines 63-64
		if ($x->high !== ((($x->low >> 31) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits)) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:64: characters 4-9
			throw Exception::thrown("Overflow");
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:66: characters 3-15
		return $x->low;
	}

	/**
	 * Returns a signed decimal `String` representation of `x`.
	 * 
	 * @param ___Int64 $x
	 * 
	 * @return string
	 */
	public static function toStr ($x) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:131: characters 3-22
		return Int64_Impl_::toString($x);
	}

	/**
	 * @param ___Int64 $this
	 * 
	 * @return string
	 */
	public static function toString ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:134: characters 3-27
		$i = $this1;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:135: characters 7-13
		$b_high = 0;
		$b_low = 0;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:135: lines 135-136
		if (($i->high === $b_high) && ($i->low === $b_low)) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:136: characters 4-14
			return "0";
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:137: characters 3-16
		$str = "";
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:138: characters 3-19
		$neg = false;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:139: lines 139-142
		if ($i->high < 0) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:140: characters 4-7
			$neg = true;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:143: characters 3-22
		$this1 = new ___Int64(0, 10);
		$ten = $this1;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:144: lines 144-153
		while (true) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:144: characters 10-16
			$b_high = 0;
			$b_low = 0;
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:144: lines 144-153
			if (!(($i->high !== $b_high) || ($i->low !== $b_low))) {
				break;
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:145: characters 4-26
			$r = Int64_Impl_::divMod($i, $ten);
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:146: lines 146-152
			if ($r->modulus->high < 0) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:147: characters 11-31
				$x = $r->modulus;
				$high = (~$x->high << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
				$low = ((~$x->low + 1) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
				if ($low === 0) {
					$ret = $high++;
					#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:225: characters 4-8
					$high = ($high << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
				}
				#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:147: characters 11-31
				$this_high = $high;
				$this_low = $low;
				#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:147: characters 5-8
				$str = ($this_low??'null') . ($str??'null');
				#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:148: characters 9-30
				$x1 = $r->quotient;
				$high1 = (~$x1->high << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
				$low1 = ((~$x1->low + 1) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
				if ($low1 === 0) {
					$ret1 = $high1++;
					#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:225: characters 4-8
					$high1 = ($high1 << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
				}
				#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:148: characters 9-30
				$this1 = new ___Int64($high1, $low1);
				$i = $this1;
			} else {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:150: characters 5-8
				$str = ($r->modulus->low??'null') . ($str??'null');
				#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:151: characters 5-6
				$i = $r->quotient;
			}
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:154: lines 154-155
		if ($neg) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:155: characters 4-7
			$str = "-" . ($str??'null');
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:156: characters 3-13
		return $str;
	}

	/**
	 * Compares `a` and `b` in unsigned mode.
	 * Returns a negative value if `a < b`, positive if `a > b`,
	 * or 0 if `a == b`.
	 * 
	 * @param ___Int64 $a
	 * @param ___Int64 $b
	 * 
	 * @return int
	 */
	public static function ucompare ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:123: characters 3-42
		$v = Int32_Impl_::ucompare($a->high, $b->high);
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:124: characters 10-57
		if ($v !== 0) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:124: characters 22-23
			return $v;
		} else {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:124: characters 29-57
			return Int32_Impl_::ucompare($a->low, $b->low);
		}
	}

	/**
	 * Returns `a` right-shifted by `b` bits in unsigned mode.
	 * `a` is padded with zeroes.
	 * 
	 * @param ___Int64 $a
	 * @param int $b
	 * 
	 * @return ___Int64
	 */
	public static function ushr ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:441: characters 3-10
		$b &= 63;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:442: characters 10-139
		if ($b === 0) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:442: characters 22-30
			$this1 = new ___Int64($a->high, $a->low);
			return $this1;
		} else if ($b < 32) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:442: characters 48-104
			$this1 = new ___Int64(Boot::shiftRightUnsigned($a->high, $b), (((($a->high << (32 - $b) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits) | Boot::shiftRightUnsigned($a->low, $b)) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits);
			return $this1;
		} else {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:442: characters 111-139
			$this1 = new ___Int64(0, Boot::shiftRightUnsigned($a->high, ($b - 32)));
			return $this1;
		}
	}

	/**
	 * Returns the bitwise XOR of `a` and `b`.
	 * 
	 * @param ___Int64 $a
	 * @param ___Int64 $b
	 * 
	 * @return ___Int64
	 */
	public static function xor ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Int64.hx:417: characters 10-46
		$this1 = new ___Int64((($a->high ^ $b->high) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits, (($a->low ^ $b->low) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits);
		return $this1;
	}
}

class _HxAnon_Int64_Impl_0 extends HxAnon {
	function __construct($quotient, $modulus) {
		$this->quotient = $quotient;
		$this->modulus = $modulus;
	}
}

Boot::registerClass(Int64_Impl_::class, 'haxe._Int64.Int64_Impl_');
Boot::registerGetters('helder\\std\\haxe\\_Int64\\Int64_Impl_', [
	'low' => true,
	'high' => true
]);
