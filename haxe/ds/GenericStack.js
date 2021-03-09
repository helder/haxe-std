import {Register} from "../../genes/Register.js"

/**
A cell of `haxe.ds.GenericStack`.

@see https://haxe.org/manual/std-GenericStack.html
*/
export const GenericCell = Register.global("$hxClasses")["haxe.ds.GenericCell"] = 
class GenericCell extends Register.inherits() {
	new(elt, next) {
		this.elt = elt;
		this.next = next;
	}
	static get __name__() {
		return "haxe.ds.GenericCell"
	}
	get __class__() {
		return GenericCell
	}
}


/**
A stack of elements.

This class is generic, which means one type is generated for each type
parameter T on static targets. For example:

- `new GenericStack<Int>()` generates `GenericStack_Int`
- `new GenericStack<String>()` generates `GenericStack_String`

The generated name is an implementation detail and should not be relied
upon.

@see https://haxe.org/manual/std-GenericStack.html
*/
export const GenericStack = Register.global("$hxClasses")["haxe.ds.GenericStack"] = 
class GenericStack extends Register.inherits() {
	new() {
	}
	
	/**
	Pushes element `item` onto the stack.
	*/
	add(item) {
		this.head = new GenericCell(item, this.head);
	}
	
	/**
	Returns the topmost stack element without removing it.
	
	If the stack is empty, null is returned.
	*/
	first() {
		if (this.head == null) {
			return null;
		} else {
			return this.head.elt;
		};
	}
	
	/**
	Returns the topmost stack element and removes it.
	
	If the stack is empty, null is returned.
	*/
	pop() {
		let k = this.head;
		if (k == null) {
			return null;
		} else {
			this.head = k.next;
			return k.elt;
		};
	}
	
	/**
	Tells if the stack is empty.
	*/
	isEmpty() {
		return this.head == null;
	}
	
	/**
	Removes the first element which is equal to `v` according to the `==`
	operator.
	
	This method traverses the stack until it finds a matching element and
	unlinks it, returning true.
	
	If no matching element is found, false is returned.
	*/
	remove(v) {
		let prev = null;
		let l = this.head;
		while (l != null) {
			if (l.elt == v) {
				if (prev == null) {
					this.head = l.next;
				} else {
					prev.next = l.next;
				};
				break;
			};
			prev = l;
			l = l.next;
		};
		return l != null;
	}
	
	/**
	Returns an iterator over the elements of `this` GenericStack.
	*/
	iterator() {
		let l = this.head;
		return {"hasNext": function () {
			return l != null;
		}, "next": function () {
			let k = l;
			l = k.next;
			return k.elt;
		}};
	}
	
	/**
	Returns a String representation of `this` GenericStack.
	*/
	toString() {
		let a = new Array();
		let l = this.head;
		while (l != null) {
			a.push(l.elt);
			l = l.next;
		};
		return "{" + a.join(",") + "}";
	}
	static get __name__() {
		return "haxe.ds.GenericStack"
	}
	get __class__() {
		return GenericStack
	}
}


//# sourceMappingURL=GenericStack.js.map