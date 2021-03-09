import {MainLoop} from "./MainLoop.js"
import {Register} from "../genes/Register.js"

/**
If `haxe.MainLoop` is kept from DCE, then we will insert an `haxe.EntryPoint.run()` call just at then end of `main()`.
This class can be redefined by custom frameworks so they can handle their own main loop logic.
*/
export const EntryPoint = Register.global("$hxClasses")["haxe.EntryPoint"] = 
class EntryPoint {
	
	/**
	Wakeup a sleeping `run()`
	*/
	static wakeup() {
	}
	static runInMainThread(f) {
		EntryPoint.pending.push(f);
	}
	static addThread(f) {
		EntryPoint.threadCount++;
		EntryPoint.pending.push(function () {
			f();
			EntryPoint.threadCount--;
		});
	}
	static processEvents() {
		while (true) {
			var f = EntryPoint.pending.shift();
			if (f == null) {
				break;
			};
			f();
		};
		var time = MainLoop.tick();
		if (!MainLoop.hasEvents() && EntryPoint.threadCount == 0) {
			return -1;
		};
		return time;
	}
	
	/**
	Start the main loop. Depending on the platform, this can return immediately or will only return when the application exits.
	*/
	static run() {
		var nextTick = EntryPoint.processEvents();
		if (nextTick < 0) {
			return;
		};
		setTimeout(EntryPoint.run, nextTick);
	}
	static get __name__() {
		return "haxe.EntryPoint"
	}
	get __class__() {
		return EntryPoint
	}
}


EntryPoint.pending = new Array()
EntryPoint.threadCount = 0
//# sourceMappingURL=EntryPoint.js.map