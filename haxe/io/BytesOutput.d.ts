import {Output} from "./Output"
import {BytesBuffer} from "./BytesBuffer"
import {Bytes} from "./Bytes"

export declare class BytesOutput extends Output {
	constructor()
	
	/**
	The length of the stream in bytes.
	*/
	readonly length: number
	writeByte(c: number): void
	writeBytes(buf: Bytes, pos: number, len: number): number
	
	/**
	Returns the `Bytes` of this output.
	
	This function should not be called more than once on a given
	`BytesOutput` instance.
	*/
	getBytes(): Bytes
}

//# sourceMappingURL=BytesOutput.d.ts.map