
export declare namespace Encoding {
	export type UTF8 = {_hx_index: 0, __enum__: "haxe.io.Encoding"}
	export const UTF8: UTF8
	export type RawNative = {_hx_index: 1, __enum__: "haxe.io.Encoding"}
	export const RawNative: RawNative
}

/**
String binary encoding supported by Haxe I/O
*/
export declare type Encoding = 
	| Encoding.UTF8
	/**
	Output the string the way the platform represent it in memory. This is the most efficient but is platform-specific
	*/
	| Encoding.RawNative

//# sourceMappingURL=Encoding.d.ts.map