import {Register} from "../../genes/Register.js"

/**
`HaxeIterator` wraps a JavaScript native iterator object to enable for-in iteration in haxe.
It can be used directly: `new HaxeIterator(jsIterator)` or via using: `using HaxeIterator`.
*/
export const HaxeIterator = Register.global("$hxClasses")["js.lib.HaxeIterator"] = 
class HaxeIterator extends Register.inherits() {
	new(jsIterator) {
		this.jsIterator = jsIterator;
		this.lastStep = jsIterator.next();
	}
	hasNext() {
		return !this.lastStep.done;
	}
	next() {
		var v = this.lastStep.value;
		this.lastStep = this.jsIterator.next();
		return v;
	}
	static iterator(jsIterator) {
		return new HaxeIterator(jsIterator);
	}
	static get __name__() {
		return "js.lib.HaxeIterator"
	}
	get __class__() {
		return HaxeIterator
	}
}


//# sourceMappingURL=HaxeIterator.js.map