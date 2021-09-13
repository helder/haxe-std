<?php
/**
 */

namespace helder\std\haxe\_Unserializer;

use \helder\std\php\Boot;
use \helder\std\Type;

class DefaultResolver {
	/**
	 * @return void
	 */
	public function __construct () {
	}

	/**
	 * @param string $name
	 * 
	 * @return Class
	 */
	public function resolveClass ($name) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Unserializer.hx:515: characters 3-33
		return Type::resolveClass($name);
	}

	/**
	 * @param string $name
	 * 
	 * @return Enum
	 */
	public function resolveEnum ($name) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Unserializer.hx:518: characters 3-32
		return Type::resolveEnum($name);
	}
}

Boot::registerClass(DefaultResolver::class, 'haxe._Unserializer.DefaultResolver');
