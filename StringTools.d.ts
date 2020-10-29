import {StringKeyValueIterator} from "./haxe/iterators/StringKeyValueIterator"
import {StringIterator} from "./haxe/iterators/StringIterator"

/**
This class provides advanced methods on Strings. It is ideally used with
`using StringTools` and then acts as an [extension](https://haxe.org/manual/lf-static-extension.html)
to the `String` class.

If the first argument to any of the methods is null, the result is
unspecified.
*/
export declare class StringTools {
	
	/**
	Encode an URL by using the standard format.
	*/
	static urlEncode(s: string): string
	
	/**
	Decode an URL using the standard format.
	*/
	static urlDecode(s: string): string
	
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
	static htmlEscape(s: string, quotes?: null | boolean): string
	
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
	static htmlUnescape(s: string): string
	
	/**
	Returns `true` if `s` contains `value` and  `false` otherwise.
	
	When `value` is `null`, the result is unspecified.
	*/
	static contains(s: string, value: string): boolean
	
	/**
	Tells if the string `s` starts with the string `start`.
	
	If `start` is `null`, the result is unspecified.
	
	If `start` is the empty String `""`, the result is true.
	*/
	static startsWith(s: string, start: string): boolean
	
	/**
	Tells if the string `s` ends with the string `end`.
	
	If `end` is `null`, the result is unspecified.
	
	If `end` is the empty String `""`, the result is true.
	*/
	static endsWith(s: string, end: string): boolean
	
	/**
	Tells if the character in the string `s` at position `pos` is a space.
	
	A character is considered to be a space character if its character code
	is 9,10,11,12,13 or 32.
	
	If `s` is the empty String `""`, or if pos is not a valid position within
	`s`, the result is false.
	*/
	static isSpace(s: string, pos: number): boolean
	
	/**
	Removes leading space characters of `s`.
	
	This function internally calls `isSpace()` to decide which characters to
	remove.
	
	If `s` is the empty String `""` or consists only of space characters, the
	result is the empty String `""`.
	*/
	static ltrim(s: string): string
	
	/**
	Removes trailing space characters of `s`.
	
	This function internally calls `isSpace()` to decide which characters to
	remove.
	
	If `s` is the empty String `""` or consists only of space characters, the
	result is the empty String `""`.
	*/
	static rtrim(s: string): string
	
	/**
	Removes leading and trailing space characters of `s`.
	
	This is a convenience function for `ltrim(rtrim(s))`.
	*/
	static trim(s: string): string
	
	/**
	Concatenates `c` to `s` until `s.length` is at least `l`.
	
	If `c` is the empty String `""` or if `l` does not exceed `s.length`,
	`s` is returned unchanged.
	
	If `c.length` is 1, the resulting String length is exactly `l`.
	
	Otherwise the length may exceed `l`.
	
	If `c` is null, the result is unspecified.
	*/
	static lpad(s: string, c: string, l: number): string
	
	/**
	Appends `c` to `s` until `s.length` is at least `l`.
	
	If `c` is the empty String `""` or if `l` does not exceed `s.length`,
	`s` is returned unchanged.
	
	If `c.length` is 1, the resulting String length is exactly `l`.
	
	Otherwise the length may exceed `l`.
	
	If `c` is null, the result is unspecified.
	*/
	static rpad(s: string, c: string, l: number): string
	
	/**
	Replace all occurrences of the String `sub` in the String `s` by the
	String `by`.
	
	If `sub` is the empty String `""`, `by` is inserted after each character
	of `s` except the last one. If `by` is also the empty String `""`, `s`
	remains unchanged.
	
	If `sub` or `by` are null, the result is unspecified.
	*/
	static replace(s: string, sub: string, by: string): string
	
	/**
	Encodes `n` into a hexadecimal representation.
	
	If `digits` is specified, the resulting String is padded with "0" until
	its `length` equals `digits`.
	*/
	static hex(n: number, digits?: null | number): string
	
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
	static fastCodeAt(s: string, index: number): number
	
	/**
	Returns an iterator of the char codes.
	
	Note that char codes may differ across platforms because of different
	internal encoding of strings in different runtimes.
	For the consistent cross-platform UTF8 char codes see `haxe.iterators.StringIteratorUnicode`.
	*/
	static iterator(s: string): StringIterator
	
	/**
	Returns an iterator of the char indexes and codes.
	
	Note that char codes may differ across platforms because of different
	internal encoding of strings in different of runtimes.
	For the consistent cross-platform UTF8 char codes see `haxe.iterators.StringKeyValueIteratorUnicode`.
	*/
	static keyValueIterator(s: string): StringKeyValueIterator
	
	/**
	Tells if `c` represents the end-of-file (EOF) character.
	*/
	static isEof(c: number): boolean
	
	/**
	Returns a String that can be used as a single command line argument
	on Unix.
	The input will be quoted, or escaped if necessary.
	*/
	static quoteUnixArg(argument: string): string
	
	/**
	Character codes of the characters that will be escaped by `quoteWinArg(_, true)`.
	*/
	static winMetaCharacters: number[]
	
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
	static quoteWinArg(argument: string, escapeMetaCharacters: boolean): string
}

//# sourceMappingURL=StringTools.d.ts.map