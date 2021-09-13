import {HashMapKeyValueIterator} from "../iterators/HashMapKeyValueIterator.js"
import {IntMap} from "./IntMap.js"
import {EsMap} from "../../genes/util/EsMap.js"
import {Register} from "../../genes/Register.js"

const $global = Register.$global

export const HashMap = Register.global("$hxClasses")["haxe.ds._HashMap.HashMap"] = 
class HashMap {
	
	/**
	Creates a new HashMap.
	*/
	static _new() {
		var this1 = new HashMapData();
		return this1;
	}
	
	/**
	See `Map.set`
	*/
	static set(this1, k, v) {
		var _this = this1.keys;
		var key = k.hashCode();
		_this.inst.set(key, k);
		var _this = this1.values;
		var key = k.hashCode();
		_this.inst.set(key, v);
	}
	
	/**
	See `Map.get`
	*/
	static get(this1, k) {
		var _this = this1.values;
		var key = k.hashCode();
		return _this.inst.get(key);
	}
	
	/**
	See `Map.exists`
	*/
	static exists(this1, k) {
		var _this = this1.values;
		var key = k.hashCode();
		return _this.inst.has(key);
	}
	
	/**
	See `Map.remove`
	*/
	static remove(this1, k) {
		var _this = this1.values;
		var key = k.hashCode();
		_this.inst["delete"](key);
		var _this = this1.keys;
		var key = k.hashCode();
		return _this.inst["delete"](key);
	}
	
	/**
	See `Map.keys`
	*/
	static keys(this1) {
		return EsMap.adaptIterator(this1.keys.inst.values());
	}
	
	/**
	See `Map.copy`
	*/
	static copy(this1) {
		var copied = new HashMapData();
		var _this = this1.keys;
		var copied1 = new IntMap();
		copied1.inst = new Map(_this.inst);
		copied.keys = copied1;
		var _this = this1.values;
		var copied1 = new IntMap();
		copied1.inst = new Map(_this.inst);
		copied.values = copied1;
		return copied;
	}
	
	/**
	See `Map.iterator`
	*/
	static iterator(this1) {
		return EsMap.adaptIterator(this1.values.inst.values());
	}
	
	/**
	See `Map.keyValueIterator`
	*/
	static keyValueIterator(this1) {
		return new HashMapKeyValueIterator(this1);
	}
	
	/**
	See `Map.clear`
	*/
	static clear(this1) {
		this1.keys.clear();
		this1.values.clear();
	}
	static get __name__() {
		return "haxe.ds._HashMap.HashMap_Impl_"
	}
	get __class__() {
		return HashMap
	}
}


export const HashMapData = Register.global("$hxClasses")["haxe.ds._HashMap.HashMapData"] = 
class HashMapData extends Register.inherits() {
	new() {
		this.keys = new IntMap();
		this.values = new IntMap();
	}
	static get __name__() {
		return "haxe.ds._HashMap.HashMapData"
	}
	get __class__() {
		return HashMapData
	}
}


//# sourceMappingURL=HashMap.js.map