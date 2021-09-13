<?php
/**
 */

namespace helder\std\haxe\zip\_InflateImpl;

use \helder\std\php\Boot;
use \helder\std\php\_Boot\HxEnum;

class State extends HxEnum {
	/**
	 * @return State
	 */
	static public function Block () {
		static $inst = null;
		if (!$inst) $inst = new State('Block', 1, []);
		return $inst;
	}

	/**
	 * @return State
	 */
	static public function CData () {
		static $inst = null;
		if (!$inst) $inst = new State('CData', 2, []);
		return $inst;
	}

	/**
	 * @return State
	 */
	static public function Crc () {
		static $inst = null;
		if (!$inst) $inst = new State('Crc', 4, []);
		return $inst;
	}

	/**
	 * @return State
	 */
	static public function Dist () {
		static $inst = null;
		if (!$inst) $inst = new State('Dist', 5, []);
		return $inst;
	}

	/**
	 * @return State
	 */
	static public function DistOne () {
		static $inst = null;
		if (!$inst) $inst = new State('DistOne', 6, []);
		return $inst;
	}

	/**
	 * @return State
	 */
	static public function Done () {
		static $inst = null;
		if (!$inst) $inst = new State('Done', 7, []);
		return $inst;
	}

	/**
	 * @return State
	 */
	static public function Flat () {
		static $inst = null;
		if (!$inst) $inst = new State('Flat', 3, []);
		return $inst;
	}

	/**
	 * @return State
	 */
	static public function Head () {
		static $inst = null;
		if (!$inst) $inst = new State('Head', 0, []);
		return $inst;
	}

	/**
	 * Returns array of (constructorIndex => constructorName)
	 *
	 * @return string[]
	 */
	static public function __hx__list () {
		return [
			1 => 'Block',
			2 => 'CData',
			4 => 'Crc',
			5 => 'Dist',
			6 => 'DistOne',
			7 => 'Done',
			3 => 'Flat',
			0 => 'Head',
		];
	}

	/**
	 * Returns array of (constructorName => parametersCount)
	 *
	 * @return int[]
	 */
	static public function __hx__paramsCount () {
		return [
			'Block' => 0,
			'CData' => 0,
			'Crc' => 0,
			'Dist' => 0,
			'DistOne' => 0,
			'Done' => 0,
			'Flat' => 0,
			'Head' => 0,
		];
	}
}

Boot::registerClass(State::class, 'haxe.zip._InflateImpl.State');
