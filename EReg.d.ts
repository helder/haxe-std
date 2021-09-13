
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
export declare class EReg {
	constructor(r: string, opt: string)
	protected r: RegExp
	
	/**
	Tells if `this` regular expression matches String `s`.
	
	This method modifies the internal state.
	
	If `s` is `null`, the result is unspecified.
	*/
	match(s: string): boolean
	
	/**
	Returns the matched sub-group `n` of `this` EReg.
	
	This method should only be called after `this.match` or
	`this.matchSub`, and then operates on the String of that operation.
	
	The index `n` corresponds to the n-th set of parentheses in the pattern
	of `this` EReg. If no such sub-group exists, the result is unspecified.
	
	If `n` equals 0, the whole matched substring is returned.
	*/
	matched(n: number): string
	
	/**
	Returns the part to the left of the last matched substring.
	
	If the most recent call to `this.match` or `this.matchSub` did not
	match anything, the result is unspecified.
	
	If the global g modifier was in place for the matching, only the
	substring to the left of the leftmost match is returned.
	
	The result does not include the matched part.
	*/
	matchedLeft(): string
	
	/**
	Returns the part to the right of the last matched substring.
	
	If the most recent call to `this.match` or `this.matchSub` did not
	match anything, the result is unspecified.
	
	If the global g modifier was in place for the matching, only the
	substring to the right of the leftmost match is returned.
	
	The result does not include the matched part.
	*/
	matchedRight(): string
	
	/**
	Returns the position and length of the last matched substring, within
	the String which was last used as argument to `this.match` or
	`this.matchSub`.
	
	If the most recent call to `this.match` or `this.matchSub` did not
	match anything, the result is unspecified.
	
	If the global g modifier was in place for the matching, the position and
	length of the leftmost substring is returned.
	*/
	matchedPos(): {len: number, pos: number}
	
	/**
	Tells if `this` regular expression matches a substring of String `s`.
	
	This function expects `pos` and `len` to describe a valid substring of
	`s`, or else the result is unspecified. To get more robust behavior,
	`this.match(s.substr(pos,len))` can be used instead.
	
	This method modifies the internal state.
	
	If `s` is null, the result is unspecified.
	*/
	matchSub(s: string, pos: number, len?: number): boolean
	
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
	split(s: string): string[]
	
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
	replace(s: string, by: string): string
	
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
	map(s: string, f: ((arg0: EReg) => string)): string
	
	/**
	Escape the string `s` for use as a part of regular expression.
	
	If `s` is null, the result is unspecified.
	*/
	static escape(s: string): string
	protected static escapeRe: RegExp
}

//# sourceMappingURL=EReg.d.ts.map