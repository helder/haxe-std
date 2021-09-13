import {ArrayIterator} from "./iterators/ArrayIterator.js"
import {List} from "./ds/List.js"
import {NativeStackTrace} from "./NativeStackTrace.js"
import {Exception} from "./Exception.js"
import {Register} from "../genes/Register.js"
import {StringBuf} from "../StringBuf.js"
import {Std} from "../Std.js"
import {Reflect as Reflect__1} from "../Reflect.js"
import {HxOverrides} from "../HxOverrides.js"
import {EReg} from "../EReg.js"

const $global = Register.$global

export const TemplateExpr = 
Register.global("$hxEnums")["haxe._Template.TemplateExpr"] = 
{
	__ename__: "haxe._Template.TemplateExpr",
	
	OpVar: Object.assign((v) => ({_hx_index: 0, __enum__: "haxe._Template.TemplateExpr", "v": v}), {_hx_name: "OpVar", __params__: ["v"]}),
	OpExpr: Object.assign((expr) => ({_hx_index: 1, __enum__: "haxe._Template.TemplateExpr", "expr": expr}), {_hx_name: "OpExpr", __params__: ["expr"]}),
	OpIf: Object.assign((expr, eif, eelse) => ({_hx_index: 2, __enum__: "haxe._Template.TemplateExpr", "expr": expr, "eif": eif, "eelse": eelse}), {_hx_name: "OpIf", __params__: ["expr", "eif", "eelse"]}),
	OpStr: Object.assign((str) => ({_hx_index: 3, __enum__: "haxe._Template.TemplateExpr", "str": str}), {_hx_name: "OpStr", __params__: ["str"]}),
	OpBlock: Object.assign((l) => ({_hx_index: 4, __enum__: "haxe._Template.TemplateExpr", "l": l}), {_hx_name: "OpBlock", __params__: ["l"]}),
	OpForeach: Object.assign((expr, loop) => ({_hx_index: 5, __enum__: "haxe._Template.TemplateExpr", "expr": expr, "loop": loop}), {_hx_name: "OpForeach", __params__: ["expr", "loop"]}),
	OpMacro: Object.assign((name, params) => ({_hx_index: 6, __enum__: "haxe._Template.TemplateExpr", "name": name, "params": params}), {_hx_name: "OpMacro", __params__: ["name", "params"]})
}
TemplateExpr.__constructs__ = [TemplateExpr.OpVar, TemplateExpr.OpExpr, TemplateExpr.OpIf, TemplateExpr.OpStr, TemplateExpr.OpBlock, TemplateExpr.OpForeach, TemplateExpr.OpMacro]
TemplateExpr.__empty_constructs__ = []

/**
`Template` provides a basic templating mechanism to replace values in a source
String, and to have some basic logic.

A complete documentation of the supported syntax is available at:
<https://haxe.org/manual/std-template.html>
*/
export const Template = Register.global("$hxClasses")["haxe.Template"] = 
class Template extends Register.inherits() {
	new(str) {
		var tokens = this.parseTokens(str);
		this.expr = this.parseBlock(tokens);
		if (!tokens.isEmpty()) {
			throw Exception.thrown("Unexpected '" + Std.string(tokens.first().s) + "'");
		};
	}
	
	/**
	Executes `this` `Template`, taking into account `context` for
	replacements and `macros` for callback functions.
	
	If `context` has a field `name`, its value replaces all occurrences of
	`::name::` in the `Template`. Otherwise `Template.globals` is checked instead,
	If `name` is not a field of that either, `::name::` is replaced with `null`.
	
	If `macros` has a field `name`, all occurrences of `$$name(args)` are
	replaced with the result of calling that field. The first argument is
	always the `resolve()` method, followed by the given arguments.
	If `macros` has no such field, the result is unspecified.
	
	If `context` is `null`, the result is unspecified. If `macros` is `null`,
	no macros are used.
	*/
	execute(context, macros) {
		this.macros = (macros == null) ? {} : macros;
		this.context = context;
		this.stack = new List();
		this.buf = new StringBuf();
		this.run(this.expr);
		return this.buf.b;
	}
	resolve(v) {
		if (v == "__current__") {
			return this.context;
		};
		if (Reflect__1.isObject(this.context)) {
			var value = Reflect__1.getProperty(this.context, v);
			if (value != null || Object.prototype.hasOwnProperty.call(this.context, v)) {
				return value;
			};
		};
		var _g_head = this.stack.h;
		while (_g_head != null) {
			var val = _g_head.item;
			_g_head = _g_head.next;
			var ctx = val;
			var value = Reflect__1.getProperty(ctx, v);
			if (value != null || Object.prototype.hasOwnProperty.call(ctx, v)) {
				return value;
			};
		};
		return Reflect__1.field(Template.globals, v);
	}
	parseTokens(data) {
		var tokens = new List();
		while (Template.splitter.match(data)) {
			var p = Template.splitter.matchedPos();
			if (p.pos > 0) {
				tokens.add({"p": HxOverrides.substr(data, 0, p.pos), "s": true, "l": null});
			};
			if (HxOverrides.cca(data, p.pos) == 58) {
				tokens.add({"p": HxOverrides.substr(data, p.pos + 2, p.len - 4), "s": false, "l": null});
				data = Template.splitter.matchedRight();
				continue;
			};
			var parp = p.pos + p.len;
			var npar = 1;
			var params = [];
			var part = "";
			while (true) {
				var c = HxOverrides.cca(data, parp);
				++parp;
				if (c == 40) {
					++npar;
				} else if (c == 41) {
					--npar;
					if (npar <= 0) {
						break;
					};
				} else if (c == null) {
					throw Exception.thrown("Unclosed macro parenthesis");
				};
				if (c == 44 && npar == 1) {
					params.push(part);
					part = "";
				} else {
					part += String.fromCodePoint(c);
				};
			};
			params.push(part);
			tokens.add({"p": Template.splitter.matched(2), "s": false, "l": params});
			data = HxOverrides.substr(data, parp, data.length - parp);
		};
		if (data.length > 0) {
			tokens.add({"p": data, "s": true, "l": null});
		};
		return tokens;
	}
	parseBlock(tokens) {
		var l = new List();
		while (true) {
			var t = tokens.first();
			if (t == null) {
				break;
			};
			if (!t.s && (t.p == "end" || t.p == "else" || HxOverrides.substr(t.p, 0, 7) == "elseif ")) {
				break;
			};
			l.add(this.parse(tokens));
		};
		if (l.length == 1) {
			return l.first();
		};
		return TemplateExpr.OpBlock(l);
	}
	parse(tokens) {
		var t = tokens.pop();
		var p = t.p;
		if (t.s) {
			return TemplateExpr.OpStr(p);
		};
		if (t.l != null) {
			var pe = new List();
			var _g = 0;
			var _g1 = t.l;
			while (_g < _g1.length) {
				var p1 = _g1[_g];
				++_g;
				pe.add(this.parseBlock(this.parseTokens(p1)));
			};
			return TemplateExpr.OpMacro(p, pe);
		};
		var kwdEnd = function (kwd) {
			var pos = -1;
			var length = kwd.length;
			if (HxOverrides.substr(p, 0, length) == kwd) {
				pos = length;
				var _g_offset = 0;
				var _g_s = HxOverrides.substr(p, length, null);
				while (_g_offset < _g_s.length) {
					var c = _g_s.charCodeAt(_g_offset++);
					if (c == 32) {
						++pos;
					} else {
						break;
					};
				};
			};
			return pos;
		};
		var pos = kwdEnd("if");
		if (pos > 0) {
			p = HxOverrides.substr(p, pos, p.length - pos);
			var e = this.parseExpr(p);
			var eif = this.parseBlock(tokens);
			var t = tokens.first();
			var eelse;
			if (t == null) {
				throw Exception.thrown("Unclosed 'if'");
			};
			if (t.p == "end") {
				tokens.pop();
				eelse = null;
			} else if (t.p == "else") {
				tokens.pop();
				eelse = this.parseBlock(tokens);
				t = tokens.pop();
				if (t == null || t.p != "end") {
					throw Exception.thrown("Unclosed 'else'");
				};
			} else {
				t.p = HxOverrides.substr(t.p, 4, t.p.length - 4);
				eelse = this.parse(tokens);
			};
			return TemplateExpr.OpIf(e, eif, eelse);
		};
		var pos = kwdEnd("foreach");
		if (pos >= 0) {
			p = HxOverrides.substr(p, pos, p.length - pos);
			var e = this.parseExpr(p);
			var efor = this.parseBlock(tokens);
			var t = tokens.pop();
			if (t == null || t.p != "end") {
				throw Exception.thrown("Unclosed 'foreach'");
			};
			return TemplateExpr.OpForeach(e, efor);
		};
		if (Template.expr_splitter.match(p)) {
			return TemplateExpr.OpExpr(this.parseExpr(p));
		};
		return TemplateExpr.OpVar(p);
	}
	parseExpr(data) {
		var l = new List();
		var expr = data;
		while (Template.expr_splitter.match(data)) {
			var p = Template.expr_splitter.matchedPos();
			var k = p.pos + p.len;
			if (p.pos != 0) {
				l.add({"p": HxOverrides.substr(data, 0, p.pos), "s": true});
			};
			var p1 = Template.expr_splitter.matched(0);
			l.add({"p": p1, "s": p1.indexOf("\"") >= 0});
			data = Template.expr_splitter.matchedRight();
		};
		if (data.length != 0) {
			var _g_offset = 0;
			var _g_s = data;
			while (_g_offset < _g_s.length) {
				var _g1_key = _g_offset;
				var _g1_value = _g_s.charCodeAt(_g_offset++);
				var i = _g1_key;
				var c = _g1_value;
				if (c != 32) {
					l.add({"p": HxOverrides.substr(data, i, null), "s": true});
					break;
				};
			};
		};
		var e;
		try {
			e = this.makeExpr(l);
			if (!l.isEmpty()) {
				throw Exception.thrown(l.first().p);
			};
		}catch (_g) {
			NativeStackTrace.lastError = _g;
			var _g1 = Exception.caught(_g).unwrap();
			if (typeof(_g1) == "string") {
				var s = _g1;
				throw Exception.thrown("Unexpected '" + s + "' in " + expr);
			} else {
				throw _g;
			};
		};
		return function () {
			try {
				return e();
			}catch (_g) {
				NativeStackTrace.lastError = _g;
				var exc = Exception.caught(_g).unwrap();
				throw Exception.thrown("Error : " + Std.string(exc) + " in " + expr);
			};
		};
	}
	makeConst(v) {
		Template.expr_trim.match(v);
		v = Template.expr_trim.matched(1);
		if (HxOverrides.cca(v, 0) == 34) {
			var str = HxOverrides.substr(v, 1, v.length - 2);
			return function () {
				return str;
			};
		};
		if (Template.expr_int.match(v)) {
			var i = Std.parseInt(v);
			return function () {
				return i;
			};
		};
		if (Template.expr_float.match(v)) {
			var f = parseFloat(v);
			return function () {
				return f;
			};
		};
		var me = this;
		return function () {
			return me.resolve(v);
		};
	}
	makePath(e, l) {
		var p = l.first();
		if (p == null || p.p != ".") {
			return e;
		};
		l.pop();
		var field = l.pop();
		if (field == null || !field.s) {
			throw Exception.thrown(field.p);
		};
		var f = field.p;
		Template.expr_trim.match(f);
		f = Template.expr_trim.matched(1);
		return this.makePath(function () {
			return Reflect__1.field(e(), f);
		}, l);
	}
	makeExpr(l) {
		return this.makePath(this.makeExpr2(l), l);
	}
	skipSpaces(l) {
		var p = l.first();
		while (p != null) {
			var _g_offset = 0;
			var _g_s = p.p;
			while (_g_offset < _g_s.length) {
				var c = _g_s.charCodeAt(_g_offset++);
				if (c != 32) {
					return;
				};
			};
			l.pop();
			p = l.first();
		};
	}
	makeExpr2(l) {
		this.skipSpaces(l);
		var p = l.pop();
		this.skipSpaces(l);
		if (p == null) {
			throw Exception.thrown("<eof>");
		};
		if (p.s) {
			return this.makeConst(p.p);
		};
		switch (p.p) {
			case "!":
				var e = this.makeExpr(l);
				return function () {
					var v = e();
					if (v != null) {
						return v == false;
					} else {
						return true;
					};
				};
				break
			case "(":
				this.skipSpaces(l);
				var e1 = this.makeExpr(l);
				this.skipSpaces(l);
				var p1 = l.pop();
				if (p1 == null || p1.s) {
					throw Exception.thrown(p1);
				};
				if (p1.p == ")") {
					return e1;
				};
				this.skipSpaces(l);
				var e2 = this.makeExpr(l);
				this.skipSpaces(l);
				var p2 = l.pop();
				this.skipSpaces(l);
				if (p2 == null || p2.p != ")") {
					throw Exception.thrown(p2);
				};
				switch (p1.p) {
					case "!=":
						return function () {
							return e1() != e2();
						};
						break
					case "&&":
						return function () {
							return e1() && e2();
						};
						break
					case "*":
						return function () {
							return e1() * e2();
						};
						break
					case "+":
						return function () {
							return e1() + e2();
						};
						break
					case "-":
						return function () {
							return e1() - e2();
						};
						break
					case "/":
						return function () {
							return e1() / e2();
						};
						break
					case "<":
						return function () {
							return e1() < e2();
						};
						break
					case "<=":
						return function () {
							return e1() <= e2();
						};
						break
					case "==":
						return function () {
							return e1() == e2();
						};
						break
					case ">":
						return function () {
							return e1() > e2();
						};
						break
					case ">=":
						return function () {
							return e1() >= e2();
						};
						break
					case "||":
						return function () {
							return e1() || e2();
						};
						break
					default:
					throw Exception.thrown("Unknown operation " + p1.p);
					
				};
				break
			case "-":
				var e3 = this.makeExpr(l);
				return function () {
					return -e3();
				};
				break
			
		};
		throw Exception.thrown(p.p);
	}
	run(e) {
		switch (e._hx_index) {
			case 0:
				var v = e.v;
				var _this = this.buf;
				var x = Std.string(this.resolve(v));
				_this.b += Std.string(x);
				break
			case 1:
				var e1 = e.expr;
				var _this = this.buf;
				var x = Std.string(e1());
				_this.b += Std.string(x);
				break
			case 2:
				var e1 = e.expr;
				var eif = e.eif;
				var eelse = e.eelse;
				var v = e1();
				if (v == null || v == false) {
					if (eelse != null) {
						this.run(eelse);
					};
				} else {
					this.run(eif);
				};
				break
			case 3:
				var str = e.str;
				this.buf.b += (str == null) ? "null" : "" + str;
				break
			case 4:
				var l = e.l;
				var _g_head = l.h;
				while (_g_head != null) {
					var val = _g_head.item;
					_g_head = _g_head.next;
					var e1 = val;
					this.run(e1);
				};
				break
			case 5:
				var e1 = e.expr;
				var loop = e.loop;
				var v = e1();
				try {
					var x = Register.iter(v);
					if (x.hasNext == null) {
						throw Exception.thrown(null);
					};
					v = x;
				}catch (_g) {
					NativeStackTrace.lastError = _g;
					try {
						if (v.hasNext == null) {
							throw Exception.thrown(null);
						};
					}catch (_g1) {
						throw Exception.thrown("Cannot iter on " + Std.string(v));
					};
				};
				this.stack.push(this.context);
				var v1 = v;
				var ctx = v1;
				while (ctx.hasNext()) {
					var ctx1 = ctx.next();
					this.context = ctx1;
					this.run(loop);
				};
				this.context = this.stack.pop();
				break
			case 6:
				var m = e.name;
				var params = e.params;
				var v = Reflect__1.field(this.macros, m);
				var pl = new Array();
				var old = this.buf;
				pl.push(Register.bind(this, this.resolve));
				var _g_head = params.h;
				while (_g_head != null) {
					var val = _g_head.item;
					_g_head = _g_head.next;
					var p = val;
					if (p._hx_index == 0) {
						var v1 = p.v;
						pl.push(this.resolve(v1));
					} else {
						this.buf = new StringBuf();
						this.run(p);
						pl.push(this.buf.b);
					};
				};
				this.buf = old;
				try {
					var _this = this.buf;
					var x = Std.string(v.apply(this.macros, pl));
					_this.b += Std.string(x);
				}catch (_g) {
					NativeStackTrace.lastError = _g;
					var e = Exception.caught(_g).unwrap();
					var plstr;
					try {
						plstr = pl.join(",");
					}catch (_g1) {
						plstr = "???";
					};
					var msg = "Macro call " + m + "(" + plstr + ") failed (" + Std.string(e) + ")";
					throw Exception.thrown(msg);
				};
				break
			
		};
	}
	static get __name__() {
		return "haxe.Template"
	}
	get __class__() {
		return Template
	}
}


Template.splitter = new EReg("(::[A-Za-z0-9_ ()&|!+=/><*.\"-]+::|\\$\\$([A-Za-z0-9_-]+)\\()", "")
Template.expr_splitter = new EReg("(\\(|\\)|[ \r\n\t]*\"[^\"]*\"[ \r\n\t]*|[!+=/><*.&|-]+)", "")
Template.expr_trim = new EReg("^[ ]*([^ ]+)[ ]*$", "")
Template.expr_int = new EReg("^[0-9]+$", "")
Template.expr_float = new EReg("^([+-]?)(?=\\d|,\\d)\\d*(,\\d*)?([Ee]([+-]?\\d+))?$", "")
Template.globals = {}
Template.hxKeepArrayIterator = new ArrayIterator([])
//# sourceMappingURL=Template.js.map