import {Register} from "../../genes/Register"

/**
This iterator is used only when `Array<T>` is passed to `Iterable<T>`
*/
export const ArrayIterator = Register.global("$hxClasses")["haxe.iterators.ArrayIterator"] = 
class ArrayIterator extends Register.inherits() {
	new(array) {
		this.current = 0;
		this.array = array;
	}
	
	/**
	See `Iterator.hasNext`
	*/
	hasNext() {
		return this.current < this.array.length;
	}
	
	/**
	See `Iterator.next`
	*/
	next() {
		return this.array[this.current++];
	}
	static get __name__() {
		return "haxe.iterators.ArrayIterator"
	}
	get __class__() {
		return ArrayIterator
	}
}


//# sourceMappingURL=ArrayIterator.js.map