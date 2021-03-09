import {Register} from "../../genes/Register.js"

/**
This exception is raised when reading while data is no longer available in the `haxe.io.Input`.
*/
export const Eof = Register.global("$hxClasses")["haxe.io.Eof"] = 
class Eof extends Register.inherits() {
	new() {
	}
	toString() {
		return "Eof";
	}
	static get __name__() {
		return "haxe.io.Eof"
	}
	get __class__() {
		return Eof
	}
}


//# sourceMappingURL=Eof.js.map