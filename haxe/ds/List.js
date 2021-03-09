import {Register} from "../../genes/Register"
import {Std} from "../../Std"

/**
A linked-list of elements. The list is composed of element container objects
that are chained together. It is optimized so that adding or removing an
element does not imply copying the whole list content every time.

@see https://haxe.org/manual/std-List.html
*/
export const List = Register.global("$hxClasses")["haxe.ds.List"] = 
class List extends Register.inherits() {
	new() {
		this.length = 0;
	}
	
	/**
	Adds element `item` at the end of `this` List.
	
	`this.length` increases by 1.
	*/
	add(item) {
		let x = new ListNode(item, null);
		if (this.h == null) {
			this.h = x;
		} else {
			this.q.next = x;
		};
		this.q = x;
		this.length++;
	}
	
	/**
	Adds element `item` at the beginning of `this` List.
	
	`this.length` increases by 1.
	*/
	push(item) {
		let x = new ListNode(item, this.h);
		this.h = x;
		if (this.q == null) {
			this.q = x;
		};
		this.length++;
	}
	
	/**
	Returns the first element of `this` List, or null if no elements exist.
	
	This function does not modify `this` List.
	*/
	first() {
		if (this.h == null) {
			return null;
		} else {
			return this.h.item;
		};
	}
	
	/**
	Returns the last element of `this` List, or null if no elements exist.
	
	This function does not modify `this` List.
	*/
	last() {
		if (this.q == null) {
			return null;
		} else {
			return this.q.item;
		};
	}
	
	/**
	Returns the first element of `this` List, or null if no elements exist.
	
	The element is removed from `this` List.
	*/
	pop() {
		if (this.h == null) {
			return null;
		};
		let x = this.h.item;
		this.h = this.h.next;
		if (this.h == null) {
			this.q = null;
		};
		this.length--;
		return x;
	}
	
	/**
	Tells if `this` List is empty.
	*/
	isEmpty() {
		return this.h == null;
	}
	
	/**
	Empties `this` List.
	
	This function does not traverse the elements, but simply sets the
	internal references to null and `this.length` to 0.
	*/
	clear() {
		this.h = null;
		this.q = null;
		this.length = 0;
	}
	
	/**
	Removes the first occurrence of `v` in `this` List.
	
	If `v` is found by checking standard equality, it is removed from `this`
	List and the function returns true.
	
	Otherwise, false is returned.
	*/
	remove(v) {
		let prev = null;
		let l = this.h;
		while (l != null) {
			if (l.item == v) {
				if (prev == null) {
					this.h = l.next;
				} else {
					prev.next = l.next;
				};
				if (this.q == l) {
					this.q = prev;
				};
				this.length--;
				return true;
			};
			prev = l;
			l = l.next;
		};
		return false;
	}
	
	/**
	Returns an iterator on the elements of the list.
	*/
	iterator() {
		return new ListIterator(this.h);
	}
	
	/**
	Returns an iterator of the List indices and values.
	*/
	keyValueIterator() {
		return new ListKeyValueIterator(this.h);
	}
	
	/**
	Returns a string representation of `this` List.
	
	The result is enclosed in { } with the individual elements being
	separated by a comma.
	*/
	toString() {
		let s_b = "";
		let first = true;
		let l = this.h;
		s_b += "{";
		while (l != null) {
			if (first) {
				first = false;
			} else {
				s_b += ", ";
			};
			s_b += Std.string(Std.string(l.item));
			l = l.next;
		};
		s_b += "}";
		return s_b;
	}
	
	/**
	Returns a string representation of `this` List, with `sep` separating
	each element.
	*/
	join(sep) {
		let s_b = "";
		let first = true;
		let l = this.h;
		while (l != null) {
			if (first) {
				first = false;
			} else {
				s_b += (sep == null) ? "null" : "" + sep;
			};
			s_b += Std.string(l.item);
			l = l.next;
		};
		return s_b;
	}
	
	/**
	Returns a list filtered with `f`. The returned list will contain all
	elements for which `f(x) == true`.
	*/
	filter(f) {
		let l2 = new List();
		let l = this.h;
		while (l != null) {
			let v = l.item;
			l = l.next;
			if (f(v)) {
				l2.add(v);
			};
		};
		return l2;
	}
	
	/**
	Returns a new list where all elements have been converted by the
	function `f`.
	*/
	map(f) {
		let b = new List();
		let l = this.h;
		while (l != null) {
			let v = l.item;
			l = l.next;
			b.add(f(v));
		};
		return b;
	}
	static get __name__() {
		return "haxe.ds.List"
	}
	get __class__() {
		return List
	}
}


export const ListNode = Register.global("$hxClasses")["haxe.ds._List.ListNode"] = 
class ListNode extends Register.inherits() {
	new(item, next) {
		this.item = item;
		this.next = next;
	}
	static get __name__() {
		return "haxe.ds._List.ListNode"
	}
	get __class__() {
		return ListNode
	}
}


export const ListIterator = Register.global("$hxClasses")["haxe.ds._List.ListIterator"] = 
class ListIterator extends Register.inherits() {
	new(head) {
		this.head = head;
	}
	hasNext() {
		return this.head != null;
	}
	next() {
		let val = this.head.item;
		this.head = this.head.next;
		return val;
	}
	static get __name__() {
		return "haxe.ds._List.ListIterator"
	}
	get __class__() {
		return ListIterator
	}
}


export const ListKeyValueIterator = Register.global("$hxClasses")["haxe.ds._List.ListKeyValueIterator"] = 
class ListKeyValueIterator extends Register.inherits() {
	new(head) {
		this.head = head;
		this.idx = 0;
	}
	hasNext() {
		return this.head != null;
	}
	next() {
		let val = this.head.item;
		this.head = this.head.next;
		return {"value": val, "key": this.idx++};
	}
	static get __name__() {
		return "haxe.ds._List.ListKeyValueIterator"
	}
	get __class__() {
		return ListKeyValueIterator
	}
}


//# sourceMappingURL=List.js.map