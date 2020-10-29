<?php
/**
 * Generated by Haxe 4.1.4
 */

namespace helder\std;

use \helder\std\php\Boot;
use \helder\std\php\_Boot\HxEnum;

class ValueType extends HxEnum {
	/**
	 * @return ValueType
	 */
	static public function TBool () {
		static $inst = null;
		if (!$inst) $inst = new ValueType('TBool', 3, []);
		return $inst;
	}

	/**
	 * @param Class $c
	 * 
	 * @return ValueType
	 */
	static public function TClass ($c) {
		return new ValueType('TClass', 6, [$c]);
	}

	/**
	 * @param Enum $e
	 * 
	 * @return ValueType
	 */
	static public function TEnum ($e) {
		return new ValueType('TEnum', 7, [$e]);
	}

	/**
	 * @return ValueType
	 */
	static public function TFloat () {
		static $inst = null;
		if (!$inst) $inst = new ValueType('TFloat', 2, []);
		return $inst;
	}

	/**
	 * @return ValueType
	 */
	static public function TFunction () {
		static $inst = null;
		if (!$inst) $inst = new ValueType('TFunction', 5, []);
		return $inst;
	}

	/**
	 * @return ValueType
	 */
	static public function TInt () {
		static $inst = null;
		if (!$inst) $inst = new ValueType('TInt', 1, []);
		return $inst;
	}

	/**
	 * @return ValueType
	 */
	static public function TNull () {
		static $inst = null;
		if (!$inst) $inst = new ValueType('TNull', 0, []);
		return $inst;
	}

	/**
	 * @return ValueType
	 */
	static public function TObject () {
		static $inst = null;
		if (!$inst) $inst = new ValueType('TObject', 4, []);
		return $inst;
	}

	/**
	 * @return ValueType
	 */
	static public function TUnknown () {
		static $inst = null;
		if (!$inst) $inst = new ValueType('TUnknown', 8, []);
		return $inst;
	}

	/**
	 * Returns array of (constructorIndex => constructorName)
	 *
	 * @return string[]
	 */
	static public function __hx__list () {
		return [
			3 => 'TBool',
			6 => 'TClass',
			7 => 'TEnum',
			2 => 'TFloat',
			5 => 'TFunction',
			1 => 'TInt',
			0 => 'TNull',
			4 => 'TObject',
			8 => 'TUnknown',
		];
	}

	/**
	 * Returns array of (constructorName => parametersCount)
	 *
	 * @return int[]
	 */
	static public function __hx__paramsCount () {
		return [
			'TBool' => 0,
			'TClass' => 1,
			'TEnum' => 1,
			'TFloat' => 0,
			'TFunction' => 0,
			'TInt' => 0,
			'TNull' => 0,
			'TObject' => 0,
			'TUnknown' => 0,
		];
	}
}

Boot::registerClass(ValueType::class, 'ValueType');
