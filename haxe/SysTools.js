import {Register} from "../genes/Register.js"
import {StringTools} from "../StringTools.js"
import {StringBuf} from "../StringBuf.js"
import {Std} from "../Std.js"
import {HxOverrides} from "../HxOverrides.js"
import {EReg} from "../EReg.js"

export const SysTools = Register.global("$hxClasses")["haxe.SysTools"] = 
class SysTools {
	
	/**
	Returns a String that can be used as a single command line argument
	on Unix.
	The input will be quoted, or escaped if necessary.
	*/
	static quoteUnixArg(argument) {
		if (argument == "") {
			return "''";
		};
		if (!new EReg("[^a-zA-Z0-9_@%+=:,./-]", "").match(argument)) {
			return argument;
		};
		return "'" + StringTools.replace(argument, "'", "'\"'\"'") + "'";
	}
	
	/**
	Returns a String that can be used as a single command line argument
	on Windows.
	The input will be quoted, or escaped if necessary, such that the output
	will be parsed as a single argument using the rule specified in
	http://msdn.microsoft.com/en-us/library/ms880421
	
	Examples:
	```haxe
	quoteWinArg("abc") == "abc";
	quoteWinArg("ab c") == '"ab c"';
	```
	*/
	static quoteWinArg(argument, escapeMetaCharacters) {
		if (!new EReg("^[^ \t\\\\\"]+$", "").match(argument)) {
			var result_b = "";
			var needquote = argument.indexOf(" ") != -1 || argument.indexOf("\t") != -1 || argument == "";
			if (needquote) {
				result_b += "\"";
			};
			var bs_buf = new StringBuf();
			var _g = 0;
			var _g1 = argument.length;
			while (_g < _g1) {
				var i = _g++;
				var _g2 = HxOverrides.cca(argument, i);
				if (_g2 == null) {
					var c = _g2;
					if (bs_buf.b.length > 0) {
						result_b += Std.string(bs_buf.b);
						bs_buf = new StringBuf();
					};
					result_b += String.fromCodePoint(c);
				} else {
					switch (_g2) {
						case 34:
							var bs = bs_buf.b;
							result_b += (bs == null) ? "null" : "" + bs;
							result_b += (bs == null) ? "null" : "" + bs;
							bs_buf = new StringBuf();
							result_b += "\\\"";
							break
						case 92:
							bs_buf.b += "\\";
							break
						default:
						var c1 = _g2;
						if (bs_buf.b.length > 0) {
							result_b += Std.string(bs_buf.b);
							bs_buf = new StringBuf();
						};
						result_b += String.fromCodePoint(c1);
						
					};
				};
			};
			result_b += Std.string(bs_buf.b);
			if (needquote) {
				result_b += Std.string(bs_buf.b);
				result_b += "\"";
			};
			argument = result_b;
		};
		if (escapeMetaCharacters) {
			var result_b1 = "";
			var _g3 = 0;
			var _g11 = argument.length;
			while (_g3 < _g11) {
				var i1 = _g3++;
				var c2 = HxOverrides.cca(argument, i1);
				if (SysTools.winMetaCharacters.indexOf(c2) >= 0) {
					result_b1 += String.fromCodePoint(94);
				};
				result_b1 += String.fromCodePoint(c2);
			};
			return result_b1;
		} else {
			return argument;
		};
	}
	static get __name__() {
		return "haxe.SysTools"
	}
	get __class__() {
		return SysTools
	}
}


SysTools.winMetaCharacters = [32, 40, 41, 37, 33, 94, 34, 60, 62, 38, 124, 10, 13, 44, 59]
//# sourceMappingURL=SysTools.js.map