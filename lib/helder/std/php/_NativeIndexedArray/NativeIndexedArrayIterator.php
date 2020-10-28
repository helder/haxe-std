<?php
/**
 * Generated by Haxe 4.1.0
 */

namespace helder\std\php\_NativeIndexedArray;

use \helder\std\php\Boot;

class NativeIndexedArrayIterator {
	/**
	 * @var int
	 */
	public $current;
	/**
	 * @var mixed
	 */
	public $data;
	/**
	 * @var int
	 */
	public $length;

	/**
	 * @param mixed $data
	 * 
	 * @return void
	 */
	public function __construct ($data) {
		#/home/runner/haxe/versions/4.1.0/std/php/NativeIndexedArray.hx:63: characters 20-21
		$this->current = 0;
		#/home/runner/haxe/versions/4.1.0/std/php/NativeIndexedArray.hx:67: characters 3-30
		$this->length = count($data);
		#/home/runner/haxe/versions/4.1.0/std/php/NativeIndexedArray.hx:68: characters 3-19
		$this->data = $data;
	}

	/**
	 * @return bool
	 */
	public function hasNext () {
		#/home/runner/haxe/versions/4.1.0/std/php/NativeIndexedArray.hx:72: characters 3-26
		return $this->current < $this->length;
	}

	/**
	 * @return mixed
	 */
	public function next () {
		#/home/runner/haxe/versions/4.1.0/std/php/NativeIndexedArray.hx:76: characters 10-25
		return $this->data[$this->current++];
	}
}

Boot::registerClass(NativeIndexedArrayIterator::class, 'php._NativeIndexedArray.NativeIndexedArrayIterator');
