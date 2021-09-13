<?php
/**
 */

namespace helder\std\haxe\iterators;

use \helder\std\php\_Boot\HxAnon;
use \helder\std\php\Boot;
use \helder\std\Array_hx;

class ArrayKeyValueIterator {
	/**
	 * @var mixed[]|Array_hx
	 */
	public $array;
	/**
	 * @var int
	 */
	public $current;

	/**
	 * @param mixed[]|Array_hx $array
	 * 
	 * @return void
	 */
	public function __construct ($array) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/iterators/ArrayKeyValueIterator.hx:27: characters 20-21
		$this->current = 0;
		#/home/runner/haxe/versions/4.2.3/std/haxe/iterators/ArrayKeyValueIterator.hx:32: characters 3-21
		$this->array = $array;
	}

	/**
	 * @return bool
	 */
	public function hasNext () {
		#/home/runner/haxe/versions/4.2.3/std/haxe/iterators/ArrayKeyValueIterator.hx:37: characters 3-32
		return $this->current < $this->array->length;
	}

	/**
	 * @return object
	 */
	public function next () {
		#/home/runner/haxe/versions/4.2.3/std/haxe/iterators/ArrayKeyValueIterator.hx:42: characters 17-31
		$tmp = ($this->array->arr[$this->current] ?? null);
		#/home/runner/haxe/versions/4.2.3/std/haxe/iterators/ArrayKeyValueIterator.hx:42: characters 3-47
		return new _HxAnon_ArrayKeyValueIterator0($tmp, $this->current++);
	}
}

class _HxAnon_ArrayKeyValueIterator0 extends HxAnon {
	function __construct($value, $key) {
		$this->value = $value;
		$this->key = $key;
	}
}

Boot::registerClass(ArrayKeyValueIterator::class, 'haxe.iterators.ArrayKeyValueIterator');
