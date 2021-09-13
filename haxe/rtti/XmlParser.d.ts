import {TypeTree, ClassField, Classdef, Enumdef, Typedef, Abstractdef, Rights, PathParams, EnumField, CType} from "./CType"
import {Xml} from "../../Xml"

/**
XmlParser processes the runtime type information (RTTI) which
is stored as a XML string in a static field `__rtti`.

@see <https://haxe.org/manual/cr-rtti.html>
*/
export declare class XmlParser {
	constructor()
	root: TypeTree[]
	protected curplatform: string
	sort(l?: null | TypeTree[]): void
	protected sortFields(a: ClassField[]): void
	process(x: Xml, platform: string): void
	protected mergeRights(f1: ClassField, f2: ClassField): boolean
	protected mergeDoc(f1: ClassField, f2: ClassField): boolean
	protected mergeFields(f: ClassField, f2: ClassField): boolean
	newField(c: Classdef, f: ClassField): void
	protected mergeClasses(c: Classdef, c2: Classdef): boolean
	protected mergeEnums(e: Enumdef, e2: Enumdef): boolean
	protected mergeTypedefs(t: Typedef, t2: Typedef): boolean
	protected mergeAbstracts(a: Abstractdef, a2: Abstractdef): boolean
	protected merge(t: TypeTree): void
	protected mkPath(p: string): string
	protected mkTypeParams(p: string): string[]
	protected mkRights(r: string): Rights
	protected xerror(c: Xml): any
	protected xroot(x: Xml): void
	processElement(x: Xml): TypeTree
	protected xmeta(x: Xml): {name: string, params: string[]}[]
	protected xoverloads(x: Xml): ClassField[]
	protected xpath(x: Xml): PathParams
	protected xclass(x: Xml): Classdef
	protected xclassfield(x: Xml, defPublic?: null | boolean): ClassField
	protected xenum(x: Xml): Enumdef
	protected xenumfield(x: Xml): EnumField
	protected xabstract(x: Xml): Abstractdef
	protected xtypedef(x: Xml): Typedef
	protected xtype(x: Xml): CType
	protected xtypeparams(x: Xml): CType[]
	protected defplat(): string[]
}

//# sourceMappingURL=XmlParser.d.ts.map