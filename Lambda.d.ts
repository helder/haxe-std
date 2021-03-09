import {List} from "./haxe/ds/List"
import {Iterable} from "./StdTypes"

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
export declare class Lambda {
	
	/**
	Creates an Array from Iterable `it`.
	
	If `it` is an Array, this function returns a copy of it.
	*/
	static array<A>(it: Iterable<A>): A[]
	
	/**
	Creates a List form Iterable `it`.
	
	If `it` is a List, this function returns a copy of it.
	*/
	static list<A>(it: Iterable<A>): List<A>
	
	/**
	Creates a new Array by applying function `f` to all elements of `it`.
	The order of elements is preserved.
	If `f` is null, the result is unspecified.
	*/
	static map<A, B>(it: Iterable<A>, f: ((item: A) => B)): B[]
	
	/**
	Similar to map, but also passes the index of each element to `f`.
	The order of elements is preserved.
	If `f` is null, the result is unspecified.
	*/
	static mapi<A, B>(it: Iterable<A>, f: ((index: number, item: A) => B)): B[]
	
	/**
	Concatenate a list of iterables.
	The order of elements is preserved.
	*/
	static flatten<A>(it: Iterable<Iterable<A>>): A[]
	
	/**
	A composition of map and flatten.
	The order of elements is preserved.
	If `f` is null, the result is unspecified.
	*/
	static flatMap<A, B>(it: Iterable<A>, f: ((item: A) => Iterable<B>)): B[]
	
	/**
	Tells if `it` contains `elt`.
	
	This function returns true as soon as an element is found which is equal
	to `elt` according to the `==` operator.
	
	If no such element is found, the result is false.
	*/
	static has<A>(it: Iterable<A>, elt: A): boolean
	
	/**
	Tells if `it` contains an element for which `f` is true.
	
	This function returns true as soon as an element is found for which a
	call to `f` returns true.
	
	If no such element is found, the result is false.
	
	If `f` is null, the result is unspecified.
	*/
	static exists<A>(it: Iterable<A>, f: ((item: A) => boolean)): boolean
	
	/**
	Tells if `f` is true for all elements of `it`.
	
	This function returns false as soon as an element is found for which a
	call to `f` returns false.
	
	If no such element is found, the result is true.
	
	In particular, this function always returns true if `it` is empty.
	
	If `f` is null, the result is unspecified.
	*/
	static foreach<A>(it: Iterable<A>, f: ((item: A) => boolean)): boolean
	
	/**
	Calls `f` on all elements of `it`, in order.
	
	If `f` is null, the result is unspecified.
	*/
	static iter<A>(it: Iterable<A>, f: ((item: A) => void)): void
	
	/**
	Returns a Array containing those elements of `it` for which `f` returned
	true.
	If `it` is empty, the result is the empty Array even if `f` is null.
	Otherwise if `f` is null, the result is unspecified.
	*/
	static filter<A>(it: Iterable<A>, f: ((item: A) => boolean)): A[]
	
	/**
	Functional fold on Iterable `it`, using function `f` with start argument
	`first`.
	
	If `it` has no elements, the result is `first`.
	
	Otherwise the first element of `it` is passed to `f` alongside `first`.
	The result of that call is then passed to `f` with the next element of
	`it`, and so on until `it` has no more elements.
	
	If `it` or `f` are null, the result is unspecified.
	*/
	static fold<A, B>(it: Iterable<A>, f: ((item: A, result: B) => B), first: B): B
	
	/**
	Returns the number of elements in `it` for which `pred` is true, or the
	total number of elements in `it` if `pred` is null.
	
	This function traverses all elements.
	*/
	static count<A>(it: Iterable<A>, pred?: null | ((item: A) => boolean)): number
	
	/**
	Tells if Iterable `it` does not contain any element.
	*/
	static empty<T>(it: Iterable<T>): boolean
	
	/**
	Returns the index of the first element `v` within Iterable `it`.
	
	This function uses operator `==` to check for equality.
	
	If `v` does not exist in `it`, the result is -1.
	*/
	static indexOf<T>(it: Iterable<T>, v: T): number
	
	/**
	Returns the first element of `it` for which `f` is true.
	
	This function returns as soon as an element is found for which a call to
	`f` returns true.
	
	If no such element is found, the result is null.
	
	If `f` is null, the result is unspecified.
	*/
	static find<T>(it: Iterable<T>, f: ((item: T) => boolean)): null | T
	
	/**
	Returns a new Array containing all elements of Iterable `a` followed by
	all elements of Iterable `b`.
	
	If `a` or `b` are null, the result is unspecified.
	*/
	static concat<T>(a: Iterable<T>, b: Iterable<T>): T[]
}

//# sourceMappingURL=Lambda.d.ts.map