import {Register} from "../genes/Register.js"

const $global = Register.$global

export const Int32 = Register.global("$hxClasses")["haxe._Int32.Int32"] = 
class Int32 {
	static negate(this1) {
		return ~this1 + 1 | 0;
	}
	static preIncrement(this1) {
		this1 = ++this1 | 0;
		return this1;
	}
	static postIncrement(this1) {
		var ret = this1++;
		this1 |= 0;
		return ret;
	}
	static preDecrement(this1) {
		this1 = --this1 | 0;
		return this1;
	}
	static postDecrement(this1) {
		var ret = this1--;
		this1 |= 0;
		return ret;
	}
	static add(a, b) {
		return a + b | 0;
	}
	static addInt(a, b) {
		return a + b | 0;
	}
	static sub(a, b) {
		return a - b | 0;
	}
	static subInt(a, b) {
		return a - b | 0;
	}
	static intSub(a, b) {
		return a - b | 0;
	}
	static mul(a, b) {
		return Int32._mul(a, b);
	}
	static mulInt(a, b) {
		return Int32._mul(a, b);
	}
	static toFloat(this1) {
		return this1;
	}
	
	/**
	Compare `a` and `b` in unsigned mode.
	*/
	static ucompare(a, b) {
		if (a < 0) {
			if (b < 0) {
				return ~b - ~a | 0;
			} else {
				return 1;
			};
		};
		if (b < 0) {
			return -1;
		} else {
			return a - b | 0;
		};
	}
	static clamp(x) {
		return x | 0;
	}
	static get __name__() {
		return "haxe._Int32.Int32_Impl_"
	}
	get __class__() {
		return Int32
	}
}


Int32._mul = (Math.imul != null) ? Math.imul : function (a, b) {
	return a * (b & 65535) + (a * (b >>> 16) << 16 | 0) | 0;
}
//# sourceMappingURL=Int32.js.map