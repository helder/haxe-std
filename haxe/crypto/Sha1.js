import {Bytes} from "../io/Bytes.js"
import {Register} from "../../genes/Register.js"
import {StringTools} from "../../StringTools.js"

/**
Creates a Sha1 of a String.
*/
export const Sha1 = Register.global("$hxClasses")["haxe.crypto.Sha1"] = 
class Sha1 extends Register.inherits() {
	new() {
	}
	doEncode(x) {
		let w = new Array();
		let a = 1732584193;
		let b = -271733879;
		let c = -1732584194;
		let d = 271733878;
		let e = -1009589776;
		let i = 0;
		while (i < x.length) {
			let olda = a;
			let oldb = b;
			let oldc = c;
			let oldd = d;
			let olde = e;
			let j = 0;
			while (j < 80) {
				if (j < 16) {
					w[j] = x[i + j];
				} else {
					let num = w[j - 3] ^ w[j - 8] ^ w[j - 14] ^ w[j - 16];
					w[j] = num << 1 | num >>> 31;
				};
				let t = (a << 5 | a >>> 27) + this.ft(j, b, c, d) + e + w[j] + this.kt(j);
				e = d;
				d = c;
				c = b << 30 | b >>> 2;
				b = a;
				a = t;
				++j;
			};
			a += olda;
			b += oldb;
			c += oldc;
			d += oldd;
			e += olde;
			i += 16;
		};
		return [a, b, c, d, e];
	}
	
	/**
	Bitwise rotate a 32-bit number to the left
	*/
	rol(num, cnt) {
		return num << cnt | num >>> 32 - cnt;
	}
	
	/**
	Perform the appropriate triplet combination function for the current iteration
	*/
	ft(t, b, c, d) {
		if (t < 20) {
			return b & c | ~b & d;
		};
		if (t < 40) {
			return b ^ c ^ d;
		};
		if (t < 60) {
			return b & c | b & d | c & d;
		};
		return b ^ c ^ d;
	}
	
	/**
	Determine the appropriate additive constant for the current iteration
	*/
	kt(t) {
		if (t < 20) {
			return 1518500249;
		};
		if (t < 40) {
			return 1859775393;
		};
		if (t < 60) {
			return -1894007588;
		};
		return -899497514;
	}
	hex(a) {
		let str = "";
		let _g = 0;
		while (_g < a.length) {
			let num = a[_g];
			++_g;
			str += StringTools.hex(num, 8);
		};
		return str.toLowerCase();
	}
	static encode(s) {
		let sh = new Sha1();
		let h = sh.doEncode(Sha1.str2blks(s));
		return sh.hex(h);
	}
	static make(b) {
		let h = new Sha1().doEncode(Sha1.bytes2blks(b));
		let out = new Bytes(new ArrayBuffer(20));
		let p = 0;
		out.b[p++] = h[0] >>> 24;
		out.b[p++] = h[0] >> 16 & 255;
		out.b[p++] = h[0] >> 8 & 255;
		out.b[p++] = h[0] & 255;
		out.b[p++] = h[1] >>> 24;
		out.b[p++] = h[1] >> 16 & 255;
		out.b[p++] = h[1] >> 8 & 255;
		out.b[p++] = h[1] & 255;
		out.b[p++] = h[2] >>> 24;
		out.b[p++] = h[2] >> 16 & 255;
		out.b[p++] = h[2] >> 8 & 255;
		out.b[p++] = h[2] & 255;
		out.b[p++] = h[3] >>> 24;
		out.b[p++] = h[3] >> 16 & 255;
		out.b[p++] = h[3] >> 8 & 255;
		out.b[p++] = h[3] & 255;
		out.b[p++] = h[4] >>> 24;
		out.b[p++] = h[4] >> 16 & 255;
		out.b[p++] = h[4] >> 8 & 255;
		out.b[p++] = h[4] & 255;
		return out;
	}
	
	/**
	Convert a string to a sequence of 16-word blocks, stored as an array.
	Append padding bits and the length, as described in the SHA1 standard.
	*/
	static str2blks(s) {
		let s1 = Bytes.ofString(s);
		let nblk = (s1.length + 8 >> 6) + 1;
		let blks = new Array();
		let _g = 0;
		let _g1 = nblk * 16;
		while (_g < _g1) {
			let i = _g++;
			blks[i] = 0;
		};
		let _g2 = 0;
		let _g3 = s1.length;
		while (_g2 < _g3) {
			let i = _g2++;
			let p = i >> 2;
			blks[p] |= s1.b[i] << 24 - ((i & 3) << 3);
		};
		let i = s1.length;
		let p = i >> 2;
		blks[p] |= 128 << 24 - ((i & 3) << 3);
		blks[nblk * 16 - 1] = s1.length * 8;
		return blks;
	}
	static bytes2blks(b) {
		let nblk = (b.length + 8 >> 6) + 1;
		let blks = new Array();
		let _g = 0;
		let _g1 = nblk * 16;
		while (_g < _g1) {
			let i = _g++;
			blks[i] = 0;
		};
		let _g2 = 0;
		let _g3 = b.length;
		while (_g2 < _g3) {
			let i = _g2++;
			let p = i >> 2;
			blks[p] |= b.b[i] << 24 - ((i & 3) << 3);
		};
		let i = b.length;
		let p = i >> 2;
		blks[p] |= 128 << 24 - ((i & 3) << 3);
		blks[nblk * 16 - 1] = b.length * 8;
		return blks;
	}
	static get __name__() {
		return "haxe.crypto.Sha1"
	}
	get __class__() {
		return Sha1
	}
}


//# sourceMappingURL=Sha1.js.map