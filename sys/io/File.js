import {FileOutput} from "./FileOutput"
import {FileInput} from "./FileInput"
import {Helper} from "../../js/node/buffer/Buffer"
import {Register} from "../../genes/Register"
import * as Fs from "fs"
import {Buffer} from "buffer"

export const File = Register.global("$hxClasses")["sys.io.File"] = 
class File {
	static append(path, binary = true) {
		return new FileOutput(Fs.openSync(path, "a"));
	}
	static write(path, binary = true) {
		return new FileOutput(Fs.openSync(path, "w"));
	}
	static read(path, binary = true) {
		return new FileInput(Fs.openSync(path, "r"));
	}
	static getContent(path) {
		return Fs.readFileSync(path, {"encoding": "utf8"});
	}
	static saveContent(path, content) {
		Fs.writeFileSync(path, content);
	}
	static getBytes(path) {
		return Helper.bytesOfBuffer(Fs.readFileSync(path));
	}
	static saveBytes(path, bytes) {
		var data = bytes.b;
		Fs.writeFileSync(path, Buffer.from(data.buffer, data.byteOffset, bytes.length));
	}
	static copy(srcPath, dstPath) {
		var src = Fs.openSync(srcPath, "r");
		var stat = Fs.fstatSync(src);
		var dst = Fs.openSync(dstPath, "w", stat.mode);
		var bytesRead;
		var pos = 0;
		while (true) {
			bytesRead = Fs.readSync(src, File.copyBuf, 0, 65536, pos);
			if (!(bytesRead > 0)) {
				break;
			};
			Fs.writeSync(dst, File.copyBuf, 0, bytesRead);
			pos += bytesRead;
		};
		Fs.closeSync(src);
		Fs.closeSync(dst);
	}
	static get __name__() {
		return "sys.io.File"
	}
	get __class__() {
		return File
	}
}


File.copyBufLen = 65536
File.copyBuf = Buffer.alloc(65536)
//# sourceMappingURL=File.js.map