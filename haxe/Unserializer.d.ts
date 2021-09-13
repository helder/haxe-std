
export type TypeResolver = {resolveClass: (name: string) => any, resolveEnum: (name: string) => any}

export declare class DefaultResolver {
	constructor()
	resolveClass(name: string): any
	resolveEnum(name: string): any
}

/**
The `Unserializer` class is the complement to the `Serializer` class. It parses
a serialization `String` and creates objects from the contained data.

This class can be used in two ways:

- create a `new Unserializer()` instance with a given serialization
String, then call its `unserialize()` method until all values are
extracted
- call `Unserializer.run()`  to unserialize a single value from a given
String

The specification of the serialization format can be found here:
<https://haxe.org/manual/serialization/format>
*/
export declare class Unserializer {
	constructor(buf: string)
	protected buf: string
	protected pos: number
	protected length: number
	protected cache: any[]
	protected scache: string[]
	protected resolver: TypeResolver
	
	/**
	Sets the type resolver of `this` Unserializer instance to `r`.
	
	If `r` is `null`, a special resolver is used which returns `null` for all
	input values.
	
	See `DEFAULT_RESOLVER` for more information on type resolvers.
	*/
	setResolver(r: TypeResolver): void
	
	/**
	Gets the type resolver of `this` Unserializer instance.
	
	See `DEFAULT_RESOLVER` for more information on type resolvers.
	*/
	getResolver(): TypeResolver
	protected get(p: number): number
	protected readDigits(): number
	protected readFloat(): number
	protected unserializeObject(o: {}): void
	protected unserializeEnum<T>(edecl: any, tag: string): T
	
	/**
	Unserializes the next part of `this` Unserializer instance and returns
	the according value.
	
	This function may call `this.resolver.resolveClass` to determine a
	Class from a String, and `this.resolver.resolveEnum` to determine an
	Enum from a String.
	
	If `this` Unserializer instance contains no more or invalid data, an
	exception is thrown.
	
	This operation may fail on structurally valid data if a type cannot be
	resolved or if a field cannot be set. This can happen when unserializing
	Strings that were serialized on a different Haxe target, in which the
	serialization side has to make sure not to include platform-specific
	data.
	
	Classes are created from `Type.createEmptyInstance`, which means their
	constructors are not called.
	*/
	unserialize(): any
	
	/**
	This value can be set to use custom type resolvers.
	
	A type resolver finds a `Class` or `Enum` instance from a given `String`.
	By default, the Haxe `Type` Api is used.
	
	A type resolver must provide two methods:
	
	1. `resolveClass(name:String):Class<Dynamic>` is called to determine a
	`Class` from a class name
	2. `resolveEnum(name:String):Enum<Dynamic>` is called to determine an
	`Enum` from an enum name
	
	This value is applied when a new `Unserializer` instance is created.
	Changing it afterwards has no effect on previously created instances.
	*/
	static DEFAULT_RESOLVER: TypeResolver
	protected static BASE64: string
	protected static CODES: number[]
	protected static initCodes(): number[]
	
	/**
	Unserializes `v` and returns the according value.
	
	This is a convenience function for creating a new instance of
	Unserializer with `v` as buffer and calling its `unserialize()` method
	once.
	*/
	static run(v: string): any
	protected static fastLength(s: string): number
	protected static fastCharCodeAt(s: string, pos: number): number
	protected static fastCharAt(s: string, pos: number): string
	protected static fastSubstr(s: string, pos: number, length: number): string
}

export declare class NullResolver {
	protected constructor()
	resolveClass(name: string): any
	resolveEnum(name: string): any
	static instance: NullResolver
	protected static get_instance(): NullResolver
}

//# sourceMappingURL=Unserializer.d.ts.map