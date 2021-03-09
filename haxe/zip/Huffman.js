import {HaxeError} from "../../js/Boot.js"
import {IntMap} from "../ds/IntMap.js"
import {Register} from "../../genes/Register.js"

export const Huffman = 
Register.global("$hxEnums")["haxe.zip.Huffman"] = 
{
	__ename__: "haxe.zip.Huffman",
	
	Found: Object.assign((i) => ({_hx_index: 0, __enum__: "haxe.zip.Huffman", i}), {_hx_name: "Found", __params__: ["i"]}),
	NeedBit: Object.assign((left, right) => ({_hx_index: 1, __enum__: "haxe.zip.Huffman", left, right}), {_hx_name: "NeedBit", __params__: ["left", "right"]}),
	NeedBits: Object.assign((n, table) => ({_hx_index: 2, __enum__: "haxe.zip.Huffman", n, table}), {_hx_name: "NeedBits", __params__: ["n", "table"]})
}
Huffman.__constructs__ = ["Found", "NeedBit", "NeedBits"]
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
				var b = t.right;
				var a = t.left;
				var da = this.treeDepth(a);
				var db = this.treeDepth(b);
				return 1 + ((da < db) ? da : db);
				break
			case 2:
				var _g2 = t.table;
				var _g1 = t.n;
				throw new HaxeError("assert");
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
				var b = t.right;
				var a = t.left;
				return Huffman.NeedBit(this.treeCompress(a), this.treeCompress(b));
			} else {
				throw new HaxeError("assert");
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
			var b = t.right;
			var a = t.left;
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
			throw new HaxeError("Invalid huffman");
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
		var counts = new Array();
		var tmp = new Array();
		if (maxbits > 32) {
			throw new HaxeError("Invalid huffman");
		};
		var _g = 0;
		var _g1 = maxbits;
		while (_g < _g1) {
			var i = _g++;
			counts.push(0);
			tmp.push(0);
		};
		var _g2 = 0;
		var _g3 = nlengths;
		while (_g2 < _g3) {
			var i1 = _g2++;
			var p = lengths[i1 + pos];
			if (p >= maxbits) {
				throw new HaxeError("Invalid huffman");
			};
			counts[p]++;
		};
		var code = 0;
		var _g4 = 1;
		var _g5 = maxbits - 1;
		while (_g4 < _g5) {
			var i2 = _g4++;
			code = code + counts[i2] << 1;
			tmp[i2] = code;
		};
		var bits = new IntMap();
		var _g6 = 0;
		var _g7 = nlengths;
		while (_g6 < _g7) {
			var i3 = _g6++;
			var l = lengths[i3 + pos];
			if (l != 0) {
				var n = tmp[l - 1];
				tmp[l - 1] = n + 1;
				bits.inst.set(n << 5 | l, i3);
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