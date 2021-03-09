import {HaxeError} from "../../js/Boot.js"
import {NodeListAccess_Impl_, Access_Impl_, AttribAccess_Impl_, HasAttribAccess_Impl_, HasNodeAccess_Impl_, NodeAccess_Impl_} from "../xml/Access.js"
import {TypeApi, Rights, TypeTree, CType} from "./CType.js"
import {StringMap} from "../ds/StringMap.js"
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
			var n1;
			if (e1._hx_index == 0) {
				var _g2 = e1.subs;
				var _g1 = e1.full;
				var p = e1.name;
				n1 = " " + p;
			} else {
				n1 = TypeApi.typeInfos(e1).path;
			};
			var n2;
			if (e2._hx_index == 0) {
				var _g5 = e2.subs;
				var _g4 = e2.full;
				var p1 = e2.name;
				n2 = " " + p1;
			} else {
				n2 = TypeApi.typeInfos(e2).path;
			};
			if (n1 > n2) {
				return 1;
			};
			return -1;
		});
		var _g = 0;
		while (_g < l.length) {
			var x = l[_g];
			++_g;
			switch (x._hx_index) {
				case 0:
					var _g21 = x.full;
					var _g11 = x.name;
					var l1 = x.subs;
					this.sort(l1);
					break
				case 1:
					var c = x.c;
					this.sortFields(c.fields);
					this.sortFields(c.statics);
					break
				case 2:
					var _g3 = x.e;
					break
				case 3:
					var _g51 = x.t;
					break
				case 4:
					var _g41 = x.a;
					break
				
			};
		};
	}
	sortFields(a) {
		a.sort(function (f1, f2) {
			var v1 = TypeApi.isVar(f1.type);
			var v2 = TypeApi.isVar(f2.type);
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
			throw new HaxeError("Invalid nodeType " + XmlType_Impl_.toString(x.nodeType));
		};
		var this1 = x;
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
		var _g = 0;
		var _g1 = c2.fields;
		while (_g < _g1.length) {
			var f2 = _g1[_g];
			++_g;
			var found = null;
			var _g2 = 0;
			var _g11 = c.fields;
			while (_g2 < _g11.length) {
				var f = _g11[_g2];
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
		var _g21 = 0;
		var _g3 = c2.statics;
		while (_g21 < _g3.length) {
			var f21 = _g3[_g21];
			++_g21;
			var found1 = null;
			var _g22 = 0;
			var _g31 = c.statics;
			while (_g22 < _g31.length) {
				var f1 = _g31[_g22];
				++_g22;
				if (this.mergeFields(f1, f21)) {
					found1 = f1;
					break;
				};
			};
			if (found1 == null) {
				this.newField(c, f21);
				c.statics.push(f21);
			} else if (this.curplatform != null) {
				found1.platforms.push(this.curplatform);
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
		var _g = 0;
		var _g1 = e2.constructors;
		while (_g < _g1.length) {
			var c2 = _g1[_g];
			++_g;
			var found = null;
			var _g2 = 0;
			var _g11 = e.constructors;
			while (_g2 < _g11.length) {
				var c = _g11[_g2];
				++_g2;
				if (TypeApi.constructorEq(c, c2)) {
					found = c;
					break;
				};
			};
			if (found == null) {
				return false;
			};
			if (this.curplatform != null) {
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
		var _g = 0;
		var _g1 = a.to.length;
		while (_g < _g1) {
			var i = _g++;
			if (!TypeApi.typeEq(a.to[i].t, a2.to[i].t)) {
				return false;
			};
		};
		var _g2 = 0;
		var _g3 = a.from.length;
		while (_g2 < _g3) {
			var i1 = _g2++;
			if (!TypeApi.typeEq(a.from[i1].t, a2.from[i1].t)) {
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
		var inf = TypeApi.typeInfos(t);
		var pack = inf.path.split(".");
		var cur = this.root;
		var curpack = new Array();
		pack.pop();
		var _g = 0;
		while (_g < pack.length) {
			var p = pack[_g];
			++_g;
			var found = false;
			var _g1 = 0;
			while (_g1 < cur.length) {
				var pk = cur[_g1];
				++_g1;
				if (pk._hx_index == 0) {
					var _g11 = pk.full;
					var subs = pk.subs;
					var pname = pk.name;
					if (pname == p) {
						found = true;
						cur = subs;
						break;
					};
				};
			};
			curpack.push(p);
			if (!found) {
				var pk1 = new Array();
				cur.push(TypeTree.TPackage(p, curpack.join("."), pk1));
				cur = pk1;
			};
		};
		var _g12 = 0;
		while (_g12 < cur.length) {
			var ct = cur[_g12];
			++_g12;
			var tmp;
			if (ct._hx_index == 0) {
				var _g3 = ct.subs;
				var _g2 = ct.full;
				var _g13 = ct.name;
				tmp = true;
			} else {
				tmp = false;
			};
			if (tmp) {
				continue;
			};
			var tinf = TypeApi.typeInfos(ct);
			if (tinf.path == inf.path) {
				var sameType = true;
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
							var _g8 = ct.subs;
							var _g7 = ct.full;
							var _g6 = ct.name;
							sameType = false;
							break
						case 1:
							var c = ct.c;
							if (t._hx_index == 1) {
								var c2 = t.c;
								if (this.mergeClasses(c, c2)) {
									return;
								};
							} else {
								sameType = false;
							};
							break
						case 2:
							var e = ct.e;
							if (t._hx_index == 2) {
								var e2 = t.e;
								if (this.mergeEnums(e, e2)) {
									return;
								};
							} else {
								sameType = false;
							};
							break
						case 3:
							var td = ct.t;
							if (t._hx_index == 3) {
								var td2 = t.t;
								if (this.mergeTypedefs(td, td2)) {
									return;
								};
							};
							break
						case 4:
							var a = ct.a;
							if (t._hx_index == 4) {
								var a2 = t.a;
								if (this.mergeAbstracts(a, a2)) {
									return;
								};
							} else {
								sameType = false;
							};
							break
						
					};
				};
				var msg = (tinf.module != inf.module) ? "module " + inf.module + " should be " + tinf.module : (tinf.doc != inf.doc) ? "documentation is different" : (tinf.isPrivate != inf.isPrivate) ? "private flag is different" : (!sameType) ? "type kind is different" : "could not merge definition";
				throw new HaxeError("Incompatibilities between " + tinf.path + " in " + tinf.platforms.join(",") + " and " + this.curplatform + " (" + msg + ")");
			};
		};
		cur.push(t);
	}
	mkPath(p) {
		return p;
	}
	mkTypeParams(p) {
		var pl = p.split(":");
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
		var tmp;
		if (c.nodeType == Xml.Document) {
			tmp = "Document";
		} else {
			if (c.nodeType != Xml.Element) {
				throw new HaxeError("Bad node type, expected Element but found " + XmlType_Impl_.toString(c.nodeType));
			};
			tmp = c.nodeName;
		};
		throw new HaxeError("Invalid " + tmp);
	}
	xroot(x) {
		var c = x.elements();
		while (c.hasNext()) {
			var c1 = c.next();
			this.merge(this.processElement(c1));
		};
	}
	processElement(x) {
		if (x.nodeType != Xml.Document && x.nodeType != Xml.Element) {
			throw new HaxeError("Invalid nodeType " + XmlType_Impl_.toString(x.nodeType));
		};
		var this1 = x;
		var c = this1;
		var _g;
		if (c.nodeType == Xml.Document) {
			_g = "Document";
		} else {
			if (c.nodeType != Xml.Element) {
				throw new HaxeError("Bad node type, expected Element but found " + XmlType_Impl_.toString(c.nodeType));
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
		var ml = [];
		var _g = 0;
		var _g1 = NodeListAccess_Impl_.resolve(x, "m");
		while (_g < _g1.length) {
			var m = _g1[_g];
			++_g;
			var pl = [];
			var _g2 = 0;
			var _g11 = NodeListAccess_Impl_.resolve(m, "e");
			while (_g2 < _g11.length) {
				var p = _g11[_g2];
				++_g2;
				pl.push(Access_Impl_.get_innerHTML(p));
			};
			ml.push({"name": AttribAccess_Impl_.resolve(m, "n"), "params": pl});
		};
		return ml;
	}
	xoverloads(x) {
		var l = new Array();
		var m = x.elements();
		while (m.hasNext()) {
			var m1 = m.next();
			l.push(this.xclassfield(m1));
		};
		return l;
	}
	xpath(x) {
		var path = this.mkPath(AttribAccess_Impl_.resolve(x, "path"));
		var params = new Array();
		var c = x.elements();
		while (c.hasNext()) {
			var c1 = c.next();
			params.push(this.xtype(c1));
		};
		return {"path": path, "params": params};
	}
	xclass(x) {
		var csuper = null;
		var doc = null;
		var tdynamic = null;
		var interfaces = new Array();
		var fields = new Array();
		var statics = new Array();
		var meta = [];
		var c = x.elements();
		while (c.hasNext()) {
			var c1 = c.next();
			var _g;
			if (c1.nodeType == Xml.Document) {
				_g = "Document";
			} else {
				if (c1.nodeType != Xml.Element) {
					throw new HaxeError("Bad node type, expected Element but found " + XmlType_Impl_.toString(c1.nodeType));
				};
				_g = c1.nodeName;
			};
			switch (_g) {
				case "extends":
					csuper = this.xpath(c1);
					break
				case "haxe_doc":
					doc = Access_Impl_.get_innerData(c1);
					break
				case "haxe_dynamic":
					var x1 = c1.firstElement();
					if (x1.nodeType != Xml.Document && x1.nodeType != Xml.Element) {
						throw new HaxeError("Invalid nodeType " + XmlType_Impl_.toString(x1.nodeType));
					};
					var this1 = x1;
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
		return {"file": (HasAttribAccess_Impl_.resolve(x, "file")) ? AttribAccess_Impl_.resolve(x, "file") : null, "path": this.mkPath(AttribAccess_Impl_.resolve(x, "path")), "module": (HasAttribAccess_Impl_.resolve(x, "module")) ? this.mkPath(AttribAccess_Impl_.resolve(x, "module")) : null, "doc": doc, "isPrivate": x.exists("private"), "isExtern": x.exists("extern"), "isInterface": x.exists("interface"), "params": this.mkTypeParams(AttribAccess_Impl_.resolve(x, "params")), "superClass": csuper, "interfaces": interfaces, "fields": fields, "statics": statics, "tdynamic": tdynamic, "platforms": this.defplat(), "meta": meta};
	}
	xclassfield(x, defPublic = false) {
		var e = x.elements();
		var t = this.xtype(e.next());
		var doc = null;
		var meta = [];
		var overloads = null;
		var c = e;
		while (c.hasNext()) {
			var c1 = c.next();
			var _g;
			if (c1.nodeType == Xml.Document) {
				_g = "Document";
			} else {
				if (c1.nodeType != Xml.Element) {
					throw new HaxeError("Bad node type, expected Element but found " + XmlType_Impl_.toString(c1.nodeType));
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
		var tmp;
		if (x.nodeType == Xml.Document) {
			tmp = "Document";
		} else {
			if (x.nodeType != Xml.Element) {
				throw new HaxeError("Bad node type, expected Element but found " + XmlType_Impl_.toString(x.nodeType));
			};
			tmp = x.nodeName;
		};
		return {"name": tmp, "type": t, "isPublic": x.exists("public") || defPublic, "isFinal": x.exists("final"), "isOverride": x.exists("override"), "line": (HasAttribAccess_Impl_.resolve(x, "line")) ? Std.parseInt(AttribAccess_Impl_.resolve(x, "line")) : null, "doc": doc, "get": (HasAttribAccess_Impl_.resolve(x, "get")) ? this.mkRights(AttribAccess_Impl_.resolve(x, "get")) : Rights.RNormal, "set": (HasAttribAccess_Impl_.resolve(x, "set")) ? this.mkRights(AttribAccess_Impl_.resolve(x, "set")) : Rights.RNormal, "params": (HasAttribAccess_Impl_.resolve(x, "params")) ? this.mkTypeParams(AttribAccess_Impl_.resolve(x, "params")) : [], "platforms": this.defplat(), "meta": meta, "overloads": overloads, "expr": (HasAttribAccess_Impl_.resolve(x, "expr")) ? AttribAccess_Impl_.resolve(x, "expr") : null};
	}
	xenum(x) {
		var cl = new Array();
		var doc = null;
		var meta = [];
		var c = x.elements();
		while (c.hasNext()) {
			var c1 = c.next();
			var tmp;
			if (c1.nodeType == Xml.Document) {
				tmp = "Document";
			} else {
				if (c1.nodeType != Xml.Element) {
					throw new HaxeError("Bad node type, expected Element but found " + XmlType_Impl_.toString(c1.nodeType));
				};
				tmp = c1.nodeName;
			};
			if (tmp == "haxe_doc") {
				doc = Access_Impl_.get_innerData(c1);
			} else {
				var tmp1;
				if (c1.nodeType == Xml.Document) {
					tmp1 = "Document";
				} else {
					if (c1.nodeType != Xml.Element) {
						throw new HaxeError("Bad node type, expected Element but found " + XmlType_Impl_.toString(c1.nodeType));
					};
					tmp1 = c1.nodeName;
				};
				if (tmp1 == "meta") {
					meta = this.xmeta(c1);
				} else {
					cl.push(this.xenumfield(c1));
				};
			};
		};
		return {"file": (HasAttribAccess_Impl_.resolve(x, "file")) ? AttribAccess_Impl_.resolve(x, "file") : null, "path": this.mkPath(AttribAccess_Impl_.resolve(x, "path")), "module": (HasAttribAccess_Impl_.resolve(x, "module")) ? this.mkPath(AttribAccess_Impl_.resolve(x, "module")) : null, "doc": doc, "isPrivate": x.exists("private"), "isExtern": x.exists("extern"), "params": this.mkTypeParams(AttribAccess_Impl_.resolve(x, "params")), "constructors": cl, "platforms": this.defplat(), "meta": meta};
	}
	xenumfield(x) {
		var args = null;
		var docElements = x.elementsNamed("haxe_doc");
		var xdoc = (docElements.hasNext()) ? docElements.next() : null;
		var meta = (HasNodeAccess_Impl_.resolve(x, "meta")) ? this.xmeta(NodeAccess_Impl_.resolve(x, "meta")) : [];
		if (HasAttribAccess_Impl_.resolve(x, "a")) {
			var names = AttribAccess_Impl_.resolve(x, "a").split(":");
			var elts = x.elements();
			args = new Array();
			var _g = 0;
			while (_g < names.length) {
				var c = names[_g];
				++_g;
				var opt = false;
				if (c.charAt(0) == "?") {
					opt = true;
					c = HxOverrides.substr(c, 1, null);
				};
				args.push({"name": c, "opt": opt, "t": this.xtype(elts.next())});
			};
		};
		var tmp;
		if (x.nodeType == Xml.Document) {
			tmp = "Document";
		} else {
			if (x.nodeType != Xml.Element) {
				throw new HaxeError("Bad node type, expected Element but found " + XmlType_Impl_.toString(x.nodeType));
			};
			tmp = x.nodeName;
		};
		var tmp1;
		if (xdoc == null) {
			tmp1 = null;
		} else {
			if (xdoc.nodeType != Xml.Document && xdoc.nodeType != Xml.Element) {
				throw new HaxeError("Invalid nodeType " + XmlType_Impl_.toString(xdoc.nodeType));
			};
			var this1 = xdoc;
			tmp1 = Access_Impl_.get_innerData(this1);
		};
		return {"name": tmp, "args": args, "doc": tmp1, "meta": meta, "platforms": this.defplat()};
	}
	xabstract(x) {
		var doc = null;
		var impl = null;
		var athis = null;
		var meta = [];
		var to = [];
		var from = [];
		var c = x.elements();
		while (c.hasNext()) {
			var c1 = c.next();
			var _g;
			if (c1.nodeType == Xml.Document) {
				_g = "Document";
			} else {
				if (c1.nodeType != Xml.Element) {
					throw new HaxeError("Bad node type, expected Element but found " + XmlType_Impl_.toString(c1.nodeType));
				};
				_g = c1.nodeName;
			};
			switch (_g) {
				case "from":
					var t = c1.elements();
					while (t.hasNext()) {
						var t1 = t.next();
						var x1 = t1.firstElement();
						if (x1.nodeType != Xml.Document && x1.nodeType != Xml.Element) {
							throw new HaxeError("Invalid nodeType " + XmlType_Impl_.toString(x1.nodeType));
						};
						var this1 = x1;
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
					var x2 = c1.firstElement();
					if (x2.nodeType != Xml.Document && x2.nodeType != Xml.Element) {
						throw new HaxeError("Invalid nodeType " + XmlType_Impl_.toString(x2.nodeType));
					};
					var this2 = x2;
					athis = this.xtype(this2);
					break
				case "to":
					var t2 = c1.elements();
					while (t2.hasNext()) {
						var t3 = t2.next();
						var x3 = t3.firstElement();
						if (x3.nodeType != Xml.Document && x3.nodeType != Xml.Element) {
							throw new HaxeError("Invalid nodeType " + XmlType_Impl_.toString(x3.nodeType));
						};
						var this3 = x3;
						to.push({"t": this.xtype(this3), "field": (HasAttribAccess_Impl_.resolve(t3, "field")) ? AttribAccess_Impl_.resolve(t3, "field") : null});
					};
					break
				default:
				this.xerror(c1);
				
			};
		};
		return {"file": (HasAttribAccess_Impl_.resolve(x, "file")) ? AttribAccess_Impl_.resolve(x, "file") : null, "path": this.mkPath(AttribAccess_Impl_.resolve(x, "path")), "module": (HasAttribAccess_Impl_.resolve(x, "module")) ? this.mkPath(AttribAccess_Impl_.resolve(x, "module")) : null, "doc": doc, "isPrivate": x.exists("private"), "params": this.mkTypeParams(AttribAccess_Impl_.resolve(x, "params")), "platforms": this.defplat(), "meta": meta, "athis": athis, "to": to, "from": from, "impl": impl};
	}
	xtypedef(x) {
		var doc = null;
		var t = null;
		var meta = [];
		var c = x.elements();
		while (c.hasNext()) {
			var c1 = c.next();
			var tmp;
			if (c1.nodeType == Xml.Document) {
				tmp = "Document";
			} else {
				if (c1.nodeType != Xml.Element) {
					throw new HaxeError("Bad node type, expected Element but found " + XmlType_Impl_.toString(c1.nodeType));
				};
				tmp = c1.nodeName;
			};
			if (tmp == "haxe_doc") {
				doc = Access_Impl_.get_innerData(c1);
			} else {
				var tmp1;
				if (c1.nodeType == Xml.Document) {
					tmp1 = "Document";
				} else {
					if (c1.nodeType != Xml.Element) {
						throw new HaxeError("Bad node type, expected Element but found " + XmlType_Impl_.toString(c1.nodeType));
					};
					tmp1 = c1.nodeName;
				};
				if (tmp1 == "meta") {
					meta = this.xmeta(c1);
				} else {
					t = this.xtype(c1);
				};
			};
		};
		var types = new StringMap();
		if (this.curplatform != null) {
			types.inst.set(this.curplatform, t);
		};
		return {"file": (HasAttribAccess_Impl_.resolve(x, "file")) ? AttribAccess_Impl_.resolve(x, "file") : null, "path": this.mkPath(AttribAccess_Impl_.resolve(x, "path")), "module": (HasAttribAccess_Impl_.resolve(x, "module")) ? this.mkPath(AttribAccess_Impl_.resolve(x, "module")) : null, "doc": doc, "isPrivate": x.exists("private"), "params": this.mkTypeParams(AttribAccess_Impl_.resolve(x, "params")), "type": t, "types": types, "platforms": this.defplat(), "meta": meta};
	}
	xtype(x) {
		var _g;
		if (x.nodeType == Xml.Document) {
			_g = "Document";
		} else {
			if (x.nodeType != Xml.Element) {
				throw new HaxeError("Bad node type, expected Element but found " + XmlType_Impl_.toString(x.nodeType));
			};
			_g = x.nodeName;
		};
		switch (_g) {
			case "a":
				var fields = new Array();
				var f = x.elements();
				while (f.hasNext()) {
					var f1 = f.next();
					var f2 = this.xclassfield(f1, true);
					f2.platforms = new Array();
					fields.push(f2);
				};
				return CType.CAnonymous(fields);
				break
			case "c":
				return CType.CClass(this.mkPath(AttribAccess_Impl_.resolve(x, "path")), this.xtypeparams(x));
				break
			case "d":
				var t = null;
				var tx = x.firstElement();
				if (tx != null) {
					if (tx.nodeType != Xml.Document && tx.nodeType != Xml.Element) {
						throw new HaxeError("Invalid nodeType " + XmlType_Impl_.toString(tx.nodeType));
					};
					var this1 = tx;
					t = this.xtype(this1);
				};
				return CType.CDynamic(t);
				break
			case "e":
				return CType.CEnum(this.mkPath(AttribAccess_Impl_.resolve(x, "path")), this.xtypeparams(x));
				break
			case "f":
				var args = new Array();
				var aname = AttribAccess_Impl_.resolve(x, "a").split(":");
				var eargs = HxOverrides.iter(aname);
				var evalues = (HasAttribAccess_Impl_.resolve(x, "v")) ? HxOverrides.iter(AttribAccess_Impl_.resolve(x, "v").split(":")) : null;
				var e = x.elements();
				while (e.hasNext()) {
					var e1 = e.next();
					var opt = false;
					var a = (eargs.hasNext()) ? eargs.next() : null;
					if (a == null) {
						a = "";
					};
					if (a.charAt(0) == "?") {
						opt = true;
						a = HxOverrides.substr(a, 1, null);
					};
					var v = (evalues == null || !evalues.hasNext()) ? null : evalues.next();
					args.push({"name": a, "opt": opt, "t": this.xtype(e1), "value": (v == "") ? null : v});
				};
				var ret = args[args.length - 1];
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
		var p = new Array();
		var c = x.elements();
		while (c.hasNext()) {
			var c1 = c.next();
			p.push(this.xtype(c1));
		};
		return p;
	}
	defplat() {
		var l = new Array();
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