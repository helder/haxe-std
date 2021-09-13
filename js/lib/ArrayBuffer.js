import {Register} from "../../genes/Register.js"

const $global = Register.$global

export const ArrayBufferCompat = Register.global("$hxClasses")["js.lib._ArrayBuffer.ArrayBufferCompat"] = 
class ArrayBufferCompat {
	static sliceImpl(begin, end) {
		var u = new Uint8Array(this, begin, (end == null) ? null : end - begin);
		var resultArray = new Uint8Array(u.byteLength);
		resultArray.set(u);
		return resultArray.buffer;
	}
	static get __name__() {
		return "js.lib._ArrayBuffer.ArrayBufferCompat"
	}
	get __class__() {
		return ArrayBufferCompat
	}
}


;if (ArrayBuffer.prototype.slice == null) {
	ArrayBuffer.prototype.slice = ArrayBufferCompat.sliceImpl;
}

//# sourceMappingURL=ArrayBuffer.js.map