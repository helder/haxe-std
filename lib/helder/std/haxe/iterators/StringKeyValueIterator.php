<?php
/**
 */

namespace helder\std\haxe\iterators;

use \helder\std\php\_Boot\HxAnon;
use \helder\std\StringTools;
use \helder\std\php\Boot;

/**
 * This iterator can be used to iterate over char indexes and char codes in a string.
 * Note that char codes may differ across platforms because of different
 * internal encoding of strings in different runtimes.
 */
class StringKeyValueIterator {
	/**
	 * @var int
	 */
	public $offset;
	/**
	 * @var string
	 */
	public $s;

	/**
	 * Create a new `StringKeyValueIterator` over String `s`.
	 * 
	 * @param string $s
	 * 
	 * @return void
	 */
	public function __construct ($s) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/iterators/StringKeyValueIterator.hx:32: characters 15-16
		$this->offset = 0;
		#/home/runner/haxe/versions/4.2.3/std/haxe/iterators/StringKeyValueIterator.hx:39: characters 3-13
		$this->s = $s;
	}

	/**
	 * See `KeyValueIterator.hasNext`
	 * 
	 * @return bool
	 */
	public function hasNext () {
		#/home/runner/haxe/versions/4.2.3/std/haxe/iterators/StringKeyValueIterator.hx:46: characters 3-27
		return $this->offset < mb_strlen($this->s);
	}

	/**
	 * See `KeyValueIterator.next`
	 * 
	 * @return object
	 */
	public function next () {
		#/home/runner/haxe/versions/4.2.3/std/haxe/iterators/StringKeyValueIterator.hx:53: characters 16-22
		$tmp = $this->offset;
		#/home/runner/haxe/versions/4.2.3/std/haxe/iterators/StringKeyValueIterator.hx:53: characters 3-67
		return new _HxAnon_StringKeyValueIterator0($tmp, StringTools::fastCodeAt($this->s, $this->offset++));
	}
}

class _HxAnon_StringKeyValueIterator0 extends HxAnon {
	function __construct($key, $value) {
		$this->key = $key;
		$this->value = $value;
	}
}

Boot::registerClass(StringKeyValueIterator::class, 'haxe.iterators.StringKeyValueIterator');
