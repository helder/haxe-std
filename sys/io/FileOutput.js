import {Output} from "../../haxe/io/Output.js"
import {Register} from "../../genes/Register.js"
import * as Fs from "fs"
import {Buffer} from "buffer"

/**
Use `sys.io.File.write` to create a `FileOutput`.
*/
export const FileOutput = Register.global("$hxClasses")["sys.io.FileOutput"] = 
class FileOutput extends Register.inherits(Output) {
	new(fd) {
		this.fd = fd;
		this.pos = 0;
	}
	writeByte(b) {
		var buf = Buffer.alloc(1);
		buf[0] = b;
		Fs.writeSync(this.fd, buf, 0, 1, this.pos);
		this.pos++;
	}
	writeBytes(s, pos, len) {
		var data = s.b;
		var buf = Buffer.from(data.buffer, data.byteOffset, s.length);
		var wrote = Fs.writeSync(this.fd, buf, pos, len, this.pos);
		this.pos += wrote;
		return wrote;
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
	static get __name__() {
		return "sys.io.FileOutput"
	}
	static get __super__() {
		return Output
	}
	get __class__() {
		return FileOutput
	}
}


//# sourceMappingURL=FileOutput.js.map