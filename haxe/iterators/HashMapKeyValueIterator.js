import {EsMap} from "../../genes/util/EsMap.js"
import {Register} from "../../genes/Register.js"

const $global = Register.$global

export const HashMapKeyValueIterator = Register.global("$hxClasses")["haxe.iterators.HashMapKeyValueIterator"] = 
class HashMapKeyValueIterator extends Register.inherits() {
	new(map) {
		this.map = map;
		this.keys = EsMap.adaptIterator(map.keys.inst.values());
	}
	
	/**
	See `Iterator.hasNext`
	*/
	hasNext() {
		return this.keys.hasNext();
	}
	
	/**
	See `Iterator.next`
	*/
	next() {
		var key = this.keys.next();
		var _this = this.map.values;
		var key1 = key.hashCode();
		return {"value": _this.inst.get(key1), "key": key};
	}
	static get __name__() {
		return "haxe.iterators.HashMapKeyValueIterator"
	}
	get __class__() {
		return HashMapKeyValueIterator
	}
}


//# sourceMappingURL=HashMapKeyValueIterator.js.map