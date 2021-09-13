<?php
/**
 */

namespace helder\std\haxe\ds;

use \helder\std\php\Boot;

/**
 * ListSort provides a stable implementation of merge sort through its `sort`
 * method. It has a O(N.log(N)) complexity and does not require additional memory allocation.
 */
class ListSort {
	/**
	 * Sorts List `lst` according to the comparison function `cmp`, where
	 * `cmp(x,y)` returns 0 if `x == y`, a positive Int if `x > y` and a
	 * negative Int if `x < y`.
	 * This operation modifies List `a` in place and returns its head once modified.
	 * The `prev` of the head is set to the tail of the sorted list.
	 * If `list` or `cmp` are null, the result is unspecified.
	 * 
	 * @param mixed $list
	 * @param \Closure $cmp
	 * 
	 * @return mixed
	 */
	public static function sort ($list, $cmp) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:44: lines 44-45
		if ($list === null) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:45: characters 4-15
			return null;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:46: characters 3-49
		$insize = 1;
		$nmerges = null;
		$psize = 0;
		$qsize = 0;
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:47: characters 3-30
		$p = null;
		$q = null;
		$e = null;
		$tail = null;
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:48: lines 48-91
		while (true) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:49: characters 4-12
			$p = $list;
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:50: characters 4-15
			$list = null;
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:51: characters 4-15
			$tail = null;
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:52: characters 4-15
			$nmerges = 0;
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:53: lines 53-86
			while ($p !== null) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:54: characters 5-14
				++$nmerges;
				#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:55: characters 5-10
				$q = $p;
				#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:56: characters 5-14
				$psize = 0;
				#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:57: characters 15-19
				$_g = 0;
				#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:57: characters 19-25
				$_g1 = $insize;
				#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:57: lines 57-62
				while ($_g < $_g1) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:57: characters 15-25
					$i = $_g++;
					#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:58: characters 6-13
					++$psize;
					#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:59: characters 6-16
					$q = $q->next;
					#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:60: lines 60-61
					if ($q === null) {
						#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:61: characters 7-12
						break;
					}
				}
				#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:63: characters 5-19
				$qsize = $insize;
				#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:64: lines 64-84
				while (($psize > 0) || (($qsize > 0) && ($q !== null))) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:65: lines 65-77
					if ($psize === 0) {
						#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:66: characters 7-12
						$e = $q;
						#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:67: characters 7-17
						$q = $q->next;
						#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:68: characters 7-14
						--$qsize;
					} else if (($qsize === 0) || ($q === null) || ($cmp($p, $q) <= 0)) {
						#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:70: characters 7-12
						$e = $p;
						#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:71: characters 7-17
						$p = $p->next;
						#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:72: characters 7-14
						--$psize;
					} else {
						#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:74: characters 7-12
						$e = $q;
						#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:75: characters 7-17
						$q = $q->next;
						#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:76: characters 7-14
						--$qsize;
					}
					#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:78: lines 78-81
					if ($tail !== null) {
						#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:79: characters 7-20
						$tail->next = $e;
					} else {
						#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:81: characters 7-15
						$list = $e;
					}
					#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:82: characters 6-19
					$e->prev = $tail;
					#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:83: characters 6-14
					$tail = $e;
				}
				#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:85: characters 5-10
				$p = $q;
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:87: characters 4-20
			$tail->next = null;
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:88: lines 88-89
			if ($nmerges <= 1) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:89: characters 5-10
				break;
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:90: characters 4-15
			$insize *= 2;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:92: characters 3-19
		$list->prev = $tail;
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:93: characters 3-14
		return $list;
	}

	/**
	 * Same as `sort` but on single linked list.
	 * 
	 * @param mixed $list
	 * @param \Closure $cmp
	 * 
	 * @return mixed
	 */
	public static function sortSingleLinked ($list, $cmp) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:100: lines 100-101
		if ($list === null) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:101: characters 4-15
			return null;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:102: characters 3-49
		$insize = 1;
		$nmerges = null;
		$psize = 0;
		$qsize = 0;
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:103: characters 3-23
		$p = null;
		$q = null;
		$e = null;
		$tail = null;
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:104: lines 104-146
		while (true) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:105: characters 4-12
			$p = $list;
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:106: characters 4-15
			$list = null;
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:107: characters 4-15
			$tail = null;
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:108: characters 4-15
			$nmerges = 0;
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:109: lines 109-141
			while ($p !== null) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:110: characters 5-14
				++$nmerges;
				#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:111: characters 5-10
				$q = $p;
				#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:112: characters 5-14
				$psize = 0;
				#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:113: characters 15-19
				$_g = 0;
				#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:113: characters 19-25
				$_g1 = $insize;
				#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:113: lines 113-118
				while ($_g < $_g1) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:113: characters 15-25
					$i = $_g++;
					#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:114: characters 6-13
					++$psize;
					#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:115: characters 6-16
					$q = $q->next;
					#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:116: lines 116-117
					if ($q === null) {
						#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:117: characters 7-12
						break;
					}
				}
				#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:119: characters 5-19
				$qsize = $insize;
				#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:120: lines 120-139
				while (($psize > 0) || (($qsize > 0) && ($q !== null))) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:121: lines 121-133
					if ($psize === 0) {
						#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:122: characters 7-12
						$e = $q;
						#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:123: characters 7-17
						$q = $q->next;
						#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:124: characters 7-14
						--$qsize;
					} else if (($qsize === 0) || ($q === null) || ($cmp($p, $q) <= 0)) {
						#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:126: characters 7-12
						$e = $p;
						#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:127: characters 7-17
						$p = $p->next;
						#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:128: characters 7-14
						--$psize;
					} else {
						#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:130: characters 7-12
						$e = $q;
						#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:131: characters 7-17
						$q = $q->next;
						#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:132: characters 7-14
						--$qsize;
					}
					#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:134: lines 134-137
					if ($tail !== null) {
						#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:135: characters 7-20
						$tail->next = $e;
					} else {
						#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:137: characters 7-15
						$list = $e;
					}
					#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:138: characters 6-14
					$tail = $e;
				}
				#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:140: characters 5-10
				$p = $q;
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:142: characters 4-20
			$tail->next = null;
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:143: lines 143-144
			if ($nmerges <= 1) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:144: characters 5-10
				break;
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:145: characters 4-15
			$insize *= 2;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/ds/ListSort.hx:147: characters 3-14
		return $list;
	}
}

Boot::registerClass(ListSort::class, 'haxe.ds.ListSort');
