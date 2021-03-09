<?php
/**
 * Generated by Haxe 4.1.5
 */

namespace helder\std\haxe\rtti;

use \helder\std\php\Boot;
use \helder\std\Array_hx;
use \helder\std\php\_Boot\HxEnum;

/**
 * The tree types of the runtime type.
 */
class TypeTree extends HxEnum {
	/**
	 * @param object $a
	 * 
	 * @return TypeTree
	 */
	static public function TAbstractdecl ($a) {
		return new TypeTree('TAbstractdecl', 4, [$a]);
	}

	/**
	 * @param object $c
	 * 
	 * @return TypeTree
	 */
	static public function TClassdecl ($c) {
		return new TypeTree('TClassdecl', 1, [$c]);
	}

	/**
	 * @param object $e
	 * 
	 * @return TypeTree
	 */
	static public function TEnumdecl ($e) {
		return new TypeTree('TEnumdecl', 2, [$e]);
	}

	/**
	 * @param string $name
	 * @param string $full
	 * @param Array_hx $subs
	 * 
	 * @return TypeTree
	 */
	static public function TPackage ($name, $full, $subs) {
		return new TypeTree('TPackage', 0, [$name, $full, $subs]);
	}

	/**
	 * @param object $t
	 * 
	 * @return TypeTree
	 */
	static public function TTypedecl ($t) {
		return new TypeTree('TTypedecl', 3, [$t]);
	}

	/**
	 * Returns array of (constructorIndex => constructorName)
	 *
	 * @return string[]
	 */
	static public function __hx__list () {
		return [
			4 => 'TAbstractdecl',
			1 => 'TClassdecl',
			2 => 'TEnumdecl',
			0 => 'TPackage',
			3 => 'TTypedecl',
		];
	}

	/**
	 * Returns array of (constructorName => parametersCount)
	 *
	 * @return int[]
	 */
	static public function __hx__paramsCount () {
		return [
			'TAbstractdecl' => 1,
			'TClassdecl' => 1,
			'TEnumdecl' => 1,
			'TPackage' => 3,
			'TTypedecl' => 1,
		];
	}
}

Boot::registerClass(TypeTree::class, 'haxe.rtti.TypeTree');
