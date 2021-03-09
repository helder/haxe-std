import {Exception} from "../Exception.js"
import {Register} from "../../genes/Register.js"
import {Xml, XmlType_Impl_} from "../../Xml.js"
import {StringTools} from "../../StringTools.js"
import {StringBuf} from "../../StringBuf.js"
import {Std} from "../../Std.js"

/**
This class provides utility methods to convert Xml instances to
String representation.
*/
export const Printer = Register.global("$hxClasses")["haxe.xml.Printer"] = 
class Printer extends Register.inherits() {
	new(pretty) {
		this.output = new StringBuf();
		this.pretty = pretty;
	}
	writeNode(value, tabs) {
		switch (value.nodeType) {
			case 0:
				this.output.b += Std.string(tabs + "<");
				if (value.nodeType != Xml.Element) {
					throw Exception.thrown("Bad node type, expected Element but found " + ((value.nodeType == null) ? "null" : XmlType_Impl_.toString(value.nodeType)));
				};
				this.output.b += Std.string(value.nodeName);
				let attribute = value.attributes();
				while (attribute.hasNext()) {
					let attribute1 = attribute.next();
					this.output.b += Std.string(" " + attribute1 + "=\"");
					let input = StringTools.htmlEscape(value.get(attribute1), true);
					this.output.b += Std.string(input);
					this.output.b += "\"";
				};
				if (this.hasChildren(value)) {
					this.output.b += ">";
					if (this.pretty) {
						this.output.b += "\n";
					};
					if (value.nodeType != Xml.Document && value.nodeType != Xml.Element) {
						throw Exception.thrown("Bad node type, expected Element or Document but found " + ((value.nodeType == null) ? "null" : XmlType_Impl_.toString(value.nodeType)));
					};
					let _g_current = 0;
					let _g_array = value.children;
					while (_g_current < _g_array.length) {
						let child = _g_array[_g_current++];
						this.writeNode(child, (this.pretty) ? tabs + "\t" : tabs);
					};
					this.output.b += Std.string(tabs + "</");
					if (value.nodeType != Xml.Element) {
						throw Exception.thrown("Bad node type, expected Element but found " + ((value.nodeType == null) ? "null" : XmlType_Impl_.toString(value.nodeType)));
					};
					this.output.b += Std.string(value.nodeName);
					this.output.b += ">";
					if (this.pretty) {
						this.output.b += "\n";
					};
				} else {
					this.output.b += "/>";
					if (this.pretty) {
						this.output.b += "\n";
					};
				};
				break
			case 1:
				if (value.nodeType == Xml.Document || value.nodeType == Xml.Element) {
					throw Exception.thrown("Bad node type, unexpected " + ((value.nodeType == null) ? "null" : XmlType_Impl_.toString(value.nodeType)));
				};
				let nodeValue = value.nodeValue;
				if (nodeValue.length != 0) {
					let input = tabs + StringTools.htmlEscape(nodeValue);
					this.output.b += Std.string(input);
					if (this.pretty) {
						this.output.b += "\n";
					};
				};
				break
			case 2:
				this.output.b += Std.string(tabs + "<![CDATA[");
				if (value.nodeType == Xml.Document || value.nodeType == Xml.Element) {
					throw Exception.thrown("Bad node type, unexpected " + ((value.nodeType == null) ? "null" : XmlType_Impl_.toString(value.nodeType)));
				};
				this.output.b += Std.string(value.nodeValue);
				this.output.b += "]]>";
				if (this.pretty) {
					this.output.b += "\n";
				};
				break
			case 3:
				if (value.nodeType == Xml.Document || value.nodeType == Xml.Element) {
					throw Exception.thrown("Bad node type, unexpected " + ((value.nodeType == null) ? "null" : XmlType_Impl_.toString(value.nodeType)));
				};
				let commentContent = value.nodeValue;
				let _this_r = new RegExp("[\n\r\t]+", "g".split("u").join(""));
				commentContent = commentContent.replace(_this_r, "");
				commentContent = "<!--" + commentContent + "-->";
				this.output.b += (tabs == null) ? "null" : "" + tabs;
				let input = StringTools.trim(commentContent);
				this.output.b += Std.string(input);
				if (this.pretty) {
					this.output.b += "\n";
				};
				break
			case 4:
				if (value.nodeType == Xml.Document || value.nodeType == Xml.Element) {
					throw Exception.thrown("Bad node type, unexpected " + ((value.nodeType == null) ? "null" : XmlType_Impl_.toString(value.nodeType)));
				};
				this.output.b += Std.string("<!DOCTYPE " + value.nodeValue + ">");
				if (this.pretty) {
					this.output.b += "\n";
				};
				break
			case 5:
				if (value.nodeType == Xml.Document || value.nodeType == Xml.Element) {
					throw Exception.thrown("Bad node type, unexpected " + ((value.nodeType == null) ? "null" : XmlType_Impl_.toString(value.nodeType)));
				};
				this.output.b += Std.string("<?" + value.nodeValue + "?>");
				if (this.pretty) {
					this.output.b += "\n";
				};
				break
			case 6:
				if (value.nodeType != Xml.Document && value.nodeType != Xml.Element) {
					throw Exception.thrown("Bad node type, expected Element or Document but found " + ((value.nodeType == null) ? "null" : XmlType_Impl_.toString(value.nodeType)));
				};
				let _g_current = 0;
				let _g_array = value.children;
				while (_g_current < _g_array.length) {
					let child = _g_array[_g_current++];
					this.writeNode(child, tabs);
				};
				break
			
		};
	}
	write(input) {
		this.output.b += (input == null) ? "null" : "" + input;
	}
	newline() {
		if (this.pretty) {
			this.output.b += "\n";
		};
	}
	hasChildren(value) {
		if (value.nodeType != Xml.Document && value.nodeType != Xml.Element) {
			throw Exception.thrown("Bad node type, expected Element or Document but found " + ((value.nodeType == null) ? "null" : XmlType_Impl_.toString(value.nodeType)));
		};
		let _g_current = 0;
		let _g_array = value.children;
		while (_g_current < _g_array.length) {
			let child = _g_array[_g_current++];
			switch (child.nodeType) {
				case 0:case 1:
					return true;
					break
				case 2:case 3:
					if (child.nodeType == Xml.Document || child.nodeType == Xml.Element) {
						throw Exception.thrown("Bad node type, unexpected " + ((child.nodeType == null) ? "null" : XmlType_Impl_.toString(child.nodeType)));
					};
					if (StringTools.ltrim(child.nodeValue).length != 0) {
						return true;
					};
					break
				default:
				
			};
		};
		return false;
	}
	
	/**
	Convert `Xml` to string representation.
	
	Set `pretty` to `true` to prettify the result.
	*/
	static print(xml, pretty = false) {
		let printer = new Printer(pretty);
		printer.writeNode(xml, "");
		return printer.output.b;
	}
	static get __name__() {
		return "haxe.xml.Printer"
	}
	get __class__() {
		return Printer
	}
}


//# sourceMappingURL=Printer.js.map