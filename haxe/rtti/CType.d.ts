import {Map as Map__1} from "../../Map"

export type Path = string

export type Platforms = string[]

export type FunctionArgument = {name: string, opt: boolean, t: CType, value?: null | string}

export declare namespace CType {
	export type CUnknown = {_hx_index: 0, __enum__: "haxe.rtti.CType"}
	export const CUnknown: CUnknown
	export type CTypedef = {_hx_index: 3, name: string, params: CType[], __enum__: "haxe.rtti.CType"}
	export const CTypedef: (name: string, params: CType[]) => CType
	export type CFunction = {_hx_index: 4, args: FunctionArgument[], ret: CType, __enum__: "haxe.rtti.CType"}
	export const CFunction: (args: FunctionArgument[], ret: CType) => CType
	export type CEnum = {_hx_index: 1, name: string, params: CType[], __enum__: "haxe.rtti.CType"}
	export const CEnum: (name: string, params: CType[]) => CType
	export type CDynamic = {_hx_index: 6, t: null | CType, __enum__: "haxe.rtti.CType"}
	export const CDynamic: (t: null | CType) => CType
	export type CClass = {_hx_index: 2, name: string, params: CType[], __enum__: "haxe.rtti.CType"}
	export const CClass: (name: string, params: CType[]) => CType
	export type CAnonymous = {_hx_index: 5, fields: ClassField[], __enum__: "haxe.rtti.CType"}
	export const CAnonymous: (fields: ClassField[]) => CType
	export type CAbstract = {_hx_index: 7, name: string, params: CType[], __enum__: "haxe.rtti.CType"}
	export const CAbstract: (name: string, params: CType[]) => CType
}

/**
The runtime member types.
*/
export declare type CType = 
	| CType.CUnknown
	| CType.CTypedef
	| CType.CFunction
	| CType.CEnum
	| CType.CDynamic
	| CType.CClass
	| CType.CAnonymous
	| CType.CAbstract

export type PathParams = {params: CType[], path: string}

export type TypeParams = string[]

export declare namespace Rights {
	export type RNormal = {_hx_index: 0, __enum__: "haxe.rtti.Rights"}
	export const RNormal: RNormal
	export type RNo = {_hx_index: 1, __enum__: "haxe.rtti.Rights"}
	export const RNo: RNo
	export type RMethod = {_hx_index: 3, __enum__: "haxe.rtti.Rights"}
	export const RMethod: RMethod
	export type RInline = {_hx_index: 5, __enum__: "haxe.rtti.Rights"}
	export const RInline: RInline
	export type RDynamic = {_hx_index: 4, __enum__: "haxe.rtti.Rights"}
	export const RDynamic: RDynamic
	export type RCall = {_hx_index: 2, m: string, __enum__: "haxe.rtti.Rights"}
	export const RCall: (m: string) => Rights
}

/**
Represents the runtime rights of a type.
*/
export declare type Rights = 
	| Rights.RNormal
	| Rights.RNo
	| Rights.RMethod
	| Rights.RInline
	| Rights.RDynamic
	| Rights.RCall

export type MetaData = {name: string, params: string[]}[]

export type ClassField = {doc: null | string, expr: null | string, get: Rights, isFinal: boolean, isOverride: boolean, isPublic: boolean, line: null | number, meta: {name: string, params: string[]}[], name: string, overloads: null | ClassField[], params: string[], platforms: string[], set: Rights, type: CType}

export type TypeInfos = {doc: null | string, file: null | string, isPrivate: boolean, meta: {name: string, params: string[]}[], module: string, params: string[], path: string, platforms: string[]}

export type Classdef = {doc: null | string, fields: ClassField[], file: null | string, interfaces: PathParams[], isExtern: boolean, isFinal: boolean, isInterface: boolean, isPrivate: boolean, meta: {name: string, params: string[]}[], module: string, params: string[], path: string, platforms: string[], statics: ClassField[], superClass: null | PathParams, tdynamic: null | CType}

export type EnumField = {args: null | {name: string, opt: boolean, t: CType}[], doc: string, meta: {name: string, params: string[]}[], name: string, platforms: string[]}

export type Enumdef = {constructors: EnumField[], doc: null | string, file: null | string, isExtern: boolean, isPrivate: boolean, meta: {name: string, params: string[]}[], module: string, params: string[], path: string, platforms: string[]}

export type Typedef = {doc: null | string, file: null | string, isPrivate: boolean, meta: {name: string, params: string[]}[], module: string, params: string[], path: string, platforms: string[], type: CType, types: Map__1<string, CType>}

export type Abstractdef = {athis: CType, doc: null | string, file: null | string, from: {field: null | string, t: CType}[], impl: Classdef, isPrivate: boolean, meta: {name: string, params: string[]}[], module: string, params: string[], path: string, platforms: string[], to: {field: null | string, t: CType}[]}

export declare namespace TypeTree {
	export type TTypedecl = {_hx_index: 3, t: Typedef, __enum__: "haxe.rtti.TypeTree"}
	export const TTypedecl: (t: Typedef) => TypeTree
	export type TPackage = {_hx_index: 0, name: string, full: string, subs: TypeTree[], __enum__: "haxe.rtti.TypeTree"}
	export const TPackage: (name: string, full: string, subs: TypeTree[]) => TypeTree
	export type TEnumdecl = {_hx_index: 2, e: Enumdef, __enum__: "haxe.rtti.TypeTree"}
	export const TEnumdecl: (e: Enumdef) => TypeTree
	export type TClassdecl = {_hx_index: 1, c: Classdef, __enum__: "haxe.rtti.TypeTree"}
	export const TClassdecl: (c: Classdef) => TypeTree
	export type TAbstractdecl = {_hx_index: 4, a: Abstractdef, __enum__: "haxe.rtti.TypeTree"}
	export const TAbstractdecl: (a: Abstractdef) => TypeTree
}

/**
The tree types of the runtime type.
*/
export declare type TypeTree = 
	| TypeTree.TTypedecl
	| TypeTree.TPackage
	| TypeTree.TEnumdecl
	| TypeTree.TClassdecl
	| TypeTree.TAbstractdecl

export type TypeRoot = TypeTree[]

/**
Contains type and equality checks functionalities for RTTI.
*/
export declare class TypeApi {
	static typeInfos(t: TypeTree): TypeInfos
	
	/**
	Returns `true` if the given `CType` is a variable or `false` if it is a
	function.
	*/
	static isVar(t: CType): boolean
	protected static leq<T>(f: ((arg0: T, arg1: T) => boolean), l1: T[], l2: T[]): boolean
	
	/**
	Unlike `r1 == r2`, this function performs a deep equality check on
	the given `Rights` instances.
	
	If `r1` or `r2` are `null`, the result is unspecified.
	*/
	static rightsEq(r1: Rights, r2: Rights): boolean
	
	/**
	Unlike `t1 == t2`, this function performs a deep equality check on
	the given `CType` instances.
	
	If `t1` or `t2` are `null`, the result is unspecified.
	*/
	static typeEq(t1: CType, t2: CType): boolean
	
	/**
	Unlike `f1 == f2`, this function performs a deep equality check on
	the given `ClassField` instances.
	
	If `f1` or `f2` are `null`, the result is unspecified.
	*/
	static fieldEq(f1: ClassField, f2: ClassField): boolean
	
	/**
	Unlike `c1 == c2`, this function performs a deep equality check on
	the arguments of the enum constructors, if exists.
	
	If `c1` or `c2` are `null`, the result is unspecified.
	*/
	static constructorEq(c1: EnumField, c2: EnumField): boolean
}

/**
The `CTypeTools` class contains some extra functionalities for handling
`CType` instances.
*/
export declare class CTypeTools {
	
	/**
	Get the string representation of `CType`.
	*/
	static toString(t: CType): string
	protected static nameWithParams(name: string, params: CType[]): string
	protected static functionArgumentName(arg: FunctionArgument): string
	protected static classField(cf: ClassField): string
}

//# sourceMappingURL=CType.d.ts.map