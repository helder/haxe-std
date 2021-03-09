import {Register} from "../../genes/Register"

export const ObjectEntry_Impl_ = Register.global("$hxClasses")["js.lib._Object.ObjectEntry_Impl_"] = 
class ObjectEntry_Impl_ {
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
		return "js.lib._Object.ObjectEntry_Impl_"
	}
	get __class__() {
		return ObjectEntry_Impl_
	}
}


//# sourceMappingURL=Object.js.map