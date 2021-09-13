import {Register} from "../../genes/Register.js"

const $global = Register.$global

/**
This iterator can be used to iterate over char codes in a string.

Note that char codes may differ across platforms because of different
internal encoding of strings in different of runtimes.
*/
export const StringIterator = Register.global("$hxClasses")["haxe.iterators.StringIterator"] = 
class StringIterator extends Register.inherits() {
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
		return this.s.charCodeAt(this.offset++);
	}
	static get __name__() {
		return "haxe.iterators.StringIterator"
	}
	get __class__() {
		return StringIterator
	}
}


//# sourceMappingURL=StringIterator.js.map