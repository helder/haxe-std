import {Register} from "../../genes/Register.js"

/**
This proxy can be inherited with an XML file name parameter.
It will	only allow access to fields which corresponds to an "id" attribute
value in the XML file :

```haxe
class MyXml extends haxe.xml.Proxy<"my.xml", MyStructure> {
}

var h = new haxe.ds.StringMap<MyStructure>();
// ... fill h with "my.xml" content
var m = new MyXml(h.get);
trace(m.myNode.structField);
// Access to "myNode" is only possible if you have an id="myNode" attribute
// in your XML, and completion works as well.
```
*/
export const Proxy = Register.global("$hxClasses")["haxe.xml.Proxy"] = 
class Proxy extends Register.inherits() {
	new(f) {
		this.__f = f;
	}
	resolve(k) {
		return this.__f(k);
	}
	static get __name__() {
		return "haxe.xml.Proxy"
	}
	get __class__() {
		return Proxy
	}
}


//# sourceMappingURL=Proxy.js.map