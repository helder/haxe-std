<?php
/**
 */

namespace helder\std\haxe\ds\_List;

use \helder\std\php\_Boot\HxAnon;
use \helder\std\php\Boot;

class ListKeyValueIterator {
	/**
	 * @var ListNode
	 */
	public $head;
	/**
	 * @var int
	 */
	public $idx;

	/**
	 * @param ListNode $head
	 * 
	 * @return void
	 */
	public function __construct ($head) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:300: characters 3-19
		$this->head = $head;
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:301: characters 3-15
		$this->idx = 0;
	}

	/**
	 * @return bool
	 */
	public function hasNext () {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:305: characters 3-22
		return $this->head !== null;
	}

	/**
	 * @return object
	 */
	public function next () {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:309: characters 3-23
		$val = $this->head->item;
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:310: characters 3-19
		$this->head = $this->head->next;
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:311: characters 3-34
		return new _HxAnon_ListKeyValueIterator0($val, $this->idx++);
	}
}

class _HxAnon_ListKeyValueIterator0 extends HxAnon {
	function __construct($value, $key) {
		$this->value = $value;
		$this->key = $key;
	}
}

Boot::registerClass(ListKeyValueIterator::class, 'haxe.ds._List.ListKeyValueIterator');
