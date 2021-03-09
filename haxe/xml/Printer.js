import {HaxeError} from "../../js/Boot.js"
import {Register} from "../../genes/Register.js"
import {Xml, XmlType_Impl_} from "../../Xml.js"
import {StringTools} from "../../StringTools.js"
import {StringBuf} from "../../StringBuf.js"
import {Std} from "../../Std.js"
import {HxOverrides} from "../../HxOverrides.js"

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
					throw new HaxeError("Bad node type, expected Element but found " + XmlType_Impl_.toString(value.nodeType));
				};
				this.output.b += Std.string(value.nodeName);
				var attribute = value.attributes();
				while (attribute.hasNext()) {
					var attribute1 = attribute.next();
					this.output.b += Std.string(" " + attribute1 + "=\"");
					var input = StringTools.htmlEscape(value.get(attribute1), true);
					this.output.b += Std.string(input);
					this.output.b += "\"";
				};
				if (this.hasChildren(value)) {
					this.output.b += ">";
					if (this.pretty) {
						this.output.b += "\n";
					};
					if (value.nodeType != Xml.Document && value.nodeType != Xml.Element) {
						throw new HaxeError("Bad node type, expected Element or Document but found " + XmlType_Impl_.toString(value.nodeType));
					};
					var child = HxOverrides.iter(value.children);
					while (child.hasNext()) {
						var child1 = child.next();
						this.writeNode(child1, (this.pretty) ? tabs + "\t" : tabs);
					};
					this.output.b += Std.string(tabs + "</");
					if (value.nodeType != Xml.Element) {
						throw new HaxeError("Bad node type, expected Element but found " + XmlType_Impl_.toString(value.nodeType));
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
					throw new HaxeError("Bad node type, unexpected " + XmlType_Impl_.toString(value.nodeType));
				};
				var nodeValue = value.nodeValue;
				if (nodeValue.length != 0) {
					var input1 = tabs + StringTools.htmlEscape(nodeValue);
					this.output.b += Std.string(input1);
					if (this.pretty) {
						this.output.b += "\n";
					};
				};
				break
			case 2:
				this.output.b += Std.string(tabs + "<![CDATA[");
				if (value.nodeType == Xml.Document || value.nodeType == Xml.Element) {
					throw new HaxeError("Bad node type, unexpected " + XmlType_Impl_.toString(value.nodeType));
				};
				this.output.b += Std.string(value.nodeValue);
				this.output.b += "]]>";
				if (this.pretty) {
					this.output.b += "\n";
				};
				break
			case 3:
				if (value.nodeType == Xml.Document || value.nodeType == Xml.Element) {
					throw new HaxeError("Bad node type, unexpected " + XmlType_Impl_.toString(value.nodeType));
				};
				var commentContent = value.nodeValue;
				var _this_r = new RegExp("[\n\r\t]+", "g".split("u").join(""));
				commentContent = commentContent.replace(_this_r, "");
				commentContent = "<!--" + commentContent + "-->";
				this.output.b += (tabs == null) ? "null" : "" + tabs;
				var input2 = StringTools.trim(commentContent);
				this.output.b += Std.string(input2);
				if (this.pretty) {
					this.output.b += "\n";
				};
				break
			case 4:
				if (value.nodeType == Xml.Document || value.nodeType == Xml.Element) {
					throw new HaxeError("Bad node type, unexpected " + XmlType_Impl_.toString(value.nodeType));
				};
				this.output.b += Std.string("<!DOCTYPE " + value.nodeValue + ">");
				if (this.pretty) {
					this.output.b += "\n";
				};
				break
			case 5:
				if (value.nodeType == Xml.Document || value.nodeType == Xml.Element) {
					throw new HaxeError("Bad node type, unexpected " + XmlType_Impl_.toString(value.nodeType));
				};
				this.output.b += Std.string("<?" + value.nodeValue + "?>");
				if (this.pretty) {
					this.output.b += "\n";
				};
				break
			case 6:
				if (value.nodeType != Xml.Document && value.nodeType != Xml.Element) {
					throw new HaxeError("Bad node type, expected Element or Document but found " + XmlType_Impl_.toString(value.nodeType));
				};
				var child2 = HxOverrides.iter(value.children);
				while (child2.hasNext()) {
					var child3 = child2.next();
					this.writeNode(child3, tabs);
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
			throw new HaxeError("Bad node type, expected Element or Document but found " + XmlType_Impl_.toString(value.nodeType));
		};
		var child = HxOverrides.iter(value.children);
		while (child.hasNext()) {
			var child1 = child.next();
			switch (child1.nodeType) {
				case 0:case 1:
					return true;
					break
				case 2:case 3:
					if (child1.nodeType == Xml.Document || child1.nodeType == Xml.Element) {
						throw new HaxeError("Bad node type, unexpected " + XmlType_Impl_.toString(child1.nodeType));
					};
					if (StringTools.ltrim(child1.nodeValue).length != 0) {
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
		var printer = new Printer(pretty);
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