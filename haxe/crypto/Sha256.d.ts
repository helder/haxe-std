import {Bytes} from "../io/Bytes"

/**
Creates a Sha256 of a String.
*/
export declare class Sha256 {
	protected constructor()
	protected doEncode(m: number[], l: number): number[]
	protected hex(a: number[]): string
	static encode(s: string): string
	static make(b: Bytes): Bytes
	
	/**
	Convert a string to a sequence of 16-word blocks, stored as an array.
	Append padding bits and the length, as described in the SHA1 standard.
	*/
	protected static str2blks(s: string): number[]
	protected static bytes2blks(b: Bytes): number[]
}

//# sourceMappingURL=Sha256.d.ts.map