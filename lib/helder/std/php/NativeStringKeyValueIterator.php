<?php
/**
 */

namespace helder\std\php;

use \helder\std\php\_Boot\HxAnon;

class NativeStringKeyValueIterator {
	/**
	 * @var int
	 */
	public $i;
	/**
	 * @var mixed
	 */
	public $s;

	/**
	 * @param mixed $s
	 * 
	 * @return void
	 */
	public function __construct ($s) {
		#/home/runner/haxe/versions/4.2.3/std/php/NativeString.hx:61: characters 14-15
		$this->i = 0;
		#/home/runner/haxe/versions/4.2.3/std/php/NativeString.hx:64: characters 3-13
		$this->s = $s;
	}

	/**
	 * @return bool
	 */
	public function hasNext () {
		#/home/runner/haxe/versions/4.2.3/std/php/NativeString.hx:68: characters 3-30
		return $this->i < \strlen($this->s);
	}

	/**
	 * @return object
	 */
	public function next () {
		#/home/runner/haxe/versions/4.2.3/std/php/NativeString.hx:72: characters 16-17
		$tmp = $this->i;
		#/home/runner/haxe/versions/4.2.3/std/php/NativeString.hx:72: characters 3-33
		return new _HxAnon_NativeStringKeyValueIterator0($tmp, $this->s[$this->i++]);
	}
}

class _HxAnon_NativeStringKeyValueIterator0 extends HxAnon {
	function __construct($key, $value) {
		$this->key = $key;
		$this->value = $value;
	}
}

Boot::registerClass(NativeStringKeyValueIterator::class, 'php.NativeStringKeyValueIterator');
