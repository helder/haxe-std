import {Xml} from "../../Xml"
import {Iterator} from "../../StdTypes"

export declare class NodeAccess_Impl_ {
	static resolve($this: Xml, name: string): Xml
}

export declare class AttribAccess_Impl_ {
	static resolve($this: Xml, name: string): string
}

export declare class HasAttribAccess_Impl_ {
	static resolve($this: Xml, name: string): boolean
}

export declare class HasNodeAccess_Impl_ {
	static resolve($this: Xml, name: string): boolean
}

export declare class NodeListAccess_Impl_ {
	static resolve($this: Xml, name: string): Xml[]
}

export declare class Access_Impl_ {
	static readonly x: Xml
	static get_x($this: Xml): Xml
	
	/**
	The name of the current element. This is the same as `Xml.nodeName`.
	*/
	static readonly name: string
	
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
	
	/**
	Check the existence of an attribute with the given name.
	*/
	static readonly has: Xml
	
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
	
	/**
	The list of all sub-elements which are the nodes with type `Xml.Element`.
	*/
	static readonly elements: Iterator<Xml>
	static _new(x: Xml): Xml
}

//# sourceMappingURL=Access.d.ts.map