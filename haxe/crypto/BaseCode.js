import {Bytes} from "../io/Bytes.js"
import {Exception} from "../Exception.js"
import {Register} from "../../genes/Register.js"

const $global = Register.$global

/**
Allows one to encode/decode String and bytes using a power of two base dictionary.
*/
export const BaseCode = Register.global("$hxClasses")["haxe.crypto.BaseCode"] = 
class BaseCode extends Register.inherits() {
	new(base) {
		var len = base.length;
		var nbits = 1;
		while (len > 1 << nbits) ++nbits;
		if (nbits > 8 || len != 1 << nbits) {
			throw Exception.thrown("BaseCode : base length must be a power of two.");
		};
		this.base = base;
		this.nbits = nbits;
	}
	encodeBytes(b) {
		var nbits = this.nbits;
		var base = this.base;
		var size = b.length * 8 / nbits | 0;
		var out = new Bytes(new ArrayBuffer(size + ((b.length * 8 % nbits == 0) ? 0 : 1)));
		var buf = 0;
		var curbits = 0;
		var mask = (1 << nbits) - 1;
		var pin = 0;
		var pout = 0;
		while (pout < size) {
			while (curbits < nbits) {
				curbits += 8;
				buf <<= 8;
				buf |= b.b[pin++];
			};
			curbits -= nbits;
			out.b[pout++] = base.b[buf >> curbits & mask];
		};
		if (curbits > 0) {
			out.b[pout++] = base.b[buf << nbits - curbits & mask];
		};
		return out;
	}
	initTable() {
		var tbl = new Array();
		var _g = 0;
		while (_g < 256) {
			var i = _g++;
			tbl[i] = -1;
		};
		var _g = 0;
		var _g1 = this.base.length;
		while (_g < _g1) {
			var i = _g++;
			tbl[this.base.b[i]] = i;
		};
		this.tbl = tbl;
	}
	decodeBytes(b) {
		var nbits = this.nbits;
		var base = this.base;
		if (this.tbl == null) {
			this.initTable();
		};
		var tbl = this.tbl;
		var size = b.length * nbits >> 3;
		var out = new Bytes(new ArrayBuffer(size));
		var buf = 0;
		var curbits = 0;
		var pin = 0;
		var pout = 0;
		while (pout < size) {
			while (curbits < 8) {
				curbits += nbits;
				buf <<= nbits;
				var i = tbl[b.b[pin++]];
				if (i == -1) {
					throw Exception.thrown("BaseCode : invalid encoded char");
				};
				buf |= i;
			};
			curbits -= 8;
			out.b[pout++] = buf >> curbits & 255;
		};
		return out;
	}
	encodeString(s) {
		return this.encodeBytes(Bytes.ofString(s)).toString();
	}
	decodeString(s) {
		return this.decodeBytes(Bytes.ofString(s)).toString();
	}
	static encode(s, base) {
		var b = new BaseCode(Bytes.ofString(base));
		return b.encodeString(s);
	}
	static decode(s, base) {
		var b = new BaseCode(Bytes.ofString(base));
		return b.decodeString(s);
	}
	static get __name__() {
		return "haxe.crypto.BaseCode"
	}
	get __class__() {
		return BaseCode
	}
}


//# sourceMappingURL=BaseCode.js.map