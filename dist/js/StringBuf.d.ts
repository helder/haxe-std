
/**
A String buffer is an efficient way to build a big string by appending small
elements together.

Unlike String, an instance of StringBuf is not immutable in the sense that
it can be passed as argument to functions which modify it by appending more
values.
*/
export declare class StringBuf {
	constructor()
	
	/**
	The length of `this` StringBuf in characters.
	*/
	readonly length: number
	
	/**
	Appends the representation of `x` to `this` StringBuf.
	
	The exact representation of `x` may vary per platform. To get more
	consistent behavior, this function should be called with
	Std.string(x).
	
	If `x` is null, the String "null" is appended.
	*/
	add<T>(x: T): void
	
	/**
	Appends the character identified by `c` to `this` StringBuf.
	
	If `c` is negative or has another invalid value, the result is
	unspecified.
	*/
	addChar(c: number): void
	
	/**
	Appends a substring of `s` to `this` StringBuf.
	
	This function expects `pos` and `len` to describe a valid substring of
	`s`, or else the result is unspecified. To get more robust behavior,
	`this.add(s.substr(pos,len))` can be used instead.
	
	If `s` or `pos` are null, the result is unspecified.
	
	If `len` is omitted or null, the substring ranges from `pos` to the end
	of `s`.
	*/
	addSub(s: string, pos: number, len?: null | number): void
	
	/**
	Returns the content of `this` StringBuf as String.
	
	The buffer is not emptied by this operation.
	*/
	toString(): string
}

//# sourceMappingURL=StringBuf.d.ts.map