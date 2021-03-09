import {IMap} from "../Constraints"
import {Iterator, KeyValueIterator} from "../../StdTypes"

/**
BalancedTree allows key-value mapping with arbitrary keys, as long as they
can be ordered. By default, `Reflect.compare` is used in the `compare`
method, which can be overridden in subclasses.

Operations have a logarithmic average and worst-case cost.

Iteration over keys and values, using `keys` and `iterator` respectively,
are in-order.
*/
export declare class BalancedTree<K, V> implements IMap<K, V> {
	constructor()
	
	/**
	Binds `key` to `value`.
	
	If `key` is already bound to a value, that binding disappears.
	
	If `key` is null, the result is unspecified.
	*/
	set(key: K, value: V): void
	
	/**
	Returns the value `key` is bound to.
	
	If `key` is not bound to any value, `null` is returned.
	
	If `key` is null, the result is unspecified.
	*/
	get(key: K): null | V
	
	/**
	Removes the current binding of `key`.
	
	If `key` has no binding, `this` BalancedTree is unchanged and false is
	returned.
	
	Otherwise the binding of `key` is removed and true is returned.
	
	If `key` is null, the result is unspecified.
	*/
	remove(key: K): boolean
	
	/**
	Tells if `key` is bound to a value.
	
	This method returns true even if `key` is bound to null.
	
	If `key` is null, the result is unspecified.
	*/
	exists(key: K): boolean
	
	/**
	Iterates over the bound values of `this` BalancedTree.
	
	This operation is performed in-order.
	*/
	iterator(): Iterator<V>
	
	/**
	See `Map.keyValueIterator`
	*/
	keyValueIterator(): KeyValueIterator<K, V>
	
	/**
	Iterates over the keys of `this` BalancedTree.
	
	This operation is performed in-order.
	*/
	keys(): Iterator<K>
	copy(): BalancedTree<K, V>
	toString(): string
	
	/**
	Removes all keys from `this` BalancedTree.
	*/
	clear(): void
}

/**
A tree node of `haxe.ds.BalancedTree`.
*/
export declare class TreeNode<K, V> {
	constructor(l: TreeNode<K, V>, k: K, v: V, r: TreeNode<K, V>, h?: number)
	left: TreeNode<K, V>
	right: TreeNode<K, V>
	key: K
	value: V
	toString(): string
}

//# sourceMappingURL=BalancedTree.d.ts.map