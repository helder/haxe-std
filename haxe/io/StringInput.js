import {BytesInput} from "./BytesInput.js"
import {Bytes} from "./Bytes.js"
import {Register} from "../../genes/Register.js"

const $global = Register.$global

export const StringInput = Register.global("$hxClasses")["haxe.io.StringInput"] = 
class StringInput extends Register.inherits(BytesInput) {
	new(s) {
		super.new(Bytes.ofString(s));
	}
	static get __name__() {
		return "haxe.io.StringInput"
	}
	static get __super__() {
		return BytesInput
	}
	get __class__() {
		return StringInput
	}
}


//# sourceMappingURL=StringInput.js.map