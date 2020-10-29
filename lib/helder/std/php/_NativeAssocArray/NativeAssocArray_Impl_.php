<?php
/**
 * Generated by Haxe 4.1.4
 */

namespace helder\std\php\_NativeAssocArray;

use \helder\std\php\Boot;
use \helder\std\php\_NativeIndexedArray\NativeIndexedArrayIterator;

final class NativeAssocArray_Impl_ {
	/**
	 * @return mixed
	 */
	public static function _new () {
		#/home/runner/haxe/versions/4.1.4/std/php/NativeAssocArray.hx:28: character 2
		$this1 = [];
		return $this1;
	}

	/**
	 * @param mixed $this
	 * @param string $key
	 * 
	 * @return mixed
	 */
	public static function get ($this1, $key) {
		#/home/runner/haxe/versions/4.1.4/std/php/NativeAssocArray.hx:33: characters 3-19
		return $this1[$key];
	}

	/**
	 * @param mixed $this
	 * 
	 * @return NativeIndexedArrayIterator
	 */
	public static function iterator ($this1) {
		#/home/runner/haxe/versions/4.1.4/std/php/NativeAssocArray.hx:40: characters 10-77
		return new NativeIndexedArrayIterator(\array_values($this1));
	}

	/**
	 * @param mixed $this
	 * 
	 * @return NativeAssocArrayKeyValueIterator
	 */
	public static function keyValueIterator ($this1) {
		#/home/runner/haxe/versions/4.1.4/std/php/NativeAssocArray.hx:43: characters 3-52
		return new NativeAssocArrayKeyValueIterator($this1);
	}

	/**
	 * @param mixed $this
	 * @param string $key
	 * @param mixed $val
	 * 
	 * @return mixed
	 */
	public static function set ($this1, $key, $val) {
		#/home/runner/haxe/versions/4.1.4/std/php/NativeAssocArray.hx:37: characters 3-25
		return $this1[$key] = $val;
	}
}

Boot::registerClass(NativeAssocArray_Impl_::class, 'php._NativeAssocArray.NativeAssocArray_Impl_');