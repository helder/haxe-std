import {HuffTools} from "./Huffman"
import {BytesBuffer} from "../io/BytesBuffer"
import {Bytes} from "../io/Bytes"
import {Adler32} from "../crypto/Adler32"
import {Exception} from "../Exception"
import {Register} from "../../genes/Register"

export const Window = Register.global("$hxClasses")["haxe.zip._InflateImpl.Window"] = 
class Window extends Register.inherits() {
	new(hasCrc) {
		this.buffer = new Bytes(new ArrayBuffer(65536));
		this.pos = 0;
		if (hasCrc) {
			this.crc = new Adler32();
		};
	}
	slide() {
		if (this.crc != null) {
			this.crc.update(this.buffer, 0, 32768);
		};
		let b = new Bytes(new ArrayBuffer(65536));
		this.pos -= 32768;
		b.blit(0, this.buffer, 32768, this.pos);
		this.buffer = b;
	}
	addBytes(b, p, len) {
		if (this.pos + len > 65536) {
			this.slide();
		};
		this.buffer.blit(this.pos, b, p, len);
		this.pos += len;
	}
	addByte(c) {
		if (this.pos == 65536) {
			this.slide();
		};
		this.buffer.b[this.pos] = c;
		this.pos++;
	}
	getLastChar() {
		return this.buffer.b[this.pos - 1];
	}
	available() {
		return this.pos;
	}
	checksum() {
		if (this.crc != null) {
			this.crc.update(this.buffer, 0, this.pos);
		};
		return this.crc;
	}
	static get __name__() {
		return "haxe.zip._InflateImpl.Window"
	}
	get __class__() {
		return Window
	}
}


Window.SIZE = 32768
Window.BUFSIZE = 65536
export const State = 
Register.global("$hxEnums")["haxe.zip._InflateImpl.State"] = 
{
	__ename__: "haxe.zip._InflateImpl.State",
	
	Head: {_hx_name: "Head", _hx_index: 0, __enum__: "haxe.zip._InflateImpl.State"},
	Block: {_hx_name: "Block", _hx_index: 1, __enum__: "haxe.zip._InflateImpl.State"},
	CData: {_hx_name: "CData", _hx_index: 2, __enum__: "haxe.zip._InflateImpl.State"},
	Flat: {_hx_name: "Flat", _hx_index: 3, __enum__: "haxe.zip._InflateImpl.State"},
	Crc: {_hx_name: "Crc", _hx_index: 4, __enum__: "haxe.zip._InflateImpl.State"},
	Dist: {_hx_name: "Dist", _hx_index: 5, __enum__: "haxe.zip._InflateImpl.State"},
	DistOne: {_hx_name: "DistOne", _hx_index: 6, __enum__: "haxe.zip._InflateImpl.State"},
	Done: {_hx_name: "Done", _hx_index: 7, __enum__: "haxe.zip._InflateImpl.State"}
}
State.__constructs__ = [State.Head, State.Block, State.CData, State.Flat, State.Crc, State.Dist, State.DistOne, State.Done]
State.__empty_constructs__ = [State.Head, State.Block, State.CData, State.Flat, State.Crc, State.Dist, State.DistOne, State.Done]

/**
A pure Haxe implementation of the ZLIB Inflate algorithm which allows reading compressed data without any platform-specific support.
*/
export const InflateImpl = Register.global("$hxClasses")["haxe.zip.InflateImpl"] = 
class InflateImpl extends Register.inherits() {
	new(i, header = true, crc = true) {
		this.isFinal = false;
		this.htools = new HuffTools();
		this.huffman = this.buildFixedHuffman();
		this.huffdist = null;
		this.len = 0;
		this.dist = 0;
		this.state = (header) ? State.Head : State.Block;
		this.input = i;
		this.bits = 0;
		this.nbits = 0;
		this.needed = 0;
		this.output = null;
		this.outpos = 0;
		this.lengths = new Array();
		this.lengths.push(-1);
		this.lengths.push(-1);
		this.lengths.push(-1);
		this.lengths.push(-1);
		this.lengths.push(-1);
		this.lengths.push(-1);
		this.lengths.push(-1);
		this.lengths.push(-1);
		this.lengths.push(-1);
		this.lengths.push(-1);
		this.lengths.push(-1);
		this.lengths.push(-1);
		this.lengths.push(-1);
		this.lengths.push(-1);
		this.lengths.push(-1);
		this.lengths.push(-1);
		this.lengths.push(-1);
		this.lengths.push(-1);
		this.lengths.push(-1);
		this.window = new Window(crc);
	}
	buildFixedHuffman() {
		if (InflateImpl.FIXED_HUFFMAN != null) {
			return InflateImpl.FIXED_HUFFMAN;
		};
		let a = new Array();
		let _g = 0;
		while (_g < 288) {
			let n = _g++;
			a.push((n <= 143) ? 8 : (n <= 255) ? 9 : (n <= 279) ? 7 : 8);
		};
		InflateImpl.FIXED_HUFFMAN = this.htools.make(a, 0, 288, 10);
		return InflateImpl.FIXED_HUFFMAN;
	}
	readBytes(b, pos, len) {
		this.needed = len;
		this.outpos = pos;
		this.output = b;
		if (len > 0) {
			while (this.inflateLoop()) {
			};
		};
		return len - this.needed;
	}
	getBits(n) {
		while (this.nbits < n) {
			this.bits |= this.input.readByte() << this.nbits;
			this.nbits += 8;
		};
		let b = this.bits & (1 << n) - 1;
		this.nbits -= n;
		this.bits >>= n;
		return b;
	}
	getBit() {
		if (this.nbits == 0) {
			this.nbits = 8;
			this.bits = this.input.readByte();
		};
		let b = (this.bits & 1) == 1;
		this.nbits--;
		this.bits >>= 1;
		return b;
	}
	getRevBits(n) {
		if (n == 0) {
			return 0;
		} else if (this.getBit()) {
			return 1 << n - 1 | this.getRevBits(n - 1);
		} else {
			return this.getRevBits(n - 1);
		};
	}
	resetBits() {
		this.bits = 0;
		this.nbits = 0;
	}
	addBytes(b, p, len) {
		this.window.addBytes(b, p, len);
		this.output.blit(this.outpos, b, p, len);
		this.needed -= len;
		this.outpos += len;
	}
	addByte(b) {
		this.window.addByte(b);
		this.output.b[this.outpos] = b;
		this.needed--;
		this.outpos++;
	}
	addDistOne(n) {
		let c = this.window.getLastChar();
		let _g = 0;
		let _g1 = n;
		while (_g < _g1) {
			let i = _g++;
			this.addByte(c);
		};
	}
	addDist(d, len) {
		this.addBytes(this.window.buffer, this.window.pos - d, len);
	}
	applyHuffman(h) {
		switch (h._hx_index) {
			case 0:
				let n = h.i;
				return n;
				break
			case 1:
				let a = h.left;
				let b = h.right;
				return this.applyHuffman((this.getBit()) ? b : a);
				break
			case 2:
				let n1 = h.n;
				let tbl = h.table;
				return this.applyHuffman(tbl[this.getBits(n1)]);
				break
			
		};
	}
	inflateLengths(a, max) {
		let i = 0;
		let prev = 0;
		while (i < max) {
			let n = this.applyHuffman(this.huffman);
			switch (n) {
				case 0:case 1:case 2:case 3:case 4:case 5:case 6:case 7:case 8:case 9:case 10:case 11:case 12:case 13:case 14:case 15:
					prev = n;
					a[i] = n;
					++i;
					break
				case 16:
					let end = i + 3 + this.getBits(2);
					if (end > max) {
						throw Exception.thrown("Invalid data");
					};
					while (i < end) {
						a[i] = prev;
						++i;
					};
					break
				case 17:
					i += 3 + this.getBits(3);
					if (i > max) {
						throw Exception.thrown("Invalid data");
					};
					break
				case 18:
					i += 11 + this.getBits(7);
					if (i > max) {
						throw Exception.thrown("Invalid data");
					};
					break
				default:
				throw Exception.thrown("Invalid data");
				
			};
		};
	}
	inflateLoop() {
		switch (this.state._hx_index) {
			case 0:
				let cmf = this.input.readByte();
				let cm = cmf & 15;
				let cinfo = cmf >> 4;
				if (cm != 8) {
					throw Exception.thrown("Invalid data");
				};
				let flg = this.input.readByte();
				let fdict = (flg & 32) != 0;
				if (((cmf << 8) + flg) % 31 != 0) {
					throw Exception.thrown("Invalid data");
				};
				if (fdict) {
					throw Exception.thrown("Unsupported dictionary");
				};
				this.state = State.Block;
				return true;
				break
			case 1:
				this.isFinal = this.getBit();
				switch (this.getBits(2)) {
					case 0:
						this.len = this.input.readUInt16();
						let nlen = this.input.readUInt16();
						if (nlen != 65535 - this.len) {
							throw Exception.thrown("Invalid data");
						};
						this.state = State.Flat;
						let r = this.inflateLoop();
						this.resetBits();
						return r;
						break
					case 1:
						this.huffman = this.buildFixedHuffman();
						this.huffdist = null;
						this.state = State.CData;
						return true;
						break
					case 2:
						let hlit = this.getBits(5) + 257;
						let hdist = this.getBits(5) + 1;
						let hclen = this.getBits(4) + 4;
						let _g = 0;
						let _g1 = hclen;
						while (_g < _g1) {
							let i = _g++;
							this.lengths[InflateImpl.CODE_LENGTHS_POS[i]] = this.getBits(3);
						};
						let _g2 = hclen;
						let _g3 = 19;
						while (_g2 < _g3) {
							let i = _g2++;
							this.lengths[InflateImpl.CODE_LENGTHS_POS[i]] = 0;
						};
						this.huffman = this.htools.make(this.lengths, 0, 19, 8);
						let lengths = new Array();
						let _g4 = 0;
						let _g5 = hlit + hdist;
						while (_g4 < _g5) {
							let i = _g4++;
							lengths.push(0);
						};
						this.inflateLengths(lengths, hlit + hdist);
						this.huffdist = this.htools.make(lengths, hlit, hdist, 16);
						this.huffman = this.htools.make(lengths, 0, hlit, 16);
						this.state = State.CData;
						return true;
						break
					default:
					throw Exception.thrown("Invalid data");
					
				};
				break
			case 2:
				let n = this.applyHuffman(this.huffman);
				if (n < 256) {
					this.addByte(n);
					return this.needed > 0;
				} else if (n == 256) {
					this.state = (this.isFinal) ? State.Crc : State.Block;
					return true;
				} else {
					n -= 257;
					let extra_bits = InflateImpl.LEN_EXTRA_BITS_TBL[n];
					if (extra_bits == -1) {
						throw Exception.thrown("Invalid data");
					};
					this.len = InflateImpl.LEN_BASE_VAL_TBL[n] + this.getBits(extra_bits);
					let dist_code = (this.huffdist == null) ? this.getRevBits(5) : this.applyHuffman(this.huffdist);
					extra_bits = InflateImpl.DIST_EXTRA_BITS_TBL[dist_code];
					if (extra_bits == -1) {
						throw Exception.thrown("Invalid data");
					};
					this.dist = InflateImpl.DIST_BASE_VAL_TBL[dist_code] + this.getBits(extra_bits);
					if (this.dist > this.window.available()) {
						throw Exception.thrown("Invalid data");
					};
					this.state = (this.dist == 1) ? State.DistOne : State.Dist;
					return true;
				};
				break
			case 3:
				let rlen = (this.len < this.needed) ? this.len : this.needed;
				let bytes = this.input.read(rlen);
				this.len -= rlen;
				this.addBytes(bytes, 0, rlen);
				if (this.len == 0) {
					this.state = (this.isFinal) ? State.Crc : State.Block;
				};
				return this.needed > 0;
				break
			case 4:
				let calc = this.window.checksum();
				if (calc == null) {
					this.state = State.Done;
					return true;
				};
				let crc = Adler32.read(this.input);
				if (!calc.equals(crc)) {
					throw Exception.thrown("Invalid CRC");
				};
				this.state = State.Done;
				return true;
				break
			case 5:
				while (this.len > 0 && this.needed > 0) {
					let rdist = (this.len < this.dist) ? this.len : this.dist;
					let rlen = (this.needed < rdist) ? this.needed : rdist;
					this.addDist(this.dist, rlen);
					this.len -= rlen;
				};
				if (this.len == 0) {
					this.state = State.CData;
				};
				return this.needed > 0;
				break
			case 6:
				let rlen1 = (this.len < this.needed) ? this.len : this.needed;
				this.addDistOne(rlen1);
				this.len -= rlen1;
				if (this.len == 0) {
					this.state = State.CData;
				};
				return this.needed > 0;
				break
			case 7:
				return false;
				break
			
		};
	}
	static run(i, bufsize = 65536) {
		let buf = new Bytes(new ArrayBuffer(bufsize));
		let output = new BytesBuffer();
		let inflate = new InflateImpl(i);
		while (true) {
			let len = inflate.readBytes(buf, 0, bufsize);
			output.addBytes(buf, 0, len);
			if (len < bufsize) {
				break;
			};
		};
		return output.getBytes();
	}
	static get __name__() {
		return "haxe.zip.InflateImpl"
	}
	get __class__() {
		return InflateImpl
	}
}


InflateImpl.LEN_EXTRA_BITS_TBL = [0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 2, 2, 2, 2, 3, 3, 3, 3, 4, 4, 4, 4, 5, 5, 5, 5, 0, -1, -1]
InflateImpl.LEN_BASE_VAL_TBL = [3, 4, 5, 6, 7, 8, 9, 10, 11, 13, 15, 17, 19, 23, 27, 31, 35, 43, 51, 59, 67, 83, 99, 115, 131, 163, 195, 227, 258]
InflateImpl.DIST_EXTRA_BITS_TBL = [0, 0, 0, 0, 1, 1, 2, 2, 3, 3, 4, 4, 5, 5, 6, 6, 7, 7, 8, 8, 9, 9, 10, 10, 11, 11, 12, 12, 13, 13, -1, -1]
InflateImpl.DIST_BASE_VAL_TBL = [1, 2, 3, 4, 5, 7, 9, 13, 17, 25, 33, 49, 65, 97, 129, 193, 257, 385, 513, 769, 1025, 1537, 2049, 3073, 4097, 6145, 8193, 12289, 16385, 24577]
InflateImpl.CODE_LENGTHS_POS = [16, 17, 18, 0, 8, 7, 9, 6, 10, 5, 11, 4, 12, 3, 13, 2, 14, 1, 15]
InflateImpl.FIXED_HUFFMAN = null
//# sourceMappingURL=InflateImpl.js.map