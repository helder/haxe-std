<?php
/**
 * Generated by Haxe 4.2.2
 */

namespace helder\std\haxe\ds\_List;

use \helder\std\php\Boot;

class ListIterator {
	/**
	 * @var ListNode
	 */
	public $head;

	/**
	 * @param ListNode $head
	 * 
	 * @return void
	 */
	public function __construct ($head) {
		#/home/runner/haxe/versions/4.2.2/std/haxe/ds/List.hx:281: characters 3-19
		$this->head = $head;
	}

	/**
	 * @return bool
	 */
	public function hasNext () {
		#/home/runner/haxe/versions/4.2.2/std/haxe/ds/List.hx:285: characters 3-22
		return $this->head !== null;
	}

	/**
	 * @return mixed
	 */
	public function next () {
		#/home/runner/haxe/versions/4.2.2/std/haxe/ds/List.hx:289: characters 3-23
		$val = $this->head->item;
		#/home/runner/haxe/versions/4.2.2/std/haxe/ds/List.hx:290: characters 3-19
		$this->head = $this->head->next;
		#/home/runner/haxe/versions/4.2.2/std/haxe/ds/List.hx:291: characters 3-13
		return $val;
	}
}

Boot::registerClass(ListIterator::class, 'haxe.ds._List.ListIterator');
