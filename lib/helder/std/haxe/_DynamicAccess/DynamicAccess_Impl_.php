<?php
/**
 */

namespace helder\std\haxe\_DynamicAccess;

use \helder\std\Reflect;
use \helder\std\php\_Boot\HxAnon;
use \helder\std\php\Boot;
use \helder\std\haxe\iterators\DynamicAccessIterator;
use \helder\std\haxe\iterators\DynamicAccessKeyValueIterator;
use \helder\std\Array_hx;

final class DynamicAccess_Impl_ {
	/**
	 * Creates a new structure.
	 * 
	 * @return mixed
	 */
	public static function _new () {
		#/home/runner/haxe/versions/4.2.3/std/haxe/DynamicAccess.hx:40: character 2
		$this1 = new HxAnon();
		return $this1;
	}

	/**
	 * Returns a shallow copy of the structure
	 * 
	 * @param mixed $this
	 * 
	 * @return mixed
	 */
	public static function copy ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/DynamicAccess.hx:106: characters 3-28
		return Reflect::copy($this1);
	}

	/**
	 * Tells if the structure contains a specified `key`.
	 * If `key` is `null`, the result is unspecified.
	 * 
	 * @param mixed $this
	 * @param string $key
	 * 
	 * @return bool
	 */
	public static function exists ($this1, $key) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/DynamicAccess.hx:84: characters 3-37
		return Reflect::hasField($this1, $key);
	}

	/**
	 * Returns a value by specified `key`.
	 * If the structure does not contain the given key, `null` is returned.
	 * If `key` is `null`, the result is unspecified.
	 * 
	 * @param mixed $this
	 * @param string $key
	 * 
	 * @return mixed
	 */
	public static function get ($this1, $key) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/DynamicAccess.hx:55: characters 3-34
		return Reflect::field($this1, $key);
	}

	/**
	 * Returns an Iterator over the values of this `DynamicAccess`.
	 * The order of values is undefined.
	 * 
	 * @param mixed $this
	 * 
	 * @return DynamicAccessIterator
	 */
	public static function iterator ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/DynamicAccess.hx:114: characters 3-41
		return new DynamicAccessIterator($this1);
	}

	/**
	 * Returns an Iterator over the keys and values of this `DynamicAccess`.
	 * The order of values is undefined.
	 * 
	 * @param mixed $this
	 * 
	 * @return DynamicAccessKeyValueIterator
	 */
	public static function keyValueIterator ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/DynamicAccess.hx:123: characters 3-49
		return new DynamicAccessKeyValueIterator($this1);
	}

	/**
	 * Returns an array of `keys` in a structure.
	 * 
	 * @param mixed $this
	 * 
	 * @return string[]|Array_hx
	 */
	public static function keys ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/DynamicAccess.hx:100: characters 3-30
		return Reflect::fields($this1);
	}

	/**
	 * Removes a specified `key` from the structure.
	 * Returns true, if `key` was present in structure, or false otherwise.
	 * If `key` is `null`, the result is unspecified.
	 * 
	 * @param mixed $this
	 * @param string $key
	 * 
	 * @return bool
	 */
	public static function remove ($this1, $key) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/DynamicAccess.hx:94: characters 3-40
		return Reflect::deleteField($this1, $key);
	}

	/**
	 * Sets a `value` for a specified `key`.
	 * If the structure contains the given key, its value will be overwritten.
	 * Returns the given value.
	 * If `key` is `null`, the result is unspecified.
	 * 
	 * @param mixed $this
	 * @param string $key
	 * @param mixed $value
	 * 
	 * @return mixed
	 */
	public static function set ($this1, $key, $value) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/DynamicAccess.hx:73: characters 3-37
		Reflect::setField($this1, $key, $value);
		#/home/runner/haxe/versions/4.2.3/std/haxe/DynamicAccess.hx:74: characters 3-15
		return $value;
	}
}

Boot::registerClass(DynamicAccess_Impl_::class, 'haxe._DynamicAccess.DynamicAccess_Impl_');
