<?php
/**
 * Generated by Haxe 4.1.4
 */

namespace helder\std\php\_NativeArray;

use \helder\std\php\_Boot\HxAnon;
use \helder\std\php\Boot;

class NativeArrayKeyValueIterator {
	/**
	 * @var int
	 */
	public $current;
	/**
	 * @var mixed
	 */
	public $keys;
	/**
	 * @var int
	 */
	public $length;
	/**
	 * @var mixed
	 */
	public $values;

	/**
	 * @param mixed $data
	 * 
	 * @return void
	 */
	public function __construct ($data) {
		#/home/runner/haxe/versions/4.1.4/std/php/NativeArray.hx:61: characters 20-21
		$this->current = 0;
		#/home/runner/haxe/versions/4.1.4/std/php/NativeArray.hx:66: characters 3-30
		$this->length = \count($data);
		#/home/runner/haxe/versions/4.1.4/std/php/NativeArray.hx:67: characters 3-38
		$this->keys = \array_keys($data);
		#/home/runner/haxe/versions/4.1.4/std/php/NativeArray.hx:68: characters 3-42
		$this->values = \array_values($data);
	}

	/**
	 * @return bool
	 */
	public function hasNext () {
		#/home/runner/haxe/versions/4.1.4/std/php/NativeArray.hx:72: characters 3-26
		return $this->current < $this->length;
	}

	/**
	 * @return object
	 */
	public function next () {
		#/home/runner/haxe/versions/4.1.4/std/php/NativeArray.hx:76: characters 16-29
		$tmp = $this->keys[$this->current];
		#/home/runner/haxe/versions/4.1.4/std/php/NativeArray.hx:76: characters 3-56
		return new HxAnon([
			"key" => $tmp,
			"value" => $this->values[$this->current++],
		]);
	}
}

Boot::registerClass(NativeArrayKeyValueIterator::class, 'php._NativeArray.NativeArrayKeyValueIterator');
