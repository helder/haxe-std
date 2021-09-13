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
 * IntMap allows mapping of Int keys to arbitrary values.
 * See `Map` for documentation details.
 * @see https://haxe.org/manual/std-Map.html
 */
class IntMap implements IMap {
	/**
	 * @var mixed[]
	 */
	public $data;

	/**
	 * Creates a new IntMap.
	 * 
	 * @return void
	 */
	public function __construct () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/ds/IntMap.hx:34: characters 10-34
		$this1 = [];
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/ds/IntMap.hx:34: characters 3-34
		$this->data = $this1;
	}

	/**
	 * See `Map.clear`
	 * 
	 * @return void
	 */
	public function clear () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/ds/IntMap.hx:86: characters 10-34
		$this1 = [];
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/ds/IntMap.hx:86: characters 3-34
		$this->data = $this1;
	}

	/**
	 * See `Map.copy`
	 * 
	 * @return IntMap
	 */
	public function copy () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/ds/IntMap.hx:73: characters 3-28
		return (clone $this);
	}

	/**
	 * See `Map.exists`
	 * 
	 * @param int $key
	 * 
	 * @return bool
	 */
	public function exists ($key) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/ds/IntMap.hx:46: characters 3-44
		return \array_key_exists($key, $this->data);
	}

	/**
	 * See `Map.get`
	 * 
	 * @param int $key
	 * 
	 * @return mixed
	 */
	public function get ($key) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/ds/IntMap.hx:42: characters 3-42
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
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/ds/IntMap.hx:64: characters 10-46
		return new NativeIndexedArrayIterator(\array_values($this->data));
	}

	/**
	 * See `Map.keyValueIterator`
	 * 
	 * @return object
	 */
	public function keyValueIterator () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/ds/IntMap.hx:69: characters 3-54
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
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/ds/IntMap.hx:59: characters 10-44
		return new NativeIndexedArrayIterator(\array_keys($this->data));
	}

	/**
	 * See `Map.remove`
	 * 
	 * @param int $key
	 * 
	 * @return bool
	 */
	public function remove ($key) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/ds/IntMap.hx:50: lines 50-53
		if (\array_key_exists($key, $this->data)) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/ds/IntMap.hx:51: characters 4-27
			unset($this->data[$key]);
			#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/ds/IntMap.hx:52: characters 4-15
			return true;
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/ds/IntMap.hx:55: characters 3-15
		return false;
	}

	/**
	 * See `Map.set`
	 * 
	 * @param int $key
	 * @param mixed $value
	 * 
	 * @return void
	 */
	public function set ($key, $value) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/ds/IntMap.hx:38: characters 3-20
		$this->data[$key] = $value;
	}

	/**
	 * See `Map.toString`
	 * 
	 * @return string
	 */
	public function toString () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/ds/IntMap.hx:77: characters 15-32
		$this1 = [];
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/ds/IntMap.hx:77: characters 3-33
		$parts = $this1;
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/ds/IntMap.hx:78: lines 78-80
		$collection = $this->data;
		foreach ($collection as $key => $value) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/ds/IntMap.hx:79: characters 4-60
			\array_push($parts, "" . ($key??'null') . " => " . Std::string($value));
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/ds/IntMap.hx:82: characters 3-49
		return "{" . (\implode(", ", $parts)??'null') . "}";
	}

	public function __toString() {
		return $this->toString();
	}
}

Boot::registerClass(IntMap::class, 'haxe.ds.IntMap');
