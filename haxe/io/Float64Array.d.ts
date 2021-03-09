import {Bytes} from "./Bytes"

export type Float64ArrayData = Float64Array

export declare class Float64Array_Impl_ {
	static BYTES_PER_ELEMENT: number
	static readonly length: number
	static readonly view: ArrayBufferView
	static _new(elements: number): Float64Array
	static get_view($this: Float64Array): ArrayBufferView
	static get($this: Float64Array, index: number): number
	static set($this: Float64Array, index: number, value: number): number
	static sub($this: Float64Array, begin: number, length?: null | number): Float64Array
	static subarray($this: Float64Array, begin?: null | number, end?: null | number): Float64Array
	static getData($this: Float64Array): Float64Array
	static fromData(d: Float64Array): Float64Array
	static fromArray(a: number[], pos?: number, length?: null | number): Float64Array
	static fromBytes(bytes: Bytes, bytePos?: number, length?: null | number): Float64Array
}

//# sourceMappingURL=Float64Array.d.ts.map