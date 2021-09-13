import {Register} from "../../genes/Register.js"

const $global = Register.$global

/**
ArraySort provides a stable implementation of merge sort through its `sort`
method. It should be used instead of `Array.sort` in cases where the order
of equal elements has to be retained on all targets.
*/
export const ArraySort = Register.global("$hxClasses")["haxe.ds.ArraySort"] = 
class ArraySort {
	
	/**
	Sorts Array `a` according to the comparison function `cmp`, where
	`cmp(x,y)` returns 0 if `x == y`, a positive Int if `x > y` and a
	negative Int if `x < y`.
	
	This operation modifies Array `a` in place.
	
	This operation is stable: The order of equal elements is preserved.
	
	If `a` or `cmp` are null, the result is unspecified.
	*/
	static sort(a, cmp) {
		ArraySort.rec(a, cmp, 0, a.length);
	}
	static rec(a, cmp, from, to) {
		var middle = from + to >> 1;
		if (to - from < 12) {
			if (to <= from) {
				return;
			};
			var _g = from + 1;
			var _g1 = to;
			while (_g < _g1) {
				var i = _g++;
				var j = i;
				while (j > from) {
					if (cmp(a[j], a[j - 1]) < 0) {
						ArraySort.swap(a, j - 1, j);
					} else {
						break;
					};
					--j;
				};
			};
			return;
		};
		ArraySort.rec(a, cmp, from, middle);
		ArraySort.rec(a, cmp, middle, to);
		ArraySort.doMerge(a, cmp, from, middle, to, middle - from, to - middle);
	}
	static doMerge(a, cmp, from, pivot, to, len1, len2) {
		var first_cut;
		var second_cut;
		var len11;
		var len22;
		if (len1 == 0 || len2 == 0) {
			return;
		};
		if (len1 + len2 == 2) {
			if (cmp(a[pivot], a[from]) < 0) {
				ArraySort.swap(a, pivot, from);
			};
			return;
		};
		if (len1 > len2) {
			len11 = len1 >> 1;
			first_cut = from + len11;
			second_cut = ArraySort.lower(a, cmp, pivot, to, first_cut);
			len22 = second_cut - pivot;
		} else {
			len22 = len2 >> 1;
			second_cut = pivot + len22;
			first_cut = ArraySort.upper(a, cmp, from, pivot, second_cut);
			len11 = first_cut - from;
		};
		ArraySort.rotate(a, cmp, first_cut, pivot, second_cut);
		var new_mid = first_cut + len22;
		ArraySort.doMerge(a, cmp, from, first_cut, new_mid, len11, len22);
		ArraySort.doMerge(a, cmp, new_mid, second_cut, to, len1 - len11, len2 - len22);
	}
	static rotate(a, cmp, from, mid, to) {
		if (from == mid || mid == to) {
			return;
		};
		var n = ArraySort.gcd(to - from, mid - from);
		while (n-- != 0) {
			var val = a[from + n];
			var shift = mid - from;
			var p1 = from + n;
			var p2 = from + n + shift;
			while (p2 != from + n) {
				a[p1] = a[p2];
				p1 = p2;
				if (to - p2 > shift) {
					p2 += shift;
				} else {
					p2 = from + (shift - (to - p2));
				};
			};
			a[p1] = val;
		};
	}
	static gcd(m, n) {
		while (n != 0) {
			var t = m % n;
			m = n;
			n = t;
		};
		return m;
	}
	static upper(a, cmp, from, to, val) {
		var len = to - from;
		var half;
		var mid;
		while (len > 0) {
			half = len >> 1;
			mid = from + half;
			if (cmp(a[val], a[mid]) < 0) {
				len = half;
			} else {
				from = mid + 1;
				len = len - half - 1;
			};
		};
		return from;
	}
	static lower(a, cmp, from, to, val) {
		var len = to - from;
		var half;
		var mid;
		while (len > 0) {
			half = len >> 1;
			mid = from + half;
			if (cmp(a[mid], a[val]) < 0) {
				from = mid + 1;
				len = len - half - 1;
			} else {
				len = half;
			};
		};
		return from;
	}
	static swap(a, i, j) {
		var tmp = a[i];
		a[i] = a[j];
		a[j] = tmp;
	}
	static compare(a, cmp, i, j) {
		return cmp(a[i], a[j]);
	}
	static get __name__() {
		return "haxe.ds.ArraySort"
	}
	get __class__() {
		return ArraySort
	}
}


//# sourceMappingURL=ArraySort.js.map