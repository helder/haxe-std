<?php
/**
 */

namespace helder\std\haxe\ds\_List;

use \helder\std\php\Boot;

class ListNode {
	/**
	 * @var mixed
	 */
	public $item;
	/**
	 * @var ListNode
	 */
	public $next;

	/**
	 * @param mixed $item
	 * @param ListNode $next
	 * 
	 * @return void
	 */
	public function __construct ($item, $next) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:267: characters 3-19
		$this->item = $item;
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:268: characters 3-19
		$this->next = $next;
	}
}

Boot::registerClass(ListNode::class, 'haxe.ds._List.ListNode');
