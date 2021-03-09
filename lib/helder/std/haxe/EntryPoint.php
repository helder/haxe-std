<?php
/**
 * Generated by Haxe 4.2.1+bf9ff69
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
	 * @var \Closure[]|Array_hx
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
		#/home/runner/haxe/versions/4.2.1/std/haxe/EntryPoint.hx:74: characters 3-16
		EntryPoint::$threadCount++;
		#/home/runner/haxe/versions/4.2.1/std/haxe/EntryPoint.hx:79: lines 79-89
		Thread::create(function () use (&$f) {
			#/home/runner/haxe/versions/4.2.1/std/haxe/EntryPoint.hx:80: characters 4-7
			$f();
			#/home/runner/haxe/versions/4.2.1/std/haxe/EntryPoint.hx:82: characters 4-17
			EntryPoint::$threadCount--;
			#/home/runner/haxe/versions/4.2.1/std/haxe/EntryPoint.hx:83: lines 83-84
			if (EntryPoint::$threadCount === 0) {
				#/home/runner/haxe/versions/4.2.1/std/haxe/EntryPoint.hx:84: characters 5-13
				EntryPoint::wakeup();
			}
		});
	}

	/**
	 * @return float
	 */
	public static function processEvents () {
		#/home/runner/haxe/versions/4.2.1/std/haxe/EntryPoint.hx:104: lines 104-115
		while (true) {
			#/home/runner/haxe/versions/4.2.1/std/haxe/EntryPoint.hx:107: characters 12-27
			$_this = EntryPoint::$pending;
			if ($_this->length > 0) {
				$_this->length--;
			}
			#/home/runner/haxe/versions/4.2.1/std/haxe/EntryPoint.hx:107: characters 4-28
			$f = \array_shift($_this->arr);
			#/home/runner/haxe/versions/4.2.1/std/haxe/EntryPoint.hx:112: lines 112-113
			if ($f === null) {
				#/home/runner/haxe/versions/4.2.1/std/haxe/EntryPoint.hx:113: characters 5-10
				break;
			}
			#/home/runner/haxe/versions/4.2.1/std/haxe/EntryPoint.hx:114: characters 4-7
			$f();
		}
		#/home/runner/haxe/versions/4.2.1/std/haxe/EntryPoint.hx:116: characters 3-46
		$time = MainLoop::tick();
		#/home/runner/haxe/versions/4.2.1/std/haxe/EntryPoint.hx:117: lines 117-118
		if (!MainLoop::hasEvents() && (EntryPoint::$threadCount === 0)) {
			#/home/runner/haxe/versions/4.2.1/std/haxe/EntryPoint.hx:118: characters 4-13
			return -1;
		}
		#/home/runner/haxe/versions/4.2.1/std/haxe/EntryPoint.hx:119: characters 3-14
		return $time;
	}

	/**
	 * Start the main loop. Depending on the platform, this can return immediately or will only return when the application exits.
	 * 
	 * @return void
	 */
	public static function run () {
		#/home/runner/haxe/versions/4.2.1/std/haxe/EntryPoint.hx:154: lines 154-160
		while (true) {
			#/home/runner/haxe/versions/4.2.1/std/haxe/EntryPoint.hx:155: characters 4-35
			$nextTick = EntryPoint::processEvents();
			#/home/runner/haxe/versions/4.2.1/std/haxe/EntryPoint.hx:156: lines 156-157
			if ($nextTick < 0) {
				#/home/runner/haxe/versions/4.2.1/std/haxe/EntryPoint.hx:157: characters 5-10
				break;
			}
			#/home/runner/haxe/versions/4.2.1/std/haxe/EntryPoint.hx:158: characters 8-20
			$tmp = $nextTick > 0;
		}
	}

	/**
	 * @param \Closure $f
	 * 
	 * @return void
	 */
	public static function runInMainThread ($f) {
		#/home/runner/haxe/versions/4.2.1/std/haxe/EntryPoint.hx:62: characters 5-20
		$_this = EntryPoint::$pending;
		$_this->arr[$_this->length++] = $f;
		#/home/runner/haxe/versions/4.2.1/std/haxe/EntryPoint.hx:64: characters 5-13
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


		self::$mutex = new Mutex();
		self::$sleepLock = new Lock();
		self::$pending = new Array_hx();
	}
}

Boot::registerClass(EntryPoint::class, 'haxe.EntryPoint');
EntryPoint::__hx__init();
