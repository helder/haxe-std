import {StringMap} from "./ds/StringMap"
import {StringBuf} from "../StringBuf"

/**
The Serializer class can be used to encode values and objects into a `String`,
from which the `Unserializer` class can recreate the original representation.

This class can be used in two ways:

- create a `new Serializer()` instance, call its `serialize()` method with
any argument and finally retrieve the String representation from
`toString()`
- call `Serializer.run()` to obtain the serialized representation of a
single argument

Serialization is guaranteed to work for all haxe-defined classes, but may
or may not work for instances of external/native classes.

The specification of the serialization format can be found here:
<https://haxe.org/manual/std-serialization-format.html>
*/
export declare class Serializer {
	constructor()
	
	/**
	The individual cache setting for `this` Serializer instance.
	
	See `USE_CACHE` for a complete description.
	*/
	useCache: boolean
	
	/**
	The individual enum index setting for `this` Serializer instance.
	
	See `USE_ENUM_INDEX` for a complete description.
	*/
	useEnumIndex: boolean
	
	/**
	Return the String representation of `this` Serializer.
	
	The exact format specification can be found here:
	https://haxe.org/manual/serialization/format
	*/
	toString(): string
	
	/**
	Serializes `v`.
	
	All haxe-defined values and objects with the exception of functions can
	be serialized. Serialization of external/native objects is not
	guaranteed to work.
	
	The values of `this.useCache` and `this.useEnumIndex` may affect
	serialization output.
	*/
	serialize(v: any): void
	serializeException(e: any): void
	
	/**
	If the values you are serializing can contain circular references or
	objects repetitions, you should set `USE_CACHE` to true to prevent
	infinite loops.
	
	This may also reduce the size of serialization Strings at the expense of
	performance.
	
	This value can be changed for individual instances of `Serializer` by
	setting their `useCache` field.
	*/
	static USE_CACHE: boolean
	
	/**
	Use constructor indexes for enums instead of names.
	
	This may reduce the size of serialization Strings, but makes them less
	suited for long-term storage: If constructors are removed or added from
	the enum, the indices may no longer match.
	
	This value can be changed for individual instances of `Serializer` by
	setting their `useEnumIndex` field.
	*/
	static USE_ENUM_INDEX: boolean
	
	/**
	Serializes `v` and returns the String representation.
	
	This is a convenience function for creating a new instance of
	Serializer, serialize `v` into it and obtain the result through a call
	to `toString()`.
	*/
	static run(v: any): string
}

//# sourceMappingURL=Serializer.d.ts.map