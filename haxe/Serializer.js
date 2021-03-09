import {Boot} from "../js/Boot.js"
import {Bytes} from "./io/Bytes.js"
import {StringMap} from "./ds/StringMap.js"
import {ObjectMap} from "./ds/ObjectMap.js"
import {List} from "./ds/List.js"
import {IntMap} from "./ds/IntMap.js"
import {Exception} from "./Exception.js"
import {EsMap} from "../genes/util/EsMap.js"
import {Register} from "../genes/Register.js"
import {Type} from "../Type.js"
import {StringBuf} from "../StringBuf.js"
import {Std} from "../Std.js"
import {Reflect} from "../Reflect.js"
import {HxOverrides} from "../HxOverrides.js"

/**
The Serializer class can be used to encode values and objects into a `String`,
from which the `Unserializer` class can recreate the original representation.

This class can be used in two ways:

- create a `new Serializer()` instance, call its `serialize()` method with
any argument and finally retrieve the String representation from
`toString()`
- call `Serializer.run()` to obtain the serialized representation of a
single argument

Serialization is guaranteed to work for all haxe-defined classes, but may
or may not work for instances of external/native classes.

The specification of the serialization format can be found here:
<https://haxe.org/manual/std-serialization-format.html>
*/
export const Serializer = Register.global("$hxClasses")["haxe.Serializer"] = 
class Serializer extends Register.inherits() {
	new() {
		this.buf = new StringBuf();
		this.cache = new Array();
		this.useCache = Serializer.USE_CACHE;
		this.useEnumIndex = Serializer.USE_ENUM_INDEX;
		this.shash = new StringMap();
		this.scount = 0;
	}
	
	/**
	Return the String representation of `this` Serializer.
	
	The exact format specification can be found here:
	https://haxe.org/manual/serialization/format
	*/
	toString() {
		return this.buf.b;
	}
	serializeString(s) {
		let x = this.shash.inst.get(s);
		if (x != null) {
			this.buf.b += "R";
			this.buf.b += (x == null) ? "null" : "" + x;
			return;
		};
		this.shash.inst.set(s, this.scount++);
		this.buf.b += "y";
		s = encodeURIComponent(s);
		this.buf.b += Std.string(s.length);
		this.buf.b += ":";
		this.buf.b += (s == null) ? "null" : "" + s;
	}
	serializeRef(v) {
		let vt = typeof(v);
		let _g = 0;
		let _g1 = this.cache.length;
		while (_g < _g1) {
			let i = _g++;
			let ci = this.cache[i];
			if (typeof(ci) == vt && ci == v) {
				this.buf.b += "r";
				this.buf.b += (i == null) ? "null" : "" + i;
				return true;
			};
		};
		this.cache.push(v);
		return false;
	}
	serializeFields(v) {
		let _g = 0;
		let _g1 = Reflect.fields(v);
		while (_g < _g1.length) {
			let f = _g1[_g];
			++_g;
			this.serializeString(f);
			this.serialize(Reflect.field(v, f));
		};
		this.buf.b += "g";
	}
	
	/**
	Serializes `v`.
	
	All haxe-defined values and objects with the exception of functions can
	be serialized. Serialization of external/native objects is not
	guaranteed to work.
	
	The values of `this.useCache` and `this.useEnumIndex` may affect
	serialization output.
	*/
	serialize(v) {
		let _g = Type["typeof"](v);
		switch (_g._hx_index) {
			case 0:
				this.buf.b += "n";
				break
			case 1:
				let v1 = v;
				if (v1 == 0) {
					this.buf.b += "z";
					return;
				};
				this.buf.b += "i";
				this.buf.b += (v1 == null) ? "null" : "" + v1;
				break
			case 2:
				let v2 = v;
				if ((isNaN)(v2)) {
					this.buf.b += "k";
				} else if (!(isFinite)(v2)) {
					this.buf.b += (v2 < 0) ? "m" : "p";
				} else {
					this.buf.b += "d";
					this.buf.b += (v2 == null) ? "null" : "" + v2;
				};
				break
			case 3:
				this.buf.b += (v) ? "t" : "f";
				break
			case 4:
				if (Boot.__instanceof(v, "$hxCoreType__Class")) {
					let className = v.__name__;
					this.buf.b += "A";
					this.serializeString(className);
				} else if (Boot.__instanceof(v, "$hxCoreType__Enum")) {
					this.buf.b += "B";
					this.serializeString(v.__ename__);
				} else {
					if (this.useCache && this.serializeRef(v)) {
						return;
					};
					this.buf.b += "o";
					this.serializeFields(v);
				};
				break
			case 5:
				throw Exception.thrown("Cannot serialize function");
				break
			case 6:
				let c = _g.c;
				if (c == String) {
					this.serializeString(v);
					return;
				};
				if (this.useCache && this.serializeRef(v)) {
					return;
				};
				switch (c) {
					case Array:
						let ucount = 0;
						this.buf.b += "a";
						let l = v["length"];
						let _g1 = 0;
						let _g2 = l;
						while (_g1 < _g2) {
							let i = _g1++;
							if (v[i] == null) {
								++ucount;
							} else {
								if (ucount > 0) {
									if (ucount == 1) {
										this.buf.b += "n";
									} else {
										this.buf.b += "u";
										this.buf.b += (ucount == null) ? "null" : "" + ucount;
									};
									ucount = 0;
								};
								this.serialize(v[i]);
							};
						};
						if (ucount > 0) {
							if (ucount == 1) {
								this.buf.b += "n";
							} else {
								this.buf.b += "u";
								this.buf.b += (ucount == null) ? "null" : "" + ucount;
							};
						};
						this.buf.b += "h";
						break
					case Date:
						let d = v;
						this.buf.b += "v";
						this.buf.b += Std.string(d.getTime());
						break
					case IntMap:
						this.buf.b += "q";
						let v3 = v;
						let k = EsMap.adaptIterator(v3.inst.keys());
						while (k.hasNext()) {
							let k1 = k.next();
							this.buf.b += ":";
							this.buf.b += (k1 == null) ? "null" : "" + k1;
							this.serialize(v3.inst.get(k1));
						};
						this.buf.b += "h";
						break
					case List:
						this.buf.b += "l";
						let v4 = v;
						let _g_head = v4.h;
						while (_g_head != null) {
							let val = _g_head.item;
							_g_head = _g_head.next;
							let i = val;
							this.serialize(i);
						};
						this.buf.b += "h";
						break
					case ObjectMap:
						this.buf.b += "M";
						let v5 = v;
						let k1 = EsMap.adaptIterator(v5.inst.keys());
						while (k1.hasNext()) {
							let k = k1.next();
							let id = Reflect.field(k, "__id__");
							Reflect.deleteField(k, "__id__");
							this.serialize(k);
							k["__id__"] = id;
							this.serialize(v5.inst.get(k));
						};
						this.buf.b += "h";
						break
					case StringMap:
						this.buf.b += "b";
						let v6 = v;
						let k2 = EsMap.adaptIterator(v6.inst.keys());
						while (k2.hasNext()) {
							let k = k2.next();
							this.serializeString(k);
							this.serialize(v6.inst.get(k));
						};
						this.buf.b += "h";
						break
					case Bytes:
						let v7 = v;
						this.buf.b += "s";
						this.buf.b += Std.string(Math.ceil(v7.length * 8 / 6));
						this.buf.b += ":";
						let i = 0;
						let max = v7.length - 2;
						let b64 = Serializer.BASE64_CODES;
						if (b64 == null) {
							let this1 = new Array(Serializer.BASE64.length);
							b64 = this1;
							let _g = 0;
							let _g1 = Serializer.BASE64.length;
							while (_g < _g1) {
								let i = _g++;
								b64[i] = HxOverrides.cca(Serializer.BASE64, i);
							};
							Serializer.BASE64_CODES = b64;
						};
						while (i < max) {
							let b1 = v7.b[i++];
							let b2 = v7.b[i++];
							let b3 = v7.b[i++];
							this.buf.b += String.fromCodePoint(b64[b1 >> 2]);
							this.buf.b += String.fromCodePoint(b64[(b1 << 4 | b2 >> 4) & 63]);
							this.buf.b += String.fromCodePoint(b64[(b2 << 2 | b3 >> 6) & 63]);
							this.buf.b += String.fromCodePoint(b64[b3 & 63]);
						};
						if (i == max) {
							let b1 = v7.b[i++];
							let b2 = v7.b[i++];
							this.buf.b += String.fromCodePoint(b64[b1 >> 2]);
							this.buf.b += String.fromCodePoint(b64[(b1 << 4 | b2 >> 4) & 63]);
							this.buf.b += String.fromCodePoint(b64[b2 << 2 & 63]);
						} else if (i == max + 1) {
							let b1 = v7.b[i++];
							this.buf.b += String.fromCodePoint(b64[b1 >> 2]);
							this.buf.b += String.fromCodePoint(b64[b1 << 4 & 63]);
						};
						break
					default:
					if (this.useCache) {
						this.cache.pop();
					};
					if (v.hxSerialize != null) {
						this.buf.b += "C";
						this.serializeString(c.__name__);
						if (this.useCache) {
							this.cache.push(v);
						};
						v.hxSerialize(this);
						this.buf.b += "g";
					} else {
						this.buf.b += "c";
						this.serializeString(c.__name__);
						if (this.useCache) {
							this.cache.push(v);
						};
						this.serializeFields(v);
					};
					
				};
				break
			case 7:
				let e = _g.e;
				if (this.useCache) {
					if (this.serializeRef(v)) {
						return;
					};
					this.cache.pop();
				};
				this.buf.b += Std.string((this.useEnumIndex) ? "j" : "w");
				this.serializeString(e.__ename__);
				if (this.useEnumIndex) {
					this.buf.b += ":";
					this.buf.b += Std.string(v._hx_index);
				} else {
					let e = v;
					this.serializeString(Register.global("$hxEnums")[e.__enum__].__constructs__[e._hx_index]);
				};
				this.buf.b += ":";
				let params = Type.enumParameters(v);
				this.buf.b += Std.string(params.length);
				let _g3 = 0;
				while (_g3 < params.length) {
					let p = params[_g3];
					++_g3;
					this.serialize(p);
				};
				if (this.useCache) {
					this.cache.push(v);
				};
				break
			default:
			throw Exception.thrown("Cannot serialize " + Std.string(v));
			
		};
	}
	serializeException(e) {
		this.buf.b += "x";
		this.serialize(e);
	}
	
	/**
	Serializes `v` and returns the String representation.
	
	This is a convenience function for creating a new instance of
	Serializer, serialize `v` into it and obtain the result through a call
	to `toString()`.
	*/
	static run(v) {
		let s = new Serializer();
		s.serialize(v);
		return s.toString();
	}
	static get __name__() {
		return "haxe.Serializer"
	}
	get __class__() {
		return Serializer
	}
}


Serializer.USE_CACHE = false
Serializer.USE_ENUM_INDEX = false
Serializer.BASE64 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789%:"
Serializer.BASE64_CODES = null
//# sourceMappingURL=Serializer.js.map