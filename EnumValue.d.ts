
export declare class EnumValue_Impl_ {
	
	/**
	Matches enum instance `e` against pattern `pattern`, returning `true` if
	matching succeeded and `false` otherwise.
	
	Example usage:
	
	```haxe
	if (e.match(pattern)) {
	// codeIfTrue
	} else {
	// codeIfFalse
	}
	```
	
	This is equivalent to the following code:
	
	```haxe
	switch (e) {
	case pattern:
	// codeIfTrue
	case _:
	// codeIfFalse
	}
	```
	
	This method is implemented in the compiler. This definition exists only
	for documentation.
	*/
	static match($this: any, pattern: any): boolean
}

//# sourceMappingURL=EnumValue.d.ts.map