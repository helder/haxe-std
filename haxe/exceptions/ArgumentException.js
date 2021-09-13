import {PosException} from "./PosException.js"
import {Register} from "../../genes/Register.js"

const $global = Register.$global

/**
An exception that is thrown when an invalid value provided for an argument of a function.
*/
export const ArgumentException = Register.global("$hxClasses")["haxe.exceptions.ArgumentException"] = 
class ArgumentException extends Register.inherits(PosException) {
	new(argument, message, previous, pos) {
		super.new((message == null) ? "Invalid argument \"" + argument + "\"" : message, previous, pos);
		this.argument = argument;
		this.__skipStack++;
	}
	static get __name__() {
		return "haxe.exceptions.ArgumentException"
	}
	static get __super__() {
		return PosException
	}
	get __class__() {
		return ArgumentException
	}
}


//# sourceMappingURL=ArgumentException.js.map