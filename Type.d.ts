
export declare namespace ValueType {
	export type TUnknown = {_hx_index: 8, __enum__: "ValueType"}
	export const TUnknown: TUnknown
	export type TObject = {_hx_index: 4, __enum__: "ValueType"}
	export const TObject: TObject
	export type TNull = {_hx_index: 0, __enum__: "ValueType"}
	export const TNull: TNull
	export type TInt = {_hx_index: 1, __enum__: "ValueType"}
	export const TInt: TInt
	export type TFunction = {_hx_index: 5, __enum__: "ValueType"}
	export const TFunction: TFunction
	export type TFloat = {_hx_index: 2, __enum__: "ValueType"}
	export const TFloat: TFloat
	export type TEnum = {_hx_index: 7, e: any, __enum__: "ValueType"}
	export const TEnum: (e: any) => ValueType
	export type TClass = {_hx_index: 6, c: any, __enum__: "ValueType"}
	export const TClass: (c: any) => ValueType
	export type TBool = {_hx_index: 3, __enum__: "ValueType"}
	export const TBool: TBool
}

export declare type ValueType = 
	| ValueType.TUnknown
	| ValueType.TObject
	| ValueType.TNull
	| ValueType.TInt
	| ValueType.TFunction
	| ValueType.TFloat
	| ValueType.TEnum
	| ValueType.TClass
	| ValueType.TBool

/**
The Haxe Reflection API allows retrieval of type information at runtime.

This class complements the more lightweight Reflect class, with a focus on
class and enum instances.

@see https://haxe.org/manual/types.html
@see https://haxe.org/manual/std-reflection.html
*/
export declare class Type {
	
	/**
	Returns the class of `o`, if `o` is a class instance.
	
	If `o` is null or of a different type, null is returned.
	
	In general, type parameter information cannot be obtained at runtime.
	*/
	static getClass<T>(o: T): any
	
	/**
	Returns the enum of enum instance `o`.
	
	An enum instance is the result of using an enum constructor. Given an
	`enum Color { Red; }`, `getEnum(Red)` returns `Enum<Color>`.
	
	If `o` is null, null is returned.
	
	In general, type parameter information cannot be obtained at runtime.
	*/
	static getEnum(o: any): any
	
	/**
	Returns the super-class of class `c`.
	
	If `c` has no super class, null is returned.
	
	If `c` is null, the result is unspecified.
	
	In general, type parameter information cannot be obtained at runtime.
	*/
	static getSuperClass(c: any): any
	
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
	static getClassName(c: any): string
	
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
	static getEnumName(e: any): string
	
	/**
	Resolves a class by name.
	
	If `name` is the path of an existing class, that class is returned.
	
	Otherwise null is returned.
	
	If `name` is null or the path to a different type, the result is
	unspecified.
	
	The class name must not include any type parameters.
	*/
	static resolveClass(name: string): any
	
	/**
	Resolves an enum by name.
	
	If `name` is the path of an existing enum, that enum is returned.
	
	Otherwise null is returned.
	
	If `name` is null the result is unspecified.
	
	If `name` is the path to a different type, null is returned.
	
	The enum name must not include any type parameters.
	*/
	static resolveEnum(name: string): any
	
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
	static createInstance<T>(cl: any, args: any[]): T
	
	/**
	Creates an instance of class `cl`.
	
	This function guarantees that the class constructor is not called.
	
	If `cl` is null, the result is unspecified.
	*/
	static createEmptyInstance<T>(cl: any): T
	
	/**
	Creates an instance of enum `e` by calling its constructor `constr` with
	arguments `params`.
	
	If `e` or `constr` is null, or if enum `e` has no constructor named
	`constr`, or if the number of elements in `params` does not match the
	expected number of constructor arguments, or if any argument has an
	invalid type, the result is unspecified.
	*/
	static createEnum<T>(e: any, constr: string, params?: null | any[]): T
	
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
	static createEnumIndex<T>(e: any, index: number, params?: null | any[]): T
	
	/**
	Returns a list of the instance fields of class `c`, including
	inherited fields.
	
	This only includes fields which are known at compile-time. In
	particular, using `getInstanceFields(getClass(obj))` will not include
	any fields which were added to `obj` at runtime.
	
	The order of the fields in the returned Array is unspecified.
	
	If `c` is null, the result is unspecified.
	*/
	static getInstanceFields(c: any): string[]
	
	/**
	Returns a list of static fields of class `c`.
	
	This does not include static fields of parent classes.
	
	The order of the fields in the returned Array is unspecified.
	
	If `c` is null, the result is unspecified.
	*/
	static getClassFields(c: any): string[]
	
	/**
	Returns a list of the names of all constructors of enum `e`.
	
	The order of the constructor names in the returned Array is preserved
	from the original syntax.
	
	If `e` is null, the result is unspecified.
	*/
	static getEnumConstructs(e: any): string[]
	
	/**
	Returns the runtime type of value `v`.
	
	The result corresponds to the type `v` has at runtime, which may vary
	per platform. Assumptions regarding this should be minimized to avoid
	surprises.
	*/
	static typeof(v: any): ValueType
	
	/**
	Recursively compares two enum instances `a` and `b` by value.
	
	Unlike `a == b`, this function performs a deep equality check on the
	arguments of the constructors, if exists.
	
	If `a` or `b` are null, the result is unspecified.
	*/
	static enumEq<T extends any>(a: T, b: T): boolean
	
	/**
	Returns the constructor name of enum instance `e`.
	
	The result String does not contain any constructor arguments.
	
	If `e` is null, the result is unspecified.
	*/
	static enumConstructor(e: any): string
	
	/**
	Returns a list of the constructor arguments of enum instance `e`.
	
	If `e` has no arguments, the result is [].
	
	Otherwise the result are the values that were used as arguments to `e`,
	in the order of their declaration.
	
	If `e` is null, the result is unspecified.
	*/
	static enumParameters(e: any): any[]
	
	/**
	Returns the index of enum instance `e`.
	
	This corresponds to the original syntactic position of `e`. The index of
	the first declared constructor is 0, the next one is 1 etc.
	
	If `e` is null, the result is unspecified.
	*/
	static enumIndex(e: any): number
	
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
	static allEnums<T>(e: any): T[]
}

//# sourceMappingURL=Type.d.ts.map