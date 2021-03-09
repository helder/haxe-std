import {Register} from "../../genes/Register.js"
import {Reflect} from "../../Reflect.js"

/**
This iterator can be used to iterate over the values of `haxe.DynamicAccess`.
*/
export const DynamicAccessIterator = Register.global("$hxClasses")["haxe.iterators.DynamicAccessIterator"] = 
class DynamicAccessIterator extends Register.inherits() {
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
		return this.access[this.keys[this.index++]];
	}
	static get __name__() {
		return "haxe.iterators.DynamicAccessIterator"
	}
	get __class__() {
		return DynamicAccessIterator
	}
}


//# sourceMappingURL=DynamicAccessIterator.js.map