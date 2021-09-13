import {Bytes} from "./io/Bytes.js"
import {Base64} from "./crypto/Base64.js"
import {Register} from "../genes/Register.js"

const $global = Register.$global

/**
Resource can be used to access resources that were added through the
`--resource file@name` command line parameter.

Depending on their type they can be obtained as `String` through
`getString(name)`, or as binary data through `getBytes(name)`.

A list of all available resource names can be obtained from `listNames()`.
*/
export const Resource = Register.global("$hxClasses")["haxe.Resource"] = 
class Resource {
	
	/**
	Lists all available resource names. The resource name is the name part
	of the `--resource file@name` command line parameter.
	*/
	static listNames() {
		var _g = [];
		var _g1 = 0;
		var _g2 = Resource.content;
		while (_g1 < _g2.length) {
			var x = _g2[_g1];
			++_g1;
			_g.push(x.name);
		};
		return _g;
	}
	
	/**
	Retrieves the resource identified by `name` as a `String`.
	
	If `name` does not match any resource name, `null` is returned.
	*/
	static getString(name) {
		var _g = 0;
		var _g1 = Resource.content;
		while (_g < _g1.length) {
			var x = _g1[_g];
			++_g;
			if (x.name == name) {
				if (x.str != null) {
					return x.str;
				};
				var b = Base64.decode(x.data);
				return b.toString();
			};
		};
		return null;
	}
	
	/**
	Retrieves the resource identified by `name` as an instance of
	haxe.io.Bytes.
	
	If `name` does not match any resource name, `null` is returned.
	*/
	static getBytes(name) {
		var _g = 0;
		var _g1 = Resource.content;
		while (_g < _g1.length) {
			var x = _g1[_g];
			++_g;
			if (x.name == name) {
				if (x.str != null) {
					return Bytes.ofString(x.str);
				};
				return Base64.decode(x.data);
			};
		};
		return null;
	}
	static get __name__() {
		return "haxe.Resource"
	}
	get __class__() {
		return Resource
	}
}


;Resource.content = []

//# sourceMappingURL=Resource.js.map