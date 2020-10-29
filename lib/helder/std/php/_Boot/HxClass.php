<?php
/**
 * Generated by Haxe 4.0.0+ef18b627e
 */

namespace helder\std\php\_Boot;

use \helder\std\php\Boot;

/**
 * Class<T> implementation for Haxe->PHP internals.
 */
class HxClass {
	/**
	 * @var string
	 */
	public $phpClassName;

	/**
	 * @param string $phpClassName
	 * 
	 * @return void
	 */
	public function __construct ($phpClassName) {
		#/home/runner/haxe/versions/4.0.0/std/php/Boot.hx:644: characters 3-35
		$this->phpClassName = $phpClassName;
	}

	/**
	 * Magic method to call static methods of this class, when `HxClass` instance is in a `Dynamic` variable.
	 * 
	 * @param string $method
	 * @param mixed $args
	 * 
	 * @return mixed
	 */
	public function __call ($method, $args) {
		#/home/runner/haxe/versions/4.0.0/std/php/Boot.hx:652: characters 3-111
		$callback = ((($this->phpClassName === "String" ? HxString::class : $this->phpClassName))??'null') . "::" . ($method??'null');
		#/home/runner/haxe/versions/4.0.0/std/php/Boot.hx:653: characters 3-53
		return call_user_func_array($callback, $args);
	}

	/**
	 * Magic method to get static vars of this class, when `HxClass` instance is in a `Dynamic` variable.
	 * 
	 * @param string $property
	 * 
	 * @return mixed
	 */
	public function __get ($property) {
		#/home/runner/haxe/versions/4.0.0/std/php/Boot.hx:661: lines 661-669
		if (defined("" . ($this->phpClassName??'null') . "::" . ($property??'null'))) {
			#/home/runner/haxe/versions/4.0.0/std/php/Boot.hx:662: characters 4-54
			return constant("" . ($this->phpClassName??'null') . "::" . ($property??'null'));
		} else if (Boot::hasGetter($this->phpClassName, $property)) {
			#/home/runner/haxe/versions/4.0.0/std/php/Boot.hx:664: characters 29-41
			$tmp = $this->phpClassName;
			#/home/runner/haxe/versions/4.0.0/std/php/Boot.hx:664: characters 4-59
			return $tmp::{"get_" . ($property??'null')}();
		} else if (method_exists($this->phpClassName, $property)) {
			#/home/runner/haxe/versions/4.0.0/std/php/Boot.hx:666: characters 4-48
			return new HxClosure($this->phpClassName, $property);
		} else {
			#/home/runner/haxe/versions/4.0.0/std/php/Boot.hx:668: characters 33-45
			$tmp1 = $this->phpClassName;
			#/home/runner/haxe/versions/4.0.0/std/php/Boot.hx:668: characters 4-56
			return $tmp1::${$property};
		}
	}

	/**
	 * Magic method to set static vars of this class, when `HxClass` instance is in a `Dynamic` variable.
	 * 
	 * @param string $property
	 * @param mixed $value
	 * 
	 * @return void
	 */
	public function __set ($property, $value) {
		#/home/runner/haxe/versions/4.0.0/std/php/Boot.hx:677: lines 677-681
		if (Boot::hasSetter($this->phpClassName, $property)) {
			#/home/runner/haxe/versions/4.0.0/std/php/Boot.hx:678: characters 22-34
			$tmp = $this->phpClassName;
			#/home/runner/haxe/versions/4.0.0/std/php/Boot.hx:678: characters 4-59
			$tmp::{"set_" . ($property??'null')}($value);
		} else {
			#/home/runner/haxe/versions/4.0.0/std/php/Boot.hx:680: characters 26-38
			$tmp1 = $this->phpClassName;
			#/home/runner/haxe/versions/4.0.0/std/php/Boot.hx:680: characters 4-56
			$tmp1::${$property} = $value;
		}
	}
}

Boot::registerClass(HxClass::class, 'php._Boot.HxClass');
