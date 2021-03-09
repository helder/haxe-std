import {Bytes} from "../io/Bytes"
import {Register} from "../../genes/Register"

/**
Creates a MD5 of a String.
*/
export const Md5 = Register.global("$hxClasses")["haxe.crypto.Md5"] = 
class Md5 extends Register.inherits() {
	new() {
	}
	bitOR(a, b) {
		let lsb = a & 1 | b & 1;
		let msb31 = a >>> 1 | b >>> 1;
		return msb31 << 1 | lsb;
	}
	bitXOR(a, b) {
		let lsb = a & 1 ^ b & 1;
		let msb31 = a >>> 1 ^ b >>> 1;
		return msb31 << 1 | lsb;
	}
	bitAND(a, b) {
		let lsb = a & 1 & (b & 1);
		let msb31 = a >>> 1 & b >>> 1;
		return msb31 << 1 | lsb;
	}
	addme(x, y) {
		let lsw = (x & 65535) + (y & 65535);
		let msw = (x >> 16) + (y >> 16) + (lsw >> 16);
		return msw << 16 | lsw & 65535;
	}
	hex(a) {
		let str = "";
		let hex_chr = "0123456789abcdef";
		let _g = 0;
		while (_g < a.length) {
			let num = a[_g];
			++_g;
			str += hex_chr.charAt(num >> 4 & 15) + hex_chr.charAt(num & 15);
			str += hex_chr.charAt(num >> 12 & 15) + hex_chr.charAt(num >> 8 & 15);
			str += hex_chr.charAt(num >> 20 & 15) + hex_chr.charAt(num >> 16 & 15);
			str += hex_chr.charAt(num >> 28 & 15) + hex_chr.charAt(num >> 24 & 15);
		};
		return str;
	}
	rol(num, cnt) {
		return num << cnt | num >>> 32 - cnt;
	}
	cmn(q, a, b, x, s, t) {
		return this.addme(this.rol(this.addme(this.addme(a, q), this.addme(x, t)), s), b);
	}
	ff(a, b, c, d, x, s, t) {
		return this.cmn(this.bitOR(this.bitAND(b, c), this.bitAND(~b, d)), a, b, x, s, t);
	}
	gg(a, b, c, d, x, s, t) {
		return this.cmn(this.bitOR(this.bitAND(b, d), this.bitAND(c, ~d)), a, b, x, s, t);
	}
	hh(a, b, c, d, x, s, t) {
		return this.cmn(this.bitXOR(this.bitXOR(b, c), d), a, b, x, s, t);
	}
	ii(a, b, c, d, x, s, t) {
		return this.cmn(this.bitXOR(c, this.bitOR(b, ~d)), a, b, x, s, t);
	}
	doEncode(x) {
		let a = 1732584193;
		let b = -271733879;
		let c = -1732584194;
		let d = 271733878;
		let step;
		let i = 0;
		while (i < x.length) {
			let olda = a;
			let oldb = b;
			let oldc = c;
			let oldd = d;
			step = 0;
			a = this.ff(a, b, c, d, x[i], 7, -680876936);
			d = this.ff(d, a, b, c, x[i + 1], 12, -389564586);
			c = this.ff(c, d, a, b, x[i + 2], 17, 606105819);
			b = this.ff(b, c, d, a, x[i + 3], 22, -1044525330);
			a = this.ff(a, b, c, d, x[i + 4], 7, -176418897);
			d = this.ff(d, a, b, c, x[i + 5], 12, 1200080426);
			c = this.ff(c, d, a, b, x[i + 6], 17, -1473231341);
			b = this.ff(b, c, d, a, x[i + 7], 22, -45705983);
			a = this.ff(a, b, c, d, x[i + 8], 7, 1770035416);
			d = this.ff(d, a, b, c, x[i + 9], 12, -1958414417);
			c = this.ff(c, d, a, b, x[i + 10], 17, -42063);
			b = this.ff(b, c, d, a, x[i + 11], 22, -1990404162);
			a = this.ff(a, b, c, d, x[i + 12], 7, 1804603682);
			d = this.ff(d, a, b, c, x[i + 13], 12, -40341101);
			c = this.ff(c, d, a, b, x[i + 14], 17, -1502002290);
			b = this.ff(b, c, d, a, x[i + 15], 22, 1236535329);
			a = this.gg(a, b, c, d, x[i + 1], 5, -165796510);
			d = this.gg(d, a, b, c, x[i + 6], 9, -1069501632);
			c = this.gg(c, d, a, b, x[i + 11], 14, 643717713);
			b = this.gg(b, c, d, a, x[i], 20, -373897302);
			a = this.gg(a, b, c, d, x[i + 5], 5, -701558691);
			d = this.gg(d, a, b, c, x[i + 10], 9, 38016083);
			c = this.gg(c, d, a, b, x[i + 15], 14, -660478335);
			b = this.gg(b, c, d, a, x[i + 4], 20, -405537848);
			a = this.gg(a, b, c, d, x[i + 9], 5, 568446438);
			d = this.gg(d, a, b, c, x[i + 14], 9, -1019803690);
			c = this.gg(c, d, a, b, x[i + 3], 14, -187363961);
			b = this.gg(b, c, d, a, x[i + 8], 20, 1163531501);
			a = this.gg(a, b, c, d, x[i + 13], 5, -1444681467);
			d = this.gg(d, a, b, c, x[i + 2], 9, -51403784);
			c = this.gg(c, d, a, b, x[i + 7], 14, 1735328473);
			b = this.gg(b, c, d, a, x[i + 12], 20, -1926607734);
			a = this.hh(a, b, c, d, x[i + 5], 4, -378558);
			d = this.hh(d, a, b, c, x[i + 8], 11, -2022574463);
			c = this.hh(c, d, a, b, x[i + 11], 16, 1839030562);
			b = this.hh(b, c, d, a, x[i + 14], 23, -35309556);
			a = this.hh(a, b, c, d, x[i + 1], 4, -1530992060);
			d = this.hh(d, a, b, c, x[i + 4], 11, 1272893353);
			c = this.hh(c, d, a, b, x[i + 7], 16, -155497632);
			b = this.hh(b, c, d, a, x[i + 10], 23, -1094730640);
			a = this.hh(a, b, c, d, x[i + 13], 4, 681279174);
			d = this.hh(d, a, b, c, x[i], 11, -358537222);
			c = this.hh(c, d, a, b, x[i + 3], 16, -722521979);
			b = this.hh(b, c, d, a, x[i + 6], 23, 76029189);
			a = this.hh(a, b, c, d, x[i + 9], 4, -640364487);
			d = this.hh(d, a, b, c, x[i + 12], 11, -421815835);
			c = this.hh(c, d, a, b, x[i + 15], 16, 530742520);
			b = this.hh(b, c, d, a, x[i + 2], 23, -995338651);
			a = this.ii(a, b, c, d, x[i], 6, -198630844);
			d = this.ii(d, a, b, c, x[i + 7], 10, 1126891415);
			c = this.ii(c, d, a, b, x[i + 14], 15, -1416354905);
			b = this.ii(b, c, d, a, x[i + 5], 21, -57434055);
			a = this.ii(a, b, c, d, x[i + 12], 6, 1700485571);
			d = this.ii(d, a, b, c, x[i + 3], 10, -1894986606);
			c = this.ii(c, d, a, b, x[i + 10], 15, -1051523);
			b = this.ii(b, c, d, a, x[i + 1], 21, -2054922799);
			a = this.ii(a, b, c, d, x[i + 8], 6, 1873313359);
			d = this.ii(d, a, b, c, x[i + 15], 10, -30611744);
			c = this.ii(c, d, a, b, x[i + 6], 15, -1560198380);
			b = this.ii(b, c, d, a, x[i + 13], 21, 1309151649);
			a = this.ii(a, b, c, d, x[i + 4], 6, -145523070);
			d = this.ii(d, a, b, c, x[i + 11], 10, -1120210379);
			c = this.ii(c, d, a, b, x[i + 2], 15, 718787259);
			b = this.ii(b, c, d, a, x[i + 9], 21, -343485551);
			a = this.addme(a, olda);
			b = this.addme(b, oldb);
			c = this.addme(c, oldc);
			d = this.addme(d, oldd);
			i += 16;
		};
		return [a, b, c, d];
	}
	static encode(s) {
		let m = new Md5();
		let h = m.doEncode(Md5.str2blks(s));
		return m.hex(h);
	}
	static make(b) {
		let h = new Md5().doEncode(Md5.bytes2blks(b));
		let out = new Bytes(new ArrayBuffer(16));
		let p = 0;
		out.b[p++] = h[0] & 255;
		out.b[p++] = h[0] >> 8 & 255;
		out.b[p++] = h[0] >> 16 & 255;
		out.b[p++] = h[0] >>> 24;
		out.b[p++] = h[1] & 255;
		out.b[p++] = h[1] >> 8 & 255;
		out.b[p++] = h[1] >> 16 & 255;
		out.b[p++] = h[1] >>> 24;
		out.b[p++] = h[2] & 255;
		out.b[p++] = h[2] >> 8 & 255;
		out.b[p++] = h[2] >> 16 & 255;
		out.b[p++] = h[2] >>> 24;
		out.b[p++] = h[3] & 255;
		out.b[p++] = h[3] >> 8 & 255;
		out.b[p++] = h[3] >> 16 & 255;
		out.b[p++] = h[3] >>> 24;
		return out;
	}
	static bytes2blks(b) {
		let nblk = (b.length + 8 >> 6) + 1;
		let blks = new Array();
		let blksSize = nblk * 16;
		let _g = 0;
		let _g1 = blksSize;
		while (_g < _g1) {
			let i = _g++;
			blks[i] = 0;
		};
		let i = 0;
		while (i < b.length) {
			blks[i >> 2] |= b.b[i] << (((b.length << 3) + i & 3) << 3);
			++i;
		};
		blks[i >> 2] |= 128 << (b.length * 8 + i) % 4 * 8;
		let l = b.length * 8;
		let k = nblk * 16 - 2;
		blks[k] = l & 255;
		blks[k] |= (l >>> 8 & 255) << 8;
		blks[k] |= (l >>> 16 & 255) << 16;
		blks[k] |= (l >>> 24 & 255) << 24;
		return blks;
	}
	static str2blks(str) {
		let str1 = Bytes.ofString(str);
		let nblk = (str1.length + 8 >> 6) + 1;
		let blks = new Array();
		let blksSize = nblk * 16;
		let _g = 0;
		let _g1 = blksSize;
		while (_g < _g1) {
			let i = _g++;
			blks[i] = 0;
		};
		let i = 0;
		let max = str1.length;
		let l = max * 8;
		while (i < max) {
			blks[i >> 2] |= str1.b[i] << (l + i) % 4 * 8;
			++i;
		};
		blks[i >> 2] |= 128 << (l + i) % 4 * 8;
		let k = nblk * 16 - 2;
		blks[k] = l & 255;
		blks[k] |= (l >>> 8 & 255) << 8;
		blks[k] |= (l >>> 16 & 255) << 16;
		blks[k] |= (l >>> 24 & 255) << 24;
		return blks;
	}
	static get __name__() {
		return "haxe.crypto.Md5"
	}
	get __class__() {
		return Md5
	}
}


//# sourceMappingURL=Md5.js.map