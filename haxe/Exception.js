import {ValueException} from "./ValueException.js"
import {NativeStackTrace} from "./NativeStackTrace.js"
import {CallStack_Impl_} from "./CallStack.js"
import {Register} from "../genes/Register.js"

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
export const Exception = Register.global("$hxClasses")["haxe.Exception"] = 
class Exception extends Register.inherits(() => Error, true) {
	new(message, previous = null, $native = null) {
		Error.call(this, message);
		this.message = message;
		this.__previousException = previous;
		this.__nativeException = ($native != null) ? $native : this;
		this.__skipStack = 0;
		let old = Error.prepareStackTrace;
		Error.prepareStackTrace = function(e) { return e.stack; };
		if ((($native) instanceof Error)) {
			this.stack = $native.stack;
		} else {
			let e = null;
			if (Error.captureStackTrace) {
				Error.captureStackTrace(this, Exception);
				e = this;
			} else {
				e = new Error();
				if (typeof(e.stack) == "undefined") {
					try { throw e; } catch(_) {};
					this.__skipStack++;
				};
			};
			this.stack = e.stack;
		};
		Error.prepareStackTrace = old;
	}
	get message() {
		return this.get_message()
	}
	get stack() {
		return this.get_stack()
	}
	get previous() {
		return this.get_previous()
	}
	get native() {
		return this.get_native()
	}
	get __exceptionStack() {
		return this.get___exceptionStack()
	}
	set __exceptionStack(v) {
		this.set___exceptionStack(v)
	}
	unwrap() {
		return this.__nativeException;
	}
	
	/**
	Returns exception message.
	*/
	toString() {
		return this.get_message();
	}
	
	/**
	Detailed exception description.
	
	Includes message, stack and the chain of previous exceptions (if set).
	*/
	details() {
		if (this.get_previous() == null) {
			let tmp = "Exception: " + this.toString();
			let tmp1 = this.get_stack();
			return tmp + ((tmp1 == null) ? "null" : CallStack_Impl_.toString(tmp1));
		} else {
			let result = "";
			let e = this;
			let prev = null;
			while (e != null) {
				if (prev == null) {
					let result1 = "Exception: " + e.get_message();
					let tmp = e.get_stack();
					result = result1 + ((tmp == null) ? "null" : CallStack_Impl_.toString(tmp)) + result;
				} else {
					let prevStack = CallStack_Impl_.subtract(e.get_stack(), prev.get_stack());
					result = "Exception: " + e.get_message() + ((prevStack == null) ? "null" : CallStack_Impl_.toString(prevStack)) + "\n\nNext " + result;
				};
				prev = e;
				e = e.get_previous();
			};
			return result;
		};
	}
	__shiftStack() {
		this.__skipStack++;
	}
	get_message() {
		return this.message;
	}
	get_previous() {
		return this.__previousException;
	}
	get_native() {
		return this.__nativeException;
	}
	get_stack() {
		let _g = this.__exceptionStack;
		if (_g == null) {
			let value = NativeStackTrace.toHaxe(NativeStackTrace.normalize(this.stack), this.__skipStack);
			this.setProperty("__exceptionStack", value);
			return value;
		} else {
			let s = _g;
			return s;
		};
	}
	setProperty(name, value) {
		try {
			Object.defineProperty(this, name, {"value": value});
		}catch (_g) {
			this[name] = value;
		};
	}
	get___exceptionStack() {
		return this.__exceptionStack;
	}
	set___exceptionStack(value) {
		this.setProperty("__exceptionStack", value);
		return value;
	}
	get___skipStack() {
		return this.__skipStack;
	}
	set___skipStack(value) {
		this.setProperty("__skipStack", value);
		return value;
	}
	get___nativeException() {
		return this.__nativeException;
	}
	set___nativeException(value) {
		this.setProperty("__nativeException", value);
		return value;
	}
	get___previousException() {
		return this.__previousException;
	}
	set___previousException(value) {
		this.setProperty("__previousException", value);
		return value;
	}
	static caught(value) {
		if (((value) instanceof Exception)) {
			return value;
		} else if (((value) instanceof Error)) {
			return new Exception(value.message, null, value);
		} else {
			return new ValueException(value, null, value);
		};
	}
	static thrown(value) {
		if (((value) instanceof Exception)) {
			return value.get_native();
		} else if (((value) instanceof Error)) {
			return value;
		} else {
			let e = new ValueException(value);
			e.__skipStack++;
			return e;
		};
	}
	static get __name__() {
		return "haxe.Exception"
	}
	static get __super__() {
		return Error
	}
	get __class__() {
		return Exception
	}
}


//# sourceMappingURL=Exception.js.map