<?php
/**
 */

namespace helder\std;

use \helder\std\php\Boot;
use \helder\std\haxe\ds\List_hx;

/**
 * The `Lambda` class is a collection of methods to support functional
 * programming. It is ideally used with `using Lambda` and then acts as an
 * extension to Iterable types.
 * On static platforms, working with the Iterable structure might be slower
 * than performing the operations directly on known types, such as Array and
 * List.
 * If the first argument to any of the methods is null, the result is
 * unspecified.
 * @see https://haxe.org/manual/std-Lambda.html
 */
class Lambda {
	/**
	 * Creates an Array from Iterable `it`.
	 * If `it` is an Array, this function returns a copy of it.
	 * 
	 * @param object $it
	 * 
	 * @return mixed[]|Array_hx
	 */
	public static function array ($it) {
		#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:46: characters 3-26
		$a = new Array_hx();
		#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:47: characters 13-15
		$i = $it->iterator();
		while ($i->hasNext()) {
			#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:47: lines 47-48
			$i1 = $i->next();
			#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:48: characters 4-13
			$a->arr[$a->length++] = $i1;
		}
		#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:49: characters 3-11
		return $a;
	}

	/**
	 * Returns a new Array containing all elements of Iterable `a` followed by
	 * all elements of Iterable `b`.
	 * If `a` or `b` are null, the result is unspecified.
	 * 
	 * @param object $a
	 * @param object $b
	 * 
	 * @return mixed[]|Array_hx
	 */
	public static function concat ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:290: characters 3-23
		$l = new Array_hx();
		#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:291: characters 13-14
		$x = $a->iterator();
		while ($x->hasNext()) {
			#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:291: lines 291-292
			$x1 = $x->next();
			#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:292: characters 4-13
			$l->arr[$l->length++] = $x1;
		}
		#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:293: characters 13-14
		$x = $b->iterator();
		while ($x->hasNext()) {
			#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:293: lines 293-294
			$x1 = $x->next();
			#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:294: characters 4-13
			$l->arr[$l->length++] = $x1;
		}
		#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:295: characters 3-11
		return $l;
	}

	/**
	 * Returns the number of elements in `it` for which `pred` is true, or the
	 * total number of elements in `it` if `pred` is null.
	 * This function traverses all elements.
	 * 
	 * @param object $it
	 * @param \Closure $pred
	 * 
	 * @return int
	 */
	public static function count ($it, $pred = null) {
		#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:210: characters 3-13
		$n = 0;
		#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:211: lines 211-217
		if ($pred === null) {
			#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:212: characters 14-16
			$_ = $it->iterator();
			while ($_->hasNext()) {
				#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:212: lines 212-213
				$_1 = $_->next();
				#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:213: characters 5-8
				++$n;
			}
		} else {
			#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:215: characters 14-16
			$x = $it->iterator();
			while ($x->hasNext()) {
				#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:215: lines 215-217
				$x1 = $x->next();
				#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:216: lines 216-217
				if ($pred($x1)) {
					#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:217: characters 6-9
					++$n;
				}
			}
		}
		#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:218: characters 3-11
		return $n;
	}

	/**
	 * Tells if Iterable `it` does not contain any element.
	 * 
	 * @param object $it
	 * 
	 * @return bool
	 */
	public static function empty ($it) {
		#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:225: characters 3-34
		return !$it->iterator()->hasNext();
	}

	/**
	 * Tells if `it` contains an element for which `f` is true.
	 * This function returns true as soon as an element is found for which a
	 * call to `f` returns true.
	 * If no such element is found, the result is false.
	 * If `f` is null, the result is unspecified.
	 * 
	 * @param object $it
	 * @param \Closure $f
	 * 
	 * @return bool
	 */
	public static function exists ($it, $f) {
		#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:126: characters 13-15
		$x = $it->iterator();
		while ($x->hasNext()) {
			#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:126: lines 126-128
			$x1 = $x->next();
			#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:127: lines 127-128
			if ($f($x1)) {
				#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:128: characters 5-16
				return true;
			}
		}
		#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:129: characters 3-15
		return false;
	}

	/**
	 * Returns a Array containing those elements of `it` for which `f` returned
	 * true.
	 * If `it` is empty, the result is the empty Array even if `f` is null.
	 * Otherwise if `f` is null, the result is unspecified.
	 * 
	 * @param object $it
	 * @param \Closure $f
	 * 
	 * @return mixed[]|Array_hx
	 */
	public static function filter ($it, $f) {
		#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:168: characters 10-37
		$_g = new Array_hx();
		#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:168: characters 21-23
		$x = $it->iterator();
		while ($x->hasNext()) {
			#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:168: characters 11-36
			$x1 = $x->next();
			#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:168: characters 25-36
			if ($f($x1)) {
				#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:168: characters 35-36
				$_g->arr[$_g->length++] = $x1;
			}
		}
		#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:168: characters 10-37
		return $_g;
	}

	/**
	 * Returns the first element of `it` for which `f` is true.
	 * This function returns as soon as an element is found for which a call to
	 * `f` returns true.
	 * If no such element is found, the result is null.
	 * If `f` is null, the result is unspecified.
	 * 
	 * @param object $it
	 * @param \Closure $f
	 * 
	 * @return mixed
	 */
	public static function find ($it, $f) {
		#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:256: characters 13-15
		$v = $it->iterator();
		while ($v->hasNext()) {
			#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:256: lines 256-259
			$v1 = $v->next();
			#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:257: lines 257-258
			if ($f($v1)) {
				#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:258: characters 5-13
				return $v1;
			}
		}
		#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:260: characters 3-14
		return null;
	}

	/**
	 * Returns the index of the first element of `it` for which `f` is true.
	 * This function returns as soon as an element is found for which a call to
	 * `f` returns true.
	 * If no such element is found, the result is -1.
	 * If `f` is null, the result is unspecified.
	 * 
	 * @param object $it
	 * @param \Closure $f
	 * 
	 * @return int
	 */
	public static function findIndex ($it, $f) {
		#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:274: characters 3-13
		$i = 0;
		#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:275: characters 13-15
		$v = $it->iterator();
		while ($v->hasNext()) {
			#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:275: lines 275-279
			$v1 = $v->next();
			#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:276: lines 276-277
			if ($f($v1)) {
				#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:277: characters 5-13
				return $i;
			}
			#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:278: characters 4-7
			++$i;
		}
		#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:280: characters 3-12
		return -1;
	}

	/**
	 * A composition of map and flatten.
	 * The order of elements is preserved.
	 * If `f` is null, the result is unspecified.
	 * 
	 * @param object $it
	 * @param \Closure $f
	 * 
	 * @return mixed[]|Array_hx
	 */
	public static function flatMap ($it, $f) {
		#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:97: characters 25-42
		$_g = new Array_hx();
		$x = $it->iterator();
		while ($x->hasNext()) {
			$x1 = $x->next();
			$x2 = $f($x1);
			$_g->arr[$_g->length++] = $x2;
		}
		#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:97: characters 10-43
		$_g1 = new Array_hx();
		$e = $_g->iterator();
		while ($e->hasNext()) {
			$e1 = $e->next();
			$x = $e1->iterator();
			while ($x->hasNext()) {
				$x1 = $x->next();
				$_g1->arr[$_g1->length++] = $x1;
			}
		}
		return $_g1;
	}

	/**
	 * Concatenate a list of iterables.
	 * The order of elements is preserved.
	 * 
	 * @param object $it
	 * 
	 * @return mixed[]|Array_hx
	 */
	public static function flatten ($it) {
		#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:88: characters 10-40
		$_g = new Array_hx();
		#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:88: characters 21-23
		$e = $it->iterator();
		while ($e->hasNext()) {
			#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:88: characters 11-39
			$e1 = $e->next();
			#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:88: characters 35-36
			$x = $e1->iterator();
			while ($x->hasNext()) {
				#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:88: characters 25-39
				$x1 = $x->next();
				#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:88: characters 38-39
				$_g->arr[$_g->length++] = $x1;
			}
		}
		#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:88: characters 10-40
		return $_g;
	}

	/**
	 * Functional fold on Iterable `it`, using function `f` with start argument
	 * `first`.
	 * If `it` has no elements, the result is `first`.
	 * Otherwise the first element of `it` is passed to `f` alongside `first`.
	 * The result of that call is then passed to `f` with the next element of
	 * `it`, and so on until `it` has no more elements.
	 * If `it` or `f` are null, the result is unspecified.
	 * 
	 * @param object $it
	 * @param \Closure $f
	 * @param mixed $first
	 * 
	 * @return mixed
	 */
	public static function fold ($it, $f, $first) {
		#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:184: characters 13-15
		$x = $it->iterator();
		while ($x->hasNext()) {
			#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:184: lines 184-185
			$x1 = $x->next();
			#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:185: characters 4-23
			$first = $f($x1, $first);
		}
		#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:186: characters 3-15
		return $first;
	}

	/**
	 * Similar to fold, but also passes the index of each element to `f`.
	 * If `it` or `f` are null, the result is unspecified.
	 * 
	 * @param object $it
	 * @param \Closure $f
	 * @param mixed $first
	 * 
	 * @return mixed
	 */
	public static function foldi ($it, $f, $first) {
		#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:195: characters 3-13
		$i = 0;
		#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:196: characters 13-15
		$x = $it->iterator();
		while ($x->hasNext()) {
			#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:196: lines 196-199
			$x1 = $x->next();
			#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:197: characters 4-26
			$first = $f($x1, $first, $i);
			#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:198: characters 4-7
			++$i;
		}
		#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:200: characters 3-15
		return $first;
	}

	/**
	 * Tells if `f` is true for all elements of `it`.
	 * This function returns false as soon as an element is found for which a
	 * call to `f` returns false.
	 * If no such element is found, the result is true.
	 * In particular, this function always returns true if `it` is empty.
	 * If `f` is null, the result is unspecified.
	 * 
	 * @param object $it
	 * @param \Closure $f
	 * 
	 * @return bool
	 */
	public static function foreach ($it, $f) {
		#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:145: characters 13-15
		$x = $it->iterator();
		while ($x->hasNext()) {
			#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:145: lines 145-147
			$x1 = $x->next();
			#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:146: lines 146-147
			if (!$f($x1)) {
				#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:147: characters 5-17
				return false;
			}
		}
		#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:148: characters 3-14
		return true;
	}

	/**
	 * Tells if `it` contains `elt`.
	 * This function returns true as soon as an element is found which is equal
	 * to `elt` according to the `==` operator.
	 * If no such element is found, the result is false.
	 * 
	 * @param object $it
	 * @param mixed $elt
	 * 
	 * @return bool
	 */
	public static function has ($it, $elt) {
		#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:109: characters 13-15
		$x = $it->iterator();
		while ($x->hasNext()) {
			#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:109: lines 109-111
			$x1 = $x->next();
			#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:110: lines 110-111
			if (Boot::equal($x1, $elt)) {
				#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:111: characters 5-16
				return true;
			}
		}
		#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:112: characters 3-15
		return false;
	}

	/**
	 * Returns the index of the first element `v` within Iterable `it`.
	 * This function uses operator `==` to check for equality.
	 * If `v` does not exist in `it`, the result is -1.
	 * 
	 * @param object $it
	 * @param mixed $v
	 * 
	 * @return int
	 */
	public static function indexOf ($it, $v) {
		#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:236: characters 3-13
		$i = 0;
		#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:237: characters 14-16
		$v2 = $it->iterator();
		while ($v2->hasNext()) {
			#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:237: lines 237-241
			$v21 = $v2->next();
			#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:238: lines 238-239
			if (Boot::equal($v, $v21)) {
				#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:239: characters 5-13
				return $i;
			}
			#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:240: characters 4-7
			++$i;
		}
		#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:242: characters 3-12
		return -1;
	}

	/**
	 * Calls `f` on all elements of `it`, in order.
	 * If `f` is null, the result is unspecified.
	 * 
	 * @param object $it
	 * @param \Closure $f
	 * 
	 * @return void
	 */
	public static function iter ($it, $f) {
		#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:157: characters 13-15
		$x = $it->iterator();
		while ($x->hasNext()) {
			#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:157: lines 157-158
			$x1 = $x->next();
			#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:158: characters 4-8
			$f($x1);
		}
	}

	/**
	 * Creates a List form Iterable `it`.
	 * If `it` is a List, this function returns a copy of it.
	 * 
	 * @param object $it
	 * 
	 * @return List_hx
	 */
	public static function list ($it) {
		#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:58: characters 3-25
		$l = new List_hx();
		#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:59: characters 13-15
		$i = $it->iterator();
		while ($i->hasNext()) {
			#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:59: lines 59-60
			$i1 = $i->next();
			#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:60: characters 4-12
			$l->add($i1);
		}
		#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:61: characters 3-11
		return $l;
	}

	/**
	 * Creates a new Array by applying function `f` to all elements of `it`.
	 * The order of elements is preserved.
	 * If `f` is null, the result is unspecified.
	 * 
	 * @param object $it
	 * @param \Closure $f
	 * 
	 * @return mixed[]|Array_hx
	 */
	public static function map ($it, $f) {
		#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:70: characters 10-30
		$_g = new Array_hx();
		#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:70: characters 21-23
		$x = $it->iterator();
		while ($x->hasNext()) {
			#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:70: characters 11-29
			$x1 = $x->next();
			#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:70: characters 25-29
			$x2 = $f($x1);
			$_g->arr[$_g->length++] = $x2;
		}
		#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:70: characters 10-30
		return $_g;
	}

	/**
	 * Similar to map, but also passes the index of each element to `f`.
	 * The order of elements is preserved.
	 * If `f` is null, the result is unspecified.
	 * 
	 * @param object $it
	 * @param \Closure $f
	 * 
	 * @return mixed[]|Array_hx
	 */
	public static function mapi ($it, $f) {
		#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:79: characters 3-13
		$i = 0;
		#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:80: characters 10-35
		$_g = new Array_hx();
		#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:80: characters 21-23
		$x = $it->iterator();
		while ($x->hasNext()) {
			#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:80: characters 11-34
			$x1 = $x->next();
			#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:80: characters 25-34
			$x2 = $f($i++, $x1);
			$_g->arr[$_g->length++] = $x2;
		}
		#/home/runner/haxe/versions/4.2.3/std/Lambda.hx:80: characters 10-35
		return $_g;
	}
}

Boot::registerClass(Lambda::class, 'Lambda');
