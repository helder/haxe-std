import {StringKeyValueIteratorUnicode} from "./haxe/iterators/StringKeyValueIteratorUnicode.js"
import {StringIteratorUnicode} from "./haxe/iterators/StringIteratorUnicode.js"
import {Exception} from "./haxe/Exception.js"
import {Register} from "./genes/Register.js"
import {HxOverrides} from "./HxOverrides.js"

const $global = Register.$global

export const UnicodeString = Register.global("$hxClasses")["_UnicodeString.UnicodeString"] = 
class UnicodeString {
	
	/**
	Tells if `b` is a correctly encoded UTF8 byte sequence.
	*/
	static validate(b, encoding) {
		switch (encoding._hx_index) {
			case 0:
				var data = b.b.bufferValue;
				var pos = 0;
				var max = b.length;
				while (pos < max) {
					var c = data.bytes[pos++];
					if (c >= 128) {
						if (c < 194) {
							return false;
						} else if (c < 224) {
							if (pos + 1 > max) {
								return false;
							};
							var c2 = data.bytes[pos++];
							if (c2 < 128 || c2 > 191) {
								return false;
							};
						} else if (c < 240) {
							if (pos + 2 > max) {
								return false;
							};
							var c21 = data.bytes[pos++];
							if (c == 224) {
								if (c21 < 160 || c21 > 191) {
									return false;
								};
							} else if (c21 < 128 || c21 > 191) {
								return false;
							};
							var c3 = data.bytes[pos++];
							if (c3 < 128 || c3 > 191) {
								return false;
							};
							c = c << 16 | c21 << 8 | c3;
							if (15573120 <= c && c <= 15581119) {
								return false;
							};
						} else if (c > 244) {
							return false;
						} else {
							if (pos + 3 > max) {
								return false;
							};
							var c22 = data.bytes[pos++];
							if (c == 240) {
								if (c22 < 144 || c22 > 191) {
									return false;
								};
							} else if (c == 244) {
								if (c22 < 128 || c22 > 143) {
									return false;
								};
							} else if (c22 < 128 || c22 > 191) {
								return false;
							};
							var c31 = data.bytes[pos++];
							if (c31 < 128 || c31 > 191) {
								return false;
							};
							var c4 = data.bytes[pos++];
							if (c4 < 128 || c4 > 191) {
								return false;
							};
						};
					};
				};
				return true;
				break
			case 1:
				throw Exception.thrown("UnicodeString.validate: RawNative encoding is not supported");
				break
			
		};
	}
	
	/**
	Creates an instance of UnicodeString.
	*/
	static _new(string) {
		var this1 = string;
		return this1;
	}
	
	/**
	Returns an iterator of the unicode code points.
	*/
	static iterator(this1) {
		return new StringIteratorUnicode(this1);
	}
	
	/**
	Returns an iterator of the code point indices and unicode code points.
	*/
	static keyValueIterator(this1) {
		return new StringKeyValueIteratorUnicode(this1);
	}
	static get length() {
		return this.get_length()
	}
	
	/**
	Returns the character at position `index` of `this` String.
	
	If `index` is negative or exceeds `this.length`, the empty String `""`
	is returned.
	*/
	static charAt(this1, index) {
		if (index < 0) {
			return "";
		};
		var unicodeOffset = 0;
		var nativeOffset = 0;
		while (nativeOffset < this1.length) {
			var index1 = nativeOffset++;
			var c = this1.charCodeAt(index1);
			if (c >= 55296 && c <= 56319) {
				c = c - 55232 << 10 | this1.charCodeAt(index1 + 1) & 1023;
			};
			var c1 = c;
			if (unicodeOffset == index) {
				return String.fromCodePoint(c1);
			};
			if (c1 >= 65536) {
				++nativeOffset;
			};
			++unicodeOffset;
		};
		return "";
	}
	
	/**
	Returns the character code at position `index` of `this` String.
	
	If `index` is negative or exceeds `this.length`, `null` is returned.
	*/
	static charCodeAt(this1, index) {
		if (index < 0) {
			return null;
		};
		var unicodeOffset = 0;
		var nativeOffset = 0;
		while (nativeOffset < this1.length) {
			var index1 = nativeOffset++;
			var c = this1.charCodeAt(index1);
			if (c >= 55296 && c <= 56319) {
				c = c - 55232 << 10 | this1.charCodeAt(index1 + 1) & 1023;
			};
			var c1 = c;
			if (unicodeOffset == index) {
				return c1;
			};
			if (c1 >= 65536) {
				++nativeOffset;
			};
			++unicodeOffset;
		};
		return null;
	}
	
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
	static indexOf(this1, str, startIndex) {
		if (startIndex == null) {
			startIndex = 0;
		} else if (startIndex < 0) {
			startIndex = UnicodeString.get_length(this1) + startIndex;
		};
		var unicodeOffset = 0;
		var nativeOffset = 0;
		var matchingOffset = 0;
		var result = -1;
		while (nativeOffset <= this1.length) {
			var c = this1.charCodeAt(nativeOffset);
			if (c >= 55296 && c <= 56319) {
				c = c - 55232 << 10 | this1.charCodeAt(nativeOffset + 1) & 1023;
			};
			var c1 = c;
			if (unicodeOffset >= startIndex) {
				var c2 = str.charCodeAt(matchingOffset);
				if (c2 >= 55296 && c2 <= 56319) {
					c2 = c2 - 55232 << 10 | str.charCodeAt(matchingOffset + 1) & 1023;
				};
				var c21 = c2;
				if (c1 == c21) {
					if (matchingOffset == 0) {
						result = unicodeOffset;
					};
					++matchingOffset;
					if (c21 >= 65536) {
						++matchingOffset;
					};
					if (matchingOffset == str.length) {
						return result;
					};
				} else if (matchingOffset != 0) {
					result = -1;
					matchingOffset = 0;
					continue;
				};
			};
			++nativeOffset;
			if (c1 >= 65536) {
				++nativeOffset;
			};
			++unicodeOffset;
		};
		return -1;
	}
	
	/**
	Returns the position of the rightmost occurrence of `str` within `this`
	String.
	
	If `startIndex` is given, the search is performed within the substring
	of `this` String from 0 to `startIndex + str.length`. Otherwise the search
	is performed within `this` String. In either case, the returned position
	is relative to the beginning of `this` String.
	
	If `str` cannot be found, -1 is returned.
	*/
	static lastIndexOf(this1, str, startIndex) {
		if (startIndex == null) {
			startIndex = this1.length;
		} else if (startIndex < 0) {
			startIndex = 0;
		};
		var unicodeOffset = 0;
		var nativeOffset = 0;
		var result = -1;
		var lastIndex = -1;
		var matchingOffset = 0;
		var strUnicodeLength = UnicodeString.get_length(str);
		while (nativeOffset < this1.length && unicodeOffset < startIndex + strUnicodeLength) {
			var c = this1.charCodeAt(nativeOffset);
			if (c >= 55296 && c <= 56319) {
				c = c - 55232 << 10 | this1.charCodeAt(nativeOffset + 1) & 1023;
			};
			var c1 = c;
			var c2 = str.charCodeAt(matchingOffset);
			if (c2 >= 55296 && c2 <= 56319) {
				c2 = c2 - 55232 << 10 | str.charCodeAt(matchingOffset + 1) & 1023;
			};
			var c21 = c2;
			if (c1 == c21) {
				if (matchingOffset == 0) {
					lastIndex = unicodeOffset;
				};
				++matchingOffset;
				if (c21 >= 65536) {
					++matchingOffset;
				};
				if (matchingOffset == str.length) {
					result = lastIndex;
					lastIndex = -1;
				};
			} else if (matchingOffset != 0) {
				lastIndex = -1;
				matchingOffset = 0;
				continue;
			};
			++nativeOffset;
			if (c1 >= 65536) {
				++nativeOffset;
			};
			++unicodeOffset;
		};
		return result;
	}
	
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
	static substr(this1, pos, len) {
		if (pos < 0) {
			pos = UnicodeString.get_length(this1) + pos;
			if (pos < 0) {
				pos = 0;
			};
		};
		if (len != null) {
			if (len < 0) {
				len = UnicodeString.get_length(this1) + len;
			};
			if (len <= 0) {
				return "";
			};
		};
		var unicodeOffset = 0;
		var nativeOffset = 0;
		var fromOffset = -1;
		var subLength = 0;
		while (nativeOffset < this1.length) {
			var c = this1.charCodeAt(nativeOffset);
			if (c >= 55296 && c <= 56319) {
				c = c - 55232 << 10 | this1.charCodeAt(nativeOffset + 1) & 1023;
			};
			var c1 = c;
			if (unicodeOffset >= pos) {
				if (fromOffset < 0) {
					if (len == null) {
						return HxOverrides.substr(this1, nativeOffset, null);
					};
					fromOffset = nativeOffset;
				};
				++subLength;
				if (subLength >= len) {
					var lastOffset = (c1 < 65536) ? nativeOffset : nativeOffset + 1;
					return HxOverrides.substr(this1, fromOffset, lastOffset - fromOffset + 1);
				};
			};
			nativeOffset += (c1 >= 65536) ? 2 : 1;
			++unicodeOffset;
		};
		if (fromOffset < 0) {
			return "";
		} else {
			return HxOverrides.substr(this1, fromOffset, null);
		};
	}
	
	/**
	Returns the part of `this` String from `startIndex` to but not including `endIndex`.
	
	If `startIndex` or `endIndex` are negative, 0 is used instead.
	
	If `startIndex` exceeds `endIndex`, they are swapped.
	
	If the (possibly swapped) `endIndex` is omitted or exceeds
	`this.length`, `this.length` is used instead.
	
	If the (possibly swapped) `startIndex` exceeds `this.length`, the empty
	String `""` is returned.
	*/
	static substring(this1, startIndex, endIndex) {
		if (startIndex < 0) {
			startIndex = 0;
		};
		if (endIndex != null) {
			if (endIndex < 0) {
				endIndex = 0;
			};
			if (startIndex == endIndex) {
				return "";
			};
			if (startIndex > endIndex) {
				var tmp = startIndex;
				startIndex = endIndex;
				endIndex = tmp;
			};
		};
		var unicodeOffset = 0;
		var nativeOffset = 0;
		var fromOffset = -1;
		var subLength = 0;
		while (nativeOffset < this1.length) {
			var c = this1.charCodeAt(nativeOffset);
			if (c >= 55296 && c <= 56319) {
				c = c - 55232 << 10 | this1.charCodeAt(nativeOffset + 1) & 1023;
			};
			var c1 = c;
			if (startIndex <= unicodeOffset) {
				if (fromOffset < 0) {
					if (endIndex == null) {
						return HxOverrides.substr(this1, nativeOffset, null);
					};
					fromOffset = nativeOffset;
				};
				++subLength;
				if (subLength >= endIndex - startIndex) {
					var lastOffset = (c1 < 65536) ? nativeOffset : nativeOffset + 1;
					return HxOverrides.substr(this1, fromOffset, lastOffset - fromOffset + 1);
				};
			};
			nativeOffset += (c1 >= 65536) ? 2 : 1;
			++unicodeOffset;
		};
		if (fromOffset < 0) {
			return "";
		} else {
			return HxOverrides.substr(this1, fromOffset, null);
		};
	}
	static get_length(this1) {
		var l = 0;
		var _g_offset = 0;
		var _g_s = this1;
		while (_g_offset < _g_s.length) {
			var s = _g_s;
			var index = _g_offset++;
			var c = s.charCodeAt(index);
			if (c >= 55296 && c <= 56319) {
				c = c - 55232 << 10 | s.charCodeAt(index + 1) & 1023;
			};
			var c1 = c;
			if (c1 >= 65536) {
				++_g_offset;
			};
			var c2 = c1;
			++l;
		};
		return l;
	}
	static get __name__() {
		return "_UnicodeString.UnicodeString_Impl_"
	}
	get __class__() {
		return UnicodeString
	}
}


//# sourceMappingURL=UnicodeString.js.map