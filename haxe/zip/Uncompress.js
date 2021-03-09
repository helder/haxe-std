import * as Zlib from "zlib"
import {Helper} from "../../js/node/buffer/Buffer.js"
import {Register} from "../../genes/Register.js"
import {Buffer} from "buffer"

export const Uncompress = Register.global("$hxClasses")["haxe.zip.Uncompress"] = 
class Uncompress extends Register.inherits() {
	new(windowBits = null) {
		this.windowBits = windowBits;
	}
	execute(src, srcPos, dst, dstPos) {
		var data = src.b;
		var src1 = Buffer.from(data.buffer, data.byteOffset, src.length).slice(srcPos);
		var data1 = dst.b;
		var dst1 = Buffer.from(data1.buffer, data1.byteOffset, dst.length);
		var res = Zlib.inflateRawSync(src1, {"info": true});
		var engine = res.engine;
		var res1 = res.buffer;
		dst1.set(res1, dstPos);
		return {"done": true, "read": engine.bytesRead, "write": res1.byteLength};
	}
	setFlushMode(f) {
	}
	close() {
	}
	static run(src, bufsize = null) {
		var data = src.b;
		var buffer = Zlib.inflateSync(Buffer.from(data.buffer, data.byteOffset, src.length), (bufsize == null) ? {} : {"chunkSize": bufsize});
		return Helper.bytesOfBuffer(buffer);
	}
	static get __name__() {
		return "haxe.zip.Uncompress"
	}
	get __class__() {
		return Uncompress
	}
}


//# sourceMappingURL=Uncompress.js.map