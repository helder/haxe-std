<?php
/**
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
		#/home/runner/haxe/versions/4.2.3/std/haxe/EntryPoint.hx:26: characters 3-6
		$f();
	}
}

Boot::registerClass(Thread::class, 'haxe._EntryPoint.Thread');
