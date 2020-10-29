import {Register} from "../../genes/Register"

/**
ListSort provides a stable implementation of merge sort through its `sort`
method. It has a O(N.log(N)) complexity and does not require additional memory allocation.
*/
export const ListSort = Register.global("$hxClasses")["haxe.ds.ListSort"] = 
class ListSort {
	
	/**
	Sorts List `lst` according to the comparison function `cmp`, where
	`cmp(x,y)` returns 0 if `x == y`, a positive Int if `x > y` and a
	negative Int if `x < y`.
	
	This operation modifies List `a` in place and returns its head once modified.
	The `prev` of the head is set to the tail of the sorted list.
	
	If `list` or `cmp` are null, the result is unspecified.
	*/
	static sort(list, cmp) {
		if (list == null) {
			return null;
		};
		var insize = 1;
		var nmerges;
		var psize = 0;
		var qsize = 0;
		var p;
		var q;
		var e;
		var tail = null;
		while (true) {
			p = list;
			list = null;
			tail = null;
			nmerges = 0;
			while (p != null) {
				++nmerges;
				q = p;
				psize = 0;
				var _g = 0;
				var _g1 = insize;
				while (_g < _g1) {
					var i = _g++;
					++psize;
					q = q.next;
					if (q == null) {
						break;
					};
				};
				qsize = insize;
				while (psize > 0 || qsize > 0 && q != null) {
					if (psize == 0) {
						e = q;
						q = q.next;
						--qsize;
					} else if (qsize == 0 || q == null || cmp(p, q) <= 0) {
						e = p;
						p = p.next;
						--psize;
					} else {
						e = q;
						q = q.next;
						--qsize;
					};
					if (tail != null) {
						tail.next = e;
					} else {
						list = e;
					};
					e.prev = tail;
					tail = e;
				};
				p = q;
			};
			tail.next = null;
			if (nmerges <= 1) {
				break;
			};
			insize *= 2;
		};
		list.prev = tail;
		return list;
	}
	
	/**
	Same as `sort` but on single linked list.
	*/
	static sortSingleLinked(list, cmp) {
		if (list == null) {
			return null;
		};
		var insize = 1;
		var nmerges;
		var psize = 0;
		var qsize = 0;
		var p;
		var q;
		var e;
		var tail;
		while (true) {
			p = list;
			list = null;
			tail = null;
			nmerges = 0;
			while (p != null) {
				++nmerges;
				q = p;
				psize = 0;
				var _g = 0;
				var _g1 = insize;
				while (_g < _g1) {
					var i = _g++;
					++psize;
					q = q.next;
					if (q == null) {
						break;
					};
				};
				qsize = insize;
				while (psize > 0 || qsize > 0 && q != null) {
					if (psize == 0) {
						e = q;
						q = q.next;
						--qsize;
					} else if (qsize == 0 || q == null || cmp(p, q) <= 0) {
						e = p;
						p = p.next;
						--psize;
					} else {
						e = q;
						q = q.next;
						--qsize;
					};
					if (tail != null) {
						tail.next = e;
					} else {
						list = e;
					};
					tail = e;
				};
				p = q;
			};
			tail.next = null;
			if (nmerges <= 1) {
				break;
			};
			insize *= 2;
		};
		return list;
	}
	static get __name__() {
		return "haxe.ds.ListSort"
	}
	get __class__() {
		return ListSort
	}
}


//# sourceMappingURL=ListSort.js.map