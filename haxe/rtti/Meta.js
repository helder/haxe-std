import {HaxeError} from "../../js/Boot.js"
import {Register} from "../../genes/Register.js"

/**
An API to access classes and enums metadata at runtime.

@see <https://haxe.org/manual/cr-rtti.html>
*/
export const Meta = Register.global("$hxClasses")["haxe.rtti.Meta"] = 
class Meta {
	
	/**
	Returns the metadata that were declared for the given type (class or enum)
	*/
	static getType(t) {
		var meta = Meta.getMeta(t);
		if (meta == null || meta.obj == null) {
			return {};
		} else {
			return meta.obj;
		};
	}
	static isInterface(t) {
		throw new HaxeError("Something went wrong");
	}
	static getMeta(t) {
		return t.__meta__;
	}
	
	/**
	Returns the metadata that were declared for the given class static fields
	*/
	static getStatics(t) {
		var meta = Meta.getMeta(t);
		if (meta == null || meta.statics == null) {
			return {};
		} else {
			return meta.statics;
		};
	}
	
	/**
	Returns the metadata that were declared for the given class fields or enum constructors
	*/
	static getFields(t) {
		var meta = Meta.getMeta(t);
		if (meta == null || meta.fields == null) {
			return {};
		} else {
			return meta.fields;
		};
	}
	static get __name__() {
		return "haxe.rtti.Meta"
	}
	get __class__() {
		return Meta
	}
}


//# sourceMappingURL=Meta.js.map