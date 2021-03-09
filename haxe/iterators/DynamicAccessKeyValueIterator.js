import {Register} from "../../genes/Register.js"
import {Reflect} from "../../Reflect.js"

/**
This Key/Value iterator can be used to iterate over `haxe.DynamicAccess`.
*/
export const DynamicAccessKeyValueIterator = Register.global("$hxClasses")["haxe.iterators.DynamicAccessKeyValueIterator"] = 
class DynamicAccessKeyValueIterator extends Register.inherits() {
	new(access) {
		this.access = access;
		this.keys = Reflect.fields(access);
		this.index = 0;
	}
	
	/**
	See `Iterator.hasNext`
	*/
	hasNext() {
		return this.index < this.keys.length;
	}
	
	/**
	See `Iterator.next`
	*/
	next() {
		var key = this.keys[this.index++];
		return {"value": this.access[key], "key": key};
	}
	static get __name__() {
		return "haxe.iterators.DynamicAccessKeyValueIterator"
	}
	get __class__() {
		return DynamicAccessKeyValueIterator
	}
}


//# sourceMappingURL=DynamicAccessKeyValueIterator.js.map