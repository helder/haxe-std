import {Bytes} from "../io/Bytes"

/**
Creates a Sha1 of a String.
*/
export declare class Sha1 {
	protected constructor()
	protected doEncode(x: number[]): number[]
	
	/**
	Bitwise rotate a 32-bit number to the left
	*/
	protected rol(num: number, cnt: number): number
	
	/**
	Perform the appropriate triplet combination function for the current iteration
	*/
	protected ft(t: number, b: number, c: number, d: number): number
	
	/**
	Determine the appropriate additive constant for the current iteration
	*/
	protected kt(t: number): number
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

//# sourceMappingURL=Sha1.d.ts.map