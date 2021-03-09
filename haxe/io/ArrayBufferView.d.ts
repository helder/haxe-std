import {Bytes} from "./Bytes"

export type ArrayBufferViewData = ArrayBufferView

export declare class ArrayBufferView_Impl_ {
	static readonly buffer: Bytes
	static readonly byteOffset: number
	static readonly byteLength: number
	static _new(size: number): ArrayBufferView
	static sub($this: ArrayBufferView, begin: number, length?: null | number): ArrayBufferView
	static getData($this: ArrayBufferView): ArrayBufferView
	static fromData(a: ArrayBufferView): ArrayBufferView
}

//# sourceMappingURL=ArrayBufferView.d.ts.map