<?php
/**
 */

namespace helder\std\haxe\_Rest;

use \helder\std\haxe\iterators\RestKeyValueIterator;
use \helder\std\php\Boot;
use \helder\std\Array_hx;
use \helder\std\haxe\iterators\RestIterator;

final class Rest_Impl_ {

	/**
	 * @param mixed[] $a
	 * 
	 * @return array
	 */
	public static function _new ($a) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/Rest.hx:20: character 2
		$this1 = $a;
		return $this1;
	}

	/**
	 * Create a new rest arguments collection by appending `item` to this one.
	 * 
	 * @param mixed[] $this
	 * @param mixed $item
	 * 
	 * @return array
	 */
	public static function append ($this1, $item) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/Rest.hx:36: characters 3-21
		$result = $this1;
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/Rest.hx:37: characters 3-20
		$result[] = $item;
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/Rest.hx:38: characters 10-26
		$this1 = $result;
		return $this1;
	}

	/**
	 * @param mixed[] $this
	 * @param int $index
	 * 
	 * @return mixed
	 */
	public static function get ($this1, $index) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/Rest.hx:24: characters 3-21
		return $this1[$index];
	}

	/**
	 * @param mixed[] $this
	 * 
	 * @return int
	 */
	public static function get_length ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/Rest.hx:14: characters 3-28
		return \count($this1);
	}

	/**
	 * @param mixed[] $this
	 * 
	 * @return RestIterator
	 */
	public static function iterator ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/Rest.hx:30: characters 3-35
		return new RestIterator($this1);
	}

	/**
	 * @param mixed[] $this
	 * 
	 * @return RestKeyValueIterator
	 */
	public static function keyValueIterator ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/Rest.hx:33: characters 3-43
		return new RestKeyValueIterator($this1);
	}

	/**
	 * Create rest arguments using contents of `array`.
	 * WARNING:
	 * Depending on a target platform modifying `array` after using this method
	 * may affect the created `Rest` instance.
	 * Use `Rest.of(array.copy())` to avoid that.
	 * 
	 * @param mixed[]|Array_hx $array
	 * 
	 * @return array
	 */
	public static function of ($array) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/Rest.hx:18: characters 10-45
		$this1 = $array->arr;
		return $this1;
	}

	/**
	 * Create a new rest arguments collection by prepending this one with `item`.
	 * 
	 * @param mixed[] $this
	 * @param mixed $item
	 * 
	 * @return array
	 */
	public static function prepend ($this1, $item) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/Rest.hx:42: characters 3-21
		$result = $this1;
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/Rest.hx:43: characters 3-37
		\array_unshift($result, $item);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/Rest.hx:44: characters 10-26
		$this1 = $result;
		return $this1;
	}

	/**
	 * Creates an array containing all the values of rest arguments.
	 * 
	 * @param mixed[] $this
	 * 
	 * @return mixed[]|Array_hx
	 */
	public static function toArray ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/Rest.hx:27: characters 3-42
		return Array_hx::wrap($this1);
	}

	/**
	 * @param mixed[] $this
	 * 
	 * @return string
	 */
	public static function toString ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/Rest.hx:48: characters 10-55
		$strings = [];
		foreach ($this1 as $key => $value) {
			$strings[$key] = Boot::stringify($value, 9);
		}
		return "[" . (\implode(",", $strings)??'null') . "]";
	}
}

Boot::registerClass(Rest_Impl_::class, 'haxe._Rest.Rest_Impl_');
Boot::registerGetters('helder\\std\\haxe\\_Rest\\Rest_Impl_', [
	'length' => true
]);
