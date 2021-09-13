<?php
/**
 */

namespace helder\std\haxe\ds;

use \helder\std\php\_Boot\HxAnon;
use \helder\std\php\Boot;
use \helder\std\Array_hx;

/**
 * A stack of elements.
 * This class is generic, which means one type is generated for each type
 * parameter T on static targets. For example:
 * - `new GenericStack<Int>()` generates `GenericStack_Int`
 * - `new GenericStack<String>()` generates `GenericStack_String`
 * The generated name is an implementation detail and should not be relied
 * upon.
 * @see https://haxe.org/manual/std-GenericStack.html
 */
class GenericStack {
	/**
	 * @var GenericCell
	 */
	public $head;

	/**
	 * Creates a new empty GenericStack.
	 * 
	 * @return void
	 */
	public function __construct () {
	}

	/**
	 * Pushes element `item` onto the stack.
	 * 
	 * @param mixed $item
	 * 
	 * @return void
	 */
	public function add ($item) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/GenericStack.hx:113: characters 3-40
		$this->head = new GenericCell($item, $this->head);
	}

	/**
	 * Returns the topmost stack element without removing it.
	 * If the stack is empty, null is returned.
	 * 
	 * @return mixed
	 */
	public function first () {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/GenericStack.hx:122: characters 10-46
		if ($this->head === null) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/GenericStack.hx:122: characters 28-32
			return null;
		} else {
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/GenericStack.hx:122: characters 38-46
			return $this->head->elt;
		}
	}

	/**
	 * Tells if the stack is empty.
	 * 
	 * @return bool
	 */
	public function isEmpty () {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/GenericStack.hx:144: characters 3-24
		return $this->head === null;
	}

	/**
	 * Returns an iterator over the elements of `this` GenericStack.
	 * 
	 * @return object
	 */
	public function iterator () {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/GenericStack.hx:186: characters 3-16
		$l = $this->head;
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/GenericStack.hx:187: lines 187-196
		return new _HxAnon_GenericStack0(function () use (&$l) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/GenericStack.hx:189: characters 5-21
			return $l !== null;
		}, function () use (&$l) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/GenericStack.hx:192: characters 5-15
			$k = $l;
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/GenericStack.hx:193: characters 5-15
			$l = $k->next;
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/GenericStack.hx:194: characters 5-17
			return $k->elt;
		});
	}

	/**
	 * Returns the topmost stack element and removes it.
	 * If the stack is empty, null is returned.
	 * 
	 * @return mixed
	 */
	public function pop () {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/GenericStack.hx:131: characters 3-16
		$k = $this->head;
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/GenericStack.hx:132: lines 132-137
		if ($k === null) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/GenericStack.hx:133: characters 4-15
			return null;
		} else {
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/GenericStack.hx:135: characters 4-17
			$this->head = $k->next;
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/GenericStack.hx:136: characters 4-16
			return $k->elt;
		}
	}

	/**
	 * Removes the first element which is equal to `v` according to the `==`
	 * operator.
	 * This method traverses the stack until it finds a matching element and
	 * unlinks it, returning true.
	 * If no matching element is found, false is returned.
	 * 
	 * @param mixed $v
	 * 
	 * @return bool
	 */
	public function remove ($v) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/GenericStack.hx:157: characters 3-34
		$prev = null;
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/GenericStack.hx:158: characters 3-16
		$l = $this->head;
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/GenericStack.hx:159: lines 159-169
		while ($l !== null) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/GenericStack.hx:160: lines 160-166
			if (Boot::equal($l->elt, $v)) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/ds/GenericStack.hx:161: lines 161-164
				if ($prev === null) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/ds/GenericStack.hx:162: characters 6-19
					$this->head = $l->next;
				} else {
					#/home/runner/haxe/versions/4.2.3/std/haxe/ds/GenericStack.hx:164: characters 6-24
					$prev->next = $l->next;
				}
				#/home/runner/haxe/versions/4.2.3/std/haxe/ds/GenericStack.hx:165: characters 5-10
				break;
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/GenericStack.hx:167: characters 4-12
			$prev = $l;
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/GenericStack.hx:168: characters 4-14
			$l = $l->next;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/GenericStack.hx:170: characters 3-21
		return $l !== null;
	}

	/**
	 * Returns a String representation of `this` GenericStack.
	 * 
	 * @return string
	 */
	public function toString () {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/GenericStack.hx:204: characters 3-23
		$a = new Array_hx();
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/GenericStack.hx:205: characters 3-16
		$l = $this->head;
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/GenericStack.hx:206: lines 206-209
		while ($l !== null) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/GenericStack.hx:207: characters 4-17
			$a->arr[$a->length++] = $l->elt;
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/GenericStack.hx:208: characters 4-14
			$l = $l->next;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/GenericStack.hx:210: characters 3-33
		return "{" . ($a->join(",")??'null') . "}";
	}

	public function __toString() {
		return $this->toString();
	}
}

class _HxAnon_GenericStack0 extends HxAnon {
	function __construct($hasNext, $next) {
		$this->hasNext = $hasNext;
		$this->next = $next;
	}
}

Boot::registerClass(GenericStack::class, 'haxe.ds.GenericStack');
