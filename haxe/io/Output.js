import {HaxeError} from "../../js/Boot"
import {FPHelper} from "./FPHelper"
import {Error} from "./Error"
import {Eof} from "./Eof"
import {Bytes} from "./Bytes"
import {CallStack} from "../CallStack"
import {Register} from "../../genes/Register"

/**
An Output is an abstract write. A specific output implementation will only
have to override the `writeByte` and maybe the `write`, `flush` and `close`
methods. See `File.write` and `String.write` for two ways of creating an
Output.
*/
export const Output = Register.global("$hxClasses")["haxe.io.Output"] = 
class Output {
	
	/**
	Write one byte.
	*/
	writeByte(c) {
		throw new HaxeError("Not implemented");
	}
	
	/**
	Write `len` bytes from `s` starting by position specified by `pos`.
	
	Returns the actual length of written data that can differ from `len`.
	
	See `writeFullBytes` that tries to write the exact amount of specified bytes.
	*/
	writeBytes(s, pos, len) {
		if (pos < 0 || len < 0 || pos + len > s.length) {
			throw new HaxeError(Error.OutsideBounds);
		};
		var b = s.b;
		var k = len;
		while (k > 0) {
			this.writeByte(b[pos]);
			++pos;
			--k;
		};
		return len;
	}
	
	/**
	Flush any buffered data.
	*/
	flush() {
	}
	
	/**
	Close the output.
	
	Behaviour while writing after calling this method is unspecified.
	*/
	close() {
	}
	set_bigEndian(b) {
		this.bigEndian = b;
		return b;
	}
	
	/**
	Write all bytes stored in `s`.
	*/
	write(s) {
		var l = s.length;
		var p = 0;
		while (l > 0) {
			var k = this.writeBytes(s, p, l);
			if (k == 0) {
				throw new HaxeError(Error.Blocked);
			};
			p += k;
			l -= k;
		};
	}
	
	/**
	Write `len` bytes from `s` starting by position specified by `pos`.
	
	Unlike `writeBytes`, this method tries to write the exact `len` amount of bytes.
	*/
	writeFullBytes(s, pos, len) {
		while (len > 0) {
			var k = this.writeBytes(s, pos, len);
			pos += k;
			len -= k;
		};
	}
	
	/**
	Write `x` as 32-bit floating point number.
	
	Endianness is specified by the `bigEndian` property.
	*/
	writeFloat(x) {
		this.writeInt32(FPHelper.floatToI32(x));
	}
	
	/**
	Write `x` as 64-bit double-precision floating point number.
	
	Endianness is specified by the `bigEndian` property.
	*/
	writeDouble(x) {
		var i64 = FPHelper.doubleToI64(x);
		if (this.bigEndian) {
			this.writeInt32(i64.high);
			this.writeInt32(i64.low);
		} else {
			this.writeInt32(i64.low);
			this.writeInt32(i64.high);
		};
	}
	
	/**
	Write `x` as 8-bit signed integer.
	*/
	writeInt8(x) {
		if (x < -128 || x >= 128) {
			throw new HaxeError(Error.Overflow);
		};
		this.writeByte(x & 255);
	}
	
	/**
	Write `x` as 16-bit signed integer.
	
	Endianness is specified by the `bigEndian` property.
	*/
	writeInt16(x) {
		if (x < -32768 || x >= 32768) {
			throw new HaxeError(Error.Overflow);
		};
		this.writeUInt16(x & 65535);
	}
	
	/**
	Write `x` as 16-bit unsigned integer.
	
	Endianness is specified by the `bigEndian` property.
	*/
	writeUInt16(x) {
		if (x < 0 || x >= 65536) {
			throw new HaxeError(Error.Overflow);
		};
		if (this.bigEndian) {
			this.writeByte(x >> 8);
			this.writeByte(x & 255);
		} else {
			this.writeByte(x & 255);
			this.writeByte(x >> 8);
		};
	}
	
	/**
	Write `x` as 24-bit signed integer.
	
	Endianness is specified by the `bigEndian` property.
	*/
	writeInt24(x) {
		if (x < -8388608 || x >= 8388608) {
			throw new HaxeError(Error.Overflow);
		};
		this.writeUInt24(x & 16777215);
	}
	
	/**
	Write `x` as 24-bit unsigned integer.
	
	Endianness is specified by the `bigEndian` property.
	*/
	writeUInt24(x) {
		if (x < 0 || x >= 16777216) {
			throw new HaxeError(Error.Overflow);
		};
		if (this.bigEndian) {
			this.writeByte(x >> 16);
			this.writeByte(x >> 8 & 255);
			this.writeByte(x & 255);
		} else {
			this.writeByte(x & 255);
			this.writeByte(x >> 8 & 255);
			this.writeByte(x >> 16);
		};
	}
	
	/**
	Write `x` as 32-bit signed integer.
	
	Endianness is specified by the `bigEndian` property.
	*/
	writeInt32(x) {
		if (this.bigEndian) {
			this.writeByte(x >>> 24);
			this.writeByte(x >> 16 & 255);
			this.writeByte(x >> 8 & 255);
			this.writeByte(x & 255);
		} else {
			this.writeByte(x & 255);
			this.writeByte(x >> 8 & 255);
			this.writeByte(x >> 16 & 255);
			this.writeByte(x >>> 24);
		};
	}
	
	/**
	Inform that we are about to write at least `nbytes` bytes.
	
	The underlying implementation can allocate proper working space depending
	on this information, or simply ignore it. This is not a mandatory call
	but a tip and is only used in some specific cases.
	*/
	prepare(nbytes) {
	}
	
	/**
	Read all available data from `i` and write it.
	
	The `bufsize` optional argument specifies the size of chunks by
	which data is read and written. Its default value is 4096.
	*/
	writeInput(i, bufsize = null) {
		if (bufsize == null) {
			bufsize = 4096;
		};
		var buf = new Bytes(new ArrayBuffer(bufsize));
		try {
			while (true) {
				var len = i.readBytes(buf, 0, bufsize);
				if (len == 0) {
					throw new HaxeError(Error.Blocked);
				};
				var p = 0;
				while (len > 0) {
					var k = this.writeBytes(buf, p, len);
					if (k == 0) {
						throw new HaxeError(Error.Blocked);
					};
					p += k;
					len -= k;
				};
			};
		}catch (e) {
			CallStack.lastException = e;
			var e1 = (((e) instanceof HaxeError)) ? e.val : e;
			if (((e1) instanceof Eof)) {
				var e2 = e1;
			} else {
				throw e;
			};
		};
	}
	
	/**
	Write `s` string.
	*/
	writeString(s, encoding = null) {
		var b = Bytes.ofString(s, encoding);
		this.writeFullBytes(b, 0, b.length);
	}
	static get __name__() {
		return "haxe.io.Output"
	}
	get __class__() {
		return Output
	}
}


//# sourceMappingURL=Output.js.map