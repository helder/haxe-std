import {HaxeError} from "../js/Boot"
import {EntryPoint} from "./EntryPoint"
import {Register} from "../genes/Register"

export const MainEvent = Register.global("$hxClasses")["haxe.MainEvent"] = 
class MainEvent extends Register.inherits() {
	new(f, p) {
		this.isBlocking = true;
		this.f = f;
		this.priority = p;
		this.nextRun = -Infinity;
	}
	
	/**
	Delay the execution of the event for the given time, in seconds.
	If t is null, the event will be run at tick() time.
	*/
	delay(t) {
		this.nextRun = (t == null) ? -Infinity : Date.now() / 1000 + t;
	}
	
	/**
	Call the event. Will do nothing if the event has been stopped.
	*/
	call() {
		if (this.f != null) {
			this.f();
		};
	}
	
	/**
	Stop the event from firing anymore.
	*/
	stop() {
		if (this.f == null) {
			return;
		};
		this.f = null;
		this.nextRun = -Infinity;
		if (this.prev == null) {
			MainLoop.pending = this.next;
		} else {
			this.prev.next = this.next;
		};
		if (this.next != null) {
			this.next.prev = this.prev;
		};
	}
	static get __name__() {
		return "haxe.MainEvent"
	}
	get __class__() {
		return MainEvent
	}
}


export const MainLoop = Register.global("$hxClasses")["haxe.MainLoop"] = 
class MainLoop {
	static get threadCount() {
		return this.get_threadCount()
	}
	static get_threadCount() {
		return EntryPoint.threadCount;
	}
	static hasEvents() {
		var p = MainLoop.pending;
		while (p != null) {
			if (p.isBlocking) {
				return true;
			};
			p = p.next;
		};
		return false;
	}
	static addThread(f) {
		EntryPoint.addThread(f);
	}
	static runInMainThread(f) {
		EntryPoint.runInMainThread(f);
	}
	
	/**
	Add a pending event to be run into the main loop.
	*/
	static add(f, priority = 0) {
		if (f == null) {
			throw new HaxeError("Event function is null");
		};
		var e = new MainEvent(f, priority);
		var head = MainLoop.pending;
		if (head != null) {
			head.prev = e;
		};
		e.next = head;
		MainLoop.pending = e;
		return e;
	}
	static sortEvents() {
		var list = MainLoop.pending;
		if (list == null) {
			return;
		};
		var insize = 1;
		var nmerges;
		var psize = 0;
		var qsize = 0;
		var p;
		var q;
		var e;
		var tail;
		while (true) {
			p = list;
			list = null;
			tail = null;
			nmerges = 0;
			while (p != null) {
				++nmerges;
				q = p;
				psize = 0;
				var _g = 0;
				var _g1 = insize;
				while (_g < _g1) {
					var i = _g++;
					++psize;
					q = q.next;
					if (q == null) {
						break;
					};
				};
				qsize = insize;
				while (psize > 0 || qsize > 0 && q != null) {
					if (psize == 0) {
						e = q;
						q = q.next;
						--qsize;
					} else if (qsize == 0 || q == null || (p.priority > q.priority || p.priority == q.priority && p.nextRun <= q.nextRun)) {
						e = p;
						p = p.next;
						--psize;
					} else {
						e = q;
						q = q.next;
						--qsize;
					};
					if (tail != null) {
						tail.next = e;
					} else {
						list = e;
					};
					e.prev = tail;
					tail = e;
				};
				p = q;
			};
			tail.next = null;
			if (nmerges <= 1) {
				break;
			};
			insize *= 2;
		};
		list.prev = null;
		MainLoop.pending = list;
	}
	
	/**
	Run the pending events. Return the time for next event.
	*/
	static tick() {
		MainLoop.sortEvents();
		var e = MainLoop.pending;
		var now = Date.now() / 1000;
		var wait = 1e9;
		while (e != null) {
			var next = e.next;
			var wt = e.nextRun - now;
			if (wt <= 0) {
				wait = 0;
				if (e.f != null) {
					e.f();
				};
			} else if (wait > wt) {
				wait = wt;
			};
			e = next;
		};
		return wait;
	}
	static get __name__() {
		return "haxe.MainLoop"
	}
	get __class__() {
		return MainLoop
	}
}


//# sourceMappingURL=MainLoop.js.map