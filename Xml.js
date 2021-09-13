import {Printer} from "./haxe/xml/Printer.js"
import {Parser} from "./haxe/xml/Parser.js"
import {ArrayIterator} from "./haxe/iterators/ArrayIterator.js"
import {StringMap} from "./haxe/ds/StringMap.js"
import {Exception} from "./haxe/Exception.js"
import {EsMap} from "./genes/util/EsMap.js"
import {Register} from "./genes/Register.js"
import {HxOverrides} from "./HxOverrides.js"

const $global = Register.$global

export const XmlType = Register.global("$hxClasses")["_Xml.XmlType"] = 
class XmlType {
	static toString(this1) {
		switch (this1) {
			case 0:
				return "Element";
				break
			case 1:
				return "PCData";
				break
			case 2:
				return "CData";
				break
			case 3:
				return "Comment";
				break
			case 4:
				return "DocType";
				break
			case 5:
				return "ProcessingInstruction";
				break
			case 6:
				return "Document";
				break
			
		};
	}
	static get __name__() {
		return "_Xml.XmlType_Impl_"
	}
	get __class__() {
		return XmlType
	}
}


XmlType.Element = 0
XmlType.PCData = 1
XmlType.CData = 2
XmlType.Comment = 3
XmlType.DocType = 4
XmlType.ProcessingInstruction = 5
XmlType.Document = 6
/**
Cross-platform Xml API.

@see https://haxe.org/manual/std-Xml.html
*/
export const Xml = Register.global("$hxClasses")["Xml"] = 
class Xml extends Register.inherits() {
	new(nodeType) {
		this.nodeType = nodeType;
		this.children = [];
		this.attributeMap = new StringMap();
	}
	get_nodeName() {
		if (this.nodeType != Xml.Element) {
			throw Exception.thrown("Bad node type, expected Element but found " + ((this.nodeType == null) ? "null" : XmlType.toString(this.nodeType)));
		};
		return this.nodeName;
	}
	set_nodeName(v) {
		if (this.nodeType != Xml.Element) {
			throw Exception.thrown("Bad node type, expected Element but found " + ((this.nodeType == null) ? "null" : XmlType.toString(this.nodeType)));
		};
		return this.nodeName = v;
	}
	get_nodeValue() {
		if (this.nodeType == Xml.Document || this.nodeType == Xml.Element) {
			throw Exception.thrown("Bad node type, unexpected " + ((this.nodeType == null) ? "null" : XmlType.toString(this.nodeType)));
		};
		return this.nodeValue;
	}
	set_nodeValue(v) {
		if (this.nodeType == Xml.Document || this.nodeType == Xml.Element) {
			throw Exception.thrown("Bad node type, unexpected " + ((this.nodeType == null) ? "null" : XmlType.toString(this.nodeType)));
		};
		return this.nodeValue = v;
	}
	
	/**
	Get the given attribute of an Element node. Returns `null` if not found.
	Attributes are case-sensitive.
	*/
	get(att) {
		if (this.nodeType != Xml.Element) {
			throw Exception.thrown("Bad node type, expected Element but found " + ((this.nodeType == null) ? "null" : XmlType.toString(this.nodeType)));
		};
		return this.attributeMap.inst.get(att);
	}
	
	/**
	Set the given attribute value for an Element node.
	Attributes are case-sensitive.
	*/
	set(att, value) {
		if (this.nodeType != Xml.Element) {
			throw Exception.thrown("Bad node type, expected Element but found " + ((this.nodeType == null) ? "null" : XmlType.toString(this.nodeType)));
		};
		this.attributeMap.inst.set(att, value);
	}
	
	/**
	Removes an attribute for an Element node.
	Attributes are case-sensitive.
	*/
	remove(att) {
		if (this.nodeType != Xml.Element) {
			throw Exception.thrown("Bad node type, expected Element but found " + ((this.nodeType == null) ? "null" : XmlType.toString(this.nodeType)));
		};
		this.attributeMap.inst["delete"](att);
	}
	
	/**
	Tells if the Element node has a given attribute.
	Attributes are case-sensitive.
	*/
	exists(att) {
		if (this.nodeType != Xml.Element) {
			throw Exception.thrown("Bad node type, expected Element but found " + ((this.nodeType == null) ? "null" : XmlType.toString(this.nodeType)));
		};
		return this.attributeMap.inst.has(att);
	}
	
	/**
	Returns an `Iterator` on all the attribute names.
	*/
	attributes() {
		if (this.nodeType != Xml.Element) {
			throw Exception.thrown("Bad node type, expected Element but found " + ((this.nodeType == null) ? "null" : XmlType.toString(this.nodeType)));
		};
		return EsMap.adaptIterator(this.attributeMap.inst.keys());
	}
	
	/**
	Returns an iterator of all child nodes.
	Only works if the current node is an Element or a Document.
	*/
	iterator() {
		if (this.nodeType != Xml.Document && this.nodeType != Xml.Element) {
			throw Exception.thrown("Bad node type, expected Element or Document but found " + ((this.nodeType == null) ? "null" : XmlType.toString(this.nodeType)));
		};
		return new ArrayIterator(this.children);
	}
	
	/**
	Returns an iterator of all child nodes which are Elements.
	Only works if the current node is an Element or a Document.
	*/
	elements() {
		if (this.nodeType != Xml.Document && this.nodeType != Xml.Element) {
			throw Exception.thrown("Bad node type, expected Element or Document but found " + ((this.nodeType == null) ? "null" : XmlType.toString(this.nodeType)));
		};
		var _g = [];
		var _g1 = 0;
		var _g2 = this.children;
		while (_g1 < _g2.length) {
			var child = _g2[_g1];
			++_g1;
			if (child.nodeType == Xml.Element) {
				_g.push(child);
			};
		};
		var ret = _g;
		return new ArrayIterator(ret);
	}
	
	/**
	Returns an iterator of all child nodes which are Elements with the given nodeName.
	Only works if the current node is an Element or a Document.
	*/
	elementsNamed(name) {
		if (this.nodeType != Xml.Document && this.nodeType != Xml.Element) {
			throw Exception.thrown("Bad node type, expected Element or Document but found " + ((this.nodeType == null) ? "null" : XmlType.toString(this.nodeType)));
		};
		var _g = [];
		var _g1 = 0;
		var _g2 = this.children;
		while (_g1 < _g2.length) {
			var child = _g2[_g1];
			++_g1;
			var tmp;
			if (child.nodeType == Xml.Element) {
				if (child.nodeType != Xml.Element) {
					throw Exception.thrown("Bad node type, expected Element but found " + ((child.nodeType == null) ? "null" : XmlType.toString(child.nodeType)));
				};
				tmp = child.nodeName == name;
			} else {
				tmp = false;
			};
			if (tmp) {
				_g.push(child);
			};
		};
		var ret = _g;
		return new ArrayIterator(ret);
	}
	
	/**
	Returns the first child node.
	*/
	firstChild() {
		if (this.nodeType != Xml.Document && this.nodeType != Xml.Element) {
			throw Exception.thrown("Bad node type, expected Element or Document but found " + ((this.nodeType == null) ? "null" : XmlType.toString(this.nodeType)));
		};
		return this.children[0];
	}
	
	/**
	Returns the first child node which is an Element.
	*/
	firstElement() {
		if (this.nodeType != Xml.Document && this.nodeType != Xml.Element) {
			throw Exception.thrown("Bad node type, expected Element or Document but found " + ((this.nodeType == null) ? "null" : XmlType.toString(this.nodeType)));
		};
		var _g = 0;
		var _g1 = this.children;
		while (_g < _g1.length) {
			var child = _g1[_g];
			++_g;
			if (child.nodeType == Xml.Element) {
				return child;
			};
		};
		return null;
	}
	
	/**
	Adds a child node to the Document or Element.
	A child node can only be inside one given parent node, which is indicated by the `parent` property.
	If the child is already inside this Document or Element, it will be moved to the last position among the Document or Element's children.
	If the child node was previously inside a different node, it will be moved to this Document or Element.
	*/
	addChild(x) {
		if (this.nodeType != Xml.Document && this.nodeType != Xml.Element) {
			throw Exception.thrown("Bad node type, expected Element or Document but found " + ((this.nodeType == null) ? "null" : XmlType.toString(this.nodeType)));
		};
		if (x.parent != null) {
			x.parent.removeChild(x);
		};
		this.children.push(x);
		x.parent = this;
	}
	
	/**
	Removes a child from the Document or Element.
	Returns true if the child was successfuly removed.
	*/
	removeChild(x) {
		if (this.nodeType != Xml.Document && this.nodeType != Xml.Element) {
			throw Exception.thrown("Bad node type, expected Element or Document but found " + ((this.nodeType == null) ? "null" : XmlType.toString(this.nodeType)));
		};
		if (HxOverrides.remove(this.children, x)) {
			x.parent = null;
			return true;
		};
		return false;
	}
	
	/**
	Inserts a child at the given position among the other childs.
	A child node can only be inside one given parent node, which is indicated by the [parent] property.
	If the child is already inside this Document or Element, it will be moved to the new position among the Document or Element's children.
	If the child node was previously inside a different node, it will be moved to this Document or Element.
	*/
	insertChild(x, pos) {
		if (this.nodeType != Xml.Document && this.nodeType != Xml.Element) {
			throw Exception.thrown("Bad node type, expected Element or Document but found " + ((this.nodeType == null) ? "null" : XmlType.toString(this.nodeType)));
		};
		if (x.parent != null) {
			HxOverrides.remove(x.parent.children, x);
		};
		this.children.splice(pos, 0, x);
		x.parent = this;
	}
	
	/**
	Returns a String representation of the Xml node.
	*/
	toString() {
		return Printer.print(this);
	}
	ensureElementType() {
		if (this.nodeType != Xml.Document && this.nodeType != Xml.Element) {
			throw Exception.thrown("Bad node type, expected Element or Document but found " + ((this.nodeType == null) ? "null" : XmlType.toString(this.nodeType)));
		};
	}
	
	/**
	Parses the String into an Xml document.
	*/
	static parse(str) {
		return Parser.parse(str);
	}
	
	/**
	Creates a node of the given type.
	*/
	static createElement(name) {
		var xml = new Xml(Xml.Element);
		if (xml.nodeType != Xml.Element) {
			throw Exception.thrown("Bad node type, expected Element but found " + ((xml.nodeType == null) ? "null" : XmlType.toString(xml.nodeType)));
		};
		xml.nodeName = name;
		return xml;
	}
	
	/**
	Creates a node of the given type.
	*/
	static createPCData(data) {
		var xml = new Xml(Xml.PCData);
		if (xml.nodeType == Xml.Document || xml.nodeType == Xml.Element) {
			throw Exception.thrown("Bad node type, unexpected " + ((xml.nodeType == null) ? "null" : XmlType.toString(xml.nodeType)));
		};
		xml.nodeValue = data;
		return xml;
	}
	
	/**
	Creates a node of the given type.
	*/
	static createCData(data) {
		var xml = new Xml(Xml.CData);
		if (xml.nodeType == Xml.Document || xml.nodeType == Xml.Element) {
			throw Exception.thrown("Bad node type, unexpected " + ((xml.nodeType == null) ? "null" : XmlType.toString(xml.nodeType)));
		};
		xml.nodeValue = data;
		return xml;
	}
	
	/**
	Creates a node of the given type.
	*/
	static createComment(data) {
		var xml = new Xml(Xml.Comment);
		if (xml.nodeType == Xml.Document || xml.nodeType == Xml.Element) {
			throw Exception.thrown("Bad node type, unexpected " + ((xml.nodeType == null) ? "null" : XmlType.toString(xml.nodeType)));
		};
		xml.nodeValue = data;
		return xml;
	}
	
	/**
	Creates a node of the given type.
	*/
	static createDocType(data) {
		var xml = new Xml(Xml.DocType);
		if (xml.nodeType == Xml.Document || xml.nodeType == Xml.Element) {
			throw Exception.thrown("Bad node type, unexpected " + ((xml.nodeType == null) ? "null" : XmlType.toString(xml.nodeType)));
		};
		xml.nodeValue = data;
		return xml;
	}
	
	/**
	Creates a node of the given type.
	*/
	static createProcessingInstruction(data) {
		var xml = new Xml(Xml.ProcessingInstruction);
		if (xml.nodeType == Xml.Document || xml.nodeType == Xml.Element) {
			throw Exception.thrown("Bad node type, unexpected " + ((xml.nodeType == null) ? "null" : XmlType.toString(xml.nodeType)));
		};
		xml.nodeValue = data;
		return xml;
	}
	
	/**
	Creates a node of the given type.
	*/
	static createDocument() {
		return new Xml(Xml.Document);
	}
	static get __name__() {
		return "Xml"
	}
	get __class__() {
		return Xml
	}
}


Xml.Element = 0
Xml.PCData = 1
Xml.CData = 2
Xml.Comment = 3
Xml.DocType = 4
Xml.ProcessingInstruction = 5
Xml.Document = 6
//# sourceMappingURL=Xml.js.map