import {StackItem} from "./CallStack"

/**
Base class for exceptions.

If this class (or derivatives) is used to catch an exception, then
`haxe.CallStack.exceptionStack()` will not return a stack for the exception
caught. Use `haxe.Exception.stack` property instead:
```haxe
try {
throwSomething();
} catch(e:Exception) {
trace(e.stack);
}
```

Custom exceptions should extend this class:
```haxe
class MyException extends haxe.Exception {}
//...
throw new MyException('terrible exception');
```

`haxe.Exception` is also a wildcard type to catch any exception:
```haxe
try {
throw 'Catch me!';
} catch(e:haxe.Exception) {
trace(e.message); // Output: Catch me!
}
```

To rethrow an exception just throw it again.
Haxe will try to rethrow an original native exception whenever possible.
```haxe
try {
var a:Array<Int> = null;
a.push(1); // generates target-specific null-pointer exception
} catch(e:haxe.Exception) {
throw e; // rethrows native exception instead of haxe.Exception
}
```
*/
export declare class Exception extends Error {
	constructor(message: string, previous?: null | Exception, $native?: null | any)
	
	/**
	Exception message.
	*/
	readonly message: string
	
	/**
	The call stack at the moment of the exception creation.
	*/
	readonly stack: StackItem[]
	
	/**
	Contains an exception, which was passed to `previous` constructor argument.
	*/
	readonly previous: null | Exception
	
	/**
	Native exception, which caused this exception.
	*/
	readonly native: any
	
	/**
	Returns exception message.
	*/
	toString(): string
	
	/**
	Detailed exception description.
	
	Includes message, stack and the chain of previous exceptions (if set).
	*/
	details(): string
}

//# sourceMappingURL=Exception.d.ts.map