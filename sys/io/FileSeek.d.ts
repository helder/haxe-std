
export declare namespace FileSeek {
	export type SeekEnd = {_hx_index: 2, __enum__: "sys.io.FileSeek"}
	export const SeekEnd: SeekEnd
	export type SeekCur = {_hx_index: 1, __enum__: "sys.io.FileSeek"}
	export const SeekCur: SeekCur
	export type SeekBegin = {_hx_index: 0, __enum__: "sys.io.FileSeek"}
	export const SeekBegin: SeekBegin
}

export declare type FileSeek = 
	| FileSeek.SeekEnd
	| FileSeek.SeekCur
	| FileSeek.SeekBegin

//# sourceMappingURL=FileSeek.d.ts.map