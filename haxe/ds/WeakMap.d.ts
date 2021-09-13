import {IMap} from "../Constraints"
import {Iterator, KeyValueIterator} from "../../StdTypes"

/**
WeakMap allows mapping of object keys to arbitrary values.

The keys are considered to be weak references on static targets.

See `Map` for documentation details.

@see https://haxe.org/manual/std-Map.html
*/
export declare class WeakMap<K extends {}, V> implements IMap<K, V> {
	constructor()
	
	/**
	See `Map.set`
	*/
	set(key: K, value: V): void
	
	/**
	See `Map.get`
	*/
	get(key: K): null | V
	
	/**
	See `Map.exists`
	*/
	exists(key: K): boolean
	
	/**
	See `Map.remove`
	*/
	remove(key: K): boolean
	
	/**
	See `Map.keys`
	*/
	keys(): Iterator<K>
	
	/**
	See `Map.iterator`
	*/
	iterator(): Iterator<V>
	
	/**
	See `Map.keyValueIterator`
	*/
	keyValueIterator(): KeyValueIterator<K, V>
	
	/**
	See `Map.copy`
	*/
	copy(): WeakMap<K, V>
	
	/**
	See `Map.toString`
	*/
	toString(): string
	
	/**
	See `Map.clear`
	*/
	clear(): void
}

//# sourceMappingURL=WeakMap.d.ts.map