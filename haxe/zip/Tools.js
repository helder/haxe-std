import {Uncompress} from "./Uncompress.js"
import {Compress} from "./Compress.js"
import {Bytes} from "../io/Bytes.js"
import {Exception} from "../Exception.js"
import {Register} from "../../genes/Register.js"

const $global = Register.$global

export const Tools = Register.global("$hxClasses")["haxe.zip.Tools"] = 
class Tools {
	static compress(f, level) {
		if (f.compressed) {
			return;
		};
		var data = Compress.run(f.data, level);
		f.compressed = true;
		f.data = data.sub(2, data.length - 6);
		f.dataSize = f.data.length;
	}
	static uncompress(f) {
		if (!f.compressed) {
			return;
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
	}
	static get __name__() {
		return "haxe.zip.Tools"
	}
	get __class__() {
		return Tools
	}
}


//# sourceMappingURL=Tools.js.map