<?php
/**
 */

namespace helder\std\haxe\io\_BytesData;

use \helder\std\php\Boot;

class Container {
	/**
	 * @var mixed
	 */
	public $s;

	/**
	 * @param mixed $s
	 * 
	 * @return void
	 */
	public function __construct ($s) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/io/BytesData.hx:35: characters 3-13
		$this->s = $s;
	}
}

Boot::registerClass(Container::class, 'haxe.io._BytesData.Container');
