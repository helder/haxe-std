import {Input} from "./Input"
import {Register} from "../../genes/Register"

export const BufferInput = Register.global("$hxClasses")["haxe.io.BufferInput"] = 
class BufferInput extends Register.inherits(Input) {
	new(i, buf, pos = 0, available = 0) {
		this.i = i;
		this.buf = buf;
		this.pos = pos;
		this.available = available;
	}
	refill() {
		if (this.pos > 0) {
			this.buf.blit(0, this.buf, this.pos, this.available);
			this.pos = 0;
		};
		this.available += this.i.readBytes(this.buf, this.available, this.buf.length - this.available);
	}
	readByte() {
		if (this.available == 0) {
			this.refill();
		};
		var c = this.buf.b[this.pos];
		this.pos++;
		this.available--;
		return c;
	}
	readBytes(buf, pos, len) {
		if (this.available == 0) {
			this.refill();
		};
		var size = (len > this.available) ? this.available : len;
		buf.blit(pos, this.buf, this.pos, size);
		this.pos += size;
		this.available -= size;
		return size;
	}
	static get __name__() {
		return "haxe.io.BufferInput"
	}
	static get __super__() {
		return Input
	}
	get __class__() {
		return BufferInput
	}
}


//# sourceMappingURL=BufferInput.js.map