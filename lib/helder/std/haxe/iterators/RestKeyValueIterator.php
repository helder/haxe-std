<?php
/**
 */

namespace helder\std\haxe\iterators;

use \helder\std\php\_Boot\HxAnon;
use \helder\std\php\Boot;

class RestKeyValueIterator {
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
		#/home/runner/haxe/versions/4.2.3/std/haxe/iterators/RestKeyValueIterator.hx:5: characters 20-21
		$this->current = 0;
		#/home/runner/haxe/versions/4.2.3/std/haxe/iterators/RestKeyValueIterator.hx:9: characters 3-19
		$this->args = $args;
	}

	/**
	 * @return bool
	 */
	public function hasNext () {
		#/home/runner/haxe/versions/4.2.3/std/haxe/iterators/RestKeyValueIterator.hx:13: characters 3-31
		return $this->current < \count($this->args);
	}

	/**
	 * @return object
	 */
	public function next () {
		#/home/runner/haxe/versions/4.2.3/std/haxe/iterators/RestKeyValueIterator.hx:17: characters 15-22
		$tmp = $this->current;
		#/home/runner/haxe/versions/4.2.3/std/haxe/iterators/RestKeyValueIterator.hx:17: characters 3-46
		return new _HxAnon_RestKeyValueIterator0($tmp, $this->args[$this->current++]);
	}
}

class _HxAnon_RestKeyValueIterator0 extends HxAnon {
	function __construct($key, $value) {
		$this->key = $key;
		$this->value = $value;
	}
}

Boot::registerClass(RestKeyValueIterator::class, 'haxe.iterators.RestKeyValueIterator');
