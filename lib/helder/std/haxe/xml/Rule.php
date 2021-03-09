<?php
/**
 * Generated by Haxe 4.1.5
 */

namespace helder\std\haxe\xml;

use \helder\std\php\Boot;
use \helder\std\Array_hx;
use \helder\std\php\_Boot\HxEnum;

class Rule extends HxEnum {
	/**
	 * @param Array_hx $choices
	 * 
	 * @return Rule
	 */
	static public function RChoice ($choices) {
		return new Rule('RChoice', 4, [$choices]);
	}

	/**
	 * @param Filter $filter
	 * 
	 * @return Rule
	 */
	static public function RData ($filter = null) {
		return new Rule('RData', 1, [$filter]);
	}

	/**
	 * @param Array_hx $rules
	 * @param bool $ordered
	 * 
	 * @return Rule
	 */
	static public function RList ($rules, $ordered = null) {
		return new Rule('RList', 3, [$rules, $ordered]);
	}

	/**
	 * @param Rule $rule
	 * @param bool $atLeastOne
	 * 
	 * @return Rule
	 */
	static public function RMulti ($rule, $atLeastOne = null) {
		return new Rule('RMulti', 2, [$rule, $atLeastOne]);
	}

	/**
	 * @param string $name
	 * @param Array_hx $attribs
	 * @param Rule $childs
	 * 
	 * @return Rule
	 */
	static public function RNode ($name, $attribs = null, $childs = null) {
		return new Rule('RNode', 0, [$name, $attribs, $childs]);
	}

	/**
	 * @param Rule $rule
	 * 
	 * @return Rule
	 */
	static public function ROptional ($rule) {
		return new Rule('ROptional', 5, [$rule]);
	}

	/**
	 * Returns array of (constructorIndex => constructorName)
	 *
	 * @return string[]
	 */
	static public function __hx__list () {
		return [
			4 => 'RChoice',
			1 => 'RData',
			3 => 'RList',
			2 => 'RMulti',
			0 => 'RNode',
			5 => 'ROptional',
		];
	}

	/**
	 * Returns array of (constructorName => parametersCount)
	 *
	 * @return int[]
	 */
	static public function __hx__paramsCount () {
		return [
			'RChoice' => 1,
			'RData' => 1,
			'RList' => 2,
			'RMulti' => 2,
			'RNode' => 3,
			'ROptional' => 1,
		];
	}
}

Boot::registerClass(Rule::class, 'haxe.xml.Rule');
