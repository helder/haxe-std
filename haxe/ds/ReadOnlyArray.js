import {Register} from "../../genes/Register.js"

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
	
	/**
	Returns a new Array by appending the elements of `a` to the elements of
	`this` Array.
	
	This operation does not modify `this` Array.
	
	If `a` is the empty Array `[]`, a copy of `this` Array is returned.
	
	The length of the returned Array is equal to the sum of `this.length`
	and `a.length`.
	
	If `a` is `null`, the result is unspecified.
	*/
	static concat(this1, a) {
		return this1.concat(a);
	}
	static get __name__() {
		return "haxe.ds._ReadOnlyArray.ReadOnlyArray_Impl_"
	}
	get __class__() {
		return ReadOnlyArray_Impl_
	}
}


//# sourceMappingURL=ReadOnlyArray.js.map