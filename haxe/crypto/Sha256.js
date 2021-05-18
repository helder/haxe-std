import {Bytes} from "../io/Bytes.js"
import {Register} from "../../genes/Register.js"
import {StringTools} from "../../StringTools.js"

/**
Creates a Sha256 of a String.
*/
export const Sha256 = Register.global("$hxClasses")["haxe.crypto.Sha256"] = 
class Sha256 extends Register.inherits() {
	new() {
	}
	doEncode(m, l) {
		let K = [1116352408, 1899447441, -1245643825, -373957723, 961987163, 1508970993, -1841331548, -1424204075, -670586216, 310598401, 607225278, 1426881987, 1925078388, -2132889090, -1680079193, -1046744716, -459576895, -272742522, 264347078, 604807628, 770255983, 1249150122, 1555081692, 1996064986, -1740746414, -1473132947, -1341970488, -1084653625, -958395405, -710438585, 113926993, 338241895, 666307205, 773529912, 1294757372, 1396182291, 1695183700, 1986661051, -2117940946, -1838011259, -1564481375, -1474664885, -1035236496, -949202525, -778901479, -694614492, -200395387, 275423344, 430227734, 506948616, 659060556, 883997877, 958139571, 1322822218, 1537002063, 1747873779, 1955562222, 2024104815, -2067236844, -1933114872, -1866530822, -1538233109, -1090935817, -965641998];
		let HASH = [1779033703, -1150833019, 1013904242, -1521486534, 1359893119, -1694144372, 528734635, 1541459225];
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
		let T1;
		let T2;
		m[l >> 5] |= 128 << 24 - l % 32;
		m[(l + 64 >> 9 << 4) + 15] = l;
		let i = 0;
		while (i < m.length) {
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
					W[j] = m[j + i];
				} else {
					let x = W[j - 2];
					let x1 = (x >>> 17 | x << 15) ^ (x >>> 19 | x << 13) ^ x >>> 10;
					let y = W[j - 7];
					let lsw = (x1 & 65535) + (y & 65535);
					let msw = (x1 >> 16) + (y >> 16) + (lsw >> 16);
					let x2 = msw << 16 | lsw & 65535;
					let x3 = W[j - 15];
					let y1 = (x3 >>> 7 | x3 << 25) ^ (x3 >>> 18 | x3 << 14) ^ x3 >>> 3;
					let lsw1 = (x2 & 65535) + (y1 & 65535);
					let msw1 = (x2 >> 16) + (y1 >> 16) + (lsw1 >> 16);
					let x4 = msw1 << 16 | lsw1 & 65535;
					let y2 = W[j - 16];
					let lsw2 = (x4 & 65535) + (y2 & 65535);
					let msw2 = (x4 >> 16) + (y2 >> 16) + (lsw2 >> 16);
					W[j] = msw2 << 16 | lsw2 & 65535;
				};
				let y = (e >>> 6 | e << 26) ^ (e >>> 11 | e << 21) ^ (e >>> 25 | e << 7);
				let lsw = (h & 65535) + (y & 65535);
				let msw = (h >> 16) + (y >> 16) + (lsw >> 16);
				let x = msw << 16 | lsw & 65535;
				let y1 = e & f ^ ~e & g;
				let lsw1 = (x & 65535) + (y1 & 65535);
				let msw1 = (x >> 16) + (y1 >> 16) + (lsw1 >> 16);
				let x1 = msw1 << 16 | lsw1 & 65535;
				let y2 = K[j];
				let lsw2 = (x1 & 65535) + (y2 & 65535);
				let msw2 = (x1 >> 16) + (y2 >> 16) + (lsw2 >> 16);
				let x2 = msw2 << 16 | lsw2 & 65535;
				let y3 = W[j];
				let lsw3 = (x2 & 65535) + (y3 & 65535);
				let msw3 = (x2 >> 16) + (y3 >> 16) + (lsw3 >> 16);
				T1 = msw3 << 16 | lsw3 & 65535;
				let x3 = (a >>> 2 | a << 30) ^ (a >>> 13 | a << 19) ^ (a >>> 22 | a << 10);
				let y4 = a & b ^ a & c ^ b & c;
				let lsw4 = (x3 & 65535) + (y4 & 65535);
				let msw4 = (x3 >> 16) + (y4 >> 16) + (lsw4 >> 16);
				T2 = msw4 << 16 | lsw4 & 65535;
				h = g;
				g = f;
				f = e;
				let lsw5 = (d & 65535) + (T1 & 65535);
				let msw5 = (d >> 16) + (T1 >> 16) + (lsw5 >> 16);
				e = msw5 << 16 | lsw5 & 65535;
				d = c;
				c = b;
				b = a;
				let lsw6 = (T1 & 65535) + (T2 & 65535);
				let msw6 = (T1 >> 16) + (T2 >> 16) + (lsw6 >> 16);
				a = msw6 << 16 | lsw6 & 65535;
			};
			let y = HASH[0];
			let lsw = (a & 65535) + (y & 65535);
			let msw = (a >> 16) + (y >> 16) + (lsw >> 16);
			HASH[0] = msw << 16 | lsw & 65535;
			let y1 = HASH[1];
			let lsw1 = (b & 65535) + (y1 & 65535);
			let msw1 = (b >> 16) + (y1 >> 16) + (lsw1 >> 16);
			HASH[1] = msw1 << 16 | lsw1 & 65535;
			let y2 = HASH[2];
			let lsw2 = (c & 65535) + (y2 & 65535);
			let msw2 = (c >> 16) + (y2 >> 16) + (lsw2 >> 16);
			HASH[2] = msw2 << 16 | lsw2 & 65535;
			let y3 = HASH[3];
			let lsw3 = (d & 65535) + (y3 & 65535);
			let msw3 = (d >> 16) + (y3 >> 16) + (lsw3 >> 16);
			HASH[3] = msw3 << 16 | lsw3 & 65535;
			let y4 = HASH[4];
			let lsw4 = (e & 65535) + (y4 & 65535);
			let msw4 = (e >> 16) + (y4 >> 16) + (lsw4 >> 16);
			HASH[4] = msw4 << 16 | lsw4 & 65535;
			let y5 = HASH[5];
			let lsw5 = (f & 65535) + (y5 & 65535);
			let msw5 = (f >> 16) + (y5 >> 16) + (lsw5 >> 16);
			HASH[5] = msw5 << 16 | lsw5 & 65535;
			let y6 = HASH[6];
			let lsw6 = (g & 65535) + (y6 & 65535);
			let msw6 = (g >> 16) + (y6 >> 16) + (lsw6 >> 16);
			HASH[6] = msw6 << 16 | lsw6 & 65535;
			let y7 = HASH[7];
			let lsw7 = (h & 65535) + (y7 & 65535);
			let msw7 = (h >> 16) + (y7 >> 16) + (lsw7 >> 16);
			HASH[7] = msw7 << 16 | lsw7 & 65535;
			i += 16;
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
		return str.toLowerCase();
	}
	static encode(s) {
		let sh = new Sha256();
		let h = sh.doEncode(Sha256.str2blks(s), s.length * 8);
		return sh.hex(h);
	}
	static make(b) {
		let h = new Sha256().doEncode(Sha256.bytes2blks(b), b.length * 8);
		let out = new Bytes(new ArrayBuffer(32));
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
		return "haxe.crypto.Sha256"
	}
	get __class__() {
		return Sha256
	}
}


//# sourceMappingURL=Sha256.js.map