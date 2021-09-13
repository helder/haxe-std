
/**
ArraySort provides a stable implementation of merge sort through its `sort`
method. It should be used instead of `Array.sort` in cases where the order
of equal elements has to be retained on all targets.
*/
export declare class ArraySort {
	
	/**
	Sorts Array `a` according to the comparison function `cmp`, where
	`cmp(x,y)` returns 0 if `x == y`, a positive Int if `x > y` and a
	negative Int if `x < y`.
	
	This operation modifies Array `a` in place.
	
	This operation is stable: The order of equal elements is preserved.
	
	If `a` or `cmp` are null, the result is unspecified.
	*/
	static sort<T>(a: T[], cmp: ((arg0: T, arg1: T) => number)): void
	protected static rec<T>(a: T[], cmp: ((arg0: T, arg1: T) => number), from: number, to: number): void
	protected static doMerge<T>(a: T[], cmp: ((arg0: T, arg1: T) => number), from: number, pivot: number, to: number, len1: number, len2: number): void
	protected static rotate<T>(a: T[], cmp: ((arg0: T, arg1: T) => number), from: number, mid: number, to: number): void
	protected static gcd(m: number, n: number): number
	protected static upper<T>(a: T[], cmp: ((arg0: T, arg1: T) => number), from: number, to: number, val: number): number
	protected static lower<T>(a: T[], cmp: ((arg0: T, arg1: T) => number), from: number, to: number, val: number): number
	protected static swap<T>(a: T[], i: number, j: number): void
	protected static compare<T>(a: T[], cmp: ((arg0: T, arg1: T) => number), i: number, j: number): number
}

//# sourceMappingURL=ArraySort.d.ts.map