<?php
/**
 */

namespace helder\std\haxe\_EntryPoint;

use \helder\std\php\Boot;

class Mutex {
	/**
	 * @return void
	 */
	public function __construct () {
	}

	/**
	 * @return void
	 */
	public function acquire () {
	}

	/**
	 * @return void
	 */
	public function release () {
	}
}

Boot::registerClass(Mutex::class, 'haxe._EntryPoint.Mutex');
