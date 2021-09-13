
export type VectorData<T> = T[]

export declare class Vector {
	
	/**
	Creates a new Vector of length `length`.
	
	Initially `this` Vector contains `length` neutral elements:
	
	- always null on dynamic targets
	- 0, 0.0 or false for Int, Float and Bool respectively on static targets
	- null for other types on static targets
	
	If `length` is less than or equal to 0, the result is unspecified.
	*/
	static _new<T>(length: number): T[]
	
	/**
	Returns the value at index `index`.
	
	If `index` is negative or exceeds `this.length`, the result is
	unspecified.
	*/
	static get<T>($this: T[], index: number): T
	
	/**
	Sets the value at index `index` to `val`.
	
	If `index` is negative or exceeds `this.length`, the result is
	unspecified.
	*/
	static set<T>($this: T[], index: number, val: T): T
	
	/**
	Returns the length of `this` Vector.
	*/
	static readonly length: number
	protected static get_length<T>($this: T[]): number
	
	/**
	Copies `length` of elements from `src` Vector, beginning at `srcPos` to
	`dest` Vector, beginning at `destPos`
	
	The results are unspecified if `length` results in out-of-bounds access,
	or if `src` or `dest` are null
	*/
	static blit<T>(src: T[], srcPos: number, dest: T[], destPos: number, len: number): void
	
	/**
	Creates a new Array, copy the content from the Vector to it, and returns it.
	*/
	static toArray<T>($this: T[]): T[]
	
	/**
	Extracts the data of `this` Vector.
	
	This returns the internal representation type.
	*/
	static toData<T>($this: T[]): T[]
	
	/**
	Initializes a new Vector from `data`.
	
	Since `data` is the internal representation of Vector, this is a no-op.
	
	If `data` is null, the corresponding Vector is also `null`.
	*/
	static fromData<T>(data: T[]): T[]
	
	/**
	Creates a new Vector by copying the elements of `array`.
	
	This always creates a copy, even on platforms where the internal
	representation is Array.
	
	The elements are not copied and retain their identity, so
	`a[i] == Vector.fromArrayCopy(a).get(i)` is true for any valid i.
	
	If `array` is null, the result is unspecified.
	*/
	static fromArrayCopy<T>(array: T[]): T[]
	
	/**
	Returns a shallow copy of `this` Vector.
	
	The elements are not copied and retain their identity, so
	`a[i] == a.copy()[i]` is true for any valid `i`. However,
	`a == a.copy()` is always false.
	*/
	static copy<T>($this: T[]): T[]
	
	/**
	Returns a string representation of `this` Vector, with `sep` separating
	each element.
	
	The result of this operation is equal to `Std.string(this[0]) + sep +
	Std.string(this[1]) + sep + ... + sep + Std.string(this[this.length-1])`
	
	If `this` Vector has length 0, the result is the empty String `""`.
	If `this` has exactly one element, the result is equal to a call to
	`Std.string(this[0])`.
	
	If `sep` is null, the result is unspecified.
	*/
	static join<T>($this: T[], sep: string): string
	
	/**
	Creates a new Vector by applying function `f` to all elements of `this`.
	
	The order of elements is preserved.
	
	If `f` is null, the result is unspecified.
	*/
	static map<T, S>($this: T[], f: ((arg0: T) => S)): T[]
	
	/**
	Sorts `this` Vector according to the comparison function `f`, where
	`f(x,y)` returns 0 if x == y, a positive Int if x > y and a
	negative Int if x < y.
	
	This operation modifies `this` Vector in place.
	
	The sort operation is not guaranteed to be stable, which means that the
	order of equal elements may not be retained.
	
	If `f` is null, the result is unspecified.
	*/
	static sort<T>($this: T[], f: ((arg0: T, arg1: T) => number)): void
}

//# sourceMappingURL=Vector.d.ts.map