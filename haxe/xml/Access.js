import {Printer} from "./Printer"
import {ArrayIterator} from "../iterators/ArrayIterator"
import {Exception} from "../Exception"
import {Register} from "../../genes/Register"
import {Xml, XmlType_Impl_} from "../../Xml"
import {StringTools} from "../../StringTools"
import {Std} from "../../Std"

export const NodeAccess_Impl_ = Register.global("$hxClasses")["haxe.xml._Access.NodeAccess_Impl_"] = 
class NodeAccess_Impl_ {
	static resolve(this1, name) {
		let x = this1.elementsNamed(name).next();
		if (x == null) {
			let xname;
			if (this1.nodeType == Xml.Document) {
				xname = "Document";
			} else {
				if (this1.nodeType != Xml.Element) {
					throw Exception.thrown("Bad node type, expected Element but found " + ((this1.nodeType == null) ? "null" : XmlType_Impl_.toString(this1.nodeType)));
				};
				xname = this1.nodeName;
			};
			throw Exception.thrown(xname + " is missing element " + name);
		};
		if (x.nodeType != Xml.Document && x.nodeType != Xml.Element) {
			throw Exception.thrown("Invalid nodeType " + ((x.nodeType == null) ? "null" : XmlType_Impl_.toString(x.nodeType)));
		};
		let this2 = x;
		return this2;
	}
	static get __name__() {
		return "haxe.xml._Access.NodeAccess_Impl_"
	}
	get __class__() {
		return NodeAccess_Impl_
	}
}


export const AttribAccess_Impl_ = Register.global("$hxClasses")["haxe.xml._Access.AttribAccess_Impl_"] = 
class AttribAccess_Impl_ {
	static resolve(this1, name) {
		if (this1.nodeType == Xml.Document) {
			throw Exception.thrown("Cannot access document attribute " + name);
		};
		let v = this1.get(name);
		if (v == null) {
			if (this1.nodeType != Xml.Element) {
				throw Exception.thrown("Bad node type, expected Element but found " + ((this1.nodeType == null) ? "null" : XmlType_Impl_.toString(this1.nodeType)));
			};
			throw Exception.thrown(this1.nodeName + " is missing attribute " + name);
		};
		return v;
	}
	static _hx_set(this1, name, value) {
		if (this1.nodeType == Xml.Document) {
			throw Exception.thrown("Cannot access document attribute " + name);
		};
		this1.set(name, value);
		return value;
	}
	static get __name__() {
		return "haxe.xml._Access.AttribAccess_Impl_"
	}
	get __class__() {
		return AttribAccess_Impl_
	}
}


export const HasAttribAccess_Impl_ = Register.global("$hxClasses")["haxe.xml._Access.HasAttribAccess_Impl_"] = 
class HasAttribAccess_Impl_ {
	static resolve(this1, name) {
		if (this1.nodeType == Xml.Document) {
			throw Exception.thrown("Cannot access document attribute " + name);
		};
		return this1.exists(name);
	}
	static get __name__() {
		return "haxe.xml._Access.HasAttribAccess_Impl_"
	}
	get __class__() {
		return HasAttribAccess_Impl_
	}
}


export const HasNodeAccess_Impl_ = Register.global("$hxClasses")["haxe.xml._Access.HasNodeAccess_Impl_"] = 
class HasNodeAccess_Impl_ {
	static resolve(this1, name) {
		return this1.elementsNamed(name).hasNext();
	}
	static get __name__() {
		return "haxe.xml._Access.HasNodeAccess_Impl_"
	}
	get __class__() {
		return HasNodeAccess_Impl_
	}
}


export const NodeListAccess_Impl_ = Register.global("$hxClasses")["haxe.xml._Access.NodeListAccess_Impl_"] = 
class NodeListAccess_Impl_ {
	static resolve(this1, name) {
		let l = [];
		let x = this1.elementsNamed(name);
		while (x.hasNext()) {
			let x1 = x.next();
			if (x1.nodeType != Xml.Document && x1.nodeType != Xml.Element) {
				throw Exception.thrown("Invalid nodeType " + ((x1.nodeType == null) ? "null" : XmlType_Impl_.toString(x1.nodeType)));
			};
			let this1 = x1;
			l.push(this1);
		};
		return l;
	}
	static get __name__() {
		return "haxe.xml._Access.NodeListAccess_Impl_"
	}
	get __class__() {
		return NodeListAccess_Impl_
	}
}


export const Access_Impl_ = Register.global("$hxClasses")["haxe.xml._Access.Access_Impl_"] = 
class Access_Impl_ {
	static get x() {
		return this.get_x()
	}
	static get_x(this1) {
		return this1;
	}
	static get name() {
		return this.get_name()
	}
	static get_name(this1) {
		if (this1.nodeType == Xml.Document) {
			return "Document";
		} else {
			if (this1.nodeType != Xml.Element) {
				throw Exception.thrown("Bad node type, expected Element but found " + ((this1.nodeType == null) ? "null" : XmlType_Impl_.toString(this1.nodeType)));
			};
			return this1.nodeName;
		};
	}
	static get innerData() {
		return this.get_innerData()
	}
	static get innerHTML() {
		return this.get_innerHTML()
	}
	static get node() {
		return this.get_node()
	}
	static get_node(this1) {
		return this1;
	}
	static get nodes() {
		return this.get_nodes()
	}
	static get_nodes(this1) {
		return this1;
	}
	static get att() {
		return this.get_att()
	}
	static get_att(this1) {
		return this1;
	}
	static get has() {
		return this.get_has()
	}
	static get_has(this1) {
		return this1;
	}
	static get hasNode() {
		return this.get_hasNode()
	}
	static get_hasNode(this1) {
		return this1;
	}
	static get elements() {
		return this.get_elements()
	}
	static get_elements(this1) {
		return this1.elements();
	}
	static _new(x) {
		if (x.nodeType != Xml.Document && x.nodeType != Xml.Element) {
			throw Exception.thrown("Invalid nodeType " + ((x.nodeType == null) ? "null" : XmlType_Impl_.toString(x.nodeType)));
		};
		let this1 = x;
		return this1;
	}
	static get_innerData(this1) {
		if (this1.nodeType != Xml.Document && this1.nodeType != Xml.Element) {
			throw Exception.thrown("Bad node type, expected Element or Document but found " + ((this1.nodeType == null) ? "null" : XmlType_Impl_.toString(this1.nodeType)));
		};
		let it = new ArrayIterator(this1.children);
		if (!it.hasNext()) {
			let tmp;
			if (this1.nodeType == Xml.Document) {
				tmp = "Document";
			} else {
				if (this1.nodeType != Xml.Element) {
					throw Exception.thrown("Bad node type, expected Element but found " + ((this1.nodeType == null) ? "null" : XmlType_Impl_.toString(this1.nodeType)));
				};
				tmp = this1.nodeName;
			};
			throw Exception.thrown(tmp + " does not have data");
		};
		let v = it.next();
		if (it.hasNext()) {
			let n = it.next();
			let tmp;
			if (v.nodeType == Xml.PCData && n.nodeType == Xml.CData) {
				if (v.nodeType == Xml.Document || v.nodeType == Xml.Element) {
					throw Exception.thrown("Bad node type, unexpected " + ((v.nodeType == null) ? "null" : XmlType_Impl_.toString(v.nodeType)));
				};
				tmp = StringTools.trim(v.nodeValue) == "";
			} else {
				tmp = false;
			};
			if (tmp) {
				if (!it.hasNext()) {
					if (n.nodeType == Xml.Document || n.nodeType == Xml.Element) {
						throw Exception.thrown("Bad node type, unexpected " + ((n.nodeType == null) ? "null" : XmlType_Impl_.toString(n.nodeType)));
					};
					return n.nodeValue;
				};
				let n2 = it.next();
				let tmp;
				if (n2.nodeType == Xml.PCData) {
					if (n2.nodeType == Xml.Document || n2.nodeType == Xml.Element) {
						throw Exception.thrown("Bad node type, unexpected " + ((n2.nodeType == null) ? "null" : XmlType_Impl_.toString(n2.nodeType)));
					};
					tmp = StringTools.trim(n2.nodeValue) == "";
				} else {
					tmp = false;
				};
				if (tmp && !it.hasNext()) {
					if (n.nodeType == Xml.Document || n.nodeType == Xml.Element) {
						throw Exception.thrown("Bad node type, unexpected " + ((n.nodeType == null) ? "null" : XmlType_Impl_.toString(n.nodeType)));
					};
					return n.nodeValue;
				};
			};
			let tmp1;
			if (this1.nodeType == Xml.Document) {
				tmp1 = "Document";
			} else {
				if (this1.nodeType != Xml.Element) {
					throw Exception.thrown("Bad node type, expected Element but found " + ((this1.nodeType == null) ? "null" : XmlType_Impl_.toString(this1.nodeType)));
				};
				tmp1 = this1.nodeName;
			};
			throw Exception.thrown(tmp1 + " does not only have data");
		};
		if (v.nodeType != Xml.PCData && v.nodeType != Xml.CData) {
			let tmp;
			if (this1.nodeType == Xml.Document) {
				tmp = "Document";
			} else {
				if (this1.nodeType != Xml.Element) {
					throw Exception.thrown("Bad node type, expected Element but found " + ((this1.nodeType == null) ? "null" : XmlType_Impl_.toString(this1.nodeType)));
				};
				tmp = this1.nodeName;
			};
			throw Exception.thrown(tmp + " does not have data");
		};
		if (v.nodeType == Xml.Document || v.nodeType == Xml.Element) {
			throw Exception.thrown("Bad node type, unexpected " + ((v.nodeType == null) ? "null" : XmlType_Impl_.toString(v.nodeType)));
		};
		return v.nodeValue;
	}
	static get_innerHTML(this1) {
		let s_b = "";
		if (this1.nodeType != Xml.Document && this1.nodeType != Xml.Element) {
			throw Exception.thrown("Bad node type, expected Element or Document but found " + ((this1.nodeType == null) ? "null" : XmlType_Impl_.toString(this1.nodeType)));
		};
		let _g_current = 0;
		let _g_array = this1.children;
		while (_g_current < _g_array.length) {
			let x = _g_array[_g_current++];
			s_b += Std.string(Printer.print(x));
		};
		return s_b;
	}
	static get __name__() {
		return "haxe.xml._Access.Access_Impl_"
	}
	get __class__() {
		return Access_Impl_
	}
}


//# sourceMappingURL=Access.js.map