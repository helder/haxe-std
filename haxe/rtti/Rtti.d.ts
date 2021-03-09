import {Classdef} from "./CType"

/**
Rtti is a helper class which supplements the `@:rtti` metadata.

@see <https://haxe.org/manual/cr-rtti.html>
*/
export declare class Rtti {
	
	/**
	Returns the `haxe.rtti.CType.Classdef` corresponding to class `c`.
	
	If `c` has no runtime type information, e.g. because no `@:rtti` was
	added, an exception of type `String` is thrown.
	
	If `c` is `null`, the result is unspecified.
	*/
	static getRtti<T>(c: any): Classdef
	
	/**
	Tells if `c` has runtime type information.
	
	If `c` is `null`, the result is unspecified.
	*/
	static hasRtti<T>(c: any): boolean
}

//# sourceMappingURL=Rtti.d.ts.map