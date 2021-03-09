import {Bytes} from "./Bytes"

export type Float32ArrayData = Float32Array

export declare class Float32Array_Impl_ {
	static BYTES_PER_ELEMENT: number
	static readonly length: number
	static readonly view: ArrayBufferView
	static _new(elements: number): Float32Array
	static get_view($this: Float32Array): ArrayBufferView
	static get($this: Float32Array, index: number): number
	static set($this: Float32Array, index: number, value: number): number
	static sub($this: Float32Array, begin: number, length?: null | number): Float32Array
	static subarray($this: Float32Array, begin?: null | number, end?: null | number): Float32Array
	static getData($this: Float32Array): Float32Array
	static fromData(d: Float32Array): Float32Array
	static fromArray(a: number[], pos?: number, length?: null | number): Float32Array
	static fromBytes(bytes: Bytes, bytePos?: number, length?: null | number): Float32Array
}

//# sourceMappingURL=Float32Array.d.ts.map