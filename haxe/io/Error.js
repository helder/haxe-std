import {Register} from "../../genes/Register"

/**
The possible IO errors that can occur
*/
export const Error = 
Register.global("$hxEnums")["haxe.io.Error"] = 
{
	__ename__: "haxe.io.Error",
	
	/**
	The IO is set into nonblocking mode and some data cannot be read or written
	*/
	Blocked: {_hx_name: "Blocked", _hx_index: 0, __enum__: "haxe.io.Error"},
	/**
	An integer value is outside its allowed range
	*/
	Overflow: {_hx_name: "Overflow", _hx_index: 1, __enum__: "haxe.io.Error"},
	/**
	An operation on Bytes is outside of its valid range
	*/
	OutsideBounds: {_hx_name: "OutsideBounds", _hx_index: 2, __enum__: "haxe.io.Error"},
	/**
	Other errors
	*/
	Custom: Object.assign((e) => ({_hx_index: 3, __enum__: "haxe.io.Error", e}), {_hx_name: "Custom", __params__: ["e"]})
}
Error.__constructs__ = ["Blocked", "Overflow", "OutsideBounds", "Custom"]
Error.__empty_constructs__ = [Error.Blocked, Error.Overflow, Error.OutsideBounds]

//# sourceMappingURL=Error.js.map