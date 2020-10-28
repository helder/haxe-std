
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
}

//# sourceMappingURL=ArraySort.d.ts.map