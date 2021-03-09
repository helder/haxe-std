import {HashMapData} from "../ds/HashMap"
import {Iterator} from "../../StdTypes"

export declare class HashMapKeyValueIterator<K, V> {
	constructor(map: HashMapData<K, V>)
	
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