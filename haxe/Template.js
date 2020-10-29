import {HaxeError} from "../js/Boot"
import {List} from "./ds/List"
import {CallStack} from "./CallStack"
import {Register} from "../genes/Register"
import {StringBuf} from "../StringBuf"
import {Std} from "../Std"
import {Reflect} from "../Reflect"
import {HxOverrides} from "../HxOverrides"
import {EReg} from "../EReg"

export const TemplateExpr = 
Register.global("$hxEnums")["haxe._Template.TemplateExpr"] = 
{
	__ename__: "haxe._Template.TemplateExpr",
	
	OpVar: Object.assign((v) => ({_hx_index: 0, __enum__: "haxe._Template.TemplateExpr", v}), {_hx_name: "OpVar", __params__: ["v"]}),
	OpExpr: Object.assign((expr) => ({_hx_index: 1, __enum__: "haxe._Template.TemplateExpr", expr}), {_hx_name: "OpExpr", __params__: ["expr"]}),
	OpIf: Object.assign((expr, eif, eelse) => ({_hx_index: 2, __enum__: "haxe._Template.TemplateExpr", expr, eif, eelse}), {_hx_name: "OpIf", __params__: ["expr", "eif", "eelse"]}),
	OpStr: Object.assign((str) => ({_hx_index: 3, __enum__: "haxe._Template.TemplateExpr", str}), {_hx_name: "OpStr", __params__: ["str"]}),
	OpBlock: Object.assign((l) => ({_hx_index: 4, __enum__: "haxe._Template.TemplateExpr", l}), {_hx_name: "OpBlock", __params__: ["l"]}),
	OpForeach: Object.assign((expr, loop) => ({_hx_index: 5, __enum__: "haxe._Template.TemplateExpr", expr, loop}), {_hx_name: "OpForeach", __params__: ["expr", "loop"]}),
	OpMacro: Object.assign((name, params) => ({_hx_index: 6, __enum__: "haxe._Template.TemplateExpr", name, params}), {_hx_name: "OpMacro", __params__: ["name", "params"]})
}
TemplateExpr.__constructs__ = ["OpVar", "OpExpr", "OpIf", "OpStr", "OpBlock", "OpForeach", "OpMacro"]
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
			throw new HaxeError("Unexpected '" + Std.string(tokens.first().s) + "'");
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
	execute(context, macros = null) {
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
		var value = Reflect.getProperty(this.context, v);
		if (value != null || Object.prototype.hasOwnProperty.call(this.context, v)) {
			return value;
		};
		var _g_head = this.stack.h;
		while (_g_head != null) {
			var val = _g_head.item;
			_g_head = _g_head.next;
			var ctx = val;
			value = Reflect.getProperty(ctx, v);
			if (value != null || Object.prototype.hasOwnProperty.call(ctx, v)) {
				return value;
			};
		};
		return Reflect.field(Template.globals, v);
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
					throw new HaxeError("Unclosed macro parenthesis");
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
		var pos1 = kwdEnd("if");
		if (pos1 > 0) {
			p = HxOverrides.substr(p, pos1, p.length - pos1);
			var e = this.parseExpr(p);
			var eif = this.parseBlock(tokens);
			var t1 = tokens.first();
			var eelse;
			if (t1 == null) {
				throw new HaxeError("Unclosed 'if'");
			};
			if (t1.p == "end") {
				tokens.pop();
				eelse = null;
			} else if (t1.p == "else") {
				tokens.pop();
				eelse = this.parseBlock(tokens);
				t1 = tokens.pop();
				if (t1 == null || t1.p != "end") {
					throw new HaxeError("Unclosed 'else'");
				};
			} else {
				t1.p = HxOverrides.substr(t1.p, 4, t1.p.length - 4);
				eelse = this.parse(tokens);
			};
			return TemplateExpr.OpIf(e, eif, eelse);
		};
		var pos2 = kwdEnd("foreach");
		if (pos2 >= 0) {
			p = HxOverrides.substr(p, pos2, p.length - pos2);
			var e1 = this.parseExpr(p);
			var efor = this.parseBlock(tokens);
			var t2 = tokens.pop();
			if (t2 == null || t2.p != "end") {
				throw new HaxeError("Unclosed 'foreach'");
			};
			return TemplateExpr.OpForeach(e1, efor);
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
				throw new HaxeError(l.first().p);
			};
		}catch (s) {
			CallStack.lastException = s;
			var s1 = (((s) instanceof HaxeError)) ? s.val : s;
			if (typeof(s1) == "string") {
				throw new HaxeError("Unexpected '" + s1 + "' in " + expr);
			} else {
				throw s;
			};
		};
		return function () {
			try {
				return e();
			}catch (exc) {
				CallStack.lastException = exc;
				throw new HaxeError("Error : " + Std.string((((exc) instanceof HaxeError)) ? exc.val : exc) + " in " + expr);
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
			throw new HaxeError(field.p);
		};
		var f = field.p;
		Template.expr_trim.match(f);
		f = Template.expr_trim.matched(1);
		return this.makePath(function () {
			return Reflect.field(e(), f);
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
			throw new HaxeError("<eof>");
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
					throw new HaxeError(p1);
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
					throw new HaxeError(p2);
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
					throw new HaxeError("Unknown operation " + p1.p);
					
				};
				break
			case "-":
				var e3 = this.makeExpr(l);
				return function () {
					return -e3();
				};
				break
			
		};
		throw new HaxeError(p.p);
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
				var _this1 = this.buf;
				var x1 = Std.string(e1());
				_this1.b += Std.string(x1);
				break
			case 2:
				var eelse = e.eelse;
				var eif = e.eif;
				var e2 = e.expr;
				var v1 = e2();
				if (v1 == null || v1 == false) {
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
					var e3 = val;
					this.run(e3);
				};
				break
			case 5:
				var loop = e.loop;
				var e4 = e.expr;
				var v2 = e4();
				try {
					var x2 = Register.iter(v2);
					if (x2.hasNext == null) {
						throw new HaxeError(null);
					};
					v2 = x2;
				}catch (e5) {
					CallStack.lastException = e5;
					var e6 = (((e5) instanceof HaxeError)) ? e5.val : e5;
					try {
						if (v2.hasNext == null) {
							throw new HaxeError(null);
						};
					}catch (e7) {
						CallStack.lastException = e7;
						var e8 = (((e7) instanceof HaxeError)) ? e7.val : e7;
						throw new HaxeError("Cannot iter on " + Std.string(v2));
					};
				};
				this.stack.push(this.context);
				var v3 = v2;
				var ctx = v3;
				while (ctx.hasNext()) {
					var ctx1 = ctx.next();
					this.context = ctx1;
					this.run(loop);
				};
				this.context = this.stack.pop();
				break
			case 6:
				var params = e.params;
				var m = e.name;
				var v4 = Reflect.field(this.macros, m);
				var pl = new Array();
				var old = this.buf;
				pl.push(Register.bind(this, this.resolve));
				var _g_head1 = params.h;
				while (_g_head1 != null) {
					var val1 = _g_head1.item;
					_g_head1 = _g_head1.next;
					var p = val1;
					if (p._hx_index == 0) {
						var v5 = p.v;
						pl.push(this.resolve(v5));
					} else {
						this.buf = new StringBuf();
						this.run(p);
						pl.push(this.buf.b);
					};
				};
				this.buf = old;
				try {
					var _this2 = this.buf;
					var x3 = Std.string(v4.apply(this.macros, pl));
					_this2.b += Std.string(x3);
				}catch (e9) {
					CallStack.lastException = e9;
					var e10 = (((e9) instanceof HaxeError)) ? e9.val : e9;
					var plstr;
					try {
						plstr = pl.join(",");
					}catch (e11) {
						CallStack.lastException = e11;
						var e12 = (((e11) instanceof HaxeError)) ? e11.val : e11;
						plstr = "???";
					};
					var msg = "Macro call " + m + "(" + plstr + ") failed (" + Std.string(e10) + ")";
					throw new HaxeError(msg);
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
Template.hxKeepArrayIterator = HxOverrides.iter([])
//# sourceMappingURL=Template.js.map