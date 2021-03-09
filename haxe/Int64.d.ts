
export declare class Int64_Impl_ {
	
	/**
	Makes a copy of `this` Int64.
	*/
	static copy($this: __Int64): __Int64
	
	/**
	Construct an Int64 from two 32-bit words `high` and `low`.
	*/
	static make(high: number, low: number): __Int64
	
	/**
	Returns an Int64 with the value of the Int `x`.
	`x` is sign-extended to fill 64 bits.
	*/
	static ofInt(x: number): __Int64
	
	/**
	Returns an Int with the value of the Int64 `x`.
	Throws an exception  if `x` cannot be represented in 32 bits.
	*/
	static toInt(x: __Int64): number
	
	/**
	Returns whether the value `val` is of type `haxe.Int64`
	*/
	static is(val: any): boolean
	
	/**
	Returns the high 32-bit word of `x`.
	*/
	static getHigh(x: __Int64): number
	
	/**
	Returns the low 32-bit word of `x`.
	*/
	static getLow(x: __Int64): number
	
	/**
	Returns `true` if `x` is less than zero.
	*/
	static isNeg(x: __Int64): boolean
	
	/**
	Returns `true` if `x` is exactly zero.
	*/
	static isZero(x: __Int64): boolean
	
	/**
	Compares `a` and `b` in signed mode.
	Returns a negative value if `a < b`, positive if `a > b`,
	or 0 if `a == b`.
	*/
	static compare(a: __Int64, b: __Int64): number
	
	/**
	Compares `a` and `b` in unsigned mode.
	Returns a negative value if `a < b`, positive if `a > b`,
	or 0 if `a == b`.
	*/
	static ucompare(a: __Int64, b: __Int64): number
	
	/**
	Returns a signed decimal `String` representation of `x`.
	*/
	static toStr(x: __Int64): string
	static parseString(sParam: string): __Int64
	static fromFloat(f: number): __Int64
	
	/**
	Performs signed integer divison of `dividend` by `divisor`.
	Returns `{ quotient : Int64, modulus : Int64 }`.
	*/
	static divMod(dividend: __Int64, divisor: __Int64): {modulus: __Int64, quotient: __Int64}
	
	/**
	Returns the negative of `x`.
	*/
	static neg(x: __Int64): __Int64
	
	/**
	Returns the sum of `a` and `b`.
	*/
	static add(a: __Int64, b: __Int64): __Int64
	
	/**
	Returns `a` minus `b`.
	*/
	static sub(a: __Int64, b: __Int64): __Int64
	
	/**
	Returns the product of `a` and `b`.
	*/
	static mul(a: __Int64, b: __Int64): __Int64
	
	/**
	Returns the quotient of `a` divided by `b`.
	*/
	static div(a: __Int64, b: __Int64): __Int64
	
	/**
	Returns the modulus of `a` divided by `b`.
	*/
	static mod(a: __Int64, b: __Int64): __Int64
	
	/**
	Returns `true` if `a` is equal to `b`.
	*/
	static eq(a: __Int64, b: __Int64): boolean
	
	/**
	Returns `true` if `a` is not equal to `b`.
	*/
	static neq(a: __Int64, b: __Int64): boolean
	
	/**
	Returns the bitwise AND of `a` and `b`.
	*/
	static and(a: __Int64, b: __Int64): __Int64
	
	/**
	Returns the bitwise OR of `a` and `b`.
	*/
	static or(a: __Int64, b: __Int64): __Int64
	
	/**
	Returns the bitwise XOR of `a` and `b`.
	*/
	static xor(a: __Int64, b: __Int64): __Int64
	
	/**
	Returns `a` left-shifted by `b` bits.
	*/
	static shl(a: __Int64, b: number): __Int64
	
	/**
	Returns `a` right-shifted by `b` bits in signed mode.
	`a` is sign-extended.
	*/
	static shr(a: __Int64, b: number): __Int64
	
	/**
	Returns `a` right-shifted by `b` bits in unsigned mode.
	`a` is padded with zeroes.
	*/
	static ushr(a: __Int64, b: number): __Int64
	static readonly high: number
	static readonly low: number
}

export type __Int64 = ___Int64

export declare class ___Int64 {
	constructor(high: number, low: number)
	high: number
	low: number
	
	/**
	We also define toString here to ensure we always get a pretty string
	when tracing or calling `Std.string`. This tends not to happen when
	`toString` is only in the abstract.
	*/
	toString(): string
}

//# sourceMappingURL=Int64.d.ts.map