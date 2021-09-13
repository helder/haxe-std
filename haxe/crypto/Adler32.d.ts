import {Input} from "../io/Input"
import {Bytes} from "../io/Bytes"

/**
Calculates the Adler32 of the given Bytes.
*/
export declare class Adler32 {
	constructor()
	protected a1: number
	protected a2: number
	get(): number
	update(b: Bytes, pos: number, len: number): void
	equals(a: Adler32): boolean
	toString(): string
	static read(i: Input): Adler32
	static make(b: Bytes): number
}

//# sourceMappingURL=Adler32.d.ts.map