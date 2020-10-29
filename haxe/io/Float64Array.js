import {HaxeError} from "../../js/Boot"
import {Error} from "./Error"
import {Register} from "../../genes/Register"

export const Float64Array_Impl_ = Register.global("$hxClasses")["haxe.io._Float64Array.Float64Array_Impl_"] = 
class Float64Array_Impl_ {
	static get length() {
		return this.get_length()
	}
	static get view() {
		return this.get_view()
	}
	static _new(elements) {
		var this1 = new Float64Array(elements);
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
	static sub(this1, begin, length = null) {
		return this1.subarray(begin, (length == null) ? this1.length : begin + length);
	}
	static subarray(this1, begin = null, end = null) {
		return this1.subarray(begin, end);
	}
	static getData(this1) {
		return this1;
	}
	static fromData(d) {
		return d;
	}
	static fromArray(a, pos = 0, length = null) {
		if (length == null) {
			length = a.length - pos;
		};
		if (pos < 0 || length < 0 || pos + length > a.length) {
			throw new HaxeError(Error.OutsideBounds);
		};
		if (pos == 0 && length == a.length) {
			return new Float64Array(a);
		};
		var this1 = new Float64Array(a.length);
		var i = this1;
		var _g = 0;
		var _g1 = length;
		while (_g < _g1) {
			var idx = _g++;
			i[idx] = a[idx + pos];
		};
		return i;
	}
	static fromBytes(bytes, bytePos = 0, length = null) {
		if (length == null) {
			length = bytes.length - bytePos >> 3;
		};
		return new Float64Array(bytes.b.bufferValue, bytePos, length);
	}
	static get __name__() {
		return "haxe.io._Float64Array.Float64Array_Impl_"
	}
	get __class__() {
		return Float64Array_Impl_
	}
}


Float64Array_Impl_.BYTES_PER_ELEMENT = 8
//# sourceMappingURL=Float64Array.js.map