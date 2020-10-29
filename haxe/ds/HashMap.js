import {IntMap} from "./IntMap"
import {EsMap} from "../../genes/util/EsMap"
import {Register} from "../../genes/Register"

export const HashMap_Impl_ = Register.global("$hxClasses")["haxe.ds._HashMap.HashMap_Impl_"] = 
class HashMap_Impl_ {
	
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
		var _this1 = this1.values;
		var key1 = k.hashCode();
		_this1.inst.set(key1, v);
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
		var _this1 = this1.keys;
		var key1 = k.hashCode();
		return _this1.inst["delete"](key1);
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
		var copied1 = new EsMap();
		copied1.inst = new Map(_this.inst);
		copied.keys = copied1;
		var _this1 = this1.values;
		var copied2 = new EsMap();
		copied2.inst = new Map(_this1.inst);
		copied.values = copied2;
		return copied;
	}
	
	/**
	See `Map.iterator`
	*/
	static iterator(this1) {
		return EsMap.adaptIterator(this1.values.inst.values());
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
		return HashMap_Impl_
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