<?php
/**
 */

namespace helder\std\php\_Boot;

use \helder\std\php\Boot;
use \helder\std\haxe\Exception;

/**
 * Closures implementation
 */
class HxClosure {
	/**
	 * @var mixed
	 * A callable value, which can be invoked by PHP
	 */
	public $callable;
	/**
	 * @var string
	 * Method name for methods
	 */
	public $func;
	/**
	 * @var mixed
	 * `this` for instance methods; php class name for static methods
	 */
	public $target;

	/**
	 * @param mixed $target
	 * @param string $func
	 * 
	 * @return void
	 */
	public function __construct ($target, $func) {
		#/home/runner/haxe/versions/4.2.3/std/php/Boot.hx:978: characters 3-23
		$this->target = $target;
		#/home/runner/haxe/versions/4.2.3/std/php/Boot.hx:979: characters 3-19
		$this->func = $func;
		#/home/runner/haxe/versions/4.2.3/std/php/Boot.hx:981: lines 981-983
		if (\is_null($target)) {
			#/home/runner/haxe/versions/4.2.3/std/php/Boot.hx:982: characters 4-9
			throw Exception::thrown("Unable to create closure on `null`");
		}
		#/home/runner/haxe/versions/4.2.3/std/php/Boot.hx:984: characters 3-104
		$this->callable = (($target instanceof HxAnon) ? $target->{$func} : [$target, $func]);
	}

	/**
	 * @see http://php.net/manual/en/language.oop5.magic.php#object.invoke
	 * 
	 * @return mixed
	 */
	public function __invoke () {
		#/home/runner/haxe/versions/4.2.3/std/php/Boot.hx:992: characters 3-71
		return \call_user_func_array($this->callable, \func_get_args());
	}

	/**
	 * Invoke this closure with `newThis` instead of `this`
	 * 
	 * @param mixed $newThis
	 * @param array $args
	 * 
	 * @return mixed
	 */
	public function callWith ($newThis, $args) {
		#/home/runner/haxe/versions/4.2.3/std/php/Boot.hx:1019: characters 3-65
		return \call_user_func_array($this->getCallback($newThis), $args);
	}

	/**
	 * Check if this is the same closure
	 * 
	 * @param HxClosure $closure
	 * 
	 * @return bool
	 */
	public function equals ($closure) {
		#/home/runner/haxe/versions/4.2.3/std/php/Boot.hx:1012: characters 10-60
		if (Boot::equal($this->target, $closure->target)) {
			#/home/runner/haxe/versions/4.2.3/std/php/Boot.hx:1012: characters 39-59
			return $this->func === $closure->func;
		} else {
			#/home/runner/haxe/versions/4.2.3/std/php/Boot.hx:1012: characters 10-60
			return false;
		}
	}

	/**
	 * Generates callable value for PHP
	 * 
	 * @param mixed $eThis
	 * 
	 * @return mixed[]
	 */
	public function getCallback ($eThis = null) {
		#/home/runner/haxe/versions/4.2.3/std/php/Boot.hx:999: lines 999-1001
		if ($eThis === null) {
			#/home/runner/haxe/versions/4.2.3/std/php/Boot.hx:1000: characters 4-18
			$eThis = $this->target;
		}
		#/home/runner/haxe/versions/4.2.3/std/php/Boot.hx:1002: lines 1002-1004
		if (($eThis instanceof HxAnon)) {
			#/home/runner/haxe/versions/4.2.3/std/php/Boot.hx:1003: characters 4-36
			return $eThis->{$this->func};
		}
		#/home/runner/haxe/versions/4.2.3/std/php/Boot.hx:1005: characters 3-39
		return [$eThis, $this->func];
	}
}

Boot::registerClass(HxClosure::class, 'php._Boot.HxClosure');
