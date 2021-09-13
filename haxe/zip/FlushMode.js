import {Register} from "../../genes/Register.js"

const $global = Register.$global

export const FlushMode = 
Register.global("$hxEnums")["haxe.zip.FlushMode"] = 
{
	__ename__: "haxe.zip.FlushMode",
	
	NO: {_hx_name: "NO", _hx_index: 0, __enum__: "haxe.zip.FlushMode"},
	SYNC: {_hx_name: "SYNC", _hx_index: 1, __enum__: "haxe.zip.FlushMode"},
	FULL: {_hx_name: "FULL", _hx_index: 2, __enum__: "haxe.zip.FlushMode"},
	FINISH: {_hx_name: "FINISH", _hx_index: 3, __enum__: "haxe.zip.FlushMode"},
	BLOCK: {_hx_name: "BLOCK", _hx_index: 4, __enum__: "haxe.zip.FlushMode"}
}
FlushMode.__constructs__ = [FlushMode.NO, FlushMode.SYNC, FlushMode.FULL, FlushMode.FINISH, FlushMode.BLOCK]
FlushMode.__empty_constructs__ = [FlushMode.NO, FlushMode.SYNC, FlushMode.FULL, FlushMode.FINISH, FlushMode.BLOCK]

//# sourceMappingURL=FlushMode.js.map