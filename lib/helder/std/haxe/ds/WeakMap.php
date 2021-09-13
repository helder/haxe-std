<?php
/**
 */

namespace helder\std\haxe\ds;

use \helder\std\php\_Boot\HxAnon;
use \helder\std\php\Boot;
use \helder\std\haxe\IMap;
use \helder\std\haxe\exceptions\NotImplementedException;

/**
 * WeakMap allows mapping of object keys to arbitrary values.
 * The keys are considered to be weak references on static targets.
 * See `Map` for documentation details.
 * @see https://haxe.org/manual/std-Map.html
 */
class WeakMap implements IMap {
	/**
	 * Creates a new WeakMap.
	 * 
	 * @return void
	 */
	public function __construct () {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/WeakMap.hx:39: characters 3-8
		throw new NotImplementedException("Not implemented for this platform", null, new _HxAnon_WeakMap0("haxe/ds/WeakMap.hx", 39, "haxe.ds.WeakMap", "new"));
	}

	/**
	 * See `Map.clear`
	 * 
	 * @return void
	 */
	public function clear () {
	}

	/**
	 * See `Map.copy`
	 * 
	 * @return WeakMap
	 */
	public function copy () {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/WeakMap.hx:93: characters 3-14
		return null;
	}

	/**
	 * See `Map.exists`
	 * 
	 * @param mixed $key
	 * 
	 * @return bool
	 */
	public function exists ($key) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/WeakMap.hx:58: characters 3-15
		return false;
	}

	/**
	 * See `Map.get`
	 * 
	 * @param mixed $key
	 * 
	 * @return mixed
	 */
	public function get ($key) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/WeakMap.hx:51: characters 3-14
		return null;
	}

	/**
	 * See `Map.iterator`
	 * 
	 * @return object
	 */
	public function iterator () {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/WeakMap.hx:79: characters 3-14
		return null;
	}

	/**
	 * See `Map.keyValueIterator`
	 * 
	 * @return object
	 */
	public function keyValueIterator () {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/WeakMap.hx:86: characters 3-14
		return null;
	}

	/**
	 * See `Map.keys`
	 * 
	 * @return object
	 */
	public function keys () {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/WeakMap.hx:72: characters 3-14
		return null;
	}

	/**
	 * See `Map.remove`
	 * 
	 * @param mixed $key
	 * 
	 * @return bool
	 */
	public function remove ($key) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/WeakMap.hx:65: characters 3-15
		return false;
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
	}

	/**
	 * See `Map.toString`
	 * 
	 * @return string
	 */
	public function toString () {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/WeakMap.hx:100: characters 3-14
		return null;
	}

	public function __toString() {
		return $this->toString();
	}
}

class _HxAnon_WeakMap0 extends HxAnon {
	function __construct($fileName, $lineNumber, $className, $methodName) {
		$this->fileName = $fileName;
		$this->lineNumber = $lineNumber;
		$this->className = $className;
		$this->methodName = $methodName;
	}
}

Boot::registerClass(WeakMap::class, 'haxe.ds.WeakMap');
