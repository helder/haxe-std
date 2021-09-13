<?php
/**
 */

namespace helder\std\haxe\ds;

use \helder\std\Reflect;
use \helder\std\php\Boot;
use \helder\std\Array_hx;
use \helder\std\haxe\IMap;
use \helder\std\php\_Boot\HxEnum;

/**
 * EnumValueMap allows mapping of enum value keys to arbitrary values.
 * Keys are compared by value and recursively over their parameters. If any
 * parameter is not an enum value, `Reflect.compare` is used to compare them.
 */
class EnumValueMap extends BalancedTree implements IMap {
	/**
	 * @return void
	 */
	public function __construct () {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/EnumValueMap.hx:31: lines 31-70
		parent::__construct();
	}

	/**
	 * @param mixed $k1
	 * @param mixed $k2
	 * 
	 * @return int
	 */
	public function compare ($k1, $k2) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/EnumValueMap.hx:33: characters 3-41
		$d = $k1->index - $k2->index;
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/EnumValueMap.hx:34: lines 34-35
		if ($d !== 0) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/EnumValueMap.hx:35: characters 4-12
			return $d;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/EnumValueMap.hx:36: characters 3-31
		$p1 = Array_hx::wrap($k1->params);
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/EnumValueMap.hx:37: characters 3-31
		$p2 = Array_hx::wrap($k2->params);
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/EnumValueMap.hx:38: lines 38-39
		if (($p1->length === 0) && ($p2->length === 0)) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/EnumValueMap.hx:39: characters 4-12
			return 0;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/EnumValueMap.hx:40: characters 3-29
		return $this->compareArgs($p1, $p2);
	}

	/**
	 * @param mixed $v1
	 * @param mixed $v2
	 * 
	 * @return int
	 */
	public function compareArg ($v1, $v2) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/EnumValueMap.hx:56: lines 56-62
		if (($v1 instanceof HxEnum) && ($v2 instanceof HxEnum)) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/EnumValueMap.hx:57: characters 4-19
			return $this->compare($v1, $v2);
		} else if (($v1 instanceof Array_hx) && ($v2 instanceof Array_hx)) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/EnumValueMap.hx:59: characters 4-23
			return $this->compareArgs($v1, $v2);
		} else {
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/EnumValueMap.hx:61: characters 4-27
			return Reflect::compare($v1, $v2);
		}
	}

	/**
	 * @param mixed[]|Array_hx $a1
	 * @param mixed[]|Array_hx $a2
	 * 
	 * @return int
	 */
	public function compareArgs ($a1, $a2) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/EnumValueMap.hx:44: characters 3-34
		$ld = $a1->length - $a2->length;
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/EnumValueMap.hx:45: lines 45-46
		if ($ld !== 0) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/EnumValueMap.hx:46: characters 4-13
			return $ld;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/EnumValueMap.hx:47: characters 13-17
		$_g = 0;
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/EnumValueMap.hx:47: characters 17-26
		$_g1 = $a1->length;
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/EnumValueMap.hx:47: lines 47-51
		while ($_g < $_g1) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/EnumValueMap.hx:47: characters 13-26
			$i = $_g++;
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/EnumValueMap.hx:48: characters 4-37
			$d = $this->compareArg(($a1->arr[$i] ?? null), ($a2->arr[$i] ?? null));
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/EnumValueMap.hx:49: lines 49-50
			if ($d !== 0) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/ds/EnumValueMap.hx:50: characters 5-13
				return $d;
			}
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/EnumValueMap.hx:52: characters 3-11
		return 0;
	}

	/**
	 * @return EnumValueMap
	 */
	public function copy () {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/EnumValueMap.hx:66: characters 3-41
		$copied = new EnumValueMap();
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/EnumValueMap.hx:67: characters 3-21
		$copied->root = $this->root;
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/EnumValueMap.hx:68: characters 3-16
		return $copied;
	}
}

Boot::registerClass(EnumValueMap::class, 'haxe.ds.EnumValueMap');
