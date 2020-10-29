import {StringKeyValueIteratorUnicode} from "./haxe/iterators/StringKeyValueIteratorUnicode"
import {StringIteratorUnicode} from "./haxe/iterators/StringIteratorUnicode"
import {Encoding} from "./haxe/io/Encoding"
import {Bytes} from "./haxe/io/Bytes"

export declare class UnicodeString_Impl_ {
	
	/**
	Tells if `b` is a correctly encoded UTF8 byte sequence.
	*/
	static validate(b: Bytes, encoding: Encoding): boolean
	
	/**
	Creates an instance of UnicodeString.
	*/
	static _new(string: string): string
	
	/**
	Returns an iterator of the unicode code points.
	*/
	static iterator($this: string): StringIteratorUnicode
	
	/**
	Returns an iterator of the code point indices and unicode code points.
	*/
	static keyValueIterator($this: string): StringKeyValueIteratorUnicode
	
	/**
	The number of characters in `this` String.
	*/
	static readonly length: number
	
	/**
	Returns the character at position `index` of `this` String.
	
	If `index` is negative or exceeds `this.length`, the empty String `""`
	is returned.
	*/
	static charAt($this: string, index: number): string
	
	/**
	Returns the character code at position `index` of `this` String.
	
	If `index` is negative or exceeds `this.length`, `null` is returned.
	*/
	static charCodeAt($this: string, index: number): null | number
	
	/**
	Returns the position of the leftmost occurrence of `str` within `this`
	String.
	
	If `startIndex` is given, the search is performed within the substring
	of `this` String starting from `startIndex` (if `startIndex` is posivite
	or 0) or `max(this.length + startIndex, 0)` (if `startIndex` is negative).
	
	If `startIndex` exceeds `this.length`, -1 is returned.
	
	Otherwise the search is performed within `this` String. In either case,
	the returned position is relative to the beginning of `this` String.
	
	If `str` cannot be found, -1 is returned.
	*/
	static indexOf($this: string, str: string, startIndex?: null | number): number
	
	/**
	Returns the position of the rightmost occurrence of `str` within `this`
	String.
	
	If `startIndex` is given, the search is performed within the substring
	of `this` String from 0 to `startIndex + str.length`. Otherwise the search
	is performed within `this` String. In either case, the returned position
	is relative to the beginning of `this` String.
	
	If `str` cannot be found, -1 is returned.
	*/
	static lastIndexOf($this: string, str: string, startIndex?: null | number): number
	
	/**
	Returns `len` characters of `this` String, starting at position `pos`.
	
	If `len` is omitted, all characters from position `pos` to the end of
	`this` String are included.
	
	If `pos` is negative, its value is calculated from the end of `this`
	String by `this.length + pos`. If this yields a negative value, 0 is
	used instead.
	
	If the calculated position + `len` exceeds `this.length`, the characters
	from that position to the end of `this` String are returned.
	
	If `len` is negative, the result is unspecified.
	*/
	static substr($this: string, pos: number, len?: null | number): string
	
	/**
	Returns the part of `this` String from `startIndex` to but not including `endIndex`.
	
	If `startIndex` or `endIndex` are negative, 0 is used instead.
	
	If `startIndex` exceeds `endIndex`, they are swapped.
	
	If the (possibly swapped) `endIndex` is omitted or exceeds
	`this.length`, `this.length` is used instead.
	
	If the (possibly swapped) `startIndex` exceeds `this.length`, the empty
	String `""` is returned.
	*/
	static substring($this: string, startIndex: number, endIndex?: null | number): string
}

//# sourceMappingURL=UnicodeString.d.ts.map