
/**
A linked-list of elements. The list is composed of element container objects
that are chained together. It is optimized so that adding or removing an
element does not imply copying the whole list content every time.

@see https://haxe.org/manual/std-List.html
*/
export declare class List<T> {
	constructor()
	
	/**
	The length of `this` List.
	*/
	length: number
	
	/**
	Adds element `item` at the end of `this` List.
	
	`this.length` increases by 1.
	*/
	add(item: T): void
	
	/**
	Adds element `item` at the beginning of `this` List.
	
	`this.length` increases by 1.
	*/
	push(item: T): void
	
	/**
	Returns the first element of `this` List, or null if no elements exist.
	
	This function does not modify `this` List.
	*/
	first(): null | T
	
	/**
	Returns the last element of `this` List, or null if no elements exist.
	
	This function does not modify `this` List.
	*/
	last(): null | T
	
	/**
	Returns the first element of `this` List, or null if no elements exist.
	
	The element is removed from `this` List.
	*/
	pop(): null | T
	
	/**
	Tells if `this` List is empty.
	*/
	isEmpty(): boolean
	
	/**
	Empties `this` List.
	
	This function does not traverse the elements, but simply sets the
	internal references to null and `this.length` to 0.
	*/
	clear(): void
	
	/**
	Removes the first occurrence of `v` in `this` List.
	
	If `v` is found by checking standard equality, it is removed from `this`
	List and the function returns true.
	
	Otherwise, false is returned.
	*/
	remove(v: T): boolean
	
	/**
	Returns an iterator on the elements of the list.
	*/
	iterator(): ListIterator<T>
	
	/**
	Returns an iterator of the List indices and values.
	*/
	keyValueIterator(): ListKeyValueIterator<T>
	
	/**
	Returns a string representation of `this` List.
	
	The result is enclosed in { } with the individual elements being
	separated by a comma.
	*/
	toString(): string
	
	/**
	Returns a string representation of `this` List, with `sep` separating
	each element.
	*/
	join(sep: string): string
	
	/**
	Returns a list filtered with `f`. The returned list will contain all
	elements for which `f(x) == true`.
	*/
	filter(f: ((arg0: T) => boolean)): List<T>
	
	/**
	Returns a new list where all elements have been converted by the
	function `f`.
	*/
	map<X>(f: ((arg0: T) => X)): List<X>
}

export declare class ListNode<T> {
	constructor(item: T, next: ListNode<T>)
	item: T
	next: ListNode<T>
}

export declare class ListIterator<T> {
	constructor(head: ListNode<T>)
	hasNext(): boolean
	next(): T
}

export declare class ListKeyValueIterator<T> {
	constructor(head: ListNode<T>)
	hasNext(): boolean
	next(): {key: number, value: T}
}

//# sourceMappingURL=List.d.ts.map