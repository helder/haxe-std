import {Register} from "../../genes/Register.js"

const $global = Register.$global

export const KeyValue = Register.global("$hxClasses")["js.node._KeyValue.KeyValue"] = 
class KeyValue {
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
		return "js.node._KeyValue.KeyValue_Impl_"
	}
	get __class__() {
		return KeyValue
	}
}


//# sourceMappingURL=KeyValue.js.map