import {Bytes} from "../io/Bytes"

/**
Creates a MD5 of a String.
*/
export declare class Md5 {
	protected constructor()
	protected bitOR(a: number, b: number): number
	protected bitXOR(a: number, b: number): number
	protected bitAND(a: number, b: number): number
	protected addme(x: number, y: number): number
	protected hex(a: number[]): string
	protected rol(num: number, cnt: number): number
	protected cmn(q: number, a: number, b: number, x: number, s: number, t: number): number
	protected ff(a: number, b: number, c: number, d: number, x: number, s: number, t: number): number
	protected gg(a: number, b: number, c: number, d: number, x: number, s: number, t: number): number
	protected hh(a: number, b: number, c: number, d: number, x: number, s: number, t: number): number
	protected ii(a: number, b: number, c: number, d: number, x: number, s: number, t: number): number
	protected doEncode(x: number[]): number[]
	static encode(s: string): string
	static make(b: Bytes): Bytes
	protected static bytes2blks(b: Bytes): number[]
	protected static str2blks(str: string): number[]
}

//# sourceMappingURL=Md5.d.ts.map