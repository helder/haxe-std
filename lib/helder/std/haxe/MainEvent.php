<?php
/**
 */

namespace helder\std\haxe;

use \helder\std\php\Boot;
use \helder\std\Math;

class MainEvent {
	/**
	 * @var \Closure
	 */
	public $f;
	/**
	 * @var bool
	 * Tells if the event can lock the process from exiting (default:true)
	 */
	public $isBlocking;
	/**
	 * @var MainEvent
	 */
	public $next;
	/**
	 * @var float
	 */
	public $nextRun;
	/**
	 * @var MainEvent
	 */
	public $prev;
	/**
	 * @var int
	 */
	public $priority;

	/**
	 * @param \Closure $f
	 * @param int $p
	 * 
	 * @return void
	 */
	public function __construct ($f, $p) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/MainLoop.hx:17: characters 31-35
		$this->isBlocking = true;
		#/home/runner/haxe/versions/4.2.3/std/haxe/MainLoop.hx:23: characters 3-13
		$this->f = $f;
		#/home/runner/haxe/versions/4.2.3/std/haxe/MainLoop.hx:24: characters 3-20
		$this->priority = $p;
		#/home/runner/haxe/versions/4.2.3/std/haxe/MainLoop.hx:25: characters 3-35
		$this->nextRun = Math::$NEGATIVE_INFINITY;
	}

	/**
	 * Call the event. Will do nothing if the event has been stopped.
	 * 
	 * @return void
	 */
	public function call () {
		#/home/runner/haxe/versions/4.2.3/std/haxe/MainLoop.hx:40: lines 40-41
		if ($this->f !== null) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/MainLoop.hx:41: characters 4-7
			($this->f)();
		}
	}

	/**
	 * Delay the execution of the event for the given time, in seconds.
	 * If t is null, the event will be run at tick() time.
	 * 
	 * @param float $t
	 * 
	 * @return void
	 */
	public function delay ($t) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/MainLoop.hx:33: characters 3-72
		$this->nextRun = ($t === null ? Math::$NEGATIVE_INFINITY : \microtime(true) + $t);
	}

	/**
	 * Stop the event from firing anymore.
	 * 
	 * @return void
	 */
	public function stop () {
		#/home/runner/haxe/versions/4.2.3/std/haxe/MainLoop.hx:48: lines 48-49
		if ($this->f === null) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/MainLoop.hx:49: characters 4-10
			return;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/MainLoop.hx:50: characters 3-11
		$this->f = null;
		#/home/runner/haxe/versions/4.2.3/std/haxe/MainLoop.hx:51: characters 3-35
		$this->nextRun = Math::$NEGATIVE_INFINITY;
		#/home/runner/haxe/versions/4.2.3/std/haxe/MainLoop.hx:52: lines 52-55
		if ($this->prev === null) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/MainLoop.hx:53: characters 20-43
			MainLoop::$pending = $this->next;
		} else {
			#/home/runner/haxe/versions/4.2.3/std/haxe/MainLoop.hx:55: characters 4-20
			$this->prev->next = $this->next;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/MainLoop.hx:56: lines 56-57
		if ($this->next !== null) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/MainLoop.hx:57: characters 4-20
			$this->next->prev = $this->prev;
		}
	}
}

Boot::registerClass(MainEvent::class, 'haxe.MainEvent');
