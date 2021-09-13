import {Input} from "../../haxe/io/Input.js"
import {Error as Error__1} from "../../haxe/io/Error.js"
import {Eof} from "../../haxe/io/Eof.js"
import {NativeStackTrace} from "../../haxe/NativeStackTrace.js"
import {Exception} from "../../haxe/Exception.js"
import {Register} from "../../genes/Register.js"
import * as Fs from "fs"
import {Buffer} from "buffer"

const $global = Register.$global

/**
Use `sys.io.File.read` to create a `FileInput`.
*/
export const FileInput = Register.global("$hxClasses")["sys.io.FileInput"] = 
class FileInput extends Register.inherits(Input) {
	new(fd) {
		this.fd = fd;
		this.pos = 0;
	}
	readByte() {
		var buf = Buffer.alloc(1);
		var bytesRead;
		try {
			bytesRead = Fs.readSync(this.fd, buf, 0, 1, this.pos);
		}catch (_g) {
			NativeStackTrace.lastError = _g;
			var e = Exception.caught(_g).unwrap();
			if (e.code == "EOF") {
				throw Exception.thrown(new Eof());
			} else {
				throw Exception.thrown(Error__1.Custom(e));
			};
		};
		if (bytesRead == 0) {
			throw Exception.thrown(new Eof());
		};
		this.pos++;
		return buf[0];
	}
	readBytes(s, pos, len) {
		var data = s.b;
		var buf = Buffer.from(data.buffer, data.byteOffset, s.length);
		var bytesRead;
		try {
			bytesRead = Fs.readSync(this.fd, buf, pos, len, this.pos);
		}catch (_g) {
			NativeStackTrace.lastError = _g;
			var e = Exception.caught(_g).unwrap();
			if (e.code == "EOF") {
				throw Exception.thrown(new Eof());
			} else {
				throw Exception.thrown(Error__1.Custom(e));
			};
		};
		if (bytesRead == 0) {
			throw Exception.thrown(new Eof());
		};
		this.pos += bytesRead;
		return bytesRead;
	}
	close() {
		Fs.closeSync(this.fd);
	}
	seek(p, pos) {
		switch (pos._hx_index) {
			case 0:
				this.pos = p;
				break
			case 1:
				this.pos += p;
				break
			case 2:
				this.pos = Fs.fstatSync(this.fd).size + p;
				break
			
		};
	}
	tell() {
		return this.pos;
	}
	eof() {
		return this.pos >= Fs.fstatSync(this.fd).size;
	}
	static get __name__() {
		return "sys.io.FileInput"
	}
	static get __super__() {
		return Input
	}
	get __class__() {
		return FileInput
	}
}


//# sourceMappingURL=FileInput.js.map