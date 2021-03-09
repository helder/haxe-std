
/**
The Reflect API is a way to manipulate values dynamically through an
abstract interface in an untyped manner. Use with care.

@see https://haxe.org/manual/std-reflection.html
*/
export declare class Reflect {
	
	/**
	Tells if structure `o` has a field named `field`.
	
	This is only guaranteed to work for anonymous structures. Refer to
	`Type.getInstanceFields` for a function supporting class instances.
	
	If `o` or `field` are null, the result is unspecified.
	*/
	static hasField(o: any, field: string): boolean
	
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
	static field(o: any, field: string): any
	
	/**
	Sets the field named `field` of object `o` to value `value`.
	
	If `o` has no field named `field`, this function is only guaranteed to
	work for anonymous structures.
	
	If `o` or `field` are null, the result is unspecified.
	
	(As3) If used on a property field, the setter will be invoked. It is
	not possible to set the value directly.
	*/
	static setField(o: any, field: string, value: any): void
	
	/**
	Returns the value of the field named `field` on object `o`, taking
	property getter functions into account.
	
	If the field is not a property, this function behaves like
	`Reflect.field`, but might be slower.
	
	If `o` or `field` are null, the result is unspecified.
	*/
	static getProperty(o: any, field: string): any
	
	/**
	Sets the field named `field` of object `o` to value `value`, taking
	property setter functions into account.
	
	If the field is not a property, this function behaves like
	`Reflect.setField`, but might be slower.
	
	If `field` is null, the result is unspecified.
	*/
	static setProperty(o: any, field: string, value: any): void
	
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
	static callMethod(o: any, func: any, args: any[]): any
	
	/**
	Returns the fields of structure `o`.
	
	This method is only guaranteed to work on anonymous structures. Refer to
	`Type.getInstanceFields` for a function supporting class instances.
	
	If `o` is null, the result is unspecified.
	*/
	static fields(o: any): string[]
	
	/**
	Returns true if `f` is a function, false otherwise.
	
	If `f` is null, the result is false.
	*/
	static isFunction(f: any): boolean
	
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
	static compare<T>(a: T, b: T): number
	
	/**
	Compares the functions `f1` and `f2`.
	
	If `f1` or `f2` are null, the result is false.
	If `f1` or `f2` are not functions, the result is unspecified.
	
	Otherwise the result is true if `f1` and the `f2` are physically equal,
	false otherwise.
	
	If `f1` or `f2` are member method closures, the result is true if they
	are closures of the same method on the same object value, false otherwise.
	*/
	static compareMethods(f1: any, f2: any): boolean
	
	/**
	Tells if `v` is an object.
	
	The result is true if `v` is one of the following:
	
	- class instance
	- structure
	- `Class<T>`
	- `Enum<T>`
	
	Otherwise, including if `v` is null, the result is false.
	*/
	static isObject(v: any): boolean
	
	/**
	Tells if `v` is an enum value.
	
	The result is true if `v` is of type EnumValue, i.e. an enum
	constructor.
	
	Otherwise, including if `v` is null, the result is false.
	*/
	static isEnumValue(v: any): boolean
	
	/**
	Removes the field named `field` from structure `o`.
	
	This method is only guaranteed to work on anonymous structures.
	
	If `o` or `field` are null, the result is unspecified.
	*/
	static deleteField(o: any, field: string): boolean
	
	/**
	Copies the fields of structure `o`.
	
	This is only guaranteed to work on anonymous structures.
	
	If `o` is null, the result is `null`.
	*/
	static copy<T>(o: null | T): null | T
	
	/**
	Transform a function taking an array of arguments into a function that can
	be called with any number of arguments.
	*/
	static makeVarArgs(f: ((arg0: any[]) => any)): any
}

//# sourceMappingURL=Reflect.d.ts.map