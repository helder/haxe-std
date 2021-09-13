<?php
/**
 */

namespace helder\std\haxe\ds\_ReadOnlyArray;

use \helder\std\php\Boot;
use \helder\std\Array_hx;

final class ReadOnlyArray_Impl_ {

	/**
	 * Returns a new Array by appending the elements of `a` to the elements of
	 * `this` Array.
	 * This operation does not modify `this` Array.
	 * If `a` is the empty Array `[]`, a copy of `this` Array is returned.
	 * The length of the returned Array is equal to the sum of `this.length`
	 * and `a.length`.
	 * If `a` is `null`, the result is unspecified.
	 * 
	 * @param mixed[]|Array_hx $this
	 * @param mixed[]|Array_hx $a
	 * 
	 * @return mixed[]|Array_hx
	 */
	public static function concat ($this1, $a) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ReadOnlyArray.hx:60: characters 3-29
		return $this1->concat($a);
	}

	/**
	 * @param mixed[]|Array_hx $this
	 * @param int $i
	 * 
	 * @return mixed
	 */
	public static function get ($this1, $i) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ReadOnlyArray.hx:44: characters 3-17
		return ($this1->arr[$i] ?? null);
	}

	/**
	 * @param mixed[]|Array_hx $this
	 * 
	 * @return int
	 */
	public static function get_length ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ReadOnlyArray.hx:41: characters 3-21
		return $this1->length;
	}
}

Boot::registerClass(ReadOnlyArray_Impl_::class, 'haxe.ds._ReadOnlyArray.ReadOnlyArray_Impl_');
Boot::registerGetters('helder\\std\\haxe\\ds\\_ReadOnlyArray\\ReadOnlyArray_Impl_', [
	'length' => true
]);
