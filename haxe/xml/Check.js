import {HaxeError} from "../../js/Boot.js"
import {Register} from "../../genes/Register.js"
import {Xml, XmlType_Impl_} from "../../Xml.js"
import {Std} from "../../Std.js"
import {HxOverrides} from "../../HxOverrides.js"
import {EReg} from "../../EReg.js"

export const Filter = 
Register.global("$hxEnums")["haxe.xml.Filter"] = 
{
	__ename__: "haxe.xml.Filter",
	
	FInt: {_hx_name: "FInt", _hx_index: 0, __enum__: "haxe.xml.Filter"},
	FBool: {_hx_name: "FBool", _hx_index: 1, __enum__: "haxe.xml.Filter"},
	FEnum: Object.assign((values) => ({_hx_index: 2, __enum__: "haxe.xml.Filter", values}), {_hx_name: "FEnum", __params__: ["values"]}),
	FReg: Object.assign((matcher) => ({_hx_index: 3, __enum__: "haxe.xml.Filter", matcher}), {_hx_name: "FReg", __params__: ["matcher"]})
}
Filter.__constructs__ = ["FInt", "FBool", "FEnum", "FReg"]
Filter.__empty_constructs__ = [Filter.FInt, Filter.FBool]

export const Attrib = 
Register.global("$hxEnums")["haxe.xml.Attrib"] = 
{
	__ename__: "haxe.xml.Attrib",
	
	Att: Object.assign((name, filter, defvalue) => ({_hx_index: 0, __enum__: "haxe.xml.Attrib", name, filter, defvalue}), {_hx_name: "Att", __params__: ["name", "filter", "defvalue"]})
}
Attrib.__constructs__ = ["Att"]
Attrib.__empty_constructs__ = []

export const Rule = 
Register.global("$hxEnums")["haxe.xml.Rule"] = 
{
	__ename__: "haxe.xml.Rule",
	
	RNode: Object.assign((name, attribs, childs) => ({_hx_index: 0, __enum__: "haxe.xml.Rule", name, attribs, childs}), {_hx_name: "RNode", __params__: ["name", "attribs", "childs"]}),
	RData: Object.assign((filter) => ({_hx_index: 1, __enum__: "haxe.xml.Rule", filter}), {_hx_name: "RData", __params__: ["filter"]}),
	RMulti: Object.assign((rule, atLeastOne) => ({_hx_index: 2, __enum__: "haxe.xml.Rule", rule, atLeastOne}), {_hx_name: "RMulti", __params__: ["rule", "atLeastOne"]}),
	RList: Object.assign((rules, ordered) => ({_hx_index: 3, __enum__: "haxe.xml.Rule", rules, ordered}), {_hx_name: "RList", __params__: ["rules", "ordered"]}),
	RChoice: Object.assign((choices) => ({_hx_index: 4, __enum__: "haxe.xml.Rule", choices}), {_hx_name: "RChoice", __params__: ["choices"]}),
	ROptional: Object.assign((rule) => ({_hx_index: 5, __enum__: "haxe.xml.Rule", rule}), {_hx_name: "ROptional", __params__: ["rule"]})
}
Rule.__constructs__ = ["RNode", "RData", "RMulti", "RList", "RChoice", "ROptional"]
Rule.__empty_constructs__ = []

export const CheckResult = 
Register.global("$hxEnums")["haxe.xml._Check.CheckResult"] = 
{
	__ename__: "haxe.xml._Check.CheckResult",
	
	CMatch: {_hx_name: "CMatch", _hx_index: 0, __enum__: "haxe.xml._Check.CheckResult"},
	CMissing: Object.assign((r) => ({_hx_index: 1, __enum__: "haxe.xml._Check.CheckResult", r}), {_hx_name: "CMissing", __params__: ["r"]}),
	CExtra: Object.assign((x) => ({_hx_index: 2, __enum__: "haxe.xml._Check.CheckResult", x}), {_hx_name: "CExtra", __params__: ["x"]}),
	CElementExpected: Object.assign((name, x) => ({_hx_index: 3, __enum__: "haxe.xml._Check.CheckResult", name, x}), {_hx_name: "CElementExpected", __params__: ["name", "x"]}),
	CDataExpected: Object.assign((x) => ({_hx_index: 4, __enum__: "haxe.xml._Check.CheckResult", x}), {_hx_name: "CDataExpected", __params__: ["x"]}),
	CExtraAttrib: Object.assign((att, x) => ({_hx_index: 5, __enum__: "haxe.xml._Check.CheckResult", att, x}), {_hx_name: "CExtraAttrib", __params__: ["att", "x"]}),
	CMissingAttrib: Object.assign((att, x) => ({_hx_index: 6, __enum__: "haxe.xml._Check.CheckResult", att, x}), {_hx_name: "CMissingAttrib", __params__: ["att", "x"]}),
	CInvalidAttrib: Object.assign((att, x, f) => ({_hx_index: 7, __enum__: "haxe.xml._Check.CheckResult", att, x, f}), {_hx_name: "CInvalidAttrib", __params__: ["att", "x", "f"]}),
	CInvalidData: Object.assign((x, f) => ({_hx_index: 8, __enum__: "haxe.xml._Check.CheckResult", x, f}), {_hx_name: "CInvalidData", __params__: ["x", "f"]}),
	CInElement: Object.assign((x, r) => ({_hx_index: 9, __enum__: "haxe.xml._Check.CheckResult", x, r}), {_hx_name: "CInElement", __params__: ["x", "r"]})
}
CheckResult.__constructs__ = ["CMatch", "CMissing", "CExtra", "CElementExpected", "CDataExpected", "CExtraAttrib", "CMissingAttrib", "CInvalidAttrib", "CInvalidData", "CInElement"]
CheckResult.__empty_constructs__ = [CheckResult.CMatch]

export const Check = Register.global("$hxClasses")["haxe.xml.Check"] = 
class Check {
	static isBlank(x) {
		var tmp;
		if (x.nodeType == Xml.PCData) {
			var tmp1 = Check.blanks;
			if (x.nodeType == Xml.Document || x.nodeType == Xml.Element) {
				throw new HaxeError("Bad node type, unexpected " + XmlType_Impl_.toString(x.nodeType));
			};
			tmp = tmp1.match(x.nodeValue);
		} else {
			tmp = false;
		};
		if (!tmp) {
			return x.nodeType == Xml.Comment;
		} else {
			return true;
		};
	}
	static filterMatch(s, f) {
		switch (f._hx_index) {
			case 0:
				return Check.filterMatch(s, Filter.FReg(new EReg("[0-9]+", "")));
				break
			case 1:
				return Check.filterMatch(s, Filter.FEnum(["true", "false", "0", "1"]));
				break
			case 2:
				var values = f.values;
				var _g = 0;
				while (_g < values.length) {
					var v = values[_g];
					++_g;
					if (s == v) {
						return true;
					};
				};
				return false;
				break
			case 3:
				var r = f.matcher;
				return r.match(s);
				break
			
		};
	}
	static isNullable(r) {
		switch (r._hx_index) {
			case 0:
				var _g2 = r.childs;
				var _g1 = r.attribs;
				var _g = r.name;
				return false;
				break
			case 1:
				var _g5 = r.filter;
				return false;
				break
			case 2:
				var one = r.atLeastOne;
				var r1 = r.rule;
				if (one == true) {
					return Check.isNullable(r1);
				} else {
					return true;
				};
				break
			case 3:
				var _g4 = r.ordered;
				var rl = r.rules;
				var _g3 = 0;
				while (_g3 < rl.length) {
					var r2 = rl[_g3];
					++_g3;
					if (!Check.isNullable(r2)) {
						return false;
					};
				};
				return true;
				break
			case 4:
				var rl1 = r.choices;
				var _g6 = 0;
				while (_g6 < rl1.length) {
					var r3 = rl1[_g6];
					++_g6;
					if (Check.isNullable(r3)) {
						return true;
					};
				};
				return false;
				break
			case 5:
				var _g9 = r.rule;
				return true;
				break
			
		};
	}
	static check(x, r) {
		switch (r._hx_index) {
			case 0:
				var childs = r.childs;
				var attribs = r.attribs;
				var name = r.name;
				var tmp;
				if (x.nodeType == Xml.Element) {
					if (x.nodeType != Xml.Element) {
						throw new HaxeError("Bad node type, expected Element but found " + XmlType_Impl_.toString(x.nodeType));
					};
					tmp = x.nodeName != name;
				} else {
					tmp = true;
				};
				if (tmp) {
					return CheckResult.CElementExpected(name, x);
				};
				var attribs1 = (attribs == null) ? new Array() : attribs.slice();
				var xatt = x.attributes();
				while (xatt.hasNext()) {
					var xatt1 = xatt.next();
					var found = false;
					var _g = 0;
					while (_g < attribs1.length) {
						var att = attribs1[_g];
						++_g;
						var _g2 = att.defvalue;
						var filter = att.filter;
						var name1 = att.name;
						if (xatt1 != name1) {
							continue;
						};
						if (filter != null && !Check.filterMatch(x.get(xatt1), filter)) {
							return CheckResult.CInvalidAttrib(name1, x, filter);
						};
						HxOverrides.remove(attribs1, att);
						found = true;
					};
					if (!found) {
						return CheckResult.CExtraAttrib(xatt1, x);
					};
				};
				var _g1 = 0;
				while (_g1 < attribs1.length) {
					var att1 = attribs1[_g1];
					++_g1;
					var _g11 = att1.filter;
					var defvalue = att1.defvalue;
					var name2 = att1.name;
					if (defvalue == null) {
						return CheckResult.CMissingAttrib(name2, x);
					};
				};
				if (childs == null) {
					childs = Rule.RList([]);
				};
				if (x.nodeType != Xml.Document && x.nodeType != Xml.Element) {
					throw new HaxeError("Bad node type, expected Element or Document but found " + XmlType_Impl_.toString(x.nodeType));
				};
				var m = Check.checkList(HxOverrides.iter(x.children), childs);
				if (m != CheckResult.CMatch) {
					return CheckResult.CInElement(x, m);
				};
				var _g12 = 0;
				while (_g12 < attribs1.length) {
					var att2 = attribs1[_g12];
					++_g12;
					var _g21 = att2.filter;
					var defvalue1 = att2.defvalue;
					var name3 = att2.name;
					x.set(name3, defvalue1);
				};
				return CheckResult.CMatch;
				break
			case 1:
				var filter1 = r.filter;
				if (x.nodeType != Xml.PCData && x.nodeType != Xml.CData) {
					return CheckResult.CDataExpected(x);
				};
				var tmp1;
				if (filter1 != null) {
					if (x.nodeType == Xml.Document || x.nodeType == Xml.Element) {
						throw new HaxeError("Bad node type, unexpected " + XmlType_Impl_.toString(x.nodeType));
					};
					tmp1 = !Check.filterMatch(x.nodeValue, filter1);
				} else {
					tmp1 = false;
				};
				if (tmp1) {
					return CheckResult.CInvalidData(x, filter1);
				};
				return CheckResult.CMatch;
				break
			case 4:
				var choices = r.choices;
				if (choices.length == 0) {
					throw new HaxeError("No choice possible");
				};
				var _g3 = 0;
				while (_g3 < choices.length) {
					var c = choices[_g3];
					++_g3;
					if (Check.check(x, c) == CheckResult.CMatch) {
						return CheckResult.CMatch;
					};
				};
				return Check.check(x, choices[0]);
				break
			case 5:
				var r1 = r.rule;
				return Check.check(x, r1);
				break
			default:
			throw new HaxeError("Unexpected " + Std.string(r));
			
		};
	}
	static checkList(it, r) {
		switch (r._hx_index) {
			case 2:
				var one = r.atLeastOne;
				var r1 = r.rule;
				var found = false;
				var x = it;
				while (x.hasNext()) {
					var x1 = x.next();
					if (Check.isBlank(x1)) {
						continue;
					};
					var m = Check.checkList(HxOverrides.iter([x1]), r1);
					if (m != CheckResult.CMatch) {
						return m;
					};
					found = true;
				};
				if (one && !found) {
					return CheckResult.CMissing(r1);
				};
				return CheckResult.CMatch;
				break
			case 3:
				var ordered = r.ordered;
				var rules = r.rules;
				var rules1 = rules.slice();
				var x2 = it;
				while (x2.hasNext()) {
					var x3 = x2.next();
					if (Check.isBlank(x3)) {
						continue;
					};
					var found1 = false;
					var _g = 0;
					while (_g < rules1.length) {
						var r2 = rules1[_g];
						++_g;
						var m1 = Check.checkList(HxOverrides.iter([x3]), r2);
						if (m1 == CheckResult.CMatch) {
							found1 = true;
							if (r2._hx_index == 2) {
								var one1 = r2.atLeastOne;
								var rsub = r2.rule;
								if (one1) {
									var i;
									var _g1 = 0;
									var _g11 = rules1.length;
									while (_g1 < _g11) {
										var i1 = _g1++;
										if (rules1[i1] == r2) {
											rules1[i1] = Rule.RMulti(rsub);
										};
									};
								};
							} else {
								HxOverrides.remove(rules1, r2);
							};
							break;
						} else if (ordered && !Check.isNullable(r2)) {
							return m1;
						};
					};
					if (!found1) {
						return CheckResult.CExtra(x3);
					};
				};
				var _g2 = 0;
				while (_g2 < rules1.length) {
					var r3 = rules1[_g2];
					++_g2;
					if (!Check.isNullable(r3)) {
						return CheckResult.CMissing(r3);
					};
				};
				return CheckResult.CMatch;
				break
			default:
			var found2 = false;
			var x4 = it;
			while (x4.hasNext()) {
				var x5 = x4.next();
				if (Check.isBlank(x5)) {
					continue;
				};
				var m2 = Check.check(x5, r);
				if (m2 != CheckResult.CMatch) {
					return m2;
				};
				found2 = true;
				break;
			};
			if (!found2) {
				if (r._hx_index == 5) {
					var _g3 = r.rule;
				} else {
					return CheckResult.CMissing(r);
				};
			};
			var x6 = it;
			while (x6.hasNext()) {
				var x7 = x6.next();
				if (Check.isBlank(x7)) {
					continue;
				};
				return CheckResult.CExtra(x7);
			};
			return CheckResult.CMatch;
			
		};
	}
	static makeWhere(path) {
		if (path.length == 0) {
			return "";
		};
		var s = "In ";
		var first = true;
		var _g = 0;
		while (_g < path.length) {
			var x = path[_g];
			++_g;
			if (first) {
				first = false;
			} else {
				s += ".";
			};
			if (x.nodeType != Xml.Element) {
				throw new HaxeError("Bad node type, expected Element but found " + XmlType_Impl_.toString(x.nodeType));
			};
			s += x.nodeName;
		};
		return s + ": ";
	}
	static makeString(x) {
		if (x.nodeType == Xml.Element) {
			if (x.nodeType != Xml.Element) {
				throw new HaxeError("Bad node type, expected Element but found " + XmlType_Impl_.toString(x.nodeType));
			};
			return "element " + x.nodeName;
		};
		if (x.nodeType == Xml.Document || x.nodeType == Xml.Element) {
			throw new HaxeError("Bad node type, unexpected " + XmlType_Impl_.toString(x.nodeType));
		};
		var s = x.nodeValue.split("\r").join("\\r").split("\n").join("\\n").split("\t").join("\\t");
		if (s.length > 20) {
			return HxOverrides.substr(s, 0, 17) + "...";
		};
		return s;
	}
	static makeRule(r) {
		switch (r._hx_index) {
			case 0:
				var _g2 = r.childs;
				var _g1 = r.attribs;
				var name = r.name;
				return "element " + name;
				break
			case 1:
				var _g5 = r.filter;
				return "data";
				break
			case 2:
				var _g7 = r.atLeastOne;
				var r1 = r.rule;
				return Check.makeRule(r1);
				break
			case 3:
				var _g4 = r.ordered;
				var rules = r.rules;
				return Check.makeRule(rules[0]);
				break
			case 4:
				var choices = r.choices;
				return Check.makeRule(choices[0]);
				break
			case 5:
				var r2 = r.rule;
				return Check.makeRule(r2);
				break
			
		};
	}
	static makeError(m, path = null) {
		if (path == null) {
			path = new Array();
		};
		switch (m._hx_index) {
			case 0:
				throw new HaxeError("assert");
				break
			case 1:
				var r = m.r;
				return Check.makeWhere(path) + "Missing " + Check.makeRule(r);
				break
			case 2:
				var x = m.x;
				return Check.makeWhere(path) + "Unexpected " + Check.makeString(x);
				break
			case 3:
				var x1 = m.x;
				var name = m.name;
				return Check.makeWhere(path) + Check.makeString(x1) + " while expected element " + name;
				break
			case 4:
				var x2 = m.x;
				return Check.makeWhere(path) + Check.makeString(x2) + " while data expected";
				break
			case 5:
				var x3 = m.x;
				var att = m.att;
				path.push(x3);
				return Check.makeWhere(path) + "unexpected attribute " + att;
				break
			case 6:
				var x4 = m.x;
				var att1 = m.att;
				path.push(x4);
				return Check.makeWhere(path) + "missing required attribute " + att1;
				break
			case 7:
				var _g11 = m.f;
				var x5 = m.x;
				var att2 = m.att;
				path.push(x5);
				return Check.makeWhere(path) + "invalid attribute value for " + att2;
				break
			case 8:
				var _g13 = m.f;
				var x6 = m.x;
				return Check.makeWhere(path) + "invalid data format for " + Check.makeString(x6);
				break
			case 9:
				var m1 = m.r;
				var x7 = m.x;
				path.push(x7);
				return Check.makeError(m1, path);
				break
			
		};
	}
	static checkNode(x, r) {
		var m = Check.checkList(HxOverrides.iter([x]), r);
		if (m == CheckResult.CMatch) {
			return;
		};
		throw new HaxeError(Check.makeError(m));
	}
	static checkDocument(x, r) {
		if (x.nodeType != Xml.Document) {
			throw new HaxeError("Document expected");
		};
		if (x.nodeType != Xml.Document && x.nodeType != Xml.Element) {
			throw new HaxeError("Bad node type, expected Element or Document but found " + XmlType_Impl_.toString(x.nodeType));
		};
		var m = Check.checkList(HxOverrides.iter(x.children), r);
		if (m == CheckResult.CMatch) {
			return;
		};
		throw new HaxeError(Check.makeError(m));
	}
	static get __name__() {
		return "haxe.xml.Check"
	}
	get __class__() {
		return Check
	}
}


Check.blanks = new EReg("^[ \r\n\t]*$", "")
//# sourceMappingURL=Check.js.map