import {Bytes} from "../io/Bytes"

/**
Creates a Sha224 of a String.
*/
export declare class Sha224 {
	constructor()
	protected doEncode(str: string, strlen: number): number[]
	protected hex(a: number[]): string
	static encode(s: string): string
	static make(b: Bytes): Bytes
	protected static str2blks(s: string): number[]
}

//# sourceMappingURL=Sha224.d.ts.map