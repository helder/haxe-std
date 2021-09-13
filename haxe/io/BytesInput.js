import {Input} from "./Input.js"
import {Error as Error__1} from "./Error.js"
import {Eof} from "./Eof.js"
import {Exception} from "../Exception.js"
import {Register} from "../../genes/Register.js"

const $global = Register.$global

export const BytesInput = Register.global("$hxClasses")["haxe.io.BytesInput"] = 
class BytesInput extends Register.inherits(Input) {
	new(b, pos, len) {
		if (pos == null) {
			pos = 0;
		};
		if (len == null) {
			len = b.length - pos;
		};
		if (pos < 0 || len < 0 || pos + len > b.length) {
			throw Exception.thrown(Error__1.OutsideBounds);
		};
		this.b = b.b;
		this.pos = pos;
		this.len = len;
		this.totlen = len;
	}
	get position() {
		return this.get_position()
	}
	set position(v) {
		this.set_position(v)
	}
	get length() {
		return this.get_length()
	}
	get_position() {
		return this.pos;
	}
	get_length() {
		return this.totlen;
	}
	set_position(p) {
		if (p < 0) {
			p = 0;
		} else if (p > this.totlen) {
			p = this.totlen;
		};
		this.len = this.totlen - p;
		return this.pos = p;
	}
	readByte() {
		if (this.len == 0) {
			throw Exception.thrown(new Eof());
		};
		this.len--;
		return this.b[this.pos++];
	}
	readBytes(buf, pos, len) {
		if (pos < 0 || len < 0 || pos + len > buf.length) {
			throw Exception.thrown(Error__1.OutsideBounds);
		};
		if (this.len == 0 && len > 0) {
			throw Exception.thrown(new Eof());
		};
		if (this.len < len) {
			len = this.len;
		};
		var b1 = this.b;
		var b2 = buf.b;
		var _g = 0;
		var _g1 = len;
		while (_g < _g1) {
			var i = _g++;
			b2[pos + i] = b1[this.pos + i];
		};
		this.pos += len;
		this.len -= len;
		return len;
	}
	static get __name__() {
		return "haxe.io.BytesInput"
	}
	static get __super__() {
		return Input
	}
	get __class__() {
		return BytesInput
	}
}


//# sourceMappingURL=BytesInput.js.map