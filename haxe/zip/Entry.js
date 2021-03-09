import {Register} from "../../genes/Register.js"

export const ExtraField = 
Register.global("$hxEnums")["haxe.zip.ExtraField"] = 
{
	__ename__: "haxe.zip.ExtraField",
	
	FUnknown: Object.assign((tag, bytes) => ({_hx_index: 0, __enum__: "haxe.zip.ExtraField", tag, bytes}), {_hx_name: "FUnknown", __params__: ["tag", "bytes"]}),
	FInfoZipUnicodePath: Object.assign((name, crc) => ({_hx_index: 1, __enum__: "haxe.zip.ExtraField", name, crc}), {_hx_name: "FInfoZipUnicodePath", __params__: ["name", "crc"]}),
	FUtf8: {_hx_name: "FUtf8", _hx_index: 2, __enum__: "haxe.zip.ExtraField"}
}
ExtraField.__constructs__ = [ExtraField.FUnknown, ExtraField.FInfoZipUnicodePath, ExtraField.FUtf8]
ExtraField.__empty_constructs__ = [ExtraField.FUtf8]

//# sourceMappingURL=Entry.js.map