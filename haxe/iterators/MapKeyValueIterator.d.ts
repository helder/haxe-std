import {IMap} from "../Constraints"
import {Iterator} from "../../StdTypes"

/**
This Key/Value iterator can be used to iterate across maps.
*/
export declare class MapKeyValueIterator<K, V> {
	constructor(map: IMap<K, V>)
	protected map: IMap<K, V>
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

//# sourceMappingURL=MapKeyValueIterator.d.ts.map