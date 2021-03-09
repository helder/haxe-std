import {PosInfos} from "./PosInfos"

/**
The `Timer` class allows you to create asynchronous timers on platforms that
support events.

The intended usage is to create an instance of the `Timer` class with a given
interval, set its `run()` method to a custom function to be invoked and
eventually call `stop()` to stop the `Timer`.

Note that a running `Timer` may or may not prevent the program to exit
automatically when `main()` returns.

It is also possible to extend this class and override its `run()` method in
the child class.
*/
export declare class Timer {
	constructor(time_ms: number)
	
	/**
	Stops `this` Timer.
	
	After calling this method, no additional invocations of `this.run`
	will occur.
	
	It is not possible to restart `this` Timer once stopped.
	*/
	stop(): void
	
	/**
	This method is invoked repeatedly on `this` Timer.
	
	It can be overridden in a subclass, or rebound directly to a custom
	function:
	
	```haxe
	var timer = new haxe.Timer(1000); // 1000ms delay
	timer.run = function() { ... }
	```
	
	Once bound, it can still be rebound to different functions until `this`
	Timer is stopped through a call to `this.stop`.
	*/
	run(): void
	
	/**
	Invokes `f` after `time_ms` milliseconds.
	
	This is a convenience function for creating a new Timer instance with
	`time_ms` as argument, binding its `run()` method to `f` and then stopping
	`this` Timer upon the first invocation.
	
	If `f` is `null`, the result is unspecified.
	*/
	static delay(f: (() => void), time_ms: number): Timer
	
	/**
	Measures the time it takes to execute `f`, in seconds with fractions.
	
	This is a convenience function for calculating the difference between
	`Timer.stamp()` before and after the invocation of `f`.
	
	The difference is passed as argument to `Log.trace()`, with `"s"` appended
	to denote the unit. The optional `pos` argument is passed through.
	
	If `f` is `null`, the result is unspecified.
	*/
	static measure<T>(f: (() => T), pos?: null | PosInfos): T
	
	/**
	Returns a timestamp, in seconds with fractions.
	
	The value itself might differ depending on platforms, only differences
	between two values make sense.
	*/
	static stamp(): number
}

//# sourceMappingURL=Timer.d.ts.map