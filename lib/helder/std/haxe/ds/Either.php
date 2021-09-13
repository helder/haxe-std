<?php
/**
 */

namespace helder\std\haxe\ds;

use \helder\std\php\Boot;
use \helder\std\php\_Boot\HxEnum;

/**
 * Either represents values which are either of type `L` (Left) or type `R`
 * (Right).
 */
class Either extends HxEnum {
	/**
	 * @param mixed $v
	 * 
	 * @return Either
	 */
	static public function Left ($v) {
		return new Either('Left', 0, [$v]);
	}

	/**
	 * @param mixed $v
	 * 
	 * @return Either
	 */
	static public function Right ($v) {
		return new Either('Right', 1, [$v]);
	}

	/**
	 * Returns array of (constructorIndex => constructorName)
	 *
	 * @return string[]
	 */
	static public function __hx__list () {
		return [
			0 => 'Left',
			1 => 'Right',
		];
	}

	/**
	 * Returns array of (constructorName => parametersCount)
	 *
	 * @return int[]
	 */
	static public function __hx__paramsCount () {
		return [
			'Left' => 1,
			'Right' => 1,
		];
	}
}

Boot::registerClass(Either::class, 'haxe.ds.Either');
