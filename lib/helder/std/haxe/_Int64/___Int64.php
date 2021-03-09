<?php
/**
 * Generated by Haxe 4.1.5
 */

namespace helder\std\haxe\_Int64;

use \helder\std\php\Boot;

class ___Int64 {
	/**
	 * @var int
	 */
	public $high;
	/**
	 * @var int
	 */
	public $low;

	/**
	 * @param int $high
	 * @param int $low
	 * 
	 * @return void
	 */
	public function __construct ($high, $low) {
		#/home/runner/haxe/versions/4.1.5/std/haxe/Int64.hx:473: characters 3-19
		$this->high = $high;
		#/home/runner/haxe/versions/4.1.5/std/haxe/Int64.hx:474: characters 3-17
		$this->low = $low;
	}

	/**
	 * We also define toString here to ensure we always get a pretty string
	 * when tracing or calling `Std.string`. This tends not to happen when
	 * `toString` is only in the abstract.
	 * 
	 * @return string
	 */
	public function toString () {
		#/home/runner/haxe/versions/4.1.5/std/haxe/Int64.hx:483: characters 3-32
		return Int64_Impl_::toString($this);
	}

	public function __toString() {
		return $this->toString();
	}
}

Boot::registerClass(___Int64::class, 'haxe._Int64.___Int64');
