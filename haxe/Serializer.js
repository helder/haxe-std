import {Boot, HaxeError} from "../js/Boot.js"
import {Bytes} from "./io/Bytes.js"
import {StringMap} from "./ds/StringMap.js"
import {ObjectMap} from "./ds/ObjectMap.js"
import {List} from "./ds/List.js"
import {IntMap} from "./ds/IntMap.js"
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
		var x = this.shash.inst.get(s);
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
		var vt = typeof(v);
		var _g = 0;
		var _g1 = this.cache.length;
		while (_g < _g1) {
			var i = _g++;
			var ci = this.cache[i];
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
		var _g = 0;
		var _g1 = Reflect.fields(v);
		while (_g < _g1.length) {
			var f = _g1[_g];
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
		var _g = Type["typeof"](v);
		switch (_g._hx_index) {
			case 0:
				this.buf.b += "n";
				break
			case 1:
				var v1 = v;
				if (v1 == 0) {
					this.buf.b += "z";
					return;
				};
				this.buf.b += "i";
				this.buf.b += (v1 == null) ? "null" : "" + v1;
				break
			case 2:
				var v2 = v;
				if (isNaN(v2)) {
					this.buf.b += "k";
				} else if (!isFinite(v2)) {
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
					var className = v.__name__;
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
				throw new HaxeError("Cannot serialize function");
				break
			case 6:
				var c = _g.c;
				if (c == String) {
					this.serializeString(v);
					return;
				};
				if (this.useCache && this.serializeRef(v)) {
					return;
				};
				switch (c) {
					case Array:
						var ucount = 0;
						this.buf.b += "a";
						var l = v["length"];
						var _g1 = 0;
						var _g11 = l;
						while (_g1 < _g11) {
							var i = _g1++;
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
						var d = v;
						this.buf.b += "v";
						this.buf.b += Std.string(d.getTime());
						break
					case IntMap:
						this.buf.b += "q";
						var v3 = v;
						var k = EsMap.adaptIterator(v3.inst.keys());
						while (k.hasNext()) {
							var k1 = k.next();
							this.buf.b += ":";
							this.buf.b += (k1 == null) ? "null" : "" + k1;
							this.serialize(v3.inst.get(k1));
						};
						this.buf.b += "h";
						break
					case List:
						this.buf.b += "l";
						var v4 = v;
						var _g_head = v4.h;
						while (_g_head != null) {
							var val = _g_head.item;
							_g_head = _g_head.next;
							var i1 = val;
							this.serialize(i1);
						};
						this.buf.b += "h";
						break
					case ObjectMap:
						this.buf.b += "M";
						var v5 = v;
						var k2 = EsMap.adaptIterator(v5.inst.keys());
						while (k2.hasNext()) {
							var k3 = k2.next();
							var id = Reflect.field(k3, "__id__");
							Reflect.deleteField(k3, "__id__");
							this.serialize(k3);
							k3["__id__"] = id;
							this.serialize(v5.inst.get(k3));
						};
						this.buf.b += "h";
						break
					case StringMap:
						this.buf.b += "b";
						var v6 = v;
						var k4 = EsMap.adaptIterator(v6.inst.keys());
						while (k4.hasNext()) {
							var k5 = k4.next();
							this.serializeString(k5);
							this.serialize(v6.inst.get(k5));
						};
						this.buf.b += "h";
						break
					case Bytes:
						var v7 = v;
						this.buf.b += "s";
						this.buf.b += Std.string(Math.ceil(v7.length * 8 / 6));
						this.buf.b += ":";
						var i2 = 0;
						var max = v7.length - 2;
						var b64 = Serializer.BASE64_CODES;
						if (b64 == null) {
							var this1 = new Array(Serializer.BASE64.length);
							b64 = this1;
							var _g2 = 0;
							var _g12 = Serializer.BASE64.length;
							while (_g2 < _g12) {
								var i3 = _g2++;
								b64[i3] = HxOverrides.cca(Serializer.BASE64, i3);
							};
							Serializer.BASE64_CODES = b64;
						};
						while (i2 < max) {
							var b1 = v7.b[i2++];
							var b2 = v7.b[i2++];
							var b3 = v7.b[i2++];
							this.buf.b += String.fromCodePoint(b64[b1 >> 2]);
							this.buf.b += String.fromCodePoint(b64[(b1 << 4 | b2 >> 4) & 63]);
							this.buf.b += String.fromCodePoint(b64[(b2 << 2 | b3 >> 6) & 63]);
							this.buf.b += String.fromCodePoint(b64[b3 & 63]);
						};
						if (i2 == max) {
							var b11 = v7.b[i2++];
							var b21 = v7.b[i2++];
							this.buf.b += String.fromCodePoint(b64[b11 >> 2]);
							this.buf.b += String.fromCodePoint(b64[(b11 << 4 | b21 >> 4) & 63]);
							this.buf.b += String.fromCodePoint(b64[b21 << 2 & 63]);
						} else if (i2 == max + 1) {
							var b12 = v7.b[i2++];
							this.buf.b += String.fromCodePoint(b64[b12 >> 2]);
							this.buf.b += String.fromCodePoint(b64[b12 << 4 & 63]);
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
				var e = _g.e;
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
					var e1 = v;
					this.serializeString(Register.global("$hxEnums")[e1.__enum__].__constructs__[e1._hx_index]);
				};
				this.buf.b += ":";
				var params = Type.enumParameters(v);
				this.buf.b += Std.string(params.length);
				var _g3 = 0;
				while (_g3 < params.length) {
					var p = params[_g3];
					++_g3;
					this.serialize(p);
				};
				if (this.useCache) {
					this.cache.push(v);
				};
				break
			default:
			throw new HaxeError("Cannot serialize " + Std.string(v));
			
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
		var s = new Serializer();
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