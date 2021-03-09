import {Input} from "./Input"
import {Bytes} from "./Bytes"

export declare class BytesInput extends Input {
	constructor(b: Bytes, pos?: null | number, len?: null | number)
	
	/**
	The current position in the stream in bytes.
	*/
	position: number
	
	/**
	The length of the stream in bytes.
	*/
	readonly length: number
	readByte(): number
	readBytes(buf: Bytes, pos: number, len: number): number
}

//# sourceMappingURL=BytesInput.d.ts.map