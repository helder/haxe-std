import {___Int64} from "./Int64.js"
import {Int32} from "./Int32.js"
import {Exception} from "./Exception.js"
import {Register} from "../genes/Register.js"
import {StringTools} from "../StringTools.js"
import {HxOverrides} from "../HxOverrides.js"

const $global = Register.$global

/**
Helper for parsing to `Int64` instances.
*/
export const Int64Helper = Register.global("$hxClasses")["haxe.Int64Helper"] = 
class Int64Helper {
	
	/**
	Create `Int64` from given string.
	*/
	static parseString(sParam) {
		var base_high = 0;
		var base_low = 10;
		var this1 = new ___Int64(0, 0);
		var current = this1;
		var this1 = new ___Int64(0, 1);
		var multiplier = this1;
		var sIsNegative = false;
		var s = StringTools.trim(sParam);
		if (s.charAt(0) == "-") {
			sIsNegative = true;
			s = s.substring(1, s.length);
		};
		var len = s.length;
		var _g = 0;
		var _g1 = len;
		while (_g < _g1) {
			var i = _g++;
			var digitInt = HxOverrides.cca(s, len - 1 - i) - 48;
			if (digitInt < 0 || digitInt > 9) {
				throw Exception.thrown("NumberFormatError");
			};
			if (digitInt != 0) {
				var digit_high = digitInt >> 31;
				var digit_low = digitInt;
				if (sIsNegative) {
					var mask = 65535;
					var al = multiplier.low & mask;
					var ah = multiplier.low >>> 16;
					var bl = digit_low & mask;
					var bh = digit_low >>> 16;
					var p00 = Int32._mul(al, bl);
					var p10 = Int32._mul(ah, bl);
					var p01 = Int32._mul(al, bh);
					var p11 = Int32._mul(ah, bh);
					var low = p00;
					var high = (p11 + (p01 >>> 16) | 0) + (p10 >>> 16) | 0;
					p01 <<= 16;
					low = low + p01 | 0;
					if (Int32.ucompare(low, p01) < 0) {
						var ret = high++;
						high = high | 0;
					};
					p10 <<= 16;
					low = low + p10 | 0;
					if (Int32.ucompare(low, p10) < 0) {
						var ret1 = high++;
						high = high | 0;
					};
					high = high + (Int32._mul(multiplier.low, digit_high) + Int32._mul(multiplier.high, digit_low) | 0) | 0;
					var b_high = high;
					var b_low = low;
					var high1 = current.high - b_high | 0;
					var low1 = current.low - b_low | 0;
					if (Int32.ucompare(current.low, b_low) < 0) {
						var ret2 = high1--;
						high1 = high1 | 0;
					};
					var this1 = new ___Int64(high1, low1);
					current = this1;
					if (!(current.high < 0)) {
						throw Exception.thrown("NumberFormatError: Underflow");
					};
				} else {
					var mask1 = 65535;
					var al1 = multiplier.low & mask1;
					var ah1 = multiplier.low >>> 16;
					var bl1 = digit_low & mask1;
					var bh1 = digit_low >>> 16;
					var p001 = Int32._mul(al1, bl1);
					var p101 = Int32._mul(ah1, bl1);
					var p011 = Int32._mul(al1, bh1);
					var p111 = Int32._mul(ah1, bh1);
					var low2 = p001;
					var high2 = (p111 + (p011 >>> 16) | 0) + (p101 >>> 16) | 0;
					p011 <<= 16;
					low2 = low2 + p011 | 0;
					if (Int32.ucompare(low2, p011) < 0) {
						var ret3 = high2++;
						high2 = high2 | 0;
					};
					p101 <<= 16;
					low2 = low2 + p101 | 0;
					if (Int32.ucompare(low2, p101) < 0) {
						var ret4 = high2++;
						high2 = high2 | 0;
					};
					high2 = high2 + (Int32._mul(multiplier.low, digit_high) + Int32._mul(multiplier.high, digit_low) | 0) | 0;
					var b_high1 = high2;
					var b_low1 = low2;
					var high3 = current.high + b_high1 | 0;
					var low3 = current.low + b_low1 | 0;
					if (Int32.ucompare(low3, current.low) < 0) {
						var ret5 = high3++;
						high3 = high3 | 0;
					};
					var this2 = new ___Int64(high3, low3);
					current = this2;
					if (current.high < 0) {
						throw Exception.thrown("NumberFormatError: Overflow");
					};
				};
			};
			var mask2 = 65535;
			var al2 = multiplier.low & mask2;
			var ah2 = multiplier.low >>> 16;
			var bl2 = base_low & mask2;
			var bh2 = base_low >>> 16;
			var p002 = Int32._mul(al2, bl2);
			var p102 = Int32._mul(ah2, bl2);
			var p012 = Int32._mul(al2, bh2);
			var p112 = Int32._mul(ah2, bh2);
			var low4 = p002;
			var high4 = (p112 + (p012 >>> 16) | 0) + (p102 >>> 16) | 0;
			p012 <<= 16;
			low4 = low4 + p012 | 0;
			if (Int32.ucompare(low4, p012) < 0) {
				var ret6 = high4++;
				high4 = high4 | 0;
			};
			p102 <<= 16;
			low4 = low4 + p102 | 0;
			if (Int32.ucompare(low4, p102) < 0) {
				var ret7 = high4++;
				high4 = high4 | 0;
			};
			high4 = high4 + (Int32._mul(multiplier.low, base_high) + Int32._mul(multiplier.high, base_low) | 0) | 0;
			var this3 = new ___Int64(high4, low4);
			multiplier = this3;
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
		var noFractions = f - f % 1;
		if (noFractions > 9007199254740991) {
			throw Exception.thrown("Conversion overflow");
		};
		if (noFractions < -9007199254740991) {
			throw Exception.thrown("Conversion underflow");
		};
		var this1 = new ___Int64(0, 0);
		var result = this1;
		var neg = noFractions < 0;
		var rest = (neg) ? -noFractions : noFractions;
		var i = 0;
		while (rest >= 1) {
			var curr = rest % 2;
			rest /= 2;
			if (curr >= 1) {
				var a_high = 0;
				var a_low = 1;
				var b = i;
				b &= 63;
				var b1;
				if (b == 0) {
					var this1 = new ___Int64(a_high, a_low);
					b1 = this1;
				} else if (b < 32) {
					var this2 = new ___Int64(a_high << b | a_low >>> 32 - b, a_low << b);
					b1 = this2;
				} else {
					var this3 = new ___Int64(a_low << b - 32, 0);
					b1 = this3;
				};
				var high = result.high + b1.high | 0;
				var low = result.low + b1.low | 0;
				if (Int32.ucompare(low, result.low) < 0) {
					var ret = high++;
					high = high | 0;
				};
				var this4 = new ___Int64(high, low);
				result = this4;
			};
			++i;
		};
		if (neg) {
			var high = ~result.high;
			var low = ~result.low + 1 | 0;
			if (low == 0) {
				var ret = high++;
				high = high | 0;
			};
			var this1 = new ___Int64(high, low);
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