<?php
/**
 * Generated by Haxe 4.1.1
 */

namespace helder\std\haxe\_EntryPoint;

use \helder\std\php\Boot;

class Thread {
	/**
	 * @param \Closure $f
	 * 
	 * @return void
	 */
	public static function create ($f) {
		#/home/runner/haxe/versions/4.1.1/std/haxe/EntryPoint.hx:26: characters 3-6
		$f();
	}
}

Boot::registerClass(Thread::class, 'haxe._EntryPoint.Thread');
