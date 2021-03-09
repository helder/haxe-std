import {CallStack} from "../haxe/CallStack.js"
import {Register} from "../genes/Register.js"
import {Std} from "../Std.js"

export const HaxeError = Register.global("$hxClasses")["js._Boot.HaxeError"] = 
class HaxeError extends Register.inherits(Error) {
	new(val) {
		Error.call(this, );
		this.val = val;
		if (Error.captureStackTrace) {
			Error.captureStackTrace(this, HaxeError);
		};
	}
	static wrap(val) {
		if (((val) instanceof Error)) {
			return val;
		} else {
			return new HaxeError(val);
		};
	}
	static get __name__() {
		return "js._Boot.HaxeError"
	}
	static get __super__() {
		return Error
	}
	get __class__() {
		return HaxeError
	}
}


;Object.defineProperty(HaxeError.prototype, "message", {"get": function () {
	return String(this.val);
}})

export const Boot = Register.global("$hxClasses")["js.Boot"] = 
class Boot {
	static isClass(o) {
		return o.__name__;
	}
	static isInterface(o) {
		return o.__isInterface__;
	}
	static isEnum(e) {
		return e.__ename__;
	}
	static getClass(o) {
		if (o == null) {
			return null;
		} else if (((o) instanceof Array)) {
			return Array;
		} else {
			var cl = o.__class__;
			if (cl != null) {
				return cl;
			};
			var name = Boot.__nativeClassName(o);
			if (name != null) {
				return Boot.__resolveNativeClass(name);
			};
			return null;
		};
	}
	static __string_rec(o, s) {
		if (o == null) {
			return "null";
		};
		if (s.length >= 5) {
			return "<...>";
		};
		var t = typeof(o);
		if (t == "function" && (o.__name__ || o.__ename__)) {
			t = "object";
		};
		switch (t) {
			case "function":
				return "<function>";
				break
			case "object":
				if (o.__enum__) {
					var e = Register.global("$hxEnums")[o.__enum__];
					var n = e.__constructs__[o._hx_index];
					var con = e[n];
					if (con.__params__) {
						s = s + "\t";
						return n + "(" + ((function($this) {var $r0
							var _g = [];
							{
								var _g1 = 0;
								var _g2 = con.__params__;
								while (true) {
									if (!(_g1 < _g2.length)) {
										break;
									};
									var p = _g2[_g1];
									_g1 = _g1 + 1;
									_g.push(Boot.__string_rec(o[p], s));
								};
							};
							
							$r0 = _g
							return $r0})(this)).join(",") + ")";
					} else {
						return n;
					};
				};
				if (((o) instanceof Array)) {
					var str = "[";
					s += "\t";
					var _g3 = 0;
					var _g11 = o.length;
					while (_g3 < _g11) {
						var i = _g3++;
						str += ((i > 0) ? "," : "") + Boot.__string_rec(o[i], s);
					};
					str += "]";
					return str;
				};
				var tostr;
				try {
					tostr = o.toString;
				}catch (e1) {
					CallStack.lastException = e1;
					var e2 = (((e1) instanceof HaxeError)) ? e1.val : e1;
					return "???";
				};
				if (tostr != null && tostr != Object.toString && typeof(tostr) == "function") {
					var s2 = o.toString();
					if (s2 != "[object Object]") {
						return s2;
					};
				};
				var str1 = "{\n";
				s += "\t";
				var hasp = o.hasOwnProperty != null;
				var k = null;
				for( k in o ) {;
				if (hasp && !o.hasOwnProperty(k)) {
					continue;
				};
				if (k == "prototype" || k == "__class__" || k == "__super__" || k == "__interfaces__" || k == "__properties__") {
					continue;
				};
				if (str1.length != 2) {
					str1 += ", \n";
				};
				str1 += s + k + " : " + Boot.__string_rec(o[k], s);
				};
				s = s.substring(1);
				str1 += "\n" + s + "}";
				return str1;
				break
			case "string":
				return o;
				break
			default:
			return String(o);
			
		};
	}
	static __interfLoop(cc, cl) {
		if (cc == null) {
			return false;
		};
		if (cc == cl) {
			return true;
		};
		if (Object.prototype.hasOwnProperty.call(cc, "__interfaces__")) {
			var intf = cc.__interfaces__;
			var _g = 0;
			var _g1 = intf.length;
			while (_g < _g1) {
				var i = _g++;
				var i1 = intf[i];
				if (i1 == cl || Boot.__interfLoop(i1, cl)) {
					return true;
				};
			};
		};
		return Boot.__interfLoop(cc.__super__, cl);
	}
	static __instanceof(o, cl) {
		if (cl == null) {
			return false;
		};
		switch (cl) {
			case Array:
				return ((o) instanceof Array);
				break
			case "$hxCoreType__Bool":
				return typeof(o) == "boolean";
				break
			case "$hxCoreType__Dynamic":
				return o != null;
				break
			case "$hxCoreType__Float":
				return typeof(o) == "number";
				break
			case "$hxCoreType__Int":
				if (typeof(o) == "number") {
					return ((o | 0) === (o));
				} else {
					return false;
				};
				break
			case String:
				return typeof(o) == "string";
				break
			default:
			if (o != null) {
				if (typeof(cl) == "function") {
					if (Boot.__downcastCheck(o, cl)) {
						return true;
					};
				} else if (typeof(cl) == "object" && Boot.__isNativeObj(cl)) {
					if (((o) instanceof cl)) {
						return true;
					};
				};
			} else {
				return false;
			};
			if ((cl == "$hxCoreType__Class") ? o.__name__ != null : false) {
				return true;
			};
			if ((cl == "$hxCoreType__Enum") ? o.__ename__ != null : false) {
				return true;
			};
			return (o.__enum__ != null) ? Register.global("$hxEnums")[o.__enum__] == cl : false;
			
		};
	}
	static __downcastCheck(o, cl) {
		if (!((o) instanceof cl)) {
			if (cl.__isInterface__) {
				return Boot.__interfLoop(Boot.getClass(o), cl);
			} else {
				return false;
			};
		} else {
			return true;
		};
	}
	static __implements(o, iface) {
		return Boot.__interfLoop(Boot.getClass(o), iface);
	}
	static __cast(o, t) {
		if (o == null || Boot.__instanceof(o, t)) {
			return o;
		} else {
			throw new HaxeError("Cannot cast " + Std.string(o) + " to " + Std.string(t));
		};
	}
	static __nativeClassName(o) {
		var name = Boot.__toStr.call(o).slice(8, -1);
		if (name == "Object" || name == "Function" || name == "Math" || name == "JSON") {
			return null;
		};
		return name;
	}
	static __isNativeObj(o) {
		return Boot.__nativeClassName(o) != null;
	}
	static __resolveNativeClass(name) {
		return $global[name];
	}
	static get __name__() {
		return "js.Boot"
	}
	get __class__() {
		return Boot
	}
}


;Boot.__toStr = ({}).toString

//# sourceMappingURL=Boot.js.map