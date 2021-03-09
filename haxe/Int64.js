import {Int64Helper} from "./Int64Helper.js"
import {Int32_Impl_} from "./Int32.js"
import {Exception} from "./Exception.js"
import {Register} from "../genes/Register.js"

export const Int64_Impl_ = Register.global("$hxClasses")["haxe._Int64.Int64_Impl_"] = 
class Int64_Impl_ {
	static _new(x) {
		let this1 = x;
		return this1;
	}
	
	/**
	Makes a copy of `this` Int64.
	*/
	static copy(this1) {
		let this2 = new ___Int64(this1.high, this1.low);
		return this2;
	}
	
	/**
	Construct an Int64 from two 32-bit words `high` and `low`.
	*/
	static make(high, low) {
		let this1 = new ___Int64(high, low);
		return this1;
	}
	
	/**
	Returns an Int64 with the value of the Int `x`.
	`x` is sign-extended to fill 64 bits.
	*/
	static ofInt(x) {
		let this1 = new ___Int64(x >> 31, x);
		return this1;
	}
	
	/**
	Returns an Int with the value of the Int64 `x`.
	Throws an exception  if `x` cannot be represented in 32 bits.
	*/
	static toInt(x) {
		if (x.high != x.low >> 31) {
			throw Exception.thrown("Overflow");
		};
		return x.low;
	}
	static is(val) {
		return ((val) instanceof ___Int64);
	}
	
	/**
	Returns whether the value `val` is of type `haxe.Int64`
	*/
	static isInt64(val) {
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
		let b_high = 0;
		let b_low = 0;
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
		let v = a.high - b.high | 0;
		if (v == 0) {
			v = Int32_Impl_.ucompare(a.low, b.low);
		};
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
		let v = Int32_Impl_.ucompare(a.high, b.high);
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
		let i = this1;
		let b_high = 0;
		let b_low = 0;
		if (i.high == b_high && i.low == b_low) {
			return "0";
		};
		let str = "";
		let neg = false;
		if (i.high < 0) {
			neg = true;
		};
		let this2 = new ___Int64(0, 10);
		let ten = this2;
		while (true) {
			let b_high = 0;
			let b_low = 0;
			if (!(i.high != b_high || i.low != b_low)) {
				break;
			};
			let r = Int64_Impl_.divMod(i, ten);
			if (r.modulus.high < 0) {
				let x = r.modulus;
				let high = ~x.high;
				let low = ~x.low + 1 | 0;
				if (low == 0) {
					let ret = high++;
					high = high | 0;
				};
				let this_high = high;
				let this_low = low;
				str = this_low + str;
				let x1 = r.quotient;
				let high1 = ~x1.high;
				let low1 = ~x1.low + 1 | 0;
				if (low1 == 0) {
					let ret = high1++;
					high1 = high1 | 0;
				};
				let this1 = new ___Int64(high1, low1);
				i = this1;
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
					throw Exception.thrown("divide by zero");
					break
				case 1:
					let this1 = new ___Int64(dividend.high, dividend.low);
					let this2 = new ___Int64(0, 0);
					return {"quotient": this1, "modulus": this2};
					break
				
			};
		};
		let divSign = dividend.high < 0 != divisor.high < 0;
		let modulus;
		if (dividend.high < 0) {
			let high = ~dividend.high;
			let low = ~dividend.low + 1 | 0;
			if (low == 0) {
				let ret = high++;
				high = high | 0;
			};
			let this1 = new ___Int64(high, low);
			modulus = this1;
		} else {
			let this1 = new ___Int64(dividend.high, dividend.low);
			modulus = this1;
		};
		if (divisor.high < 0) {
			let high = ~divisor.high;
			let low = ~divisor.low + 1 | 0;
			if (low == 0) {
				let ret = high++;
				high = high | 0;
			};
			let this1 = new ___Int64(high, low);
			divisor = this1;
		};
		let this3 = new ___Int64(0, 0);
		let quotient = this3;
		let this4 = new ___Int64(0, 1);
		let mask = this4;
		while (!(divisor.high < 0)) {
			let v = Int32_Impl_.ucompare(divisor.high, modulus.high);
			let cmp = (v != 0) ? v : Int32_Impl_.ucompare(divisor.low, modulus.low);
			let b = 1;
			b &= 63;
			if (b == 0) {
				let this1 = new ___Int64(divisor.high, divisor.low);
				divisor = this1;
			} else if (b < 32) {
				let this1 = new ___Int64(divisor.high << b | divisor.low >>> 32 - b, divisor.low << b);
				divisor = this1;
			} else {
				let this1 = new ___Int64(divisor.low << b - 32, 0);
				divisor = this1;
			};
			let b1 = 1;
			b1 &= 63;
			if (b1 == 0) {
				let this1 = new ___Int64(mask.high, mask.low);
				mask = this1;
			} else if (b1 < 32) {
				let this1 = new ___Int64(mask.high << b1 | mask.low >>> 32 - b1, mask.low << b1);
				mask = this1;
			} else {
				let this1 = new ___Int64(mask.low << b1 - 32, 0);
				mask = this1;
			};
			if (cmp >= 0) {
				break;
			};
		};
		while (true) {
			let b_high = 0;
			let b_low = 0;
			if (!(mask.high != b_high || mask.low != b_low)) {
				break;
			};
			let v = Int32_Impl_.ucompare(modulus.high, divisor.high);
			if (((v != 0) ? v : Int32_Impl_.ucompare(modulus.low, divisor.low)) >= 0) {
				let this1 = new ___Int64(quotient.high | mask.high, quotient.low | mask.low);
				quotient = this1;
				let high = modulus.high - divisor.high | 0;
				let low = modulus.low - divisor.low | 0;
				if (Int32_Impl_.ucompare(modulus.low, divisor.low) < 0) {
					let ret = high--;
					high = high | 0;
				};
				let this2 = new ___Int64(high, low);
				modulus = this2;
			};
			let b = 1;
			b &= 63;
			if (b == 0) {
				let this1 = new ___Int64(mask.high, mask.low);
				mask = this1;
			} else if (b < 32) {
				let this1 = new ___Int64(mask.high >>> b, mask.high << 32 - b | mask.low >>> b);
				mask = this1;
			} else {
				let this1 = new ___Int64(0, mask.high >>> b - 32);
				mask = this1;
			};
			let b1 = 1;
			b1 &= 63;
			if (b1 == 0) {
				let this1 = new ___Int64(divisor.high, divisor.low);
				divisor = this1;
			} else if (b1 < 32) {
				let this1 = new ___Int64(divisor.high >>> b1, divisor.high << 32 - b1 | divisor.low >>> b1);
				divisor = this1;
			} else {
				let this1 = new ___Int64(0, divisor.high >>> b1 - 32);
				divisor = this1;
			};
		};
		if (divSign) {
			let high = ~quotient.high;
			let low = ~quotient.low + 1 | 0;
			if (low == 0) {
				let ret = high++;
				high = high | 0;
			};
			let this1 = new ___Int64(high, low);
			quotient = this1;
		};
		if (dividend.high < 0) {
			let high = ~modulus.high;
			let low = ~modulus.low + 1 | 0;
			if (low == 0) {
				let ret = high++;
				high = high | 0;
			};
			let this1 = new ___Int64(high, low);
			modulus = this1;
		};
		return {"quotient": quotient, "modulus": modulus};
	}
	
	/**
	Returns the negative of `x`.
	*/
	static neg(x) {
		let high = ~x.high;
		let low = ~x.low + 1 | 0;
		if (low == 0) {
			let ret = high++;
			high = high | 0;
		};
		let this1 = new ___Int64(high, low);
		return this1;
	}
	static preIncrement(this1) {
		let this2 = new ___Int64(this1.high, this1.low);
		this1 = this2;
		let ret = this1.low++;
		this1.low = this1.low | 0;
		if (this1.low == 0) {
			let ret = this1.high++;
			this1.high = this1.high | 0;
		};
		return this1;
	}
	static postIncrement(this1) {
		let ret = this1;
		let this2 = new ___Int64(this1.high, this1.low);
		this1 = this2;
		let ret1 = this1.low++;
		this1.low = this1.low | 0;
		if (this1.low == 0) {
			let ret = this1.high++;
			this1.high = this1.high | 0;
		};
		return ret;
	}
	static preDecrement(this1) {
		let this2 = new ___Int64(this1.high, this1.low);
		this1 = this2;
		if (this1.low == 0) {
			let ret = this1.high--;
			this1.high = this1.high | 0;
		};
		let ret = this1.low--;
		this1.low = this1.low | 0;
		return this1;
	}
	static postDecrement(this1) {
		let ret = this1;
		let this2 = new ___Int64(this1.high, this1.low);
		this1 = this2;
		if (this1.low == 0) {
			let ret = this1.high--;
			this1.high = this1.high | 0;
		};
		let ret1 = this1.low--;
		this1.low = this1.low | 0;
		return ret;
	}
	
	/**
	Returns the sum of `a` and `b`.
	*/
	static add(a, b) {
		let high = a.high + b.high | 0;
		let low = a.low + b.low | 0;
		if (Int32_Impl_.ucompare(low, a.low) < 0) {
			let ret = high++;
			high = high | 0;
		};
		let this1 = new ___Int64(high, low);
		return this1;
	}
	static addInt(a, b) {
		let b_high = b >> 31;
		let b_low = b;
		let high = a.high + b_high | 0;
		let low = a.low + b_low | 0;
		if (Int32_Impl_.ucompare(low, a.low) < 0) {
			let ret = high++;
			high = high | 0;
		};
		let this1 = new ___Int64(high, low);
		return this1;
	}
	
	/**
	Returns `a` minus `b`.
	*/
	static sub(a, b) {
		let high = a.high - b.high | 0;
		let low = a.low - b.low | 0;
		if (Int32_Impl_.ucompare(a.low, b.low) < 0) {
			let ret = high--;
			high = high | 0;
		};
		let this1 = new ___Int64(high, low);
		return this1;
	}
	static subInt(a, b) {
		let b_high = b >> 31;
		let b_low = b;
		let high = a.high - b_high | 0;
		let low = a.low - b_low | 0;
		if (Int32_Impl_.ucompare(a.low, b_low) < 0) {
			let ret = high--;
			high = high | 0;
		};
		let this1 = new ___Int64(high, low);
		return this1;
	}
	static intSub(a, b) {
		let a_high = a >> 31;
		let a_low = a;
		let high = a_high - b.high | 0;
		let low = a_low - b.low | 0;
		if (Int32_Impl_.ucompare(a_low, b.low) < 0) {
			let ret = high--;
			high = high | 0;
		};
		let this1 = new ___Int64(high, low);
		return this1;
	}
	
	/**
	Returns the product of `a` and `b`.
	*/
	static mul(a, b) {
		let mask = 65535;
		let al = a.low & mask;
		let ah = a.low >>> 16;
		let bl = b.low & mask;
		let bh = b.low >>> 16;
		let p00 = Int32_Impl_._mul(al, bl);
		let p10 = Int32_Impl_._mul(ah, bl);
		let p01 = Int32_Impl_._mul(al, bh);
		let p11 = Int32_Impl_._mul(ah, bh);
		let low = p00;
		let high = (p11 + (p01 >>> 16) | 0) + (p10 >>> 16) | 0;
		p01 <<= 16;
		low = low + p01 | 0;
		if (Int32_Impl_.ucompare(low, p01) < 0) {
			let ret = high++;
			high = high | 0;
		};
		p10 <<= 16;
		low = low + p10 | 0;
		if (Int32_Impl_.ucompare(low, p10) < 0) {
			let ret = high++;
			high = high | 0;
		};
		high = high + (Int32_Impl_._mul(a.low, b.high) + Int32_Impl_._mul(a.high, b.low) | 0) | 0;
		let this1 = new ___Int64(high, low);
		return this1;
	}
	static mulInt(a, b) {
		let b_high = b >> 31;
		let b_low = b;
		let mask = 65535;
		let al = a.low & mask;
		let ah = a.low >>> 16;
		let bl = b_low & mask;
		let bh = b_low >>> 16;
		let p00 = Int32_Impl_._mul(al, bl);
		let p10 = Int32_Impl_._mul(ah, bl);
		let p01 = Int32_Impl_._mul(al, bh);
		let p11 = Int32_Impl_._mul(ah, bh);
		let low = p00;
		let high = (p11 + (p01 >>> 16) | 0) + (p10 >>> 16) | 0;
		p01 <<= 16;
		low = low + p01 | 0;
		if (Int32_Impl_.ucompare(low, p01) < 0) {
			let ret = high++;
			high = high | 0;
		};
		p10 <<= 16;
		low = low + p10 | 0;
		if (Int32_Impl_.ucompare(low, p10) < 0) {
			let ret = high++;
			high = high | 0;
		};
		high = high + (Int32_Impl_._mul(a.low, b_high) + Int32_Impl_._mul(a.high, b_low) | 0) | 0;
		let this1 = new ___Int64(high, low);
		return this1;
	}
	
	/**
	Returns the quotient of `a` divided by `b`.
	*/
	static div(a, b) {
		return Int64_Impl_.divMod(a, b).quotient;
	}
	static divInt(a, b) {
		let this1 = new ___Int64(b >> 31, b);
		return Int64_Impl_.divMod(a, this1).quotient;
	}
	static intDiv(a, b) {
		let this1 = new ___Int64(a >> 31, a);
		let x = Int64_Impl_.divMod(this1, b).quotient;
		if (x.high != x.low >> 31) {
			throw Exception.thrown("Overflow");
		};
		let x1 = x.low;
		let this2 = new ___Int64(x1 >> 31, x1);
		return this2;
	}
	
	/**
	Returns the modulus of `a` divided by `b`.
	*/
	static mod(a, b) {
		return Int64_Impl_.divMod(a, b).modulus;
	}
	static modInt(a, b) {
		let this1 = new ___Int64(b >> 31, b);
		let x = Int64_Impl_.divMod(a, this1).modulus;
		if (x.high != x.low >> 31) {
			throw Exception.thrown("Overflow");
		};
		let x1 = x.low;
		let this2 = new ___Int64(x1 >> 31, x1);
		return this2;
	}
	static intMod(a, b) {
		let this1 = new ___Int64(a >> 31, a);
		let x = Int64_Impl_.divMod(this1, b).modulus;
		if (x.high != x.low >> 31) {
			throw Exception.thrown("Overflow");
		};
		let x1 = x.low;
		let this2 = new ___Int64(x1 >> 31, x1);
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
		let b_high = b >> 31;
		let b_low = b;
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
		if (a.high == b.high) {
			return a.low != b.low;
		} else {
			return true;
		};
	}
	static neqInt(a, b) {
		let b_high = b >> 31;
		let b_low = b;
		if (a.high == b_high) {
			return a.low != b_low;
		} else {
			return true;
		};
	}
	static lt(a, b) {
		let v = a.high - b.high | 0;
		if (v == 0) {
			v = Int32_Impl_.ucompare(a.low, b.low);
		};
		return ((a.high < 0) ? (b.high < 0) ? v : -1 : (b.high >= 0) ? v : 1) < 0;
	}
	static ltInt(a, b) {
		let b_high = b >> 31;
		let b_low = b;
		let v = a.high - b_high | 0;
		if (v == 0) {
			v = Int32_Impl_.ucompare(a.low, b_low);
		};
		return ((a.high < 0) ? (b_high < 0) ? v : -1 : (b_high >= 0) ? v : 1) < 0;
	}
	static intLt(a, b) {
		let a_high = a >> 31;
		let a_low = a;
		let v = a_high - b.high | 0;
		if (v == 0) {
			v = Int32_Impl_.ucompare(a_low, b.low);
		};
		return ((a_high < 0) ? (b.high < 0) ? v : -1 : (b.high >= 0) ? v : 1) < 0;
	}
	static lte(a, b) {
		let v = a.high - b.high | 0;
		if (v == 0) {
			v = Int32_Impl_.ucompare(a.low, b.low);
		};
		return ((a.high < 0) ? (b.high < 0) ? v : -1 : (b.high >= 0) ? v : 1) <= 0;
	}
	static lteInt(a, b) {
		let b_high = b >> 31;
		let b_low = b;
		let v = a.high - b_high | 0;
		if (v == 0) {
			v = Int32_Impl_.ucompare(a.low, b_low);
		};
		return ((a.high < 0) ? (b_high < 0) ? v : -1 : (b_high >= 0) ? v : 1) <= 0;
	}
	static intLte(a, b) {
		let a_high = a >> 31;
		let a_low = a;
		let v = a_high - b.high | 0;
		if (v == 0) {
			v = Int32_Impl_.ucompare(a_low, b.low);
		};
		return ((a_high < 0) ? (b.high < 0) ? v : -1 : (b.high >= 0) ? v : 1) <= 0;
	}
	static gt(a, b) {
		let v = a.high - b.high | 0;
		if (v == 0) {
			v = Int32_Impl_.ucompare(a.low, b.low);
		};
		return ((a.high < 0) ? (b.high < 0) ? v : -1 : (b.high >= 0) ? v : 1) > 0;
	}
	static gtInt(a, b) {
		let b_high = b >> 31;
		let b_low = b;
		let v = a.high - b_high | 0;
		if (v == 0) {
			v = Int32_Impl_.ucompare(a.low, b_low);
		};
		return ((a.high < 0) ? (b_high < 0) ? v : -1 : (b_high >= 0) ? v : 1) > 0;
	}
	static intGt(a, b) {
		let a_high = a >> 31;
		let a_low = a;
		let v = a_high - b.high | 0;
		if (v == 0) {
			v = Int32_Impl_.ucompare(a_low, b.low);
		};
		return ((a_high < 0) ? (b.high < 0) ? v : -1 : (b.high >= 0) ? v : 1) > 0;
	}
	static gte(a, b) {
		let v = a.high - b.high | 0;
		if (v == 0) {
			v = Int32_Impl_.ucompare(a.low, b.low);
		};
		return ((a.high < 0) ? (b.high < 0) ? v : -1 : (b.high >= 0) ? v : 1) >= 0;
	}
	static gteInt(a, b) {
		let b_high = b >> 31;
		let b_low = b;
		let v = a.high - b_high | 0;
		if (v == 0) {
			v = Int32_Impl_.ucompare(a.low, b_low);
		};
		return ((a.high < 0) ? (b_high < 0) ? v : -1 : (b_high >= 0) ? v : 1) >= 0;
	}
	static intGte(a, b) {
		let a_high = a >> 31;
		let a_low = a;
		let v = a_high - b.high | 0;
		if (v == 0) {
			v = Int32_Impl_.ucompare(a_low, b.low);
		};
		return ((a_high < 0) ? (b.high < 0) ? v : -1 : (b.high >= 0) ? v : 1) >= 0;
	}
	
	/**
	Returns the bitwise NOT of `a`.
	*/
	static complement(a) {
		let this1 = new ___Int64(~a.high, ~a.low);
		return this1;
	}
	
	/**
	Returns the bitwise AND of `a` and `b`.
	*/
	static and(a, b) {
		let this1 = new ___Int64(a.high & b.high, a.low & b.low);
		return this1;
	}
	
	/**
	Returns the bitwise OR of `a` and `b`.
	*/
	static or(a, b) {
		let this1 = new ___Int64(a.high | b.high, a.low | b.low);
		return this1;
	}
	
	/**
	Returns the bitwise XOR of `a` and `b`.
	*/
	static xor(a, b) {
		let this1 = new ___Int64(a.high ^ b.high, a.low ^ b.low);
		return this1;
	}
	
	/**
	Returns `a` left-shifted by `b` bits.
	*/
	static shl(a, b) {
		b &= 63;
		if (b == 0) {
			let this1 = new ___Int64(a.high, a.low);
			return this1;
		} else if (b < 32) {
			let this1 = new ___Int64(a.high << b | a.low >>> 32 - b, a.low << b);
			return this1;
		} else {
			let this1 = new ___Int64(a.low << b - 32, 0);
			return this1;
		};
	}
	
	/**
	Returns `a` right-shifted by `b` bits in signed mode.
	`a` is sign-extended.
	*/
	static shr(a, b) {
		b &= 63;
		if (b == 0) {
			let this1 = new ___Int64(a.high, a.low);
			return this1;
		} else if (b < 32) {
			let this1 = new ___Int64(a.high >> b, a.high << 32 - b | a.low >>> b);
			return this1;
		} else {
			let this1 = new ___Int64(a.high >> 31, a.high >> b - 32);
			return this1;
		};
	}
	
	/**
	Returns `a` right-shifted by `b` bits in unsigned mode.
	`a` is padded with zeroes.
	*/
	static ushr(a, b) {
		b &= 63;
		if (b == 0) {
			let this1 = new ___Int64(a.high, a.low);
			return this1;
		} else if (b < 32) {
			let this1 = new ___Int64(a.high >>> b, a.high << 32 - b | a.low >>> b);
			return this1;
		} else {
			let this1 = new ___Int64(0, a.high >>> b - 32);
			return this1;
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