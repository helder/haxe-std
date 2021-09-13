import {Iterator} from "./StdTypes"
import {Map as Map__1} from "./Map"

export declare class XmlType {
	
	/**
	Represents an XML element type.
	*/
	static Element: number
	
	/**
	Represents XML parsed character data type.
	*/
	static PCData: number
	
	/**
	Represents XML character data type.
	*/
	static CData: number
	
	/**
	Represents an XML comment type.
	*/
	static Comment: number
	
	/**
	Represents an XML doctype element type.
	*/
	static DocType: number
	
	/**
	Represents an XML processing instruction type.
	*/
	static ProcessingInstruction: number
	
	/**
	Represents an XML document type.
	*/
	static Document: number
	static toString($this: number): string
}

/**
Cross-platform Xml API.

@see https://haxe.org/manual/std-Xml.html
*/
export declare class Xml {
	protected constructor(nodeType: number)
	
	/**
	Returns the type of the Xml Node. This should be used before
	accessing other functions since some might raise an exception
	if the node type is not correct.
	*/
	nodeType: number
	
	/**
	Returns the node name of an Element.
	*/
	nodeName: string
	
	/**
	Returns the node value. Only works if the Xml node is not an Element or a Document.
	*/
	nodeValue: string
	
	/**
	Returns the parent object in the Xml hierarchy.
	The parent can be `null`, an Element or a Document.
	*/
	parent: Xml
	protected children: Xml[]
	protected attributeMap: Map__1<string, string>
	protected get_nodeName(): string
	protected set_nodeName(v: string): string
	protected get_nodeValue(): string
	protected set_nodeValue(v: string): string
	
	/**
	Get the given attribute of an Element node. Returns `null` if not found.
	Attributes are case-sensitive.
	*/
	get(att: string): string
	
	/**
	Set the given attribute value for an Element node.
	Attributes are case-sensitive.
	*/
	set(att: string, value: string): void
	
	/**
	Removes an attribute for an Element node.
	Attributes are case-sensitive.
	*/
	remove(att: string): void
	
	/**
	Tells if the Element node has a given attribute.
	Attributes are case-sensitive.
	*/
	exists(att: string): boolean
	
	/**
	Returns an `Iterator` on all the attribute names.
	*/
	attributes(): Iterator<string>
	
	/**
	Returns an iterator of all child nodes.
	Only works if the current node is an Element or a Document.
	*/
	iterator(): Iterator<Xml>
	
	/**
	Returns an iterator of all child nodes which are Elements.
	Only works if the current node is an Element or a Document.
	*/
	elements(): Iterator<Xml>
	
	/**
	Returns an iterator of all child nodes which are Elements with the given nodeName.
	Only works if the current node is an Element or a Document.
	*/
	elementsNamed(name: string): Iterator<Xml>
	
	/**
	Returns the first child node.
	*/
	firstChild(): Xml
	
	/**
	Returns the first child node which is an Element.
	*/
	firstElement(): Xml
	
	/**
	Adds a child node to the Document or Element.
	A child node can only be inside one given parent node, which is indicated by the `parent` property.
	If the child is already inside this Document or Element, it will be moved to the last position among the Document or Element's children.
	If the child node was previously inside a different node, it will be moved to this Document or Element.
	*/
	addChild(x: Xml): void
	
	/**
	Removes a child from the Document or Element.
	Returns true if the child was successfuly removed.
	*/
	removeChild(x: Xml): boolean
	
	/**
	Inserts a child at the given position among the other childs.
	A child node can only be inside one given parent node, which is indicated by the [parent] property.
	If the child is already inside this Document or Element, it will be moved to the new position among the Document or Element's children.
	If the child node was previously inside a different node, it will be moved to this Document or Element.
	*/
	insertChild(x: Xml, pos: number): void
	
	/**
	Returns a String representation of the Xml node.
	*/
	toString(): string
	protected ensureElementType(): void
	
	/**
	XML element type.
	*/
	static Element: number
	
	/**
	XML parsed character data type.
	*/
	static PCData: number
	
	/**
	XML character data type.
	*/
	static CData: number
	
	/**
	XML comment type.
	*/
	static Comment: number
	
	/**
	XML doctype element type.
	*/
	static DocType: number
	
	/**
	XML processing instruction type.
	*/
	static ProcessingInstruction: number
	
	/**
	XML document type.
	*/
	static Document: number
	
	/**
	Parses the String into an Xml document.
	*/
	static parse(str: string): Xml
	
	/**
	Creates a node of the given type.
	*/
	static createElement(name: string): Xml
	
	/**
	Creates a node of the given type.
	*/
	static createPCData(data: string): Xml
	
	/**
	Creates a node of the given type.
	*/
	static createCData(data: string): Xml
	
	/**
	Creates a node of the given type.
	*/
	static createComment(data: string): Xml
	
	/**
	Creates a node of the given type.
	*/
	static createDocType(data: string): Xml
	
	/**
	Creates a node of the given type.
	*/
	static createProcessingInstruction(data: string): Xml
	
	/**
	Creates a node of the given type.
	*/
	static createDocument(): Xml
}

//# sourceMappingURL=Xml.d.ts.map