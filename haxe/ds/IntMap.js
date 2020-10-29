import {MapKeyValueIterator} from "../iterators/MapKeyValueIterator"
import {IMap} from "../Constraints"
import {EsMap} from "../../genes/util/EsMap"
import {Register} from "../../genes/Register"

export const IntMap = Register.global("$hxClasses")["haxe.ds.IntMap"] = 
class IntMap extends Register.inherits(EsMap) {
	new() {
		super.new();
	}
	copy() {
		var copied = new EsMap();
		copied.inst = new Map(this.inst);
		return copied;
	}
	keyValueIterator() {
		return new MapKeyValueIterator(this);
	}
	static get __name__() {
		return "haxe.ds.IntMap"
	}
	static get __interfaces__() {
		return [IMap]
	}
	static get __super__() {
		return EsMap
	}
	get __class__() {
		return IntMap
	}
}


//# sourceMappingURL=IntMap.js.map