import {IntMap} from "./IntMap"
import {Iterator} from "../../StdTypes"

export declare class HashMap_Impl_ {
	
	/**
	Creates a new HashMap.
	*/
	static _new<K, V>(): HashMapData<K, V>
	
	/**
	See `Map.set`
	*/
	static set<K, V>($this: HashMapData<K, V>, k: K, v: V): void
	
	/**
	See `Map.get`
	*/
	static get<K, V>($this: HashMapData<K, V>, k: K): null | V
	
	/**
	See `Map.exists`
	*/
	static exists<K, V>($this: HashMapData<K, V>, k: K): boolean
	
	/**
	See `Map.remove`
	*/
	static remove<K, V>($this: HashMapData<K, V>, k: K): boolean
	
	/**
	See `Map.keys`
	*/
	static keys<K, V>($this: HashMapData<K, V>): Iterator<K>
	
	/**
	See `Map.copy`
	*/
	static copy<K, V>($this: HashMapData<K, V>): HashMapData<K, V>
	
	/**
	See `Map.iterator`
	*/
	static iterator<K, V>($this: HashMapData<K, V>): Iterator<V>
	
	/**
	See `Map.clear`
	*/
	static clear<K, V>($this: HashMapData<K, V>): void
}

export declare class HashMapData<K, V> {
	constructor()
	keys: IntMap<K>
	values: IntMap<V>
}

//# sourceMappingURL=HashMap.d.ts.map