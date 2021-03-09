import {Exception} from "./Exception.js"
import {Register} from "../genes/Register.js"
import {HxOverrides} from "../HxOverrides.js"

/**
Since not all platforms guarantee that `String` always uses UTF-8 encoding, you
can use this cross-platform API to perform operations on such strings.
*/
export const Utf8 = Register.global("$hxClasses")["haxe.Utf8"] = 
class Utf8 extends Register.inherits() {
	new(size = null) {
		this.__b = "";
	}
	
	/**
	Add the given UTF8 character code to the buffer.
	*/
	addChar(c) {
		this.__b += String.fromCodePoint(c);
	}
	
	/**
	Returns the buffer converted to a String.
	*/
	toString() {
		return this.__b;
	}
	
	/**
	Call the `chars` function for each UTF8 char of the string.
	*/
	static iter(s, chars) {
		let _g = 0;
		let _g1 = s.length;
		while (_g < _g1) {
			let i = _g++;
			chars(HxOverrides.cca(s, i));
		};
	}
	
	/**
	Encode the input ISO string into the corresponding UTF8 one.
	*/
	static encode(s) {
		throw Exception.thrown("Not implemented");
	}
	
	/**
	Decode an UTF8 string back to an ISO string.
	Throw an exception if a given UTF8 character is not supported by the decoder.
	*/
	static decode(s) {
		throw Exception.thrown("Not implemented");
	}
	
	/**
	Similar to `String.charCodeAt` but uses the UTF8 character position.
	*/
	static charCodeAt(s, index) {
		return HxOverrides.cca(s, index);
	}
	
	/**
	Tells if the String is correctly encoded as UTF8.
	*/
	static validate(s) {
		return true;
	}
	
	/**
	Compare two UTF8 strings, character by character.
	*/
	static compare(a, b) {
		if (a > b) {
			return 1;
		} else if (a == b) {
			return 0;
		} else {
			return -1;
		};
	}
	
	/**
	This is similar to `String.substr` but the `pos` and `len` parts are considering UTF8 characters.
	*/
	static sub(s, pos, len) {
		return HxOverrides.substr(s, pos, len);
	}
	static get __name__() {
		return "haxe.Utf8"
	}
	get __class__() {
		return Utf8
	}
}


//# sourceMappingURL=Utf8.js.map