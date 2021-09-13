import {Bytes} from "./Bytes"

export type UInt8ArrayData = Uint8Array

export declare class UInt8Array {
	static BYTES_PER_ELEMENT: number
	static readonly length: number
	static readonly view: ArrayBufferView
	static _new(elements: number): Uint8Array
	protected static get_length($this: Uint8Array): number
	static get_view($this: Uint8Array): ArrayBufferView
	static get($this: Uint8Array, index: number): number
	static set($this: Uint8Array, index: number, value: number): number
	static sub($this: Uint8Array, begin: number, length?: null | number): Uint8Array
	static subarray($this: Uint8Array, begin?: null | number, end?: null | number): Uint8Array
	static getData($this: Uint8Array): Uint8Array
	static fromData(d: Uint8Array): Uint8Array
	static fromArray(a: number[], pos?: number, length?: null | number): Uint8Array
	static fromBytes(bytes: Bytes, bytePos?: number, length?: null | number): Uint8Array
}

//# sourceMappingURL=UInt8Array.d.ts.map