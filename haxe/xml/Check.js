import {ArrayIterator} from "../iterators/ArrayIterator.js"
import {Exception} from "../Exception.js"
import {Register} from "../../genes/Register.js"
import {Xml, XmlType} from "../../Xml.js"
import {Std} from "../../Std.js"
import {HxOverrides} from "../../HxOverrides.js"
import {EReg} from "../../EReg.js"

const $global = Register.$global

export const Filter = 
Register.global("$hxEnums")["haxe.xml.Filter"] = 
{
	__ename__: "haxe.xml.Filter",
	
	FInt: {_hx_name: "FInt", _hx_index: 0, __enum__: "haxe.xml.Filter"},
	FBool: {_hx_name: "FBool", _hx_index: 1, __enum__: "haxe.xml.Filter"},
	FEnum: Object.assign((values) => ({_hx_index: 2, __enum__: "haxe.xml.Filter", "values": values}), {_hx_name: "FEnum", __params__: ["values"]}),
	FReg: Object.assign((matcher) => ({_hx_index: 3, __enum__: "haxe.xml.Filter", "matcher": matcher}), {_hx_name: "FReg", __params__: ["matcher"]})
}
Filter.__constructs__ = [Filter.FInt, Filter.FBool, Filter.FEnum, Filter.FReg]
Filter.__empty_constructs__ = [Filter.FInt, Filter.FBool]

export const Attrib = 
Register.global("$hxEnums")["haxe.xml.Attrib"] = 
{
	__ename__: "haxe.xml.Attrib",
	
	Att: Object.assign((name, filter, defvalue) => ({_hx_index: 0, __enum__: "haxe.xml.Attrib", "name": name, "filter": filter, "defvalue": defvalue}), {_hx_name: "Att", __params__: ["name", "filter", "defvalue"]})
}
Attrib.__constructs__ = [Attrib.Att]
Attrib.__empty_constructs__ = []

export const Rule = 
Register.global("$hxEnums")["haxe.xml.Rule"] = 
{
	__ename__: "haxe.xml.Rule",
	
	RNode: Object.assign((name, attribs, childs) => ({_hx_index: 0, __enum__: "haxe.xml.Rule", "name": name, "attribs": attribs, "childs": childs}), {_hx_name: "RNode", __params__: ["name", "attribs", "childs"]}),
	RData: Object.assign((filter) => ({_hx_index: 1, __enum__: "haxe.xml.Rule", "filter": filter}), {_hx_name: "RData", __params__: ["filter"]}),
	RMulti: Object.assign((rule, atLeastOne) => ({_hx_index: 2, __enum__: "haxe.xml.Rule", "rule": rule, "atLeastOne": atLeastOne}), {_hx_name: "RMulti", __params__: ["rule", "atLeastOne"]}),
	RList: Object.assign((rules, ordered) => ({_hx_index: 3, __enum__: "haxe.xml.Rule", "rules": rules, "ordered": ordered}), {_hx_name: "RList", __params__: ["rules", "ordered"]}),
	RChoice: Object.assign((choices) => ({_hx_index: 4, __enum__: "haxe.xml.Rule", "choices": choices}), {_hx_name: "RChoice", __params__: ["choices"]}),
	ROptional: Object.assign((rule) => ({_hx_index: 5, __enum__: "haxe.xml.Rule", "rule": rule}), {_hx_name: "ROptional", __params__: ["rule"]})
}
Rule.__constructs__ = [Rule.RNode, Rule.RData, Rule.RMulti, Rule.RList, Rule.RChoice, Rule.ROptional]
Rule.__empty_constructs__ = []

export const CheckResult = 
Register.global("$hxEnums")["haxe.xml._Check.CheckResult"] = 
{
	__ename__: "haxe.xml._Check.CheckResult",
	
	CMatch: {_hx_name: "CMatch", _hx_index: 0, __enum__: "haxe.xml._Check.CheckResult"},
	CMissing: Object.assign((r) => ({_hx_index: 1, __enum__: "haxe.xml._Check.CheckResult", "r": r}), {_hx_name: "CMissing", __params__: ["r"]}),
	CExtra: Object.assign((x) => ({_hx_index: 2, __enum__: "haxe.xml._Check.CheckResult", "x": x}), {_hx_name: "CExtra", __params__: ["x"]}),
	CElementExpected: Object.assign((name, x) => ({_hx_index: 3, __enum__: "haxe.xml._Check.CheckResult", "name": name, "x": x}), {_hx_name: "CElementExpected", __params__: ["name", "x"]}),
	CDataExpected: Object.assign((x) => ({_hx_index: 4, __enum__: "haxe.xml._Check.CheckResult", "x": x}), {_hx_name: "CDataExpected", __params__: ["x"]}),
	CExtraAttrib: Object.assign((att, x) => ({_hx_index: 5, __enum__: "haxe.xml._Check.CheckResult", "att": att, "x": x}), {_hx_name: "CExtraAttrib", __params__: ["att", "x"]}),
	CMissingAttrib: Object.assign((att, x) => ({_hx_index: 6, __enum__: "haxe.xml._Check.CheckResult", "att": att, "x": x}), {_hx_name: "CMissingAttrib", __params__: ["att", "x"]}),
	CInvalidAttrib: Object.assign((att, x, f) => ({_hx_index: 7, __enum__: "haxe.xml._Check.CheckResult", "att": att, "x": x, "f": f}), {_hx_name: "CInvalidAttrib", __params__: ["att", "x", "f"]}),
	CInvalidData: Object.assign((x, f) => ({_hx_index: 8, __enum__: "haxe.xml._Check.CheckResult", "x": x, "f": f}), {_hx_name: "CInvalidData", __params__: ["x", "f"]}),
	CInElement: Object.assign((x, r) => ({_hx_index: 9, __enum__: "haxe.xml._Check.CheckResult", "x": x, "r": r}), {_hx_name: "CInElement", __params__: ["x", "r"]})
}
CheckResult.__constructs__ = [CheckResult.CMatch, CheckResult.CMissing, CheckResult.CExtra, CheckResult.CElementExpected, CheckResult.CDataExpected, CheckResult.CExtraAttrib, CheckResult.CMissingAttrib, CheckResult.CInvalidAttrib, CheckResult.CInvalidData, CheckResult.CInElement]
CheckResult.__empty_constructs__ = [CheckResult.CMatch]

export const Check = Register.global("$hxClasses")["haxe.xml.Check"] = 
class Check {
	static isBlank(x) {
		var tmp;
		if (x.nodeType == Xml.PCData) {
			var tmp1 = Check.blanks;
			if (x.nodeType == Xml.Document || x.nodeType == Xml.Element) {
				throw Exception.thrown("Bad node type, unexpected " + ((x.nodeType == null) ? "null" : XmlType.toString(x.nodeType)));
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
				var _g = r.name;
				var _g = r.attribs;
				var _g = r.childs;
				return false;
				break
			case 1:
				var _g = r.filter;
				return false;
				break
			case 2:
				var r1 = r.rule;
				var one = r.atLeastOne;
				if (one == true) {
					return Check.isNullable(r1);
				} else {
					return true;
				};
				break
			case 3:
				var _g = r.ordered;
				var rl = r.rules;
				var _g = 0;
				while (_g < rl.length) {
					var r1 = rl[_g];
					++_g;
					if (!Check.isNullable(r1)) {
						return false;
					};
				};
				return true;
				break
			case 4:
				var rl = r.choices;
				var _g = 0;
				while (_g < rl.length) {
					var r1 = rl[_g];
					++_g;
					if (Check.isNullable(r1)) {
						return true;
					};
				};
				return false;
				break
			case 5:
				var _g = r.rule;
				return true;
				break
			
		};
	}
	static check(x, r) {
		switch (r._hx_index) {
			case 0:
				var name = r.name;
				var attribs = r.attribs;
				var childs = r.childs;
				var tmp;
				if (x.nodeType == Xml.Element) {
					if (x.nodeType != Xml.Element) {
						throw Exception.thrown("Bad node type, expected Element but found " + ((x.nodeType == null) ? "null" : XmlType.toString(x.nodeType)));
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
						var _g1 = att.defvalue;
						var name = att.name;
						var filter = att.filter;
						if (xatt1 != name) {
							continue;
						};
						if (filter != null && !Check.filterMatch(x.get(xatt1), filter)) {
							return CheckResult.CInvalidAttrib(name, x, filter);
						};
						HxOverrides.remove(attribs1, att);
						found = true;
					};
					if (!found) {
						return CheckResult.CExtraAttrib(xatt1, x);
					};
				};
				var _g = 0;
				while (_g < attribs1.length) {
					var att = attribs1[_g];
					++_g;
					var _g1 = att.filter;
					var name = att.name;
					var defvalue = att.defvalue;
					if (defvalue == null) {
						return CheckResult.CMissingAttrib(name, x);
					};
				};
				if (childs == null) {
					childs = Rule.RList([]);
				};
				if (x.nodeType != Xml.Document && x.nodeType != Xml.Element) {
					throw Exception.thrown("Bad node type, expected Element or Document but found " + ((x.nodeType == null) ? "null" : XmlType.toString(x.nodeType)));
				};
				var m = Check.checkList(new ArrayIterator(x.children), childs);
				if (m != CheckResult.CMatch) {
					return CheckResult.CInElement(x, m);
				};
				var _g = 0;
				while (_g < attribs1.length) {
					var att = attribs1[_g];
					++_g;
					var _g1 = att.filter;
					var name = att.name;
					var defvalue = att.defvalue;
					x.set(name, defvalue);
				};
				return CheckResult.CMatch;
				break
			case 1:
				var filter = r.filter;
				if (x.nodeType != Xml.PCData && x.nodeType != Xml.CData) {
					return CheckResult.CDataExpected(x);
				};
				var tmp;
				if (filter != null) {
					if (x.nodeType == Xml.Document || x.nodeType == Xml.Element) {
						throw Exception.thrown("Bad node type, unexpected " + ((x.nodeType == null) ? "null" : XmlType.toString(x.nodeType)));
					};
					tmp = !Check.filterMatch(x.nodeValue, filter);
				} else {
					tmp = false;
				};
				if (tmp) {
					return CheckResult.CInvalidData(x, filter);
				};
				return CheckResult.CMatch;
				break
			case 4:
				var choices = r.choices;
				if (choices.length == 0) {
					throw Exception.thrown("No choice possible");
				};
				var _g = 0;
				while (_g < choices.length) {
					var c = choices[_g];
					++_g;
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
			throw Exception.thrown("Unexpected " + Std.string(r));
			
		};
	}
	static checkList(it, r) {
		switch (r._hx_index) {
			case 2:
				var r1 = r.rule;
				var one = r.atLeastOne;
				var found = false;
				var x = it;
				while (x.hasNext()) {
					var x1 = x.next();
					if (Check.isBlank(x1)) {
						continue;
					};
					var m = Check.checkList(new ArrayIterator([x1]), r1);
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
				var rules = r.rules;
				var ordered = r.ordered;
				var rules1 = rules.slice();
				var x = it;
				while (x.hasNext()) {
					var x1 = x.next();
					if (Check.isBlank(x1)) {
						continue;
					};
					var found = false;
					var _g = 0;
					while (_g < rules1.length) {
						var r1 = rules1[_g];
						++_g;
						var m = Check.checkList(new ArrayIterator([x1]), r1);
						if (m == CheckResult.CMatch) {
							found = true;
							if (r1._hx_index == 2) {
								var rsub = r1.rule;
								var one = r1.atLeastOne;
								if (one) {
									var i;
									var _g1 = 0;
									var _g2 = rules1.length;
									while (_g1 < _g2) {
										var i1 = _g1++;
										if (rules1[i1] == r1) {
											rules1[i1] = Rule.RMulti(rsub);
										};
									};
								};
							} else {
								HxOverrides.remove(rules1, r1);
							};
							break;
						} else if (ordered && !Check.isNullable(r1)) {
							return m;
						};
					};
					if (!found) {
						return CheckResult.CExtra(x1);
					};
				};
				var _g = 0;
				while (_g < rules1.length) {
					var r1 = rules1[_g];
					++_g;
					if (!Check.isNullable(r1)) {
						return CheckResult.CMissing(r1);
					};
				};
				return CheckResult.CMatch;
				break
			default:
			var found = false;
			var x = it;
			while (x.hasNext()) {
				var x1 = x.next();
				if (Check.isBlank(x1)) {
					continue;
				};
				var m = Check.check(x1, r);
				if (m != CheckResult.CMatch) {
					return m;
				};
				found = true;
				break;
			};
			if (!found) {
				if (r._hx_index == 5) {
					var _g = r.rule;
				} else {
					return CheckResult.CMissing(r);
				};
			};
			var x = it;
			while (x.hasNext()) {
				var x1 = x.next();
				if (Check.isBlank(x1)) {
					continue;
				};
				return CheckResult.CExtra(x1);
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
				throw Exception.thrown("Bad node type, expected Element but found " + ((x.nodeType == null) ? "null" : XmlType.toString(x.nodeType)));
			};
			s += x.nodeName;
		};
		return s + ": ";
	}
	static makeString(x) {
		if (x.nodeType == Xml.Element) {
			if (x.nodeType != Xml.Element) {
				throw Exception.thrown("Bad node type, expected Element but found " + ((x.nodeType == null) ? "null" : XmlType.toString(x.nodeType)));
			};
			return "element " + x.nodeName;
		};
		if (x.nodeType == Xml.Document || x.nodeType == Xml.Element) {
			throw Exception.thrown("Bad node type, unexpected " + ((x.nodeType == null) ? "null" : XmlType.toString(x.nodeType)));
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
				var _g = r.attribs;
				var _g = r.childs;
				var name = r.name;
				return "element " + name;
				break
			case 1:
				var _g = r.filter;
				return "data";
				break
			case 2:
				var _g = r.atLeastOne;
				var r1 = r.rule;
				return Check.makeRule(r1);
				break
			case 3:
				var _g = r.ordered;
				var rules = r.rules;
				return Check.makeRule(rules[0]);
				break
			case 4:
				var choices = r.choices;
				return Check.makeRule(choices[0]);
				break
			case 5:
				var r1 = r.rule;
				return Check.makeRule(r1);
				break
			
		};
	}
	static makeError(m, path) {
		if (path == null) {
			path = new Array();
		};
		switch (m._hx_index) {
			case 0:
				throw Exception.thrown("assert");
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
				var name = m.name;
				var x = m.x;
				return Check.makeWhere(path) + Check.makeString(x) + " while expected element " + name;
				break
			case 4:
				var x = m.x;
				return Check.makeWhere(path) + Check.makeString(x) + " while data expected";
				break
			case 5:
				var att = m.att;
				var x = m.x;
				path.push(x);
				return Check.makeWhere(path) + "unexpected attribute " + att;
				break
			case 6:
				var att = m.att;
				var x = m.x;
				path.push(x);
				return Check.makeWhere(path) + "missing required attribute " + att;
				break
			case 7:
				var _g = m.f;
				var att = m.att;
				var x = m.x;
				path.push(x);
				return Check.makeWhere(path) + "invalid attribute value for " + att;
				break
			case 8:
				var _g = m.f;
				var x = m.x;
				return Check.makeWhere(path) + "invalid data format for " + Check.makeString(x);
				break
			case 9:
				var x = m.x;
				var m1 = m.r;
				path.push(x);
				return Check.makeError(m1, path);
				break
			
		};
	}
	static checkNode(x, r) {
		var m = Check.checkList(new ArrayIterator([x]), r);
		if (m == CheckResult.CMatch) {
			return;
		};
		throw Exception.thrown(Check.makeError(m));
	}
	static checkDocument(x, r) {
		if (x.nodeType != Xml.Document) {
			throw Exception.thrown("Document expected");
		};
		if (x.nodeType != Xml.Document && x.nodeType != Xml.Element) {
			throw Exception.thrown("Bad node type, expected Element or Document but found " + ((x.nodeType == null) ? "null" : XmlType.toString(x.nodeType)));
		};
		var m = Check.checkList(new ArrayIterator(x.children), r);
		if (m == CheckResult.CMatch) {
			return;
		};
		throw Exception.thrown(Check.makeError(m));
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