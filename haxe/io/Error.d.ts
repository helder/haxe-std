
export declare namespace Error {
	export type Overflow = {_hx_index: 1, __enum__: "haxe.io.Error"}
	export const Overflow: Overflow
	export type OutsideBounds = {_hx_index: 2, __enum__: "haxe.io.Error"}
	export const OutsideBounds: OutsideBounds
	export type Custom = {_hx_index: 3, e: any, __enum__: "haxe.io.Error"}
	export const Custom: (e: any) => Error
	export type Blocked = {_hx_index: 0, __enum__: "haxe.io.Error"}
	export const Blocked: Blocked
}

/**
The possible IO errors that can occur
*/
export declare type Error = 
	/**
	An integer value is outside its allowed range
	*/
	| Error.Overflow
	/**
	An operation on Bytes is outside of its valid range
	*/
	| Error.OutsideBounds
	/**
	Other errors
	*/
	| Error.Custom
	/**
	The IO is set into nonblocking mode and some data cannot be read or written
	*/
	| Error.Blocked

//# sourceMappingURL=Error.d.ts.map