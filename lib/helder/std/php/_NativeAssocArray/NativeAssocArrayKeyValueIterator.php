<?php
/**
 */

namespace helder\std\php\_NativeAssocArray;

use \helder\std\php\_Boot\HxAnon;
use \helder\std\php\Boot;

class NativeAssocArrayKeyValueIterator {
	/**
	 * @var int
	 */
	public $current;
	/**
	 * @var string[]
	 */
	public $keys;
	/**
	 * @var int
	 */
	public $length;
	/**
	 * @var mixed[]
	 */
	public $values;

	/**
	 * @param mixed[] $data
	 * 
	 * @return void
	 */
	public function __construct ($data) {
		#/home/runner/haxe/versions/4.2.3/std/php/NativeAssocArray.hx:48: characters 20-21
		$this->current = 0;
		#/home/runner/haxe/versions/4.2.3/std/php/NativeAssocArray.hx:53: characters 3-30
		$this->length = \count($data);
		#/home/runner/haxe/versions/4.2.3/std/php/NativeAssocArray.hx:54: characters 3-38
		$this->keys = \array_keys($data);
		#/home/runner/haxe/versions/4.2.3/std/php/NativeAssocArray.hx:55: characters 3-47
		$this->values = \array_values($data);
	}

	/**
	 * @return bool
	 */
	public function hasNext () {
		#/home/runner/haxe/versions/4.2.3/std/php/NativeAssocArray.hx:59: characters 3-26
		return $this->current < $this->length;
	}

	/**
	 * @return object
	 */
	public function next () {
		#/home/runner/haxe/versions/4.2.3/std/php/NativeAssocArray.hx:63: characters 16-29
		$tmp = $this->keys[$this->current];
		#/home/runner/haxe/versions/4.2.3/std/php/NativeAssocArray.hx:63: characters 3-56
		return new _HxAnon_NativeAssocArrayKeyValueIterator0($tmp, $this->values[$this->current++]);
	}
}

class _HxAnon_NativeAssocArrayKeyValueIterator0 extends HxAnon {
	function __construct($key, $value) {
		$this->key = $key;
		$this->value = $value;
	}
}

Boot::registerClass(NativeAssocArrayKeyValueIterator::class, 'php._NativeAssocArray.NativeAssocArrayKeyValueIterator');
