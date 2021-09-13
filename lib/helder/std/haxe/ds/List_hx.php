<?php
/**
 */

namespace helder\std\haxe\ds;

use \helder\std\php\Boot;
use \helder\std\haxe\ds\_List\ListIterator;
use \helder\std\haxe\ds\_List\ListKeyValueIterator;
use \helder\std\haxe\ds\_List\ListNode;
use \helder\std\Std;
use \helder\std\StringBuf;

/**
 * A linked-list of elements. The list is composed of element container objects
 * that are chained together. It is optimized so that adding or removing an
 * element does not imply copying the whole list content every time.
 * @see https://haxe.org/manual/std-List.html
 */
class List_hx {
	/**
	 * @var ListNode
	 */
	public $h;
	/**
	 * @var int
	 * The length of `this` List.
	 */
	public $length;
	/**
	 * @var ListNode
	 */
	public $q;

	/**
	 * Creates a new empty list.
	 * 
	 * @return void
	 */
	public function __construct () {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:45: characters 3-13
		$this->length = 0;
	}

	/**
	 * Adds element `item` at the end of `this` List.
	 * `this.length` increases by 1.
	 * 
	 * @param mixed $item
	 * 
	 * @return void
	 */
	public function add ($item) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:54: characters 3-39
		$x = new ListNode($item, null);
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:55: lines 55-58
		if ($this->h === null) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:56: characters 4-9
			$this->h = $x;
		} else {
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:58: characters 4-14
			$this->q->next = $x;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:59: characters 3-8
		$this->q = $x;
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:60: characters 3-11
		$this->length++;
	}

	/**
	 * Empties `this` List.
	 * This function does not traverse the elements, but simply sets the
	 * internal references to null and `this.length` to 0.
	 * 
	 * @return void
	 */
	public function clear () {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:124: characters 3-11
		$this->h = null;
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:125: characters 3-11
		$this->q = null;
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:126: characters 3-13
		$this->length = 0;
	}

	/**
	 * Returns a list filtered with `f`. The returned list will contain all
	 * elements for which `f(x) == true`.
	 * 
	 * @param \Closure $f
	 * 
	 * @return List_hx
	 */
	public function filter ($f) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:218: characters 3-23
		$l2 = new List_hx();
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:219: characters 3-13
		$l = $this->h;
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:220: lines 220-225
		while ($l !== null) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:221: characters 4-19
			$v = $l->item;
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:222: characters 4-14
			$l = $l->next;
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:223: lines 223-224
			if ($f($v)) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:224: characters 5-14
				$l2->add($v);
			}
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:226: characters 3-12
		return $l2;
	}

	/**
	 * Returns the first element of `this` List, or null if no elements exist.
	 * This function does not modify `this` List.
	 * 
	 * @return mixed
	 */
	public function first () {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:82: characters 10-41
		if ($this->h === null) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:82: characters 25-29
			return null;
		} else {
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:82: characters 35-41
			return $this->h->item;
		}
	}

	/**
	 * Tells if `this` List is empty.
	 * 
	 * @return bool
	 */
	public function isEmpty () {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:114: characters 3-21
		return $this->h === null;
	}

	/**
	 * Returns an iterator on the elements of the list.
	 * 
	 * @return ListIterator
	 */
	public function iterator () {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:161: characters 3-32
		return new ListIterator($this->h);
	}

	/**
	 * Returns a string representation of `this` List, with `sep` separating
	 * each element.
	 * 
	 * @param string $sep
	 * 
	 * @return string
	 */
	public function join ($sep) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:199: characters 3-27
		$s = new StringBuf();
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:200: characters 3-20
		$first = true;
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:201: characters 3-13
		$l = $this->h;
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:202: lines 202-209
		while ($l !== null) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:203: lines 203-206
			if ($first) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:204: characters 5-18
				$first = false;
			} else {
				#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:206: characters 5-15
				$s->add($sep);
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:207: characters 4-17
			$s->add($l->item);
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:208: characters 4-14
			$l = $l->next;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:210: characters 3-22
		return $s->b;
	}

	/**
	 * Returns an iterator of the List indices and values.
	 * 
	 * @return ListKeyValueIterator
	 */
	public function keyValueIterator () {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:168: characters 3-37
		return new ListKeyValueIterator($this->h);
	}

	/**
	 * Returns the last element of `this` List, or null if no elements exist.
	 * This function does not modify `this` List.
	 * 
	 * @return mixed
	 */
	public function last () {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:91: characters 10-41
		if ($this->q === null) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:91: characters 25-29
			return null;
		} else {
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:91: characters 35-41
			return $this->q->item;
		}
	}

	/**
	 * Returns a new list where all elements have been converted by the
	 * function `f`.
	 * 
	 * @param \Closure $f
	 * 
	 * @return List_hx
	 */
	public function map ($f) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:234: characters 3-22
		$b = new List_hx();
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:235: characters 3-13
		$l = $this->h;
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:236: lines 236-240
		while ($l !== null) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:237: characters 4-19
			$v = $l->item;
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:238: characters 4-14
			$l = $l->next;
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:239: characters 4-15
			$b->add($f($v));
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:241: characters 3-11
		return $b;
	}

	/**
	 * Returns the first element of `this` List, or null if no elements exist.
	 * The element is removed from `this` List.
	 * 
	 * @return mixed
	 */
	public function pop () {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:100: lines 100-101
		if ($this->h === null) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:101: characters 4-15
			return null;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:102: characters 3-18
		$x = $this->h->item;
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:103: characters 3-13
		$this->h = $this->h->next;
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:104: lines 104-105
		if ($this->h === null) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:105: characters 4-12
			$this->q = null;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:106: characters 3-11
		$this->length--;
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:107: characters 3-11
		return $x;
	}

	/**
	 * Adds element `item` at the beginning of `this` List.
	 * `this.length` increases by 1.
	 * 
	 * @param mixed $item
	 * 
	 * @return void
	 */
	public function push ($item) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:69: characters 3-36
		$x = new ListNode($item, $this->h);
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:70: characters 3-8
		$this->h = $x;
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:71: lines 71-72
		if ($this->q === null) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:72: characters 4-9
			$this->q = $x;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:73: characters 3-11
		$this->length++;
	}

	/**
	 * Removes the first occurrence of `v` in `this` List.
	 * If `v` is found by checking standard equality, it is removed from `this`
	 * List and the function returns true.
	 * Otherwise, false is returned.
	 * 
	 * @param mixed $v
	 * 
	 * @return bool
	 */
	public function remove ($v) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:138: characters 3-31
		$prev = null;
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:139: characters 3-13
		$l = $this->h;
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:140: lines 140-153
		while ($l !== null) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:141: lines 141-150
			if (Boot::equal($l->item, $v)) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:142: lines 142-145
				if ($prev === null) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:143: characters 6-16
					$this->h = $l->next;
				} else {
					#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:145: characters 6-24
					$prev->next = $l->next;
				}
				#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:146: lines 146-147
				if ($this->q === $l) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:147: characters 6-14
					$this->q = $prev;
				}
				#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:148: characters 5-13
				$this->length--;
				#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:149: characters 5-16
				return true;
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:151: characters 4-12
			$prev = $l;
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:152: characters 4-14
			$l = $l->next;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:154: characters 3-15
		return false;
	}

	/**
	 * Returns a string representation of `this` List.
	 * The result is enclosed in { } with the individual elements being
	 * separated by a comma.
	 * 
	 * @return string
	 */
	public function toString () {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:178: characters 3-27
		$s = new StringBuf();
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:179: characters 3-20
		$first = true;
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:180: characters 3-13
		$l = $this->h;
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:181: characters 3-13
		$s->add("{");
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:182: lines 182-189
		while ($l !== null) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:183: lines 183-186
			if ($first) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:184: characters 5-18
				$first = false;
			} else {
				#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:186: characters 5-16
				$s->add(", ");
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:187: characters 4-29
			$s->add(Std::string($l->item));
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:188: characters 4-14
			$l = $l->next;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:190: characters 3-13
		$s->add("}");
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/List.hx:191: characters 3-22
		return $s->b;
	}

	public function __toString() {
		return $this->toString();
	}
}

Boot::registerClass(List_hx::class, 'haxe.ds.List');
