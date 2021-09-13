
/**
This iterator is used only when `Array<T>` is passed to `Iterable<T>`
*/
export declare class ArrayIterator<T> {
	constructor(array: T[])
	protected array: T[]
	protected current: number
	
	/**
	See `Iterator.hasNext`
	*/
	hasNext(): boolean
	
	/**
	See `Iterator.next`
	*/
	next(): T
}

//# sourceMappingURL=ArrayIterator.d.ts.map