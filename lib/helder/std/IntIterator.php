<?php
/**
 * Generated by Haxe 4.2.1+bf9ff69
 */

namespace helder\std;

use \helder\std\php\Boot;

/**
 * IntIterator is used for implementing interval iterations.
 * It is usually not used explicitly, but through its special syntax:
 * `min...max`
 * While it is possible to assign an instance of IntIterator to a variable or
 * field, it is worth noting that IntIterator does not reset after being used
 * in a for-loop. Subsequent uses of the same instance will then have no
 * effect.
 * @see https://haxe.org/manual/lf-iterators.html
 */
class IntIterator {
	/**
	 * @var int
	 */
	public $max;
	/**
	 * @var int
	 */
	public $min;

	/**
	 * Iterates from `min` (inclusive) to `max` (exclusive).
	 * If `max <= min`, the iterator will not act as a countdown.
	 * 
	 * @param int $min
	 * @param int $max
	 * 
	 * @return void
	 */
	public function __construct ($min, $max) {
		#/home/runner/haxe/versions/4.2.1/std/IntIterator.hx:46: characters 3-17
		$this->min = $min;
		#/home/runner/haxe/versions/4.2.1/std/IntIterator.hx:47: characters 3-17
		$this->max = $max;
	}

	/**
	 * Returns true if the iterator has other items, false otherwise.
	 * 
	 * @return bool
	 */
	public function hasNext () {
		#/home/runner/haxe/versions/4.2.1/std/IntIterator.hx:54: characters 3-19
		return $this->min < $this->max;
	}

	/**
	 * Moves to the next item of the iterator.
	 * If this is called while hasNext() is false, the result is unspecified.
	 * 
	 * @return int
	 */
	public function next () {
		#/home/runner/haxe/versions/4.2.1/std/IntIterator.hx:63: characters 3-15
		return $this->min++;
	}
}

Boot::registerClass(IntIterator::class, 'IntIterator');
