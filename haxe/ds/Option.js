import {Register} from "../../genes/Register.js"

/**
An Option is a wrapper type which can either have a value (Some) or not a
value (None).

@see https://haxe.org/manual/std-Option.html
*/
export const Option = 
Register.global("$hxEnums")["haxe.ds.Option"] = 
{
	__ename__: "haxe.ds.Option",
	
	Some: Object.assign((v) => ({_hx_index: 0, __enum__: "haxe.ds.Option", v}), {_hx_name: "Some", __params__: ["v"]}),
	None: {_hx_name: "None", _hx_index: 1, __enum__: "haxe.ds.Option"}
}
Option.__constructs__ = ["Some", "None"]
Option.__empty_constructs__ = [Option.None]

//# sourceMappingURL=Option.js.map