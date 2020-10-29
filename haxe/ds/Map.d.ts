import {StringMap} from "./StringMap"
import {ObjectMap} from "./ObjectMap"
import {IntMap} from "./IntMap"
import {EnumValueMap} from "./EnumValueMap"
import {IMap} from "../Constraints"
import {Iterator, KeyValueIterator} from "../../StdTypes"

export declare class Map_Impl_ {
	
	/**
	Maps `key` to `value`.
	
	If `key` already has a mapping, the previous value disappears.
	
	If `key` is `null`, the result is unspecified.
	*/
	static set<K, V>($this: IMap<K, V>, key: K, value: V): void
	
	/**
	Returns the current mapping of `key`.
	
	If no such mapping exists, `null` is returned.
	
	Note that a check like `map.get(key) == null` can hold for two reasons:
	
	1. the map has no mapping for `key`
	2. the map has a mapping with a value of `null`
	
	If it is important to distinguish these cases, `exists()` should be
	used.
	
	If `key` is `null`, the result is unspecified.
	*/
	static get<K, V>($this: IMap<K, V>, key: K): null | V
	
	/**
	Returns true if `key` has a mapping, false otherwise.
	
	If `key` is `null`, the result is unspecified.
	*/
	static exists<K, V>($this: IMap<K, V>, key: K): boolean
	
	/**
	Removes the mapping of `key` and returns true if such a mapping existed,
	false otherwise.
	
	If `key` is `null`, the result is unspecified.
	*/
	static remove<K, V>($this: IMap<K, V>, key: K): boolean
	
	/**
	Returns an Iterator over the keys of `this` Map.
	
	The order of keys is undefined.
	*/
	static keys<K, V>($this: IMap<K, V>): Iterator<K>
	
	/**
	Returns an Iterator over the values of `this` Map.
	
	The order of values is undefined.
	*/
	static iterator<K, V>($this: IMap<K, V>): Iterator<V>
	
	/**
	Returns an Iterator over the keys and values of `this` Map.
	
	The order of values is undefined.
	*/
	static keyValueIterator<K, V>($this: IMap<K, V>): KeyValueIterator<K, V>
	
	/**
	Returns a shallow copy of `this` map.
	
	The order of values is undefined.
	*/
	static copy<K, V>($this: IMap<K, V>): IMap<K, V>
	
	/**
	Returns a String representation of `this` Map.
	
	The exact representation depends on the platform and key-type.
	*/
	static toString<K, V>($this: IMap<K, V>): string
	
	/**
	Removes all keys from `this` Map.
	*/
	static clear<K, V>($this: IMap<K, V>): void
	static arrayWrite<K, V>($this: IMap<K, V>, k: K, v: V): V
}

//# sourceMappingURL=Map.d.ts.map