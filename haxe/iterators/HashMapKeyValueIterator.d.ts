import {HashMapData} from "../ds/HashMap"
import {Iterator} from "../../StdTypes"

export declare class HashMapKeyValueIterator<K extends {hashCode: () => number}, V> {
	constructor(map: HashMapData<K, V>)
	protected map: HashMapData<K, V>
	protected keys: Iterator<K>
	
	/**
	See `Iterator.hasNext`
	*/
	hasNext(): boolean
	
	/**
	See `Iterator.next`
	*/
	next(): {key: K, value: V}
}

//# sourceMappingURL=HashMapKeyValueIterator.d.ts.map