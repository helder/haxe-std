import {Register} from "../genes/Register"
import {Std} from "../Std"

/**
Log primarily provides the `trace()` method, which is invoked upon a call to
`trace()` in Haxe code.
*/
export const Log = Register.global("$hxClasses")["haxe.Log"] = 
class Log {
	
	/**
	Format the output of `trace` before printing it.
	*/
	static formatOutput(v, infos) {
		var str = Std.string(v);
		if (infos == null) {
			return str;
		};
		var pstr = infos.fileName + ":" + infos.lineNumber;
		if (infos.customParams != null) {
			var _g = 0;
			var _g1 = infos.customParams;
			while (_g < _g1.length) {
				var v1 = _g1[_g];
				++_g;
				str += ", " + Std.string(v1);
			};
		};
		return pstr + ": " + str;
	}
	
	/**
	Outputs `v` in a platform-dependent way.
	
	The second parameter `infos` is injected by the compiler and contains
	information about the position where the `trace()` call was made.
	
	This method can be rebound to a custom function:
	
	var oldTrace = haxe.Log.trace; // store old function
	haxe.Log.trace = function(v, ?infos) {
	// handle trace
	}
	...
	haxe.Log.trace = oldTrace;
	
	If it is bound to null, subsequent calls to `trace()` will cause an
	exception.
	*/
	static trace(v, infos = null) {
		var str = Log.formatOutput(v, infos);
		if (typeof(console) != "undefined" && console.log != null) {
			console.log(str);
		};
	}
	static get __name__() {
		return "haxe.Log"
	}
	get __class__() {
		return Log
	}
}


//# sourceMappingURL=Log.js.map