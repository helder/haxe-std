import {HaxeError} from "./js/Boot.js"
import {CallStack} from "./haxe/CallStack.js"
import {Register} from "./genes/Register.js"

/**
The Reflect API is a way to manipulate values dynamically through an
abstract interface in an untyped manner. Use with care.

@see https://haxe.org/manual/std-reflection.html
*/
export const Reflect = Register.global("$hxClasses")["Reflect"] = 
class Reflect {
	
	/**
	Tells if structure `o` has a field named `field`.
	
	This is only guaranteed to work for anonymous structures. Refer to
	`Type.getInstanceFields` for a function supporting class instances.
	
	If `o` or `field` are null, the result is unspecified.
	*/
	static hasField(o, field) {
		return Object.prototype.hasOwnProperty.call(o, field);
	}
	
	/**
	Returns the value of the field named `field` on object `o`.
	
	If `o` is not an object or has no field named `field`, the result is
	null.
	
	If the field is defined as a property, its accessors are ignored. Refer
	to `Reflect.getProperty` for a function supporting property accessors.
	
	If `field` is null, the result is unspecified.
	
	(As3) If used on a property field, the getter will be invoked. It is
	not possible to obtain the value directly.
	*/
	static field(o, field) {
		try {
			return o[field];
		}catch (e) {
			CallStack.lastException = e;
			var e1 = (((e) instanceof HaxeError)) ? e.val : e;
			return null;
		};
	}
	
	/**
	Sets the field named `field` of object `o` to value `value`.
	
	If `o` has no field named `field`, this function is only guaranteed to
	work for anonymous structures.
	
	If `o` or `field` are null, the result is unspecified.
	
	(As3) If used on a property field, the setter will be invoked. It is
	not possible to set the value directly.
	*/
	static setField(o, field, value) {
		o[field] = value;
	}
	
	/**
	Returns the value of the field named `field` on object `o`, taking
	property getter functions into account.
	
	If the field is not a property, this function behaves like
	`Reflect.field`, but might be slower.
	
	If `o` or `field` are null, the result is unspecified.
	*/
	static getProperty(o, field) {
		var tmp;
		if (o == null) {
			return null;
		} else {
			var tmp1;
			if (o.__properties__) {
				tmp = o.__properties__["get_" + field];
				tmp1 = tmp;
			} else {
				tmp1 = false;
			};
			if (tmp1) {
				return o[tmp]();
			} else {
				return o[field];
			};
		};
	}
	
	/**
	Sets the field named `field` of object `o` to value `value`, taking
	property setter functions into account.
	
	If the field is not a property, this function behaves like
	`Reflect.setField`, but might be slower.
	
	If `field` is null, the result is unspecified.
	*/
	static setProperty(o, field, value) {
		var tmp;
		var tmp1;
		if (o.__properties__) {
			tmp = o.__properties__["set_" + field];
			tmp1 = tmp;
		} else {
			tmp1 = false;
		};
		if (tmp1) {
			o[tmp](value);
		} else {
			o[field] = value;
		};
	}
	
	/**
	Call a method `func` with the given arguments `args`.
	
	The object `o` is ignored in most cases. It serves as the `this`-context in the following
	situations:
	
	* (neko) Allows switching the context to `o` in all cases.
	* (macro) Same as neko for Haxe 3. No context switching in Haxe 4.
	* (js, lua) Require the `o` argument if `func` does not, but should have a context.
	This can occur by accessing a function field natively, e.g. through `Reflect.field`
	or by using `(object : Dynamic).field`. However, if `func` has a context, `o` is
	ignored like on other targets.
	*/
	static callMethod(o, func, args) {
		return func.apply(o, args);
	}
	
	/**
	Returns the fields of structure `o`.
	
	This method is only guaranteed to work on anonymous structures. Refer to
	`Type.getInstanceFields` for a function supporting class instances.
	
	If `o` is null, the result is unspecified.
	*/
	static fields(o) {
		var a = [];
		if (o != null) {
			var hasOwnProperty = Object.prototype.hasOwnProperty;
			for( var f in o ) {;
			if (f != "__id__" && f != "hx__closures__" && hasOwnProperty.call(o, f)) {
				a.push(f);
			};
			};
		};
		return a;
	}
	
	/**
	Returns true if `f` is a function, false otherwise.
	
	If `f` is null, the result is false.
	*/
	static isFunction(f) {
		if (typeof(f) == "function") {
			return !(f.__name__ || f.__ename__);
		} else {
			return false;
		};
	}
	
	/**
	Compares `a` and `b`.
	
	If `a` is less than `b`, the result is negative. If `b` is less than
	`a`, the result is positive. If `a` and `b` are equal, the result is 0.
	
	This function is only defined if `a` and `b` are of the same type.
	
	If that type is a function, the result is unspecified and
	`Reflect.compareMethods` should be used instead.
	
	For all other types, the result is 0 if `a` and `b` are equal. If they
	are not equal, the result depends on the type and is negative if:
	
	- Numeric types: a is less than b
	- String: a is lexicographically less than b
	- Other: unspecified
	
	If `a` and `b` are null, the result is 0. If only one of them is null,
	the result is unspecified.
	*/
	static compare(a, b) {
		if (a == b) {
			return 0;
		} else if (a > b) {
			return 1;
		} else {
			return -1;
		};
	}
	
	/**
	Compares the functions `f1` and `f2`.
	
	If `f1` or `f2` are null, the result is false.
	If `f1` or `f2` are not functions, the result is unspecified.
	
	Otherwise the result is true if `f1` and the `f2` are physically equal,
	false otherwise.
	
	If `f1` or `f2` are member method closures, the result is true if they
	are closures of the same method on the same object value, false otherwise.
	*/
	static compareMethods(f1, f2) {
		if (f1 == f2) {
			return true;
		};
		if (!Reflect.isFunction(f1) || !Reflect.isFunction(f2)) {
			return false;
		};
		if (f1.scope == f2.scope && f1.method == f2.method) {
			return f1.method != null;
		} else {
			return false;
		};
	}
	
	/**
	Tells if `v` is an object.
	
	The result is true if `v` is one of the following:
	
	- class instance
	- structure
	- `Class<T>`
	- `Enum<T>`
	
	Otherwise, including if `v` is null, the result is false.
	*/
	static isObject(v) {
		if (v == null) {
			return false;
		};
		var t = typeof(v);
		if (!(t == "string" || t == "object" && v.__enum__ == null)) {
			if (t == "function") {
				return (v.__name__ || v.__ename__) != null;
			} else {
				return false;
			};
		} else {
			return true;
		};
	}
	
	/**
	Tells if `v` is an enum value.
	
	The result is true if `v` is of type EnumValue, i.e. an enum
	constructor.
	
	Otherwise, including if `v` is null, the result is false.
	*/
	static isEnumValue(v) {
		if (v != null) {
			return v.__enum__ != null;
		} else {
			return false;
		};
	}
	
	/**
	Removes the field named `field` from structure `o`.
	
	This method is only guaranteed to work on anonymous structures.
	
	If `o` or `field` are null, the result is unspecified.
	*/
	static deleteField(o, field) {
		if (!Object.prototype.hasOwnProperty.call(o, field)) {
			return false;
		};
		delete(o[field]);
		return true;
	}
	
	/**
	Copies the fields of structure `o`.
	
	This is only guaranteed to work on anonymous structures.
	
	If `o` is null, the result is `null`.
	*/
	static copy(o) {
		if (o == null) {
			return null;
		};
		var o2 = {};
		var _g = 0;
		var _g1 = Reflect.fields(o);
		while (_g < _g1.length) {
			var f = _g1[_g];
			++_g;
			o2[f] = Reflect.field(o, f);
		};
		return o2;
	}
	
	/**
	Transform a function taking an array of arguments into a function that can
	be called with any number of arguments.
	*/
	static makeVarArgs(f) {
		return function () {
			var a = Array.prototype.slice.call(arguments);
			return f(a);
		};
	}
	static get __name__() {
		return "Reflect"
	}
	get __class__() {
		return Reflect
	}
}


//# sourceMappingURL=Reflect.js.map