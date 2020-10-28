import {HaxeError} from "../js/Boot"
import {Int64Helper} from "./Int64Helper"
import {Int32_Impl_} from "./Int32"
import {Register} from "../genes/Register"

export const Int64_Impl_ = Register.global("$hxClasses")["haxe._Int64.Int64_Impl_"] = 
class Int64_Impl_ {
	static _new(x) {
		var this1 = x;
		return this1;
	}
	
	/**
	Makes a copy of `this` Int64.
	*/
	static copy(this1) {
		var this2 = new ___Int64(this1.high, this1.low);
		return this2;
	}
	
	/**
	Construct an Int64 from two 32-bit words `high` and `low`.
	*/
	static make(high, low) {
		var this1 = new ___Int64(high, low);
		return this1;
	}
	
	/**
	Returns an Int64 with the value of the Int `x`.
	`x` is sign-extended to fill 64 bits.
	*/
	static ofInt(x) {
		var this1 = new ___Int64(x >> 31, x);
		return this1;
	}
	
	/**
	Returns an Int with the value of the Int64 `x`.
	Throws an exception  if `x` cannot be represented in 32 bits.
	*/
	static toInt(x) {
		if (x.high != x.low >> 31) {
			throw new HaxeError("Overflow");
		};
		return x.low;
	}
	
	/**
	Returns whether the value `val` is of type `haxe.Int64`
	*/
	static is(val) {
		return ((val) instanceof ___Int64);
	}
	
	/**
	Returns the high 32-bit word of `x`.
	*/
	static getHigh(x) {
		return x.high;
	}
	
	/**
	Returns the low 32-bit word of `x`.
	*/
	static getLow(x) {
		return x.low;
	}
	
	/**
	Returns `true` if `x` is less than zero.
	*/
	static isNeg(x) {
		return x.high < 0;
	}
	
	/**
	Returns `true` if `x` is exactly zero.
	*/
	static isZero(x) {
		var b_high = 0;
		var b_low = 0;
		if (x.high == b_high) {
			return x.low == b_low;
		} else {
			return false;
		};
	}
	
	/**
	Compares `a` and `b` in signed mode.
	Returns a negative value if `a < b`, positive if `a > b`,
	or 0 if `a == b`.
	*/
	static compare(a, b) {
		var v = a.high - b.high | 0;
		v = (v != 0) ? v : Int32_Impl_.ucompare(a.low, b.low);
		if (a.high < 0) {
			if (b.high < 0) {
				return v;
			} else {
				return -1;
			};
		} else if (b.high >= 0) {
			return v;
		} else {
			return 1;
		};
	}
	
	/**
	Compares `a` and `b` in unsigned mode.
	Returns a negative value if `a < b`, positive if `a > b`,
	or 0 if `a == b`.
	*/
	static ucompare(a, b) {
		var v = Int32_Impl_.ucompare(a.high, b.high);
		if (v != 0) {
			return v;
		} else {
			return Int32_Impl_.ucompare(a.low, b.low);
		};
	}
	
	/**
	Returns a signed decimal `String` representation of `x`.
	*/
	static toStr(x) {
		return Int64_Impl_.toString(x);
	}
	static toString(this1) {
		var i = this1;
		var b_high = 0;
		var b_low = 0;
		if (i.high == b_high && i.low == b_low) {
			return "0";
		};
		var str = "";
		var neg = false;
		if (i.high < 0) {
			neg = true;
		};
		var this2 = new ___Int64(0, 10);
		var ten = this2;
		while (true) {
			var b_high1 = 0;
			var b_low1 = 0;
			if (!(i.high != b_high1 || i.low != b_low1)) {
				break;
			};
			var r = Int64_Impl_.divMod(i, ten);
			if (r.modulus.high < 0) {
				var x = r.modulus;
				var high = ~x.high;
				var low = ~x.low + 1 | 0;
				if (low == 0) {
					var ret = high++;
					high = high | 0;
				};
				var this_high = high;
				var this_low = low;
				str = this_low + str;
				var x1 = r.quotient;
				var high1 = ~x1.high;
				var low1 = ~x1.low + 1 | 0;
				if (low1 == 0) {
					var ret1 = high1++;
					high1 = high1 | 0;
				};
				var this3 = new ___Int64(high1, low1);
				i = this3;
			} else {
				str = r.modulus.low + str;
				i = r.quotient;
			};
		};
		if (neg) {
			str = "-" + str;
		};
		return str;
	}
	static parseString(sParam) {
		return Int64Helper.parseString(sParam);
	}
	static fromFloat(f) {
		return Int64Helper.fromFloat(f);
	}
	
	/**
	Performs signed integer divison of `dividend` by `divisor`.
	Returns `{ quotient : Int64, modulus : Int64 }`.
	*/
	static divMod(dividend, divisor) {
		if (divisor.high == 0) {
			switch (divisor.low) {
				case 0:
					throw new HaxeError("divide by zero");
					break
				case 1:
					var this1 = new ___Int64(dividend.high, dividend.low);
					var this2 = new ___Int64(0, 0);
					return {"quotient": this1, "modulus": this2};
					break
				
			};
		};
		var divSign = dividend.high < 0 != divisor.high < 0;
		var modulus;
		if (dividend.high < 0) {
			var high = ~dividend.high;
			var low = ~dividend.low + 1 | 0;
			if (low == 0) {
				var ret = high++;
				high = high | 0;
			};
			var this3 = new ___Int64(high, low);
			modulus = this3;
		} else {
			var this4 = new ___Int64(dividend.high, dividend.low);
			modulus = this4;
		};
		if (divisor.high < 0) {
			var high1 = ~divisor.high;
			var low1 = ~divisor.low + 1 | 0;
			if (low1 == 0) {
				var ret1 = high1++;
				high1 = high1 | 0;
			};
			var this5 = new ___Int64(high1, low1);
			divisor = this5;
		} else {
			divisor = divisor;
		};
		var this6 = new ___Int64(0, 0);
		var quotient = this6;
		var this7 = new ___Int64(0, 1);
		var mask = this7;
		while (!(divisor.high < 0)) {
			var v = Int32_Impl_.ucompare(divisor.high, modulus.high);
			var cmp = (v != 0) ? v : Int32_Impl_.ucompare(divisor.low, modulus.low);
			var b = 1;
			b &= 63;
			if (b == 0) {
				var this8 = new ___Int64(divisor.high, divisor.low);
				divisor = this8;
			} else if (b < 32) {
				var this9 = new ___Int64(divisor.high << b | divisor.low >>> 32 - b, divisor.low << b);
				divisor = this9;
			} else {
				var this10 = new ___Int64(divisor.low << b - 32, 0);
				divisor = this10;
			};
			var b1 = 1;
			b1 &= 63;
			if (b1 == 0) {
				var this11 = new ___Int64(mask.high, mask.low);
				mask = this11;
			} else if (b1 < 32) {
				var this12 = new ___Int64(mask.high << b1 | mask.low >>> 32 - b1, mask.low << b1);
				mask = this12;
			} else {
				var this13 = new ___Int64(mask.low << b1 - 32, 0);
				mask = this13;
			};
			if (cmp >= 0) {
				break;
			};
		};
		while (true) {
			var b_high = 0;
			var b_low = 0;
			if (!(mask.high != b_high || mask.low != b_low)) {
				break;
			};
			var v1 = Int32_Impl_.ucompare(modulus.high, divisor.high);
			if (((v1 != 0) ? v1 : Int32_Impl_.ucompare(modulus.low, divisor.low)) >= 0) {
				var this14 = new ___Int64(quotient.high | mask.high, quotient.low | mask.low);
				quotient = this14;
				var high2 = modulus.high - divisor.high | 0;
				var low2 = modulus.low - divisor.low | 0;
				if (Int32_Impl_.ucompare(modulus.low, divisor.low) < 0) {
					var ret2 = high2--;
					high2 = high2 | 0;
				};
				var this15 = new ___Int64(high2, low2);
				modulus = this15;
			};
			var b2 = 1;
			b2 &= 63;
			if (b2 == 0) {
				var this16 = new ___Int64(mask.high, mask.low);
				mask = this16;
			} else if (b2 < 32) {
				var this17 = new ___Int64(mask.high >>> b2, mask.high << 32 - b2 | mask.low >>> b2);
				mask = this17;
			} else {
				var this18 = new ___Int64(0, mask.high >>> b2 - 32);
				mask = this18;
			};
			var b3 = 1;
			b3 &= 63;
			if (b3 == 0) {
				var this19 = new ___Int64(divisor.high, divisor.low);
				divisor = this19;
			} else if (b3 < 32) {
				var this20 = new ___Int64(divisor.high >>> b3, divisor.high << 32 - b3 | divisor.low >>> b3);
				divisor = this20;
			} else {
				var this21 = new ___Int64(0, divisor.high >>> b3 - 32);
				divisor = this21;
			};
		};
		if (divSign) {
			var high3 = ~quotient.high;
			var low3 = ~quotient.low + 1 | 0;
			if (low3 == 0) {
				var ret3 = high3++;
				high3 = high3 | 0;
			};
			var this22 = new ___Int64(high3, low3);
			quotient = this22;
		};
		if (dividend.high < 0) {
			var high4 = ~modulus.high;
			var low4 = ~modulus.low + 1 | 0;
			if (low4 == 0) {
				var ret4 = high4++;
				high4 = high4 | 0;
			};
			var this23 = new ___Int64(high4, low4);
			modulus = this23;
		};
		return {"quotient": quotient, "modulus": modulus};
	}
	
	/**
	Returns the negative of `x`.
	*/
	static neg(x) {
		var high = ~x.high;
		var low = ~x.low + 1 | 0;
		if (low == 0) {
			var ret = high++;
			high = high | 0;
		};
		var this1 = new ___Int64(high, low);
		return this1;
	}
	static preIncrement(this1) {
		var this2 = new ___Int64(this1.high, this1.low);
		this1 = this2;
		var ret = this1.low++;
		this1.low = this1.low | 0;
		if (this1.low == 0) {
			var ret1 = this1.high++;
			this1.high = this1.high | 0;
		};
		return this1;
	}
	static postIncrement(this1) {
		var ret = this1;
		var this2 = new ___Int64(this1.high, this1.low);
		this1 = this2;
		var ret1 = this1.low++;
		this1.low = this1.low | 0;
		if (this1.low == 0) {
			var ret2 = this1.high++;
			this1.high = this1.high | 0;
		};
		return ret;
	}
	static preDecrement(this1) {
		var this2 = new ___Int64(this1.high, this1.low);
		this1 = this2;
		if (this1.low == 0) {
			var ret = this1.high--;
			this1.high = this1.high | 0;
		};
		var ret1 = this1.low--;
		this1.low = this1.low | 0;
		return this1;
	}
	static postDecrement(this1) {
		var ret = this1;
		var this2 = new ___Int64(this1.high, this1.low);
		this1 = this2;
		if (this1.low == 0) {
			var ret1 = this1.high--;
			this1.high = this1.high | 0;
		};
		var ret2 = this1.low--;
		this1.low = this1.low | 0;
		return ret;
	}
	
	/**
	Returns the sum of `a` and `b`.
	*/
	static add(a, b) {
		var high = a.high + b.high | 0;
		var low = a.low + b.low | 0;
		if (Int32_Impl_.ucompare(low, a.low) < 0) {
			var ret = high++;
			high = high | 0;
		};
		var this1 = new ___Int64(high, low);
		return this1;
	}
	static addInt(a, b) {
		var b_high = b >> 31;
		var b_low = b;
		var high = a.high + b_high | 0;
		var low = a.low + b_low | 0;
		if (Int32_Impl_.ucompare(low, a.low) < 0) {
			var ret = high++;
			high = high | 0;
		};
		var this1 = new ___Int64(high, low);
		return this1;
	}
	
	/**
	Returns `a` minus `b`.
	*/
	static sub(a, b) {
		var high = a.high - b.high | 0;
		var low = a.low - b.low | 0;
		if (Int32_Impl_.ucompare(a.low, b.low) < 0) {
			var ret = high--;
			high = high | 0;
		};
		var this1 = new ___Int64(high, low);
		return this1;
	}
	static subInt(a, b) {
		var b_high = b >> 31;
		var b_low = b;
		var high = a.high - b_high | 0;
		var low = a.low - b_low | 0;
		if (Int32_Impl_.ucompare(a.low, b_low) < 0) {
			var ret = high--;
			high = high | 0;
		};
		var this1 = new ___Int64(high, low);
		return this1;
	}
	static intSub(a, b) {
		var a_high = a >> 31;
		var a_low = a;
		var high = a_high - b.high | 0;
		var low = a_low - b.low | 0;
		if (Int32_Impl_.ucompare(a_low, b.low) < 0) {
			var ret = high--;
			high = high | 0;
		};
		var this1 = new ___Int64(high, low);
		return this1;
	}
	
	/**
	Returns the product of `a` and `b`.
	*/
	static mul(a, b) {
		var mask = 65535;
		var al = a.low & mask;
		var ah = a.low >>> 16;
		var bl = b.low & mask;
		var bh = b.low >>> 16;
		var p00 = Int32_Impl_._mul(al, bl);
		var p10 = Int32_Impl_._mul(ah, bl);
		var p01 = Int32_Impl_._mul(al, bh);
		var p11 = Int32_Impl_._mul(ah, bh);
		var low = p00;
		var high = (p11 + (p01 >>> 16) | 0) + (p10 >>> 16) | 0;
		p01 = p01 << 16;
		low = low + p01 | 0;
		if (Int32_Impl_.ucompare(low, p01) < 0) {
			var ret = high++;
			high = high | 0;
		};
		p10 = p10 << 16;
		low = low + p10 | 0;
		if (Int32_Impl_.ucompare(low, p10) < 0) {
			var ret1 = high++;
			high = high | 0;
		};
		high = high + (Int32_Impl_._mul(a.low, b.high) + Int32_Impl_._mul(a.high, b.low) | 0) | 0;
		var this1 = new ___Int64(high, low);
		return this1;
	}
	static mulInt(a, b) {
		var b_high = b >> 31;
		var b_low = b;
		var mask = 65535;
		var al = a.low & mask;
		var ah = a.low >>> 16;
		var bl = b_low & mask;
		var bh = b_low >>> 16;
		var p00 = Int32_Impl_._mul(al, bl);
		var p10 = Int32_Impl_._mul(ah, bl);
		var p01 = Int32_Impl_._mul(al, bh);
		var p11 = Int32_Impl_._mul(ah, bh);
		var low = p00;
		var high = (p11 + (p01 >>> 16) | 0) + (p10 >>> 16) | 0;
		p01 = p01 << 16;
		low = low + p01 | 0;
		if (Int32_Impl_.ucompare(low, p01) < 0) {
			var ret = high++;
			high = high | 0;
		};
		p10 = p10 << 16;
		low = low + p10 | 0;
		if (Int32_Impl_.ucompare(low, p10) < 0) {
			var ret1 = high++;
			high = high | 0;
		};
		high = high + (Int32_Impl_._mul(a.low, b_high) + Int32_Impl_._mul(a.high, b_low) | 0) | 0;
		var this1 = new ___Int64(high, low);
		return this1;
	}
	
	/**
	Returns the quotient of `a` divided by `b`.
	*/
	static div(a, b) {
		return Int64_Impl_.divMod(a, b).quotient;
	}
	static divInt(a, b) {
		var this1 = new ___Int64(b >> 31, b);
		return Int64_Impl_.divMod(a, this1).quotient;
	}
	static intDiv(a, b) {
		var this1 = new ___Int64(a >> 31, a);
		var x = Int64_Impl_.divMod(this1, b).quotient;
		if (x.high != x.low >> 31) {
			throw new HaxeError("Overflow");
		};
		var x1 = x.low;
		var this2 = new ___Int64(x1 >> 31, x1);
		return this2;
	}
	
	/**
	Returns the modulus of `a` divided by `b`.
	*/
	static mod(a, b) {
		return Int64_Impl_.divMod(a, b).modulus;
	}
	static modInt(a, b) {
		var this1 = new ___Int64(b >> 31, b);
		var x = Int64_Impl_.divMod(a, this1).modulus;
		if (x.high != x.low >> 31) {
			throw new HaxeError("Overflow");
		};
		var x1 = x.low;
		var this2 = new ___Int64(x1 >> 31, x1);
		return this2;
	}
	static intMod(a, b) {
		var this1 = new ___Int64(a >> 31, a);
		var x = Int64_Impl_.divMod(this1, b).modulus;
		if (x.high != x.low >> 31) {
			throw new HaxeError("Overflow");
		};
		var x1 = x.low;
		var this2 = new ___Int64(x1 >> 31, x1);
		return this2;
	}
	
	/**
	Returns `true` if `a` is equal to `b`.
	*/
	static eq(a, b) {
		if (a.high == b.high) {
			return a.low == b.low;
		} else {
			return false;
		};
	}
	static eqInt(a, b) {
		var b_high = b >> 31;
		var b_low = b;
		if (a.high == b_high) {
			return a.low == b_low;
		} else {
			return false;
		};
	}
	
	/**
	Returns `true` if `a` is not equal to `b`.
	*/
	static neq(a, b) {
		if (!(a.high != b.high)) {
			return a.low != b.low;
		} else {
			return true;
		};
	}
	static neqInt(a, b) {
		var b_high = b >> 31;
		var b_low = b;
		if (!(a.high != b_high)) {
			return a.low != b_low;
		} else {
			return true;
		};
	}
	static lt(a, b) {
		var v = a.high - b.high | 0;
		v = (v != 0) ? v : Int32_Impl_.ucompare(a.low, b.low);
		return ((a.high < 0) ? (b.high < 0) ? v : -1 : (b.high >= 0) ? v : 1) < 0;
	}
	static ltInt(a, b) {
		var b_high = b >> 31;
		var b_low = b;
		var v = a.high - b_high | 0;
		v = (v != 0) ? v : Int32_Impl_.ucompare(a.low, b_low);
		return ((a.high < 0) ? (b_high < 0) ? v : -1 : (b_high >= 0) ? v : 1) < 0;
	}
	static intLt(a, b) {
		var a_high = a >> 31;
		var a_low = a;
		var v = a_high - b.high | 0;
		v = (v != 0) ? v : Int32_Impl_.ucompare(a_low, b.low);
		return ((a_high < 0) ? (b.high < 0) ? v : -1 : (b.high >= 0) ? v : 1) < 0;
	}
	static lte(a, b) {
		var v = a.high - b.high | 0;
		v = (v != 0) ? v : Int32_Impl_.ucompare(a.low, b.low);
		return ((a.high < 0) ? (b.high < 0) ? v : -1 : (b.high >= 0) ? v : 1) <= 0;
	}
	static lteInt(a, b) {
		var b_high = b >> 31;
		var b_low = b;
		var v = a.high - b_high | 0;
		v = (v != 0) ? v : Int32_Impl_.ucompare(a.low, b_low);
		return ((a.high < 0) ? (b_high < 0) ? v : -1 : (b_high >= 0) ? v : 1) <= 0;
	}
	static intLte(a, b) {
		var a_high = a >> 31;
		var a_low = a;
		var v = a_high - b.high | 0;
		v = (v != 0) ? v : Int32_Impl_.ucompare(a_low, b.low);
		return ((a_high < 0) ? (b.high < 0) ? v : -1 : (b.high >= 0) ? v : 1) <= 0;
	}
	static gt(a, b) {
		var v = a.high - b.high | 0;
		v = (v != 0) ? v : Int32_Impl_.ucompare(a.low, b.low);
		return ((a.high < 0) ? (b.high < 0) ? v : -1 : (b.high >= 0) ? v : 1) > 0;
	}
	static gtInt(a, b) {
		var b_high = b >> 31;
		var b_low = b;
		var v = a.high - b_high | 0;
		v = (v != 0) ? v : Int32_Impl_.ucompare(a.low, b_low);
		return ((a.high < 0) ? (b_high < 0) ? v : -1 : (b_high >= 0) ? v : 1) > 0;
	}
	static intGt(a, b) {
		var a_high = a >> 31;
		var a_low = a;
		var v = a_high - b.high | 0;
		v = (v != 0) ? v : Int32_Impl_.ucompare(a_low, b.low);
		return ((a_high < 0) ? (b.high < 0) ? v : -1 : (b.high >= 0) ? v : 1) > 0;
	}
	static gte(a, b) {
		var v = a.high - b.high | 0;
		v = (v != 0) ? v : Int32_Impl_.ucompare(a.low, b.low);
		return ((a.high < 0) ? (b.high < 0) ? v : -1 : (b.high >= 0) ? v : 1) >= 0;
	}
	static gteInt(a, b) {
		var b_high = b >> 31;
		var b_low = b;
		var v = a.high - b_high | 0;
		v = (v != 0) ? v : Int32_Impl_.ucompare(a.low, b_low);
		return ((a.high < 0) ? (b_high < 0) ? v : -1 : (b_high >= 0) ? v : 1) >= 0;
	}
	static intGte(a, b) {
		var a_high = a >> 31;
		var a_low = a;
		var v = a_high - b.high | 0;
		v = (v != 0) ? v : Int32_Impl_.ucompare(a_low, b.low);
		return ((a_high < 0) ? (b.high < 0) ? v : -1 : (b.high >= 0) ? v : 1) >= 0;
	}
	
	/**
	Returns the bitwise NOT of `a`.
	*/
	static complement(a) {
		var this1 = new ___Int64(~a.high, ~a.low);
		return this1;
	}
	
	/**
	Returns the bitwise AND of `a` and `b`.
	*/
	static and(a, b) {
		var this1 = new ___Int64(a.high & b.high, a.low & b.low);
		return this1;
	}
	
	/**
	Returns the bitwise OR of `a` and `b`.
	*/
	static or(a, b) {
		var this1 = new ___Int64(a.high | b.high, a.low | b.low);
		return this1;
	}
	
	/**
	Returns the bitwise XOR of `a` and `b`.
	*/
	static xor(a, b) {
		var this1 = new ___Int64(a.high ^ b.high, a.low ^ b.low);
		return this1;
	}
	
	/**
	Returns `a` left-shifted by `b` bits.
	*/
	static shl(a, b) {
		b &= 63;
		if (b == 0) {
			var this1 = new ___Int64(a.high, a.low);
			return this1;
		} else if (b < 32) {
			var this2 = new ___Int64(a.high << b | a.low >>> 32 - b, a.low << b);
			return this2;
		} else {
			var this3 = new ___Int64(a.low << b - 32, 0);
			return this3;
		};
	}
	
	/**
	Returns `a` right-shifted by `b` bits in signed mode.
	`a` is sign-extended.
	*/
	static shr(a, b) {
		b &= 63;
		if (b == 0) {
			var this1 = new ___Int64(a.high, a.low);
			return this1;
		} else if (b < 32) {
			var this2 = new ___Int64(a.high >> b, a.high << 32 - b | a.low >>> b);
			return this2;
		} else {
			var this3 = new ___Int64(a.high >> 31, a.high >> b - 32);
			return this3;
		};
	}
	
	/**
	Returns `a` right-shifted by `b` bits in unsigned mode.
	`a` is padded with zeroes.
	*/
	static ushr(a, b) {
		b &= 63;
		if (b == 0) {
			var this1 = new ___Int64(a.high, a.low);
			return this1;
		} else if (b < 32) {
			var this2 = new ___Int64(a.high >>> b, a.high << 32 - b | a.low >>> b);
			return this2;
		} else {
			var this3 = new ___Int64(0, a.high >>> b - 32);
			return this3;
		};
	}
	static get high() {
		return this.get_high()
	}
	static get_high(this1) {
		return this1.high;
	}
	static set_high(this1, x) {
		return this1.high = x;
	}
	static get low() {
		return this.get_low()
	}
	static get_low(this1) {
		return this1.low;
	}
	static set_low(this1, x) {
		return this1.low = x;
	}
	static get __name__() {
		return "haxe._Int64.Int64_Impl_"
	}
	get __class__() {
		return Int64_Impl_
	}
}


export const ___Int64 = Register.global("$hxClasses")["haxe._Int64.___Int64"] = 
class ___Int64 extends Register.inherits() {
	new(high, low) {
		this.high = high;
		this.low = low;
	}
	
	/**
	We also define toString here to ensure we always get a pretty string
	when tracing or calling `Std.string`. This tends not to happen when
	`toString` is only in the abstract.
	*/
	toString() {
		return Int64_Impl_.toString(this);
	}
	static get __name__() {
		return "haxe._Int64.___Int64"
	}
	get __class__() {
		return ___Int64
	}
}


//# sourceMappingURL=Int64.js.map