import {HaxeError} from "../../js/Boot.js"
import {Input} from "../../haxe/io/Input.js"
import {Error} from "../../haxe/io/Error.js"
import {Eof} from "../../haxe/io/Eof.js"
import {CallStack} from "../../haxe/CallStack.js"
import {Register} from "../../genes/Register.js"
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
		var buf = Buffer.alloc(1);
		var bytesRead;
		try {
			bytesRead = Fs.readSync(this.fd, buf, 0, 1, this.pos);
		}catch (e) {
			CallStack.lastException = e;
			var e1 = (((e) instanceof HaxeError)) ? e.val : e;
			if (e1.code == "EOF") {
				throw new HaxeError(new Eof());
			} else {
				throw new HaxeError(Error.Custom(e1));
			};
		};
		if (bytesRead == 0) {
			throw new HaxeError(new Eof());
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
		}catch (e) {
			CallStack.lastException = e;
			var e1 = (((e) instanceof HaxeError)) ? e.val : e;
			if (e1.code == "EOF") {
				throw new HaxeError(new Eof());
			} else {
				throw new HaxeError(Error.Custom(e1));
			};
		};
		if (bytesRead == 0) {
			throw new HaxeError(new Eof());
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