
/**
This iterator can be used to iterate across strings in a cross-platform
way. It handles surrogate pairs on platforms that require it. On each
iteration, it returns the next character offset as key and the next
character code as value.

Note that in the general case, because of surrogate pairs, the key values
should not be used as offsets for various String API operations. For the
same reason, the last key value returned might be less than `s.length - 1`.
*/
export declare class StringKeyValueIteratorUnicode {
	constructor(s: string)
	protected byteOffset: number
	protected charOffset: number
	protected s: string
	
	/**
	See `Iterator.hasNext`
	*/
	hasNext(): boolean
	
	/**
	See `Iterator.next`
	*/
	next(): {key: number, value: number}
	
	/**
	Convenience function which can be used as a static extension.
	*/
	static unicodeKeyValueIterator(s: string): StringKeyValueIteratorUnicode
}

//# sourceMappingURL=StringKeyValueIteratorUnicode.d.ts.map