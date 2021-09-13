import {Register} from "../Register.js"
import {Std} from "../../Std.js"

const $global = Register.$global

export const EsMap = Register.global("$hxClasses")["genes.util.EsMap"] = 
class EsMap extends Register.inherits() {
	new() {
		this.inst = new Map();
	}
	set(key, value) {
		this.inst.set(key, value);
	}
	get(key) {
		return this.inst.get(key);
	}
	remove(key) {
		return this.inst["delete"](key);
	}
	exists(key) {
		return this.inst.has(key);
	}
	keys() {
		return EsMap.adaptIterator(this.inst.keys());
	}
	iterator() {
		return EsMap.adaptIterator(this.inst.values());
	}
	toString() {
		var _g = [];
		var key = EsMap.adaptIterator(this.inst.keys());
		while (key.hasNext()) {
			var key1 = key.next();
			_g.push("" + Std.string(key1) + " => " + Std.string(this.inst.get(key1)));
		};
		return "{" + _g.join(", ") + "}";
	}
	clear() {
		this.inst.clear();
	}
	static adaptIterator(from) {
		var value;
		var done;
		var queue = function () {
			var data = from.next();
			value = data.value;
			done = data.done;
		};
		return {"hasNext": function () {
			if (done == null) {
				queue();
			};
			return !done;
		}, "next": function () {
			if (done == null) {
				queue();
			};
			var pending = value;
			queue();
			return pending;
		}};
	}
	static get __name__() {
		return "genes.util.EsMap"
	}
	get __class__() {
		return EsMap
	}
}


//# sourceMappingURL=EsMap.js.map