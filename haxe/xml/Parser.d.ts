import {StringMap} from "../ds/StringMap"
import {Xml} from "../../Xml"

export declare class XmlParserException {
	constructor(message: string, xml: string, position: number)
	
	/**
	the XML parsing error message
	*/
	message: string
	
	/**
	the line number at which the XML parsing error occurred
	*/
	lineNumber: number
	
	/**
	the character position in the reported line at which the parsing error occurred
	*/
	positionAtLine: number
	
	/**
	the character position in the XML string at which the parsing error occurred
	*/
	position: number
	
	/**
	the invalid XML string
	*/
	xml: string
	toString(): string
}

export declare class Parser {
	
	/**
	Parses the String into an XML Document. Set strict parsing to true in order to enable a strict check of XML attributes and entities.
	
	@throws haxe.xml.XmlParserException
	*/
	static parse(str: string, strict?: boolean): Xml
}

//# sourceMappingURL=Parser.d.ts.map