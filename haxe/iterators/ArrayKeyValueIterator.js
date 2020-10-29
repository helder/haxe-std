import {Register} from "../../genes/Register"

export const ArrayKeyValueIterator = Register.global("$hxClasses")["haxe.iterators.ArrayKeyValueIterator"] = 
class ArrayKeyValueIterator extends Register.inherits() {
	new(array) {
		this.current = 0;
		this.array = array;
	}
	hasNext() {
		return this.current < this.array.length;
	}
	next() {
		return {"value": this.array[this.current], "key": this.current++};
	}
	static get __name__() {
		return "haxe.iterators.ArrayKeyValueIterator"
	}
	get __class__() {
		return ArrayKeyValueIterator
	}
}


//# sourceMappingURL=ArrayKeyValueIterator.js.map