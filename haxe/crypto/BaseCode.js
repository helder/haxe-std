import {Bytes} from "../io/Bytes.js"
import {Exception} from "../Exception.js"
import {Register} from "../../genes/Register.js"

/**
Allows one to encode/decode String and bytes using a power of two base dictionary.
*/
export const BaseCode = Register.global("$hxClasses")["haxe.crypto.BaseCode"] = 
class BaseCode extends Register.inherits() {
	new(base) {
		let len = base.length;
		let nbits = 1;
		while (len > 1 << nbits) ++nbits;
		if (nbits > 8 || len != 1 << nbits) {
			throw Exception.thrown("BaseCode : base length must be a power of two.");
		};
		this.base = base;
		this.nbits = nbits;
	}
	encodeBytes(b) {
		let nbits = this.nbits;
		let base = this.base;
		let size = b.length * 8 / nbits | 0;
		let out = new Bytes(new ArrayBuffer(size + ((b.length * 8 % nbits == 0) ? 0 : 1)));
		let buf = 0;
		let curbits = 0;
		let mask = (1 << nbits) - 1;
		let pin = 0;
		let pout = 0;
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
		let tbl = new Array();
		let _g = 0;
		while (_g < 256) {
			let i = _g++;
			tbl[i] = -1;
		};
		let _g1 = 0;
		let _g2 = this.base.length;
		while (_g1 < _g2) {
			let i = _g1++;
			tbl[this.base.b[i]] = i;
		};
		this.tbl = tbl;
	}
	decodeBytes(b) {
		let nbits = this.nbits;
		let base = this.base;
		if (this.tbl == null) {
			this.initTable();
		};
		let tbl = this.tbl;
		let size = b.length * nbits >> 3;
		let out = new Bytes(new ArrayBuffer(size));
		let buf = 0;
		let curbits = 0;
		let pin = 0;
		let pout = 0;
		while (pout < size) {
			while (curbits < 8) {
				curbits += nbits;
				buf <<= nbits;
				let i = tbl[b.b[pin++]];
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
		let b = new BaseCode(Bytes.ofString(base));
		return b.encodeString(s);
	}
	static decode(s, base) {
		let b = new BaseCode(Bytes.ofString(base));
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