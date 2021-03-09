import {Input} from "./Input"
import {Bytes} from "./Bytes"

export declare class BufferInput extends Input {
	constructor(i: Input, buf: Bytes, pos?: null | number, available?: null | number)
	i: Input
	buf: Bytes
	available: number
	pos: number
	refill(): void
	readByte(): number
	readBytes(buf: Bytes, pos: number, len: number): number
}

//# sourceMappingURL=BufferInput.d.ts.map