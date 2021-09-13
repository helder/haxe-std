import {ArrayKeyValueIterator} from "./haxe/iterators/ArrayKeyValueIterator"
import {Iterator} from "./StdTypes"

export declare class HxOverrides {
	protected static dateStr(date: Date): string
	protected static strDate(s: string): Date
	protected static cca(s: string, index: number): null | number
	protected static substr(s: string, pos: number, len?: null | number): string
	protected static indexOf<T>(a: T[], obj: T, i: number): number
	protected static lastIndexOf<T>(a: T[], obj: T, i: number): number
	protected static remove<T>(a: T[], obj: T): boolean
	protected static iter<T>(a: T[]): Iterator<T>
	protected static keyValueIter<T>(a: T[]): ArrayKeyValueIterator<T>
	protected static now(): number
}

//# sourceMappingURL=HxOverrides.d.ts.map