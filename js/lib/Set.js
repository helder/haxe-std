import {HaxeIterator} from "./HaxeIterator.js"
import {Register} from "../../genes/Register.js"

/**
key => value iterator for js.lib.Set, tracking the entry index for the key to match the behavior of haxe.ds.List
*/
export const SetKeyValueIterator = Register.global("$hxClasses")["js.lib.SetKeyValueIterator"] = 
class SetKeyValueIterator extends Register.inherits() {
	new(set) {
		this.index = 0;
		this.set = set;
		this.values = new HaxeIterator(set.values());
	}
	hasNext() {
		return !this.values.lastStep.done;
	}
	next() {
		let tmp = this.index++;
		let _this = this.values;
		let v = _this.lastStep.value;
		_this.lastStep = _this.jsIterator.next();
		return {"key": tmp, "value": v};
	}
	static get __name__() {
		return "js.lib.SetKeyValueIterator"
	}
	get __class__() {
		return SetKeyValueIterator
	}
}


//# sourceMappingURL=Set.js.map