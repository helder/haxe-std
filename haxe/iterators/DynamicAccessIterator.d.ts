
/**
This iterator can be used to iterate over the values of `haxe.DynamicAccess`.
*/
export declare class DynamicAccessIterator<T> {
	constructor(access: {[key: string]: T})
	
	/**
	See `Iterator.hasNext`
	*/
	hasNext(): boolean
	
	/**
	See `Iterator.next`
	*/
	next(): T
}

//# sourceMappingURL=DynamicAccessIterator.d.ts.map