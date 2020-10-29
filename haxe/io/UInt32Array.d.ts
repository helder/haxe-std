import {Bytes} from "./Bytes"

export type UInt32ArrayData = Uint32Array

export declare class UInt32Array_Impl_ {
	static BYTES_PER_ELEMENT: number
	static readonly length: number
	static readonly view: ArrayBufferView
	static _new(elements: number): Uint32Array
	static get_view($this: Uint32Array): ArrayBufferView
	static get($this: Uint32Array, index: number): number
	static set($this: Uint32Array, index: number, value: number): number
	static sub($this: Uint32Array, begin: number, length?: null | number): Uint32Array
	static subarray($this: Uint32Array, begin?: null | number, end?: null | number): Uint32Array
	static getData($this: Uint32Array): Uint32Array
	static fromData(d: Uint32Array): Uint32Array
	static fromArray(a: number[], pos?: number, length?: null | number): Uint32Array
	static fromBytes(bytes: Bytes, bytePos?: number, length?: null | number): Uint32Array
}

//# sourceMappingURL=UInt32Array.d.ts.map