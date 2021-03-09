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

/**
Get information about the call stack.
*/
export declare class CallStack {
	static wrapCallSite: ((arg0: any) => any)
	
	/**
	Return the call stack elements, or an empty array if not available.
	*/
	static callStack(): StackItem[]
	
	/**
	Return the exception stack : this is the stack elements between
	the place the last exception was thrown and the place it was
	caught, or an empty array if not available.
	*/
	static exceptionStack(): StackItem[]
	
	/**
	Returns a representation of the stack as a printable string.
	*/
	static toString(stack: StackItem[]): string
}

//# sourceMappingURL=CallStack.d.ts.map