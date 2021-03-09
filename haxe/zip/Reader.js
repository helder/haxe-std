import {Uncompress} from "./Uncompress.js"
import {InflateImpl} from "./InflateImpl.js"
import {ExtraField} from "./Entry.js"
import {BytesBuffer} from "../io/BytesBuffer.js"
import {Bytes} from "../io/Bytes.js"
import {List} from "../ds/List.js"
import {Exception} from "../Exception.js"
import {Register} from "../../genes/Register.js"

export const Reader = Register.global("$hxClasses")["haxe.zip.Reader"] = 
class Reader extends Register.inherits() {
	new(i) {
		this.i = i;
	}
	readZipDate() {
		let t = this.i.readUInt16();
		let hour = t >> 11 & 31;
		let min = t >> 5 & 63;
		let sec = t & 31;
		let d = this.i.readUInt16();
		let year = d >> 9;
		let month = d >> 5 & 15;
		let day = d & 31;
		return new Date(year + 1980, month - 1, day, hour, min, sec << 1);
	}
	readExtraFields(length) {
		let fields = new List();
		while (length > 0) {
			if (length < 4) {
				throw Exception.thrown("Invalid extra fields data");
			};
			let tag = this.i.readUInt16();
			let len = this.i.readUInt16();
			if (length < len) {
				throw Exception.thrown("Invalid extra fields data");
			};
			if (tag == 28789) {
				let version = this.i.readByte();
				if (version != 1) {
					let data = new BytesBuffer();
					data.addByte(version);
					data.add(this.i.read(len - 1));
					fields.add(ExtraField.FUnknown(tag, data.getBytes()));
				} else {
					let crc = this.i.readInt32();
					let name = this.i.read(len - 5).toString();
					fields.add(ExtraField.FInfoZipUnicodePath(name, crc));
				};
			} else {
				fields.add(ExtraField.FUnknown(tag, this.i.read(len)));
			};
			length -= 4 + len;
		};
		return fields;
	}
	readEntryHeader() {
		let i = this.i;
		let h = i.readInt32();
		if (h == 33639248 || h == 101010256) {
			return null;
		};
		if (h != 67324752) {
			throw Exception.thrown("Invalid Zip Data");
		};
		let version = i.readUInt16();
		let flags = i.readUInt16();
		let utf8 = (flags & 2048) != 0;
		if ((flags & 63473) != 0) {
			throw Exception.thrown("Unsupported flags " + flags);
		};
		let compression = i.readUInt16();
		let compressed = compression != 0;
		if (compressed && compression != 8) {
			throw Exception.thrown("Unsupported compression " + compression);
		};
		let mtime = this.readZipDate();
		let crc32 = i.readInt32();
		let csize = i.readInt32();
		let usize = i.readInt32();
		let fnamelen = i.readInt16();
		let elen = i.readInt16();
		let fname = i.readString(fnamelen);
		let fields = this.readExtraFields(elen);
		if (utf8) {
			fields.push(ExtraField.FUtf8);
		};
		let data = null;
		if ((flags & 8) != 0) {
			crc32 = null;
		};
		return {"fileName": fname, "fileSize": usize, "fileTime": mtime, "compressed": compressed, "dataSize": csize, "data": data, "crc32": crc32, "extraFields": fields};
	}
	read() {
		let l = new List();
		let buf = null;
		let tmp = null;
		while (true) {
			let e = this.readEntryHeader();
			if (e == null) {
				break;
			};
			if (e.crc32 == null) {
				if (e.compressed) {
					let bufSize = 65536;
					if (tmp == null) {
						tmp = new Bytes(new ArrayBuffer(bufSize));
					};
					let out = new BytesBuffer();
					let z = new InflateImpl(this.i, false, false);
					while (true) {
						let n = z.readBytes(tmp, 0, bufSize);
						out.addBytes(tmp, 0, n);
						if (n < bufSize) {
							break;
						};
					};
					e.data = out.getBytes();
				} else {
					e.data = this.i.read(e.dataSize);
				};
				e.crc32 = this.i.readInt32();
				if (e.crc32 == 134695760) {
					e.crc32 = this.i.readInt32();
				};
				e.dataSize = this.i.readInt32();
				e.fileSize = this.i.readInt32();
				e.dataSize = e.fileSize;
				e.compressed = false;
			} else {
				e.data = this.i.read(e.dataSize);
			};
			l.add(e);
		};
		return l;
	}
	static readZip(i) {
		let r = new Reader(i);
		return r.read();
	}
	static unzip(f) {
		if (!f.compressed) {
			return f.data;
		};
		let c = new Uncompress(-15);
		let s = new Bytes(new ArrayBuffer(f.fileSize));
		let r = c.execute(f.data, 0, s, 0);
		c.close();
		if (!r.done || r.read != f.data.length || r.write != f.fileSize) {
			throw Exception.thrown("Invalid compressed data for " + f.fileName);
		};
		f.compressed = false;
		f.dataSize = f.fileSize;
		f.data = s;
		return f.data;
	}
	static get __name__() {
		return "haxe.zip.Reader"
	}
	get __class__() {
		return Reader
	}
}


//# sourceMappingURL=Reader.js.map