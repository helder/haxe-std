import {PosException} from "./PosException.js"
import {Register} from "../../genes/Register.js"

/**
An exception that is thrown when requested function or operation does not have an implementation.
*/
export const NotImplementedException = Register.global("$hxClasses")["haxe.exceptions.NotImplementedException"] = 
class NotImplementedException extends Register.inherits(PosException) {
	new(message = "Not implemented", previous = null, pos = null) {
		super.new(message, previous, pos);
		this.__skipStack++;
	}
	static get __name__() {
		return "haxe.exceptions.NotImplementedException"
	}
	static get __super__() {
		return PosException
	}
	get __class__() {
		return NotImplementedException
	}
}


//# sourceMappingURL=NotImplementedException.js.map