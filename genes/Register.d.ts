import {Iterator} from "../StdTypes"

export declare class Register {
	static $global: any
	protected static globals: {}
	static global(name: number): any
	static createStatic<T>(obj: {}, name: string, get: (() => T)): void
	static iter<T>(a: T[]): Iterator<T>
	static extend(superClass: any): void
	static inherits(resolve: any, defer?: boolean): void
	protected static fid: number
	static bind(o: any, m: any): any
}

//# sourceMappingURL=Register.d.ts.map