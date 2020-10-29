
/**
Platform-specific JavaScript Library. Provides some platform-specific functions
for the JavaScript target.
*/
export declare class Lib {
	
	/**
	Inserts a 'debugger' statement that will make a breakpoint if a debugger is available.
	*/
	static debug(): void
	
	/**
	Display an alert message box containing the given message.
	@deprecated Use Browser.alert() instead.
	*/
	static alert(v: any): void
	static eval(code: string): any
	
	/**
	Returns JavaScript `undefined` value.
	
	Note that this is only needed in very rare cases when working with external JavaScript code.
	
	In Haxe, `null` is used to represent the absence of a value.
	*/
	static readonly undefined: any
	
	/**
	`nativeThis` is the JavaScript `this`, which is semantically different
	from the Haxe `this`. Use `nativeThis` only when working with external
	JavaScript code.
	
	In Haxe, `this` is always bound to a class instance.
	In JavaScript, `this` in a function can be bound to an arbitrary
	variable when the function is called using `func.call(thisObj, ...)` or
	`func.apply(thisObj, [...])`.
	
	Read more at https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Operators/this
	*/
	static nativeThis: any
	
	/**
	An alias of the JS "global" object.
	
	Concretely, it is set as the first defined value in the list of
	`window`, `global`, `self`, and `this` in the top-level of the compiled output.
	*/
	static global: any
	
	/**
	Re-throw last cathed exception, preserving original stack information.
	
	Calling this is only possible inside a catch statement.
	*/
	static rethrow(): void
	
	/**
	Get original caught exception object, before unwrapping the `js.Boot.HaxeError`.
	
	Can be useful if we want to redirect the original error into some external API (e.g. Promise or node.js callbacks).
	
	Calling this is only possible inside a catch statement.
	*/
	static getOriginalException(): any
}

//# sourceMappingURL=Lib.d.ts.map