import {Output} from "./Output.js"
import {BytesBuffer} from "./BytesBuffer.js"
import {Register} from "../../genes/Register.js"

export const BytesOutput = Register.global("$hxClasses")["haxe.io.BytesOutput"] = 
class BytesOutput extends Register.inherits(Output) {
	new() {
		this.b = new BytesBuffer();
	}
	get length() {
		return this.get_length()
	}
	get_length() {
		return this.b.pos;
	}
	writeByte(c) {
		this.b.addByte(c);
	}
	writeBytes(buf, pos, len) {
		this.b.addBytes(buf, pos, len);
		return len;
	}
	
	/**
	Returns the `Bytes` of this output.
	
	This function should not be called more than once on a given
	`BytesOutput` instance.
	*/
	getBytes() {
		return this.b.getBytes();
	}
	static get __name__() {
		return "haxe.io.BytesOutput"
	}
	static get __super__() {
		return Output
	}
	get __class__() {
		return BytesOutput
	}
}


//# sourceMappingURL=BytesOutput.js.map