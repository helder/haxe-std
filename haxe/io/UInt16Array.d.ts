import {Bytes} from "./Bytes"

export type UInt16ArrayData = Uint16Array

export declare class UInt16Array_Impl_ {
	static BYTES_PER_ELEMENT: number
	static readonly length: number
	static readonly view: ArrayBufferView
	static _new(elements: number): Uint16Array
	static get_view($this: Uint16Array): ArrayBufferView
	static get($this: Uint16Array, index: number): number
	static set($this: Uint16Array, index: number, value: number): number
	static sub($this: Uint16Array, begin: number, length?: null | number): Uint16Array
	static subarray($this: Uint16Array, begin?: null | number, end?: null | number): Uint16Array
	static getData($this: Uint16Array): Uint16Array
	static fromData(d: Uint16Array): Uint16Array
	static fromArray(a: number[], pos?: number, length?: null | number): Uint16Array
	static fromBytes(bytes: Bytes, bytePos?: number, length?: null | number): Uint16Array
}

//# sourceMappingURL=UInt16Array.d.ts.map