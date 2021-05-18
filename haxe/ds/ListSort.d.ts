
/**
ListSort provides a stable implementation of merge sort through its `sort`
method. It has a O(N.log(N)) complexity and does not require additional memory allocation.
*/
export declare class ListSort {
	
	/**
	Sorts List `lst` according to the comparison function `cmp`, where
	`cmp(x,y)` returns 0 if `x == y`, a positive Int if `x > y` and a
	negative Int if `x < y`.
	
	This operation modifies List `a` in place and returns its head once modified.
	The `prev` of the head is set to the tail of the sorted list.
	
	If `list` or `cmp` are null, the result is unspecified.
	*/
	static sort<T>(list: T, cmp: ((arg0: T, arg1: T) => number)): T
	
	/**
	Same as `sort` but on single linked list.
	*/
	static sortSingleLinked<T>(list: T, cmp: ((arg0: T, arg1: T) => number)): T
}

//# sourceMappingURL=ListSort.d.ts.map