<?php
/**
 * Generated by Haxe 4.0.0+ef18b627e
 */

namespace helder\std\php\_NativeStructArray;

use \helder\std\php\_Boot\HxAnon;
use \helder\std\php\Boot;

final class NativeStructArray_Impl_ {
	/**
	 * @param mixed $obj
	 * 
	 * @return mixed
	 */
	static public function __fromObject ($obj) {
		#/home/runner/haxe/versions/4.0.0/std/php/NativeStructArray.hx:34: characters 3-32
		return ((array)($obj));
	}

	/**
	 * @param mixed $this
	 * 
	 * @return mixed
	 */
	static public function __toObject ($this1) {
		#/home/runner/haxe/versions/4.0.0/std/php/NativeStructArray.hx:39: characters 3-31
		return new HxAnon($this1);
	}

	/**
	 * @param mixed $this
	 * @param string $key
	 * 
	 * @return mixed
	 */
	static public function get ($this1, $key) {
		#/home/runner/haxe/versions/4.0.0/std/php/NativeStructArray.hx:44: characters 3-19
		return $this1[$key];
	}

	/**
	 * @param mixed $this
	 * @param string $key
	 * @param mixed $val
	 * 
	 * @return mixed
	 */
	static public function set ($this1, $key, $val) {
		#/home/runner/haxe/versions/4.0.0/std/php/NativeStructArray.hx:48: characters 3-25
		return $this1[$key] = $val;
	}
}

Boot::registerClass(NativeStructArray_Impl_::class, 'php._NativeStructArray.NativeStructArray_Impl_');
