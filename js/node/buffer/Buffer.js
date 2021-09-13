import {Bytes} from "../../../haxe/io/Bytes.js"
import {Register} from "../../../genes/Register.js"

const $global = Register.$global

export const Helper = Register.global("$hxClasses")["js.node.buffer._Buffer.Helper"] = 
class Helper {
	static bytesOfBuffer(b) {
		var o = Object.create(Bytes.prototype);
		o.length = b.byteLength;
		o.b = b;
		b.bufferValue = b;
		b.hxBytes = o;
		b.bytes = b;
		return o;
	}
	static get __name__() {
		return "js.node.buffer._Buffer.Helper"
	}
	get __class__() {
		return Helper
	}
}


//# sourceMappingURL=Buffer.js.map