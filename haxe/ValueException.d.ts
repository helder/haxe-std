import {Exception} from "./Exception"

/**
An exception containing arbitrary value.

This class is automatically used for throwing values, which don't extend `haxe.Exception`
or native exception type.
For example:
```haxe
throw "Terrible error";
```
will be compiled to
```haxe
throw new ValueException("Terrible error");
```
*/
export declare class ValueException extends Exception {
	constructor(value: any, previous?: null | Exception, $native?: null | any)
	
	/**
	Thrown value.
	*/
	value: any
}

//# sourceMappingURL=ValueException.d.ts.map