import {Exception} from "./Exception.js"
import {EntryPoint} from "./EntryPoint.js"
import {Register} from "../genes/Register.js"

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
		let tmp;
		if (t == null) {
			tmp = -Infinity;
		} else {
			let hrtime = process.hrtime();
			tmp = hrtime[0] + hrtime[1] / 1e9 + t;
		};
		this.nextRun = tmp;
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
		let p = MainLoop.pending;
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
			throw Exception.thrown("Event function is null");
		};
		let e = new MainEvent(f, priority);
		let head = MainLoop.pending;
		if (head != null) {
			head.prev = e;
		};
		e.next = head;
		MainLoop.pending = e;
		return e;
	}
	static sortEvents() {
		let list = MainLoop.pending;
		if (list == null) {
			return;
		};
		let insize = 1;
		let nmerges;
		let psize = 0;
		let qsize = 0;
		let p;
		let q;
		let e;
		let tail;
		while (true) {
			p = list;
			list = null;
			tail = null;
			nmerges = 0;
			while (p != null) {
				++nmerges;
				q = p;
				psize = 0;
				let _g = 0;
				let _g1 = insize;
				while (_g < _g1) {
					let i = _g++;
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
		let e = MainLoop.pending;
		let hrtime = process.hrtime();
		let now = hrtime[0] + hrtime[1] / 1e9;
		let wait = 1e9;
		while (e != null) {
			let next = e.next;
			let wt = e.nextRun - now;
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