import {Exception} from "../Exception.js"
import {Register} from "../../genes/Register.js"

const $global = Register.$global

/**
The runtime member types.
*/
export const CType = 
Register.global("$hxEnums")["haxe.rtti.CType"] = 
{
	__ename__: "haxe.rtti.CType",
	
	CUnknown: {_hx_name: "CUnknown", _hx_index: 0, __enum__: "haxe.rtti.CType"},
	CEnum: Object.assign((name, params) => ({_hx_index: 1, __enum__: "haxe.rtti.CType", "name": name, "params": params}), {_hx_name: "CEnum", __params__: ["name", "params"]}),
	CClass: Object.assign((name, params) => ({_hx_index: 2, __enum__: "haxe.rtti.CType", "name": name, "params": params}), {_hx_name: "CClass", __params__: ["name", "params"]}),
	CTypedef: Object.assign((name, params) => ({_hx_index: 3, __enum__: "haxe.rtti.CType", "name": name, "params": params}), {_hx_name: "CTypedef", __params__: ["name", "params"]}),
	CFunction: Object.assign((args, ret) => ({_hx_index: 4, __enum__: "haxe.rtti.CType", "args": args, "ret": ret}), {_hx_name: "CFunction", __params__: ["args", "ret"]}),
	CAnonymous: Object.assign((fields) => ({_hx_index: 5, __enum__: "haxe.rtti.CType", "fields": fields}), {_hx_name: "CAnonymous", __params__: ["fields"]}),
	CDynamic: Object.assign((t) => ({_hx_index: 6, __enum__: "haxe.rtti.CType", "t": t}), {_hx_name: "CDynamic", __params__: ["t"]}),
	CAbstract: Object.assign((name, params) => ({_hx_index: 7, __enum__: "haxe.rtti.CType", "name": name, "params": params}), {_hx_name: "CAbstract", __params__: ["name", "params"]})
}
CType.__constructs__ = [CType.CUnknown, CType.CEnum, CType.CClass, CType.CTypedef, CType.CFunction, CType.CAnonymous, CType.CDynamic, CType.CAbstract]
CType.__empty_constructs__ = [CType.CUnknown]

/**
Represents the runtime rights of a type.
*/
export const Rights = 
Register.global("$hxEnums")["haxe.rtti.Rights"] = 
{
	__ename__: "haxe.rtti.Rights",
	
	RNormal: {_hx_name: "RNormal", _hx_index: 0, __enum__: "haxe.rtti.Rights"},
	RNo: {_hx_name: "RNo", _hx_index: 1, __enum__: "haxe.rtti.Rights"},
	RCall: Object.assign((m) => ({_hx_index: 2, __enum__: "haxe.rtti.Rights", "m": m}), {_hx_name: "RCall", __params__: ["m"]}),
	RMethod: {_hx_name: "RMethod", _hx_index: 3, __enum__: "haxe.rtti.Rights"},
	RDynamic: {_hx_name: "RDynamic", _hx_index: 4, __enum__: "haxe.rtti.Rights"},
	RInline: {_hx_name: "RInline", _hx_index: 5, __enum__: "haxe.rtti.Rights"}
}
Rights.__constructs__ = [Rights.RNormal, Rights.RNo, Rights.RCall, Rights.RMethod, Rights.RDynamic, Rights.RInline]
Rights.__empty_constructs__ = [Rights.RNormal, Rights.RNo, Rights.RMethod, Rights.RDynamic, Rights.RInline]

/**
The tree types of the runtime type.
*/
export const TypeTree = 
Register.global("$hxEnums")["haxe.rtti.TypeTree"] = 
{
	__ename__: "haxe.rtti.TypeTree",
	
	TPackage: Object.assign((name, full, subs) => ({_hx_index: 0, __enum__: "haxe.rtti.TypeTree", "name": name, "full": full, "subs": subs}), {_hx_name: "TPackage", __params__: ["name", "full", "subs"]}),
	TClassdecl: Object.assign((c) => ({_hx_index: 1, __enum__: "haxe.rtti.TypeTree", "c": c}), {_hx_name: "TClassdecl", __params__: ["c"]}),
	TEnumdecl: Object.assign((e) => ({_hx_index: 2, __enum__: "haxe.rtti.TypeTree", "e": e}), {_hx_name: "TEnumdecl", __params__: ["e"]}),
	TTypedecl: Object.assign((t) => ({_hx_index: 3, __enum__: "haxe.rtti.TypeTree", "t": t}), {_hx_name: "TTypedecl", __params__: ["t"]}),
	TAbstractdecl: Object.assign((a) => ({_hx_index: 4, __enum__: "haxe.rtti.TypeTree", "a": a}), {_hx_name: "TAbstractdecl", __params__: ["a"]})
}
TypeTree.__constructs__ = [TypeTree.TPackage, TypeTree.TClassdecl, TypeTree.TEnumdecl, TypeTree.TTypedecl, TypeTree.TAbstractdecl]
TypeTree.__empty_constructs__ = []

/**
Contains type and equality checks functionalities for RTTI.
*/
export const TypeApi = Register.global("$hxClasses")["haxe.rtti.TypeApi"] = 
class TypeApi {
	static typeInfos(t) {
		var inf;
		switch (t._hx_index) {
			case 0:
				var _g = t.name;
				var _g = t.full;
				var _g = t.subs;
				throw Exception.thrown("Unexpected Package");
				break
			case 1:
				var c = t.c;
				inf = c;
				break
			case 2:
				var e = t.e;
				inf = e;
				break
			case 3:
				var t1 = t.t;
				inf = t1;
				break
			case 4:
				var a = t.a;
				inf = a;
				break
			
		};
		return inf;
	}
	
	/**
	Returns `true` if the given `CType` is a variable or `false` if it is a
	function.
	*/
	static isVar(t) {
		if (t._hx_index == 4) {
			var _g = t.args;
			var _g = t.ret;
			return false;
		} else {
			return true;
		};
	}
	static leq(f, l1, l2) {
		var it_current = 0;
		var it_array = l2;
		var _g = 0;
		while (_g < l1.length) {
			var e1 = l1[_g];
			++_g;
			if (it_current >= it_array.length) {
				return false;
			};
			var e2 = it_array[it_current++];
			if (!f(e1, e2)) {
				return false;
			};
		};
		if (it_current < it_array.length) {
			return false;
		};
		return true;
	}
	
	/**
	Unlike `r1 == r2`, this function performs a deep equality check on
	the given `Rights` instances.
	
	If `r1` or `r2` are `null`, the result is unspecified.
	*/
	static rightsEq(r1, r2) {
		if (r1 == r2) {
			return true;
		};
		if (r1._hx_index == 2) {
			var m1 = r1.m;
			if (r2._hx_index == 2) {
				var m2 = r2.m;
				return m1 == m2;
			};
		};
		return false;
	}
	
	/**
	Unlike `t1 == t2`, this function performs a deep equality check on
	the given `CType` instances.
	
	If `t1` or `t2` are `null`, the result is unspecified.
	*/
	static typeEq(t1, t2) {
		switch (t1._hx_index) {
			case 0:
				return t2 == CType.CUnknown;
				break
			case 1:
				var name = t1.name;
				var params = t1.params;
				if (t2._hx_index == 1) {
					var name2 = t2.name;
					var params2 = t2.params;
					if (name == name2) {
						return TypeApi.leq(TypeApi.typeEq, params, params2);
					} else {
						return false;
					};
				};
				break
			case 2:
				var name = t1.name;
				var params = t1.params;
				if (t2._hx_index == 2) {
					var name2 = t2.name;
					var params2 = t2.params;
					if (name == name2) {
						return TypeApi.leq(TypeApi.typeEq, params, params2);
					} else {
						return false;
					};
				};
				break
			case 3:
				var name = t1.name;
				var params = t1.params;
				if (t2._hx_index == 3) {
					var name2 = t2.name;
					var params2 = t2.params;
					if (name == name2) {
						return TypeApi.leq(TypeApi.typeEq, params, params2);
					} else {
						return false;
					};
				};
				break
			case 4:
				var args = t1.args;
				var ret = t1.ret;
				if (t2._hx_index == 4) {
					var args2 = t2.args;
					var ret2 = t2.ret;
					if (TypeApi.leq(function (a, b) {
						if (a.name == b.name && a.opt == b.opt) {
							return TypeApi.typeEq(a.t, b.t);
						} else {
							return false;
						};
					}, args, args2)) {
						return TypeApi.typeEq(ret, ret2);
					} else {
						return false;
					};
				};
				break
			case 5:
				var fields = t1.fields;
				if (t2._hx_index == 5) {
					var fields2 = t2.fields;
					return TypeApi.leq(function (a, b) {
						return TypeApi.fieldEq(a, b);
					}, fields, fields2);
				};
				break
			case 6:
				var t = t1.t;
				if (t2._hx_index == 6) {
					var t21 = t2.t;
					if (t == null != (t21 == null)) {
						return false;
					};
					if (t != null) {
						return TypeApi.typeEq(t, t21);
					} else {
						return true;
					};
				};
				break
			case 7:
				var name = t1.name;
				var params = t1.params;
				if (t2._hx_index == 7) {
					var name2 = t2.name;
					var params2 = t2.params;
					if (name == name2) {
						return TypeApi.leq(TypeApi.typeEq, params, params2);
					} else {
						return false;
					};
				};
				break
			
		};
		return false;
	}
	
	/**
	Unlike `f1 == f2`, this function performs a deep equality check on
	the given `ClassField` instances.
	
	If `f1` or `f2` are `null`, the result is unspecified.
	*/
	static fieldEq(f1, f2) {
		if (f1.name != f2.name) {
			return false;
		};
		if (!TypeApi.typeEq(f1.type, f2.type)) {
			return false;
		};
		if (f1.isPublic != f2.isPublic) {
			return false;
		};
		if (f1.doc != f2.doc) {
			return false;
		};
		if (!TypeApi.rightsEq(f1.get, f2.get)) {
			return false;
		};
		if (!TypeApi.rightsEq(f1.set, f2.set)) {
			return false;
		};
		if (f1.params == null != (f2.params == null)) {
			return false;
		};
		if (f1.params != null && f1.params.join(":") != f2.params.join(":")) {
			return false;
		};
		return true;
	}
	
	/**
	Unlike `c1 == c2`, this function performs a deep equality check on
	the arguments of the enum constructors, if exists.
	
	If `c1` or `c2` are `null`, the result is unspecified.
	*/
	static constructorEq(c1, c2) {
		if (c1.name != c2.name) {
			return false;
		};
		if (c1.doc != c2.doc) {
			return false;
		};
		if (c1.args == null != (c2.args == null)) {
			return false;
		};
		if (c1.args != null && !TypeApi.leq(function (a, b) {
			if (a.name == b.name && a.opt == b.opt) {
				return TypeApi.typeEq(a.t, b.t);
			} else {
				return false;
			};
		}, c1.args, c2.args)) {
			return false;
		};
		return true;
	}
	static get __name__() {
		return "haxe.rtti.TypeApi"
	}
	get __class__() {
		return TypeApi
	}
}


/**
The `CTypeTools` class contains some extra functionalities for handling
`CType` instances.
*/
export const CTypeTools = Register.global("$hxClasses")["haxe.rtti.CTypeTools"] = 
class CTypeTools {
	
	/**
	Get the string representation of `CType`.
	*/
	static toString(t) {
		switch (t._hx_index) {
			case 0:
				return "unknown";
				break
			case 1:
				var name = t.name;
				var params = t.params;
				return CTypeTools.nameWithParams(name, params);
				break
			case 2:
				var name = t.name;
				var params = t.params;
				return CTypeTools.nameWithParams(name, params);
				break
			case 3:
				var name = t.name;
				var params = t.params;
				return CTypeTools.nameWithParams(name, params);
				break
			case 4:
				var args = t.args;
				var ret = t.ret;
				if (args.length == 0) {
					return "Void -> " + CTypeTools.toString(ret);
				} else {
					var f = CTypeTools.functionArgumentName;
					var result = new Array(args.length);
					var _g = 0;
					var _g1 = args.length;
					while (_g < _g1) {
						var i = _g++;
						result[i] = f(args[i]);
					};
					return result.join(" -> ") + " -> " + CTypeTools.toString(ret);
				};
				break
			case 5:
				var fields = t.fields;
				var f = CTypeTools.classField;
				var result = new Array(fields.length);
				var _g = 0;
				var _g1 = fields.length;
				while (_g < _g1) {
					var i = _g++;
					result[i] = f(fields[i]);
				};
				return "{ " + result.join(", ") + "}";
				break
			case 6:
				var d = t.t;
				if (d == null) {
					return "Dynamic";
				} else {
					return "Dynamic<" + CTypeTools.toString(d) + ">";
				};
				break
			case 7:
				var name = t.name;
				var params = t.params;
				return CTypeTools.nameWithParams(name, params);
				break
			
		};
	}
	static nameWithParams(name, params) {
		if (params.length == 0) {
			return name;
		};
		var tmp = name + "<";
		var f = CTypeTools.toString;
		var result = new Array(params.length);
		var _g = 0;
		var _g1 = params.length;
		while (_g < _g1) {
			var i = _g++;
			result[i] = f(params[i]);
		};
		return tmp + result.join(", ") + ">";
	}
	static functionArgumentName(arg) {
		return ((arg.opt) ? "?" : "") + ((arg.name == "") ? "" : arg.name + ":") + CTypeTools.toString(arg.t) + ((arg.value == null) ? "" : " = " + arg.value);
	}
	static classField(cf) {
		return cf.name + ":" + CTypeTools.toString(cf.type);
	}
	static get __name__() {
		return "haxe.rtti.CTypeTools"
	}
	get __class__() {
		return CTypeTools
	}
}


//# sourceMappingURL=CType.js.map