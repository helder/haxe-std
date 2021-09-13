import {Register} from "../../genes/Register.js"

const $global = Register.$global

export const ObjectEntry = Register.global("$hxClasses")["js.lib._Object.ObjectEntry"] = 
class ObjectEntry {
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
		return ObjectEntry
	}
}


//# sourceMappingURL=Object.js.map