import {Register} from "./genes/Register"
import {Std} from "./Std"
import {HxOverrides} from "./HxOverrides"

/**
A String buffer is an efficient way to build a big string by appending small
elements together.

Its cross-platform implementation uses String concatenation internally, but
StringBuf may be optimized for different targets.

Unlike String, an instance of StringBuf is not immutable in the sense that
it can be passed as argument to functions which modify it by appending more
values. However, the internal buffer cannot be modified.
*/
export const StringBuf = Register.global("$hxClasses")["StringBuf"] = 
class StringBuf extends Register.inherits() {
	new() {
		this.b = "";
	}
	get length() {
		return this.get_length()
	}
	get_length() {
		return this.b.length;
	}
	
	/**
	Appends the representation of `x` to `this` StringBuf.
	
	The exact representation of `x` may vary per platform. To get more
	consistent behavior, this function should be called with
	Std.string(x).
	
	If `x` is null, the String "null" is appended.
	*/
	add(x) {
		this.b += Std.string(x);
	}
	
	/**
	Appends the character identified by `c` to `this` StringBuf.
	
	If `c` is negative or has another invalid value, the result is
	unspecified.
	*/
	addChar(c) {
		this.b += String.fromCodePoint(c);
	}
	
	/**
	Appends a substring of `s` to `this` StringBuf.
	
	This function expects `pos` and `len` to describe a valid substring of
	`s`, or else the result is unspecified. To get more robust behavior,
	`this.add(s.substr(pos,len))` can be used instead.
	
	If `s` or `pos` are null, the result is unspecified.
	
	If `len` is omitted or null, the substring ranges from `pos` to the end
	of `s`.
	*/
	addSub(s, pos, len = null) {
		this.b += (len == null) ? HxOverrides.substr(s, pos, null) : HxOverrides.substr(s, pos, len);
	}
	
	/**
	Returns the content of `this` StringBuf as String.
	
	The buffer is not emptied by this operation.
	*/
	toString() {
		return this.b;
	}
	static get __name__() {
		return "StringBuf"
	}
	get __class__() {
		return StringBuf
	}
}


//# sourceMappingURL=StringBuf.js.map