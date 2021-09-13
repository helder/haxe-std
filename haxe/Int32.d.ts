
export declare class Int32 {
	protected static negate($this: number): number
	protected static preIncrement($this: number): number
	protected static postIncrement($this: number): number
	protected static preDecrement($this: number): number
	protected static postDecrement($this: number): number
	protected static add(a: number, b: number): number
	protected static addInt(a: number, b: number): number
	protected static sub(a: number, b: number): number
	protected static subInt(a: number, b: number): number
	protected static intSub(a: number, b: number): number
	protected static mul(a: number, b: number): number
	protected static _mul: ((arg0: number, arg1: number) => number)
	protected static mulInt(a: number, b: number): number
	protected static toFloat($this: number): number
	
	/**
	Compare `a` and `b` in unsigned mode.
	*/
	static ucompare(a: number, b: number): number
	protected static clamp(x: number): number
}

//# sourceMappingURL=Int32.d.ts.map