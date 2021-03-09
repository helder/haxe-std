import {Boot} from "../../js/Boot"
import {StringMap} from "../ds/StringMap"
import {Exception} from "../Exception"
import {Register} from "../../genes/Register"
import {Xml, XmlType_Impl_} from "../../Xml"
import {StringBuf} from "../../StringBuf"
import {Std} from "../../Std"
import {HxOverrides} from "../../HxOverrides"

export const XmlParserException = Register.global("$hxClasses")["haxe.xml.XmlParserException"] = 
class XmlParserException extends Register.inherits() {
	new(message, xml, position) {
		this.xml = xml;
		this.message = message;
		this.position = position;
		this.lineNumber = 1;
		this.positionAtLine = 0;
		let _g = 0;
		let _g1 = position;
		while (_g < _g1) {
			let i = _g++;
			let c = xml.charCodeAt(i);
			if (c == 10) {
				this.lineNumber++;
				this.positionAtLine = 0;
			} else if (c != 13) {
				this.positionAtLine++;
			};
		};
	}
	toString() {
		let c = Boot.getClass(this);
		return c.__name__ + ": " + this.message + " at line " + this.lineNumber + " char " + this.positionAtLine;
	}
	static get __name__() {
		return "haxe.xml.XmlParserException"
	}
	get __class__() {
		return XmlParserException
	}
}


export const Parser = Register.global("$hxClasses")["haxe.xml.Parser"] = 
class Parser {
	
	/**
	Parses the String into an XML Document. Set strict parsing to true in order to enable a strict check of XML attributes and entities.
	
	@throws haxe.xml.XmlParserException
	*/
	static parse(str, strict = false) {
		let doc = Xml.createDocument();
		Parser.doParse(str, strict, 0, doc);
		return doc;
	}
	static doParse(str, strict, p = 0, parent = null) {
		let xml = null;
		let state = 1;
		let next = 1;
		let aname = null;
		let start = 0;
		let nsubs = 0;
		let nbrackets = 0;
		let buf = new StringBuf();
		let escapeNext = 1;
		let attrValQuote = -1;
		while (p < str.length) {
			let c = str.charCodeAt(p);
			switch (state) {
				case 0:
					switch (c) {
						case 9:case 10:case 13:case 32:
							break
						default:
						state = next;
						continue;
						
					};
					break
				case 1:
					if (c == 60) {
						state = 0;
						next = 2;
					} else {
						start = p;
						state = 13;
						continue;
					};
					break
				case 2:
					switch (c) {
						case 33:
							if (str.charCodeAt(p + 1) == 91) {
								p += 2;
								if (HxOverrides.substr(str, p, 6).toUpperCase() != "CDATA[") {
									throw Exception.thrown(new XmlParserException("Expected <![CDATA[", str, p));
								};
								p += 5;
								state = 17;
								start = p + 1;
							} else if (str.charCodeAt(p + 1) == 68 || str.charCodeAt(p + 1) == 100) {
								if (HxOverrides.substr(str, p + 2, 6).toUpperCase() != "OCTYPE") {
									throw Exception.thrown(new XmlParserException("Expected <!DOCTYPE", str, p));
								};
								p += 8;
								state = 16;
								start = p + 1;
							} else if (str.charCodeAt(p + 1) != 45 || str.charCodeAt(p + 2) != 45) {
								throw Exception.thrown(new XmlParserException("Expected <!--", str, p));
							} else {
								p += 2;
								state = 15;
								start = p + 1;
							};
							break
						case 47:
							if (parent == null) {
								throw Exception.thrown(new XmlParserException("Expected node name", str, p));
							};
							start = p + 1;
							state = 0;
							next = 10;
							break
						case 63:
							state = 14;
							start = p;
							break
						default:
						state = 3;
						start = p;
						continue;
						
					};
					break
				case 3:
					if (!(c >= 97 && c <= 122 || c >= 65 && c <= 90 || c >= 48 && c <= 57 || c == 58 || c == 46 || c == 95 || c == 45)) {
						if (p == start) {
							throw Exception.thrown(new XmlParserException("Expected node name", str, p));
						};
						xml = Xml.createElement(HxOverrides.substr(str, start, p - start));
						parent.addChild(xml);
						++nsubs;
						state = 0;
						next = 4;
						continue;
					};
					break
				case 4:
					switch (c) {
						case 47:
							state = 11;
							break
						case 62:
							state = 9;
							break
						default:
						state = 5;
						start = p;
						continue;
						
					};
					break
				case 5:
					if (!(c >= 97 && c <= 122 || c >= 65 && c <= 90 || c >= 48 && c <= 57 || c == 58 || c == 46 || c == 95 || c == 45)) {
						if (start == p) {
							throw Exception.thrown(new XmlParserException("Expected attribute name", str, p));
						};
						let tmp = HxOverrides.substr(str, start, p - start);
						aname = tmp;
						if (xml.exists(aname)) {
							throw Exception.thrown(new XmlParserException("Duplicate attribute [" + aname + "]", str, p));
						};
						state = 0;
						next = 6;
						continue;
					};
					break
				case 6:
					if (c == 61) {
						state = 0;
						next = 7;
					} else {
						throw Exception.thrown(new XmlParserException("Expected =", str, p));
					};
					break
				case 7:
					switch (c) {
						case 34:case 39:
							buf = new StringBuf();
							state = 8;
							start = p + 1;
							attrValQuote = c;
							break
						default:
						throw Exception.thrown(new XmlParserException("Expected \"", str, p));
						
					};
					break
				case 8:
					switch (c) {
						case 38:
							let len = p - start;
							buf.b += (len == null) ? HxOverrides.substr(str, start, null) : HxOverrides.substr(str, start, len);
							state = 18;
							escapeNext = 8;
							start = p + 1;
							break
						case 60:case 62:
							if (strict) {
								throw Exception.thrown(new XmlParserException("Invalid unescaped " + String.fromCodePoint(c) + " in attribute value", str, p));
							} else if (c == attrValQuote) {
								let len = p - start;
								buf.b += (len == null) ? HxOverrides.substr(str, start, null) : HxOverrides.substr(str, start, len);
								let val = buf.b;
								buf = new StringBuf();
								xml.set(aname, val);
								state = 0;
								next = 4;
							};
							break
						default:
						if (c == attrValQuote) {
							let len = p - start;
							buf.b += (len == null) ? HxOverrides.substr(str, start, null) : HxOverrides.substr(str, start, len);
							let val = buf.b;
							buf = new StringBuf();
							xml.set(aname, val);
							state = 0;
							next = 4;
						};
						
					};
					break
				case 9:
					p = Parser.doParse(str, strict, p, xml);
					start = p;
					state = 1;
					break
				case 10:
					if (!(c >= 97 && c <= 122 || c >= 65 && c <= 90 || c >= 48 && c <= 57 || c == 58 || c == 46 || c == 95 || c == 45)) {
						if (start == p) {
							throw Exception.thrown(new XmlParserException("Expected node name", str, p));
						};
						let v = HxOverrides.substr(str, start, p - start);
						if (parent == null || parent.nodeType != 0) {
							throw Exception.thrown(new XmlParserException("Unexpected </" + v + ">, tag is not open", str, p));
						};
						if (parent.nodeType != Xml.Element) {
							throw Exception.thrown("Bad node type, expected Element but found " + ((parent.nodeType == null) ? "null" : XmlType_Impl_.toString(parent.nodeType)));
						};
						if (v != parent.nodeName) {
							if (parent.nodeType != Xml.Element) {
								throw Exception.thrown("Bad node type, expected Element but found " + ((parent.nodeType == null) ? "null" : XmlType_Impl_.toString(parent.nodeType)));
							};
							throw Exception.thrown(new XmlParserException("Expected </" + parent.nodeName + ">", str, p));
						};
						state = 0;
						next = 12;
						continue;
					};
					break
				case 11:
					if (c == 62) {
						state = 1;
					} else {
						throw Exception.thrown(new XmlParserException("Expected >", str, p));
					};
					break
				case 12:
					if (c == 62) {
						if (nsubs == 0) {
							parent.addChild(Xml.createPCData(""));
						};
						return p;
					} else {
						throw Exception.thrown(new XmlParserException("Expected >", str, p));
					};
					break
				case 13:
					if (c == 60) {
						let len = p - start;
						buf.b += (len == null) ? HxOverrides.substr(str, start, null) : HxOverrides.substr(str, start, len);
						let child = Xml.createPCData(buf.b);
						buf = new StringBuf();
						parent.addChild(child);
						++nsubs;
						state = 0;
						next = 2;
					} else if (c == 38) {
						let len = p - start;
						buf.b += (len == null) ? HxOverrides.substr(str, start, null) : HxOverrides.substr(str, start, len);
						state = 18;
						escapeNext = 13;
						start = p + 1;
					};
					break
				case 14:
					if (c == 63 && str.charCodeAt(p + 1) == 62) {
						++p;
						let str1 = HxOverrides.substr(str, start + 1, p - start - 2);
						parent.addChild(Xml.createProcessingInstruction(str1));
						++nsubs;
						state = 1;
					};
					break
				case 15:
					if (c == 45 && str.charCodeAt(p + 1) == 45 && str.charCodeAt(p + 2) == 62) {
						parent.addChild(Xml.createComment(HxOverrides.substr(str, start, p - start)));
						++nsubs;
						p += 2;
						state = 1;
					};
					break
				case 16:
					if (c == 91) {
						++nbrackets;
					} else if (c == 93) {
						--nbrackets;
					} else if (c == 62 && nbrackets == 0) {
						parent.addChild(Xml.createDocType(HxOverrides.substr(str, start, p - start)));
						++nsubs;
						state = 1;
					};
					break
				case 17:
					if (c == 93 && str.charCodeAt(p + 1) == 93 && str.charCodeAt(p + 2) == 62) {
						let child = Xml.createCData(HxOverrides.substr(str, start, p - start));
						parent.addChild(child);
						++nsubs;
						p += 2;
						state = 1;
					};
					break
				case 18:
					if (c == 59) {
						let s = HxOverrides.substr(str, start, p - start);
						if (s.charCodeAt(0) == 35) {
							let c = (s.charCodeAt(1) == 120) ? Std.parseInt("0" + HxOverrides.substr(s, 1, s.length - 1)) : Std.parseInt(HxOverrides.substr(s, 1, s.length - 1));
							buf.b += String.fromCodePoint(c);
						} else if (!Parser.escapes.inst.has(s)) {
							if (strict) {
								throw Exception.thrown(new XmlParserException("Undefined entity: " + s, str, p));
							};
							buf.b += Std.string("&" + s + ";");
						} else {
							buf.b += Std.string(Parser.escapes.inst.get(s));
						};
						start = p + 1;
						state = escapeNext;
					} else if (!(c >= 97 && c <= 122 || c >= 65 && c <= 90 || c >= 48 && c <= 57 || c == 58 || c == 46 || c == 95 || c == 45) && c != 35) {
						if (strict) {
							throw Exception.thrown(new XmlParserException("Invalid character in entity: " + String.fromCodePoint(c), str, p));
						};
						buf.b += String.fromCodePoint(38);
						let len = p - start;
						buf.b += (len == null) ? HxOverrides.substr(str, start, null) : HxOverrides.substr(str, start, len);
						--p;
						start = p + 1;
						state = escapeNext;
					};
					break
				
			};
			++p;
		};
		if (state == 1) {
			start = p;
			state = 13;
		};
		if (state == 13) {
			if (parent.nodeType == 0) {
				if (parent.nodeType != Xml.Element) {
					throw Exception.thrown("Bad node type, expected Element but found " + ((parent.nodeType == null) ? "null" : XmlType_Impl_.toString(parent.nodeType)));
				};
				throw Exception.thrown(new XmlParserException("Unclosed node <" + parent.nodeName + ">", str, p));
			};
			if (p != start || nsubs == 0) {
				let len = p - start;
				buf.b += (len == null) ? HxOverrides.substr(str, start, null) : HxOverrides.substr(str, start, len);
				parent.addChild(Xml.createPCData(buf.b));
				++nsubs;
			};
			return p;
		};
		if (!strict && state == 18 && escapeNext == 13) {
			buf.b += String.fromCodePoint(38);
			let len = p - start;
			buf.b += (len == null) ? HxOverrides.substr(str, start, null) : HxOverrides.substr(str, start, len);
			parent.addChild(Xml.createPCData(buf.b));
			++nsubs;
			return p;
		};
		throw Exception.thrown(new XmlParserException("Unexpected end", str, p));
	}
	static isValidChar(c) {
		if (!(c >= 97 && c <= 122 || c >= 65 && c <= 90 || c >= 48 && c <= 57 || c == 58 || c == 46 || c == 95)) {
			return c == 45;
		} else {
			return true;
		};
	}
	static get __name__() {
		return "haxe.xml.Parser"
	}
	get __class__() {
		return Parser
	}
}


Parser.escapes = (function($this) {var $r0
	let h = new StringMap();
	h.inst.set("lt", "<");
	h.inst.set("gt", ">");
	h.inst.set("amp", "&");
	h.inst.set("quot", "\"");
	h.inst.set("apos", "'");
	
	$r0 = h
	return $r0})(this)
//# sourceMappingURL=Parser.js.map