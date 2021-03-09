import {Bytes} from "../io/Bytes"
import {List} from "../ds/List"

export declare namespace ExtraField {
	export type FUtf8 = {_hx_index: 2, __enum__: "haxe.zip.ExtraField"}
	export const FUtf8: FUtf8
	export type FUnknown = {_hx_index: 0, tag: number, bytes: Bytes, __enum__: "haxe.zip.ExtraField"}
	export const FUnknown: (tag: number, bytes: Bytes) => ExtraField
	export type FInfoZipUnicodePath = {_hx_index: 1, name: string, crc: number, __enum__: "haxe.zip.ExtraField"}
	export const FInfoZipUnicodePath: (name: string, crc: number) => ExtraField
}

export declare type ExtraField = 
	| ExtraField.FUtf8
	| ExtraField.FUnknown
	| ExtraField.FInfoZipUnicodePath

export type Entry = {compressed: boolean, crc32: null | number, data: null | Bytes, dataSize: number, extraFields?: null | List<ExtraField>, fileName: string, fileSize: number, fileTime: Date}

//# sourceMappingURL=Entry.d.ts.map