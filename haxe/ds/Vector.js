import {Register} from "../../genes/Register.js"
import {Std} from "../../Std.js"

export const Vector_Impl_ = Register.global("$hxClasses")["haxe.ds._Vector.Vector_Impl_"] = 
class Vector_Impl_ {
	
	/**
	Creates a new Vector of length `length`.
	
	Initially `this` Vector contains `length` neutral elements:
	
	- always null on dynamic targets
	- 0, 0.0 or false for Int, Float and Bool respectively on static targets
	- null for other types on static targets
	
	If `length` is less than or equal to 0, the result is unspecified.
	*/
	static _new(length) {
		let this1 = new Array(length);
		return this1;
	}
	
	/**
	Returns the value at index `index`.
	
	If `index` is negative or exceeds `this.length`, the result is
	unspecified.
	*/
	static get(this1, index) {
		return this1[index];
	}
	
	/**
	Sets the value at index `index` to `val`.
	
	If `index` is negative or exceeds `this.length`, the result is
	unspecified.
	*/
	static set(this1, index, val) {
		return this1[index] = val;
	}
	static get length() {
		return this.get_length()
	}
	static get_length(this1) {
		return this1.length;
	}
	
	/**
	Copies `length` of elements from `src` Vector, beginning at `srcPos` to
	`dest` Vector, beginning at `destPos`
	
	The results are unspecified if `length` results in out-of-bounds access,
	or if `src` or `dest` are null
	*/
	static blit(src, srcPos, dest, destPos, len) {
		if (src == dest) {
			if (srcPos < destPos) {
				let i = srcPos + len;
				let j = destPos + len;
				let _g = 0;
				let _g1 = len;
				while (_g < _g1) {
					let k = _g++;
					--i;
					--j;
					src[j] = src[i];
				};
			} else if (srcPos > destPos) {
				let i = srcPos;
				let j = destPos;
				let _g = 0;
				let _g1 = len;
				while (_g < _g1) {
					let k = _g++;
					src[j] = src[i];
					++i;
					++j;
				};
			};
		} else {
			let _g = 0;
			let _g1 = len;
			while (_g < _g1) {
				let i = _g++;
				dest[destPos + i] = src[srcPos + i];
			};
		};
	}
	
	/**
	Creates a new Array, copy the content from the Vector to it, and returns it.
	*/
	static toArray(this1) {
		return this1.slice(0);
	}
	
	/**
	Extracts the data of `this` Vector.
	
	This returns the internal representation type.
	*/
	static toData(this1) {
		return this1;
	}
	
	/**
	Initializes a new Vector from `data`.
	
	Since `data` is the internal representation of Vector, this is a no-op.
	
	If `data` is null, the corresponding Vector is also `null`.
	*/
	static fromData(data) {
		return data;
	}
	
	/**
	Creates a new Vector by copying the elements of `array`.
	
	This always creates a copy, even on platforms where the internal
	representation is Array.
	
	The elements are not copied and retain their identity, so
	`a[i] == Vector.fromArrayCopy(a).get(i)` is true for any valid i.
	
	If `array` is null, the result is unspecified.
	*/
	static fromArrayCopy(array) {
		return array.slice(0);
	}
	
	/**
	Returns a shallow copy of `this` Vector.
	
	The elements are not copied and retain their identity, so
	`a[i] == a.copy()[i]` is true for any valid `i`. However,
	`a == a.copy()` is always false.
	*/
	static copy(this1) {
		let this2 = new Array(this1.length);
		let r = this2;
		Vector_Impl_.blit(this1, 0, r, 0, this1.length);
		return r;
	}
	
	/**
	Returns a string representation of `this` Vector, with `sep` separating
	each element.
	
	The result of this operation is equal to `Std.string(this[0]) + sep +
	Std.string(this[1]) + sep + ... + sep + Std.string(this[this.length-1])`
	
	If `this` Vector has length 0, the result is the empty String `""`.
	If `this` has exactly one element, the result is equal to a call to
	`Std.string(this[0])`.
	
	If `sep` is null, the result is unspecified.
	*/
	static join(this1, sep) {
		let b_b = "";
		let len = this1.length;
		let _g = 0;
		let _g1 = len;
		while (_g < _g1) {
			let i = _g++;
			b_b += Std.string(Std.string(this1[i]));
			if (i < len - 1) {
				b_b += (sep == null) ? "null" : "" + sep;
			};
		};
		return b_b;
	}
	
	/**
	Creates a new Vector by applying function `f` to all elements of `this`.
	
	The order of elements is preserved.
	
	If `f` is null, the result is unspecified.
	*/
	static map(this1, f) {
		let length = this1.length;
		let this2 = new Array(length);
		let r = this2;
		let len = length;
		let _g = 0;
		let _g1 = len;
		while (_g < _g1) {
			let i = _g++;
			let v = f(this1[i]);
			r[i] = v;
		};
		return r;
	}
	
	/**
	Sorts `this` Vector according to the comparison function `f`, where
	`f(x,y)` returns 0 if x == y, a positive Int if x > y and a
	negative Int if x < y.
	
	This operation modifies `this` Vector in place.
	
	The sort operation is not guaranteed to be stable, which means that the
	order of equal elements may not be retained.
	
	If `f` is null, the result is unspecified.
	*/
	static sort(this1, f) {
		this1.sort(f);
	}
	static get __name__() {
		return "haxe.ds._Vector.Vector_Impl_"
	}
	get __class__() {
		return Vector_Impl_
	}
}


//# sourceMappingURL=Vector.js.map