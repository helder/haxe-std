<?php
/**
 * Generated by Haxe 4.1.4
 */

namespace helder\std\haxe;

use \helder\std\haxe\_EntryPoint\Lock;
use \helder\std\php\Boot;
use \helder\std\Array_hx;
use \helder\std\haxe\_EntryPoint\Mutex;
use \helder\std\haxe\_EntryPoint\Thread;

/**
 * If `haxe.MainLoop` is kept from DCE, then we will insert an `haxe.EntryPoint.run()` call just at then end of `main()`.
 * This class can be redefined by custom frameworks so they can handle their own main loop logic.
 */
class EntryPoint {
	/**
	 * @var Mutex
	 */
	static public $mutex;
	/**
	 * @var Array_hx
	 */
	static public $pending;
	/**
	 * @var Lock
	 */
	static public $sleepLock;
	/**
	 * @var int
	 */
	static public $threadCount = 0;

	/**
	 * @param \Closure $f
	 * 
	 * @return void
	 */
	public static function addThread ($f) {
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/haxe/EntryPoint.hx:66: characters 3-16
		EntryPoint::$threadCount++;
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/haxe/EntryPoint.hx:68: lines 68-75
		Thread::create(function () use (&$f) {
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/haxe/EntryPoint.hx:69: characters 4-7
			$f();
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/haxe/EntryPoint.hx:71: characters 4-17
			EntryPoint::$threadCount--;
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/haxe/EntryPoint.hx:72: lines 72-73
			if (EntryPoint::$threadCount === 0) {
				#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/haxe/EntryPoint.hx:73: characters 5-13
				EntryPoint::wakeup();
			}
		});
	}

	/**
	 * @return float
	 */
	public static function processEvents () {
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/haxe/EntryPoint.hx:87: lines 87-98
		while (true) {
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/haxe/EntryPoint.hx:90: characters 12-27
			$_this = EntryPoint::$pending;
			if ($_this->length > 0) {
				$_this->length--;
			}
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/haxe/EntryPoint.hx:90: characters 4-28
			$f = \array_shift($_this->arr);
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/haxe/EntryPoint.hx:95: lines 95-96
			if ($f === null) {
				#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/haxe/EntryPoint.hx:96: characters 5-10
				break;
			}
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/haxe/EntryPoint.hx:97: characters 4-7
			$f();
		}
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/haxe/EntryPoint.hx:99: characters 3-46
		$time = MainLoop::tick();
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/haxe/EntryPoint.hx:100: lines 100-101
		if (!MainLoop::hasEvents() && (EntryPoint::$threadCount === 0)) {
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/haxe/EntryPoint.hx:101: characters 4-13
			return -1;
		}
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/haxe/EntryPoint.hx:102: characters 3-14
		return $time;
	}

	/**
	 * Start the main loop. Depending on the platform, this can return immediately or will only return when the application exits.
	 * 
	 * @return void
	 */
	public static function run () {
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/haxe/EntryPoint.hx:134: lines 134-140
		while (true) {
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/haxe/EntryPoint.hx:135: characters 4-35
			$nextTick = EntryPoint::processEvents();
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/haxe/EntryPoint.hx:136: lines 136-137
			if ($nextTick < 0) {
				#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/haxe/EntryPoint.hx:137: characters 5-10
				break;
			}
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/haxe/EntryPoint.hx:138: characters 8-20
			$tmp = $nextTick > 0;
		}
	}

	/**
	 * @param \Closure $f
	 * 
	 * @return void
	 */
	public static function runInMainThread ($f) {
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/haxe/EntryPoint.hx:55: characters 3-18
		$_this = EntryPoint::$pending;
		$_this->arr[$_this->length++] = $f;
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/haxe/EntryPoint.hx:57: characters 3-11
		EntryPoint::wakeup();
	}

	/**
	 * Wakeup a sleeping `run()`
	 * 
	 * @return void
	 */
	public static function wakeup () {
	}

	/**
	 * @internal
	 * @access private
	 */
	static public function __hx__init ()
	{
		static $called = false;
		if ($called) return;
		$called = true;


		self::$sleepLock = new Lock();
		self::$mutex = new Mutex();
		self::$pending = new Array_hx();
	}
}

Boot::registerClass(EntryPoint::class, 'haxe.EntryPoint');
EntryPoint::__hx__init();
