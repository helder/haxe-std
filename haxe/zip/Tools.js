import {Compress} from "./Compress"
import {Register} from "../../genes/Register"

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
	static get __name__() {
		return "haxe.zip.Tools"
	}
	get __class__() {
		return Tools
	}
}


//# sourceMappingURL=Tools.js.map