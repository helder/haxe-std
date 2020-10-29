<?php
/**
 * Generated by Haxe 4.0.5
 */

namespace helder\std\php\_Boot;

use \helder\std\php\Boot;

/**
 * Base class for enum types
 */
class HxEnum {
	/**
	 * @var int
	 */
	public $index;
	/**
	 * @var mixed
	 */
	public $params;
	/**
	 * @var string
	 */
	public $tag;

	/**
	 * @param string $tag
	 * @param int $index
	 * @param mixed $arguments
	 * 
	 * @return void
	 */
	public function __construct ($tag, $index, $arguments = null) {
		#/home/runner/haxe/versions/4.0.5/std/php/Boot.hx:705: characters 3-17
		$this->tag = $tag;
		#/home/runner/haxe/versions/4.0.5/std/php/Boot.hx:706: characters 3-21
		$this->index = $index;
		#/home/runner/haxe/versions/4.0.5/std/php/Boot.hx:707: characters 12-63
		$tmp = null;
		if ($arguments === null) {
			#/home/runner/haxe/versions/4.0.5/std/php/Boot.hx:707: characters 33-50
			$this1 = [];
			#/home/runner/haxe/versions/4.0.5/std/php/Boot.hx:707: characters 12-63
			$tmp = $this1;
		} else {
			$tmp = $arguments;
		}
		#/home/runner/haxe/versions/4.0.5/std/php/Boot.hx:707: characters 3-63
		$this->params = $tmp;
	}

	/**
	 * PHP magic method to get string representation of this `Class`
	 * 
	 * @return string
	 */
	public function __toString () {
		#/home/runner/haxe/versions/4.0.5/std/php/Boot.hx:722: characters 3-30
		return Boot::stringify($this);
	}

	/**
	 * Get string representation of this `Class`
	 * 
	 * @return string
	 */
	public function toString () {
		#/home/runner/haxe/versions/4.0.5/std/php/Boot.hx:714: characters 3-22
		return $this->__toString();
	}
}

Boot::registerClass(HxEnum::class, 'php._Boot.HxEnum');
