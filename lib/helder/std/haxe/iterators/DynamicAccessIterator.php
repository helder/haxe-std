<?php
/**
 */

namespace helder\std\haxe\iterators;

use \helder\std\Reflect;
use \helder\std\php\Boot;
use \helder\std\Array_hx;

/**
 * This iterator can be used to iterate over the values of `haxe.DynamicAccess`.
 */
class DynamicAccessIterator {
	/**
	 * @var mixed
	 */
	public $access;
	/**
	 * @var int
	 */
	public $index;
	/**
	 * @var string[]|Array_hx
	 */
	public $keys;

	/**
	 * @param mixed $access
	 * 
	 * @return void
	 */
	public function __construct ($access) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/iterators/DynamicAccessIterator.hx:34: characters 3-23
		$this->access = $access;
		#/home/runner/haxe/versions/4.2.3/std/haxe/iterators/DynamicAccessIterator.hx:35: characters 3-28
		$this->keys = Reflect::fields($access);
		#/home/runner/haxe/versions/4.2.3/std/haxe/iterators/DynamicAccessIterator.hx:36: characters 3-12
		$this->index = 0;
	}

	/**
	 * See `Iterator.hasNext`
	 * 
	 * @return bool
	 */
	public function hasNext () {
		#/home/runner/haxe/versions/4.2.3/std/haxe/iterators/DynamicAccessIterator.hx:43: characters 3-29
		return $this->index < $this->keys->length;
	}

	/**
	 * See `Iterator.next`
	 * 
	 * @return mixed
	 */
	public function next () {
		#/home/runner/haxe/versions/4.2.3/std/haxe/iterators/DynamicAccessIterator.hx:50: characters 10-31
		return Reflect::field($this->access, ($this->keys->arr[$this->index++] ?? null));
	}
}

Boot::registerClass(DynamicAccessIterator::class, 'haxe.iterators.DynamicAccessIterator');
