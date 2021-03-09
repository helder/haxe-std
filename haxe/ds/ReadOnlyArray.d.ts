
export declare class ReadOnlyArray_Impl_ {
	
	/**
	The length of `this` Array.
	*/
	static readonly length: number
	
	/**
	Returns a new Array by appending the elements of `a` to the elements of
	`this` Array.
	
	This operation does not modify `this` Array.
	
	If `a` is the empty Array `[]`, a copy of `this` Array is returned.
	
	The length of the returned Array is equal to the sum of `this.length`
	and `a.length`.
	
	If `a` is `null`, the result is unspecified.
	*/
	static concat<T>($this: T[], a: T[]): T[]
}

//# sourceMappingURL=ReadOnlyArray.d.ts.map