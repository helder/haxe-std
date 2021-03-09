import {___Int64} from "../Int64"
import {Register} from "../../genes/Register"

/**
Helper that converts between floating point and binary representation.
Always works in low-endian encoding.
*/
export const FPHelper = Register.global("$hxClasses")["haxe.io.FPHelper"] = 
class FPHelper {
	static _i32ToFloat(i) {
		let sign = 1 - (i >>> 31 << 1);
		let e = i >> 23 & 255;
		if (e == 255) {
			if ((i & 8388607) == 0) {
				if (sign > 0) {
					return Infinity;
				} else {
					return -Infinity;
				};
			} else {
				return NaN;
			};
		};
		let m = (e == 0) ? (i & 8388607) << 1 : i & 8388607 | 8388608;
		return sign * m * Math.pow(2, e - 150);
	}
	static _i64ToDouble(lo, hi) {
		let sign = 1 - (hi >>> 31 << 1);
		let e = hi >> 20 & 2047;
		if (e == 2047) {
			if (lo == 0 && (hi & 1048575) == 0) {
				if (sign > 0) {
					return Infinity;
				} else {
					return -Infinity;
				};
			} else {
				return NaN;
			};
		};
		let m = 2.220446049250313e-16 * ((hi & 1048575) * 4294967296. + (lo >>> 31) * 2147483648. + (lo & 2147483647));
		if (e == 0) {
			m *= 2.0;
		} else {
			m += 1.0;
		};
		return sign * m * Math.pow(2, e - 1023);
	}
	static _floatToI32(f) {
		if (f == 0) {
			return 0;
		};
		let af = (f < 0) ? -f : f;
		let exp = Math.floor(Math.log(af) / 0.6931471805599453);
		if (exp > 127) {
			return 2139095040;
		} else {
			if (exp <= -127) {
				exp = -127;
				af *= 7.1362384635298e+44;
			} else {
				af = (af / Math.pow(2, exp) - 1.0) * 8388608;
			};
			return ((f < 0) ? -2147483648 : 0) | exp + 127 << 23 | Math.round(af);
		};
	}
	static _doubleToI64(v) {
		let i64 = FPHelper.i64tmp;
		if (v == 0) {
			i64.low = 0;
			i64.high = 0;
		} else if (!(isFinite)(v)) {
			i64.low = 0;
			i64.high = (v > 0) ? 2146435072 : -1048576;
		} else {
			let av = (v < 0) ? -v : v;
			let exp = Math.floor(Math.log(av) / 0.6931471805599453);
			if (exp > 1023) {
				i64.low = -1;
				i64.high = 2146435071;
			} else {
				if (exp <= -1023) {
					exp = -1023;
					av /= 2.2250738585072014e-308;
				} else {
					av = av / Math.pow(2, exp) - 1.0;
				};
				let sig = Math.round(av * 4503599627370496.);
				let sig_l = sig | 0;
				let sig_h = sig / 4294967296.0 | 0;
				i64.low = sig_l;
				i64.high = ((v < 0) ? -2147483648 : 0) | exp + 1023 << 20 | sig_h;
			};
		};
		return i64;
	}
	static i32ToFloat(i) {
		FPHelper.helper.setInt32(0, i, true);
		return FPHelper.helper.getFloat32(0, true);
	}
	static floatToI32(f) {
		FPHelper.helper.setFloat32(0, f, true);
		return FPHelper.helper.getInt32(0, true);
	}
	static i64ToDouble(low, high) {
		FPHelper.helper.setInt32(0, low, true);
		FPHelper.helper.setInt32(4, high, true);
		return FPHelper.helper.getFloat64(0, true);
	}
	
	/**
	Returns an Int64 representing the bytes representation of the double precision IEEE float value.
	WARNING : for performance reason, the same Int64 value might be reused every time. Copy its low/high values before calling again.
	We still ensure that this is safe to use in a multithread environment
	*/
	static doubleToI64(v) {
		let i64 = FPHelper.i64tmp;
		FPHelper.helper.setFloat64(0, v, true);
		i64.low = FPHelper.helper.getInt32(0, true);
		i64.high = FPHelper.helper.getInt32(4, true);
		return i64;
	}
	static get __name__() {
		return "haxe.io.FPHelper"
	}
	get __class__() {
		return FPHelper
	}
}


FPHelper.i64tmp = (function($this) {var $r0
	let this1 = new ___Int64(0, 0);
	
	$r0 = this1
	return $r0})(this)
FPHelper.LN2 = 0.6931471805599453
FPHelper.helper = new DataView(new ArrayBuffer(8))
//# sourceMappingURL=FPHelper.js.map