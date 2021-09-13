import {Bytes} from "../io/Bytes.js"
import {Register} from "../../genes/Register.js"
import {StringTools} from "../../StringTools.js"

const $global = Register.$global

/**
Creates a Sha1 of a String.
*/
export const Sha1 = Register.global("$hxClasses")["haxe.crypto.Sha1"] = 
class Sha1 extends Register.inherits() {
	new() {
	}
	doEncode(x) {
		var w = new Array();
		var a = 1732584193;
		var b = -271733879;
		var c = -1732584194;
		var d = 271733878;
		var e = -1009589776;
		var i = 0;
		while (i < x.length) {
			var olda = a;
			var oldb = b;
			var oldc = c;
			var oldd = d;
			var olde = e;
			var j = 0;
			while (j < 80) {
				if (j < 16) {
					w[j] = x[i + j];
				} else {
					var num = w[j - 3] ^ w[j - 8] ^ w[j - 14] ^ w[j - 16];
					w[j] = num << 1 | num >>> 31;
				};
				var t = (a << 5 | a >>> 27) + this.ft(j, b, c, d) + e + w[j] + this.kt(j);
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
		var str = "";
		var _g = 0;
		while (_g < a.length) {
			var num = a[_g];
			++_g;
			str += StringTools.hex(num, 8);
		};
		return str.toLowerCase();
	}
	static encode(s) {
		var sh = new Sha1();
		var h = sh.doEncode(Sha1.str2blks(s));
		return sh.hex(h);
	}
	static make(b) {
		var h = new Sha1().doEncode(Sha1.bytes2blks(b));
		var out = new Bytes(new ArrayBuffer(20));
		var p = 0;
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
		var s1 = Bytes.ofString(s);
		var nblk = (s1.length + 8 >> 6) + 1;
		var blks = new Array();
		var _g = 0;
		var _g1 = nblk * 16;
		while (_g < _g1) {
			var i = _g++;
			blks[i] = 0;
		};
		var _g = 0;
		var _g1 = s1.length;
		while (_g < _g1) {
			var i = _g++;
			var p = i >> 2;
			blks[p] |= s1.b[i] << 24 - ((i & 3) << 3);
		};
		var i = s1.length;
		var p = i >> 2;
		blks[p] |= 128 << 24 - ((i & 3) << 3);
		blks[nblk * 16 - 1] = s1.length * 8;
		return blks;
	}
	static bytes2blks(b) {
		var nblk = (b.length + 8 >> 6) + 1;
		var blks = new Array();
		var _g = 0;
		var _g1 = nblk * 16;
		while (_g < _g1) {
			var i = _g++;
			blks[i] = 0;
		};
		var _g = 0;
		var _g1 = b.length;
		while (_g < _g1) {
			var i = _g++;
			var p = i >> 2;
			blks[p] |= b.b[i] << 24 - ((i & 3) << 3);
		};
		var i = b.length;
		var p = i >> 2;
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