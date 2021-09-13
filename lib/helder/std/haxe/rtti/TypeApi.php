<?php
/**
 */

namespace helder\std\haxe\rtti;

use \helder\std\php\Boot;
use \helder\std\haxe\Exception;
use \helder\std\Array_hx;

/**
 * Contains type and equality checks functionalities for RTTI.
 */
class TypeApi {
	/**
	 * Unlike `c1 == c2`, this function performs a deep equality check on
	 * the arguments of the enum constructors, if exists.
	 * If `c1` or `c2` are `null`, the result is unspecified.
	 * 
	 * @param object $c1
	 * @param object $c2
	 * 
	 * @return bool
	 */
	public static function constructorEq ($c1, $c2) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:533: lines 533-534
		if ($c1->name !== $c2->name) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:534: characters 4-16
			return false;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:535: lines 535-536
		if ($c1->doc !== $c2->doc) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:536: characters 4-16
			return false;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:537: lines 537-538
		if (($c1->args === null) !== ($c2->args === null)) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:538: characters 4-16
			return false;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:539: lines 539-542
		if (($c1->args !== null) && !TypeApi::leq(function ($a, $b) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:540: characters 11-65
			if (($a->name === $b->name) && ($a->opt === $b->opt)) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:540: characters 49-65
				return TypeApi::typeEq($a->t, $b->t);
			} else {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:540: characters 11-65
				return false;
			}
		}, $c1->args, $c2->args)) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:542: characters 4-16
			return false;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:543: characters 3-14
		return true;
	}

	/**
	 * Unlike `f1 == f2`, this function performs a deep equality check on
	 * the given `ClassField` instances.
	 * If `f1` or `f2` are `null`, the result is unspecified.
	 * 
	 * @param object $f1
	 * @param object $f2
	 * 
	 * @return bool
	 */
	public static function fieldEq ($f1, $f2) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:507: lines 507-508
		if ($f1->name !== $f2->name) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:508: characters 4-16
			return false;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:509: lines 509-510
		if (!TypeApi::typeEq($f1->type, $f2->type)) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:510: characters 4-16
			return false;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:511: lines 511-512
		if ($f1->isPublic !== $f2->isPublic) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:512: characters 4-16
			return false;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:513: lines 513-514
		if ($f1->doc !== $f2->doc) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:514: characters 4-16
			return false;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:515: lines 515-516
		if (!TypeApi::rightsEq($f1->get, $f2->get)) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:516: characters 4-16
			return false;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:517: lines 517-518
		if (!TypeApi::rightsEq($f1->set, $f2->set)) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:518: characters 4-16
			return false;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:519: lines 519-520
		if (($f1->params === null) !== ($f2->params === null)) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:520: characters 4-16
			return false;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:521: lines 521-522
		if (($f1->params !== null) && ($f1->params->join(":") !== $f2->params->join(":"))) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:522: characters 4-16
			return false;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:523: characters 3-14
		return true;
	}

	/**
	 * Returns `true` if the given `CType` is a variable or `false` if it is a
	 * function.
	 * 
	 * @param CType $t
	 * 
	 * @return bool
	 */
	public static function isVar ($t) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:399: lines 399-402
		if ($t->index === 4) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:400: characters 19-20
			$_g = $t->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:400: characters 22-23
			$_g = $t->params[1];
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:400: characters 26-31
			return false;
		} else {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:401: characters 13-17
			return true;
		}
	}

	/**
	 * @param \Closure $f
	 * @param mixed[]|Array_hx $l1
	 * @param mixed[]|Array_hx $l2
	 * 
	 * @return bool
	 */
	public static function leq ($f, $l1, $l2) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:406: characters 12-25
		$it_current = 0;
		$it_array = $l2;
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:407: lines 407-413
		$_g = 0;
		while ($_g < $l1->length) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:407: characters 8-10
			$e1 = ($l1->arr[$_g] ?? null);
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:407: lines 407-413
			++$_g;
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:408: lines 408-409
			if ($it_current >= $it_array->length) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:409: characters 5-17
				return false;
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:410: characters 4-23
			$e2 = ($it_array->arr[$it_current++] ?? null);
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:411: lines 411-412
			if (!$f($e1, $e2)) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:412: characters 5-17
				return false;
			}
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:414: lines 414-415
		if ($it_current < $it_array->length) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:415: characters 4-16
			return false;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:416: characters 3-14
		return true;
	}

	/**
	 * Unlike `r1 == r2`, this function performs a deep equality check on
	 * the given `Rights` instances.
	 * If `r1` or `r2` are `null`, the result is unspecified.
	 * 
	 * @param Rights $r1
	 * @param Rights $r2
	 * 
	 * @return bool
	 */
	public static function rightsEq ($r1, $r2) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:426: lines 426-427
		if ($r1 === $r2) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:427: characters 4-15
			return true;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:428: lines 428-436
		if ($r1->index === 2) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:429: characters 15-17
			$m1 = $r1->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:430: lines 430-434
			if ($r2->index === 2) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:431: characters 17-19
				$m2 = $r2->params[0];
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:432: characters 7-22
				return $m1 === $m2;
			}
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:437: characters 3-15
		return false;
	}

	/**
	 * Unlike `t1 == t2`, this function performs a deep equality check on
	 * the given `CType` instances.
	 * If `t1` or `t2` are `null`, the result is unspecified.
	 * 
	 * @param CType $t1
	 * @param CType $t2
	 * 
	 * @return bool
	 */
	public static function typeEq ($t1, $t2) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:447: lines 447-496
		$__hx__switch = ($t1->index);
		if ($__hx__switch === 0) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:449: characters 5-26
			return $t2 === CType::CUnknown();
		} else if ($__hx__switch === 1) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:450: characters 15-19
			$name = $t1->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:450: characters 21-27
			$params = $t1->params[1];
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:451: lines 451-455
			if ($t2->index === 1) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:452: characters 17-22
				$name2 = $t2->params[0];
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:452: characters 24-31
				$params2 = $t2->params[1];
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:453: characters 14-59
				if ($name === $name2) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:453: characters 31-59
					return TypeApi::leq(Boot::getStaticClosure(TypeApi::class, 'typeEq'), $params, $params2);
				} else {
					#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:453: characters 14-59
					return false;
				}
			}
		} else if ($__hx__switch === 2) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:456: characters 16-20
			$name = $t1->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:456: characters 22-28
			$params = $t1->params[1];
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:457: lines 457-461
			if ($t2->index === 2) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:458: characters 18-23
				$name2 = $t2->params[0];
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:458: characters 25-32
				$params2 = $t2->params[1];
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:459: characters 14-59
				if ($name === $name2) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:459: characters 31-59
					return TypeApi::leq(Boot::getStaticClosure(TypeApi::class, 'typeEq'), $params, $params2);
				} else {
					#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:459: characters 14-59
					return false;
				}
			}
		} else if ($__hx__switch === 3) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:468: characters 18-22
			$name = $t1->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:468: characters 24-30
			$params = $t1->params[1];
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:469: lines 469-473
			if ($t2->index === 3) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:470: characters 20-25
				$name2 = $t2->params[0];
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:470: characters 27-34
				$params2 = $t2->params[1];
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:471: characters 14-59
				if ($name === $name2) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:471: characters 31-59
					return TypeApi::leq(Boot::getStaticClosure(TypeApi::class, 'typeEq'), $params, $params2);
				} else {
					#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:471: characters 14-59
					return false;
				}
			}
		} else if ($__hx__switch === 4) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:474: characters 19-23
			$args = $t1->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:474: characters 25-28
			$ret = $t1->params[1];
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:475: lines 475-481
			if ($t2->index === 4) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:476: characters 21-26
				$args2 = $t2->params[0];
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:476: characters 28-32
				$ret2 = $t2->params[1];
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:477: lines 477-479
				if (TypeApi::leq(function ($a, $b) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:478: characters 15-69
					if (($a->name === $b->name) && ($a->opt === $b->opt)) {
						#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:478: characters 53-69
						return TypeApi::typeEq($a->t, $b->t);
					} else {
						#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:478: characters 15-69
						return false;
					}
				}, $args, $args2)) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:479: characters 26-43
					return TypeApi::typeEq($ret, $ret2);
				} else {
					#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:477: lines 477-479
					return false;
				}
			}
		} else if ($__hx__switch === 5) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:482: characters 20-26
			$fields = $t1->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:483: lines 483-487
			if ($t2->index === 5) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:484: characters 22-29
				$fields2 = $t2->params[0];
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:485: characters 7-71
				return TypeApi::leq(function ($a, $b) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:485: characters 33-53
					return TypeApi::fieldEq($a, $b);
				}, $fields, $fields2);
			}
		} else if ($__hx__switch === 6) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:488: characters 18-19
			$t = $t1->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:489: lines 489-495
			if ($t2->index === 6) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:490: characters 20-22
				$t21 = $t2->params[0];
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:491: lines 491-492
				if (($t === null) !== ($t21 === null)) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:492: characters 8-20
					return false;
				}
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:493: characters 14-40
				if ($t !== null) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:493: characters 27-40
					return TypeApi::typeEq($t, $t21);
				} else {
					#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:493: characters 14-40
					return true;
				}
			}
		} else if ($__hx__switch === 7) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:462: characters 19-23
			$name = $t1->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:462: characters 25-31
			$params = $t1->params[1];
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:463: lines 463-467
			if ($t2->index === 7) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:464: characters 21-26
				$name2 = $t2->params[0];
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:464: characters 28-35
				$params2 = $t2->params[1];
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:465: characters 14-59
				if ($name === $name2) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:465: characters 31-59
					return TypeApi::leq(Boot::getStaticClosure(TypeApi::class, 'typeEq'), $params, $params2);
				} else {
					#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:465: characters 14-59
					return false;
				}
			}
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:497: characters 3-15
		return false;
	}

	/**
	 * @param TypeTree $t
	 * 
	 * @return object
	 */
	public static function typeInfos ($t) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:378: characters 3-21
		$inf = null;
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:379: lines 379-390
		$__hx__switch = ($t->index);
		if ($__hx__switch === 0) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:388: characters 18-19
			$_g = $t->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:388: characters 21-22
			$_g = $t->params[1];
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:388: characters 24-25
			$_g = $t->params[2];
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:389: characters 5-10
			throw Exception::thrown("Unexpected Package");
		} else if ($__hx__switch === 1) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:380: characters 20-21
			$c = $t->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:381: characters 5-12
			$inf = $c;
		} else if ($__hx__switch === 2) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:382: characters 19-20
			$e = $t->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:383: characters 5-12
			$inf = $e;
		} else if ($__hx__switch === 3) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:384: characters 19-20
			$t1 = $t->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:385: characters 5-12
			$inf = $t1;
		} else if ($__hx__switch === 4) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:386: characters 23-24
			$a = $t->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:387: characters 5-12
			$inf = $a;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:391: characters 3-13
		return $inf;
	}
}

Boot::registerClass(TypeApi::class, 'haxe.rtti.TypeApi');
