import {Bytes} from "./Bytes"

export type ArrayBufferViewData = ArrayBufferView

export declare class ArrayBufferView {
	static readonly buffer: Bytes
	static readonly byteOffset: number
	static readonly byteLength: number
	static _new(size: number): ArrayBufferView
	protected static get_byteOffset($this: ArrayBufferView): number
	protected static get_byteLength($this: ArrayBufferView): number
	protected static get_buffer($this: ArrayBufferView): Bytes
	static sub($this: ArrayBufferView, begin: number, length?: null | number): ArrayBufferView
	static getData($this: ArrayBufferView): ArrayBufferView
	static fromData(a: ArrayBufferView): ArrayBufferView
}

//# sourceMappingURL=ArrayBufferView.d.ts.map