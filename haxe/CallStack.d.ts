import {Exception} from "./Exception"
import {StringBuf} from "../StringBuf"

export declare namespace StackItem {
	export type Module = {_hx_index: 1, m: string, __enum__: "haxe.StackItem"}
	export const Module: (m: string) => StackItem
	export type Method = {_hx_index: 3, classname: null | string, method: string, __enum__: "haxe.StackItem"}
	export const Method: (classname: null | string, method: string) => StackItem
	export type LocalFunction = {_hx_index: 4, v: null | number, __enum__: "haxe.StackItem"}
	export const LocalFunction: (v: null | number) => StackItem
	export type FilePos = {_hx_index: 2, s: null | StackItem, file: string, line: number, column: null | number, __enum__: "haxe.StackItem"}
	export const FilePos: (s: null | StackItem, file: string, line: number, column: null | number) => StackItem
	export type CFunction = {_hx_index: 0, __enum__: "haxe.StackItem"}
	export const CFunction: CFunction
}

/**
Elements return by `CallStack` methods.
*/
export declare type StackItem = 
	| StackItem.Module
	| StackItem.Method
	| StackItem.LocalFunction
	| StackItem.FilePos
	| StackItem.CFunction

export declare class CallStack {
	
	/**
	The length of this stack.
	*/
	static readonly length: number
	protected static get_length($this: StackItem[]): number
	
	/**
	Return the call stack elements, or an empty array if not available.
	*/
	static callStack(): StackItem[]
	
	/**
	Return the exception stack : this is the stack elements between
	the place the last exception was thrown and the place it was
	caught, or an empty array if not available.
	Set `fullStack` parameter to true in order to return the full exception stack.
	
	May not work if catch type was a derivative from `haxe.Exception`.
	*/
	static exceptionStack(fullStack?: boolean): StackItem[]
	
	/**
	Returns a representation of the stack as a printable string.
	*/
	static toString(stack: StackItem[]): string
	
	/**
	Returns a range of entries of current stack from the beginning to the the
	common part of this and `stack`.
	*/
	static subtract($this: StackItem[], stack: StackItem[]): StackItem[]
	
	/**
	Make a copy of the stack.
	*/
	static copy($this: StackItem[]): StackItem[]
	static get($this: StackItem[], index: number): StackItem
	protected static asArray($this: StackItem[]): StackItem[]
	protected static equalItems(item1: null | StackItem, item2: null | StackItem): boolean
	protected static exceptionToString(e: Exception): string
	protected static itemToString(b: StringBuf, s: StackItem): void
}

//# sourceMappingURL=CallStack.d.ts.map