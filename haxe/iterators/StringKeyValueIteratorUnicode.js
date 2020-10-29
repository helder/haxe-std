import {Register} from "../../genes/Register"

/**
This iterator can be used to iterate across strings in a cross-platform
way. It handles surrogate pairs on platforms that require it. On each
iteration, it returns the next character offset as key and the next
character code as value.

Note that in the general case, because of surrogate pairs, the key values
should not be used as offsets for various String API operations. For the
same reason, the last key value returned might be less than `s.length - 1`.
*/
export const StringKeyValueIteratorUnicode = Register.global("$hxClasses")["haxe.iterators.StringKeyValueIteratorUnicode"] = 
class StringKeyValueIteratorUnicode extends Register.inherits() {
	new(s) {
		this.charOffset = 0;
		this.byteOffset = 0;
		this.s = s;
	}
	
	/**
	See `Iterator.hasNext`
	*/
	hasNext() {
		return this.byteOffset < this.s.length;
	}
	
	/**
	See `Iterator.next`
	*/
	next() {
		var s = this.s;
		var index = this.byteOffset++;
		var c = s.charCodeAt(index);
		if (c >= 55296 && c <= 56319) {
			c = c - 55232 << 10 | s.charCodeAt(index + 1) & 1023;
		};
		var c1 = c;
		if (c1 >= 65536) {
			this.byteOffset++;
		};
		return {"key": this.charOffset++, "value": c1};
	}
	
	/**
	Convenience function which can be used as a static extension.
	*/
	static unicodeKeyValueIterator(s) {
		return new StringKeyValueIteratorUnicode(s);
	}
	static get __name__() {
		return "haxe.iterators.StringKeyValueIteratorUnicode"
	}
	get __class__() {
		return StringKeyValueIteratorUnicode
	}
}


//# sourceMappingURL=StringKeyValueIteratorUnicode.js.map