import {Input} from "./Input"
import {Bytes} from "./Bytes"

export declare class BytesInput extends Input {
	constructor(b: Bytes, pos?: null | number, len?: null | number)
	protected b: Uint8Array
	protected pos: number
	protected len: number
	protected totlen: number
	
	/**
	The current position in the stream in bytes.
	*/
	position: number
	
	/**
	The length of the stream in bytes.
	*/
	readonly length: number
	protected get_position(): number
	protected get_length(): number
	protected set_position(p: number): number
	readByte(): number
	readBytes(buf: Bytes, pos: number, len: number): number
}

//# sourceMappingURL=BytesInput.d.ts.map