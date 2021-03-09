import {XmlParser} from "./XmlParser.js"
import {Exception} from "../Exception.js"
import {Register} from "../../genes/Register.js"
import {Xml} from "../../Xml.js"
import {Type} from "../../Type.js"
import {Std} from "../../Std.js"
import {Reflect} from "../../Reflect.js"
import {Lambda} from "../../Lambda.js"

/**
Rtti is a helper class which supplements the `@:rtti` metadata.

@see <https://haxe.org/manual/cr-rtti.html>
*/
export const Rtti = Register.global("$hxClasses")["haxe.rtti.Rtti"] = 
class Rtti {
	
	/**
	Returns the `haxe.rtti.CType.Classdef` corresponding to class `c`.
	
	If `c` has no runtime type information, e.g. because no `@:rtti` was
	added, an exception of type `String` is thrown.
	
	If `c` is `null`, the result is unspecified.
	*/
	static getRtti(c) {
		let rtti = Reflect.field(c, "__rtti");
		if (rtti == null) {
			throw Exception.thrown("Class " + c.__name__ + " has no RTTI information, consider adding @:rtti");
		};
		let x = Xml.parse(rtti).firstElement();
		let infos = new XmlParser().processElement(x);
		if (infos._hx_index == 1) {
			let c = infos.c;
			return c;
		} else {
			let t = infos;
			throw Exception.thrown("Enum mismatch: expected TClassDecl but found " + Std.string(t));
		};
	}
	
	/**
	Tells if `c` has runtime type information.
	
	If `c` is `null`, the result is unspecified.
	*/
	static hasRtti(c) {
		return Lambda.has(Type.getClassFields(c), "__rtti");
	}
	static get __name__() {
		return "haxe.rtti.Rtti"
	}
	get __class__() {
		return Rtti
	}
}


//# sourceMappingURL=Rtti.js.map