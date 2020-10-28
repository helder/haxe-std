<?php
/**
 * Generated by Haxe 4.0.0+ef18b627e
 */

namespace helder\std\php\_Boot;

use \helder\std\php\Boot;

/**
 * Anonymous objects implementation
 */
class HxAnon extends \StdClass {
	/**
	 * @param mixed $fields
	 * 
	 * @return void
	 */
	public function __construct ($fields = null) {
		#/home/runner/haxe/versions/4.0.0/std/php/Boot.hx:925: lines 925-930
		$_gthis = $this;
		#/home/runner/haxe/versions/4.0.0/std/php/Boot.hx:926: characters 3-10
		;
		#/home/runner/haxe/versions/4.0.0/std/php/Boot.hx:927: lines 927-929
		if ($fields !== null) {
			#/home/runner/haxe/versions/4.0.0/std/php/Boot.hx:928: characters 4-84
			foreach ($fields as $key => $value) {
				#/home/runner/haxe/versions/4.0.0/std/php/Boot.hx:928: characters 65-69
				$tmp = $_gthis;
				#/home/runner/haxe/versions/4.0.0/std/php/Boot.hx:928: characters 49-83
				$tmp->{$key} = $value;
			}
		}
	}

	/**
	 * @param string $name
	 * @param mixed $args
	 * 
	 * @return mixed
	 */
	public function __call ($name, $args) {
		#/home/runner/haxe/versions/4.0.0/std/php/Boot.hx:939: characters 3-57
		return ($this->$name)(...$args);
	}

	/**
	 * @param string $name
	 * 
	 * @return mixed
	 */
	public function __get ($name) {
		#/home/runner/haxe/versions/4.0.0/std/php/Boot.hx:934: characters 3-14
		return null;
	}
}

Boot::registerClass(HxAnon::class, 'php._Boot.HxAnon');
