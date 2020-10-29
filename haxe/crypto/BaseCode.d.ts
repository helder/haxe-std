import {Bytes} from "../io/Bytes"

/**
Allows one to encode/decode String and bytes using a power of two base dictionary.
*/
export declare class BaseCode {
	constructor(base: Bytes)
	encodeBytes(b: Bytes): Bytes
	decodeBytes(b: Bytes): Bytes
	encodeString(s: string): string
	decodeString(s: string): string
	static encode(s: string, base: string): string
	static decode(s: string, base: string): string
}

//# sourceMappingURL=BaseCode.d.ts.map