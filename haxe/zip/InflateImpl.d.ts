import {Huffman, HuffTools} from "./Huffman"
import {Input} from "../io/Input"
import {Bytes} from "../io/Bytes"
import {Adler32} from "../crypto/Adler32"

export declare class Window {
	constructor(hasCrc: boolean)
	buffer: Bytes
	pos: number
	protected crc: Adler32
	slide(): void
	addBytes(b: Bytes, p: number, len: number): void
	addByte(c: number): void
	getLastChar(): number
	available(): number
	checksum(): Adler32
	static SIZE: number
	static BUFSIZE: number
}

export declare namespace State {
	export type Head = {_hx_index: 0, __enum__: "haxe.zip._InflateImpl.State"}
	export const Head: Head
	export type Flat = {_hx_index: 3, __enum__: "haxe.zip._InflateImpl.State"}
	export const Flat: Flat
	export type Done = {_hx_index: 7, __enum__: "haxe.zip._InflateImpl.State"}
	export const Done: Done
	export type DistOne = {_hx_index: 6, __enum__: "haxe.zip._InflateImpl.State"}
	export const DistOne: DistOne
	export type Dist = {_hx_index: 5, __enum__: "haxe.zip._InflateImpl.State"}
	export const Dist: Dist
	export type Crc = {_hx_index: 4, __enum__: "haxe.zip._InflateImpl.State"}
	export const Crc: Crc
	export type CData = {_hx_index: 2, __enum__: "haxe.zip._InflateImpl.State"}
	export const CData: CData
	export type Block = {_hx_index: 1, __enum__: "haxe.zip._InflateImpl.State"}
	export const Block: Block
}

export declare type State = 
	| State.Head
	| State.Flat
	| State.Done
	| State.DistOne
	| State.Dist
	| State.Crc
	| State.CData
	| State.Block

/**
A pure Haxe implementation of the ZLIB Inflate algorithm which allows reading compressed data without any platform-specific support.
*/
export declare class InflateImpl {
	constructor(i: Input, header?: null | boolean, crc?: null | boolean)
	protected nbits: number
	protected bits: number
	protected state: State
	protected isFinal: boolean
	protected huffman: Huffman
	protected huffdist: null | Huffman
	protected htools: HuffTools
	protected len: number
	protected dist: number
	protected needed: number
	protected output: Bytes
	protected outpos: number
	protected input: Input
	protected lengths: number[]
	protected window: Window
	protected buildFixedHuffman(): Huffman
	readBytes(b: Bytes, pos: number, len: number): number
	protected getBits(n: number): number
	protected getBit(): boolean
	protected getRevBits(n: number): number
	protected resetBits(): void
	protected addBytes(b: Bytes, p: number, len: number): void
	protected addByte(b: number): void
	protected addDistOne(n: number): void
	protected addDist(d: number, len: number): void
	protected applyHuffman(h: Huffman): number
	protected inflateLengths(a: number[], max: number): void
	protected inflateLoop(): boolean
	protected static LEN_EXTRA_BITS_TBL: number[]
	protected static LEN_BASE_VAL_TBL: number[]
	protected static DIST_EXTRA_BITS_TBL: number[]
	protected static DIST_BASE_VAL_TBL: number[]
	protected static CODE_LENGTHS_POS: number[]
	protected static FIXED_HUFFMAN: Huffman
	static run(i: Input, bufsize?: null | number): Bytes
}

//# sourceMappingURL=InflateImpl.d.ts.map