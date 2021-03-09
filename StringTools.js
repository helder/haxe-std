import {StringKeyValueIterator} from "./haxe/iterators/StringKeyValueIterator.js"
import {StringIterator} from "./haxe/iterators/StringIterator.js"
import {SysTools} from "./haxe/SysTools.js"
import {Register} from "./genes/Register.js"
import {StringBuf} from "./StringBuf.js"
import {Std} from "./Std.js"
import {HxOverrides} from "./HxOverrides.js"
import {EReg} from "./EReg.js"

/**
This class provides advanced methods on Strings. It is ideally used with
`using StringTools` and then acts as an [extension](https://haxe.org/manual/lf-static-extension.html)
to the `String` class.

If the first argument to any of the methods is null, the result is
unspecified.
*/
export const StringTools = Register.global("$hxClasses")["StringTools"] = 
class StringTools {
	
	/**
	Encode an URL by using the standard format.
	*/
	static urlEncode(s) {
		return encodeURIComponent(s);
	}
	
	/**
	Decode an URL using the standard format.
	*/
	static urlDecode(s) {
		return decodeURIComponent(s.split("+").join(" "));
	}
	
	/**
	Escapes HTML special characters of the string `s`.
	
	The following replacements are made:
	
	- `&` becomes `&amp`;
	- `<` becomes `&lt`;
	- `>` becomes `&gt`;
	
	If `quotes` is true, the following characters are also replaced:
	
	- `"` becomes `&quot`;
	- `'` becomes `&#039`;
	*/
	static htmlEscape(s, quotes = null) {
		var buf_b = "";
		var _g_offset = 0;
		var _g_s = s;
		while (_g_offset < _g_s.length) {
			var s1 = _g_s;
			var index = _g_offset++;
			var c = s1.charCodeAt(index);
			if (c >= 55296 && c <= 56319) {
				c = c - 55232 << 10 | s1.charCodeAt(index + 1) & 1023;
			};
			var c1 = c;
			if (c1 >= 65536) {
				++_g_offset;
			};
			var code = c1;
			switch (code) {
				case 34:
					if (quotes) {
						buf_b += "&quot;";
					} else {
						buf_b += String.fromCodePoint(code);
					};
					break
				case 38:
					buf_b += "&amp;";
					break
				case 39:
					if (quotes) {
						buf_b += "&#039;";
					} else {
						buf_b += String.fromCodePoint(code);
					};
					break
				case 60:
					buf_b += "&lt;";
					break
				case 62:
					buf_b += "&gt;";
					break
				default:
				buf_b += String.fromCodePoint(code);
				
			};
		};
		return buf_b;
	}
	
	/**
	Unescapes HTML special characters of the string `s`.
	
	This is the inverse operation to htmlEscape, i.e. the following always
	holds: `htmlUnescape(htmlEscape(s)) == s`
	
	The replacements follow:
	
	- `&amp;` becomes `&`
	- `&lt;` becomes `<`
	- `&gt;` becomes `>`
	- `&quot;` becomes `"`
	- `&#039;` becomes `'`
	*/
	static htmlUnescape(s) {
		return s.split("&gt;").join(">").split("&lt;").join("<").split("&quot;").join("\"").split("&#039;").join("'").split("&amp;").join("&");
	}
	
	/**
	Returns `true` if `s` contains `value` and  `false` otherwise.
	
	When `value` is `null`, the result is unspecified.
	*/
	static contains(s, value) {
		return s.indexOf(value) != -1;
	}
	
	/**
	Tells if the string `s` starts with the string `start`.
	
	If `start` is `null`, the result is unspecified.
	
	If `start` is the empty String `""`, the result is true.
	*/
	static startsWith(s, start) {
		if (s.length >= start.length) {
			return s.lastIndexOf(start, 0) == 0;
		} else {
			return false;
		};
	}
	
	/**
	Tells if the string `s` ends with the string `end`.
	
	If `end` is `null`, the result is unspecified.
	
	If `end` is the empty String `""`, the result is true.
	*/
	static endsWith(s, end) {
		var elen = end.length;
		var slen = s.length;
		if (slen >= elen) {
			return s.indexOf(end, slen - elen) == slen - elen;
		} else {
			return false;
		};
	}
	
	/**
	Tells if the character in the string `s` at position `pos` is a space.
	
	A character is considered to be a space character if its character code
	is 9,10,11,12,13 or 32.
	
	If `s` is the empty String `""`, or if pos is not a valid position within
	`s`, the result is false.
	*/
	static isSpace(s, pos) {
		var c = HxOverrides.cca(s, pos);
		if (!(c > 8 && c < 14)) {
			return c == 32;
		} else {
			return true;
		};
	}
	
	/**
	Removes leading space characters of `s`.
	
	This function internally calls `isSpace()` to decide which characters to
	remove.
	
	If `s` is the empty String `""` or consists only of space characters, the
	result is the empty String `""`.
	*/
	static ltrim(s) {
		var l = s.length;
		var r = 0;
		while (r < l && StringTools.isSpace(s, r)) ++r;
		if (r > 0) {
			return HxOverrides.substr(s, r, l - r);
		} else {
			return s;
		};
	}
	
	/**
	Removes trailing space characters of `s`.
	
	This function internally calls `isSpace()` to decide which characters to
	remove.
	
	If `s` is the empty String `""` or consists only of space characters, the
	result is the empty String `""`.
	*/
	static rtrim(s) {
		var l = s.length;
		var r = 0;
		while (r < l && StringTools.isSpace(s, l - r - 1)) ++r;
		if (r > 0) {
			return HxOverrides.substr(s, 0, l - r);
		} else {
			return s;
		};
	}
	
	/**
	Removes leading and trailing space characters of `s`.
	
	This is a convenience function for `ltrim(rtrim(s))`.
	*/
	static trim(s) {
		return StringTools.ltrim(StringTools.rtrim(s));
	}
	
	/**
	Concatenates `c` to `s` until `s.length` is at least `l`.
	
	If `c` is the empty String `""` or if `l` does not exceed `s.length`,
	`s` is returned unchanged.
	
	If `c.length` is 1, the resulting String length is exactly `l`.
	
	Otherwise the length may exceed `l`.
	
	If `c` is null, the result is unspecified.
	*/
	static lpad(s, c, l) {
		if (c.length <= 0) {
			return s;
		};
		var buf_b = "";
		l -= s.length;
		while (buf_b.length < l) buf_b += (c == null) ? "null" : "" + c;
		buf_b += (s == null) ? "null" : "" + s;
		return buf_b;
	}
	
	/**
	Appends `c` to `s` until `s.length` is at least `l`.
	
	If `c` is the empty String `""` or if `l` does not exceed `s.length`,
	`s` is returned unchanged.
	
	If `c.length` is 1, the resulting String length is exactly `l`.
	
	Otherwise the length may exceed `l`.
	
	If `c` is null, the result is unspecified.
	*/
	static rpad(s, c, l) {
		if (c.length <= 0) {
			return s;
		};
		var buf_b = "";
		buf_b += (s == null) ? "null" : "" + s;
		while (buf_b.length < l) buf_b += (c == null) ? "null" : "" + c;
		return buf_b;
	}
	
	/**
	Replace all occurrences of the String `sub` in the String `s` by the
	String `by`.
	
	If `sub` is the empty String `""`, `by` is inserted after each character
	of `s` except the last one. If `by` is also the empty String `""`, `s`
	remains unchanged.
	
	If `sub` or `by` are null, the result is unspecified.
	*/
	static replace(s, sub, by) {
		return s.split(sub).join(by);
	}
	
	/**
	Encodes `n` into a hexadecimal representation.
	
	If `digits` is specified, the resulting String is padded with "0" until
	its `length` equals `digits`.
	*/
	static hex(n, digits = null) {
		var s = "";
		var hexChars = "0123456789ABCDEF";
		while (true) {
			s = hexChars.charAt(n & 15) + s;
			n >>>= 4;
			if (!(n > 0)) {
				break;
			};
		};
		if (digits != null) {
			while (s.length < digits) s = "0" + s;
		};
		return s;
	}
	
	/**
	Returns the character code at position `index` of String `s`, or an
	end-of-file indicator at if `position` equals `s.length`.
	
	This method is faster than `String.charCodeAt()` on some platforms, but
	the result is unspecified if `index` is negative or greater than
	`s.length`.
	
	End of file status can be checked by calling `StringTools.isEof()` with
	the returned value as argument.
	
	This operation is not guaranteed to work if `s` contains the `\0`
	character.
	*/
	static fastCodeAt(s, index) {
		return s.charCodeAt(index);
	}
	
	/**
	Returns an iterator of the char codes.
	
	Note that char codes may differ across platforms because of different
	internal encoding of strings in different runtimes.
	For the consistent cross-platform UTF8 char codes see `haxe.iterators.StringIteratorUnicode`.
	*/
	static iterator(s) {
		return new StringIterator(s);
	}
	
	/**
	Returns an iterator of the char indexes and codes.
	
	Note that char codes may differ across platforms because of different
	internal encoding of strings in different of runtimes.
	For the consistent cross-platform UTF8 char codes see `haxe.iterators.StringKeyValueIteratorUnicode`.
	*/
	static keyValueIterator(s) {
		return new StringKeyValueIterator(s);
	}
	
	/**
	Tells if `c` represents the end-of-file (EOF) character.
	*/
	static isEof(c) {
		return c != c;
	}
	
	/**
	Returns a String that can be used as a single command line argument
	on Unix.
	The input will be quoted, or escaped if necessary.
	*/
	static quoteUnixArg(argument) {
		if (argument == "") {
			return "''";
		} else if (!new EReg("[^a-zA-Z0-9_@%+=:,./-]", "").match(argument)) {
			return argument;
		} else {
			return "'" + StringTools.replace(argument, "'", "'\"'\"'") + "'";
		};
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
		var argument1 = argument;
		if (!new EReg("^[^ \t\\\\\"]+$", "").match(argument1)) {
			var result_b = "";
			var needquote = argument1.indexOf(" ") != -1 || argument1.indexOf("\t") != -1 || argument1 == "";
			if (needquote) {
				result_b += "\"";
			};
			var bs_buf = new StringBuf();
			var _g = 0;
			var _g1 = argument1.length;
			while (_g < _g1) {
				var i = _g++;
				var _g2 = HxOverrides.cca(argument1, i);
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
							result_b += Std.string(bs);
							result_b += Std.string(bs);
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
			argument1 = result_b;
		};
		if (escapeMetaCharacters) {
			var result_b1 = "";
			var _g3 = 0;
			var _g11 = argument1.length;
			while (_g3 < _g11) {
				var i1 = _g3++;
				var c2 = HxOverrides.cca(argument1, i1);
				if (SysTools.winMetaCharacters.indexOf(c2) >= 0) {
					result_b1 += String.fromCodePoint(94);
				};
				result_b1 += String.fromCodePoint(c2);
			};
			return result_b1;
		} else {
			return argument1;
		};
	}
	static utf16CodePointAt(s, index) {
		var c = s.charCodeAt(index);
		if (c >= 55296 && c <= 56319) {
			c = c - 55232 << 10 | s.charCodeAt(index + 1) & 1023;
		};
		return c;
	}
	static get __name__() {
		return "StringTools"
	}
	get __class__() {
		return StringTools
	}
}


Register.createStatic(StringTools, "winMetaCharacters", function () { return SysTools.winMetaCharacters })
StringTools.MIN_SURROGATE_CODE_POINT = 65536
//# sourceMappingURL=StringTools.js.map