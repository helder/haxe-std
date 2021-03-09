import {RestKeyValueIterator} from "./iterators/RestKeyValueIterator"
import {RestIterator} from "./iterators/RestIterator"

export type NativeRest<T> = T[]

export declare class Rest_Impl_ {
	
	/**
	Amount of arguments passed as rest arguments
	*/
	static readonly length: number
	
	/**
	Create rest arguments using contents of `array`.
	
	WARNING:
	Depending on a target platform modifying `array` after using this method
	may affect the created `Rest` instance.
	Use `Rest.of(array.copy())` to avoid that.
	*/
	static of<T>(array: T[]): T[]
	
	/**
	Creates an array containing all the values of rest arguments.
	*/
	static toArray<T>($this: T[]): T[]
	static iterator<T>($this: T[]): RestIterator<T>
	static keyValueIterator<T>($this: T[]): RestKeyValueIterator<T>
	
	/**
	Create a new rest arguments collection by appending `item` to this one.
	*/
	static append<T>($this: T[], item: T): T[]
	
	/**
	Create a new rest arguments collection by prepending this one with `item`.
	*/
	static prepend<T>($this: T[], item: T): T[]
	static toString<T>($this: T[]): string
}

//# sourceMappingURL=Rest.d.ts.map