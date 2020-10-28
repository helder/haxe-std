<?php
/**
 * Generated by Haxe 4.1.4
 */

namespace helder\std\haxe\ds;

use \helder\std\php\Boot;
use \helder\std\haxe\iterators\MapKeyValueIterator;
use \helder\std\Std;
use \helder\std\haxe\IMap;
use \helder\std\php\_NativeIndexedArray\NativeIndexedArrayIterator;

/**
 * ObjectMap allows mapping of object keys to arbitrary values.
 * On static targets, the keys are considered to be strong references. Refer
 * to `haxe.ds.WeakMap` for a weak reference version.
 * See `Map` for documentation details.
 * @see https://haxe.org/manual/std-Map.html
 */
class ObjectMap implements IMap {
	/**
	 * @var mixed
	 */
	public $_keys;
	/**
	 * @var mixed
	 */
	public $_values;

	/**
	 * Creates a new ObjectMap.
	 * 
	 * @return void
	 */
	public function __construct () {
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/ds/ObjectMap.hx:33: characters 11-33
		$this1 = [];
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/ds/ObjectMap.hx:33: characters 3-33
		$this->_keys = $this1;
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/ds/ObjectMap.hx:34: characters 13-35
		$this1 = [];
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/ds/ObjectMap.hx:34: characters 3-35
		$this->_values = $this1;
	}

	/**
	 * See `Map.clear`
	 * 
	 * @return void
	 */
	public function clear () {
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/ds/ObjectMap.hx:94: characters 11-33
		$this1 = [];
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/ds/ObjectMap.hx:94: characters 3-33
		$this->_keys = $this1;
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/ds/ObjectMap.hx:95: characters 13-35
		$this1 = [];
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/ds/ObjectMap.hx:95: characters 3-35
		$this->_values = $this1;
	}

	/**
	 * See `Map.copy`
	 * 
	 * @return ObjectMap
	 */
	public function copy () {
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/ds/ObjectMap.hx:77: characters 3-28
		return (clone $this);
	}

	/**
	 * See `Map.exists`
	 * 
	 * @param mixed $key
	 * 
	 * @return bool
	 */
	public function exists ($key) {
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/ds/ObjectMap.hx:49: characters 3-71
		return \array_key_exists(\spl_object_hash($key), $this->_values);
	}

	/**
	 * See `Map.get`
	 * 
	 * @param mixed $key
	 * 
	 * @return mixed
	 */
	public function get ($key) {
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/ds/ObjectMap.hx:44: characters 3-40
		$id = \spl_object_hash($key);
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/ds/ObjectMap.hx:45: characters 10-56
		if (isset($this->_values[$id])) {
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/ds/ObjectMap.hx:45: characters 38-49
			return $this->_values[$id];
		} else {
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/ds/ObjectMap.hx:45: characters 52-56
			return null;
		}
	}

	/**
	 * See `Map.iterator`
	 * (cs, java) Implementation detail: Do not `set()` any new value while
	 * iterating, as it may cause a resize, which will break iteration.
	 * 
	 * @return object
	 */
	public function iterator () {
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/ds/ObjectMap.hx:68: characters 10-28
		return new NativeIndexedArrayIterator(\array_values($this->_values));
	}

	/**
	 * See `Map.keyValueIterator`
	 * 
	 * @return object
	 */
	public function keyValueIterator () {
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/ds/ObjectMap.hx:73: characters 3-54
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
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/ds/ObjectMap.hx:63: characters 10-26
		return new NativeIndexedArrayIterator(\array_values($this->_keys));
	}

	/**
	 * See `Map.remove`
	 * 
	 * @param mixed $key
	 * 
	 * @return bool
	 */
	public function remove ($key) {
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/ds/ObjectMap.hx:53: characters 3-40
		$id = \spl_object_hash($key);
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/ds/ObjectMap.hx:54: lines 54-59
		if (\array_key_exists($id, $this->_values)) {
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/ds/ObjectMap.hx:55: characters 4-40
			unset($this->_keys[$id], $this->_values[$id]);
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/ds/ObjectMap.hx:56: characters 4-15
			return true;
		} else {
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/ds/ObjectMap.hx:58: characters 4-16
			return false;
		}
	}

	/**
	 * See `Map.set`
	 * 
	 * @param mixed $key
	 * @param mixed $value
	 * 
	 * @return void
	 */
	public function set ($key, $value) {
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/ds/ObjectMap.hx:38: characters 3-40
		$id = \spl_object_hash($key);
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/ds/ObjectMap.hx:39: characters 3-18
		$this->_keys[$id] = $key;
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/ds/ObjectMap.hx:40: characters 3-22
		$this->_values[$id] = $value;
	}

	/**
	 * See `Map.toString`
	 * 
	 * @return string
	 */
	public function toString () {
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/ds/ObjectMap.hx:81: characters 3-15
		$s = "{";
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/ds/ObjectMap.hx:82: characters 3-19
		$it = new NativeIndexedArrayIterator(\array_values($this->_keys));
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/ds/ObjectMap.hx:83: characters 13-15
		$i = $it;
		while ($i->hasNext()) {
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/ds/ObjectMap.hx:83: lines 83-89
			$i1 = $i->next();
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/ds/ObjectMap.hx:84: characters 4-22
			$s = ($s??'null') . (Std::string($i1)??'null');
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/ds/ObjectMap.hx:85: characters 4-15
			$s = ($s??'null') . " => ";
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/ds/ObjectMap.hx:86: characters 4-27
			$s = ($s??'null') . (Std::string($this->get($i1))??'null');
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/ds/ObjectMap.hx:87: lines 87-88
			if ($it->hasNext()) {
				#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/ds/ObjectMap.hx:88: characters 5-14
				$s = ($s??'null') . ", ";
			}
		}
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/ds/ObjectMap.hx:90: characters 3-17
		return ($s??'null') . "}";
	}

	public function __toString() {
		return $this->toString();
	}
}

Boot::registerClass(ObjectMap::class, 'haxe.ds.ObjectMap');
