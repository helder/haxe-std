import {HaxeIterator} from "./HaxeIterator"

/**
key => value iterator for js.lib.Set, tracking the entry index for the key to match the behavior of haxe.ds.List
*/
export declare class SetKeyValueIterator<T> {
	constructor(set: Set<T>)
	hasNext(): boolean
	next(): {key: number, value: T}
}

//# sourceMappingURL=Set.d.ts.map