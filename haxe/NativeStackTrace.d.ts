import {StackItem} from "./CallStack"

export type V8CallSite = {getColumnNumber: () => number, getFileName: () => string, getFunctionName: () => string, getLineNumber: () => number}

/**
Do not use manually.
*/
export declare class NativeStackTrace {
	static wrapCallSite: ((arg0: V8CallSite) => V8CallSite)
	static saveStack(e: Error): void
	static callStack(): any
	static exceptionStack(): any
	static toHaxe(s: null | any, skip?: number): StackItem[]
}

//# sourceMappingURL=NativeStackTrace.d.ts.map