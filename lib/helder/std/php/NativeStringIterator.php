<?php
/**
 */

namespace helder\std\php;


class NativeStringIterator {
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
		#/home/runner/haxe/versions/4.2.3/std/php/NativeString.hx:44: characters 14-15
		$this->i = 0;
		#/home/runner/haxe/versions/4.2.3/std/php/NativeString.hx:47: characters 3-13
		$this->s = $s;
	}

	/**
	 * @return bool
	 */
	public function hasNext () {
		#/home/runner/haxe/versions/4.2.3/std/php/NativeString.hx:51: characters 3-30
		return $this->i < \strlen($this->s);
	}

	/**
	 * @return string
	 */
	public function next () {
		#/home/runner/haxe/versions/4.2.3/std/php/NativeString.hx:55: characters 3-16
		return $this->s[$this->i++];
	}
}

Boot::registerClass(NativeStringIterator::class, 'php.NativeStringIterator');
