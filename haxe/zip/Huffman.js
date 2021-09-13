import {IntMap} from "../ds/IntMap.js"
import {Exception} from "../Exception.js"
import {Register} from "../../genes/Register.js"

const $global = Register.$global

export const Huffman = 
Register.global("$hxEnums")["haxe.zip.Huffman"] = 
{
	__ename__: "haxe.zip.Huffman",
	
	Found: Object.assign((i) => ({_hx_index: 0, __enum__: "haxe.zip.Huffman", "i": i}), {_hx_name: "Found", __params__: ["i"]}),
	NeedBit: Object.assign((left, right) => ({_hx_index: 1, __enum__: "haxe.zip.Huffman", "left": left, "right": right}), {_hx_name: "NeedBit", __params__: ["left", "right"]}),
	NeedBits: Object.assign((n, table) => ({_hx_index: 2, __enum__: "haxe.zip.Huffman", "n": n, "table": table}), {_hx_name: "NeedBits", __params__: ["n", "table"]})
}
Huffman.__constructs__ = [Huffman.Found, Huffman.NeedBit, Huffman.NeedBits]
Huffman.__empty_constructs__ = []

export const HuffTools = Register.global("$hxClasses")["haxe.zip.HuffTools"] = 
class HuffTools extends Register.inherits() {
	new() {
	}
	treeDepth(t) {
		switch (t._hx_index) {
			case 0:
				var _g = t.i;
				return 0;
				break
			case 1:
				var a = t.left;
				var b = t.right;
				var da = this.treeDepth(a);
				var db = this.treeDepth(b);
				return 1 + ((da < db) ? da : db);
				break
			case 2:
				var _g = t.n;
				var _g = t.table;
				throw Exception.thrown("assert");
				break
			
		};
	}
	treeCompress(t) {
		var d = this.treeDepth(t);
		if (d == 0) {
			return t;
		};
		if (d == 1) {
			if (t._hx_index == 1) {
				var a = t.left;
				var b = t.right;
				return Huffman.NeedBit(this.treeCompress(a), this.treeCompress(b));
			} else {
				throw Exception.thrown("assert");
			};
		};
		var size = 1 << d;
		var table = new Array();
		var _g = 0;
		var _g1 = size;
		while (_g < _g1) {
			var i = _g++;
			table.push(Huffman.Found(-1));
		};
		this.treeWalk(table, 0, 0, d, t);
		return Huffman.NeedBits(d, table);
	}
	treeWalk(table, p, cd, d, t) {
		if (t._hx_index == 1) {
			var a = t.left;
			var b = t.right;
			if (d > 0) {
				this.treeWalk(table, p, cd + 1, d - 1, a);
				this.treeWalk(table, p | 1 << cd, cd + 1, d - 1, b);
			} else {
				table[p] = this.treeCompress(t);
			};
		} else {
			table[p] = this.treeCompress(t);
		};
	}
	treeMake(bits, maxbits, v, len) {
		if (len > maxbits) {
			throw Exception.thrown("Invalid huffman");
		};
		var idx = v << 5 | len;
		if (bits.inst.has(idx)) {
			return Huffman.Found(bits.inst.get(idx));
		};
		v <<= 1;
		++len;
		return Huffman.NeedBit(this.treeMake(bits, maxbits, v, len), this.treeMake(bits, maxbits, v | 1, len));
	}
	make(lengths, pos, nlengths, maxbits) {
		if (nlengths == 1) {
			return Huffman.NeedBit(Huffman.Found(0), Huffman.Found(0));
		};
		var counts = new Array();
		var tmp = new Array();
		if (maxbits > 32) {
			throw Exception.thrown("Invalid huffman");
		};
		var _g = 0;
		var _g1 = maxbits;
		while (_g < _g1) {
			var i = _g++;
			counts.push(0);
			tmp.push(0);
		};
		var _g = 0;
		var _g1 = nlengths;
		while (_g < _g1) {
			var i = _g++;
			var p = lengths[i + pos];
			if (p >= maxbits) {
				throw Exception.thrown("Invalid huffman");
			};
			counts[p]++;
		};
		var code = 0;
		var _g = 1;
		var _g1 = maxbits - 1;
		while (_g < _g1) {
			var i = _g++;
			code = code + counts[i] << 1;
			tmp[i] = code;
		};
		var bits = new IntMap();
		var _g = 0;
		var _g1 = nlengths;
		while (_g < _g1) {
			var i = _g++;
			var l = lengths[i + pos];
			if (l != 0) {
				var n = tmp[l - 1];
				tmp[l - 1] = n + 1;
				bits.inst.set(n << 5 | l, i);
			};
		};
		return this.treeCompress(Huffman.NeedBit(this.treeMake(bits, maxbits, 0, 1), this.treeMake(bits, maxbits, 1, 1)));
	}
	static get __name__() {
		return "haxe.zip.HuffTools"
	}
	get __class__() {
		return HuffTools
	}
}


//# sourceMappingURL=Huffman.js.map