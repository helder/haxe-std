<?php
/**
 */

namespace helder\std\haxe\_EnumFlags;

use \helder\std\php\Boot;

final class EnumFlags_Impl_ {
	/**
	 * Initializes the bitflags to `i`.
	 * 
	 * @param int $i
	 * 
	 * @return int
	 */
	public static function _new ($i = 0) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/EnumFlags.hx:39: character 2
		if ($i === null) {
			$i = 0;
		}
		$this1 = $i;
		return $this1;
	}

	/**
	 * Checks if the index of enum instance `v` is set.
	 * This method is optimized if `v` is an enum instance expression such as
	 * `SomeEnum.SomeCtor`.
	 * If `v` is `null`, the result is unspecified.
	 * 
	 * @param int $this
	 * @param mixed $v
	 * 
	 * @return bool
	 */
	public static function has ($this1, $v) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/EnumFlags.hx:52: characters 3-46
		return ($this1 & (1 << $v->index)) !== 0;
	}

	/**
	 * Convert a integer bitflag into a typed one (this is a no-op, it does not
	 * have any impact on speed).
	 * 
	 * @param int $i
	 * 
	 * @return int
	 */
	public static function ofInt ($i) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/EnumFlags.hx:84: characters 10-29
		$i1 = $i;
		#/home/runner/haxe/versions/4.2.3/std/haxe/EnumFlags.hx:84: characters 27-28
		if ($i1 === null) {
			$i1 = 0;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/EnumFlags.hx:84: characters 10-29
		$this1 = $i1;
		return $this1;
	}

	/**
	 * Sets the index of enum instance `v`.
	 * This method is optimized if `v` is an enum instance expression such as
	 * `SomeEnum.SomeCtor`.
	 * If `v` is `null`, the result is unspecified.
	 * 
	 * @param int $this
	 * @param mixed $v
	 * 
	 * @return void
	 */
	public static function set ($this1, $v) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/EnumFlags.hx:64: characters 3-33
		$this1 |= 1 << $v->index;
	}

	/**
	 * Convert the typed bitflag into the corresponding int value (this is a
	 * no-op, it doesn't have any impact on speed).
	 * 
	 * @param int $this
	 * 
	 * @return int
	 */
	public static function toInt ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/EnumFlags.hx:92: characters 3-14
		return $this1;
	}

	/**
	 * Unsets the index of enum instance `v`.
	 * This method is optimized if `v` is an enum instance expression such as
	 * `SomeEnum.SomeCtor`.
	 * If `v` is `null`, the result is unspecified.
	 * 
	 * @param int $this
	 * @param mixed $v
	 * 
	 * @return void
	 */
	public static function unset ($this1, $v) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/EnumFlags.hx:76: characters 3-48
		$this1 &= -1 - (1 << $v->index);
	}
}

Boot::registerClass(EnumFlags_Impl_::class, 'haxe._EnumFlags.EnumFlags_Impl_');
