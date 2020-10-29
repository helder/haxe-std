import {Iterator, IteratorStep} from "./Iterator"

/**
`HaxeIterator` wraps a JavaScript native iterator object to enable for-in iteration in haxe.
It can be used directly: `new HaxeIterator(jsIterator)` or via using: `using HaxeIterator`.
*/
export declare class HaxeIterator<T> {
	constructor(jsIterator: Iterator<T>)
	hasNext(): boolean
	next(): T
	static iterator<T>(jsIterator: Iterator<T>): HaxeIterator<T>
}

//# sourceMappingURL=HaxeIterator.d.ts.map