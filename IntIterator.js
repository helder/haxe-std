import {Register} from "./genes/Register.js"

/**
IntIterator is used for implementing interval iterations.

It is usually not used explicitly, but through its special syntax:
`min...max`

While it is possible to assign an instance of IntIterator to a variable or
field, it is worth noting that IntIterator does not reset after being used
in a for-loop. Subsequent uses of the same instance will then have no
effect.

@see https://haxe.org/manual/lf-iterators.html
*/
export const IntIterator = Register.global("$hxClasses")["IntIterator"] = 
class IntIterator extends Register.inherits() {
	new(min, max) {
		this.min = min;
		this.max = max;
	}
	
	/**
	Returns true if the iterator has other items, false otherwise.
	*/
	hasNext() {
		return this.min < this.max;
	}
	
	/**
	Moves to the next item of the iterator.
	
	If this is called while hasNext() is false, the result is unspecified.
	*/
	next() {
		return this.min++;
	}
	static get __name__() {
		return "IntIterator"
	}
	get __class__() {
		return IntIterator
	}
}


//# sourceMappingURL=IntIterator.js.map