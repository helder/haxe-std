
export declare namespace FlushMode {
	export type SYNC = {_hx_index: 1, __enum__: "haxe.zip.FlushMode"}
	export const SYNC: SYNC
	export type NO = {_hx_index: 0, __enum__: "haxe.zip.FlushMode"}
	export const NO: NO
	export type FULL = {_hx_index: 2, __enum__: "haxe.zip.FlushMode"}
	export const FULL: FULL
	export type FINISH = {_hx_index: 3, __enum__: "haxe.zip.FlushMode"}
	export const FINISH: FINISH
	export type BLOCK = {_hx_index: 4, __enum__: "haxe.zip.FlushMode"}
	export const BLOCK: BLOCK
}

export declare type FlushMode = 
	| FlushMode.SYNC
	| FlushMode.NO
	| FlushMode.FULL
	| FlushMode.FINISH
	| FlushMode.BLOCK

//# sourceMappingURL=FlushMode.d.ts.map