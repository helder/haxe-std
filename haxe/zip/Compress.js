import * as Zlib from "zlib"
import {Helper} from "../../js/node/buffer/Buffer"
import {Exception} from "../Exception"
import {Register} from "../../genes/Register"
import {Buffer} from "buffer"

export const Compress = Register.global("$hxClasses")["haxe.zip.Compress"] = 
class Compress extends Register.inherits() {
	new(level) {
		throw Exception.thrown("Not implemented for this platform");
	}
	execute(src, srcPos, dst, dstPos) {
		return null;
	}
	setFlushMode(f) {
	}
	close() {
	}
	static run(s, level) {
		let data = s.b;
		let buffer = Zlib.deflateSync(Buffer.from(data.buffer, data.byteOffset, s.length), {"level": level});
		return Helper.bytesOfBuffer(buffer);
	}
	static get __name__() {
		return "haxe.zip.Compress"
	}
	get __class__() {
		return Compress
	}
}


//# sourceMappingURL=Compress.js.map