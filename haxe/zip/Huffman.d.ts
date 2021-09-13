import {IntMap} from "../ds/IntMap"

export declare namespace Huffman {
	export type NeedBits = {_hx_index: 2, n: number, table: Huffman[], __enum__: "haxe.zip.Huffman"}
	export const NeedBits: (n: number, table: Huffman[]) => Huffman
	export type NeedBit = {_hx_index: 1, left: Huffman, right: Huffman, __enum__: "haxe.zip.Huffman"}
	export const NeedBit: (left: Huffman, right: Huffman) => Huffman
	export type Found = {_hx_index: 0, i: number, __enum__: "haxe.zip.Huffman"}
	export const Found: (i: number) => Huffman
}

export declare type Huffman = 
	| Huffman.NeedBits
	| Huffman.NeedBit
	| Huffman.Found

export declare class HuffTools {
	constructor()
	protected treeDepth(t: Huffman): number
	protected treeCompress(t: Huffman): Huffman
	protected treeWalk(table: Huffman[], p: number, cd: number, d: number, t: Huffman): void
	protected treeMake(bits: IntMap<number>, maxbits: number, v: number, len: number): Huffman
	make(lengths: number[], pos: number, nlengths: number, maxbits: number): Huffman
}

//# sourceMappingURL=Huffman.d.ts.map