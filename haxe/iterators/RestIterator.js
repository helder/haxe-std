import {Register} from "../../genes/Register.js"

const $global = Register.$global

export const RestIterator = Register.global("$hxClasses")["haxe.iterators.RestIterator"] = 
class RestIterator extends Register.inherits() {
	new(args) {
		this.current = 0;
		this.args = args;
	}
	hasNext() {
		return this.current < this.args.length;
	}
	next() {
		return this.args[this.current++];
	}
	static get __name__() {
		return "haxe.iterators.RestIterator"
	}
	get __class__() {
		return RestIterator
	}
}


//# sourceMappingURL=RestIterator.js.map