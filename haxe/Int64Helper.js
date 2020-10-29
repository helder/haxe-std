import {___Int64} from "./Int64"
import {Int32_Impl_} from "./Int32"
import {Exception} from "./Exception"
import {Register} from "../genes/Register"
import {StringTools} from "../StringTools"
import {HxOverrides} from "../HxOverrides"

/**
Helper for parsing to `Int64` instances.
*/
export const Int64Helper = Register.global("$hxClasses")["haxe.Int64Helper"] = 
class Int64Helper {
	
	/**
	Create `Int64` from given string.
	*/
	static parseString(sParam) {
		let base_high = 0;
		let base_low = 10;
		let this1 = new ___Int64(0, 0);
		let current = this1;
		let this2 = new ___Int64(0, 1);
		let multiplier = this2;
		let sIsNegative = false;
		let s = StringTools.trim(sParam);
		if (s.charAt(0) == "-") {
			sIsNegative = true;
			s = s.substring(1, s.length);
		};
		let len = s.length;
		let _g = 0;
		let _g1 = len;
		while (_g < _g1) {
			let i = _g++;
			let digitInt = HxOverrides.cca(s, len - 1 - i) - 48;
			if (digitInt < 0 || digitInt > 9) {
				throw Exception.thrown("NumberFormatError");
			};
			if (digitInt != 0) {
				let digit_high = digitInt >> 31;
				let digit_low = digitInt;
				if (sIsNegative) {
					let mask = 65535;
					let al = multiplier.low & mask;
					let ah = multiplier.low >>> 16;
					let bl = digit_low & mask;
					let bh = digit_low >>> 16;
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
					high = high + (Int32_Impl_._mul(multiplier.low, digit_high) + Int32_Impl_._mul(multiplier.high, digit_low) | 0) | 0;
					let b_high = high;
					let b_low = low;
					let high1 = current.high - b_high | 0;
					let low1 = current.low - b_low | 0;
					if (Int32_Impl_.ucompare(current.low, b_low) < 0) {
						let ret = high1--;
						high1 = high1 | 0;
					};
					let this1 = new ___Int64(high1, low1);
					current = this1;
					if (!(current.high < 0)) {
						throw Exception.thrown("NumberFormatError: Underflow");
					};
				} else {
					let mask = 65535;
					let al = multiplier.low & mask;
					let ah = multiplier.low >>> 16;
					let bl = digit_low & mask;
					let bh = digit_low >>> 16;
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
					high = high + (Int32_Impl_._mul(multiplier.low, digit_high) + Int32_Impl_._mul(multiplier.high, digit_low) | 0) | 0;
					let b_high = high;
					let b_low = low;
					let high1 = current.high + b_high | 0;
					let low1 = current.low + b_low | 0;
					if (Int32_Impl_.ucompare(low1, current.low) < 0) {
						let ret = high1++;
						high1 = high1 | 0;
					};
					let this1 = new ___Int64(high1, low1);
					current = this1;
					if (current.high < 0) {
						throw Exception.thrown("NumberFormatError: Overflow");
					};
				};
			};
			let mask = 65535;
			let al = multiplier.low & mask;
			let ah = multiplier.low >>> 16;
			let bl = base_low & mask;
			let bh = base_low >>> 16;
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
			high = high + (Int32_Impl_._mul(multiplier.low, base_high) + Int32_Impl_._mul(multiplier.high, base_low) | 0) | 0;
			let this1 = new ___Int64(high, low);
			multiplier = this1;
		};
		return current;
	}
	
	/**
	Create `Int64` from given float.
	*/
	static fromFloat(f) {
		if ((isNaN)(f) || !(isFinite)(f)) {
			throw Exception.thrown("Number is NaN or Infinite");
		};
		let noFractions = f - f % 1;
		if (noFractions > 9007199254740991) {
			throw Exception.thrown("Conversion overflow");
		};
		if (noFractions < -9007199254740991) {
			throw Exception.thrown("Conversion underflow");
		};
		let this1 = new ___Int64(0, 0);
		let result = this1;
		let neg = noFractions < 0;
		let rest = (neg) ? -noFractions : noFractions;
		let i = 0;
		while (rest >= 1) {
			let curr = rest % 2;
			rest /= 2;
			if (curr >= 1) {
				let a_high = 0;
				let a_low = 1;
				let b = i;
				b &= 63;
				let b1;
				if (b == 0) {
					let this1 = new ___Int64(a_high, a_low);
					b1 = this1;
				} else if (b < 32) {
					let this1 = new ___Int64(a_high << b | a_low >>> 32 - b, a_low << b);
					b1 = this1;
				} else {
					let this1 = new ___Int64(a_low << b - 32, 0);
					b1 = this1;
				};
				let high = result.high + b1.high | 0;
				let low = result.low + b1.low | 0;
				if (Int32_Impl_.ucompare(low, result.low) < 0) {
					let ret = high++;
					high = high | 0;
				};
				let this1 = new ___Int64(high, low);
				result = this1;
			};
			++i;
		};
		if (neg) {
			let high = ~result.high;
			let low = ~result.low + 1 | 0;
			if (low == 0) {
				let ret = high++;
				high = high | 0;
			};
			let this1 = new ___Int64(high, low);
			result = this1;
		};
		return result;
	}
	static get __name__() {
		return "haxe.Int64Helper"
	}
	get __class__() {
		return Int64Helper
	}
}


//# sourceMappingURL=Int64Helper.js.map