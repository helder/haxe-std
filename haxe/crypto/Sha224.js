import {Bytes} from "../io/Bytes.js"
import {Register} from "../../genes/Register.js"
import {StringTools} from "../../StringTools.js"
import {HxOverrides} from "../../HxOverrides.js"

/**
Creates a Sha224 of a String.
*/
export const Sha224 = Register.global("$hxClasses")["haxe.crypto.Sha224"] = 
class Sha224 extends Register.inherits() {
	new() {
	}
	doEncode(str, strlen) {
		let K = [1116352408, 1899447441, -1245643825, -373957723, 961987163, 1508970993, -1841331548, -1424204075, -670586216, 310598401, 607225278, 1426881987, 1925078388, -2132889090, -1680079193, -1046744716, -459576895, -272742522, 264347078, 604807628, 770255983, 1249150122, 1555081692, 1996064986, -1740746414, -1473132947, -1341970488, -1084653625, -958395405, -710438585, 113926993, 338241895, 666307205, 773529912, 1294757372, 1396182291, 1695183700, 1986661051, -2117940946, -1838011259, -1564481375, -1474664885, -1035236496, -949202525, -778901479, -694614492, -200395387, 275423344, 430227734, 506948616, 659060556, 883997877, 958139571, 1322822218, 1537002063, 1747873779, 1955562222, 2024104815, -2067236844, -1933114872, -1866530822, -1538233109, -1090935817, -965641998];
		let HASH = [-1056596264, 914150663, 812702999, -150054599, -4191439, 1750603025, 1694076839, -1090891868];
		let W = new Array();
		W[64] = 0;
		let a;
		let b;
		let c;
		let d;
		let e;
		let f;
		let g;
		let h;
		let i;
		let j;
		let T1;
		let T2;
		let i1 = 0;
		let blocks = Sha224.str2blks(str);
		blocks[strlen >> 5] |= 128 << 24 - strlen % 32;
		blocks[(strlen + 64 >> 9 << 4) + 15] = strlen;
		while (i1 < blocks.length) {
			a = HASH[0];
			b = HASH[1];
			c = HASH[2];
			d = HASH[3];
			e = HASH[4];
			f = HASH[5];
			g = HASH[6];
			h = HASH[7];
			let _g = 0;
			while (_g < 64) {
				let j = _g++;
				if (j < 16) {
					W[j] = blocks[j + i1];
				} else {
					let x = W[j - 2];
					let x1 = (x >>> 17 | x << 15) ^ (x >>> 19 | x << 13) ^ x >>> 10;
					let y = W[j - 7];
					let lsw = (x1 & 65535) + (y & 65535);
					let msw = (x1 >>> 16) + (y >>> 16) + (lsw >>> 16);
					let x2 = (msw & 65535) << 16 | lsw & 65535;
					let x3 = W[j - 15];
					let y1 = (x3 >>> 7 | x3 << 25) ^ (x3 >>> 18 | x3 << 14) ^ x3 >>> 3;
					let lsw1 = (x2 & 65535) + (y1 & 65535);
					let msw1 = (x2 >>> 16) + (y1 >>> 16) + (lsw1 >>> 16);
					let x4 = (msw1 & 65535) << 16 | lsw1 & 65535;
					let y2 = W[j - 16];
					let lsw2 = (x4 & 65535) + (y2 & 65535);
					let msw2 = (x4 >>> 16) + (y2 >>> 16) + (lsw2 >>> 16);
					W[j] = (msw2 & 65535) << 16 | lsw2 & 65535;
				};
				let y = (e >>> 6 | e << 26) ^ (e >>> 11 | e << 21) ^ (e >>> 25 | e << 7);
				let lsw = (h & 65535) + (y & 65535);
				let msw = (h >>> 16) + (y >>> 16) + (lsw >>> 16);
				let x = (msw & 65535) << 16 | lsw & 65535;
				let y1 = e & f ^ ~e & g;
				let lsw1 = (x & 65535) + (y1 & 65535);
				let msw1 = (x >>> 16) + (y1 >>> 16) + (lsw1 >>> 16);
				let x1 = (msw1 & 65535) << 16 | lsw1 & 65535;
				let y2 = K[j];
				let lsw2 = (x1 & 65535) + (y2 & 65535);
				let msw2 = (x1 >>> 16) + (y2 >>> 16) + (lsw2 >>> 16);
				let x2 = (msw2 & 65535) << 16 | lsw2 & 65535;
				let y3 = W[j];
				let lsw3 = (x2 & 65535) + (y3 & 65535);
				let msw3 = (x2 >>> 16) + (y3 >>> 16) + (lsw3 >>> 16);
				T1 = (msw3 & 65535) << 16 | lsw3 & 65535;
				let x3 = (a >>> 2 | a << 30) ^ (a >>> 13 | a << 19) ^ (a >>> 22 | a << 10);
				let y4 = a & b ^ a & c ^ b & c;
				let lsw4 = (x3 & 65535) + (y4 & 65535);
				let msw4 = (x3 >>> 16) + (y4 >>> 16) + (lsw4 >>> 16);
				T2 = (msw4 & 65535) << 16 | lsw4 & 65535;
				h = g;
				g = f;
				f = e;
				let lsw5 = (d & 65535) + (T1 & 65535);
				let msw5 = (d >>> 16) + (T1 >>> 16) + (lsw5 >>> 16);
				e = (msw5 & 65535) << 16 | lsw5 & 65535;
				d = c;
				c = b;
				b = a;
				let lsw6 = (T1 & 65535) + (T2 & 65535);
				let msw6 = (T1 >>> 16) + (T2 >>> 16) + (lsw6 >>> 16);
				a = (msw6 & 65535) << 16 | lsw6 & 65535;
			};
			let y = HASH[0];
			let lsw = (a & 65535) + (y & 65535);
			let msw = (a >>> 16) + (y >>> 16) + (lsw >>> 16);
			HASH[0] = (msw & 65535) << 16 | lsw & 65535;
			let y1 = HASH[1];
			let lsw1 = (b & 65535) + (y1 & 65535);
			let msw1 = (b >>> 16) + (y1 >>> 16) + (lsw1 >>> 16);
			HASH[1] = (msw1 & 65535) << 16 | lsw1 & 65535;
			let y2 = HASH[2];
			let lsw2 = (c & 65535) + (y2 & 65535);
			let msw2 = (c >>> 16) + (y2 >>> 16) + (lsw2 >>> 16);
			HASH[2] = (msw2 & 65535) << 16 | lsw2 & 65535;
			let y3 = HASH[3];
			let lsw3 = (d & 65535) + (y3 & 65535);
			let msw3 = (d >>> 16) + (y3 >>> 16) + (lsw3 >>> 16);
			HASH[3] = (msw3 & 65535) << 16 | lsw3 & 65535;
			let y4 = HASH[4];
			let lsw4 = (e & 65535) + (y4 & 65535);
			let msw4 = (e >>> 16) + (y4 >>> 16) + (lsw4 >>> 16);
			HASH[4] = (msw4 & 65535) << 16 | lsw4 & 65535;
			let y5 = HASH[5];
			let lsw5 = (f & 65535) + (y5 & 65535);
			let msw5 = (f >>> 16) + (y5 >>> 16) + (lsw5 >>> 16);
			HASH[5] = (msw5 & 65535) << 16 | lsw5 & 65535;
			let y6 = HASH[6];
			let lsw6 = (g & 65535) + (y6 & 65535);
			let msw6 = (g >>> 16) + (y6 >>> 16) + (lsw6 >>> 16);
			HASH[6] = (msw6 & 65535) << 16 | lsw6 & 65535;
			let y7 = HASH[7];
			let lsw7 = (h & 65535) + (y7 & 65535);
			let msw7 = (h >>> 16) + (y7 >>> 16) + (lsw7 >>> 16);
			HASH[7] = (msw7 & 65535) << 16 | lsw7 & 65535;
			i1 += 16;
		};
		return HASH;
	}
	hex(a) {
		let str = "";
		let _g = 0;
		while (_g < a.length) {
			let num = a[_g];
			++_g;
			str += StringTools.hex(num, 8);
		};
		return str.substring(0, 56).toLowerCase();
	}
	static encode(s) {
		let sh = new Sha224();
		let h = sh.doEncode(s, s.length * 8);
		return sh.hex(h);
	}
	static make(b) {
		let h = new Sha224().doEncode(b.toString(), b.length * 8);
		let out = new Bytes(new ArrayBuffer(28));
		let p = 0;
		let _g = 0;
		while (_g < 8) {
			let i = _g++;
			out.b[p++] = h[i] >>> 24;
			out.b[p++] = h[i] >> 16 & 255;
			out.b[p++] = h[i] >> 8 & 255;
			out.b[p++] = h[i] & 255;
		};
		return out;
	}
	static str2blks(s) {
		let nblk = (s.length + 8 >> 6) + 1;
		let blks = new Array();
		let _g = 0;
		let _g1 = nblk * 16;
		while (_g < _g1) {
			let i = _g++;
			blks[i] = 0;
		};
		let _g2 = 0;
		let _g3 = s.length;
		while (_g2 < _g3) {
			let i = _g2++;
			let p = i >> 2;
			blks[p] |= HxOverrides.cca(s, i) << 24 - ((i & 3) << 3);
		};
		let i = s.length;
		let p = i >> 2;
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