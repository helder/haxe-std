import {Register} from "../../genes/Register.js"

export const MapEntry_Impl_ = Register.global("$hxClasses")["js.lib._Map.MapEntry_Impl_"] = 
class MapEntry_Impl_ {
	static get key() {
		return this.get_key()
	}
	static get value() {
		return this.get_value()
	}
	static get_key(this1) {
		return this1[0];
	}
	static get_value(this1) {
		return this1[1];
	}
	static get __name__() {
		return "js.lib._Map.MapEntry_Impl_"
	}
	get __class__() {
		return MapEntry_Impl_
	}
}


//# sourceMappingURL=Map.js.map