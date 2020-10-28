import {Log} from "./Log"
import {Register} from "../genes/Register"

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
export const Timer = Register.global("$hxClasses")["haxe.Timer"] = 
class Timer extends Register.inherits() {
	new(time_ms) {
		let me = this;
		this.id = setInterval(function () {
			me.run();
		}, time_ms);
	}
	
	/**
	Stops `this` Timer.
	
	After calling this method, no additional invocations of `this.run`
	will occur.
	
	It is not possible to restart `this` Timer once stopped.
	*/
	stop() {
		if (this.id == null) {
			return;
		};
		clearInterval(this.id);
		this.id = null;
	}
	
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
	run() {
	}
	
	/**
	Invokes `f` after `time_ms` milliseconds.
	
	This is a convenience function for creating a new Timer instance with
	`time_ms` as argument, binding its `run()` method to `f` and then stopping
	`this` Timer upon the first invocation.
	
	If `f` is `null`, the result is unspecified.
	*/
	static delay(f, time_ms) {
		let t = new Timer(time_ms);
		t.run = function () {
			t.stop();
			f();
		};
		return t;
	}
	
	/**
	Measures the time it takes to execute `f`, in seconds with fractions.
	
	This is a convenience function for calculating the difference between
	`Timer.stamp()` before and after the invocation of `f`.
	
	The difference is passed as argument to `Log.trace()`, with `"s"` appended
	to denote the unit. The optional `pos` argument is passed through.
	
	If `f` is `null`, the result is unspecified.
	*/
	static measure(f, pos = null) {
		let hrtime = process.hrtime();
		let t0 = hrtime[0] + hrtime[1] / 1e9;
		let r = f();
		let tmp = Log.trace;
		let hrtime1 = process.hrtime();
		tmp(hrtime1[0] + hrtime1[1] / 1e9 - t0 + "s", pos);
		return r;
	}
	
	/**
	Returns a timestamp, in seconds with fractions.
	
	The value itself might differ depending on platforms, only differences
	between two values make sense.
	*/
	static stamp() {
		let hrtime = process.hrtime();
		return hrtime[0] + hrtime[1] / 1e9;
	}
	static get __name__() {
		return "haxe.Timer"
	}
	get __class__() {
		return Timer
	}
}


//# sourceMappingURL=Timer.js.map