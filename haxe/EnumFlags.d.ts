
export declare class EnumFlags {
	
	/**
	Initializes the bitflags to `i`.
	*/
	static _new<T extends any>(i?: number): number
	
	/**
	Checks if the index of enum instance `v` is set.
	
	This method is optimized if `v` is an enum instance expression such as
	`SomeEnum.SomeCtor`.
	
	If `v` is `null`, the result is unspecified.
	*/
	static has<T extends any>($this: number, v: T): boolean
	
	/**
	Sets the index of enum instance `v`.
	
	This method is optimized if `v` is an enum instance expression such as
	`SomeEnum.SomeCtor`.
	
	If `v` is `null`, the result is unspecified.
	*/
	static set<T extends any>($this: number, v: T): void
	
	/**
	Unsets the index of enum instance `v`.
	
	This method is optimized if `v` is an enum instance expression such as
	`SomeEnum.SomeCtor`.
	
	If `v` is `null`, the result is unspecified.
	*/
	static unset<T extends any>($this: number, v: T): void
	
	/**
	Convert a integer bitflag into a typed one (this is a no-op, it does not
	have any impact on speed).
	*/
	static ofInt<T extends any>(i: number): number
	
	/**
	Convert the typed bitflag into the corresponding int value (this is a
	no-op, it doesn't have any impact on speed).
	*/
	static toInt<T extends any>($this: number): number
}

//# sourceMappingURL=EnumFlags.d.ts.map