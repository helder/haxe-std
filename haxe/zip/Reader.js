import {Uncompress} from "./Uncompress.js"
import {InflateImpl} from "./InflateImpl.js"
import {ExtraField} from "./Entry.js"
import {BytesBuffer} from "../io/BytesBuffer.js"
import {Bytes} from "../io/Bytes.js"
import {List} from "../ds/List.js"
import {Exception} from "../Exception.js"
import {Register} from "../../genes/Register.js"

const $global = Register.$global

export const Reader = Register.global("$hxClasses")["haxe.zip.Reader"] = 
class Reader extends Register.inherits() {
	new(i) {
		this.i = i;
	}
	readZipDate() {
		var t = this.i.readUInt16();
		var hour = t >> 11 & 31;
		var min = t >> 5 & 63;
		var sec = t & 31;
		var d = this.i.readUInt16();
		var year = d >> 9;
		var month = d >> 5 & 15;
		var day = d & 31;
		return new Date(year + 1980, month - 1, day, hour, min, sec << 1);
	}
	readExtraFields(length) {
		var fields = new List();
		while (length > 0) {
			if (length < 4) {
				throw Exception.thrown("Invalid extra fields data");
			};
			var tag = this.i.readUInt16();
			var len = this.i.readUInt16();
			if (length < len) {
				throw Exception.thrown("Invalid extra fields data");
			};
			if (tag == 28789) {
				var version = this.i.readByte();
				if (version != 1) {
					var data = new BytesBuffer();
					data.addByte(version);
					data.add(this.i.read(len - 1));
					fields.add(ExtraField.FUnknown(tag, data.getBytes()));
				} else {
					var crc = this.i.readInt32();
					var name = this.i.read(len - 5).toString();
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
		var i = this.i;
		var h = i.readInt32();
		if (h == 33639248 || h == 101010256) {
			return null;
		};
		if (h != 67324752) {
			throw Exception.thrown("Invalid Zip Data");
		};
		var version = i.readUInt16();
		var flags = i.readUInt16();
		var utf8 = (flags & 2048) != 0;
		if ((flags & 63473) != 0) {
			throw Exception.thrown("Unsupported flags " + flags);
		};
		var compression = i.readUInt16();
		var compressed = compression != 0;
		if (compressed && compression != 8) {
			throw Exception.thrown("Unsupported compression " + compression);
		};
		var mtime = this.readZipDate();
		var crc32 = i.readInt32();
		var csize = i.readInt32();
		var usize = i.readInt32();
		var fnamelen = i.readInt16();
		var elen = i.readInt16();
		var fname = i.readString(fnamelen);
		var fields = this.readExtraFields(elen);
		if (utf8) {
			fields.push(ExtraField.FUtf8);
		};
		var data = null;
		if ((flags & 8) != 0) {
			crc32 = null;
		};
		return {"fileName": fname, "fileSize": usize, "fileTime": mtime, "compressed": compressed, "dataSize": csize, "data": data, "crc32": crc32, "extraFields": fields};
	}
	read() {
		var l = new List();
		var buf = null;
		var tmp = null;
		while (true) {
			var e = this.readEntryHeader();
			if (e == null) {
				break;
			};
			if (e.crc32 == null) {
				if (e.compressed) {
					var bufSize = 65536;
					if (tmp == null) {
						tmp = new Bytes(new ArrayBuffer(bufSize));
					};
					var out = new BytesBuffer();
					var z = new InflateImpl(this.i, false, false);
					while (true) {
						var n = z.readBytes(tmp, 0, bufSize);
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
		var r = new Reader(i);
		return r.read();
	}
	static unzip(f) {
		if (!f.compressed) {
			return f.data;
		};
		var c = new Uncompress(-15);
		var s = new Bytes(new ArrayBuffer(f.fileSize));
		var r = c.execute(f.data, 0, s, 0);
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