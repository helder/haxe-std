import {BytesBuffer} from "../io/BytesBuffer.js"
import {Sha256} from "./Sha256.js"
import {Sha1} from "./Sha1.js"
import {Md5} from "./Md5.js"
import {Register} from "../../genes/Register.js"

const $global = Register.$global

/**
Hash methods for Hmac calculation.
*/
export const HashMethod = 
Register.global("$hxEnums")["haxe.crypto.HashMethod"] = 
{
	__ename__: "haxe.crypto.HashMethod",
	
	MD5: {_hx_name: "MD5", _hx_index: 0, __enum__: "haxe.crypto.HashMethod"},
	SHA1: {_hx_name: "SHA1", _hx_index: 1, __enum__: "haxe.crypto.HashMethod"},
	SHA256: {_hx_name: "SHA256", _hx_index: 2, __enum__: "haxe.crypto.HashMethod"}
}
HashMethod.__constructs__ = [HashMethod.MD5, HashMethod.SHA1, HashMethod.SHA256]
HashMethod.__empty_constructs__ = [HashMethod.MD5, HashMethod.SHA1, HashMethod.SHA256]

/**
Calculates a Hmac of the given Bytes using a HashMethod.
*/
export const Hmac = Register.global("$hxClasses")["haxe.crypto.Hmac"] = 
class Hmac extends Register.inherits() {
	new(hashMethod) {
		this.method = hashMethod;
		this.blockSize = 64;
		var tmp;
		switch (hashMethod._hx_index) {
			case 0:
				tmp = 16;
				break
			case 1:
				tmp = 20;
				break
			case 2:
				tmp = 32;
				break
			
		};
		this.length = tmp;
	}
	doHash(b) {
		switch (this.method._hx_index) {
			case 0:
				return Md5.make(b);
				break
			case 1:
				return Sha1.make(b);
				break
			case 2:
				return Sha256.make(b);
				break
			
		};
	}
	nullPad(s, chunkLen) {
		var r = chunkLen - s.length % chunkLen;
		if (r == chunkLen && s.length != 0) {
			return s;
		};
		var sb = new BytesBuffer();
		sb.add(s);
		var _g = 0;
		var _g1 = r;
		while (_g < _g1) {
			var x = _g++;
			sb.addByte(0);
		};
		return sb.getBytes();
	}
	make(key, msg) {
		if (key.length > this.blockSize) {
			switch (this.method._hx_index) {
				case 0:
					key = Md5.make(key);
					break
				case 1:
					key = Sha1.make(key);
					break
				case 2:
					key = Sha256.make(key);
					break
				
			};
		};
		key = this.nullPad(key, this.blockSize);
		var Ki = new BytesBuffer();
		var Ko = new BytesBuffer();
		var _g = 0;
		var _g1 = key.length;
		while (_g < _g1) {
			var i = _g++;
			Ko.addByte(key.b[i] ^ 92);
			Ki.addByte(key.b[i] ^ 54);
		};
		Ki.add(msg);
		var b = Ki.getBytes();
		var tmp;
		switch (this.method._hx_index) {
			case 0:
				tmp = Md5.make(b);
				break
			case 1:
				tmp = Sha1.make(b);
				break
			case 2:
				tmp = Sha256.make(b);
				break
			
		};
		Ko.add(tmp);
		var b = Ko.getBytes();
		switch (this.method._hx_index) {
			case 0:
				return Md5.make(b);
				break
			case 1:
				return Sha1.make(b);
				break
			case 2:
				return Sha256.make(b);
				break
			
		};
	}
	static get __name__() {
		return "haxe.crypto.Hmac"
	}
	get __class__() {
		return Hmac
	}
}


//# sourceMappingURL=Hmac.js.map