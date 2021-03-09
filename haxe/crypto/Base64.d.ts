import {Bytes} from "../io/Bytes"

/**
Allows one to encode/decode String and bytes using Base64 encoding.
*/
export declare class Base64 {
	static CHARS: string
	static BYTES: Bytes
	static URL_CHARS: string
	static URL_BYTES: Bytes
	static encode(bytes: Bytes, complement?: boolean): string
	static decode(str: string, complement?: boolean): Bytes
	static urlEncode(bytes: Bytes, complement?: boolean): string
	static urlDecode(str: string, complement?: boolean): Bytes
}

//# sourceMappingURL=Base64.d.ts.map