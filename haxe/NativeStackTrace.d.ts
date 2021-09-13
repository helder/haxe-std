import {StackItem} from "./CallStack"

export type V8CallSite = {getColumnNumber: () => number, getFileName: () => string, getFunctionName: () => string, getLineNumber: () => number}

/**
Do not use manually.
*/
export declare class NativeStackTrace {
	protected static lastError: Error
	static wrapCallSite: ((arg0: V8CallSite) => V8CallSite)
	static saveStack(e: Error): void
	static callStack(): any
	static exceptionStack(): any
	static toHaxe(s: null | any, skip?: number): StackItem[]
	protected static tryHaxeStack(e: null | Error): any
	protected static prepareHxStackTrace(e: Error, callsites: V8CallSite[]): any
	protected static normalize(stack: any, skipItems?: number): any
	protected static skipLines(stack: string, skip: number, pos?: number): string
}

//# sourceMappingURL=NativeStackTrace.d.ts.map