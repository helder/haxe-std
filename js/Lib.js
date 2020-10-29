import {Boot} from "./Boot"
import {Register} from "../genes/Register"

/**
Platform-specific JavaScript Library. Provides some platform-specific functions
for the JavaScript target.
*/
export const Lib = Register.global("$hxClasses")["js.Lib"] = 
class Lib {
	
	/**
	Inserts a 'debugger' statement that will make a breakpoint if a debugger is available.
	*/
	static debug() {
		debugger;
	}
	
	/**
	Display an alert message box containing the given message.
	@deprecated Use Browser.alert() instead.
	*/
	static alert(v) {
		alert(Boot.__string_rec(v, ""));
	}
	static eval(code) {
		return eval(code);
	}
	static get undefined() {
		return this.get_undefined()
	}
	static get_undefined() {
		return undefined;
	}
	
	/**
	Re-throw last cathed exception, preserving original stack information.
	
	Calling this is only possible inside a catch statement.
	*/
	static rethrow() {
	}
	
	/**
	Get original caught exception object, before unwrapping the `js.Boot.HaxeError`.
	
	Can be useful if we want to redirect the original error into some external API (e.g. Promise or node.js callbacks).
	
	Calling this is only possible inside a catch statement.
	*/
	static getOriginalException() {
		return null;
	}
	
	/**
	Generate next unique id
	*/
	static getNextHaxeUID() {
		return $global.$haxeUID++;
	}
	static get __name__() {
		return "js.Lib"
	}
	get __class__() {
		return Lib
	}
}


//# sourceMappingURL=Lib.js.map