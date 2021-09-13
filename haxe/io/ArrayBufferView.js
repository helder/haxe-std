import {Bytes} from "./Bytes.js"
import {Register} from "../../genes/Register.js"

const $global = Register.$global

export const ArrayBufferView = Register.global("$hxClasses")["haxe.io._ArrayBufferView.ArrayBufferView"] = 
class ArrayBufferView {
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
	static sub(this1, begin, length) {
		return new Uint8Array(this1.buffer, begin, (length == null) ? this1.buffer.byteLength - begin : length);
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
		return ArrayBufferView
	}
}


//# sourceMappingURL=ArrayBufferView.js.map