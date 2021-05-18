import {Boot} from "../../js/Boot.js"
import {StringMap} from "../ds/StringMap.js"
import {EsMap} from "../../genes/util/EsMap.js"
import {Register} from "../../genes/Register.js"
import {Type} from "../../Type.js"
import {StringTools} from "../../StringTools.js"
import {StringBuf} from "../../StringBuf.js"
import {Std} from "../../Std.js"
import {Reflect} from "../../Reflect.js"
import {HxOverrides} from "../../HxOverrides.js"

/**
An implementation of JSON printer in Haxe.

This class is used by `haxe.Json` when native JSON implementation
is not available.

@see https://haxe.org/manual/std-Json-encoding.html
*/
export const JsonPrinter = Register.global("$hxClasses")["haxe.format.JsonPrinter"] = 
class JsonPrinter extends Register.inherits() {
	new(replacer, space) {
		this.replacer = replacer;
		this.indent = space;
		this.pretty = space != null;
		this.nind = 0;
		this.buf = new StringBuf();
	}
	ipad() {
		if (this.pretty) {
			let v = StringTools.lpad("", this.indent, this.nind * this.indent.length);
			this.buf.b += Std.string(v);
		};
	}
	newl() {
		if (this.pretty) {
			this.buf.b += String.fromCodePoint(10);
		};
	}
	write(k, v) {
		if (this.replacer != null) {
			v = this.replacer(k, v);
		};
		let _g = Type["typeof"](v);
		switch (_g._hx_index) {
			case 0:
				this.buf.b += "null";
				break
			case 1:
				this.buf.b += Std.string(v);
				break
			case 2:
				let v1 = ((isFinite)(v)) ? Std.string(v) : "null";
				this.buf.b += Std.string(v1);
				break
			case 3:
				this.buf.b += Std.string(v);
				break
			case 4:
				this.fieldsString(v, Reflect.fields(v));
				break
			case 5:
				this.buf.b += "\"<fun>\"";
				break
			case 6:
				let c = _g.c;
				if (c == String) {
					this.quote(v);
				} else if (c == Array) {
					let v1 = v;
					this.buf.b += String.fromCodePoint(91);
					let len = v1.length;
					let last = len - 1;
					let _g = 0;
					let _g1 = len;
					while (_g < _g1) {
						let i = _g++;
						if (i > 0) {
							this.buf.b += String.fromCodePoint(44);
						} else {
							this.nind++;
						};
						if (this.pretty) {
							this.buf.b += String.fromCodePoint(10);
						};
						if (this.pretty) {
							let v = StringTools.lpad("", this.indent, this.nind * this.indent.length);
							this.buf.b += Std.string(v);
						};
						this.write(i, v1[i]);
						if (i == last) {
							this.nind--;
							if (this.pretty) {
								this.buf.b += String.fromCodePoint(10);
							};
							if (this.pretty) {
								let v = StringTools.lpad("", this.indent, this.nind * this.indent.length);
								this.buf.b += Std.string(v);
							};
						};
					};
					this.buf.b += String.fromCodePoint(93);
				} else if (c == StringMap) {
					let v1 = v;
					let o = {};
					let k = EsMap.adaptIterator(v1.inst.keys());
					while (k.hasNext()) {
						let k1 = k.next();
						o[k1] = v1.inst.get(k1);
					};
					let v2 = o;
					this.fieldsString(v2, Reflect.fields(v2));
				} else if (c == Date) {
					let v1 = v;
					this.quote(HxOverrides.dateStr(v1));
				} else {
					this.classString(v);
				};
				break
			case 7:
				let _g1 = _g.e;
				let i = v._hx_index;
				this.buf.b += Std.string(i);
				break
			case 8:
				this.buf.b += "\"???\"";
				break
			
		};
	}
	classString(v) {
		this.fieldsString(v, Type.getInstanceFields(Boot.getClass(v)));
	}
	objString(v) {
		this.fieldsString(v, Reflect.fields(v));
	}
	fieldsString(v, fields) {
		this.buf.b += String.fromCodePoint(123);
		let len = fields.length;
		let last = len - 1;
		let first = true;
		let _g = 0;
		let _g1 = len;
		while (_g < _g1) {
			let i = _g++;
			let f = fields[i];
			let value = Reflect.field(v, f);
			if (Reflect.isFunction(value)) {
				continue;
			};
			if (first) {
				this.nind++;
				first = false;
			} else {
				this.buf.b += String.fromCodePoint(44);
			};
			if (this.pretty) {
				this.buf.b += String.fromCodePoint(10);
			};
			if (this.pretty) {
				let v = StringTools.lpad("", this.indent, this.nind * this.indent.length);
				this.buf.b += Std.string(v);
			};
			this.quote(f);
			this.buf.b += String.fromCodePoint(58);
			if (this.pretty) {
				this.buf.b += String.fromCodePoint(32);
			};
			this.write(f, value);
			if (i == last) {
				this.nind--;
				if (this.pretty) {
					this.buf.b += String.fromCodePoint(10);
				};
				if (this.pretty) {
					let v = StringTools.lpad("", this.indent, this.nind * this.indent.length);
					this.buf.b += Std.string(v);
				};
			};
		};
		this.buf.b += String.fromCodePoint(125);
	}
	quote(s) {
		this.buf.b += String.fromCodePoint(34);
		let i = 0;
		let length = s.length;
		while (i < length) {
			let c = s.charCodeAt(i++);
			switch (c) {
				case 8:
					this.buf.b += "\\b";
					break
				case 9:
					this.buf.b += "\\t";
					break
				case 10:
					this.buf.b += "\\n";
					break
				case 12:
					this.buf.b += "\\f";
					break
				case 13:
					this.buf.b += "\\r";
					break
				case 34:
					this.buf.b += "\\\"";
					break
				case 92:
					this.buf.b += "\\\\";
					break
				default:
				this.buf.b += String.fromCodePoint(c);
				
			};
		};
		this.buf.b += String.fromCodePoint(34);
	}
	
	/**
	Encodes `o`'s value and returns the resulting JSON string.
	
	If `replacer` is given and is not null, it is used to retrieve
	actual object to be encoded. The `replacer` function takes two parameters,
	the key and the value being encoded. Initial key value is an empty string.
	
	If `space` is given and is not null, the result will be pretty-printed.
	Successive levels will be indented by this string.
	*/
	static print(o, replacer = null, space = null) {
		let printer = new JsonPrinter(replacer, space);
		printer.write("", o);
		return printer.buf.b;
	}
	static get __name__() {
		return "haxe.format.JsonPrinter"
	}
	get __class__() {
		return JsonPrinter
	}
}


//# sourceMappingURL=JsonPrinter.js.map