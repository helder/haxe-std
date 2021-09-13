import {Register} from "../genes/Register.js"

const $global = Register.$global

export const EnumFlags = Register.global("$hxClasses")["haxe._EnumFlags.EnumFlags"] = 
class EnumFlags {
	
	/**
	Initializes the bitflags to `i`.
	*/
	static _new(i) {
		if (i == null) {
			i = 0;
		};
		var this1 = i;
		return this1;
	}
	
	/**
	Checks if the index of enum instance `v` is set.
	
	This method is optimized if `v` is an enum instance expression such as
	`SomeEnum.SomeCtor`.
	
	If `v` is `null`, the result is unspecified.
	*/
	static has(this1, v) {
		return (this1 & 1 << v._hx_index) != 0;
	}
	
	/**
	Sets the index of enum instance `v`.
	
	This method is optimized if `v` is an enum instance expression such as
	`SomeEnum.SomeCtor`.
	
	If `v` is `null`, the result is unspecified.
	*/
	static set(this1, v) {
		this1 |= 1 << v._hx_index;
	}
	
	/**
	Unsets the index of enum instance `v`.
	
	This method is optimized if `v` is an enum instance expression such as
	`SomeEnum.SomeCtor`.
	
	If `v` is `null`, the result is unspecified.
	*/
	static unset(this1, v) {
		this1 &= -1 - (1 << v._hx_index);
	}
	
	/**
	Convert a integer bitflag into a typed one (this is a no-op, it does not
	have any impact on speed).
	*/
	static ofInt(i) {
		var i1 = i;
		if (i1 == null) {
			i1 = 0;
		};
		var this1 = i1;
		return this1;
	}
	
	/**
	Convert the typed bitflag into the corresponding int value (this is a
	no-op, it doesn't have any impact on speed).
	*/
	static toInt(this1) {
		return this1;
	}
	static get __name__() {
		return "haxe._EnumFlags.EnumFlags_Impl_"
	}
	get __class__() {
		return EnumFlags
	}
}


//# sourceMappingURL=EnumFlags.js.map