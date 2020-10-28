import {Exception} from "./haxe/Exception"
import {Register} from "./genes/Register"
import {Std} from "./Std"
import {HxOverrides} from "./HxOverrides"

/**
The EReg class represents regular expressions.

While basic usage and patterns consistently work across platforms, some more
complex operations may yield different results. This is a necessary trade-
off to retain a certain level of performance.

EReg instances can be created by calling the constructor, or with the
special syntax `~/pattern/modifier`

EReg instances maintain an internal state, which is affected by several of
its methods.

A detailed explanation of the supported operations is available at
<https://haxe.org/manual/std-regex.html>
*/
export const EReg = Register.global("$hxClasses")["EReg"] = 
class EReg extends Register.inherits() {
	new(r, opt) {
		this.r = new RegExp(r, opt.split("u").join(""));
	}
	
	/**
	Tells if `this` regular expression matches String `s`.
	
	This method modifies the internal state.
	
	If `s` is `null`, the result is unspecified.
	*/
	match(s) {
		if (this.r.global) {
			this.r.lastIndex = 0;
		};
		this.r.m = this.r.exec(s);
		this.r.s = s;
		return this.r.m != null;
	}
	
	/**
	Returns the matched sub-group `n` of `this` EReg.
	
	This method should only be called after `this.match` or
	`this.matchSub`, and then operates on the String of that operation.
	
	The index `n` corresponds to the n-th set of parentheses in the pattern
	of `this` EReg. If no such sub-group exists, the result is unspecified.
	
	If `n` equals 0, the whole matched substring is returned.
	*/
	matched(n) {
		if (this.r.m != null && n >= 0 && n < this.r.m.length) {
			return this.r.m[n];
		} else {
			throw Exception.thrown("EReg::matched");
		};
	}
	
	/**
	Returns the part to the left of the last matched substring.
	
	If the most recent call to `this.match` or `this.matchSub` did not
	match anything, the result is unspecified.
	
	If the global g modifier was in place for the matching, only the
	substring to the left of the leftmost match is returned.
	
	The result does not include the matched part.
	*/
	matchedLeft() {
		if (this.r.m == null) {
			throw Exception.thrown("No string matched");
		};
		return HxOverrides.substr(this.r.s, 0, this.r.m.index);
	}
	
	/**
	Returns the part to the right of the last matched substring.
	
	If the most recent call to `this.match` or `this.matchSub` did not
	match anything, the result is unspecified.
	
	If the global g modifier was in place for the matching, only the
	substring to the right of the leftmost match is returned.
	
	The result does not include the matched part.
	*/
	matchedRight() {
		if (this.r.m == null) {
			throw Exception.thrown("No string matched");
		};
		let sz = this.r.m.index + this.r.m[0].length;
		return HxOverrides.substr(this.r.s, sz, this.r.s.length - sz);
	}
	
	/**
	Returns the position and length of the last matched substring, within
	the String which was last used as argument to `this.match` or
	`this.matchSub`.
	
	If the most recent call to `this.match` or `this.matchSub` did not
	match anything, the result is unspecified.
	
	If the global g modifier was in place for the matching, the position and
	length of the leftmost substring is returned.
	*/
	matchedPos() {
		if (this.r.m == null) {
			throw Exception.thrown("No string matched");
		};
		return {"pos": this.r.m.index, "len": this.r.m[0].length};
	}
	
	/**
	Tells if `this` regular expression matches a substring of String `s`.
	
	This function expects `pos` and `len` to describe a valid substring of
	`s`, or else the result is unspecified. To get more robust behavior,
	`this.match(s.substr(pos,len))` can be used instead.
	
	This method modifies the internal state.
	
	If `s` is null, the result is unspecified.
	*/
	matchSub(s, pos, len = -1) {
		if (this.r.global) {
			this.r.lastIndex = pos;
			this.r.m = this.r.exec((len < 0) ? s : HxOverrides.substr(s, 0, pos + len));
			let b = this.r.m != null;
			if (b) {
				this.r.s = s;
			};
			return b;
		} else {
			let b = this.match((len < 0) ? HxOverrides.substr(s, pos, null) : HxOverrides.substr(s, pos, len));
			if (b) {
				this.r.s = s;
				this.r.m.index += pos;
			};
			return b;
		};
	}
	
	/**
	Splits String `s` at all substrings `this` EReg matches.
	
	If a match is found at the start of `s`, the result contains a leading
	empty String "" entry.
	
	If a match is found at the end of `s`, the result contains a trailing
	empty String "" entry.
	
	If two matching substrings appear next to each other, the result
	contains the empty String `""` between them.
	
	By default, this method splits `s` into two parts at the first matched
	substring. If the global g modifier is in place, `s` is split at each
	matched substring.
	
	If `s` is null, the result is unspecified.
	*/
	split(s) {
		let d = "#__delim__#";
		return s.replace(this.r, d).split(d);
	}
	
	/**
	Replaces the first substring of `s` which `this` EReg matches with `by`.
	
	If `this` EReg does not match any substring, the result is `s`.
	
	By default, this method replaces only the first matched substring. If
	the global g modifier is in place, all matched substrings are replaced.
	
	If `by` contains `$1` to `$9`, the digit corresponds to number of a
	matched sub-group and its value is used instead. If no such sub-group
	exists, the replacement is unspecified. The string `$$` becomes `$`.
	
	If `s` or `by` are null, the result is unspecified.
	*/
	replace(s, by) {
		return s.replace(this.r, by);
	}
	
	/**
	Calls the function `f` for the substring of `s` which `this` EReg matches
	and replaces that substring with the result of `f` call.
	
	The `f` function takes `this` EReg object as its first argument and should
	return a replacement string for the substring matched.
	
	If `this` EReg does not match any substring, the result is `s`.
	
	By default, this method replaces only the first matched substring. If
	the global g modifier is in place, all matched substrings are replaced.
	
	If `s` or `f` are null, the result is unspecified.
	*/
	map(s, f) {
		let offset = 0;
		let buf_b = "";
		while (true) {
			if (offset >= s.length) {
				break;
			} else if (!this.matchSub(s, offset)) {
				buf_b += Std.string(HxOverrides.substr(s, offset, null));
				break;
			};
			let p = this.matchedPos();
			buf_b += Std.string(HxOverrides.substr(s, offset, p.pos - offset));
			buf_b += Std.string(f(this));
			if (p.len == 0) {
				buf_b += Std.string(HxOverrides.substr(s, p.pos, 1));
				offset = p.pos + 1;
			} else {
				offset = p.pos + p.len;
			};
			if (!this.r.global) {
				break;
			};
		};
		if (!this.r.global && offset > 0 && offset < s.length) {
			buf_b += Std.string(HxOverrides.substr(s, offset, null));
		};
		return buf_b;
	}
	
	/**
	Escape the string `s` for use as a part of regular expression.
	
	If `s` is null, the result is unspecified.
	*/
	static escape(s) {
		return s.replace(EReg.escapeRe, "\\$&");
	}
	static get __name__() {
		return "EReg"
	}
	get __class__() {
		return EReg
	}
}


EReg.escapeRe = new RegExp("[.*+?^${}()|[\\]\\\\]", "g")
//# sourceMappingURL=EReg.js.map