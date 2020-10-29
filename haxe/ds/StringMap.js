import {MapKeyValueIterator} from "../iterators/MapKeyValueIterator"
import {IMap} from "../Constraints"
import {EsMap} from "../../genes/util/EsMap"
import {Register} from "../../genes/Register"

export const StringMap = Register.global("$hxClasses")["haxe.ds.StringMap"] = 
class StringMap extends Register.inherits(EsMap) {
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
		return "haxe.ds.StringMap"
	}
	static get __interfaces__() {
		return [IMap]
	}
	static get __super__() {
		return EsMap
	}
	get __class__() {
		return StringMap
	}
}


//# sourceMappingURL=StringMap.js.map