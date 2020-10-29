import {HaxeError} from "../../js/Boot"
import {BytesOutput} from "../io/BytesOutput"
import {Bytes} from "../io/Bytes"
import {List} from "../ds/List"
import {Crc32} from "../crypto/Crc32"
import {Register} from "../../genes/Register"

export const Writer = Register.global("$hxClasses")["haxe.zip.Writer"] = 
class Writer extends Register.inherits() {
	new(o) {
		this.o = o;
		this.files = new List();
	}
	writeZipDate(date) {
		var hour = date.getHours();
		var min = date.getMinutes();
		var sec = date.getSeconds() >> 1;
		this.o.writeUInt16(hour << 11 | min << 5 | sec);
		var year = date.getFullYear() - 1980;
		var month = date.getMonth() + 1;
		var day = date.getDate();
		this.o.writeUInt16(year << 9 | month << 5 | day);
	}
	writeEntryHeader(f) {
		var o = this.o;
		var flags = 0;
		if (f.extraFields != null) {
			var _g_head = f.extraFields.h;
			while (_g_head != null) {
				var val = _g_head.item;
				_g_head = _g_head.next;
				var e = val;
				if (e._hx_index == 2) {
					flags |= 2048;
				};
			};
		};
		o.writeInt32(67324752);
		o.writeUInt16(20);
		o.writeUInt16(flags);
		if (f.data == null) {
			f.fileSize = 0;
			f.dataSize = 0;
			f.crc32 = 0;
			f.compressed = false;
			f.data = new Bytes(new ArrayBuffer(0));
		} else {
			if (f.crc32 == null) {
				if (f.compressed) {
					throw new HaxeError("CRC32 must be processed before compression");
				};
				f.crc32 = Crc32.make(f.data);
			};
			if (!f.compressed) {
				f.fileSize = f.data.length;
			};
			f.dataSize = f.data.length;
		};
		o.writeUInt16((f.compressed) ? 8 : 0);
		this.writeZipDate(f.fileTime);
		o.writeInt32(f.crc32);
		o.writeInt32(f.dataSize);
		o.writeInt32(f.fileSize);
		o.writeUInt16(f.fileName.length);
		var e1 = new BytesOutput();
		if (f.extraFields != null) {
			var _g_head1 = f.extraFields.h;
			while (_g_head1 != null) {
				var val1 = _g_head1.item;
				_g_head1 = _g_head1.next;
				var f1 = val1;
				switch (f1._hx_index) {
					case 0:
						var bytes = f1.bytes;
						var tag = f1.tag;
						e1.writeUInt16(tag);
						e1.writeUInt16(bytes.length);
						e1.write(bytes);
						break
					case 1:
						var crc = f1.crc;
						var name = f1.name;
						var namebytes = Bytes.ofString(name);
						e1.writeUInt16(28789);
						e1.writeUInt16(namebytes.length + 5);
						e1.writeByte(1);
						e1.writeInt32(crc);
						e1.write(namebytes);
						break
					case 2:
						break
					
				};
			};
		};
		var ebytes = e1.getBytes();
		o.writeUInt16(ebytes.length);
		o.writeString(f.fileName);
		o.write(ebytes);
		this.files.add({"name": f.fileName, "compressed": f.compressed, "clen": f.data.length, "size": f.fileSize, "crc": f.crc32, "date": f.fileTime, "fields": ebytes});
	}
	write(files) {
		var _g_head = files.h;
		while (_g_head != null) {
			var val = _g_head.item;
			_g_head = _g_head.next;
			var f = val;
			this.writeEntryHeader(f);
			this.o.writeFullBytes(f.data, 0, f.data.length);
		};
		this.writeCDR();
	}
	writeCDR() {
		var cdr_size = 0;
		var cdr_offset = 0;
		var _g_head = this.files.h;
		while (_g_head != null) {
			var val = _g_head.item;
			_g_head = _g_head.next;
			var f = val;
			var namelen = f.name.length;
			var extraFieldsLength = f.fields.length;
			this.o.writeInt32(33639248);
			this.o.writeUInt16(20);
			this.o.writeUInt16(20);
			this.o.writeUInt16(0);
			this.o.writeUInt16((f.compressed) ? 8 : 0);
			this.writeZipDate(f.date);
			this.o.writeInt32(f.crc);
			this.o.writeInt32(f.clen);
			this.o.writeInt32(f.size);
			this.o.writeUInt16(namelen);
			this.o.writeUInt16(extraFieldsLength);
			this.o.writeUInt16(0);
			this.o.writeUInt16(0);
			this.o.writeUInt16(0);
			this.o.writeInt32(0);
			this.o.writeInt32(cdr_offset);
			this.o.writeString(f.name);
			this.o.write(f.fields);
			cdr_size += 46 + namelen + extraFieldsLength;
			cdr_offset += 30 + namelen + extraFieldsLength + f.clen;
		};
		this.o.writeInt32(101010256);
		this.o.writeUInt16(0);
		this.o.writeUInt16(0);
		this.o.writeUInt16(this.files.length);
		this.o.writeUInt16(this.files.length);
		this.o.writeInt32(cdr_size);
		this.o.writeInt32(cdr_offset);
		this.o.writeUInt16(0);
	}
	static get __name__() {
		return "haxe.zip.Writer"
	}
	get __class__() {
		return Writer
	}
}


Writer.CENTRAL_DIRECTORY_RECORD_FIELDS_SIZE = 46
Writer.LOCAL_FILE_HEADER_FIELDS_SIZE = 30
//# sourceMappingURL=Writer.js.map