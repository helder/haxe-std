import {Register} from "../../genes/Register"

export const ReadOnlyArray_Impl_ = Register.global("$hxClasses")["haxe.ds._ReadOnlyArray.ReadOnlyArray_Impl_"] = 
class ReadOnlyArray_Impl_ {
	static get length() {
		return this.get_length()
	}
	static get_length(this1) {
		return this1.length;
	}
	static get(this1, i) {
		return this1[i];
	}
	static get __name__() {
		return "haxe.ds._ReadOnlyArray.ReadOnlyArray_Impl_"
	}
	get __class__() {
		return ReadOnlyArray_Impl_
	}
}


//# sourceMappingURL=ReadOnlyArray.js.map