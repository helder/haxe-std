import {Bytes} from "./io/Bytes.js"
import {StringMap} from "./ds/StringMap.js"
import {ObjectMap} from "./ds/ObjectMap.js"
import {List} from "./ds/List.js"
import {IntMap} from "./ds/IntMap.js"
import {Exception} from "./Exception.js"
import {Register} from "../genes/Register.js"
import {Type} from "../Type.js"
import {HxOverrides} from "../HxOverrides.js"

const $global = Register.$global

export const DefaultResolver = Register.global("$hxClasses")["haxe._Unserializer.DefaultResolver"] = 
class DefaultResolver extends Register.inherits() {
	new() {
	}
	resolveClass(name) {
		return Register.global("$hxClasses")[name];
	}
	resolveEnum(name) {
		return Register.global("$hxEnums")[name];
	}
	static get __name__() {
		return "haxe._Unserializer.DefaultResolver"
	}
	get __class__() {
		return DefaultResolver
	}
}


/**
The `Unserializer` class is the complement to the `Serializer` class. It parses
a serialization `String` and creates objects from the contained data.

This class can be used in two ways:

- create a `new Unserializer()` instance with a given serialization
String, then call its `unserialize()` method until all values are
extracted
- call `Unserializer.run()`  to unserialize a single value from a given
String

The specification of the serialization format can be found here:
<https://haxe.org/manual/serialization/format>
*/
export const Unserializer = Register.global("$hxClasses")["haxe.Unserializer"] = 
class Unserializer extends Register.inherits() {
	new(buf) {
		this.buf = buf;
		this.length = this.buf.length;
		this.pos = 0;
		this.scache = new Array();
		this.cache = new Array();
		var r = Unserializer.DEFAULT_RESOLVER;
		if (r == null) {
			r = new DefaultResolver();
			Unserializer.DEFAULT_RESOLVER = r;
		};
		this.resolver = r;
	}
	
	/**
	Sets the type resolver of `this` Unserializer instance to `r`.
	
	If `r` is `null`, a special resolver is used which returns `null` for all
	input values.
	
	See `DEFAULT_RESOLVER` for more information on type resolvers.
	*/
	setResolver(r) {
		if (r == null) {
			if (NullResolver.instance == null) {
				NullResolver.instance = new NullResolver();
			};
			this.resolver = NullResolver.instance;
		} else {
			this.resolver = r;
		};
	}
	
	/**
	Gets the type resolver of `this` Unserializer instance.
	
	See `DEFAULT_RESOLVER` for more information on type resolvers.
	*/
	getResolver() {
		return this.resolver;
	}
	get(p) {
		return this.buf.charCodeAt(p);
	}
	readDigits() {
		var k = 0;
		var s = false;
		var fpos = this.pos;
		while (true) {
			var c = this.buf.charCodeAt(this.pos);
			if (c != c) {
				break;
			};
			if (c == 45) {
				if (this.pos != fpos) {
					break;
				};
				s = true;
				this.pos++;
				continue;
			};
			if (c < 48 || c > 57) {
				break;
			};
			k = k * 10 + (c - 48);
			this.pos++;
		};
		if (s) {
			k *= -1;
		};
		return k;
	}
	readFloat() {
		var p1 = this.pos;
		while (true) {
			var c = this.buf.charCodeAt(this.pos);
			if (c != c) {
				break;
			};
			if (c >= 43 && c < 58 || c == 101 || c == 69) {
				this.pos++;
			} else {
				break;
			};
		};
		return parseFloat(HxOverrides.substr(this.buf,p1,this.pos - p1));
	}
	unserializeObject(o) {
		while (true) {
			if (this.pos >= this.length) {
				throw Exception.thrown("Invalid object");
			};
			if (this.buf.charCodeAt(this.pos) == 103) {
				break;
			};
			var k = this.unserialize();
			if (typeof(k) != "string") {
				throw Exception.thrown("Invalid object key");
			};
			var v = this.unserialize();
			o[k] = v;
		};
		this.pos++;
	}
	unserializeEnum(edecl, tag) {
		if (this.buf.charCodeAt(this.pos++) != 58) {
			throw Exception.thrown("Invalid enum format");
		};
		var nargs = this.readDigits();
		if (nargs == 0) {
			return Type.createEnum(edecl, tag);
		};
		var args = new Array();
		while (nargs-- > 0) args.push(this.unserialize());
		return Type.createEnum(edecl, tag, args);
	}
	
	/**
	Unserializes the next part of `this` Unserializer instance and returns
	the according value.
	
	This function may call `this.resolver.resolveClass` to determine a
	Class from a String, and `this.resolver.resolveEnum` to determine an
	Enum from a String.
	
	If `this` Unserializer instance contains no more or invalid data, an
	exception is thrown.
	
	This operation may fail on structurally valid data if a type cannot be
	resolved or if a field cannot be set. This can happen when unserializing
	Strings that were serialized on a different Haxe target, in which the
	serialization side has to make sure not to include platform-specific
	data.
	
	Classes are created from `Type.createEmptyInstance`, which means their
	constructors are not called.
	*/
	unserialize() {
		switch (this.buf.charCodeAt(this.pos++)) {
			case 65:
				var name = this.unserialize();
				var cl = this.resolver.resolveClass(name);
				if (cl == null) {
					throw Exception.thrown("Class not found " + name);
				};
				return cl;
				break
			case 66:
				var name = this.unserialize();
				var e = this.resolver.resolveEnum(name);
				if (e == null) {
					throw Exception.thrown("Enum not found " + name);
				};
				return e;
				break
			case 67:
				var name = this.unserialize();
				var cl = this.resolver.resolveClass(name);
				if (cl == null) {
					throw Exception.thrown("Class not found " + name);
				};
				var o = Object.create(cl.prototype);
				this.cache.push(o);
				o.hxUnserialize(this);
				if (this.buf.charCodeAt(this.pos++) != 103) {
					throw Exception.thrown("Invalid custom data");
				};
				return o;
				break
			case 77:
				var h = new ObjectMap();
				this.cache.push(h);
				var buf = this.buf;
				while (this.buf.charCodeAt(this.pos) != 104) {
					var s = this.unserialize();
					var value = this.unserialize();
					h.inst.set(s, value);
				};
				this.pos++;
				return h;
				break
			case 82:
				var n = this.readDigits();
				if (n < 0 || n >= this.scache.length) {
					throw Exception.thrown("Invalid string reference");
				};
				return this.scache[n];
				break
			case 97:
				var buf = this.buf;
				var a = new Array();
				this.cache.push(a);
				while (true) {
					var c = this.buf.charCodeAt(this.pos);
					if (c == 104) {
						this.pos++;
						break;
					};
					if (c == 117) {
						this.pos++;
						var n = this.readDigits();
						a[a.length + n - 1] = null;
					} else {
						a.push(this.unserialize());
					};
				};
				return a;
				break
			case 98:
				var h = new StringMap();
				this.cache.push(h);
				var buf = this.buf;
				while (this.buf.charCodeAt(this.pos) != 104) {
					var s = this.unserialize();
					var value = this.unserialize();
					h.inst.set(s, value);
				};
				this.pos++;
				return h;
				break
			case 99:
				var name = this.unserialize();
				var cl = this.resolver.resolveClass(name);
				if (cl == null) {
					throw Exception.thrown("Class not found " + name);
				};
				var o = Object.create(cl.prototype);
				this.cache.push(o);
				this.unserializeObject(o);
				return o;
				break
			case 100:
				return this.readFloat();
				break
			case 102:
				return false;
				break
			case 105:
				return this.readDigits();
				break
			case 106:
				var name = this.unserialize();
				var edecl = this.resolver.resolveEnum(name);
				if (edecl == null) {
					throw Exception.thrown("Enum not found " + name);
				};
				this.pos++;
				var index = this.readDigits();
				var _this = edecl.__constructs__;
				var result = new Array(_this.length);
				var _g = 0;
				var _g1 = _this.length;
				while (_g < _g1) {
					var i = _g++;
					result[i] = _this[i]._hx_name;
				};
				var tag = result[index];
				if (tag == null) {
					throw Exception.thrown("Unknown enum index " + name + "@" + index);
				};
				var e = this.unserializeEnum(edecl, tag);
				this.cache.push(e);
				return e;
				break
			case 107:
				return NaN;
				break
			case 108:
				var l = new List();
				this.cache.push(l);
				var buf = this.buf;
				while (this.buf.charCodeAt(this.pos) != 104) l.add(this.unserialize());
				this.pos++;
				return l;
				break
			case 109:
				return -Infinity;
				break
			case 110:
				return null;
				break
			case 111:
				var o = {};
				this.cache.push(o);
				this.unserializeObject(o);
				return o;
				break
			case 112:
				return Infinity;
				break
			case 113:
				var h = new IntMap();
				this.cache.push(h);
				var buf = this.buf;
				var c = this.buf.charCodeAt(this.pos++);
				while (c == 58) {
					var i = this.readDigits();
					var value = this.unserialize();
					h.inst.set(i, value);
					c = this.buf.charCodeAt(this.pos++);
				};
				if (c != 104) {
					throw Exception.thrown("Invalid IntMap format");
				};
				return h;
				break
			case 114:
				var n = this.readDigits();
				if (n < 0 || n >= this.cache.length) {
					throw Exception.thrown("Invalid reference");
				};
				return this.cache[n];
				break
			case 115:
				var len = this.readDigits();
				var buf = this.buf;
				if (this.buf.charCodeAt(this.pos++) != 58 || this.length - this.pos < len) {
					throw Exception.thrown("Invalid bytes length");
				};
				var codes = Unserializer.CODES;
				if (codes == null) {
					codes = Unserializer.initCodes();
					Unserializer.CODES = codes;
				};
				var i = this.pos;
				var rest = len & 3;
				var size = (len >> 2) * 3 + ((rest >= 2) ? rest - 1 : 0);
				var max = i + (len - rest);
				var bytes = new Bytes(new ArrayBuffer(size));
				var bpos = 0;
				while (i < max) {
					var c1 = codes[buf.charCodeAt(i++)];
					var c2 = codes[buf.charCodeAt(i++)];
					bytes.b[bpos++] = c1 << 2 | c2 >> 4;
					var c3 = codes[buf.charCodeAt(i++)];
					bytes.b[bpos++] = c2 << 4 | c3 >> 2;
					var c4 = codes[buf.charCodeAt(i++)];
					bytes.b[bpos++] = c3 << 6 | c4;
				};
				if (rest >= 2) {
					var c1 = codes[buf.charCodeAt(i++)];
					var c2 = codes[buf.charCodeAt(i++)];
					bytes.b[bpos++] = c1 << 2 | c2 >> 4;
					if (rest == 3) {
						var c3 = codes[buf.charCodeAt(i++)];
						bytes.b[bpos++] = c2 << 4 | c3 >> 2;
					};
				};
				this.pos += len;
				this.cache.push(bytes);
				return bytes;
				break
			case 116:
				return true;
				break
			case 118:
				var d;
				if (this.buf.charCodeAt(this.pos) >= 48 && this.buf.charCodeAt(this.pos) <= 57 && this.buf.charCodeAt(this.pos + 1) >= 48 && this.buf.charCodeAt(this.pos + 1) <= 57 && this.buf.charCodeAt(this.pos + 2) >= 48 && this.buf.charCodeAt(this.pos + 2) <= 57 && this.buf.charCodeAt(this.pos + 3) >= 48 && this.buf.charCodeAt(this.pos + 3) <= 57 && this.buf.charCodeAt(this.pos + 4) == 45) {
					d = HxOverrides.strDate(HxOverrides.substr(this.buf, this.pos, 19));
					this.pos += 19;
				} else {
					d = new Date(this.readFloat());
				};
				this.cache.push(d);
				return d;
				break
			case 119:
				var name = this.unserialize();
				var edecl = this.resolver.resolveEnum(name);
				if (edecl == null) {
					throw Exception.thrown("Enum not found " + name);
				};
				var e = this.unserializeEnum(edecl, this.unserialize());
				this.cache.push(e);
				return e;
				break
			case 120:
				throw Exception.thrown(this.unserialize());
				break
			case 121:
				var len = this.readDigits();
				if (this.buf.charCodeAt(this.pos++) != 58 || this.length - this.pos < len) {
					throw Exception.thrown("Invalid string length");
				};
				var s = HxOverrides.substr(this.buf, this.pos, len);
				this.pos += len;
				s = decodeURIComponent(s.split("+").join(" "));
				this.scache.push(s);
				return s;
				break
			case 122:
				return 0;
				break
			default:
			
		};
		this.pos--;
		throw Exception.thrown("Invalid char " + this.buf.charAt(this.pos) + " at position " + this.pos);
	}
	static initCodes() {
		var codes = new Array();
		var _g = 0;
		var _g1 = Unserializer.BASE64.length;
		while (_g < _g1) {
			var i = _g++;
			codes[Unserializer.BASE64.charCodeAt(i)] = i;
		};
		return codes;
	}
	
	/**
	Unserializes `v` and returns the according value.
	
	This is a convenience function for creating a new instance of
	Unserializer with `v` as buffer and calling its `unserialize()` method
	once.
	*/
	static run(v) {
		return new Unserializer(v).unserialize();
	}
	static fastLength(s) {
		return s.length;
	}
	static fastCharCodeAt(s, pos) {
		return HxOverrides.cca(s, pos);
	}
	static fastCharAt(s, pos) {
		return s.charAt(pos);
	}
	static fastSubstr(s, pos, length) {
		return HxOverrides.substr(s, pos, length);
	}
	static get __name__() {
		return "haxe.Unserializer"
	}
	get __class__() {
		return Unserializer
	}
}


Unserializer.DEFAULT_RESOLVER = new DefaultResolver()
Unserializer.BASE64 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789%:"
Unserializer.CODES = null
export const NullResolver = Register.global("$hxClasses")["haxe._Unserializer.NullResolver"] = 
class NullResolver extends Register.inherits() {
	new() {
	}
	resolveClass(name) {
		return null;
	}
	resolveEnum(name) {
		return null;
	}
	static get_instance() {
		if (NullResolver.instance == null) {
			NullResolver.instance = new NullResolver();
		};
		return NullResolver.instance;
	}
	static get __name__() {
		return "haxe._Unserializer.NullResolver"
	}
	get __class__() {
		return NullResolver
	}
}


//# sourceMappingURL=Unserializer.js.map