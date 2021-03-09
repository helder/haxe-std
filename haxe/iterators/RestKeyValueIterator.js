import {Register} from "../../genes/Register"

export const RestKeyValueIterator = Register.global("$hxClasses")["haxe.iterators.RestKeyValueIterator"] = 
class RestKeyValueIterator extends Register.inherits() {
	new(args) {
		this.current = 0;
		this.args = args;
	}
	hasNext() {
		return this.current < this.args.length;
	}
	next() {
		return {"key": this.current, "value": this.args[this.current++]};
	}
	static get __name__() {
		return "haxe.iterators.RestKeyValueIterator"
	}
	get __class__() {
		return RestKeyValueIterator
	}
}


//# sourceMappingURL=RestKeyValueIterator.js.map