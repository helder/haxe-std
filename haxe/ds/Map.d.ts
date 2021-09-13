import {StringMap} from "./StringMap"
import {ObjectMap} from "./ObjectMap"
import {IntMap} from "./IntMap"
import {EnumValueMap} from "./EnumValueMap"
import {IMap} from "../Constraints"
import {Iterator, KeyValueIterator} from "../../StdTypes"

export declare class Map {
	
	/**
	Maps `key` to `value`.
	
	If `key` already has a mapping, the previous value disappears.
	
	If `key` is `null`, the result is unspecified.
	*/
	static set<V, K>($this: IMap<K, V>, key: K, value: V): void
	
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
	static get<V, K>($this: IMap<K, V>, key: K): null | V
	
	/**
	Returns true if `key` has a mapping, false otherwise.
	
	If `key` is `null`, the result is unspecified.
	*/
	static exists<V, K>($this: IMap<K, V>, key: K): boolean
	
	/**
	Removes the mapping of `key` and returns true if such a mapping existed,
	false otherwise.
	
	If `key` is `null`, the result is unspecified.
	*/
	static remove<V, K>($this: IMap<K, V>, key: K): boolean
	
	/**
	Returns an Iterator over the keys of `this` Map.
	
	The order of keys is undefined.
	*/
	static keys<V, K>($this: IMap<K, V>): Iterator<K>
	
	/**
	Returns an Iterator over the values of `this` Map.
	
	The order of values is undefined.
	*/
	static iterator<V, K>($this: IMap<K, V>): Iterator<V>
	
	/**
	Returns an Iterator over the keys and values of `this` Map.
	
	The order of values is undefined.
	*/
	static keyValueIterator<V, K>($this: IMap<K, V>): KeyValueIterator<K, V>
	
	/**
	Returns a shallow copy of `this` map.
	
	The order of values is undefined.
	*/
	static copy<V, K>($this: IMap<K, V>): IMap<K, V>
	
	/**
	Returns a String representation of `this` Map.
	
	The exact representation depends on the platform and key-type.
	*/
	static toString<V, K>($this: IMap<K, V>): string
	
	/**
	Removes all keys from `this` Map.
	*/
	static clear<V, K>($this: IMap<K, V>): void
	static arrayWrite<V, K>($this: IMap<K, V>, k: K, v: V): V
	protected static toStringMap<V, K>(t: IMap<K, V>): StringMap<V>
	protected static toIntMap<V, K>(t: IMap<K, V>): IntMap<V>
	protected static toEnumValueMapMap<V, K>(t: IMap<K, V>): EnumValueMap<K, V>
	protected static toObjectMap<V, K>(t: IMap<K, V>): ObjectMap<K, V>
	protected static fromStringMap<V, K>(map: StringMap<V>): IMap<string, V>
	protected static fromIntMap<V, K>(map: IntMap<V>): IMap<number, V>
	protected static fromObjectMap<V, K>(map: ObjectMap<K, V>): IMap<K, V>
}

//# sourceMappingURL=Map.d.ts.map