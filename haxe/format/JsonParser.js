import {Exception} from "../Exception"
import {Register} from "../../genes/Register"
import {StringBuf} from "../../StringBuf"
import {Std} from "../../Std"
import {HxOverrides} from "../../HxOverrides"

/**
An implementation of JSON parser in Haxe.

This class is used by `haxe.Json` when native JSON implementation
is not available.

@see https://haxe.org/manual/std-Json-parsing.html
*/
export const JsonParser = Register.global("$hxClasses")["haxe.format.JsonParser"] = 
class JsonParser extends Register.inherits() {
	new(str) {
		this.str = str;
		this.pos = 0;
	}
	doParse() {
		let result = this.parseRec();
		let c;
		while (true) {
			c = this.str.charCodeAt(this.pos++);
			let c1 = c;
			if (!(c1 == c1)) {
				break;
			};
			switch (c) {
				case 9:case 10:case 13:case 32:
					break
				default:
				this.invalidChar();
				
			};
		};
		return result;
	}
	parseRec() {
		while (true) {
			let c = this.str.charCodeAt(this.pos++);
			switch (c) {
				case 9:case 10:case 13:case 32:
					break
				case 34:
					return this.parseString();
					break
				case 45:case 48:case 49:case 50:case 51:case 52:case 53:case 54:case 55:case 56:case 57:
					let c1 = c;
					let start = this.pos - 1;
					let minus = c1 == 45;
					let digit = !minus;
					let zero = c1 == 48;
					let point = false;
					let e = false;
					let pm = false;
					let end = false;
					while (true) {
						c1 = this.str.charCodeAt(this.pos++);
						switch (c1) {
							case 43:case 45:
								if (!e || pm) {
									this.invalidNumber(start);
								};
								digit = false;
								pm = true;
								break
							case 46:
								if (minus || point || e) {
									this.invalidNumber(start);
								};
								digit = false;
								point = true;
								break
							case 48:
								if (zero && !point) {
									this.invalidNumber(start);
								};
								if (minus) {
									minus = false;
									zero = true;
								};
								digit = true;
								break
							case 49:case 50:case 51:case 52:case 53:case 54:case 55:case 56:case 57:
								if (zero && !point) {
									this.invalidNumber(start);
								};
								if (minus) {
									minus = false;
								};
								digit = true;
								zero = false;
								break
							case 69:case 101:
								if (minus || zero || e) {
									this.invalidNumber(start);
								};
								digit = false;
								e = true;
								break
							default:
							if (!digit) {
								this.invalidNumber(start);
							};
							this.pos--;
							end = true;
							
						};
						if (end) {
							break;
						};
					};
					let f = parseFloat(HxOverrides.substr(this.str,start,this.pos - start));
					let i = f | 0;
					if (i == f) {
						return i;
					} else {
						return f;
					};
					break
				case 91:
					let arr = [];
					let comma = null;
					while (true) {
						let c = this.str.charCodeAt(this.pos++);
						switch (c) {
							case 9:case 10:case 13:case 32:
								break
							case 44:
								if (comma) {
									comma = false;
								} else {
									this.invalidChar();
								};
								break
							case 93:
								if (comma == false) {
									this.invalidChar();
								};
								return arr;
								break
							default:
							if (comma) {
								this.invalidChar();
							};
							this.pos--;
							arr.push(this.parseRec());
							comma = true;
							
						};
					};
					break
				case 102:
					let save = this.pos;
					if (this.str.charCodeAt(this.pos++) != 97 || this.str.charCodeAt(this.pos++) != 108 || this.str.charCodeAt(this.pos++) != 115 || this.str.charCodeAt(this.pos++) != 101) {
						this.pos = save;
						this.invalidChar();
					};
					return false;
					break
				case 110:
					let save1 = this.pos;
					if (this.str.charCodeAt(this.pos++) != 117 || this.str.charCodeAt(this.pos++) != 108 || this.str.charCodeAt(this.pos++) != 108) {
						this.pos = save1;
						this.invalidChar();
					};
					return null;
					break
				case 116:
					let save2 = this.pos;
					if (this.str.charCodeAt(this.pos++) != 114 || this.str.charCodeAt(this.pos++) != 117 || this.str.charCodeAt(this.pos++) != 101) {
						this.pos = save2;
						this.invalidChar();
					};
					return true;
					break
				case 123:
					let obj = {};
					let field = null;
					let comma1 = null;
					while (true) {
						let c = this.str.charCodeAt(this.pos++);
						switch (c) {
							case 9:case 10:case 13:case 32:
								break
							case 34:
								if (field != null || comma1) {
									this.invalidChar();
								};
								field = this.parseString();
								break
							case 44:
								if (comma1) {
									comma1 = false;
								} else {
									this.invalidChar();
								};
								break
							case 58:
								if (field == null) {
									this.invalidChar();
								};
								obj[field] = this.parseRec();
								field = null;
								comma1 = true;
								break
							case 125:
								if (field != null || comma1 == false) {
									this.invalidChar();
								};
								return obj;
								break
							default:
							this.invalidChar();
							
						};
					};
					break
				default:
				this.invalidChar();
				
			};
		};
	}
	parseString() {
		let start = this.pos;
		let buf = null;
		let prev = -1;
		while (true) {
			let c = this.str.charCodeAt(this.pos++);
			if (c == 34) {
				break;
			};
			if (c == 92) {
				if (buf == null) {
					buf = new StringBuf();
				};
				let s = this.str;
				let len = this.pos - start - 1;
				buf.b += (len == null) ? HxOverrides.substr(s, start, null) : HxOverrides.substr(s, start, len);
				c = this.str.charCodeAt(this.pos++);
				if (c != 117 && prev != -1) {
					buf.b += String.fromCodePoint(65533);
					prev = -1;
				};
				switch (c) {
					case 34:case 47:case 92:
						buf.b += String.fromCodePoint(c);
						break
					case 98:
						buf.b += String.fromCodePoint(8);
						break
					case 102:
						buf.b += String.fromCodePoint(12);
						break
					case 110:
						buf.b += String.fromCodePoint(10);
						break
					case 114:
						buf.b += String.fromCodePoint(13);
						break
					case 116:
						buf.b += String.fromCodePoint(9);
						break
					case 117:
						let uc = Std.parseInt("0x" + HxOverrides.substr(this.str, this.pos, 4));
						this.pos += 4;
						if (prev != -1) {
							if (uc < 56320 || uc > 57343) {
								buf.b += String.fromCodePoint(65533);
								prev = -1;
							} else {
								buf.b += String.fromCodePoint(((prev - 55296 << 10) + (uc - 56320) + 65536));
								prev = -1;
							};
						} else if (uc >= 55296 && uc <= 56319) {
							prev = uc;
						} else {
							buf.b += String.fromCodePoint(uc);
						};
						break
					default:
					throw Exception.thrown("Invalid escape sequence \\" + String.fromCodePoint(c) + " at position " + (this.pos - 1));
					
				};
				start = this.pos;
			} else if (c != c) {
				throw Exception.thrown("Unclosed string");
			};
		};
		if (prev != -1) {
			buf.b += String.fromCodePoint(65533);
			prev = -1;
		};
		if (buf == null) {
			return HxOverrides.substr(this.str, start, this.pos - start - 1);
		} else {
			let s = this.str;
			let len = this.pos - start - 1;
			buf.b += (len == null) ? HxOverrides.substr(s, start, null) : HxOverrides.substr(s, start, len);
			return buf.b;
		};
	}
	parseNumber(c) {
		let start = this.pos - 1;
		let minus = c == 45;
		let digit = !minus;
		let zero = c == 48;
		let point = false;
		let e = false;
		let pm = false;
		let end = false;
		while (true) {
			c = this.str.charCodeAt(this.pos++);
			switch (c) {
				case 43:case 45:
					if (!e || pm) {
						this.invalidNumber(start);
					};
					digit = false;
					pm = true;
					break
				case 46:
					if (minus || point || e) {
						this.invalidNumber(start);
					};
					digit = false;
					point = true;
					break
				case 48:
					if (zero && !point) {
						this.invalidNumber(start);
					};
					if (minus) {
						minus = false;
						zero = true;
					};
					digit = true;
					break
				case 49:case 50:case 51:case 52:case 53:case 54:case 55:case 56:case 57:
					if (zero && !point) {
						this.invalidNumber(start);
					};
					if (minus) {
						minus = false;
					};
					digit = true;
					zero = false;
					break
				case 69:case 101:
					if (minus || zero || e) {
						this.invalidNumber(start);
					};
					digit = false;
					e = true;
					break
				default:
				if (!digit) {
					this.invalidNumber(start);
				};
				this.pos--;
				end = true;
				
			};
			if (end) {
				break;
			};
		};
		let f = parseFloat(HxOverrides.substr(this.str,start,this.pos - start));
		let i = f | 0;
		if (i == f) {
			return i;
		} else {
			return f;
		};
	}
	nextChar() {
		return this.str.charCodeAt(this.pos++);
	}
	invalidChar() {
		this.pos--;
		throw Exception.thrown("Invalid char " + this.str.charCodeAt(this.pos) + " at position " + this.pos);
	}
	invalidNumber(start) {
		throw Exception.thrown("Invalid number at position " + start + ": " + HxOverrides.substr(this.str, start, this.pos - start));
	}
	
	/**
	Parses given JSON-encoded `str` and returns the resulting object.
	
	JSON objects are parsed into anonymous structures and JSON arrays
	are parsed into `Array<Dynamic>`.
	
	If given `str` is not valid JSON, an exception will be thrown.
	
	If `str` is null, the result is unspecified.
	*/
	static parse(str) {
		return new JsonParser(str).doParse();
	}
	static get __name__() {
		return "haxe.format.JsonParser"
	}
	get __class__() {
		return JsonParser
	}
}


//# sourceMappingURL=JsonParser.js.map