import {Register} from "../../genes/Register.js"

const $global = Register.$global

export const BufferSource = Register.global("$hxClasses")["js.lib._BufferSource.BufferSource"] = 
class BufferSource {
	static fromBufferView(view) {
		return view.buffer;
	}
	static get __name__() {
		return "js.lib._BufferSource.BufferSource_Impl_"
	}
	get __class__() {
		return BufferSource
	}
}


//# sourceMappingURL=BufferSource.js.map