import {Exception} from "../Exception.js"
import {Register} from "../../genes/Register.js"

/**
An exception that carry position information of a place where it was created.
*/
export const PosException = Register.global("$hxClasses")["haxe.exceptions.PosException"] = 
class PosException extends Register.inherits(Exception) {
	new(message, previous = null, pos = null) {
		super.new(message, previous);
		if (pos == null) {
			this.posInfos = {"fileName": "(unknown)", "lineNumber": 0, "className": "(unknown)", "methodName": "(unknown)"};
		} else {
			this.posInfos = pos;
		};
		this.__skipStack++;
	}
	
	/**
	Returns exception message.
	*/
	toString() {
		return "" + super.toString() + " in " + this.posInfos.className + "." + this.posInfos.methodName + " at " + this.posInfos.fileName + ":" + this.posInfos.lineNumber;
	}
	static get __name__() {
		return "haxe.exceptions.PosException"
	}
	static get __super__() {
		return Exception
	}
	get __class__() {
		return PosException
	}
}


//# sourceMappingURL=PosException.js.map