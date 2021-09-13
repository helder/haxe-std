<?php
/**
 */

namespace helder\std\haxe\xml;

use \helder\std\php\Boot;
use \helder\std\Array_hx;
use \helder\std\php\_Boot\HxEnum;
use \helder\std\EReg;

class Filter extends HxEnum {
	/**
	 * @return Filter
	 */
	static public function FBool () {
		static $inst = null;
		if (!$inst) $inst = new Filter('FBool', 1, []);
		return $inst;
	}

	/**
	 * @param string[]|Array_hx $values
	 * 
	 * @return Filter
	 */
	static public function FEnum ($values) {
		return new Filter('FEnum', 2, [$values]);
	}

	/**
	 * @return Filter
	 */
	static public function FInt () {
		static $inst = null;
		if (!$inst) $inst = new Filter('FInt', 0, []);
		return $inst;
	}

	/**
	 * @param EReg $matcher
	 * 
	 * @return Filter
	 */
	static public function FReg ($matcher) {
		return new Filter('FReg', 3, [$matcher]);
	}

	/**
	 * Returns array of (constructorIndex => constructorName)
	 *
	 * @return string[]
	 */
	static public function __hx__list () {
		return [
			1 => 'FBool',
			2 => 'FEnum',
			0 => 'FInt',
			3 => 'FReg',
		];
	}

	/**
	 * Returns array of (constructorName => parametersCount)
	 *
	 * @return int[]
	 */
	static public function __hx__paramsCount () {
		return [
			'FBool' => 0,
			'FEnum' => 1,
			'FInt' => 0,
			'FReg' => 1,
		];
	}
}

Boot::registerClass(Filter::class, 'haxe.xml.Filter');
