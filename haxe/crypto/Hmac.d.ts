import {Bytes} from "../io/Bytes"

export declare namespace HashMethod {
	export type SHA256 = {_hx_index: 2, __enum__: "haxe.crypto.HashMethod"}
	export const SHA256: SHA256
	export type SHA1 = {_hx_index: 1, __enum__: "haxe.crypto.HashMethod"}
	export const SHA1: SHA1
	export type MD5 = {_hx_index: 0, __enum__: "haxe.crypto.HashMethod"}
	export const MD5: MD5
}

/**
Hash methods for Hmac calculation.
*/
export declare type HashMethod = 
	| HashMethod.SHA256
	| HashMethod.SHA1
	| HashMethod.MD5

/**
Calculates a Hmac of the given Bytes using a HashMethod.
*/
export declare class Hmac {
	constructor(hashMethod: HashMethod)
	make(key: Bytes, msg: Bytes): Bytes
}

//# sourceMappingURL=Hmac.d.ts.map