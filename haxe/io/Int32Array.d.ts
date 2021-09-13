import {Bytes} from "./Bytes"

export type Int32ArrayData = Int32Array

export declare class Int32Array {
	static BYTES_PER_ELEMENT: number
	static readonly length: number
	static readonly view: ArrayBufferView
	static _new(elements: number): Int32Array
	protected static get_length($this: Int32Array): number
	static get_view($this: Int32Array): ArrayBufferView
	static get($this: Int32Array, index: number): number
	static set($this: Int32Array, index: number, value: number): number
	static sub($this: Int32Array, begin: number, length?: null | number): Int32Array
	static subarray($this: Int32Array, begin?: null | number, end?: null | number): Int32Array
	static getData($this: Int32Array): Int32Array
	static fromData(d: Int32Array): Int32Array
	static fromArray(a: number[], pos?: number, length?: null | number): Int32Array
	static fromBytes(bytes: Bytes, bytePos?: number, length?: null | number): Int32Array
}

//# sourceMappingURL=Int32Array.d.ts.map