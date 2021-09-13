import {Error as Error__1} from "./Error.js"
import {Exception} from "../Exception.js"
import {Register} from "../../genes/Register.js"

const $global = Register.$global

export const UInt8Array = Register.global("$hxClasses")["haxe.io._UInt8Array.UInt8Array"] = 
class UInt8Array {
	static get length() {
		return this.get_length()
	}
	static get view() {
		return this.get_view()
	}
	static _new(elements) {
		var this1 = new Uint8Array(elements);
		return this1;
	}
	static get_length(this1) {
		return this1.length;
	}
	static get_view(this1) {
		return this1;
	}
	static get(this1, index) {
		return this1[index];
	}
	static set(this1, index, value) {
		return this1[index] = value;
	}
	static sub(this1, begin, length) {
		return this1.subarray(begin, (length == null) ? this1.length : begin + length);
	}
	static subarray(this1, begin, end) {
		return this1.subarray(begin, end);
	}
	static getData(this1) {
		return this1;
	}
	static fromData(d) {
		return d;
	}
	static fromArray(a, pos, length) {
		if (pos == null) {
			pos = 0;
		};
		if (length == null) {
			length = a.length - pos;
		};
		if (pos < 0 || length < 0 || pos + length > a.length) {
			throw Exception.thrown(Error__1.OutsideBounds);
		};
		if (pos == 0 && length == a.length) {
			return new Uint8Array(a);
		};
		var this1 = new Uint8Array(a.length);
		var i = this1;
		var _g = 0;
		var _g1 = length;
		while (_g < _g1) {
			var idx = _g++;
			i[idx] = a[idx + pos];
		};
		return i;
	}
	static fromBytes(bytes, bytePos, length) {
		if (bytePos == null) {
			bytePos = 0;
		};
		if (length == null) {
			length = bytes.length - bytePos;
		};
		return new Uint8Array(bytes.b.bufferValue, bytePos, length);
	}
	static get __name__() {
		return "haxe.io._UInt8Array.UInt8Array_Impl_"
	}
	get __class__() {
		return UInt8Array
	}
}


UInt8Array.BYTES_PER_ELEMENT = 1
//# sourceMappingURL=UInt8Array.js.map