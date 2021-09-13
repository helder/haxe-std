<?php
/**
 */

namespace helder\std\haxe\ds\_HashMap;

use \helder\std\php\Boot;
use \helder\std\haxe\ds\IntMap;

class HashMapData {
	/**
	 * @var IntMap
	 */
	public $keys;
	/**
	 * @var IntMap
	 */
	public $values;

	/**
	 * @return void
	 */
	public function __construct () {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/HashMap.hx:117: characters 3-22
		$this->keys = new IntMap();
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/HashMap.hx:118: characters 3-24
		$this->values = new IntMap();
	}
}

Boot::registerClass(HashMapData::class, 'haxe.ds._HashMap.HashMapData');
