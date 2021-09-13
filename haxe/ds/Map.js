import {StringMap} from "./StringMap.js"
import {ObjectMap} from "./ObjectMap.js"
import {IntMap} from "./IntMap.js"
import {EnumValueMap} from "./EnumValueMap.js"
import {Register} from "../../genes/Register.js"

const $global = Register.$global

export const Map = Register.global("$hxClasses")["haxe.ds._Map.Map"] = 
class Map {
	
	/**
	Maps `key` to `value`.
	
	If `key` already has a mapping, the previous value disappears.
	
	If `key` is `null`, the result is unspecified.
	*/
	static set(this1, key, value) {
		this1.set(key, value);
	}
	
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
	static get(this1, key) {
		return this1.get(key);
	}
	
	/**
	Returns true if `key` has a mapping, false otherwise.
	
	If `key` is `null`, the result is unspecified.
	*/
	static exists(this1, key) {
		return this1.exists(key);
	}
	
	/**
	Removes the mapping of `key` and returns true if such a mapping existed,
	false otherwise.
	
	If `key` is `null`, the result is unspecified.
	*/
	static remove(this1, key) {
		return this1.remove(key);
	}
	
	/**
	Returns an Iterator over the keys of `this` Map.
	
	The order of keys is undefined.
	*/
	static keys(this1) {
		return this1.keys();
	}
	
	/**
	Returns an Iterator over the values of `this` Map.
	
	The order of values is undefined.
	*/
	static iterator(this1) {
		return this1.iterator();
	}
	
	/**
	Returns an Iterator over the keys and values of `this` Map.
	
	The order of values is undefined.
	*/
	static keyValueIterator(this1) {
		return this1.keyValueIterator();
	}
	
	/**
	Returns a shallow copy of `this` map.
	
	The order of values is undefined.
	*/
	static copy(this1) {
		return this1.copy();
	}
	
	/**
	Returns a String representation of `this` Map.
	
	The exact representation depends on the platform and key-type.
	*/
	static toString(this1) {
		return this1.toString();
	}
	
	/**
	Removes all keys from `this` Map.
	*/
	static clear(this1) {
		this1.clear();
	}
	static arrayWrite(this1, k, v) {
		this1.set(k, v);
		return v;
	}
	static toStringMap(t) {
		return new StringMap();
	}
	static toIntMap(t) {
		return new IntMap();
	}
	static toEnumValueMapMap(t) {
		return new EnumValueMap();
	}
	static toObjectMap(t) {
		return new ObjectMap();
	}
	static fromStringMap(map) {
		return map;
	}
	static fromIntMap(map) {
		return map;
	}
	static fromObjectMap(map) {
		return map;
	}
	static get __name__() {
		return "haxe.ds._Map.Map_Impl_"
	}
	get __class__() {
		return Map
	}
}


//# sourceMappingURL=Map.js.map