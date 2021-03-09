
/**
This Key/Value iterator can be used to iterate over `haxe.DynamicAccess`.
*/
export declare class DynamicAccessKeyValueIterator<T> {
	constructor(access: {[key: string]: T})
	
	/**
	See `Iterator.hasNext`
	*/
	hasNext(): boolean
	
	/**
	See `Iterator.next`
	*/
	next(): {key: string, value: T}
}

//# sourceMappingURL=DynamicAccessKeyValueIterator.d.ts.map