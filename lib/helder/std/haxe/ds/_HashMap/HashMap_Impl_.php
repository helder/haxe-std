<?php
/**
 */

namespace helder\std\haxe\ds\_HashMap;

use \helder\std\php\Boot;
use \helder\std\haxe\iterators\HashMapKeyValueIterator;
use \helder\std\php\_NativeIndexedArray\NativeIndexedArrayIterator;

final class HashMap_Impl_ {
	/**
	 * Creates a new HashMap.
	 * 
	 * @return HashMapData
	 */
	public static function _new () {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/HashMap.hx:38: character 2
		$this1 = new HashMapData();
		return $this1;
	}

	/**
	 * See `Map.clear`
	 * 
	 * @param HashMapData $this
	 * 
	 * @return void
	 */
	public static function clear ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/HashMap.hx:107: characters 3-20
		$_this = $this1->keys;
		$this2 = [];
		$_this->data = $this2;
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/HashMap.hx:108: characters 3-22
		$_this = $this1->values;
		$this1 = [];
		$_this->data = $this1;
	}

	/**
	 * See `Map.copy`
	 * 
	 * @param HashMapData $this
	 * 
	 * @return HashMapData
	 */
	public static function copy ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/HashMap.hx:83: characters 3-34
		$copied = new HashMapData();
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/HashMap.hx:84: characters 3-33
		$copied->keys = (clone $this1->keys);
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/HashMap.hx:85: characters 3-37
		$copied->values = (clone $this1->values);
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/HashMap.hx:86: characters 3-21
		return $copied;
	}

	/**
	 * See `Map.exists`
	 * 
	 * @param HashMapData $this
	 * @param mixed $k
	 * 
	 * @return bool
	 */
	public static function exists ($this1, $k) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/HashMap.hx:61: characters 10-42
		$_this = $this1->values;
		return \array_key_exists($k->hashCode(), $_this->data);
	}

	/**
	 * See `Map.get`
	 * 
	 * @param HashMapData $this
	 * @param mixed $k
	 * 
	 * @return mixed
	 */
	public static function get ($this1, $k) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/HashMap.hx:54: characters 10-39
		$_this = $this1->values;
		$key = $k->hashCode();
		return ($_this->data[$key] ?? null);
	}

	/**
	 * See `Map.iterator`
	 * 
	 * @param HashMapData $this
	 * 
	 * @return object
	 */
	public static function iterator ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/HashMap.hx:93: characters 10-32
		return new NativeIndexedArrayIterator(\array_values($this1->values->data));
	}

	/**
	 * See `Map.keyValueIterator`
	 * 
	 * @param HashMapData $this
	 * 
	 * @return HashMapKeyValueIterator
	 */
	public static function keyValueIterator ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/HashMap.hx:100: characters 3-48
		return new HashMapKeyValueIterator($this1);
	}

	/**
	 * See `Map.keys`
	 * 
	 * @param HashMapData $this
	 * 
	 * @return object
	 */
	public static function keys ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/HashMap.hx:76: characters 10-30
		return new NativeIndexedArrayIterator(\array_values($this1->keys->data));
	}

	/**
	 * See `Map.remove`
	 * 
	 * @param HashMapData $this
	 * @param mixed $k
	 * 
	 * @return bool
	 */
	public static function remove ($this1, $k) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/HashMap.hx:68: characters 3-35
		$this1->values->remove($k->hashCode());
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/HashMap.hx:69: characters 3-40
		return $this1->keys->remove($k->hashCode());
	}

	/**
	 * See `Map.set`
	 * 
	 * @param HashMapData $this
	 * @param mixed $k
	 * @param mixed $v
	 * 
	 * @return void
	 */
	public static function set ($this1, $k, $v) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/HashMap.hx:46: characters 3-33
		$_this = $this1->keys;
		$key = $k->hashCode();
		$_this->data[$key] = $k;
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/HashMap.hx:47: characters 3-35
		$_this = $this1->values;
		$key = $k->hashCode();
		$_this->data[$key] = $v;
	}
}

Boot::registerClass(HashMap_Impl_::class, 'haxe.ds._HashMap.HashMap_Impl_');
