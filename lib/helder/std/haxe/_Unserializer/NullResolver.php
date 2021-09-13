<?php
/**
 */

namespace helder\std\haxe\_Unserializer;

use \helder\std\php\Boot;

class NullResolver {
	/**
	 * @var NullResolver
	 */
	static public $instance;

	/**
	 * @return NullResolver
	 */
	public static function get_instance () {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Unserializer.hx:533: lines 533-534
		if (NullResolver::$instance === null) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Unserializer.hx:534: characters 4-33
			NullResolver::$instance = new NullResolver();
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Unserializer.hx:535: characters 3-18
		return NullResolver::$instance;
	}

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
		#/home/runner/haxe/versions/4.2.3/std/haxe/Unserializer.hx:525: characters 3-14
		return null;
	}

	/**
	 * @param string $name
	 * 
	 * @return Enum
	 */
	public function resolveEnum ($name) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Unserializer.hx:528: characters 3-14
		return null;
	}
}

Boot::registerClass(NullResolver::class, 'haxe._Unserializer.NullResolver');
Boot::registerGetters('helder\\std\\haxe\\_Unserializer\\NullResolver', [
	'instance' => true
]);
