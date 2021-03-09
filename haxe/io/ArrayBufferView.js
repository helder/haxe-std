import {Bytes} from "./Bytes.js"
import {Register} from "../../genes/Register.js"

export const ArrayBufferView_Impl_ = Register.global("$hxClasses")["haxe.io._ArrayBufferView.ArrayBufferView_Impl_"] = 
class ArrayBufferView_Impl_ {
	static get buffer() {
		return this.get_buffer()
	}
	static get byteOffset() {
		return this.get_byteOffset()
	}
	static get byteLength() {
		return this.get_byteLength()
	}
	static _new(size) {
		var this1 = new Uint8Array(size);
		return this1;
	}
	static get_byteOffset(this1) {
		return this1.byteOffset;
	}
	static get_byteLength(this1) {
		return this1.byteLength;
	}
	static get_buffer(this1) {
		return Bytes.ofData(this1.buffer);
	}
	static sub(this1, begin, length = null) {
		return new Uint8Array(this1.buffer.slice(begin, (length == null) ? null : begin + length));
	}
	static getData(this1) {
		return this1;
	}
	static fromData(a) {
		return a;
	}
	static get __name__() {
		return "haxe.io._ArrayBufferView.ArrayBufferView_Impl_"
	}
	get __class__() {
		return ArrayBufferView_Impl_
	}
}


//# sourceMappingURL=ArrayBufferView.js.map