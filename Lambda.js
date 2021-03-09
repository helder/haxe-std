import {List} from "./haxe/ds/List.js"
import {Register} from "./genes/Register.js"

/**
The `Lambda` class is a collection of methods to support functional
programming. It is ideally used with `using Lambda` and then acts as an
extension to Iterable types.

On static platforms, working with the Iterable structure might be slower
than performing the operations directly on known types, such as Array and
List.

If the first argument to any of the methods is null, the result is
unspecified.

@see https://haxe.org/manual/std-Lambda.html
*/
export const Lambda = Register.global("$hxClasses")["Lambda"] = 
class Lambda {
	
	/**
	Creates an Array from Iterable `it`.
	
	If `it` is an Array, this function returns a copy of it.
	*/
	static array(it) {
		let a = new Array();
		let i = Register.iter(it);
		while (i.hasNext()) {
			let i1 = i.next();
			a.push(i1);
		};
		return a;
	}
	
	/**
	Creates a List form Iterable `it`.
	
	If `it` is a List, this function returns a copy of it.
	*/
	static list(it) {
		let l = new List();
		let i = Register.iter(it);
		while (i.hasNext()) {
			let i1 = i.next();
			l.add(i1);
		};
		return l;
	}
	
	/**
	Creates a new Array by applying function `f` to all elements of `it`.
	The order of elements is preserved.
	If `f` is null, the result is unspecified.
	*/
	static map(it, f) {
		let _g = [];
		let x = Register.iter(it);
		while (x.hasNext()) {
			let x1 = x.next();
			_g.push(f(x1));
		};
		return _g;
	}
	
	/**
	Similar to map, but also passes the index of each element to `f`.
	The order of elements is preserved.
	If `f` is null, the result is unspecified.
	*/
	static mapi(it, f) {
		let i = 0;
		let _g = [];
		let x = Register.iter(it);
		while (x.hasNext()) {
			let x1 = x.next();
			_g.push(f(i++, x1));
		};
		return _g;
	}
	
	/**
	Concatenate a list of iterables.
	The order of elements is preserved.
	*/
	static flatten(it) {
		let _g = [];
		let e = Register.iter(it);
		while (e.hasNext()) {
			let e1 = e.next();
			let x = Register.iter(e1);
			while (x.hasNext()) {
				let x1 = x.next();
				_g.push(x1);
			};
		};
		return _g;
	}
	
	/**
	A composition of map and flatten.
	The order of elements is preserved.
	If `f` is null, the result is unspecified.
	*/
	static flatMap(it, f) {
		let _g = [];
		let x = Register.iter(it);
		while (x.hasNext()) {
			let x1 = x.next();
			_g.push(f(x1));
		};
		let _g1 = [];
		let e = Register.iter(_g);
		while (e.hasNext()) {
			let e1 = e.next();
			let x = Register.iter(e1);
			while (x.hasNext()) {
				let x1 = x.next();
				_g1.push(x1);
			};
		};
		return _g1;
	}
	
	/**
	Tells if `it` contains `elt`.
	
	This function returns true as soon as an element is found which is equal
	to `elt` according to the `==` operator.
	
	If no such element is found, the result is false.
	*/
	static has(it, elt) {
		let x = Register.iter(it);
		while (x.hasNext()) {
			let x1 = x.next();
			if (x1 == elt) {
				return true;
			};
		};
		return false;
	}
	
	/**
	Tells if `it` contains an element for which `f` is true.
	
	This function returns true as soon as an element is found for which a
	call to `f` returns true.
	
	If no such element is found, the result is false.
	
	If `f` is null, the result is unspecified.
	*/
	static exists(it, f) {
		let x = Register.iter(it);
		while (x.hasNext()) {
			let x1 = x.next();
			if (f(x1)) {
				return true;
			};
		};
		return false;
	}
	
	/**
	Tells if `f` is true for all elements of `it`.
	
	This function returns false as soon as an element is found for which a
	call to `f` returns false.
	
	If no such element is found, the result is true.
	
	In particular, this function always returns true if `it` is empty.
	
	If `f` is null, the result is unspecified.
	*/
	static foreach(it, f) {
		let x = Register.iter(it);
		while (x.hasNext()) {
			let x1 = x.next();
			if (!f(x1)) {
				return false;
			};
		};
		return true;
	}
	
	/**
	Calls `f` on all elements of `it`, in order.
	
	If `f` is null, the result is unspecified.
	*/
	static iter(it, f) {
		let x = Register.iter(it);
		while (x.hasNext()) {
			let x1 = x.next();
			f(x1);
		};
	}
	
	/**
	Returns a Array containing those elements of `it` for which `f` returned
	true.
	If `it` is empty, the result is the empty Array even if `f` is null.
	Otherwise if `f` is null, the result is unspecified.
	*/
	static filter(it, f) {
		let _g = [];
		let x = Register.iter(it);
		while (x.hasNext()) {
			let x1 = x.next();
			if (f(x1)) {
				_g.push(x1);
			};
		};
		return _g;
	}
	
	/**
	Functional fold on Iterable `it`, using function `f` with start argument
	`first`.
	
	If `it` has no elements, the result is `first`.
	
	Otherwise the first element of `it` is passed to `f` alongside `first`.
	The result of that call is then passed to `f` with the next element of
	`it`, and so on until `it` has no more elements.
	
	If `it` or `f` are null, the result is unspecified.
	*/
	static fold(it, f, first) {
		let x = Register.iter(it);
		while (x.hasNext()) {
			let x1 = x.next();
			first = f(x1, first);
		};
		return first;
	}
	
	/**
	Similar to fold, but also passes the index of each element to `f`.
	
	If `it` or `f` are null, the result is unspecified.
	*/
	static foldi(it, f, first) {
		let i = 0;
		let x = Register.iter(it);
		while (x.hasNext()) {
			let x1 = x.next();
			first = f(x1, first, i);
			++i;
		};
		return first;
	}
	
	/**
	Returns the number of elements in `it` for which `pred` is true, or the
	total number of elements in `it` if `pred` is null.
	
	This function traverses all elements.
	*/
	static count(it, pred = null) {
		let n = 0;
		if (pred == null) {
			let _ = Register.iter(it);
			while (_.hasNext()) {
				let _1 = _.next();
				++n;
			};
		} else {
			let x = Register.iter(it);
			while (x.hasNext()) {
				let x1 = x.next();
				if (pred(x1)) {
					++n;
				};
			};
		};
		return n;
	}
	
	/**
	Tells if Iterable `it` does not contain any element.
	*/
	static empty(it) {
		return !Register.iter(it).hasNext();
	}
	
	/**
	Returns the index of the first element `v` within Iterable `it`.
	
	This function uses operator `==` to check for equality.
	
	If `v` does not exist in `it`, the result is -1.
	*/
	static indexOf(it, v) {
		let i = 0;
		let v2 = Register.iter(it);
		while (v2.hasNext()) {
			let v21 = v2.next();
			if (v == v21) {
				return i;
			};
			++i;
		};
		return -1;
	}
	
	/**
	Returns the first element of `it` for which `f` is true.
	
	This function returns as soon as an element is found for which a call to
	`f` returns true.
	
	If no such element is found, the result is null.
	
	If `f` is null, the result is unspecified.
	*/
	static find(it, f) {
		let v = Register.iter(it);
		while (v.hasNext()) {
			let v1 = v.next();
			if (f(v1)) {
				return v1;
			};
		};
		return null;
	}
	
	/**
	Returns the index of the first element of `it` for which `f` is true.
	
	This function returns as soon as an element is found for which a call to
	`f` returns true.
	
	If no such element is found, the result is -1.
	
	If `f` is null, the result is unspecified.
	*/
	static findIndex(it, f) {
		let i = 0;
		let v = Register.iter(it);
		while (v.hasNext()) {
			let v1 = v.next();
			if (f(v1)) {
				return i;
			};
			++i;
		};
		return -1;
	}
	
	/**
	Returns a new Array containing all elements of Iterable `a` followed by
	all elements of Iterable `b`.
	
	If `a` or `b` are null, the result is unspecified.
	*/
	static concat(a, b) {
		let l = new Array();
		let x = Register.iter(a);
		while (x.hasNext()) {
			let x1 = x.next();
			l.push(x1);
		};
		let x1 = Register.iter(b);
		while (x1.hasNext()) {
			let x = x1.next();
			l.push(x);
		};
		return l;
	}
	static get __name__() {
		return "Lambda"
	}
	get __class__() {
		return Lambda
	}
}


//# sourceMappingURL=Lambda.js.map