
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
export declare class IntIterator {
	constructor(min: number, max: number)
	protected min: number
	protected max: number
	
	/**
	Returns true if the iterator has other items, false otherwise.
	*/
	hasNext(): boolean
	
	/**
	Moves to the next item of the iterator.
	
	If this is called while hasNext() is false, the result is unspecified.
	*/
	next(): number
}

//# sourceMappingURL=IntIterator.d.ts.map