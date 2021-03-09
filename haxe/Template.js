import {ArrayIterator} from "./iterators/ArrayIterator.js"
import {List} from "./ds/List.js"
import {NativeStackTrace} from "./NativeStackTrace.js"
import {Exception} from "./Exception.js"
import {Register} from "../genes/Register.js"
import {StringBuf} from "../StringBuf.js"
import {Std} from "../Std.js"
import {Reflect} from "../Reflect.js"
import {HxOverrides} from "../HxOverrides.js"
import {EReg} from "../EReg.js"

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
		let tokens = this.parseTokens(str);
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
		if (Reflect.isObject(this.context)) {
			let value = Reflect.getProperty(this.context, v);
			if (value != null || Object.prototype.hasOwnProperty.call(this.context, v)) {
				return value;
			};
		};
		let _g_head = this.stack.h;
		while (_g_head != null) {
			let val = _g_head.item;
			_g_head = _g_head.next;
			let ctx = val;
			let value = Reflect.getProperty(ctx, v);
			if (value != null || Object.prototype.hasOwnProperty.call(ctx, v)) {
				return value;
			};
		};
		return Reflect.field(Template.globals, v);
	}
	parseTokens(data) {
		let tokens = new List();
		while (Template.splitter.match(data)) {
			let p = Template.splitter.matchedPos();
			if (p.pos > 0) {
				tokens.add({"p": HxOverrides.substr(data, 0, p.pos), "s": true, "l": null});
			};
			if (HxOverrides.cca(data, p.pos) == 58) {
				tokens.add({"p": HxOverrides.substr(data, p.pos + 2, p.len - 4), "s": false, "l": null});
				data = Template.splitter.matchedRight();
				continue;
			};
			let parp = p.pos + p.len;
			let npar = 1;
			let params = [];
			let part = "";
			while (true) {
				let c = HxOverrides.cca(data, parp);
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
		let l = new List();
		while (true) {
			let t = tokens.first();
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
		let t = tokens.pop();
		let p = t.p;
		if (t.s) {
			return TemplateExpr.OpStr(p);
		};
		if (t.l != null) {
			let pe = new List();
			let _g = 0;
			let _g1 = t.l;
			while (_g < _g1.length) {
				let p = _g1[_g];
				++_g;
				pe.add(this.parseBlock(this.parseTokens(p)));
			};
			return TemplateExpr.OpMacro(p, pe);
		};
		let kwdEnd = function (kwd) {
			let pos = -1;
			let length = kwd.length;
			if (HxOverrides.substr(p, 0, length) == kwd) {
				pos = length;
				let _g_offset = 0;
				let _g_s = HxOverrides.substr(p, length, null);
				while (_g_offset < _g_s.length) {
					let c = _g_s.charCodeAt(_g_offset++);
					if (c == 32) {
						++pos;
					} else {
						break;
					};
				};
			};
			return pos;
		};
		let pos = kwdEnd("if");
		if (pos > 0) {
			p = HxOverrides.substr(p, pos, p.length - pos);
			let e = this.parseExpr(p);
			let eif = this.parseBlock(tokens);
			let t = tokens.first();
			let eelse;
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
		let pos1 = kwdEnd("foreach");
		if (pos1 >= 0) {
			p = HxOverrides.substr(p, pos1, p.length - pos1);
			let e = this.parseExpr(p);
			let efor = this.parseBlock(tokens);
			let t = tokens.pop();
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
		let l = new List();
		let expr = data;
		while (Template.expr_splitter.match(data)) {
			let p = Template.expr_splitter.matchedPos();
			let k = p.pos + p.len;
			if (p.pos != 0) {
				l.add({"p": HxOverrides.substr(data, 0, p.pos), "s": true});
			};
			let p1 = Template.expr_splitter.matched(0);
			l.add({"p": p1, "s": p1.indexOf("\"") >= 0});
			data = Template.expr_splitter.matchedRight();
		};
		if (data.length != 0) {
			let _g_offset = 0;
			let _g_s = data;
			while (_g_offset < _g_s.length) {
				let _g1_key = _g_offset;
				let _g1_value = _g_s.charCodeAt(_g_offset++);
				let i = _g1_key;
				let c = _g1_value;
				if (c != 32) {
					l.add({"p": HxOverrides.substr(data, i, null), "s": true});
					break;
				};
			};
		};
		let e;
		try {
			e = this.makeExpr(l);
			if (!l.isEmpty()) {
				throw Exception.thrown(l.first().p);
			};
		}catch (_g) {
			NativeStackTrace.lastError = _g;
			let _g1 = Exception.caught(_g).unwrap();
			if (typeof(_g1) == "string") {
				let s = _g1;
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
				let exc = Exception.caught(_g).unwrap();
				throw Exception.thrown("Error : " + Std.string(exc) + " in " + expr);
			};
		};
	}
	makeConst(v) {
		Template.expr_trim.match(v);
		v = Template.expr_trim.matched(1);
		if (HxOverrides.cca(v, 0) == 34) {
			let str = HxOverrides.substr(v, 1, v.length - 2);
			return function () {
				return str;
			};
		};
		if (Template.expr_int.match(v)) {
			let i = Std.parseInt(v);
			return function () {
				return i;
			};
		};
		if (Template.expr_float.match(v)) {
			let f = parseFloat(v);
			return function () {
				return f;
			};
		};
		let me = this;
		return function () {
			return me.resolve(v);
		};
	}
	makePath(e, l) {
		let p = l.first();
		if (p == null || p.p != ".") {
			return e;
		};
		l.pop();
		let field = l.pop();
		if (field == null || !field.s) {
			throw Exception.thrown(field.p);
		};
		let f = field.p;
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
		let p = l.first();
		while (p != null) {
			let _g_offset = 0;
			let _g_s = p.p;
			while (_g_offset < _g_s.length) {
				let c = _g_s.charCodeAt(_g_offset++);
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
		let p = l.pop();
		this.skipSpaces(l);
		if (p == null) {
			throw Exception.thrown("<eof>");
		};
		if (p.s) {
			return this.makeConst(p.p);
		};
		switch (p.p) {
			case "!":
				let e = this.makeExpr(l);
				return function () {
					let v = e();
					if (v != null) {
						return v == false;
					} else {
						return true;
					};
				};
				break
			case "(":
				this.skipSpaces(l);
				let e1 = this.makeExpr(l);
				this.skipSpaces(l);
				let p1 = l.pop();
				if (p1 == null || p1.s) {
					throw Exception.thrown(p1);
				};
				if (p1.p == ")") {
					return e1;
				};
				this.skipSpaces(l);
				let e2 = this.makeExpr(l);
				this.skipSpaces(l);
				let p2 = l.pop();
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
				let e3 = this.makeExpr(l);
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
				let v = e.v;
				let _this = this.buf;
				let x = Std.string(this.resolve(v));
				_this.b += Std.string(x);
				break
			case 1:
				let e1 = e.expr;
				let _this1 = this.buf;
				let x1 = Std.string(e1());
				_this1.b += Std.string(x1);
				break
			case 2:
				let e2 = e.expr;
				let eif = e.eif;
				let eelse = e.eelse;
				let v1 = e2();
				if (v1 == null || v1 == false) {
					if (eelse != null) {
						this.run(eelse);
					};
				} else {
					this.run(eif);
				};
				break
			case 3:
				let str = e.str;
				this.buf.b += (str == null) ? "null" : "" + str;
				break
			case 4:
				let l = e.l;
				let _g_head = l.h;
				while (_g_head != null) {
					let val = _g_head.item;
					_g_head = _g_head.next;
					let e = val;
					this.run(e);
				};
				break
			case 5:
				let e3 = e.expr;
				let loop = e.loop;
				let v2 = e3();
				try {
					let x = Register.iter(v2);
					if (x.hasNext == null) {
						throw Exception.thrown(null);
					};
					v2 = x;
				}catch (_g) {
					NativeStackTrace.lastError = _g;
					try {
						if (v2.hasNext == null) {
							throw Exception.thrown(null);
						};
					}catch (_g) {
						throw Exception.thrown("Cannot iter on " + Std.string(v2));
					};
				};
				this.stack.push(this.context);
				let v3 = v2;
				let ctx = v3;
				while (ctx.hasNext()) {
					let ctx1 = ctx.next();
					this.context = ctx1;
					this.run(loop);
				};
				this.context = this.stack.pop();
				break
			case 6:
				let m = e.name;
				let params = e.params;
				let v4 = Reflect.field(this.macros, m);
				let pl = new Array();
				let old = this.buf;
				pl.push(Register.bind(this, this.resolve));
				let _g_head1 = params.h;
				while (_g_head1 != null) {
					let val = _g_head1.item;
					_g_head1 = _g_head1.next;
					let p = val;
					if (p._hx_index == 0) {
						let v = p.v;
						pl.push(this.resolve(v));
					} else {
						this.buf = new StringBuf();
						this.run(p);
						pl.push(this.buf.b);
					};
				};
				this.buf = old;
				try {
					let _this = this.buf;
					let x = Std.string(v4.apply(this.macros, pl));
					_this.b += Std.string(x);
				}catch (_g) {
					NativeStackTrace.lastError = _g;
					let e = Exception.caught(_g).unwrap();
					let plstr;
					try {
						plstr = pl.join(",");
					}catch (_g) {
						plstr = "???";
					};
					let msg = "Macro call " + m + "(" + plstr + ") failed (" + Std.string(e) + ")";
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