import {Encoding} from "./Encoding"
import {Bytes} from "./Bytes"
import {__Int64} from "../Int64"

export declare class BytesBuffer {
	constructor()
	
	/**
	The length of the buffer in bytes.
	*/
	readonly length: number
	addByte($byte: number): void
	add(src: Bytes): void
	addString(v: string, encoding?: null | Encoding): void
	addInt32(v: number): void
	addInt64(v: __Int64): void
	addFloat(v: number): void
	addDouble(v: number): void
	addBytes(src: Bytes, pos: number, len: number): void
	
	/**
	Returns either a copy or a reference of the current bytes.
	Once called, the buffer should no longer be used.
	*/
	getBytes(): Bytes
}

//# sourceMappingURL=BytesBuffer.d.ts.map