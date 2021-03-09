import {Register} from "../../genes/Register"

/**
Either represents values which are either of type `L` (Left) or type `R`
(Right).
*/
export const Either = 
Register.global("$hxEnums")["haxe.ds.Either"] = 
{
	__ename__: "haxe.ds.Either",
	
	Left: Object.assign((v) => ({_hx_index: 0, __enum__: "haxe.ds.Either", v}), {_hx_name: "Left", __params__: ["v"]}),
	Right: Object.assign((v) => ({_hx_index: 1, __enum__: "haxe.ds.Either", v}), {_hx_name: "Right", __params__: ["v"]})
}
Either.__constructs__ = [Either.Left, Either.Right]
Either.__empty_constructs__ = []

//# sourceMappingURL=Either.js.map