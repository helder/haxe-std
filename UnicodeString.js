import {StringKeyValueIteratorUnicode} from "./haxe/iterators/StringKeyValueIteratorUnicode"
import {StringIteratorUnicode} from "./haxe/iterators/StringIteratorUnicode"
import {Exception} from "./haxe/Exception"
import {Register} from "./genes/Register"
import {HxOverrides} from "./HxOverrides"

export const UnicodeString_Impl_ = Register.global("$hxClasses")["_UnicodeString.UnicodeString_Impl_"] = 
class UnicodeString_Impl_ {
	
	/**
	Tells if `b` is a correctly encoded UTF8 byte sequence.
	*/
	static validate(b, encoding) {
		switch (encoding._hx_index) {
			case 0:
				let data = b.b.bufferValue;
				let pos = 0;
				let max = b.length;
				while (pos < max) {
					let c = data.bytes[pos++];
					if (c >= 128) {
						if (c < 194) {
							return false;
						} else if (c < 224) {
							if (pos + 1 > max) {
								return false;
							};
							let c2 = data.bytes[pos++];
							if (c2 < 128 || c2 > 191) {
								return false;
							};
						} else if (c < 240) {
							if (pos + 2 > max) {
								return false;
							};
							let c2 = data.bytes[pos++];
							if (c == 224) {
								if (c2 < 160 || c2 > 191) {
									return false;
								};
							} else if (c2 < 128 || c2 > 191) {
								return false;
							};
							let c3 = data.bytes[pos++];
							if (c3 < 128 || c3 > 191) {
								return false;
							};
							c = c << 16 | c2 << 8 | c3;
							if (15573120 <= c && c <= 15581119) {
								return false;
							};
						} else if (c > 244) {
							return false;
						} else {
							if (pos + 3 > max) {
								return false;
							};
							let c2 = data.bytes[pos++];
							if (c == 240) {
								if (c2 < 144 || c2 > 191) {
									return false;
								};
							} else if (c == 244) {
								if (c2 < 128 || c2 > 143) {
									return false;
								};
							} else if (c2 < 128 || c2 > 191) {
								return false;
							};
							let c3 = data.bytes[pos++];
							if (c3 < 128 || c3 > 191) {
								return false;
							};
							let c4 = data.bytes[pos++];
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
		let this1 = string;
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
		let unicodeOffset = 0;
		let nativeOffset = 0;
		while (nativeOffset < this1.length) {
			let index1 = nativeOffset++;
			let c = this1.charCodeAt(index1);
			if (c >= 55296 && c <= 56319) {
				c = c - 55232 << 10 | this1.charCodeAt(index1 + 1) & 1023;
			};
			let c1 = c;
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
		let unicodeOffset = 0;
		let nativeOffset = 0;
		while (nativeOffset < this1.length) {
			let index1 = nativeOffset++;
			let c = this1.charCodeAt(index1);
			if (c >= 55296 && c <= 56319) {
				c = c - 55232 << 10 | this1.charCodeAt(index1 + 1) & 1023;
			};
			let c1 = c;
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
	static indexOf(this1, str, startIndex = null) {
		if (startIndex == null) {
			startIndex = 0;
		} else if (startIndex < 0) {
			startIndex = UnicodeString_Impl_.get_length(this1) + startIndex;
		};
		let unicodeOffset = 0;
		let nativeOffset = 0;
		let matchingOffset = 0;
		let result = -1;
		while (nativeOffset <= this1.length) {
			let c = this1.charCodeAt(nativeOffset);
			if (c >= 55296 && c <= 56319) {
				c = c - 55232 << 10 | this1.charCodeAt(nativeOffset + 1) & 1023;
			};
			let c1 = c;
			if (unicodeOffset >= startIndex) {
				let c = str.charCodeAt(matchingOffset);
				if (c >= 55296 && c <= 56319) {
					c = c - 55232 << 10 | str.charCodeAt(matchingOffset + 1) & 1023;
				};
				let c2 = c;
				if (c1 == c2) {
					if (matchingOffset == 0) {
						result = unicodeOffset;
					};
					++matchingOffset;
					if (c2 >= 65536) {
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
	static lastIndexOf(this1, str, startIndex = null) {
		if (startIndex == null) {
			startIndex = this1.length;
		} else if (startIndex < 0) {
			startIndex = 0;
		};
		let unicodeOffset = 0;
		let nativeOffset = 0;
		let result = -1;
		let lastIndex = -1;
		let matchingOffset = 0;
		let strUnicodeLength = UnicodeString_Impl_.get_length(str);
		while (nativeOffset < this1.length && unicodeOffset < startIndex + strUnicodeLength) {
			let c = this1.charCodeAt(nativeOffset);
			if (c >= 55296 && c <= 56319) {
				c = c - 55232 << 10 | this1.charCodeAt(nativeOffset + 1) & 1023;
			};
			let c1 = c;
			let c2 = str.charCodeAt(matchingOffset);
			if (c2 >= 55296 && c2 <= 56319) {
				c2 = c2 - 55232 << 10 | str.charCodeAt(matchingOffset + 1) & 1023;
			};
			let c21 = c2;
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
	static substr(this1, pos, len = null) {
		if (pos < 0) {
			pos = UnicodeString_Impl_.get_length(this1) + pos;
			if (pos < 0) {
				pos = 0;
			};
		};
		if (len != null) {
			if (len < 0) {
				len = UnicodeString_Impl_.get_length(this1) + len;
			};
			if (len <= 0) {
				return "";
			};
		};
		let unicodeOffset = 0;
		let nativeOffset = 0;
		let fromOffset = -1;
		let subLength = 0;
		while (nativeOffset < this1.length) {
			let c = this1.charCodeAt(nativeOffset);
			if (c >= 55296 && c <= 56319) {
				c = c - 55232 << 10 | this1.charCodeAt(nativeOffset + 1) & 1023;
			};
			let c1 = c;
			if (unicodeOffset >= pos) {
				if (fromOffset < 0) {
					if (len == null) {
						return HxOverrides.substr(this1, nativeOffset, null);
					};
					fromOffset = nativeOffset;
				};
				++subLength;
				if (subLength >= len) {
					let lastOffset = (c1 < 65536) ? nativeOffset : nativeOffset + 1;
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
	static substring(this1, startIndex, endIndex = null) {
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
				let tmp = startIndex;
				startIndex = endIndex;
				endIndex = tmp;
			};
		};
		let unicodeOffset = 0;
		let nativeOffset = 0;
		let fromOffset = -1;
		let subLength = 0;
		while (nativeOffset < this1.length) {
			let c = this1.charCodeAt(nativeOffset);
			if (c >= 55296 && c <= 56319) {
				c = c - 55232 << 10 | this1.charCodeAt(nativeOffset + 1) & 1023;
			};
			let c1 = c;
			if (startIndex <= unicodeOffset) {
				if (fromOffset < 0) {
					if (endIndex == null) {
						return HxOverrides.substr(this1, nativeOffset, null);
					};
					fromOffset = nativeOffset;
				};
				++subLength;
				if (subLength >= endIndex - startIndex) {
					let lastOffset = (c1 < 65536) ? nativeOffset : nativeOffset + 1;
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
		let l = 0;
		let _g_offset = 0;
		let _g_s = this1;
		while (_g_offset < _g_s.length) {
			let s = _g_s;
			let index = _g_offset++;
			let c = s.charCodeAt(index);
			if (c >= 55296 && c <= 56319) {
				c = c - 55232 << 10 | s.charCodeAt(index + 1) & 1023;
			};
			let c1 = c;
			if (c1 >= 65536) {
				++_g_offset;
			};
			let c2 = c1;
			++l;
		};
		return l;
	}
	static get __name__() {
		return "_UnicodeString.UnicodeString_Impl_"
	}
	get __class__() {
		return UnicodeString_Impl_
	}
}


//# sourceMappingURL=UnicodeString.js.map