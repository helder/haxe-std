import {BalancedTree} from "./BalancedTree.js"
import {IMap} from "../Constraints.js"
import {Register} from "../../genes/Register.js"
import {Type} from "../../Type.js"
import {Reflect as Reflect__1} from "../../Reflect.js"

const $global = Register.$global

/**
EnumValueMap allows mapping of enum value keys to arbitrary values.

Keys are compared by value and recursively over their parameters. If any
parameter is not an enum value, `Reflect.compare` is used to compare them.
*/
export const EnumValueMap = Register.global("$hxClasses")["haxe.ds.EnumValueMap"] = 
class EnumValueMap extends Register.inherits(BalancedTree) {
	new() {
		super.new();
	}
	compare(k1, k2) {
		var d = k1._hx_index - k2._hx_index;
		if (d != 0) {
			return d;
		};
		var p1 = Type.enumParameters(k1);
		var p2 = Type.enumParameters(k2);
		if (p1.length == 0 && p2.length == 0) {
			return 0;
		};
		return this.compareArgs(p1, p2);
	}
	compareArgs(a1, a2) {
		var ld = a1.length - a2.length;
		if (ld != 0) {
			return ld;
		};
		var _g = 0;
		var _g1 = a1.length;
		while (_g < _g1) {
			var i = _g++;
			var d = this.compareArg(a1[i], a2[i]);
			if (d != 0) {
				return d;
			};
		};
		return 0;
	}
	compareArg(v1, v2) {
		if (Reflect__1.isEnumValue(v1) && Reflect__1.isEnumValue(v2)) {
			return this.compare(v1, v2);
		} else if (((v1) instanceof Array) && ((v2) instanceof Array)) {
			return this.compareArgs(v1, v2);
		} else {
			return Reflect__1.compare(v1, v2);
		};
	}
	copy() {
		var copied = new EnumValueMap();
		copied.root = this.root;
		return copied;
	}
	static get __name__() {
		return "haxe.ds.EnumValueMap"
	}
	static get __interfaces__() {
		return [IMap]
	}
	static get __super__() {
		return BalancedTree
	}
	get __class__() {
		return EnumValueMap
	}
}


//# sourceMappingURL=EnumValueMap.js.map