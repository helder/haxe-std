import {MapKeyValueIterator} from "../iterators/MapKeyValueIterator"
import {IMap} from "../Constraints"
import {EsMap} from "../../genes/util/EsMap"
import {Register} from "../../genes/Register"

export const ObjectMap = Register.global("$hxClasses")["haxe.ds.ObjectMap"] = 
class ObjectMap extends Register.inherits(EsMap) {
	new() {
		super.new();
	}
	copy() {
		let copied = new EsMap();
		copied.inst = new Map(this.inst);
		return copied;
	}
	keyValueIterator() {
		return new MapKeyValueIterator(this);
	}
	static get __name__() {
		return "haxe.ds.ObjectMap"
	}
	static get __interfaces__() {
		return [IMap]
	}
	static get __super__() {
		return EsMap
	}
	get __class__() {
		return ObjectMap
	}
}


//# sourceMappingURL=ObjectMap.js.map