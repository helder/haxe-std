import {Bytes} from "./io/Bytes.js"
import {StringMap} from "./ds/StringMap.js"
import {ObjectMap} from "./ds/ObjectMap.js"
import {List} from "./ds/List.js"
import {IntMap} from "./ds/IntMap.js"
import {Exception} from "./Exception.js"
import {Register} from "../genes/Register.js"
import {Type} from "../Type.js"
import {HxOverrides} from "../HxOverrides.js"

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
		this.length = buf.length;
		this.pos = 0;
		this.scache = new Array();
		this.cache = new Array();
		let r = Unserializer.DEFAULT_RESOLVER;
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
		let k = 0;
		let s = false;
		let fpos = this.pos;
		while (true) {
			let c = this.buf.charCodeAt(this.pos);
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
		let p1 = this.pos;
		while (true) {
			let c = this.buf.charCodeAt(this.pos);
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
			let k = this.unserialize();
			if (typeof(k) != "string") {
				throw Exception.thrown("Invalid object key");
			};
			let v = this.unserialize();
			o[k] = v;
		};
		this.pos++;
	}
	unserializeEnum(edecl, tag) {
		if (this.buf.charCodeAt(this.pos++) != 58) {
			throw Exception.thrown("Invalid enum format");
		};
		let nargs = this.readDigits();
		if (nargs == 0) {
			return Type.createEnum(edecl, tag);
		};
		let args = new Array();
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
				let name = this.unserialize();
				let cl = this.resolver.resolveClass(name);
				if (cl == null) {
					throw Exception.thrown("Class not found " + name);
				};
				return cl;
				break
			case 66:
				let name1 = this.unserialize();
				let e = this.resolver.resolveEnum(name1);
				if (e == null) {
					throw Exception.thrown("Enum not found " + name1);
				};
				return e;
				break
			case 67:
				let name2 = this.unserialize();
				let cl1 = this.resolver.resolveClass(name2);
				if (cl1 == null) {
					throw Exception.thrown("Class not found " + name2);
				};
				let o = Object.create(cl1.prototype);
				this.cache.push(o);
				o.hxUnserialize(this);
				if (this.buf.charCodeAt(this.pos++) != 103) {
					throw Exception.thrown("Invalid custom data");
				};
				return o;
				break
			case 77:
				let h = new ObjectMap();
				this.cache.push(h);
				let buf = this.buf;
				while (this.buf.charCodeAt(this.pos) != 104) {
					let s = this.unserialize();
					let value = this.unserialize();
					h.inst.set(s, value);
				};
				this.pos++;
				return h;
				break
			case 82:
				let n = this.readDigits();
				if (n < 0 || n >= this.scache.length) {
					throw Exception.thrown("Invalid string reference");
				};
				return this.scache[n];
				break
			case 97:
				let buf1 = this.buf;
				let a = new Array();
				this.cache.push(a);
				while (true) {
					let c = this.buf.charCodeAt(this.pos);
					if (c == 104) {
						this.pos++;
						break;
					};
					if (c == 117) {
						this.pos++;
						let n = this.readDigits();
						a[a.length + n - 1] = null;
					} else {
						a.push(this.unserialize());
					};
				};
				return a;
				break
			case 98:
				let h1 = new StringMap();
				this.cache.push(h1);
				let buf2 = this.buf;
				while (this.buf.charCodeAt(this.pos) != 104) {
					let s = this.unserialize();
					let value = this.unserialize();
					h1.inst.set(s, value);
				};
				this.pos++;
				return h1;
				break
			case 99:
				let name3 = this.unserialize();
				let cl2 = this.resolver.resolveClass(name3);
				if (cl2 == null) {
					throw Exception.thrown("Class not found " + name3);
				};
				let o1 = Object.create(cl2.prototype);
				this.cache.push(o1);
				this.unserializeObject(o1);
				return o1;
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
				let name4 = this.unserialize();
				let edecl = this.resolver.resolveEnum(name4);
				if (edecl == null) {
					throw Exception.thrown("Enum not found " + name4);
				};
				this.pos++;
				let index = this.readDigits();
				let tag = edecl.__constructs__.slice()[index];
				if (tag == null) {
					throw Exception.thrown("Unknown enum index " + name4 + "@" + index);
				};
				let e1 = this.unserializeEnum(edecl, tag);
				this.cache.push(e1);
				return e1;
				break
			case 107:
				return NaN;
				break
			case 108:
				let l = new List();
				this.cache.push(l);
				let buf3 = this.buf;
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
				let o2 = {};
				this.cache.push(o2);
				this.unserializeObject(o2);
				return o2;
				break
			case 112:
				return Infinity;
				break
			case 113:
				let h2 = new IntMap();
				this.cache.push(h2);
				let buf4 = this.buf;
				let c = this.buf.charCodeAt(this.pos++);
				while (c == 58) {
					let i = this.readDigits();
					let value = this.unserialize();
					h2.inst.set(i, value);
					c = this.buf.charCodeAt(this.pos++);
				};
				if (c != 104) {
					throw Exception.thrown("Invalid IntMap format");
				};
				return h2;
				break
			case 114:
				let n1 = this.readDigits();
				if (n1 < 0 || n1 >= this.cache.length) {
					throw Exception.thrown("Invalid reference");
				};
				return this.cache[n1];
				break
			case 115:
				let len = this.readDigits();
				let buf5 = this.buf;
				if (this.buf.charCodeAt(this.pos++) != 58 || this.length - this.pos < len) {
					throw Exception.thrown("Invalid bytes length");
				};
				let codes = Unserializer.CODES;
				if (codes == null) {
					codes = Unserializer.initCodes();
					Unserializer.CODES = codes;
				};
				let i = this.pos;
				let rest = len & 3;
				let size = (len >> 2) * 3 + ((rest >= 2) ? rest - 1 : 0);
				let max = i + (len - rest);
				let bytes = new Bytes(new ArrayBuffer(size));
				let bpos = 0;
				while (i < max) {
					let c1 = codes[buf5.charCodeAt(i++)];
					let c2 = codes[buf5.charCodeAt(i++)];
					bytes.b[bpos++] = c1 << 2 | c2 >> 4;
					let c3 = codes[buf5.charCodeAt(i++)];
					bytes.b[bpos++] = c2 << 4 | c3 >> 2;
					let c4 = codes[buf5.charCodeAt(i++)];
					bytes.b[bpos++] = c3 << 6 | c4;
				};
				if (rest >= 2) {
					let c1 = codes[buf5.charCodeAt(i++)];
					let c2 = codes[buf5.charCodeAt(i++)];
					bytes.b[bpos++] = c1 << 2 | c2 >> 4;
					if (rest == 3) {
						let c3 = codes[buf5.charCodeAt(i++)];
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
				let d;
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
				let name5 = this.unserialize();
				let edecl1 = this.resolver.resolveEnum(name5);
				if (edecl1 == null) {
					throw Exception.thrown("Enum not found " + name5);
				};
				let e2 = this.unserializeEnum(edecl1, this.unserialize());
				this.cache.push(e2);
				return e2;
				break
			case 120:
				throw Exception.thrown(this.unserialize());
				break
			case 121:
				let len1 = this.readDigits();
				if (this.buf.charCodeAt(this.pos++) != 58 || this.length - this.pos < len1) {
					throw Exception.thrown("Invalid string length");
				};
				let s = HxOverrides.substr(this.buf, this.pos, len1);
				this.pos += len1;
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
		let codes = new Array();
		let _g = 0;
		let _g1 = Unserializer.BASE64.length;
		while (_g < _g1) {
			let i = _g++;
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