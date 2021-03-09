<?php
/**
 * Generated by Haxe 4.2.1+bf9ff69
 */

namespace helder\std\haxe\iterators;

use \helder\std\php\Boot;

class RestIterator {
	/**
	 * @var array
	 */
	public $args;
	/**
	 * @var int
	 */
	public $current;

	/**
	 * @param mixed $args
	 * 
	 * @return void
	 */
	public function __construct ($args) {
		#/home/runner/haxe/versions/4.2.1/std/haxe/iterators/RestIterator.hx:5: characters 20-21
		$this->current = 0;
		#/home/runner/haxe/versions/4.2.1/std/haxe/iterators/RestIterator.hx:9: characters 3-19
		$this->args = $args;
	}

	/**
	 * @return bool
	 */
	public function hasNext () {
		#/home/runner/haxe/versions/4.2.1/std/haxe/iterators/RestIterator.hx:13: characters 3-31
		return $this->current < \count($this->args);
	}

	/**
	 * @return mixed
	 */
	public function next () {
		#/home/runner/haxe/versions/4.2.1/std/haxe/iterators/RestIterator.hx:17: characters 10-25
		return $this->args[$this->current++];
	}
}

Boot::registerClass(RestIterator::class, 'haxe.iterators.RestIterator');
