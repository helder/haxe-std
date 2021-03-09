import {Register} from "../../genes/Register.js"

/**
String binary encoding supported by Haxe I/O
*/
export const Encoding = 
Register.global("$hxEnums")["haxe.io.Encoding"] = 
{
	__ename__: "haxe.io.Encoding",
	
	UTF8: {_hx_name: "UTF8", _hx_index: 0, __enum__: "haxe.io.Encoding"},
	/**
	Output the string the way the platform represent it in memory. This is the most efficient but is platform-specific
	*/
	RawNative: {_hx_name: "RawNative", _hx_index: 1, __enum__: "haxe.io.Encoding"}
}
Encoding.__constructs__ = ["UTF8", "RawNative"]
Encoding.__empty_constructs__ = [Encoding.UTF8, Encoding.RawNative]

//# sourceMappingURL=Encoding.js.map