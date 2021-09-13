<?php
/**
 */

namespace helder\std\haxe\ds;

use \helder\std\php\Boot;

/**
 * A cell of `haxe.ds.GenericStack`.
 * @see https://haxe.org/manual/std-GenericStack.html
 */
class GenericCell {
	/**
	 * @var mixed
	 */
	public $elt;
	/**
	 * @var GenericCell
	 */
	public $next;

	/**
	 * @param mixed $elt
	 * @param GenericCell $next
	 * 
	 * @return void
	 */
	public function __construct ($elt, $next) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/GenericStack.hx:38: characters 3-17
		$this->elt = $elt;
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/GenericStack.hx:39: characters 3-19
		$this->next = $next;
	}
}

Boot::registerClass(GenericCell::class, 'haxe.ds.GenericCell');
