import {Error as Error__1} from "./Error.js"
import {Encoding} from "./Encoding.js"
import {___Int64} from "../Int64.js"
import {Exception} from "../Exception.js"
import {Register} from "../../genes/Register.js"
import {HxOverrides} from "../../HxOverrides.js"

const $global = Register.$global

export const Bytes = Register.global("$hxClasses")["haxe.io.Bytes"] = 
class Bytes extends Register.inherits() {
	new(data) {
		this.length = data.byteLength;
		this.b = new Uint8Array(data);
		this.b.bufferValue = data;
		data.hxBytes = this;
		data.bytes = this.b;
	}
	
	/**
	Returns the byte at index `pos`.
	*/
	get(pos) {
		return this.b[pos];
	}
	
	/**
	Stores the given byte `v` at the given position `pos`.
	*/
	set(pos, v) {
		this.b[pos] = v;
	}
	
	/**
	Copies `len` bytes from `src` into this instance.
	@param pos Zero-based location in `this` instance at which to start writing
	bytes.
	@param src Source `Bytes` instance from which to copy bytes.
	@param srcpos Zero-based location at `src` from which bytes will be copied.
	@param len Number of bytes to be copied.
	*/
	blit(pos, src, srcpos, len) {
		if (pos < 0 || srcpos < 0 || len < 0 || pos + len > this.length || srcpos + len > src.length) {
			throw Exception.thrown(Error__1.OutsideBounds);
		};
		if (srcpos == 0 && len == src.b.byteLength) {
			this.b.set(src.b, pos);
		} else {
			this.b.set(src.b.subarray(srcpos, srcpos + len), pos);
		};
	}
	
	/**
	Sets `len` consecutive bytes starting from index `pos` of `this` instance
	to `value`.
	*/
	fill(pos, len, value) {
		var _g = 0;
		var _g1 = len;
		while (_g < _g1) {
			var i = _g++;
			this.b[pos++] = value;
		};
	}
	
	/**
	Returns a new `Bytes` instance that contains a copy of `len` bytes of
	`this` instance, starting at index `pos`.
	*/
	sub(pos, len) {
		if (pos < 0 || len < 0 || pos + len > this.length) {
			throw Exception.thrown(Error__1.OutsideBounds);
		};
		return new Bytes(this.b.buffer.slice(pos + this.b.byteOffset, pos + this.b.byteOffset + len));
	}
	
	/**
	Returns `0` if the bytes of `this` instance and the bytes of `other` are
	identical.
	
	Returns a negative value if the `length` of `this` instance is less than
	the `length` of `other`, or a positive value if the `length` of `this`
	instance is greater than the `length` of `other`.
	
	In case of equal `length`s, returns a negative value if the first different
	value in `other` is greater than the corresponding value in `this`
	instance; otherwise returns a positive value.
	*/
	compare(other) {
		var b1 = this.b;
		var b2 = other.b;
		var len = (this.length < other.length) ? this.length : other.length;
		var _g = 0;
		var _g1 = len;
		while (_g < _g1) {
			var i = _g++;
			if (b1[i] != b2[i]) {
				return b1[i] - b2[i];
			};
		};
		return this.length - other.length;
	}
	initData() {
		if (this.data == null) {
			this.data = new DataView(this.b.buffer, this.b.byteOffset, this.b.byteLength);
		};
	}
	
	/**
	Returns the IEEE double-precision value at the given position `pos` (in
	little-endian encoding). Result is unspecified if `pos` is outside the
	bounds.
	*/
	getDouble(pos) {
		if (this.data == null) {
			this.data = new DataView(this.b.buffer, this.b.byteOffset, this.b.byteLength);
		};
		return this.data.getFloat64(pos, true);
	}
	
	/**
	Returns the IEEE single-precision value at the given position `pos` (in
	little-endian encoding). Result is unspecified if `pos` is outside the
	bounds.
	*/
	getFloat(pos) {
		if (this.data == null) {
			this.data = new DataView(this.b.buffer, this.b.byteOffset, this.b.byteLength);
		};
		return this.data.getFloat32(pos, true);
	}
	
	/**
	Stores the given IEEE double-precision value `v` at the given position
	`pos` in little-endian encoding. Result is unspecified if writing outside
	of bounds.
	*/
	setDouble(pos, v) {
		if (this.data == null) {
			this.data = new DataView(this.b.buffer, this.b.byteOffset, this.b.byteLength);
		};
		this.data.setFloat64(pos, v, true);
	}
	
	/**
	Stores the given IEEE single-precision value `v` at the given position
	`pos` in little-endian encoding. Result is unspecified if writing outside
	of bounds.
	*/
	setFloat(pos, v) {
		if (this.data == null) {
			this.data = new DataView(this.b.buffer, this.b.byteOffset, this.b.byteLength);
		};
		this.data.setFloat32(pos, v, true);
	}
	
	/**
	Returns the 16-bit unsigned integer at the given position `pos` (in
	little-endian encoding).
	*/
	getUInt16(pos) {
		if (this.data == null) {
			this.data = new DataView(this.b.buffer, this.b.byteOffset, this.b.byteLength);
		};
		return this.data.getUint16(pos, true);
	}
	
	/**
	Stores the given 16-bit unsigned integer `v` at the given position `pos`
	(in little-endian encoding).
	*/
	setUInt16(pos, v) {
		if (this.data == null) {
			this.data = new DataView(this.b.buffer, this.b.byteOffset, this.b.byteLength);
		};
		this.data.setUint16(pos, v, true);
	}
	
	/**
	Returns the 32-bit integer at the given position `pos` (in little-endian
	encoding).
	*/
	getInt32(pos) {
		if (this.data == null) {
			this.data = new DataView(this.b.buffer, this.b.byteOffset, this.b.byteLength);
		};
		return this.data.getInt32(pos, true);
	}
	
	/**
	Stores the given 32-bit integer `v` at the given position `pos` (in
	little-endian encoding).
	*/
	setInt32(pos, v) {
		if (this.data == null) {
			this.data = new DataView(this.b.buffer, this.b.byteOffset, this.b.byteLength);
		};
		this.data.setInt32(pos, v, true);
	}
	
	/**
	Returns the 64-bit integer at the given position `pos` (in little-endian
	encoding).
	*/
	getInt64(pos) {
		var this1 = new ___Int64(this.getInt32(pos + 4), this.getInt32(pos));
		return this1;
	}
	
	/**
	Stores the given 64-bit integer `v` at the given position `pos` (in
	little-endian encoding).
	*/
	setInt64(pos, v) {
		this.setInt32(pos, v.low);
		this.setInt32(pos + 4, v.high);
	}
	
	/**
	Returns the `len`-bytes long string stored at the given position `pos`,
	interpreted with the given `encoding` (UTF-8 by default).
	*/
	getString(pos, len, encoding) {
		if (pos < 0 || len < 0 || pos + len > this.length) {
			throw Exception.thrown(Error__1.OutsideBounds);
		};
		if (encoding == null) {
			encoding = Encoding.UTF8;
		};
		var s = "";
		var b = this.b;
		var i = pos;
		var max = pos + len;
		switch (encoding._hx_index) {
			case 0:
				var debug = pos > 0;
				while (i < max) {
					var c = b[i++];
					if (c < 128) {
						if (c == 0) {
							break;
						};
						s += String.fromCodePoint(c);
					} else if (c < 224) {
						var code = (c & 63) << 6 | b[i++] & 127;
						s += String.fromCodePoint(code);
					} else if (c < 240) {
						var c2 = b[i++];
						var code1 = (c & 31) << 12 | (c2 & 127) << 6 | b[i++] & 127;
						s += String.fromCodePoint(code1);
					} else {
						var c21 = b[i++];
						var c3 = b[i++];
						var u = (c & 15) << 18 | (c21 & 127) << 12 | (c3 & 127) << 6 | b[i++] & 127;
						s += String.fromCodePoint(u);
					};
				};
				break
			case 1:
				while (i < max) {
					var c = b[i++] | b[i++] << 8;
					s += String.fromCodePoint(c);
				};
				break
			
		};
		return s;
	}
	readString(pos, len) {
		return this.getString(pos, len);
	}
	
	/**
	Returns a `String` representation of the bytes interpreted as UTF-8.
	*/
	toString() {
		return this.getString(0, this.length);
	}
	
	/**
	Returns a hexadecimal `String` representation of the bytes of `this`
	instance.
	*/
	toHex() {
		var s_b = "";
		var chars = [];
		var str = "0123456789abcdef";
		var _g = 0;
		var _g1 = str.length;
		while (_g < _g1) {
			var i = _g++;
			chars.push(HxOverrides.cca(str, i));
		};
		var _g = 0;
		var _g1 = this.length;
		while (_g < _g1) {
			var i = _g++;
			var c = this.b[i];
			s_b += String.fromCodePoint(chars[c >> 4]);
			s_b += String.fromCodePoint(chars[c & 15]);
		};
		return s_b;
	}
	
	/**
	Returns the bytes of `this` instance as `BytesData`.
	*/
	getData() {
		return this.b.bufferValue;
	}
	
	/**
	Returns a new `Bytes` instance with the given `length`. The values of the
	bytes are not initialized and may not be zero.
	*/
	static alloc(length) {
		return new Bytes(new ArrayBuffer(length));
	}
	
	/**
	Returns the `Bytes` representation of the given `String`, using the
	specified encoding (UTF-8 by default).
	*/
	static ofString(s, encoding) {
		if (encoding == Encoding.RawNative) {
			var buf = new Uint8Array(s.length << 1);
			var _g = 0;
			var _g1 = s.length;
			while (_g < _g1) {
				var i = _g++;
				var c = s.charCodeAt(i);
				buf[i << 1] = c & 255;
				buf[i << 1 | 1] = c >> 8;
			};
			return new Bytes(buf.buffer);
		};
		var a = new Array();
		var i = 0;
		while (i < s.length) {
			var c = s.charCodeAt(i++);
			if (55296 <= c && c <= 56319) {
				c = c - 55232 << 10 | s.charCodeAt(i++) & 1023;
			};
			if (c <= 127) {
				a.push(c);
			} else if (c <= 2047) {
				a.push(192 | c >> 6);
				a.push(128 | c & 63);
			} else if (c <= 65535) {
				a.push(224 | c >> 12);
				a.push(128 | c >> 6 & 63);
				a.push(128 | c & 63);
			} else {
				a.push(240 | c >> 18);
				a.push(128 | c >> 12 & 63);
				a.push(128 | c >> 6 & 63);
				a.push(128 | c & 63);
			};
		};
		return new Bytes(new Uint8Array(a).buffer);
	}
	
	/**
	Returns the `Bytes` representation of the given `BytesData`.
	*/
	static ofData(b) {
		var hb = b.hxBytes;
		if (hb != null) {
			return hb;
		};
		return new Bytes(b);
	}
	
	/**
	Converts the given hexadecimal `String` to `Bytes`. `s` must be a string of
	even length consisting only of hexadecimal digits. For example:
	`"0FDA14058916052309"`.
	*/
	static ofHex(s) {
		if ((s.length & 1) != 0) {
			throw Exception.thrown("Not a hex string (odd number of digits)");
		};
		var a = new Array();
		var i = 0;
		var len = s.length >> 1;
		while (i < len) {
			var high = s.charCodeAt(i * 2);
			var low = s.charCodeAt(i * 2 + 1);
			high = (high & 15) + ((high & 64) >> 6) * 9;
			low = (low & 15) + ((low & 64) >> 6) * 9;
			a.push((high << 4 | low) & 255);
			++i;
		};
		return new Bytes(new Uint8Array(a).buffer);
	}
	
	/**
	Reads the `pos`-th byte of the given `b` bytes, in the most efficient way
	possible. Behavior when reading outside of the available data is
	unspecified.
	*/
	static fastGet(b, pos) {
		return b.bytes[pos];
	}
	static get __name__() {
		return "haxe.io.Bytes"
	}
	get __class__() {
		return Bytes
	}
}


//# sourceMappingURL=Bytes.js.map