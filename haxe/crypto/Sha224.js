import {Bytes} from "../io/Bytes.js"
import {Register} from "../../genes/Register.js"
import {StringTools} from "../../StringTools.js"
import {HxOverrides} from "../../HxOverrides.js"

const $global = Register.$global

/**
Creates a Sha224 of a String.
*/
export const Sha224 = Register.global("$hxClasses")["haxe.crypto.Sha224"] = 
class Sha224 extends Register.inherits() {
	new() {
	}
	doEncode(str, strlen) {
		var K = [1116352408, 1899447441, -1245643825, -373957723, 961987163, 1508970993, -1841331548, -1424204075, -670586216, 310598401, 607225278, 1426881987, 1925078388, -2132889090, -1680079193, -1046744716, -459576895, -272742522, 264347078, 604807628, 770255983, 1249150122, 1555081692, 1996064986, -1740746414, -1473132947, -1341970488, -1084653625, -958395405, -710438585, 113926993, 338241895, 666307205, 773529912, 1294757372, 1396182291, 1695183700, 1986661051, -2117940946, -1838011259, -1564481375, -1474664885, -1035236496, -949202525, -778901479, -694614492, -200395387, 275423344, 430227734, 506948616, 659060556, 883997877, 958139571, 1322822218, 1537002063, 1747873779, 1955562222, 2024104815, -2067236844, -1933114872, -1866530822, -1538233109, -1090935817, -965641998];
		var HASH = [-1056596264, 914150663, 812702999, -150054599, -4191439, 1750603025, 1694076839, -1090891868];
		var W = new Array();
		W[64] = 0;
		var a;
		var b;
		var c;
		var d;
		var e;
		var f;
		var g;
		var h;
		var i;
		var j;
		var T1;
		var T2;
		var i = 0;
		var blocks = Sha224.str2blks(str);
		blocks[strlen >> 5] |= 128 << 24 - strlen % 32;
		blocks[(strlen + 64 >> 9 << 4) + 15] = strlen;
		while (i < blocks.length) {
			a = HASH[0];
			b = HASH[1];
			c = HASH[2];
			d = HASH[3];
			e = HASH[4];
			f = HASH[5];
			g = HASH[6];
			h = HASH[7];
			var _g = 0;
			while (_g < 64) {
				var j = _g++;
				if (j < 16) {
					W[j] = blocks[j + i];
				} else {
					var x = W[j - 2];
					var x1 = (x >>> 17 | x << 15) ^ (x >>> 19 | x << 13) ^ x >>> 10;
					var y = W[j - 7];
					var lsw = (x1 & 65535) + (y & 65535);
					var msw = (x1 >>> 16) + (y >>> 16) + (lsw >>> 16);
					var x2 = (msw & 65535) << 16 | lsw & 65535;
					var x3 = W[j - 15];
					var y1 = (x3 >>> 7 | x3 << 25) ^ (x3 >>> 18 | x3 << 14) ^ x3 >>> 3;
					var lsw1 = (x2 & 65535) + (y1 & 65535);
					var msw1 = (x2 >>> 16) + (y1 >>> 16) + (lsw1 >>> 16);
					var x4 = (msw1 & 65535) << 16 | lsw1 & 65535;
					var y2 = W[j - 16];
					var lsw2 = (x4 & 65535) + (y2 & 65535);
					var msw2 = (x4 >>> 16) + (y2 >>> 16) + (lsw2 >>> 16);
					W[j] = (msw2 & 65535) << 16 | lsw2 & 65535;
				};
				var y3 = (e >>> 6 | e << 26) ^ (e >>> 11 | e << 21) ^ (e >>> 25 | e << 7);
				var lsw3 = (h & 65535) + (y3 & 65535);
				var msw3 = (h >>> 16) + (y3 >>> 16) + (lsw3 >>> 16);
				var x5 = (msw3 & 65535) << 16 | lsw3 & 65535;
				var y4 = e & f ^ ~e & g;
				var lsw4 = (x5 & 65535) + (y4 & 65535);
				var msw4 = (x5 >>> 16) + (y4 >>> 16) + (lsw4 >>> 16);
				var x6 = (msw4 & 65535) << 16 | lsw4 & 65535;
				var y5 = K[j];
				var lsw5 = (x6 & 65535) + (y5 & 65535);
				var msw5 = (x6 >>> 16) + (y5 >>> 16) + (lsw5 >>> 16);
				var x7 = (msw5 & 65535) << 16 | lsw5 & 65535;
				var y6 = W[j];
				var lsw6 = (x7 & 65535) + (y6 & 65535);
				var msw6 = (x7 >>> 16) + (y6 >>> 16) + (lsw6 >>> 16);
				T1 = (msw6 & 65535) << 16 | lsw6 & 65535;
				var x8 = (a >>> 2 | a << 30) ^ (a >>> 13 | a << 19) ^ (a >>> 22 | a << 10);
				var y7 = a & b ^ a & c ^ b & c;
				var lsw7 = (x8 & 65535) + (y7 & 65535);
				var msw7 = (x8 >>> 16) + (y7 >>> 16) + (lsw7 >>> 16);
				T2 = (msw7 & 65535) << 16 | lsw7 & 65535;
				h = g;
				g = f;
				f = e;
				var lsw8 = (d & 65535) + (T1 & 65535);
				var msw8 = (d >>> 16) + (T1 >>> 16) + (lsw8 >>> 16);
				e = (msw8 & 65535) << 16 | lsw8 & 65535;
				d = c;
				c = b;
				b = a;
				var lsw9 = (T1 & 65535) + (T2 & 65535);
				var msw9 = (T1 >>> 16) + (T2 >>> 16) + (lsw9 >>> 16);
				a = (msw9 & 65535) << 16 | lsw9 & 65535;
			};
			var y8 = HASH[0];
			var lsw10 = (a & 65535) + (y8 & 65535);
			var msw10 = (a >>> 16) + (y8 >>> 16) + (lsw10 >>> 16);
			HASH[0] = (msw10 & 65535) << 16 | lsw10 & 65535;
			var y9 = HASH[1];
			var lsw11 = (b & 65535) + (y9 & 65535);
			var msw11 = (b >>> 16) + (y9 >>> 16) + (lsw11 >>> 16);
			HASH[1] = (msw11 & 65535) << 16 | lsw11 & 65535;
			var y10 = HASH[2];
			var lsw12 = (c & 65535) + (y10 & 65535);
			var msw12 = (c >>> 16) + (y10 >>> 16) + (lsw12 >>> 16);
			HASH[2] = (msw12 & 65535) << 16 | lsw12 & 65535;
			var y11 = HASH[3];
			var lsw13 = (d & 65535) + (y11 & 65535);
			var msw13 = (d >>> 16) + (y11 >>> 16) + (lsw13 >>> 16);
			HASH[3] = (msw13 & 65535) << 16 | lsw13 & 65535;
			var y12 = HASH[4];
			var lsw14 = (e & 65535) + (y12 & 65535);
			var msw14 = (e >>> 16) + (y12 >>> 16) + (lsw14 >>> 16);
			HASH[4] = (msw14 & 65535) << 16 | lsw14 & 65535;
			var y13 = HASH[5];
			var lsw15 = (f & 65535) + (y13 & 65535);
			var msw15 = (f >>> 16) + (y13 >>> 16) + (lsw15 >>> 16);
			HASH[5] = (msw15 & 65535) << 16 | lsw15 & 65535;
			var y14 = HASH[6];
			var lsw16 = (g & 65535) + (y14 & 65535);
			var msw16 = (g >>> 16) + (y14 >>> 16) + (lsw16 >>> 16);
			HASH[6] = (msw16 & 65535) << 16 | lsw16 & 65535;
			var y15 = HASH[7];
			var lsw17 = (h & 65535) + (y15 & 65535);
			var msw17 = (h >>> 16) + (y15 >>> 16) + (lsw17 >>> 16);
			HASH[7] = (msw17 & 65535) << 16 | lsw17 & 65535;
			i += 16;
		};
		return HASH;
	}
	hex(a) {
		var str = "";
		var _g = 0;
		while (_g < a.length) {
			var num = a[_g];
			++_g;
			str += StringTools.hex(num, 8);
		};
		return str.substring(0, 56).toLowerCase();
	}
	static encode(s) {
		var sh = new Sha224();
		var h = sh.doEncode(s, s.length * 8);
		return sh.hex(h);
	}
	static make(b) {
		var h = new Sha224().doEncode(b.toString(), b.length * 8);
		var out = new Bytes(new ArrayBuffer(28));
		var p = 0;
		var _g = 0;
		while (_g < 8) {
			var i = _g++;
			out.b[p++] = h[i] >>> 24;
			out.b[p++] = h[i] >> 16 & 255;
			out.b[p++] = h[i] >> 8 & 255;
			out.b[p++] = h[i] & 255;
		};
		return out;
	}
	static str2blks(s) {
		var nblk = (s.length + 8 >> 6) + 1;
		var blks = new Array();
		var _g = 0;
		var _g1 = nblk * 16;
		while (_g < _g1) {
			var i = _g++;
			blks[i] = 0;
		};
		var _g = 0;
		var _g1 = s.length;
		while (_g < _g1) {
			var i = _g++;
			var p = i >> 2;
			blks[p] |= HxOverrides.cca(s, i) << 24 - ((i & 3) << 3);
		};
		var i = s.length;
		var p = i >> 2;
		blks[p] |= 128 << 24 - ((i & 3) << 3);
		blks[nblk * 16 - 1] = s.length * 8;
		return blks;
	}
	static get __name__() {
		return "haxe.crypto.Sha224"
	}
	get __class__() {
		return Sha224
	}
}


//# sourceMappingURL=Sha224.js.map