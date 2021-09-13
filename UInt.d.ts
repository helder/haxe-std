
export declare class UInt {
	protected static add(a: number, b: number): number
	protected static div(a: number, b: number): number
	protected static mul(a: number, b: number): number
	protected static sub(a: number, b: number): number
	protected static gt(a: number, b: number): boolean
	protected static gte(a: number, b: number): boolean
	protected static lt(a: number, b: number): boolean
	protected static lte(a: number, b: number): boolean
	protected static and(a: number, b: number): number
	protected static or(a: number, b: number): number
	protected static xor(a: number, b: number): number
	protected static shl(a: number, b: number): number
	protected static shr(a: number, b: number): number
	protected static ushr(a: number, b: number): number
	protected static mod(a: number, b: number): number
	protected static addWithFloat(a: number, b: number): number
	protected static mulWithFloat(a: number, b: number): number
	protected static divFloat(a: number, b: number): number
	protected static floatDiv(a: number, b: number): number
	protected static subFloat(a: number, b: number): number
	protected static floatSub(a: number, b: number): number
	protected static gtFloat(a: number, b: number): boolean
	protected static equalsInt<T extends number>(a: number, b: T): boolean
	protected static notEqualsInt<T extends number>(a: number, b: T): boolean
	protected static equalsFloat<T extends number>(a: number, b: T): boolean
	protected static notEqualsFloat<T extends number>(a: number, b: T): boolean
	protected static gteFloat(a: number, b: number): boolean
	protected static floatGt(a: number, b: number): boolean
	protected static floatGte(a: number, b: number): boolean
	protected static ltFloat(a: number, b: number): boolean
	protected static lteFloat(a: number, b: number): boolean
	protected static floatLt(a: number, b: number): boolean
	protected static floatLte(a: number, b: number): boolean
	protected static modFloat(a: number, b: number): number
	protected static floatMod(a: number, b: number): number
	protected static negBits($this: number): number
	protected static prefixIncrement($this: number): number
	protected static postfixIncrement($this: number): number
	protected static prefixDecrement($this: number): number
	protected static postfixDecrement($this: number): number
	protected static toString($this: number, radix?: null | number): string
	protected static toInt($this: number): number
	protected static toFloat($this: number): number
}

//# sourceMappingURL=UInt.d.ts.map