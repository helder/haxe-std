<?php
/**
 */

namespace helder\std\haxe\zip;

use \helder\std\php\Boot;
use \helder\std\Array_hx;
use \helder\std\php\_Boot\HxEnum;

class Huffman extends HxEnum {
	/**
	 * @param int $i
	 * 
	 * @return Huffman
	 */
	static public function Found ($i) {
		return new Huffman('Found', 0, [$i]);
	}

	/**
	 * @param Huffman $left
	 * @param Huffman $right
	 * 
	 * @return Huffman
	 */
	static public function NeedBit ($left, $right) {
		return new Huffman('NeedBit', 1, [$left, $right]);
	}

	/**
	 * @param int $n
	 * @param Huffman[]|Array_hx $table
	 * 
	 * @return Huffman
	 */
	static public function NeedBits ($n, $table) {
		return new Huffman('NeedBits', 2, [$n, $table]);
	}

	/**
	 * Returns array of (constructorIndex => constructorName)
	 *
	 * @return string[]
	 */
	static public function __hx__list () {
		return [
			0 => 'Found',
			1 => 'NeedBit',
			2 => 'NeedBits',
		];
	}

	/**
	 * Returns array of (constructorName => parametersCount)
	 *
	 * @return int[]
	 */
	static public function __hx__paramsCount () {
		return [
			'Found' => 1,
			'NeedBit' => 2,
			'NeedBits' => 2,
		];
	}
}

Boot::registerClass(Huffman::class, 'haxe.zip.Huffman');
