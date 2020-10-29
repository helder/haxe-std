import {Register} from "./genes/Register"
import {Std} from "./Std"

export const UInt_Impl_ = Register.global("$hxClasses")["_UInt.UInt_Impl_"] = 
class UInt_Impl_ {
	static add(a, b) {
		return a + b;
	}
	static div(a, b) {
		return UInt_Impl_.toFloat(a) / UInt_Impl_.toFloat(b);
	}
	static mul(a, b) {
		return a * b;
	}
	static sub(a, b) {
		return a - b;
	}
	static gt(a, b) {
		let aNeg = a < 0;
		let bNeg = b < 0;
		if (aNeg != bNeg) {
			return aNeg;
		} else {
			return a > b;
		};
	}
	static gte(a, b) {
		let aNeg = a < 0;
		let bNeg = b < 0;
		if (aNeg != bNeg) {
			return aNeg;
		} else {
			return a >= b;
		};
	}
	static lt(a, b) {
		return UInt_Impl_.gt(b, a);
	}
	static lte(a, b) {
		return UInt_Impl_.gte(b, a);
	}
	static and(a, b) {
		return a & b;
	}
	static or(a, b) {
		return a | b;
	}
	static xor(a, b) {
		return a ^ b;
	}
	static shl(a, b) {
		return a << b;
	}
	static shr(a, b) {
		return a >>> b;
	}
	static ushr(a, b) {
		return a >>> b;
	}
	static mod(a, b) {
		return UInt_Impl_.toFloat(a) % UInt_Impl_.toFloat(b) | 0;
	}
	static addWithFloat(a, b) {
		return UInt_Impl_.toFloat(a) + b;
	}
	static mulWithFloat(a, b) {
		return UInt_Impl_.toFloat(a) * b;
	}
	static divFloat(a, b) {
		return UInt_Impl_.toFloat(a) / b;
	}
	static floatDiv(a, b) {
		return a / UInt_Impl_.toFloat(b);
	}
	static subFloat(a, b) {
		return UInt_Impl_.toFloat(a) - b;
	}
	static floatSub(a, b) {
		return a - UInt_Impl_.toFloat(b);
	}
	static gtFloat(a, b) {
		return UInt_Impl_.toFloat(a) > b;
	}
	static equalsInt(a, b) {
		return a == b;
	}
	static notEqualsInt(a, b) {
		return a != b;
	}
	static equalsFloat(a, b) {
		return UInt_Impl_.toFloat(a) == b;
	}
	static notEqualsFloat(a, b) {
		return UInt_Impl_.toFloat(a) != b;
	}
	static gteFloat(a, b) {
		return UInt_Impl_.toFloat(a) >= b;
	}
	static floatGt(a, b) {
		return a > UInt_Impl_.toFloat(b);
	}
	static floatGte(a, b) {
		return a >= UInt_Impl_.toFloat(b);
	}
	static ltFloat(a, b) {
		return UInt_Impl_.toFloat(a) < b;
	}
	static lteFloat(a, b) {
		return UInt_Impl_.toFloat(a) <= b;
	}
	static floatLt(a, b) {
		return a < UInt_Impl_.toFloat(b);
	}
	static floatLte(a, b) {
		return a <= UInt_Impl_.toFloat(b);
	}
	static modFloat(a, b) {
		return UInt_Impl_.toFloat(a) % b;
	}
	static floatMod(a, b) {
		return a % UInt_Impl_.toFloat(b);
	}
	static negBits(this1) {
		return ~this1;
	}
	static prefixIncrement(this1) {
		return ++this1;
	}
	static postfixIncrement(this1) {
		return this1++;
	}
	static prefixDecrement(this1) {
		return --this1;
	}
	static postfixDecrement(this1) {
		return this1--;
	}
	static toString(this1, radix = null) {
		return Std.string(UInt_Impl_.toFloat(this1));
	}
	static toInt(this1) {
		return this1;
	}
	static toFloat(this1) {
		let $int = this1;
		if ($int < 0) {
			return 4294967296.0 + $int;
		} else {
			return $int + 0.0;
		};
	}
	static get __name__() {
		return "_UInt.UInt_Impl_"
	}
	get __class__() {
		return UInt_Impl_
	}
}


//# sourceMappingURL=UInt.js.map