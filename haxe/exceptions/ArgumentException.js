import {PosException} from "./PosException"
import {Register} from "../../genes/Register"

/**
An exception that is thrown when an invalid value provided for an argument of a function.
*/
export const ArgumentException = Register.global("$hxClasses")["haxe.exceptions.ArgumentException"] = 
class ArgumentException extends Register.inherits(PosException) {
	new(argument, message = null, previous = null, pos = null) {
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