import {__Int64} from "../Int64"

/**
Helper that converts between floating point and binary representation.
Always works in low-endian encoding.
*/
export declare class FPHelper {
	static i32ToFloat(i: number): number
	static floatToI32(f: number): number
	static i64ToDouble(low: number, high: number): number
	
	/**
	Returns an Int64 representing the bytes representation of the double precision IEEE float value.
	WARNING : for performance reason, the same Int64 value might be reused every time. Copy its low/high values before calling again.
	We still ensure that this is safe to use in a multithread environment
	*/
	static doubleToI64(v: number): __Int64
}

//# sourceMappingURL=FPHelper.d.ts.map