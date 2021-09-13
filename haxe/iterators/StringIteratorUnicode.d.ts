
/**
This iterator can be used to iterate across strings in a cross-platform
way. It handles surrogate pairs on platforms that require it. On each
iteration, it returns the next character code.

Note that this has different semantics than a standard for-loop over the
String's length due to the fact that it deals with surrogate pairs.
*/
export declare class StringIteratorUnicode {
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
	
	/**
	Convenience function which can be used as a static extension.
	*/
	static unicodeIterator(s: string): StringIteratorUnicode
}

//# sourceMappingURL=StringIteratorUnicode.d.ts.map