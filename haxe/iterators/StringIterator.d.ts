
/**
This iterator can be used to iterate over char codes in a string.

Note that char codes may differ across platforms because of different
internal encoding of strings in different of runtimes.
*/
export declare class StringIterator {
	constructor(s: string)
	protected offset: number
	protected s: string
	
	/**
	See `Iterator.hasNext`
	*/
	hasNext(): boolean
	
	/**
	See `Iterator.next`
	*/
	next(): number
}

//# sourceMappingURL=StringIterator.d.ts.map