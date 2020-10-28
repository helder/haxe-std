import {DynamicAccessKeyValueIterator} from "./iterators/DynamicAccessKeyValueIterator"
import {DynamicAccessIterator} from "./iterators/DynamicAccessIterator"
import {Register} from "../genes/Register"
import {Reflect} from "../Reflect"

export const DynamicAccess_Impl_ = Register.global("$hxClasses")["haxe._DynamicAccess.DynamicAccess_Impl_"] = 
class DynamicAccess_Impl_ {
	
	/**
	Creates a new structure.
	*/
	static _new() {
		let this1 = {};
		return this1;
	}
	
	/**
	Returns a value by specified `key`.
	
	If the structure does not contain the given key, `null` is returned.
	
	If `key` is `null`, the result is unspecified.
	*/
	static get(this1, key) {
		return this1[key];
	}
	
	/**
	Sets a `value` for a specified `key`.
	
	If the structure contains the given key, its value will be overwritten.
	
	Returns the given value.
	
	If `key` is `null`, the result is unspecified.
	*/
	static set(this1, key, value) {
		return this1[key] = value;
	}
	
	/**
	Tells if the structure contains a specified `key`.
	
	If `key` is `null`, the result is unspecified.
	*/
	static exists(this1, key) {
		return Object.prototype.hasOwnProperty.call(this1, key);
	}
	
	/**
	Removes a specified `key` from the structure.
	
	Returns true, if `key` was present in structure, or false otherwise.
	
	If `key` is `null`, the result is unspecified.
	*/
	static remove(this1, key) {
		return Reflect.deleteField(this1, key);
	}
	
	/**
	Returns an array of `keys` in a structure.
	*/
	static keys(this1) {
		return Reflect.fields(this1);
	}
	
	/**
	Returns a shallow copy of the structure
	*/
	static copy(this1) {
		return Reflect.copy(this1);
	}
	
	/**
	Returns an Iterator over the values of this `DynamicAccess`.
	
	The order of values is undefined.
	*/
	static iterator(this1) {
		return new DynamicAccessIterator(this1);
	}
	
	/**
	Returns an Iterator over the keys and values of this `DynamicAccess`.
	
	The order of values is undefined.
	*/
	static keyValueIterator(this1) {
		return new DynamicAccessKeyValueIterator(this1);
	}
	static get __name__() {
		return "haxe._DynamicAccess.DynamicAccess_Impl_"
	}
	get __class__() {
		return DynamicAccess_Impl_
	}
}


//# sourceMappingURL=DynamicAccess.js.map