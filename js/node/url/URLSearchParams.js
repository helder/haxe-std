import {Register} from "../../../genes/Register.js"

const $global = Register.$global

export const URLSearchParamsEntry = Register.global("$hxClasses")["js.node.url._URLSearchParams.URLSearchParamsEntry"] = 
class URLSearchParamsEntry {
	static get name() {
		return this.get_name()
	}
	static get value() {
		return this.get_value()
	}
	static _new(name, value) {
		var this1 = [name, value];
		return this1;
	}
	static get_name(this1) {
		return this1[0];
	}
	static get_value(this1) {
		return this1[1];
	}
	static get __name__() {
		return "js.node.url._URLSearchParams.URLSearchParamsEntry_Impl_"
	}
	get __class__() {
		return URLSearchParamsEntry
	}
}


//# sourceMappingURL=URLSearchParams.js.map