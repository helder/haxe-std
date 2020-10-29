import {Input} from "../../haxe/io/Input"
import {Error} from "../../haxe/io/Error"
import {Eof} from "../../haxe/io/Eof"
import {NativeStackTrace} from "../../haxe/NativeStackTrace"
import {Exception} from "../../haxe/Exception"
import {Register} from "../../genes/Register"
import * as Fs from "fs"
import {Buffer} from "buffer"

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
		let buf = Buffer.alloc(1);
		let bytesRead;
		try {
			bytesRead = Fs.readSync(this.fd, buf, 0, 1, this.pos);
		}catch (_g) {
			NativeStackTrace.lastError = _g;
			let e = Exception.caught(_g).unwrap();
			if (e.code == "EOF") {
				throw Exception.thrown(new Eof());
			} else {
				throw Exception.thrown(Error.Custom(e));
			};
		};
		if (bytesRead == 0) {
			throw Exception.thrown(new Eof());
		};
		this.pos++;
		return buf[0];
	}
	readBytes(s, pos, len) {
		let data = s.b;
		let buf = Buffer.from(data.buffer, data.byteOffset, s.length);
		let bytesRead;
		try {
			bytesRead = Fs.readSync(this.fd, buf, pos, len, this.pos);
		}catch (_g) {
			NativeStackTrace.lastError = _g;
			let e = Exception.caught(_g).unwrap();
			if (e.code == "EOF") {
				throw Exception.thrown(new Eof());
			} else {
				throw Exception.thrown(Error.Custom(e));
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