import {ArrayIterator} from "../iterators/ArrayIterator.js"
import {Exception} from "../Exception.js"
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
		let tmp;
		if (x.nodeType == Xml.PCData) {
			let tmp1 = Check.blanks;
			if (x.nodeType == Xml.Document || x.nodeType == Xml.Element) {
				throw Exception.thrown("Bad node type, unexpected " + ((x.nodeType == null) ? "null" : XmlType_Impl_.toString(x.nodeType)));
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
				let values = f.values;
				let _g = 0;
				while (_g < values.length) {
					let v = values[_g];
					++_g;
					if (s == v) {
						return true;
					};
				};
				return false;
				break
			case 3:
				let r = f.matcher;
				return r.match(s);
				break
			
		};
	}
	static isNullable(r) {
		switch (r._hx_index) {
			case 0:
				let _g = r.childs;
				let _g1 = r.attribs;
				let _g2 = r.name;
				return false;
				break
			case 1:
				let _g3 = r.filter;
				return false;
				break
			case 2:
				let one = r.atLeastOne;
				let r1 = r.rule;
				if (one == true) {
					return Check.isNullable(r1);
				} else {
					return true;
				};
				break
			case 3:
				let _g4 = r.ordered;
				let rl = r.rules;
				let _g5 = 0;
				while (_g5 < rl.length) {
					let r = rl[_g5];
					++_g5;
					if (!Check.isNullable(r)) {
						return false;
					};
				};
				return true;
				break
			case 4:
				let rl1 = r.choices;
				let _g6 = 0;
				while (_g6 < rl1.length) {
					let r = rl1[_g6];
					++_g6;
					if (Check.isNullable(r)) {
						return true;
					};
				};
				return false;
				break
			case 5:
				let _g7 = r.rule;
				return true;
				break
			
		};
	}
	static check(x, r) {
		switch (r._hx_index) {
			case 0:
				let childs = r.childs;
				let attribs = r.attribs;
				let name = r.name;
				let tmp;
				if (x.nodeType == Xml.Element) {
					if (x.nodeType != Xml.Element) {
						throw Exception.thrown("Bad node type, expected Element but found " + ((x.nodeType == null) ? "null" : XmlType_Impl_.toString(x.nodeType)));
					};
					tmp = x.nodeName != name;
				} else {
					tmp = true;
				};
				if (tmp) {
					return CheckResult.CElementExpected(name, x);
				};
				let attribs1 = (attribs == null) ? new Array() : attribs.slice();
				let xatt = x.attributes();
				while (xatt.hasNext()) {
					let xatt1 = xatt.next();
					let found = false;
					let _g = 0;
					while (_g < attribs1.length) {
						let att = attribs1[_g];
						++_g;
						let _g1 = att.defvalue;
						let filter = att.filter;
						let name = att.name;
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
				let _g = 0;
				while (_g < attribs1.length) {
					let att = attribs1[_g];
					++_g;
					let _g1 = att.filter;
					let defvalue = att.defvalue;
					let name = att.name;
					if (defvalue == null) {
						return CheckResult.CMissingAttrib(name, x);
					};
				};
				if (childs == null) {
					childs = Rule.RList([]);
				};
				if (x.nodeType != Xml.Document && x.nodeType != Xml.Element) {
					throw Exception.thrown("Bad node type, expected Element or Document but found " + ((x.nodeType == null) ? "null" : XmlType_Impl_.toString(x.nodeType)));
				};
				let m = Check.checkList(new ArrayIterator(x.children), childs);
				if (m != CheckResult.CMatch) {
					return CheckResult.CInElement(x, m);
				};
				let _g1 = 0;
				while (_g1 < attribs1.length) {
					let att = attribs1[_g1];
					++_g1;
					let _g = att.filter;
					let defvalue = att.defvalue;
					let name = att.name;
					x.set(name, defvalue);
				};
				return CheckResult.CMatch;
				break
			case 1:
				let filter = r.filter;
				if (x.nodeType != Xml.PCData && x.nodeType != Xml.CData) {
					return CheckResult.CDataExpected(x);
				};
				let tmp1;
				if (filter != null) {
					if (x.nodeType == Xml.Document || x.nodeType == Xml.Element) {
						throw Exception.thrown("Bad node type, unexpected " + ((x.nodeType == null) ? "null" : XmlType_Impl_.toString(x.nodeType)));
					};
					tmp1 = !Check.filterMatch(x.nodeValue, filter);
				} else {
					tmp1 = false;
				};
				if (tmp1) {
					return CheckResult.CInvalidData(x, filter);
				};
				return CheckResult.CMatch;
				break
			case 4:
				let choices = r.choices;
				if (choices.length == 0) {
					throw Exception.thrown("No choice possible");
				};
				let _g2 = 0;
				while (_g2 < choices.length) {
					let c = choices[_g2];
					++_g2;
					if (Check.check(x, c) == CheckResult.CMatch) {
						return CheckResult.CMatch;
					};
				};
				return Check.check(x, choices[0]);
				break
			case 5:
				let r1 = r.rule;
				return Check.check(x, r1);
				break
			default:
			throw Exception.thrown("Unexpected " + Std.string(r));
			
		};
	}
	static checkList(it, r) {
		switch (r._hx_index) {
			case 2:
				let one = r.atLeastOne;
				let r1 = r.rule;
				let found = false;
				let x = it;
				while (x.hasNext()) {
					let x1 = x.next();
					if (Check.isBlank(x1)) {
						continue;
					};
					let m = Check.checkList(new ArrayIterator([x1]), r1);
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
				let ordered = r.ordered;
				let rules = r.rules;
				let rules1 = rules.slice();
				let x1 = it;
				while (x1.hasNext()) {
					let x = x1.next();
					if (Check.isBlank(x)) {
						continue;
					};
					let found = false;
					let _g = 0;
					while (_g < rules1.length) {
						let r = rules1[_g];
						++_g;
						let m = Check.checkList(new ArrayIterator([x]), r);
						if (m == CheckResult.CMatch) {
							found = true;
							if (r._hx_index == 2) {
								let one = r.atLeastOne;
								let rsub = r.rule;
								if (one) {
									let i;
									let _g = 0;
									let _g1 = rules1.length;
									while (_g < _g1) {
										let i = _g++;
										if (rules1[i] == r) {
											rules1[i] = Rule.RMulti(rsub);
										};
									};
								};
							} else {
								HxOverrides.remove(rules1, r);
							};
							break;
						} else if (ordered && !Check.isNullable(r)) {
							return m;
						};
					};
					if (!found) {
						return CheckResult.CExtra(x);
					};
				};
				let _g = 0;
				while (_g < rules1.length) {
					let r = rules1[_g];
					++_g;
					if (!Check.isNullable(r)) {
						return CheckResult.CMissing(r);
					};
				};
				return CheckResult.CMatch;
				break
			default:
			let found1 = false;
			let x2 = it;
			while (x2.hasNext()) {
				let x = x2.next();
				if (Check.isBlank(x)) {
					continue;
				};
				let m = Check.check(x, r);
				if (m != CheckResult.CMatch) {
					return m;
				};
				found1 = true;
				break;
			};
			if (!found1) {
				if (r._hx_index == 5) {
					let _g = r.rule;
				} else {
					return CheckResult.CMissing(r);
				};
			};
			let x3 = it;
			while (x3.hasNext()) {
				let x = x3.next();
				if (Check.isBlank(x)) {
					continue;
				};
				return CheckResult.CExtra(x);
			};
			return CheckResult.CMatch;
			
		};
	}
	static makeWhere(path) {
		if (path.length == 0) {
			return "";
		};
		let s = "In ";
		let first = true;
		let _g = 0;
		while (_g < path.length) {
			let x = path[_g];
			++_g;
			if (first) {
				first = false;
			} else {
				s += ".";
			};
			if (x.nodeType != Xml.Element) {
				throw Exception.thrown("Bad node type, expected Element but found " + ((x.nodeType == null) ? "null" : XmlType_Impl_.toString(x.nodeType)));
			};
			s += x.nodeName;
		};
		return s + ": ";
	}
	static makeString(x) {
		if (x.nodeType == Xml.Element) {
			if (x.nodeType != Xml.Element) {
				throw Exception.thrown("Bad node type, expected Element but found " + ((x.nodeType == null) ? "null" : XmlType_Impl_.toString(x.nodeType)));
			};
			return "element " + x.nodeName;
		};
		if (x.nodeType == Xml.Document || x.nodeType == Xml.Element) {
			throw Exception.thrown("Bad node type, unexpected " + ((x.nodeType == null) ? "null" : XmlType_Impl_.toString(x.nodeType)));
		};
		let s = x.nodeValue.split("\r").join("\\r").split("\n").join("\\n").split("\t").join("\\t");
		if (s.length > 20) {
			return HxOverrides.substr(s, 0, 17) + "...";
		};
		return s;
	}
	static makeRule(r) {
		switch (r._hx_index) {
			case 0:
				let _g = r.childs;
				let _g1 = r.attribs;
				let name = r.name;
				return "element " + name;
				break
			case 1:
				let _g2 = r.filter;
				return "data";
				break
			case 2:
				let _g3 = r.atLeastOne;
				let r1 = r.rule;
				return Check.makeRule(r1);
				break
			case 3:
				let _g4 = r.ordered;
				let rules = r.rules;
				return Check.makeRule(rules[0]);
				break
			case 4:
				let choices = r.choices;
				return Check.makeRule(choices[0]);
				break
			case 5:
				let r2 = r.rule;
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
				throw Exception.thrown("assert");
				break
			case 1:
				let r = m.r;
				return Check.makeWhere(path) + "Missing " + Check.makeRule(r);
				break
			case 2:
				let x = m.x;
				return Check.makeWhere(path) + "Unexpected " + Check.makeString(x);
				break
			case 3:
				let x1 = m.x;
				let name = m.name;
				return Check.makeWhere(path) + Check.makeString(x1) + " while expected element " + name;
				break
			case 4:
				let x2 = m.x;
				return Check.makeWhere(path) + Check.makeString(x2) + " while data expected";
				break
			case 5:
				let x3 = m.x;
				let att = m.att;
				path.push(x3);
				return Check.makeWhere(path) + "unexpected attribute " + att;
				break
			case 6:
				let x4 = m.x;
				let att1 = m.att;
				path.push(x4);
				return Check.makeWhere(path) + "missing required attribute " + att1;
				break
			case 7:
				let _g = m.f;
				let x5 = m.x;
				let att2 = m.att;
				path.push(x5);
				return Check.makeWhere(path) + "invalid attribute value for " + att2;
				break
			case 8:
				let _g1 = m.f;
				let x6 = m.x;
				return Check.makeWhere(path) + "invalid data format for " + Check.makeString(x6);
				break
			case 9:
				let m1 = m.r;
				let x7 = m.x;
				path.push(x7);
				return Check.makeError(m1, path);
				break
			
		};
	}
	static checkNode(x, r) {
		let m = Check.checkList(new ArrayIterator([x]), r);
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
			throw Exception.thrown("Bad node type, expected Element or Document but found " + ((x.nodeType == null) ? "null" : XmlType_Impl_.toString(x.nodeType)));
		};
		let m = Check.checkList(new ArrayIterator(x.children), r);
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