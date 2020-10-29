import {Register} from "../../genes/Register"

/**
Calculates the Crc32 of the given Bytes.
*/
export const Crc32 = Register.global("$hxClasses")["haxe.crypto.Crc32"] = 
class Crc32 extends Register.inherits() {
	new() {
		this.crc = -1;
	}
	byte(b) {
		var tmp = (this.crc ^ b) & 255;
		tmp = tmp >>> 1 ^ -(tmp & 1) & -306674912;
		tmp = tmp >>> 1 ^ -(tmp & 1) & -306674912;
		tmp = tmp >>> 1 ^ -(tmp & 1) & -306674912;
		tmp = tmp >>> 1 ^ -(tmp & 1) & -306674912;
		tmp = tmp >>> 1 ^ -(tmp & 1) & -306674912;
		tmp = tmp >>> 1 ^ -(tmp & 1) & -306674912;
		tmp = tmp >>> 1 ^ -(tmp & 1) & -306674912;
		tmp = tmp >>> 1 ^ -(tmp & 1) & -306674912;
		this.crc = this.crc >>> 8 ^ tmp;
	}
	update(b, pos, len) {
		var b1 = b.b.bufferValue;
		var _g = pos;
		var _g1 = pos + len;
		while (_g < _g1) {
			var i = _g++;
			var tmp = (this.crc ^ b1.bytes[i]) & 255;
			tmp = tmp >>> 1 ^ -(tmp & 1) & -306674912;
			tmp = tmp >>> 1 ^ -(tmp & 1) & -306674912;
			tmp = tmp >>> 1 ^ -(tmp & 1) & -306674912;
			tmp = tmp >>> 1 ^ -(tmp & 1) & -306674912;
			tmp = tmp >>> 1 ^ -(tmp & 1) & -306674912;
			tmp = tmp >>> 1 ^ -(tmp & 1) & -306674912;
			tmp = tmp >>> 1 ^ -(tmp & 1) & -306674912;
			tmp = tmp >>> 1 ^ -(tmp & 1) & -306674912;
			this.crc = this.crc >>> 8 ^ tmp;
		};
	}
	get() {
		return this.crc ^ -1;
	}
	
	/**
	Calculates the CRC32 of the given data bytes
	*/
	static make(data) {
		var c_crc = -1;
		var b = data.b.bufferValue;
		var _g = 0;
		var _g1 = data.length;
		while (_g < _g1) {
			var i = _g++;
			var tmp = (c_crc ^ b.bytes[i]) & 255;
			tmp = tmp >>> 1 ^ -(tmp & 1) & -306674912;
			tmp = tmp >>> 1 ^ -(tmp & 1) & -306674912;
			tmp = tmp >>> 1 ^ -(tmp & 1) & -306674912;
			tmp = tmp >>> 1 ^ -(tmp & 1) & -306674912;
			tmp = tmp >>> 1 ^ -(tmp & 1) & -306674912;
			tmp = tmp >>> 1 ^ -(tmp & 1) & -306674912;
			tmp = tmp >>> 1 ^ -(tmp & 1) & -306674912;
			tmp = tmp >>> 1 ^ -(tmp & 1) & -306674912;
			c_crc = c_crc >>> 8 ^ tmp;
		};
		return c_crc ^ -1;
	}
	static get __name__() {
		return "haxe.crypto.Crc32"
	}
	get __class__() {
		return Crc32
	}
}


//# sourceMappingURL=Crc32.js.map