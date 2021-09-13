<?php
/**
 */

namespace helder\std\haxe\xml;

use \helder\std\php\Boot;
use \helder\std\php\_Boot\HxEnum;

class Attrib extends HxEnum {
	/**
	 * @param string $name
	 * @param Filter $filter
	 * @param string $defvalue
	 * 
	 * @return Attrib
	 */
	static public function Att ($name, $filter = null, $defvalue = null) {
		return new Attrib('Att', 0, [$name, $filter, $defvalue]);
	}

	/**
	 * Returns array of (constructorIndex => constructorName)
	 *
	 * @return string[]
	 */
	static public function __hx__list () {
		return [
			0 => 'Att',
		];
	}

	/**
	 * Returns array of (constructorName => parametersCount)
	 *
	 * @return int[]
	 */
	static public function __hx__paramsCount () {
		return [
			'Att' => 3,
		];
	}
}

Boot::registerClass(Attrib::class, 'haxe.xml.Attrib');
