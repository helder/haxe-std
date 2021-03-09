import {NodeListAccess_Impl_, Access_Impl_, AttribAccess_Impl_, HasAttribAccess_Impl_, HasNodeAccess_Impl_, NodeAccess_Impl_} from "../xml/Access.js"
import {TypeApi, Rights, TypeTree, CType} from "./CType.js"
import {ArrayIterator} from "../iterators/ArrayIterator.js"
import {StringMap} from "../ds/StringMap.js"
import {Exception} from "../Exception.js"
import {Register} from "../../genes/Register.js"
import {Xml, XmlType_Impl_} from "../../Xml.js"
import {Type} from "../../Type.js"
import {Std} from "../../Std.js"
import {HxOverrides} from "../../HxOverrides.js"

/**
XmlParser processes the runtime type information (RTTI) which
is stored as a XML string in a static field `__rtti`.

@see <https://haxe.org/manual/cr-rtti.html>
*/
export const XmlParser = Register.global("$hxClasses")["haxe.rtti.XmlParser"] = 
class XmlParser extends Register.inherits() {
	new() {
		this.root = new Array();
	}
	sort(l = null) {
		if (l == null) {
			l = this.root;
		};
		l.sort(function (e1, e2) {
			let n1;
			if (e1._hx_index == 0) {
				let _g = e1.subs;
				let _g1 = e1.full;
				let p = e1.name;
				n1 = " " + p;
			} else {
				n1 = TypeApi.typeInfos(e1).path;
			};
			let n2;
			if (e2._hx_index == 0) {
				let _g = e2.subs;
				let _g1 = e2.full;
				let p = e2.name;
				n2 = " " + p;
			} else {
				n2 = TypeApi.typeInfos(e2).path;
			};
			if (n1 > n2) {
				return 1;
			};
			return -1;
		});
		let _g = 0;
		while (_g < l.length) {
			let x = l[_g];
			++_g;
			switch (x._hx_index) {
				case 0:
					let _g1 = x.full;
					let _g2 = x.name;
					let l1 = x.subs;
					this.sort(l1);
					break
				case 1:
					let c = x.c;
					this.sortFields(c.fields);
					this.sortFields(c.statics);
					break
				case 2:
					let _g3 = x.e;
					break
				case 3:
					let _g4 = x.t;
					break
				case 4:
					let _g5 = x.a;
					break
				
			};
		};
	}
	sortFields(a) {
		a.sort(function (f1, f2) {
			let v1 = TypeApi.isVar(f1.type);
			let v2 = TypeApi.isVar(f2.type);
			if (v1 && !v2) {
				return -1;
			};
			if (v2 && !v1) {
				return 1;
			};
			if (f1.name == "new") {
				return -1;
			};
			if (f2.name == "new") {
				return 1;
			};
			if (f1.name > f2.name) {
				return 1;
			};
			return -1;
		});
	}
	process(x, platform) {
		this.curplatform = platform;
		if (x.nodeType != Xml.Document && x.nodeType != Xml.Element) {
			throw Exception.thrown("Invalid nodeType " + ((x.nodeType == null) ? "null" : XmlType_Impl_.toString(x.nodeType)));
		};
		let this1 = x;
		this.xroot(this1);
	}
	mergeRights(f1, f2) {
		if (f1.get == Rights.RInline && f1.set == Rights.RNo && f2.get == Rights.RNormal && f2.set == Rights.RMethod) {
			f1.get = Rights.RNormal;
			f1.set = Rights.RMethod;
			return true;
		};
		if (Type.enumEq(f1.get, f2.get)) {
			return Type.enumEq(f1.set, f2.set);
		} else {
			return false;
		};
	}
	mergeDoc(f1, f2) {
		if (f1.doc == null) {
			f1.doc = f2.doc;
		} else if (f2.doc == null) {
			f2.doc = f1.doc;
		};
		return true;
	}
	mergeFields(f, f2) {
		if (!TypeApi.fieldEq(f, f2)) {
			if (f.name == f2.name && (this.mergeRights(f, f2) || this.mergeRights(f2, f)) && this.mergeDoc(f, f2)) {
				return TypeApi.fieldEq(f, f2);
			} else {
				return false;
			};
		} else {
			return true;
		};
	}
	newField(c, f) {
	}
	mergeClasses(c, c2) {
		if (c.isInterface != c2.isInterface) {
			return false;
		};
		if (this.curplatform != null) {
			c.platforms.push(this.curplatform);
		};
		if (c.isExtern != c2.isExtern) {
			c.isExtern = false;
		};
		let _g = 0;
		let _g1 = c2.fields;
		while (_g < _g1.length) {
			let f2 = _g1[_g];
			++_g;
			let found = null;
			let _g2 = 0;
			let _g3 = c.fields;
			while (_g2 < _g3.length) {
				let f = _g3[_g2];
				++_g2;
				if (this.mergeFields(f, f2)) {
					found = f;
					break;
				};
			};
			if (found == null) {
				this.newField(c, f2);
				c.fields.push(f2);
			} else if (this.curplatform != null) {
				found.platforms.push(this.curplatform);
			};
		};
		let _g2 = 0;
		let _g3 = c2.statics;
		while (_g2 < _g3.length) {
			let f2 = _g3[_g2];
			++_g2;
			let found = null;
			let _g = 0;
			let _g1 = c.statics;
			while (_g < _g1.length) {
				let f = _g1[_g];
				++_g;
				if (this.mergeFields(f, f2)) {
					found = f;
					break;
				};
			};
			if (found == null) {
				this.newField(c, f2);
				c.statics.push(f2);
			} else if (this.curplatform != null) {
				found.platforms.push(this.curplatform);
			};
		};
		return true;
	}
	mergeEnums(e, e2) {
		if (e.isExtern != e2.isExtern) {
			return false;
		};
		if (this.curplatform != null) {
			e.platforms.push(this.curplatform);
		};
		let _g = 0;
		let _g1 = e2.constructors;
		while (_g < _g1.length) {
			let c2 = _g1[_g];
			++_g;
			let found = null;
			let _g2 = 0;
			let _g3 = e.constructors;
			while (_g2 < _g3.length) {
				let c = _g3[_g2];
				++_g2;
				if (TypeApi.constructorEq(c, c2)) {
					found = c;
					break;
				};
			};
			if (found == null) {
				e.constructors.push(c2);
			} else if (this.curplatform != null) {
				found.platforms.push(this.curplatform);
			};
		};
		return true;
	}
	mergeTypedefs(t, t2) {
		if (this.curplatform == null) {
			return false;
		};
		t.platforms.push(this.curplatform);
		t.types.inst.set(this.curplatform, t2.type);
		return true;
	}
	mergeAbstracts(a, a2) {
		if (this.curplatform == null) {
			return false;
		};
		if (a.to.length != a2.to.length || a.from.length != a2.from.length) {
			return false;
		};
		let _g = 0;
		let _g1 = a.to.length;
		while (_g < _g1) {
			let i = _g++;
			if (!TypeApi.typeEq(a.to[i].t, a2.to[i].t)) {
				return false;
			};
		};
		let _g2 = 0;
		let _g3 = a.from.length;
		while (_g2 < _g3) {
			let i = _g2++;
			if (!TypeApi.typeEq(a.from[i].t, a2.from[i].t)) {
				return false;
			};
		};
		if (a2.impl != null) {
			this.mergeClasses(a.impl, a2.impl);
		};
		a.platforms.push(this.curplatform);
		return true;
	}
	merge(t) {
		let inf = TypeApi.typeInfos(t);
		let pack = inf.path.split(".");
		let cur = this.root;
		let curpack = new Array();
		pack.pop();
		let _g = 0;
		while (_g < pack.length) {
			let p = pack[_g];
			++_g;
			let found = false;
			let _g1 = 0;
			while (_g1 < cur.length) {
				let pk = cur[_g1];
				++_g1;
				if (pk._hx_index == 0) {
					let _g = pk.full;
					let subs = pk.subs;
					let pname = pk.name;
					if (pname == p) {
						found = true;
						cur = subs;
						break;
					};
				};
			};
			curpack.push(p);
			if (!found) {
				let pk = new Array();
				cur.push(TypeTree.TPackage(p, curpack.join("."), pk));
				cur = pk;
			};
		};
		let _g1 = 0;
		while (_g1 < cur.length) {
			let ct = cur[_g1];
			++_g1;
			let tmp;
			if (ct._hx_index == 0) {
				let _g = ct.subs;
				let _g1 = ct.full;
				let _g2 = ct.name;
				tmp = true;
			} else {
				tmp = false;
			};
			if (tmp) {
				continue;
			};
			let tinf = TypeApi.typeInfos(ct);
			if (tinf.path == inf.path) {
				let sameType = true;
				if (tinf.doc == null != (inf.doc == null)) {
					if (inf.doc == null) {
						inf.doc = tinf.doc;
					} else {
						tinf.doc = inf.doc;
					};
				};
				if (tinf.path == "haxe._Int64.NativeInt64") {
					continue;
				};
				if (tinf.module == inf.module && tinf.doc == inf.doc && tinf.isPrivate == inf.isPrivate) {
					switch (ct._hx_index) {
						case 0:
							let _g = ct.subs;
							let _g1 = ct.full;
							let _g2 = ct.name;
							sameType = false;
							break
						case 1:
							let c = ct.c;
							if (t._hx_index == 1) {
								let c2 = t.c;
								if (this.mergeClasses(c, c2)) {
									return;
								};
							} else {
								sameType = false;
							};
							break
						case 2:
							let e = ct.e;
							if (t._hx_index == 2) {
								let e2 = t.e;
								if (this.mergeEnums(e, e2)) {
									return;
								};
							} else {
								sameType = false;
							};
							break
						case 3:
							let td = ct.t;
							if (t._hx_index == 3) {
								let td2 = t.t;
								if (this.mergeTypedefs(td, td2)) {
									return;
								};
							};
							break
						case 4:
							let a = ct.a;
							if (t._hx_index == 4) {
								let a2 = t.a;
								if (this.mergeAbstracts(a, a2)) {
									return;
								};
							} else {
								sameType = false;
							};
							break
						
					};
				};
				let msg = (tinf.module != inf.module) ? "module " + inf.module + " should be " + tinf.module : (tinf.doc != inf.doc) ? "documentation is different" : (tinf.isPrivate != inf.isPrivate) ? "private flag is different" : (!sameType) ? "type kind is different" : "could not merge definition";
				throw Exception.thrown("Incompatibilities between " + tinf.path + " in " + tinf.platforms.join(",") + " and " + this.curplatform + " (" + msg + ")");
			};
		};
		cur.push(t);
	}
	mkPath(p) {
		return p;
	}
	mkTypeParams(p) {
		let pl = p.split(":");
		if (pl[0] == "") {
			return new Array();
		};
		return pl;
	}
	mkRights(r) {
		switch (r) {
			case "dynamic":
				return Rights.RDynamic;
				break
			case "inline":
				return Rights.RInline;
				break
			case "method":
				return Rights.RMethod;
				break
			case "null":
				return Rights.RNo;
				break
			default:
			return Rights.RCall(r);
			
		};
	}
	xerror(c) {
		let tmp;
		if (c.nodeType == Xml.Document) {
			tmp = "Document";
		} else {
			if (c.nodeType != Xml.Element) {
				throw Exception.thrown("Bad node type, expected Element but found " + ((c.nodeType == null) ? "null" : XmlType_Impl_.toString(c.nodeType)));
			};
			tmp = c.nodeName;
		};
		throw Exception.thrown("Invalid " + tmp);
	}
	xroot(x) {
		let c = x.elements();
		while (c.hasNext()) {
			let c1 = c.next();
			this.merge(this.processElement(c1));
		};
	}
	processElement(x) {
		if (x.nodeType != Xml.Document && x.nodeType != Xml.Element) {
			throw Exception.thrown("Invalid nodeType " + ((x.nodeType == null) ? "null" : XmlType_Impl_.toString(x.nodeType)));
		};
		let this1 = x;
		let c = this1;
		let _g;
		if (c.nodeType == Xml.Document) {
			_g = "Document";
		} else {
			if (c.nodeType != Xml.Element) {
				throw Exception.thrown("Bad node type, expected Element but found " + ((c.nodeType == null) ? "null" : XmlType_Impl_.toString(c.nodeType)));
			};
			_g = c.nodeName;
		};
		switch (_g) {
			case "abstract":
				return TypeTree.TAbstractdecl(this.xabstract(c));
				break
			case "class":
				return TypeTree.TClassdecl(this.xclass(c));
				break
			case "enum":
				return TypeTree.TEnumdecl(this.xenum(c));
				break
			case "typedef":
				return TypeTree.TTypedecl(this.xtypedef(c));
				break
			default:
			return this.xerror(c);
			
		};
	}
	xmeta(x) {
		let ml = [];
		let _g = 0;
		let _g1 = NodeListAccess_Impl_.resolve(x, "m");
		while (_g < _g1.length) {
			let m = _g1[_g];
			++_g;
			let pl = [];
			let _g2 = 0;
			let _g3 = NodeListAccess_Impl_.resolve(m, "e");
			while (_g2 < _g3.length) {
				let p = _g3[_g2];
				++_g2;
				pl.push(Access_Impl_.get_innerHTML(p));
			};
			ml.push({"name": AttribAccess_Impl_.resolve(m, "n"), "params": pl});
		};
		return ml;
	}
	xoverloads(x) {
		let l = new Array();
		let m = x.elements();
		while (m.hasNext()) {
			let m1 = m.next();
			l.push(this.xclassfield(m1));
		};
		return l;
	}
	xpath(x) {
		let path = this.mkPath(AttribAccess_Impl_.resolve(x, "path"));
		let params = new Array();
		let c = x.elements();
		while (c.hasNext()) {
			let c1 = c.next();
			params.push(this.xtype(c1));
		};
		return {"path": path, "params": params};
	}
	xclass(x) {
		let csuper = null;
		let doc = null;
		let tdynamic = null;
		let interfaces = new Array();
		let fields = new Array();
		let statics = new Array();
		let meta = [];
		let isInterface = x.exists("interface");
		let c = x.elements();
		while (c.hasNext()) {
			let c1 = c.next();
			let _g;
			if (c1.nodeType == Xml.Document) {
				_g = "Document";
			} else {
				if (c1.nodeType != Xml.Element) {
					throw Exception.thrown("Bad node type, expected Element but found " + ((c1.nodeType == null) ? "null" : XmlType_Impl_.toString(c1.nodeType)));
				};
				_g = c1.nodeName;
			};
			switch (_g) {
				case "extends":
					if (isInterface) {
						interfaces.push(this.xpath(c1));
					} else {
						csuper = this.xpath(c1);
					};
					break
				case "haxe_doc":
					doc = Access_Impl_.get_innerData(c1);
					break
				case "haxe_dynamic":
					let x = c1.firstElement();
					if (x.nodeType != Xml.Document && x.nodeType != Xml.Element) {
						throw Exception.thrown("Invalid nodeType " + ((x.nodeType == null) ? "null" : XmlType_Impl_.toString(x.nodeType)));
					};
					let this1 = x;
					tdynamic = this.xtype(this1);
					break
				case "implements":
					interfaces.push(this.xpath(c1));
					break
				case "meta":
					meta = this.xmeta(c1);
					break
				default:
				if (c1.exists("static")) {
					statics.push(this.xclassfield(c1));
				} else {
					fields.push(this.xclassfield(c1));
				};
				
			};
		};
		return {"file": (HasAttribAccess_Impl_.resolve(x, "file")) ? AttribAccess_Impl_.resolve(x, "file") : null, "path": this.mkPath(AttribAccess_Impl_.resolve(x, "path")), "module": (HasAttribAccess_Impl_.resolve(x, "module")) ? this.mkPath(AttribAccess_Impl_.resolve(x, "module")) : null, "doc": doc, "isPrivate": x.exists("private"), "isExtern": x.exists("extern"), "isFinal": x.exists("final"), "isInterface": isInterface, "params": this.mkTypeParams(AttribAccess_Impl_.resolve(x, "params")), "superClass": csuper, "interfaces": interfaces, "fields": fields, "statics": statics, "tdynamic": tdynamic, "platforms": this.defplat(), "meta": meta};
	}
	xclassfield(x, defPublic = false) {
		let e = x.elements();
		let t = this.xtype(e.next());
		let doc = null;
		let meta = [];
		let overloads = null;
		let c = e;
		while (c.hasNext()) {
			let c1 = c.next();
			let _g;
			if (c1.nodeType == Xml.Document) {
				_g = "Document";
			} else {
				if (c1.nodeType != Xml.Element) {
					throw Exception.thrown("Bad node type, expected Element but found " + ((c1.nodeType == null) ? "null" : XmlType_Impl_.toString(c1.nodeType)));
				};
				_g = c1.nodeName;
			};
			switch (_g) {
				case "haxe_doc":
					doc = Access_Impl_.get_innerData(c1);
					break
				case "meta":
					meta = this.xmeta(c1);
					break
				case "overloads":
					overloads = this.xoverloads(c1);
					break
				default:
				this.xerror(c1);
				
			};
		};
		let tmp;
		if (x.nodeType == Xml.Document) {
			tmp = "Document";
		} else {
			if (x.nodeType != Xml.Element) {
				throw Exception.thrown("Bad node type, expected Element but found " + ((x.nodeType == null) ? "null" : XmlType_Impl_.toString(x.nodeType)));
			};
			tmp = x.nodeName;
		};
		return {"name": tmp, "type": t, "isPublic": x.exists("public") || defPublic, "isFinal": x.exists("final"), "isOverride": x.exists("override"), "line": (HasAttribAccess_Impl_.resolve(x, "line")) ? Std.parseInt(AttribAccess_Impl_.resolve(x, "line")) : null, "doc": doc, "get": (HasAttribAccess_Impl_.resolve(x, "get")) ? this.mkRights(AttribAccess_Impl_.resolve(x, "get")) : Rights.RNormal, "set": (HasAttribAccess_Impl_.resolve(x, "set")) ? this.mkRights(AttribAccess_Impl_.resolve(x, "set")) : Rights.RNormal, "params": (HasAttribAccess_Impl_.resolve(x, "params")) ? this.mkTypeParams(AttribAccess_Impl_.resolve(x, "params")) : [], "platforms": this.defplat(), "meta": meta, "overloads": overloads, "expr": (HasAttribAccess_Impl_.resolve(x, "expr")) ? AttribAccess_Impl_.resolve(x, "expr") : null};
	}
	xenum(x) {
		let cl = new Array();
		let doc = null;
		let meta = [];
		let c = x.elements();
		while (c.hasNext()) {
			let c1 = c.next();
			let tmp;
			if (c1.nodeType == Xml.Document) {
				tmp = "Document";
			} else {
				if (c1.nodeType != Xml.Element) {
					throw Exception.thrown("Bad node type, expected Element but found " + ((c1.nodeType == null) ? "null" : XmlType_Impl_.toString(c1.nodeType)));
				};
				tmp = c1.nodeName;
			};
			if (tmp == "haxe_doc") {
				doc = Access_Impl_.get_innerData(c1);
			} else {
				let tmp;
				if (c1.nodeType == Xml.Document) {
					tmp = "Document";
				} else {
					if (c1.nodeType != Xml.Element) {
						throw Exception.thrown("Bad node type, expected Element but found " + ((c1.nodeType == null) ? "null" : XmlType_Impl_.toString(c1.nodeType)));
					};
					tmp = c1.nodeName;
				};
				if (tmp == "meta") {
					meta = this.xmeta(c1);
				} else {
					cl.push(this.xenumfield(c1));
				};
			};
		};
		return {"file": (HasAttribAccess_Impl_.resolve(x, "file")) ? AttribAccess_Impl_.resolve(x, "file") : null, "path": this.mkPath(AttribAccess_Impl_.resolve(x, "path")), "module": (HasAttribAccess_Impl_.resolve(x, "module")) ? this.mkPath(AttribAccess_Impl_.resolve(x, "module")) : null, "doc": doc, "isPrivate": x.exists("private"), "isExtern": x.exists("extern"), "params": this.mkTypeParams(AttribAccess_Impl_.resolve(x, "params")), "constructors": cl, "platforms": this.defplat(), "meta": meta};
	}
	xenumfield(x) {
		let args = null;
		let docElements = x.elementsNamed("haxe_doc");
		let xdoc = (docElements.hasNext()) ? docElements.next() : null;
		let meta = (HasNodeAccess_Impl_.resolve(x, "meta")) ? this.xmeta(NodeAccess_Impl_.resolve(x, "meta")) : [];
		if (HasAttribAccess_Impl_.resolve(x, "a")) {
			let names = AttribAccess_Impl_.resolve(x, "a").split(":");
			let elts = x.elements();
			args = new Array();
			let _g = 0;
			while (_g < names.length) {
				let c = names[_g];
				++_g;
				let opt = false;
				if (c.charAt(0) == "?") {
					opt = true;
					c = HxOverrides.substr(c, 1, null);
				};
				args.push({"name": c, "opt": opt, "t": this.xtype(elts.next())});
			};
		};
		let tmp;
		if (x.nodeType == Xml.Document) {
			tmp = "Document";
		} else {
			if (x.nodeType != Xml.Element) {
				throw Exception.thrown("Bad node type, expected Element but found " + ((x.nodeType == null) ? "null" : XmlType_Impl_.toString(x.nodeType)));
			};
			tmp = x.nodeName;
		};
		let tmp1;
		if (xdoc == null) {
			tmp1 = null;
		} else {
			if (xdoc.nodeType != Xml.Document && xdoc.nodeType != Xml.Element) {
				throw Exception.thrown("Invalid nodeType " + ((xdoc.nodeType == null) ? "null" : XmlType_Impl_.toString(xdoc.nodeType)));
			};
			let this1 = xdoc;
			tmp1 = Access_Impl_.get_innerData(this1);
		};
		return {"name": tmp, "args": args, "doc": tmp1, "meta": meta, "platforms": this.defplat()};
	}
	xabstract(x) {
		let doc = null;
		let impl = null;
		let athis = null;
		let meta = [];
		let to = [];
		let from = [];
		let c = x.elements();
		while (c.hasNext()) {
			let c1 = c.next();
			let _g;
			if (c1.nodeType == Xml.Document) {
				_g = "Document";
			} else {
				if (c1.nodeType != Xml.Element) {
					throw Exception.thrown("Bad node type, expected Element but found " + ((c1.nodeType == null) ? "null" : XmlType_Impl_.toString(c1.nodeType)));
				};
				_g = c1.nodeName;
			};
			switch (_g) {
				case "from":
					let t = c1.elements();
					while (t.hasNext()) {
						let t1 = t.next();
						let x = t1.firstElement();
						if (x.nodeType != Xml.Document && x.nodeType != Xml.Element) {
							throw Exception.thrown("Invalid nodeType " + ((x.nodeType == null) ? "null" : XmlType_Impl_.toString(x.nodeType)));
						};
						let this1 = x;
						from.push({"t": this.xtype(this1), "field": (HasAttribAccess_Impl_.resolve(t1, "field")) ? AttribAccess_Impl_.resolve(t1, "field") : null});
					};
					break
				case "haxe_doc":
					doc = Access_Impl_.get_innerData(c1);
					break
				case "impl":
					impl = this.xclass(NodeAccess_Impl_.resolve(c1, "class"));
					break
				case "meta":
					meta = this.xmeta(c1);
					break
				case "this":
					let x = c1.firstElement();
					if (x.nodeType != Xml.Document && x.nodeType != Xml.Element) {
						throw Exception.thrown("Invalid nodeType " + ((x.nodeType == null) ? "null" : XmlType_Impl_.toString(x.nodeType)));
					};
					let this1 = x;
					athis = this.xtype(this1);
					break
				case "to":
					let t1 = c1.elements();
					while (t1.hasNext()) {
						let t = t1.next();
						let x = t.firstElement();
						if (x.nodeType != Xml.Document && x.nodeType != Xml.Element) {
							throw Exception.thrown("Invalid nodeType " + ((x.nodeType == null) ? "null" : XmlType_Impl_.toString(x.nodeType)));
						};
						let this1 = x;
						to.push({"t": this.xtype(this1), "field": (HasAttribAccess_Impl_.resolve(t, "field")) ? AttribAccess_Impl_.resolve(t, "field") : null});
					};
					break
				default:
				this.xerror(c1);
				
			};
		};
		return {"file": (HasAttribAccess_Impl_.resolve(x, "file")) ? AttribAccess_Impl_.resolve(x, "file") : null, "path": this.mkPath(AttribAccess_Impl_.resolve(x, "path")), "module": (HasAttribAccess_Impl_.resolve(x, "module")) ? this.mkPath(AttribAccess_Impl_.resolve(x, "module")) : null, "doc": doc, "isPrivate": x.exists("private"), "params": this.mkTypeParams(AttribAccess_Impl_.resolve(x, "params")), "platforms": this.defplat(), "meta": meta, "athis": athis, "to": to, "from": from, "impl": impl};
	}
	xtypedef(x) {
		let doc = null;
		let t = null;
		let meta = [];
		let c = x.elements();
		while (c.hasNext()) {
			let c1 = c.next();
			let tmp;
			if (c1.nodeType == Xml.Document) {
				tmp = "Document";
			} else {
				if (c1.nodeType != Xml.Element) {
					throw Exception.thrown("Bad node type, expected Element but found " + ((c1.nodeType == null) ? "null" : XmlType_Impl_.toString(c1.nodeType)));
				};
				tmp = c1.nodeName;
			};
			if (tmp == "haxe_doc") {
				doc = Access_Impl_.get_innerData(c1);
			} else {
				let tmp;
				if (c1.nodeType == Xml.Document) {
					tmp = "Document";
				} else {
					if (c1.nodeType != Xml.Element) {
						throw Exception.thrown("Bad node type, expected Element but found " + ((c1.nodeType == null) ? "null" : XmlType_Impl_.toString(c1.nodeType)));
					};
					tmp = c1.nodeName;
				};
				if (tmp == "meta") {
					meta = this.xmeta(c1);
				} else {
					t = this.xtype(c1);
				};
			};
		};
		let types = new StringMap();
		if (this.curplatform != null) {
			types.inst.set(this.curplatform, t);
		};
		return {"file": (HasAttribAccess_Impl_.resolve(x, "file")) ? AttribAccess_Impl_.resolve(x, "file") : null, "path": this.mkPath(AttribAccess_Impl_.resolve(x, "path")), "module": (HasAttribAccess_Impl_.resolve(x, "module")) ? this.mkPath(AttribAccess_Impl_.resolve(x, "module")) : null, "doc": doc, "isPrivate": x.exists("private"), "params": this.mkTypeParams(AttribAccess_Impl_.resolve(x, "params")), "type": t, "types": types, "platforms": this.defplat(), "meta": meta};
	}
	xtype(x) {
		let _g;
		if (x.nodeType == Xml.Document) {
			_g = "Document";
		} else {
			if (x.nodeType != Xml.Element) {
				throw Exception.thrown("Bad node type, expected Element but found " + ((x.nodeType == null) ? "null" : XmlType_Impl_.toString(x.nodeType)));
			};
			_g = x.nodeName;
		};
		switch (_g) {
			case "a":
				let fields = new Array();
				let f = x.elements();
				while (f.hasNext()) {
					let f1 = f.next();
					let f2 = this.xclassfield(f1, true);
					f2.platforms = new Array();
					fields.push(f2);
				};
				return CType.CAnonymous(fields);
				break
			case "c":
				return CType.CClass(this.mkPath(AttribAccess_Impl_.resolve(x, "path")), this.xtypeparams(x));
				break
			case "d":
				let t = null;
				let tx = x.firstElement();
				if (tx != null) {
					if (tx.nodeType != Xml.Document && tx.nodeType != Xml.Element) {
						throw Exception.thrown("Invalid nodeType " + ((tx.nodeType == null) ? "null" : XmlType_Impl_.toString(tx.nodeType)));
					};
					let this1 = tx;
					t = this.xtype(this1);
				};
				return CType.CDynamic(t);
				break
			case "e":
				return CType.CEnum(this.mkPath(AttribAccess_Impl_.resolve(x, "path")), this.xtypeparams(x));
				break
			case "f":
				let args = new Array();
				let aname = AttribAccess_Impl_.resolve(x, "a").split(":");
				let eargs_current = 0;
				let eargs_array = aname;
				let evalues = (HasAttribAccess_Impl_.resolve(x, "v")) ? new ArrayIterator(AttribAccess_Impl_.resolve(x, "v").split(":")) : null;
				let e = x.elements();
				while (e.hasNext()) {
					let e1 = e.next();
					let opt = false;
					let a = (eargs_current < eargs_array.length) ? eargs_array[eargs_current++] : null;
					if (a == null) {
						a = "";
					};
					if (a.charAt(0) == "?") {
						opt = true;
						a = HxOverrides.substr(a, 1, null);
					};
					let v = (evalues == null || evalues.current >= evalues.array.length) ? null : evalues.array[evalues.current++];
					args.push({"name": a, "opt": opt, "t": this.xtype(e1), "value": (v == "") ? null : v});
				};
				let ret = args[args.length - 1];
				HxOverrides.remove(args, ret);
				return CType.CFunction(args, ret.t);
				break
			case "t":
				return CType.CTypedef(this.mkPath(AttribAccess_Impl_.resolve(x, "path")), this.xtypeparams(x));
				break
			case "unknown":
				return CType.CUnknown;
				break
			case "x":
				return CType.CAbstract(this.mkPath(AttribAccess_Impl_.resolve(x, "path")), this.xtypeparams(x));
				break
			default:
			return this.xerror(x);
			
		};
	}
	xtypeparams(x) {
		let p = new Array();
		let c = x.elements();
		while (c.hasNext()) {
			let c1 = c.next();
			p.push(this.xtype(c1));
		};
		return p;
	}
	defplat() {
		let l = new Array();
		if (this.curplatform != null) {
			l.push(this.curplatform);
		};
		return l;
	}
	static get __name__() {
		return "haxe.rtti.XmlParser"
	}
	get __class__() {
		return XmlParser
	}
}


//# sourceMappingURL=XmlParser.js.map