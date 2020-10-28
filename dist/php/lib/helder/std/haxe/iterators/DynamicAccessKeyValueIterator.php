<?php
/**
 * Generated by Haxe 4.1.4
 */

namespace helder\std\haxe\iterators;

use \helder\std\Reflect;
use \helder\std\php\_Boot\HxAnon;
use \helder\std\php\Boot;
use \helder\std\Array_hx;

/**
 * This Key/Value iterator can be used to iterate over `haxe.DynamicAccess`.
 */
class DynamicAccessKeyValueIterator {
	/**
	 * @var mixed
	 */
	public $access;
	/**
	 * @var int
	 */
	public $index;
	/**
	 * @var Array_hx
	 */
	public $keys;

	/**
	 * @param mixed $access
	 * 
	 * @return void
	 */
	public function __construct ($access) {
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/haxe/iterators/DynamicAccessKeyValueIterator.hx:34: characters 3-23
		$this->access = $access;
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/haxe/iterators/DynamicAccessKeyValueIterator.hx:35: characters 3-28
		$this->keys = Reflect::fields($access);
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/haxe/iterators/DynamicAccessKeyValueIterator.hx:36: characters 3-12
		$this->index = 0;
	}

	/**
	 * See `Iterator.hasNext`
	 * 
	 * @return bool
	 */
	public function hasNext () {
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/haxe/iterators/DynamicAccessKeyValueIterator.hx:43: characters 3-29
		return $this->index < $this->keys->length;
	}

	/**
	 * See `Iterator.next`
	 * 
	 * @return object
	 */
	public function next () {
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/haxe/iterators/DynamicAccessKeyValueIterator.hx:50: characters 3-27
		$key = ($this->keys->arr[$this->index++] ?? null);
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/haxe/iterators/DynamicAccessKeyValueIterator.hx:51: characters 3-40
		return new HxAnon([
			"value" => Reflect::field($this->access, $key),
			"key" => $key,
		]);
	}
}

Boot::registerClass(DynamicAccessKeyValueIterator::class, 'haxe.iterators.DynamicAccessKeyValueIterator');
