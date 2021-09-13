import {HashMapKeyValueIterator} from "../iterators/HashMapKeyValueIterator"
import {IntMap} from "./IntMap"
import {Iterator} from "../../StdTypes"

export declare class HashMap {
	
	/**
	Creates a new HashMap.
	*/
	static _new<V, K extends {hashCode: () => number}>(): HashMapData<K, V>
	
	/**
	See `Map.set`
	*/
	static set<V, K extends {hashCode: () => number}>($this: HashMapData<K, V>, k: K, v: V): void
	
	/**
	See `Map.get`
	*/
	static get<V, K extends {hashCode: () => number}>($this: HashMapData<K, V>, k: K): null | V
	
	/**
	See `Map.exists`
	*/
	static exists<V, K extends {hashCode: () => number}>($this: HashMapData<K, V>, k: K): boolean
	
	/**
	See `Map.remove`
	*/
	static remove<V, K extends {hashCode: () => number}>($this: HashMapData<K, V>, k: K): boolean
	
	/**
	See `Map.keys`
	*/
	static keys<V, K extends {hashCode: () => number}>($this: HashMapData<K, V>): Iterator<K>
	
	/**
	See `Map.copy`
	*/
	static copy<V, K extends {hashCode: () => number}>($this: HashMapData<K, V>): HashMapData<K, V>
	
	/**
	See `Map.iterator`
	*/
	static iterator<V, K extends {hashCode: () => number}>($this: HashMapData<K, V>): Iterator<V>
	
	/**
	See `Map.keyValueIterator`
	*/
	static keyValueIterator<V, K extends {hashCode: () => number}>($this: HashMapData<K, V>): HashMapKeyValueIterator<K, V>
	
	/**
	See `Map.clear`
	*/
	static clear<V, K extends {hashCode: () => number}>($this: HashMapData<K, V>): void
}

export declare class HashMapData<K extends {hashCode: () => number}, V> {
	constructor()
	keys: IntMap<K>
	values: IntMap<V>
}

//# sourceMappingURL=HashMap.d.ts.map