<?php
/**
 */

namespace helder\std\haxe\ds;

use \helder\std\php\Boot;
use \helder\std\haxe\iterators\MapKeyValueIterator;
use \helder\std\Std;
use \helder\std\haxe\IMap;
use \helder\std\php\_NativeIndexedArray\NativeIndexedArrayIterator;

/**
 * StringMap allows mapping of String keys to arbitrary values.
 * See `Map` for documentation details.
 * @see https://haxe.org/manual/std-Map.html
 */
class StringMap implements IMap {
	/**
	 * @var array
	 */
	public $data;

	/**
	 * Creates a new StringMap.
	 * 
	 * @return void
	 */
	public function __construct () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/ds/StringMap.hx:35: characters 10-32
		$this1 = [];
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/ds/StringMap.hx:35: characters 3-32
		$this->data = $this1;
	}

	/**
	 * See `Map.clear`
	 * 
	 * @return void
	 */
	public function clear () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/ds/StringMap.hx:87: characters 10-32
		$this1 = [];
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/ds/StringMap.hx:87: characters 3-32
		$this->data = $this1;
	}

	/**
	 * See `Map.copy`
	 * 
	 * @return StringMap
	 */
	public function copy () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/ds/StringMap.hx:74: characters 3-28
		return (clone $this);
	}

	/**
	 * See `Map.exists`
	 * 
	 * @param string $key
	 * 
	 * @return bool
	 */
	public function exists ($key) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/ds/StringMap.hx:47: characters 3-44
		return \array_key_exists($key, $this->data);
	}

	/**
	 * See `Map.get`
	 * 
	 * @param string $key
	 * 
	 * @return mixed
	 */
	public function get ($key) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/ds/StringMap.hx:43: characters 3-42
		return ($this->data[$key] ?? null);
	}

	/**
	 * See `Map.iterator`
	 * (cs, java) Implementation detail: Do not `set()` any new value while
	 * iterating, as it may cause a resize, which will break iteration.
	 * 
	 * @return object
	 */
	public function iterator () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/ds/StringMap.hx:65: characters 10-25
		return new NativeIndexedArrayIterator(\array_values($this->data));
	}

	/**
	 * See `Map.keyValueIterator`
	 * 
	 * @return object
	 */
	public function keyValueIterator () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/ds/StringMap.hx:70: characters 3-54
		return new MapKeyValueIterator($this);
	}

	/**
	 * See `Map.keys`
	 * (cs, java) Implementation detail: Do not `set()` any new value while
	 * iterating, as it may cause a resize, which will break iteration.
	 * 
	 * @return object
	 */
	public function keys () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/ds/StringMap.hx:60: characters 10-72
		return new NativeIndexedArrayIterator(\array_values(\array_map("strval", \array_keys($this->data))));
	}

	/**
	 * See `Map.remove`
	 * 
	 * @param string $key
	 * 
	 * @return bool
	 */
	public function remove ($key) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/ds/StringMap.hx:51: lines 51-56
		if (\array_key_exists($key, $this->data)) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/ds/StringMap.hx:52: characters 4-27
			unset($this->data[$key]);
			#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/ds/StringMap.hx:53: characters 4-15
			return true;
		} else {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/ds/StringMap.hx:55: characters 4-16
			return false;
		}
	}

	/**
	 * See `Map.set`
	 * 
	 * @param string $key
	 * @param mixed $value
	 * 
	 * @return void
	 */
	public function set ($key, $value) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/ds/StringMap.hx:39: characters 3-20
		$this->data[$key] = $value;
	}

	/**
	 * See `Map.toString`
	 * 
	 * @return string
	 */
	public function toString () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/ds/StringMap.hx:78: characters 15-32
		$this1 = [];
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/ds/StringMap.hx:78: characters 3-33
		$parts = $this1;
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/ds/StringMap.hx:79: lines 79-81
		$collection = $this->data;
		foreach ($collection as $key => $value) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/ds/StringMap.hx:80: characters 4-60
			\array_push($parts, "" . ($key??'null') . " => " . Std::string($value));
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/ds/StringMap.hx:83: characters 3-49
		return "{" . (\implode(", ", $parts)??'null') . "}";
	}

	public function __toString() {
		return $this->toString();
	}
}

Boot::registerClass(StringMap::class, 'haxe.ds.StringMap');
