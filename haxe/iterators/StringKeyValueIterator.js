import {Register} from "../../genes/Register.js"

const $global = Register.$global

/**
This iterator can be used to iterate over char indexes and char codes in a string.

Note that char codes may differ across platforms because of different
internal encoding of strings in different runtimes.
*/
export const StringKeyValueIterator = Register.global("$hxClasses")["haxe.iterators.StringKeyValueIterator"] = 
class StringKeyValueIterator extends Register.inherits() {
	new(s) {
		this.offset = 0;
		this.s = s;
	}
	
	/**
	See `KeyValueIterator.hasNext`
	*/
	hasNext() {
		return this.offset < this.s.length;
	}
	
	/**
	See `KeyValueIterator.next`
	*/
	next() {
		return {"key": this.offset, "value": this.s.charCodeAt(this.offset++)};
	}
	static get __name__() {
		return "haxe.iterators.StringKeyValueIterator"
	}
	get __class__() {
		return StringKeyValueIterator
	}
}


//# sourceMappingURL=StringKeyValueIterator.js.map