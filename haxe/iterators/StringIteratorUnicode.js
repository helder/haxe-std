import {Register} from "../../genes/Register"

/**
This iterator can be used to iterate across strings in a cross-platform
way. It handles surrogate pairs on platforms that require it. On each
iteration, it returns the next character code.

Note that this has different semantics than a standard for-loop over the
String's length due to the fact that it deals with surrogate pairs.
*/
export const StringIteratorUnicode = Register.global("$hxClasses")["haxe.iterators.StringIteratorUnicode"] = 
class StringIteratorUnicode extends Register.inherits() {
	new(s) {
		this.offset = 0;
		this.s = s;
	}
	
	/**
	See `Iterator.hasNext`
	*/
	hasNext() {
		return this.offset < this.s.length;
	}
	
	/**
	See `Iterator.next`
	*/
	next() {
		let s = this.s;
		let index = this.offset++;
		let c = s.charCodeAt(index);
		if (c >= 55296 && c <= 56319) {
			c = c - 55232 << 10 | s.charCodeAt(index + 1) & 1023;
		};
		let c1 = c;
		if (c1 >= 65536) {
			this.offset++;
		};
		return c1;
	}
	
	/**
	Convenience function which can be used as a static extension.
	*/
	static unicodeIterator(s) {
		return new StringIteratorUnicode(s);
	}
	static get __name__() {
		return "haxe.iterators.StringIteratorUnicode"
	}
	get __class__() {
		return StringIteratorUnicode
	}
}


//# sourceMappingURL=StringIteratorUnicode.js.map