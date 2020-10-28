<?php
/**
 * Generated by Haxe 4.1.4
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
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/haxe/ds/List.hx:300: characters 3-19
		$this->head = $head;
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/haxe/ds/List.hx:301: characters 3-15
		$this->idx = 0;
	}

	/**
	 * @return bool
	 */
	public function hasNext () {
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/haxe/ds/List.hx:305: characters 3-22
		return $this->head !== null;
	}

	/**
	 * @return object
	 */
	public function next () {
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/haxe/ds/List.hx:309: characters 3-23
		$val = $this->head->item;
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/haxe/ds/List.hx:310: characters 3-19
		$this->head = $this->head->next;
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/haxe/ds/List.hx:311: characters 3-34
		return new HxAnon([
			"value" => $val,
			"key" => $this->idx++,
		]);
	}
}

Boot::registerClass(ListKeyValueIterator::class, 'haxe.ds._List.ListKeyValueIterator');
