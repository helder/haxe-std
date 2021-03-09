import {Iterator} from "../../StdTypes"

/**
A cell of `haxe.ds.GenericStack`.

@see https://haxe.org/manual/std-GenericStack.html
*/
export declare class GenericCell<T> {
	constructor(elt: T, next: GenericCell<T>)
	elt: T
	next: GenericCell<T>
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
export declare class GenericStack<T> {
	constructor()
	head: GenericCell<T>
	
	/**
	Pushes element `item` onto the stack.
	*/
	add(item: T): void
	
	/**
	Returns the topmost stack element without removing it.
	
	If the stack is empty, null is returned.
	*/
	first(): null | T
	
	/**
	Returns the topmost stack element and removes it.
	
	If the stack is empty, null is returned.
	*/
	pop(): null | T
	
	/**
	Tells if the stack is empty.
	*/
	isEmpty(): boolean
	
	/**
	Removes the first element which is equal to `v` according to the `==`
	operator.
	
	This method traverses the stack until it finds a matching element and
	unlinks it, returning true.
	
	If no matching element is found, false is returned.
	*/
	remove(v: T): boolean
	
	/**
	Returns an iterator over the elements of `this` GenericStack.
	*/
	iterator(): Iterator<T>
	
	/**
	Returns a String representation of `this` GenericStack.
	*/
	toString(): string
}

//# sourceMappingURL=GenericStack.d.ts.map