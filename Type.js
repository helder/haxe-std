import {Boot} from "./js/Boot"
import {NativeStackTrace} from "./haxe/NativeStackTrace"
import {Exception} from "./haxe/Exception"
import {Register} from "./genes/Register"
import {Reflect} from "./Reflect"
import {HxOverrides} from "./HxOverrides"

export const ValueType = 
Register.global("$hxEnums")["ValueType"] = 
{
	__ename__: "ValueType",
	
	TNull: {_hx_name: "TNull", _hx_index: 0, __enum__: "ValueType"},
	TInt: {_hx_name: "TInt", _hx_index: 1, __enum__: "ValueType"},
	TFloat: {_hx_name: "TFloat", _hx_index: 2, __enum__: "ValueType"},
	TBool: {_hx_name: "TBool", _hx_index: 3, __enum__: "ValueType"},
	TObject: {_hx_name: "TObject", _hx_index: 4, __enum__: "ValueType"},
	TFunction: {_hx_name: "TFunction", _hx_index: 5, __enum__: "ValueType"},
	TClass: Object.assign((c) => ({_hx_index: 6, __enum__: "ValueType", c}), {_hx_name: "TClass", __params__: ["c"]}),
	TEnum: Object.assign((e) => ({_hx_index: 7, __enum__: "ValueType", e}), {_hx_name: "TEnum", __params__: ["e"]}),
	TUnknown: {_hx_name: "TUnknown", _hx_index: 8, __enum__: "ValueType"}
}
ValueType.__constructs__ = ["TNull", "TInt", "TFloat", "TBool", "TObject", "TFunction", "TClass", "TEnum", "TUnknown"]
ValueType.__empty_constructs__ = [ValueType.TNull, ValueType.TInt, ValueType.TFloat, ValueType.TBool, ValueType.TObject, ValueType.TFunction, ValueType.TUnknown]

/**
The Haxe Reflection API allows retrieval of type information at runtime.

This class complements the more lightweight Reflect class, with a focus on
class and enum instances.

@see https://haxe.org/manual/types.html
@see https://haxe.org/manual/std-reflection.html
*/
export const Type = Register.global("$hxClasses")["Type"] = 
class Type {
	
	/**
	Returns the class of `o`, if `o` is a class instance.
	
	If `o` is null or of a different type, null is returned.
	
	In general, type parameter information cannot be obtained at runtime.
	*/
	static getClass(o) {
		return Boot.getClass(o);
	}
	
	/**
	Returns the enum of enum instance `o`.
	
	An enum instance is the result of using an enum constructor. Given an
	`enum Color { Red; }`, `getEnum(Red)` returns `Enum<Color>`.
	
	If `o` is null, null is returned.
	
	In general, type parameter information cannot be obtained at runtime.
	*/
	static getEnum(o) {
		if (o == null) {
			return null;
		};
		return Register.global("$hxEnums")[o.__enum__];
	}
	
	/**
	Returns the super-class of class `c`.
	
	If `c` has no super class, null is returned.
	
	If `c` is null, the result is unspecified.
	
	In general, type parameter information cannot be obtained at runtime.
	*/
	static getSuperClass(c) {
		return c.__super__;
	}
	
	/**
	Returns the name of class `c`, including its path.
	
	If `c` is inside a package, the package structure is returned dot-
	separated, with another dot separating the class name:
	`pack1.pack2.(...).packN.ClassName`
	If `c` is a sub-type of a Haxe module, that module is not part of the
	package structure.
	
	If `c` has no package, the class name is returned.
	
	If `c` is null, the result is unspecified.
	
	The class name does not include any type parameters.
	*/
	static getClassName(c) {
		return c.__name__;
	}
	
	/**
	Returns the name of enum `e`, including its path.
	
	If `e` is inside a package, the package structure is returned dot-
	separated, with another dot separating the enum name:
	`pack1.pack2.(...).packN.EnumName`
	If `e` is a sub-type of a Haxe module, that module is not part of the
	package structure.
	
	If `e` has no package, the enum name is returned.
	
	If `e` is null, the result is unspecified.
	
	The enum name does not include any type parameters.
	*/
	static getEnumName(e) {
		return e.__ename__;
	}
	
	/**
	Resolves a class by name.
	
	If `name` is the path of an existing class, that class is returned.
	
	Otherwise null is returned.
	
	If `name` is null or the path to a different type, the result is
	unspecified.
	
	The class name must not include any type parameters.
	*/
	static resolveClass(name) {
		return Register.global("$hxClasses")[name];
	}
	
	/**
	Resolves an enum by name.
	
	If `name` is the path of an existing enum, that enum is returned.
	
	Otherwise null is returned.
	
	If `name` is null the result is unspecified.
	
	If `name` is the path to a different type, null is returned.
	
	The enum name must not include any type parameters.
	*/
	static resolveEnum(name) {
		return Register.global("$hxEnums")[name];
	}
	
	/**
	Creates an instance of class `cl`, using `args` as arguments to the
	class constructor.
	
	This function guarantees that the class constructor is called.
	
	Default values of constructors arguments are not guaranteed to be
	taken into account.
	
	If `cl` or `args` are null, or if the number of elements in `args` does
	not match the expected number of constructor arguments, or if any
	argument has an invalid type,  or if `cl` has no own constructor, the
	result is unspecified.
	
	In particular, default values of constructor arguments are not
	guaranteed to be taken into account.
	*/
	static createInstance(cl, args) {
		let ctor = Function.prototype.bind.apply(cl, [null].concat(args));
		return new (ctor);
	}
	
	/**
	Creates an instance of class `cl`.
	
	This function guarantees that the class constructor is not called.
	
	If `cl` is null, the result is unspecified.
	*/
	static createEmptyInstance(cl) {
		return Object.create(cl.prototype);
	}
	
	/**
	Creates an instance of enum `e` by calling its constructor `constr` with
	arguments `params`.
	
	If `e` or `constr` is null, or if enum `e` has no constructor named
	`constr`, or if the number of elements in `params` does not match the
	expected number of constructor arguments, or if any argument has an
	invalid type, the result is unspecified.
	*/
	static createEnum(e, constr, params = null) {
		let f = Reflect.field(e, constr);
		if (f == null) {
			throw Exception.thrown("No such constructor " + constr);
		};
		if (Reflect.isFunction(f)) {
			if (params == null) {
				throw Exception.thrown("Constructor " + constr + " need parameters");
			};
			return f.apply(e, params);
		};
		if (params != null && params.length != 0) {
			throw Exception.thrown("Constructor " + constr + " does not need parameters");
		};
		return f;
	}
	
	/**
	Creates an instance of enum `e` by calling its constructor number
	`index` with arguments `params`.
	
	The constructor indices are preserved from Haxe syntax, so the first
	declared is index 0, the next index 1 etc.
	
	If `e` or `constr` is null, or if enum `e` has no constructor named
	`constr`, or if the number of elements in `params` does not match the
	expected number of constructor arguments, or if any argument has an
	invalid type, the result is unspecified.
	*/
	static createEnumIndex(e, index, params = null) {
		let c = e.__constructs__[index];
		if (c == null) {
			throw Exception.thrown(index + " is not a valid enum constructor index");
		};
		return Type.createEnum(e, c, params);
	}
	
	/**
	Returns a list of the instance fields of class `c`, including
	inherited fields.
	
	This only includes fields which are known at compile-time. In
	particular, using `getInstanceFields(getClass(obj))` will not include
	any fields which were added to `obj` at runtime.
	
	The order of the fields in the returned Array is unspecified.
	
	If `c` is null, the result is unspecified.
	*/
	static getInstanceFields(c) {
		let result = [];
		while (c != null) {
			let _g = 0;
			let _g1 = Object.getOwnPropertyNames(c.prototype);
			while (_g < _g1.length) {
				let name = _g1[_g];
				++_g;
				switch (name) {
					case "__class__":case "__properties__":case "constructor":
						break
					default:
					if (result.indexOf(name) == -1) {
						result.push(name);
					};
					
				};
			};
			c = c.__super__;
		};
		return result;
	}
	
	/**
	Returns a list of static fields of class `c`.
	
	This does not include static fields of parent classes.
	
	The order of the fields in the returned Array is unspecified.
	
	If `c` is null, the result is unspecified.
	*/
	static getClassFields(c) {
		let a = Object.getOwnPropertyNames(c);
		HxOverrides.remove(a, "__id__");
		HxOverrides.remove(a, "hx__closures__");
		HxOverrides.remove(a, "__name__");
		HxOverrides.remove(a, "__interfaces__");
		HxOverrides.remove(a, "__isInterface__");
		HxOverrides.remove(a, "__properties__");
		HxOverrides.remove(a, "__instanceFields__");
		HxOverrides.remove(a, "__super__");
		HxOverrides.remove(a, "__meta__");
		HxOverrides.remove(a, "prototype");
		HxOverrides.remove(a, "name");
		HxOverrides.remove(a, "length");
		return a;
	}
	
	/**
	Returns a list of the names of all constructors of enum `e`.
	
	The order of the constructor names in the returned Array is preserved
	from the original syntax.
	
	If `e` is null, the result is unspecified.
	*/
	static getEnumConstructs(e) {
		return e.__constructs__.slice();
	}
	
	/**
	Returns the runtime type of value `v`.
	
	The result corresponds to the type `v` has at runtime, which may vary
	per platform. Assumptions regarding this should be minimized to avoid
	surprises.
	*/
	static typeof(v) {
		switch (typeof(v)) {
			case "boolean":
				return ValueType.TBool;
				break
			case "function":
				if (v.__name__ || v.__ename__) {
					return ValueType.TObject;
				};
				return ValueType.TFunction;
				break
			case "number":
				if (Math.ceil(v) == v % 2147483648.0) {
					return ValueType.TInt;
				};
				return ValueType.TFloat;
				break
			case "object":
				if (v == null) {
					return ValueType.TNull;
				};
				let e = v.__enum__;
				if (e != null) {
					return ValueType.TEnum(Register.global("$hxEnums")[e]);
				};
				let c = Boot.getClass(v);
				if (c != null) {
					return ValueType.TClass(c);
				};
				return ValueType.TObject;
				break
			case "string":
				return ValueType.TClass(String);
				break
			case "undefined":
				return ValueType.TNull;
				break
			default:
			return ValueType.TUnknown;
			
		};
	}
	
	/**
	Recursively compares two enum instances `a` and `b` by value.
	
	Unlike `a == b`, this function performs a deep equality check on the
	arguments of the constructors, if exists.
	
	If `a` or `b` are null, the result is unspecified.
	*/
	static enumEq(a, b) {
		if (a == b) {
			return true;
		};
		try {
			let e = a.__enum__;
			if (e == null || e != b.__enum__) {
				return false;
			};
			if (a._hx_index != b._hx_index) {
				return false;
			};
			let enm = Register.global("$hxEnums")[e];
			let ctorName = enm.__constructs__[a._hx_index];
			let params = enm[ctorName].__params__;
			let _g = 0;
			while (_g < params.length) {
				let f = params[_g];
				++_g;
				if (!Type.enumEq(a[f], b[f])) {
					return false;
				};
			};
		}catch (_g) {
			NativeStackTrace.lastError = _g;
			return false;
		};
		return true;
	}
	
	/**
	Returns the constructor name of enum instance `e`.
	
	The result String does not contain any constructor arguments.
	
	If `e` is null, the result is unspecified.
	*/
	static enumConstructor(e) {
		return Register.global("$hxEnums")[e.__enum__].__constructs__[e._hx_index];
	}
	
	/**
	Returns a list of the constructor arguments of enum instance `e`.
	
	If `e` has no arguments, the result is [].
	
	Otherwise the result are the values that were used as arguments to `e`,
	in the order of their declaration.
	
	If `e` is null, the result is unspecified.
	*/
	static enumParameters(e) {
		let enm = Register.global("$hxEnums")[e.__enum__];
		let ctorName = enm.__constructs__[e._hx_index];
		let params = enm[ctorName].__params__;
		if (params != null) {
			let _g = [];
			let _g1 = 0;
			while (_g1 < params.length) {
				let p = params[_g1];
				++_g1;
				_g.push(e[p]);
			};
			return _g;
		} else {
			return [];
		};
	}
	
	/**
	Returns the index of enum instance `e`.
	
	This corresponds to the original syntactic position of `e`. The index of
	the first declared constructor is 0, the next one is 1 etc.
	
	If `e` is null, the result is unspecified.
	*/
	static enumIndex(e) {
		return e._hx_index;
	}
	
	/**
	Returns a list of all constructors of enum `e` that require no
	arguments.
	
	This may return the empty Array `[]` if all constructors of `e` require
	arguments.
	
	Otherwise an instance of `e` constructed through each of its non-
	argument constructors is returned, in the order of the constructor
	declaration.
	
	If `e` is null, the result is unspecified.
	*/
	static allEnums(e) {
		return e.__empty_constructs__.slice();
	}
	static get __name__() {
		return "Type"
	}
	get __class__() {
		return Type
	}
}


//# sourceMappingURL=Type.js.map