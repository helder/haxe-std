import {Xml} from "../../Xml"
import {Iterator} from "../../StdTypes"

export declare class NodeAccess {
	static resolve($this: Xml, name: string): Xml
}

export declare class AttribAccess {
	static resolve($this: Xml, name: string): string
	protected static _hx_set($this: Xml, name: string, value: string): string
}

export declare class HasAttribAccess {
	static resolve($this: Xml, name: string): boolean
}

export declare class HasNodeAccess {
	static resolve($this: Xml, name: string): boolean
}

export declare class NodeListAccess {
	static resolve($this: Xml, name: string): Xml[]
}

export declare class Access {
	static readonly x: Xml
	static get_x($this: Xml): Xml
	
	/**
	The name of the current element. This is the same as `Xml.nodeName`.
	*/
	static readonly name: string
	protected static get_name($this: Xml): string
	
	/**
	The inner PCDATA or CDATA of the node.
	
	An exception is thrown if there is no data or if there not only data
	but also other nodes.
	*/
	static readonly innerData: string
	
	/**
	The XML string built with all the sub nodes, excluding the current one.
	*/
	static readonly innerHTML: string
	
	/**
	Access to the first sub element with the given name.
	
	An exception is thrown if the element doesn't exists.
	Use `hasNode` to check the existence of a node.
	
	```haxe
	var access = new haxe.xml.Access(Xml.parse("<user><name>John</name></user>"));
	var user = access.node.user;
	var name = user.node.name;
	trace(name.innerData); // John
	
	// Uncaught Error: Document is missing element password
	var password = user.node.password;
	```
	*/
	static readonly node: Xml
	protected static get_node($this: Xml): Xml
	
	/**
	Access to the List of elements with the given name.
	```haxe
	var fast = new haxe.xml.Access(Xml.parse("
	<users>
	<user name='John'/>
	<user name='Andy'/>
	<user name='Dan'/>
	</users>"
	));
	
	var users = fast.node.users;
	for (user in users.nodes.user) {
	trace(user.att.name);
	}
	```
	*/
	static readonly nodes: Xml
	protected static get_nodes($this: Xml): Xml
	
	/**
	Access to a given attribute.
	
	An exception is thrown if the attribute doesn't exists.
	Use `has` to check the existence of an attribute.
	
	```haxe
	var f = new haxe.xml.Access(Xml.parse("<user name='Mark'></user>"));
	var user = f.node.user;
	if (user.has.name) {
	trace(user.att.name); // Mark
	}
	```
	*/
	static readonly att: Xml
	protected static get_att($this: Xml): Xml
	
	/**
	Check the existence of an attribute with the given name.
	*/
	static readonly has: Xml
	protected static get_has($this: Xml): Xml
	
	/**
	Check the existence of a sub node with the given name.
	
	```haxe
	var f = new haxe.xml.Access(Xml.parse("<user><age>31</age></user>"));
	var user = f.node.user;
	if (user.hasNode.age) {
	trace(user.node.age.innerData); // 31
	}
	```
	*/
	static readonly hasNode: Xml
	protected static get_hasNode($this: Xml): Xml
	
	/**
	The list of all sub-elements which are the nodes with type `Xml.Element`.
	*/
	static readonly elements: Iterator<Xml>
	protected static get_elements($this: Xml): Iterator<Xml>
	static _new(x: Xml): Xml
	protected static get_innerData($this: Xml): string
	protected static get_innerHTML($this: Xml): string
}

//# sourceMappingURL=Access.d.ts.map