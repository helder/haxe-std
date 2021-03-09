import {Register} from "../../genes/Register.js"

/**
This Key/Value iterator can be used to iterate across maps.
*/
export const MapKeyValueIterator = Register.global("$hxClasses")["haxe.iterators.MapKeyValueIterator"] = 
class MapKeyValueIterator extends Register.inherits() {
	new(map) {
		this.map = map;
		this.keys = map.keys();
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
		return {"value": this.map.get(key), "key": key};
	}
	static get __name__() {
		return "haxe.iterators.MapKeyValueIterator"
	}
	get __class__() {
		return MapKeyValueIterator
	}
}


//# sourceMappingURL=MapKeyValueIterator.js.map