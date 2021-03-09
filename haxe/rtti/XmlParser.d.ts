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
	sort(l?: null | TypeTree[]): void
	process(x: Xml, platform: string): void
	newField(c: Classdef, f: ClassField): void
	processElement(x: Xml): TypeTree
}

//# sourceMappingURL=XmlParser.d.ts.map