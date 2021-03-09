import {Bytes} from "../io/Bytes.js"
import {BaseCode} from "./BaseCode.js"
import {Register} from "../../genes/Register.js"
import {HxOverrides} from "../../HxOverrides.js"

/**
Allows one to encode/decode String and bytes using Base64 encoding.
*/
export const Base64 = Register.global("$hxClasses")["haxe.crypto.Base64"] = 
class Base64 {
	static encode(bytes, complement = true) {
		var str = new BaseCode(Base64.BYTES).encodeBytes(bytes).toString();
		if (complement) {
			switch (bytes.length % 3) {
				case 1:
					str += "==";
					break
				case 2:
					str += "=";
					break
				default:
				
			};
		};
		return str;
	}
	static decode(str, complement = true) {
		if (complement) {
			while (HxOverrides.cca(str, str.length - 1) == 61) str = HxOverrides.substr(str, 0, -1);
		};
		return new BaseCode(Base64.BYTES).decodeBytes(Bytes.ofString(str));
	}
	static urlEncode(bytes, complement = false) {
		var str = new BaseCode(Base64.URL_BYTES).encodeBytes(bytes).toString();
		if (complement) {
			switch (bytes.length % 3) {
				case 1:
					str += "==";
					break
				case 2:
					str += "=";
					break
				default:
				
			};
		};
		return str;
	}
	static urlDecode(str, complement = false) {
		if (complement) {
			while (HxOverrides.cca(str, str.length - 1) == 61) str = HxOverrides.substr(str, 0, -1);
		};
		return new BaseCode(Base64.URL_BYTES).decodeBytes(Bytes.ofString(str));
	}
	static get __name__() {
		return "haxe.crypto.Base64"
	}
	get __class__() {
		return Base64
	}
}


Base64.CHARS = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/"
Base64.BYTES = Bytes.ofString(Base64.CHARS)
Base64.URL_CHARS = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-_"
Base64.URL_BYTES = Bytes.ofString(Base64.URL_CHARS)
//# sourceMappingURL=Base64.js.map