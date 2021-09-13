<?php
/**
 */

namespace helder\std\haxe\ds;

use \helder\std\Reflect;
use \helder\std\php\Boot;
use \helder\std\haxe\Exception;
use \helder\std\Array_hx;
use \helder\std\haxe\iterators\MapKeyValueIterator;
use \helder\std\haxe\IMap;
use \helder\std\haxe\NativeStackTrace;
use \helder\std\haxe\iterators\ArrayIterator;

/**
 * BalancedTree allows key-value mapping with arbitrary keys, as long as they
 * can be ordered. By default, `Reflect.compare` is used in the `compare`
 * method, which can be overridden in subclasses.
 * Operations have a logarithmic average and worst-case cost.
 * Iteration over keys and values, using `keys` and `iterator` respectively,
 * are in-order.
 */
class BalancedTree implements IMap {
	/**
	 * @var TreeNode
	 */
	public $root;

	/**
	 * @param TreeNode $node
	 * @param mixed[]|Array_hx $acc
	 * 
	 * @return void
	 */
	public static function iteratorLoop ($node, $acc) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:173: lines 173-177
		if ($node !== null) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:174: characters 4-32
			BalancedTree::iteratorLoop($node->left, $acc);
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:175: characters 4-24
			$acc->arr[$acc->length++] = $node->value;
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:176: characters 4-33
			BalancedTree::iteratorLoop($node->right, $acc);
		}
	}

	/**
	 * Creates a new BalancedTree, which is initially empty.
	 * 
	 * @return void
	 */
	public function __construct () {
	}

	/**
	 * @param TreeNode $l
	 * @param mixed $k
	 * @param mixed $v
	 * @param TreeNode $r
	 * 
	 * @return TreeNode
	 */
	public function balance ($l, $k, $v, $r) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:206: characters 3-27
		$hl = ($l === null ? 0 : $l->_height);
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:207: characters 3-27
		$hr = ($r === null ? 0 : $r->_height);
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:208: lines 208-222
		if ($hl > ($hr + 2)) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:209: characters 8-27
			$_this = $l->left;
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:209: characters 31-51
			$_this1 = $l->right;
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:209: lines 209-213
			if ((($_this === null ? 0 : $_this->_height)) >= (($_this1 === null ? 0 : $_this1->_height))) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:210: characters 24-30
				$l1 = $l->left;
				#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:210: characters 32-37
				$l2 = $l->key;
				#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:210: characters 39-46
				$l3 = $l->value;
				#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:210: characters 5-85
				return new TreeNode($l1, $l2, $l3, new TreeNode($l->right, $k, $v, $r));
			} else {
				#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:212: characters 24-80
				$tmp = new TreeNode($l->left, $l->key, $l->value, $l->right->left);
				#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:212: characters 82-93
				$l1 = $l->right->key;
				#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:212: characters 95-108
				$l2 = $l->right->value;
				#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:212: lines 212-213
				return new TreeNode($tmp, $l1, $l2, new TreeNode($l->right->right, $k, $v, $r));
			}
		} else if ($hr > ($hl + 2)) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:215: characters 8-28
			$_this = $r->right;
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:215: characters 31-50
			$_this1 = $r->left;
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:215: lines 215-219
			if ((($_this === null ? 0 : $_this->_height)) > (($_this1 === null ? 0 : $_this1->_height))) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:216: characters 5-85
				return new TreeNode(new TreeNode($l, $k, $v, $r->left), $r->key, $r->value, $r->right);
			} else {
				#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:218: characters 24-64
				$tmp = new TreeNode($l, $k, $v, $r->left->left);
				#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:218: characters 66-76
				$r1 = $r->left->key;
				#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:218: characters 78-90
				$r2 = $r->left->value;
				#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:218: lines 218-219
				return new TreeNode($tmp, $r1, $r2, new TreeNode($r->left->right, $r->key, $r->value, $r->right));
			}
		} else {
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:221: characters 4-59
			return new TreeNode($l, $k, $v, $r, (($hl > $hr ? $hl : $hr)) + 1);
		}
	}

	/**
	 * Removes all keys from `this` BalancedTree.
	 * 
	 * @return void
	 */
	public function clear () {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:237: characters 3-14
		$this->root = null;
	}

	/**
	 * @param mixed $k1
	 * @param mixed $k2
	 * 
	 * @return int
	 */
	public function compare ($k1, $k2) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:226: characters 3-33
		return Reflect::compare($k1, $k2);
	}

	/**
	 * @return BalancedTree
	 */
	public function copy () {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:145: characters 3-41
		$copied = new BalancedTree();
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:146: characters 3-21
		$copied->root = $this->root;
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:147: characters 3-16
		return $copied;
	}

	/**
	 * Tells if `key` is bound to a value.
	 * This method returns true even if `key` is bound to null.
	 * If `key` is null, the result is unspecified.
	 * 
	 * @param mixed $key
	 * 
	 * @return bool
	 */
	public function exists ($key) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:102: characters 3-19
		$node = $this->root;
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:103: lines 103-111
		while ($node !== null) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:104: characters 4-35
			$c = $this->compare($key, $node->key);
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:105: lines 105-110
			if ($c === 0) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:106: characters 5-16
				return true;
			} else if ($c < 0) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:108: characters 5-21
				$node = $node->left;
			} else {
				#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:110: characters 5-22
				$node = $node->right;
			}
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:112: characters 3-15
		return false;
	}

	/**
	 * Returns the value `key` is bound to.
	 * If `key` is not bound to any value, `null` is returned.
	 * If `key` is null, the result is unspecified.
	 * 
	 * @param mixed $key
	 * 
	 * @return mixed
	 */
	public function get ($key) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:62: characters 3-19
		$node = $this->root;
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:63: lines 63-71
		while ($node !== null) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:64: characters 4-35
			$c = $this->compare($key, $node->key);
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:65: lines 65-66
			if ($c === 0) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:66: characters 5-22
				return $node->value;
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:67: lines 67-70
			if ($c < 0) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:68: characters 5-21
				$node = $node->left;
			} else {
				#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:70: characters 5-22
				$node = $node->right;
			}
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:72: characters 3-14
		return null;
	}

	/**
	 * Iterates over the bound values of `this` BalancedTree.
	 * This operation is performed in-order.
	 * 
	 * @return object
	 */
	public function iterator () {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:121: characters 3-16
		$ret = new Array_hx();
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:122: characters 3-26
		BalancedTree::iteratorLoop($this->root, $ret);
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:123: characters 3-24
		return new ArrayIterator($ret);
	}

	/**
	 * See `Map.keyValueIterator`
	 * 
	 * @return object
	 */
	public function keyValueIterator () {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:130: characters 3-54
		return new MapKeyValueIterator($this);
	}

	/**
	 * Iterates over the keys of `this` BalancedTree.
	 * This operation is performed in-order.
	 * 
	 * @return object
	 */
	public function keys () {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:139: characters 3-16
		$ret = new Array_hx();
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:140: characters 3-22
		$this->keysLoop($this->root, $ret);
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:141: characters 3-24
		return new ArrayIterator($ret);
	}

	/**
	 * @param TreeNode $node
	 * @param mixed[]|Array_hx $acc
	 * 
	 * @return void
	 */
	public function keysLoop ($node, $acc) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:181: lines 181-185
		if ($node !== null) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:182: characters 4-28
			$this->keysLoop($node->left, $acc);
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:183: characters 4-22
			$acc->arr[$acc->length++] = $node->key;
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:184: characters 4-29
			$this->keysLoop($node->right, $acc);
		}
	}

	/**
	 * @param TreeNode $t1
	 * @param TreeNode $t2
	 * 
	 * @return TreeNode
	 */
	public function merge ($t1, $t2) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:189: lines 189-190
		if ($t1 === null) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:190: characters 4-13
			return $t2;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:191: lines 191-192
		if ($t2 === null) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:192: characters 4-13
			return $t1;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:193: characters 3-26
		$t = $this->minBinding($t2);
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:194: characters 3-59
		return $this->balance($t1, $t->key, $t->value, $this->removeMinBinding($t2));
	}

	/**
	 * @param TreeNode $t
	 * 
	 * @return TreeNode
	 */
	public function minBinding ($t) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:198: characters 10-95
		if ($t === null) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:198: characters 25-30
			throw Exception::thrown("Not_found");
		} else if ($t->left === null) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:198: characters 69-70
			return $t;
		} else {
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:198: characters 77-95
			return $this->minBinding($t->left);
		}
	}

	/**
	 * Removes the current binding of `key`.
	 * If `key` has no binding, `this` BalancedTree is unchanged and false is
	 * returned.
	 * Otherwise the binding of `key` is removed and true is returned.
	 * If `key` is null, the result is unspecified.
	 * 
	 * @param mixed $key
	 * 
	 * @return bool
	 */
	public function remove ($key) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:86: lines 86-91
		try {
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:87: characters 4-32
			$this->root = $this->removeLoop($key, $this->root);
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:88: characters 4-15
			return true;
		} catch(\Throwable $_g) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:89: characters 12-13
			NativeStackTrace::saveStack($_g);
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:86: lines 86-91
			if (is_string(Exception::caught($_g)->unwrap())) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:90: characters 4-16
				return false;
			} else {
				#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:86: lines 86-91
				throw $_g;
			}
		}
	}

	/**
	 * @param mixed $k
	 * @param TreeNode $node
	 * 
	 * @return TreeNode
	 */
	public function removeLoop ($k, $node) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:164: lines 164-165
		if ($node === null) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:165: characters 4-9
			throw Exception::thrown("Not_found");
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:166: characters 3-32
		$c = $this->compare($k, $node->key);
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:167: lines 167-169
		if ($c === 0) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:167: lines 167-168
			return $this->merge($node->left, $node->right);
		} else if ($c < 0) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:168: lines 168-169
			return $this->balance($this->removeLoop($k, $node->left), $node->key, $node->value, $node->right);
		} else {
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:169: characters 22-89
			return $this->balance($node->left, $node->key, $node->value, $this->removeLoop($k, $node->right));
		}
	}

	/**
	 * @param TreeNode $t
	 * 
	 * @return TreeNode
	 */
	public function removeMinBinding ($t) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:202: characters 10-102
		if ($t->left === null) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:202: characters 30-37
			return $t->right;
		} else {
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:202: characters 44-102
			return $this->balance($this->removeMinBinding($t->left), $t->key, $t->value, $t->right);
		}
	}

	/**
	 * Binds `key` to `value`.
	 * If `key` is already bound to a value, that binding disappears.
	 * If `key` is null, the result is unspecified.
	 * 
	 * @param mixed $key
	 * @param mixed $value
	 * 
	 * @return void
	 */
	public function set ($key, $value) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:51: characters 3-35
		$this->root = $this->setLoop($key, $value, $this->root);
	}

	/**
	 * @param mixed $k
	 * @param mixed $v
	 * @param TreeNode $node
	 * 
	 * @return TreeNode
	 */
	public function setLoop ($k, $v, $node) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:151: lines 151-152
		if ($node === null) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:152: characters 4-47
			return new TreeNode(null, $k, $v, null);
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:153: characters 3-32
		$c = $this->compare($k, $node->key);
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:154: lines 154-160
		if ($c === 0) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:154: characters 22-88
			return new TreeNode($node->left, $k, $v, $node->right, ($node === null ? 0 : $node->_height));
		} else if ($c < 0) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:155: characters 4-38
			$nl = $this->setLoop($k, $v, $node->left);
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:156: characters 4-49
			return $this->balance($nl, $node->key, $node->value, $node->right);
		} else {
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:158: characters 4-39
			$nr = $this->setLoop($k, $v, $node->right);
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:159: characters 4-48
			return $this->balance($node->left, $node->key, $node->value, $nr);
		}
	}

	/**
	 * @return string
	 */
	public function toString () {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:230: characters 10-54
		if ($this->root === null) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:230: characters 26-28
			return "{}";
		} else {
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/BalancedTree.hx:230: characters 33-53
			return "{" . ($this->root->toString()??'null') . "}";
		}
	}

	public function __toString() {
		return $this->toString();
	}
}

Boot::registerClass(BalancedTree::class, 'haxe.ds.BalancedTree');
