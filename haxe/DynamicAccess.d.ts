import {DynamicAccessKeyValueIterator} from "./iterators/DynamicAccessKeyValueIterator"
import {DynamicAccessIterator} from "./iterators/DynamicAccessIterator"

export declare class DynamicAccess {
	
	/**
	Creates a new structure.
	*/
	static _new<T>(): {[key: string]: T}
	
	/**
	Returns a value by specified `key`.
	
	If the structure does not contain the given key, `null` is returned.
	
	If `key` is `null`, the result is unspecified.
	*/
	static get<T>($this: {[key: string]: T}, key: string): null | T
	
	/**
	Sets a `value` for a specified `key`.
	
	If the structure contains the given key, its value will be overwritten.
	
	Returns the given value.
	
	If `key` is `null`, the result is unspecified.
	*/
	static set<T>($this: {[key: string]: T}, key: string, value: T): T
	
	/**
	Tells if the structure contains a specified `key`.
	
	If `key` is `null`, the result is unspecified.
	*/
	static exists<T>($this: {[key: string]: T}, key: string): boolean
	
	/**
	Removes a specified `key` from the structure.
	
	Returns true, if `key` was present in structure, or false otherwise.
	
	If `key` is `null`, the result is unspecified.
	*/
	static remove<T>($this: {[key: string]: T}, key: string): boolean
	
	/**
	Returns an array of `keys` in a structure.
	*/
	static keys<T>($this: {[key: string]: T}): string[]
	
	/**
	Returns a shallow copy of the structure
	*/
	static copy<T>($this: {[key: string]: T}): {[key: string]: T}
	
	/**
	Returns an Iterator over the values of this `DynamicAccess`.
	
	The order of values is undefined.
	*/
	static iterator<T>($this: {[key: string]: T}): DynamicAccessIterator<T>
	
	/**
	Returns an Iterator over the keys and values of this `DynamicAccess`.
	
	The order of values is undefined.
	*/
	static keyValueIterator<T>($this: {[key: string]: T}): DynamicAccessKeyValueIterator<T>
}

//# sourceMappingURL=DynamicAccess.d.ts.map