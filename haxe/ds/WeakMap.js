import {HaxeError} from "../../js/Boot"
import {IMap} from "../Constraints"
import {Register} from "../../genes/Register"

/**
WeakMap allows mapping of object keys to arbitrary values.

The keys are considered to be weak references on static targets.

See `Map` for documentation details.

@see https://haxe.org/manual/std-Map.html
*/
export const WeakMap = Register.global("$hxClasses")["haxe.ds.WeakMap"] = 
class WeakMap extends Register.inherits() {
	new() {
		throw new HaxeError("Not implemented for this platform");
	}
	
	/**
	See `Map.set`
	*/
	set(key, value) {
	}
	
	/**
	See `Map.get`
	*/
	get(key) {
		return null;
	}
	
	/**
	See `Map.exists`
	*/
	exists(key) {
		return false;
	}
	
	/**
	See `Map.remove`
	*/
	remove(key) {
		return false;
	}
	
	/**
	See `Map.keys`
	*/
	keys() {
		return null;
	}
	
	/**
	See `Map.iterator`
	*/
	iterator() {
		return null;
	}
	
	/**
	See `Map.keyValueIterator`
	*/
	keyValueIterator() {
		return null;
	}
	
	/**
	See `Map.copy`
	*/
	copy() {
		return null;
	}
	
	/**
	See `Map.toString`
	*/
	toString() {
		return null;
	}
	
	/**
	See `Map.clear`
	*/
	clear() {
	}
	static get __name__() {
		return "haxe.ds.WeakMap"
	}
	static get __interfaces__() {
		return [IMap]
	}
	get __class__() {
		return WeakMap
	}
}


//# sourceMappingURL=WeakMap.js.map