<?php
/**
 */

namespace helder\std\php\_NativeString;

use \helder\std\php\Boot;
use \helder\std\php\NativeStringKeyValueIterator;
use \helder\std\php\NativeStringIterator;

final class NativeString_Impl_ {
	/**
	 * @param mixed $this
	 * @param int $key
	 * 
	 * @return string
	 */
	public static function get ($this, $key) ;

	/**
	 * @param mixed $this
	 * 
	 * @return NativeStringIterator
	 */
	public static function iterator ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/php/NativeString.hx:34: characters 3-40
		return new NativeStringIterator($this1);
	}

	/**
	 * @param mixed $this
	 * 
	 * @return NativeStringKeyValueIterator
	 */
	public static function keyValueIterator ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/php/NativeString.hx:38: characters 3-48
		return new NativeStringKeyValueIterator($this1);
	}

	/**
	 * @param mixed $this
	 * @param int $key
	 * @param string $val
	 * 
	 * @return string
	 */
	public static function set ($this, $key, $val) ;
}

Boot::registerClass(NativeString_Impl_::class, 'php._NativeString.NativeString_Impl_');
