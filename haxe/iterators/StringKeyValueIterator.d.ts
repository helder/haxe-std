
/**
This iterator can be used to iterate over char indexes and char codes in a string.

Note that char codes may differ across platforms because of different
internal encoding of strings in different runtimes.
*/
export declare class StringKeyValueIterator {
	constructor(s: string)
	protected offset: number
	protected s: string
	
	/**
	See `KeyValueIterator.hasNext`
	*/
	hasNext(): boolean
	
	/**
	See `KeyValueIterator.next`
	*/
	next(): {key: number, value: number}
}

//# sourceMappingURL=StringKeyValueIterator.d.ts.map