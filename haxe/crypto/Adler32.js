import {Register} from "../../genes/Register"
import {StringTools} from "../../StringTools"

/**
Calculates the Adler32 of the given Bytes.
*/
export const Adler32 = Register.global("$hxClasses")["haxe.crypto.Adler32"] = 
class Adler32 extends Register.inherits() {
	new() {
		this.a1 = 1;
		this.a2 = 0;
	}
	get() {
		return this.a2 << 16 | this.a1;
	}
	update(b, pos, len) {
		let a1 = this.a1;
		let a2 = this.a2;
		let _g = pos;
		let _g1 = pos + len;
		while (_g < _g1) {
			let p = _g++;
			let c = b.b[p];
			a1 = (a1 + c) % 65521;
			a2 = (a2 + a1) % 65521;
		};
		this.a1 = a1;
		this.a2 = a2;
	}
	equals(a) {
		if (a.a1 == this.a1) {
			return a.a2 == this.a2;
		} else {
			return false;
		};
	}
	toString() {
		return StringTools.hex(this.a2, 8) + StringTools.hex(this.a1, 8);
	}
	static read(i) {
		let a = new Adler32();
		let a2a = i.readByte();
		let a2b = i.readByte();
		let a1a = i.readByte();
		let a1b = i.readByte();
		a.a1 = a1a << 8 | a1b;
		a.a2 = a2a << 8 | a2b;
		return a;
	}
	static make(b) {
		let a = new Adler32();
		a.update(b, 0, b.length);
		return a.get();
	}
	static get __name__() {
		return "haxe.crypto.Adler32"
	}
	get __class__() {
		return Adler32
	}
}


//# sourceMappingURL=Adler32.js.map