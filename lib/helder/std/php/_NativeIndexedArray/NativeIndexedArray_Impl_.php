<?php
/**
 */

namespace helder\std\php\_NativeIndexedArray;

use \helder\std\php\Boot;
use \helder\std\Array_hx;

final class NativeIndexedArray_Impl_ {
	/**
	 * @return mixed[]
	 */
	public static function _new () {
		#/home/runner/haxe/versions/4.2.3/std/php/NativeIndexedArray.hx:28: character 2
		$this1 = [];
		return $this1;
	}

	/**
	 * @param mixed[]|Array_hx $a
	 * 
	 * @return mixed[]
	 */
	public static function fromHaxeArray ($a) {
		#/home/runner/haxe/versions/4.2.3/std/php/NativeIndexedArray.hx:54: characters 3-31
		return $a->arr;
	}

	/**
	 * @param array $this
	 * @param int $idx
	 * 
	 * @return mixed
	 */
	public static function get ($this1, $idx) {
		#/home/runner/haxe/versions/4.2.3/std/php/NativeIndexedArray.hx:33: characters 3-19
		return $this1[$idx];
	}

	/**
	 * @param array $this
	 * 
	 * @return NativeIndexedArrayIterator
	 */
	public static function iterator ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/php/NativeIndexedArray.hx:43: characters 3-46
		return new NativeIndexedArrayIterator($this1);
	}

	/**
	 * @param array $this
	 * 
	 * @return NativeIndexedArrayKeyValueIterator
	 */
	public static function keyValueIterator ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/php/NativeIndexedArray.hx:46: characters 3-54
		return new NativeIndexedArrayKeyValueIterator($this1);
	}

	/**
	 * @param array $this
	 * @param mixed $val
	 * 
	 * @return void
	 */
	public static function push ($this1, $val) {
		#/home/runner/haxe/versions/4.2.3/std/php/NativeIndexedArray.hx:40: characters 3-40
		$this1[] = $val;
	}

	/**
	 * @param array $this
	 * @param int $idx
	 * @param mixed $val
	 * 
	 * @return mixed
	 */
	public static function set ($this1, $idx, $val) {
		#/home/runner/haxe/versions/4.2.3/std/php/NativeIndexedArray.hx:37: characters 3-25
		return $this1[$idx] = $val;
	}

	/**
	 * @param array $this
	 * 
	 * @return mixed[]|Array_hx
	 */
	public static function toHaxeArray ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/php/NativeIndexedArray.hx:50: characters 3-42
		return Array_hx::wrap($this1);
	}

	/**
	 * @param array $this
	 * 
	 * @return string
	 */
	public static function toString ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/php/NativeIndexedArray.hx:57: characters 3-48
		return Boot::stringifyNativeIndexedArray($this1);
	}
}

Boot::registerClass(NativeIndexedArray_Impl_::class, 'php._NativeIndexedArray.NativeIndexedArray_Impl_');
