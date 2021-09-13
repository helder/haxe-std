
export declare class ArrayKeyValueIterator<T> {
	constructor(array: T[])
	protected current: number
	protected array: T[]
	hasNext(): boolean
	next(): {key: number, value: T}
}

//# sourceMappingURL=ArrayKeyValueIterator.d.ts.map