<?php
/**
 */

namespace helder\std\haxe\xml;

use \helder\std\php\Boot;
use \helder\std\haxe\Exception;
use \helder\std\Array_hx;
use \helder\std\Xml;
use \helder\std\haxe\xml\_Check\CheckResult;
use \helder\std\Std;
use \helder\std\php\_Boot\HxString;
use \helder\std\_Xml\XmlType_Impl_;
use \helder\std\EReg;
use \helder\std\haxe\iterators\ArrayIterator;

class Check {
	/**
	 * @var EReg
	 */
	static public $blanks;

	/**
	 * @param Xml $x
	 * @param Rule $r
	 * 
	 * @return CheckResult
	 */
	public static function check ($x, $r) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:105: lines 105-166
		$__hx__switch = ($r->index);
		if ($__hx__switch === 0) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:107: characters 15-19
			$name = $r->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:107: characters 21-28
			$attribs = $r->params[1];
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:107: characters 30-36
			$childs = $r->params[2];
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:108: characters 9-56
			$tmp = null;
			if ($x->nodeType === Xml::$Element) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:108: characters 38-48
				if ($x->nodeType !== Xml::$Element) {
					throw Exception::thrown("Bad node type, expected Element but found " . ((($x->nodeType === null ? "null" : XmlType_Impl_::toString($x->nodeType)))??'null'));
				}
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:108: characters 9-56
				$tmp = $x->nodeName !== $name;
			} else {
				$tmp = true;
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:108: lines 108-109
			if ($tmp) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:109: characters 6-38
				return CheckResult::CElementExpected($name, $x);
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:110: characters 5-72
			$attribs1 = ($attribs === null ? new Array_hx() : (clone $attribs));
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:112: characters 18-32
			$xatt = $x->attributes();
			while ($xatt->hasNext()) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:112: lines 112-126
				$xatt1 = $xatt->next();
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:113: characters 6-24
				$found = false;
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:114: lines 114-123
				$_g = 0;
				while ($_g < $attribs1->length) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:114: characters 11-14
					$att = ($attribs1->arr[$_g] ?? null);
					#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:114: lines 114-123
					++$_g;
					#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:116: characters 31-32
					$_g1 = $att->params[2];
					#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:116: characters 17-21
					$name = $att->params[0];
					#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:116: characters 23-29
					$filter = $att->params[1];
					#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:117: lines 117-118
					if ($xatt1 !== $name) {
						#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:118: characters 10-18
						continue;
					}
					#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:119: lines 119-120
					if (($filter !== null) && !Check::filterMatch($x->get($xatt1), $filter)) {
						#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:120: characters 10-48
						return CheckResult::CInvalidAttrib($name, $x, $filter);
					}
					#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:121: characters 9-28
					$attribs1->remove($att);
					#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:122: characters 9-21
					$found = true;
				}
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:124: lines 124-125
				if (!$found) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:125: characters 7-35
					return CheckResult::CExtraAttrib($xatt1, $x);
				}
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:128: lines 128-133
			$_g = 0;
			while ($_g < $attribs1->length) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:128: characters 10-13
				$att = ($attribs1->arr[$_g] ?? null);
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:128: lines 128-133
				++$_g;
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:130: characters 22-23
				$_g1 = $att->params[1];
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:130: characters 16-20
				$name = $att->params[0];
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:130: characters 25-33
				$defvalue = $att->params[2];
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:131: lines 131-132
				if ($defvalue === null) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:132: characters 9-39
					return CheckResult::CMissingAttrib($name, $x);
				}
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:135: lines 135-136
			if ($childs === null) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:136: characters 6-24
				$childs = Rule::RList(new Array_hx());
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:137: characters 23-35
			if (($x->nodeType !== Xml::$Document) && ($x->nodeType !== Xml::$Element)) {
				throw Exception::thrown("Bad node type, expected Element or Document but found " . ((($x->nodeType === null ? "null" : XmlType_Impl_::toString($x->nodeType)))??'null'));
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:137: characters 5-45
			$m = Check::checkList(new ArrayIterator($x->children), $childs);
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:138: lines 138-139
			if ($m !== CheckResult::CMatch()) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:139: characters 6-29
				return CheckResult::CInElement($x, $m);
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:141: lines 141-145
			$_g = 0;
			while ($_g < $attribs1->length) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:141: characters 10-13
				$att = ($attribs1->arr[$_g] ?? null);
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:141: lines 141-145
				++$_g;
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:143: characters 22-23
				$_g1 = $att->params[1];
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:143: characters 16-20
				$name = $att->params[0];
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:143: characters 25-33
				$defvalue = $att->params[2];
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:144: characters 8-29
				$x->set($name, $defvalue);
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:146: characters 5-18
			return CheckResult::CMatch();
		} else if ($__hx__switch === 1) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:148: characters 15-21
			$filter = $r->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:149: lines 149-150
			if (($x->nodeType !== Xml::$PCData) && ($x->nodeType !== Xml::$CData)) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:150: characters 6-29
				return CheckResult::CDataExpected($x);
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:151: characters 9-60
			$tmp = null;
			if ($filter !== null) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:151: characters 40-51
				if (($x->nodeType === Xml::$Document) || ($x->nodeType === Xml::$Element)) {
					throw Exception::thrown("Bad node type, unexpected " . ((($x->nodeType === null ? "null" : XmlType_Impl_::toString($x->nodeType)))??'null'));
				}
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:151: characters 9-60
				$tmp = !Check::filterMatch($x->nodeValue, $filter);
			} else {
				$tmp = false;
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:151: lines 151-152
			if ($tmp) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:152: characters 6-36
				return CheckResult::CInvalidData($x, $filter);
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:153: characters 5-18
			return CheckResult::CMatch();
		} else if ($__hx__switch === 4) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:155: characters 17-24
			$choices = $r->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:156: lines 156-157
			if ($choices->length === 0) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:157: characters 6-11
				throw Exception::thrown("No choice possible");
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:158: lines 158-160
			$_g = 0;
			while ($_g < $choices->length) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:158: characters 10-11
				$c = ($choices->arr[$_g] ?? null);
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:158: lines 158-160
				++$_g;
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:159: lines 159-160
				if (Check::check($x, $c) === CheckResult::CMatch()) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:160: characters 7-20
					return CheckResult::CMatch();
				}
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:161: characters 5-32
			return Check::check($x, ($choices->arr[0] ?? null));
		} else if ($__hx__switch === 5) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:162: characters 19-20
			$r1 = $r->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:163: characters 5-23
			return Check::check($x, $r1);
		} else {
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:165: characters 5-10
			throw Exception::thrown("Unexpected " . Std::string($r));
		}
	}

	/**
	 * @param Xml $x
	 * @param Rule $r
	 * 
	 * @return void
	 */
	public static function checkDocument ($x, $r) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:322: lines 322-323
		if ($x->nodeType !== Xml::$Document) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:323: characters 4-9
			throw Exception::thrown("Document expected");
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:324: characters 21-33
		if (($x->nodeType !== Xml::$Document) && ($x->nodeType !== Xml::$Element)) {
			throw Exception::thrown("Bad node type, expected Element or Document but found " . ((($x->nodeType === null ? "null" : XmlType_Impl_::toString($x->nodeType)))??'null'));
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:324: characters 3-38
		$m = Check::checkList(new ArrayIterator($x->children), $r);
		#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:325: lines 325-326
		if ($m === CheckResult::CMatch()) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:326: characters 4-10
			return;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:327: characters 3-8
		throw Exception::thrown(Check::makeError($m));
	}

	/**
	 * @param object $it
	 * @param Rule $r
	 * 
	 * @return CheckResult
	 */
	public static function checkList ($it, $r) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:170: lines 170-239
		$__hx__switch = ($r->index);
		if ($__hx__switch === 2) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:203: characters 16-17
			$r1 = $r->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:203: characters 19-22
			$one = $r->params[1];
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:204: characters 5-23
			$found = false;
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:205: characters 15-17
			$x = $it;
			while ($x->hasNext()) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:205: lines 205-212
				$x1 = $x->next();
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:206: lines 206-207
				if (Check::isBlank($x1)) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:207: characters 7-15
					continue;
				}
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:208: characters 6-43
				$m = Check::checkList(new ArrayIterator(Array_hx::wrap([$x1])), $r1);
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:209: lines 209-210
				if ($m !== CheckResult::CMatch()) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:210: characters 7-15
					return $m;
				}
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:211: characters 6-18
				$found = true;
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:213: lines 213-214
			if ($one && !$found) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:214: characters 6-24
				return CheckResult::CMissing($r1);
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:215: characters 5-18
			return CheckResult::CMatch();
		} else if ($__hx__switch === 3) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:171: characters 15-20
			$rules = $r->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:171: characters 22-29
			$ordered = $r->params[1];
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:172: characters 5-30
			$rules1 = (clone $rules);
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:173: characters 15-17
			$x = $it;
			while ($x->hasNext()) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:173: lines 173-198
				$x1 = $x->next();
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:174: lines 174-175
				if (Check::isBlank($x1)) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:175: characters 7-15
					continue;
				}
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:176: characters 6-24
				$found = false;
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:177: lines 177-195
				$_g = 0;
				while ($_g < $rules1->length) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:177: characters 11-12
					$r1 = ($rules1->arr[$_g] ?? null);
					#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:177: lines 177-195
					++$_g;
					#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:178: characters 7-44
					$m = Check::checkList(new ArrayIterator(Array_hx::wrap([$x1])), $r1);
					#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:179: lines 179-194
					if ($m === CheckResult::CMatch()) {
						#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:180: characters 8-20
						$found = true;
						#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:181: lines 181-191
						if ($r1->index === 2) {
							#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:182: characters 21-25
							$rsub = $r1->params[0];
							#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:182: characters 27-30
							$one = $r1->params[1];
							#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:183: lines 183-188
							if ($one) {
								#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:184: characters 11-17
								$i = null;
								#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:185: characters 21-25
								$_g1 = 0;
								#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:185: characters 25-37
								$_g2 = $rules1->length;
								#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:185: lines 185-187
								while ($_g1 < $_g2) {
									#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:185: characters 21-37
									$i1 = $_g1++;
									#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:186: lines 186-187
									if (($rules1->arr[$i1] ?? null) === $r1) {
										#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:187: characters 13-36
										$rules1->offsetSet($i1, Rule::RMulti($rsub));
									}
								}
							}
						} else {
							#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:190: characters 10-25
							$rules1->remove($r1);
						}
						#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:192: characters 8-13
						break;
					} else if ($ordered && !Check::isNullable($r1)) {
						#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:194: characters 8-16
						return $m;
					}
				}
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:196: lines 196-197
				if (!$found) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:197: characters 7-23
					return CheckResult::CExtra($x1);
				}
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:199: lines 199-201
			$_g = 0;
			while ($_g < $rules1->length) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:199: characters 10-11
				$r1 = ($rules1->arr[$_g] ?? null);
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:199: lines 199-201
				++$_g;
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:200: lines 200-201
				if (!Check::isNullable($r1)) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:201: characters 7-25
					return CheckResult::CMissing($r1);
				}
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:202: characters 5-18
			return CheckResult::CMatch();
		} else {
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:217: characters 5-23
			$found = false;
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:218: characters 15-17
			$x = $it;
			while ($x->hasNext()) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:218: lines 218-226
				$x1 = $x->next();
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:219: lines 219-220
				if (Check::isBlank($x1)) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:220: characters 7-15
					continue;
				}
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:221: characters 6-26
				$m = Check::check($x1, $r);
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:222: lines 222-223
				if ($m !== CheckResult::CMatch()) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:223: characters 7-15
					return $m;
				}
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:224: characters 6-18
				$found = true;
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:225: characters 6-11
				break;
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:227: lines 227-232
			if (!$found) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:228: lines 228-231
				if ($r->index === 5) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:229: characters 22-23
					$_g = $r->params[0];
				} else {
					#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:230: characters 16-34
					return CheckResult::CMissing($r);
				}
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:233: characters 15-17
			$x = $it;
			while ($x->hasNext()) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:233: lines 233-237
				$x1 = $x->next();
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:234: lines 234-235
				if (Check::isBlank($x1)) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:235: characters 7-15
					continue;
				}
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:236: characters 6-22
				return CheckResult::CExtra($x1);
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:238: characters 5-18
			return CheckResult::CMatch();
		}
	}

	/**
	 * @param Xml $x
	 * @param Rule $r
	 * 
	 * @return void
	 */
	public static function checkNode ($x, $r) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:315: characters 3-40
		$m = Check::checkList(new ArrayIterator(Array_hx::wrap([$x])), $r);
		#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:316: lines 316-317
		if ($m === CheckResult::CMatch()) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:317: characters 4-10
			return;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:318: characters 3-8
		throw Exception::thrown(Check::makeError($m));
	}

	/**
	 * @param string $s
	 * @param Filter $f
	 * 
	 * @return bool
	 */
	public static function filterMatch ($s, $f) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:66: lines 66-78
		$__hx__switch = ($f->index);
		if ($__hx__switch === 0) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:68: characters 5-43
			return Check::filterMatch($s, Filter::FReg(new EReg("[0-9]+", "")));
		} else if ($__hx__switch === 1) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:70: characters 5-62
			return Check::filterMatch($s, Filter::FEnum(Array_hx::wrap([
				"true",
				"false",
				"0",
				"1",
			])));
		} else if ($__hx__switch === 2) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:71: characters 15-21
			$values = $f->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:72: lines 72-74
			$_g = 0;
			while ($_g < $values->length) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:72: characters 10-11
				$v = ($values->arr[$_g] ?? null);
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:72: lines 72-74
				++$_g;
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:73: lines 73-74
				if ($s === $v) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:74: characters 7-18
					return true;
				}
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:75: characters 5-17
			return false;
		} else if ($__hx__switch === 3) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:76: characters 14-15
			$r = $f->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:77: characters 5-22
			return $r->match($s);
		}
	}

	/**
	 * @param Xml $x
	 * 
	 * @return bool
	 */
	public static function isBlank ($x) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:62: characters 10-65
		$tmp = null;
		if ($x->nodeType === Xml::$PCData) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:62: characters 39-45
			$tmp1 = Check::$blanks;
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:62: characters 52-63
			if (($x->nodeType === Xml::$Document) || ($x->nodeType === Xml::$Element)) {
				throw Exception::thrown("Bad node type, unexpected " . ((($x->nodeType === null ? "null" : XmlType_Impl_::toString($x->nodeType)))??'null'));
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:62: characters 10-65
			$tmp = $tmp1->match($x->nodeValue);
		} else {
			$tmp = false;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:62: characters 10-94
		if (!$tmp) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:62: characters 69-94
			return $x->nodeType === Xml::$Comment;
		} else {
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:62: characters 10-94
			return true;
		}
	}

	/**
	 * @param Rule $r
	 * 
	 * @return bool
	 */
	public static function isNullable ($r) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:82: lines 82-101
		$__hx__switch = ($r->index);
		if ($__hx__switch === 0) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:97: characters 15-16
			$_g = $r->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:97: characters 18-19
			$_g = $r->params[1];
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:97: characters 21-22
			$_g = $r->params[2];
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:98: characters 5-17
			return false;
		} else if ($__hx__switch === 1) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:95: characters 15-16
			$_g = $r->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:96: characters 5-17
			return false;
		} else if ($__hx__switch === 2) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:83: characters 16-17
			$r1 = $r->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:83: characters 19-22
			$one = $r->params[1];
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:84: characters 12-42
			if ($one === true) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:84: characters 28-41
				return Check::isNullable($r1);
			} else {
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:84: characters 12-42
				return true;
			}
		} else if ($__hx__switch === 3) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:85: characters 19-20
			$_g = $r->params[1];
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:85: characters 15-17
			$rl = $r->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:86: lines 86-88
			$_g = 0;
			while ($_g < $rl->length) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:86: characters 10-11
				$r1 = ($rl->arr[$_g] ?? null);
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:86: lines 86-88
				++$_g;
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:87: lines 87-88
				if (!Check::isNullable($r1)) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:88: characters 7-19
					return false;
				}
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:89: characters 5-16
			return true;
		} else if ($__hx__switch === 4) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:90: characters 17-19
			$rl = $r->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:91: lines 91-93
			$_g = 0;
			while ($_g < $rl->length) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:91: characters 10-11
				$r1 = ($rl->arr[$_g] ?? null);
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:91: lines 91-93
				++$_g;
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:92: lines 92-93
				if (Check::isNullable($r1)) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:93: characters 7-18
					return true;
				}
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:94: characters 5-17
			return false;
		} else if ($__hx__switch === 5) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:99: characters 19-20
			$_g = $r->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:100: characters 5-16
			return true;
		}
	}

	/**
	 * @param CheckResult $m
	 * @param Xml[]|Array_hx $path
	 * 
	 * @return string
	 */
	public static function makeError ($m, $path = null) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:284: lines 284-285
		if ($path === null) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:285: characters 4-22
			$path = new Array_hx();
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:286: lines 286-311
		$__hx__switch = ($m->index);
		if ($__hx__switch === 0) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:288: characters 5-10
			throw Exception::thrown("assert");
		} else if ($__hx__switch === 1) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:289: characters 18-19
			$r = $m->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:290: characters 5-54
			return (Check::makeWhere($path)??'null') . "Missing " . (Check::makeRule($r)??'null');
		} else if ($__hx__switch === 2) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:291: characters 16-17
			$x = $m->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:292: characters 5-59
			return (Check::makeWhere($path)??'null') . "Unexpected " . (Check::makeString($x)??'null');
		} else if ($__hx__switch === 3) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:293: characters 26-30
			$name = $m->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:293: characters 32-33
			$x = $m->params[1];
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:294: characters 5-79
			return (Check::makeWhere($path)??'null') . (Check::makeString($x)??'null') . " while expected element " . ($name??'null');
		} else if ($__hx__switch === 4) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:295: characters 23-24
			$x = $m->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:296: characters 5-68
			return (Check::makeWhere($path)??'null') . (Check::makeString($x)??'null') . " while data expected";
		} else if ($__hx__switch === 5) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:297: characters 22-25
			$att = $m->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:297: characters 27-28
			$x = $m->params[1];
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:298: characters 5-17
			$path->arr[$path->length++] = $x;
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:299: characters 5-59
			return (Check::makeWhere($path)??'null') . "unexpected attribute " . ($att??'null');
		} else if ($__hx__switch === 6) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:300: characters 24-27
			$att = $m->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:300: characters 29-30
			$x = $m->params[1];
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:301: characters 5-17
			$path->arr[$path->length++] = $x;
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:302: characters 5-65
			return (Check::makeWhere($path)??'null') . "missing required attribute " . ($att??'null');
		} else if ($__hx__switch === 7) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:303: characters 32-33
			$_g = $m->params[2];
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:303: characters 24-27
			$att = $m->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:303: characters 29-30
			$x = $m->params[1];
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:304: characters 5-17
			$path->arr[$path->length++] = $x;
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:305: characters 5-66
			return (Check::makeWhere($path)??'null') . "invalid attribute value for " . ($att??'null');
		} else if ($__hx__switch === 8) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:306: characters 25-26
			$_g = $m->params[1];
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:306: characters 22-23
			$x = $m->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:307: characters 5-72
			return (Check::makeWhere($path)??'null') . "invalid data format for " . (Check::makeString($x)??'null');
		} else if ($__hx__switch === 9) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:308: characters 20-21
			$x = $m->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:308: characters 23-24
			$m1 = $m->params[1];
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:309: characters 5-17
			$path->arr[$path->length++] = $x;
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:310: characters 5-30
			return Check::makeError($m1, $path);
		}
	}

	/**
	 * @param Rule $r
	 * 
	 * @return string
	 */
	public static function makeRule ($r) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:267: lines 267-280
		$__hx__switch = ($r->index);
		if ($__hx__switch === 0) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:268: characters 21-22
			$_g = $r->params[1];
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:268: characters 24-25
			$_g = $r->params[2];
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:268: characters 15-19
			$name = $r->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:269: characters 5-29
			return "element " . ($name??'null');
		} else if ($__hx__switch === 1) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:270: characters 15-16
			$_g = $r->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:271: characters 5-18
			return "data";
		} else if ($__hx__switch === 2) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:272: characters 19-20
			$_g = $r->params[1];
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:272: characters 16-17
			$r1 = $r->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:273: characters 5-23
			return Check::makeRule($r1);
		} else if ($__hx__switch === 3) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:274: characters 22-23
			$_g = $r->params[1];
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:274: characters 15-20
			$rules = $r->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:275: characters 5-30
			return Check::makeRule(($rules->arr[0] ?? null));
		} else if ($__hx__switch === 4) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:276: characters 17-24
			$choices = $r->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:277: characters 5-32
			return Check::makeRule(($choices->arr[0] ?? null));
		} else if ($__hx__switch === 5) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:278: characters 19-20
			$r1 = $r->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:279: characters 5-23
			return Check::makeRule($r1);
		}
	}

	/**
	 * @param Xml $x
	 * 
	 * @return string
	 */
	public static function makeString ($x) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:258: lines 258-259
		if ($x->nodeType === Xml::$Element) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:259: characters 24-34
			if ($x->nodeType !== Xml::$Element) {
				throw Exception::thrown("Bad node type, expected Element but found " . ((($x->nodeType === null ? "null" : XmlType_Impl_::toString($x->nodeType)))??'null'));
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:259: characters 4-34
			return "element " . ($x->nodeName??'null');
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:260: characters 11-28
		if (($x->nodeType === Xml::$Document) || ($x->nodeType === Xml::$Element)) {
			throw Exception::thrown("Bad node type, unexpected " . ((($x->nodeType === null ? "null" : XmlType_Impl_::toString($x->nodeType)))??'null'));
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:260: characters 3-95
		$s = HxString::split(HxString::split(HxString::split($x->nodeValue, "\x0D")->join("\\r"), "\x0A")->join("\\n"), "\x09")->join("\\t");
		#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:261: lines 261-262
		if (mb_strlen($s) > 20) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:262: characters 4-34
			return (\mb_substr($s, 0, 17)??'null') . "...";
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:263: characters 3-11
		return $s;
	}

	/**
	 * @param Xml[]|Array_hx $path
	 * 
	 * @return string
	 */
	public static function makeWhere ($path) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:243: lines 243-244
		if ($path->length === 0) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:244: characters 4-13
			return "";
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:245: characters 3-17
		$s = "In ";
		#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:246: characters 3-20
		$first = true;
		#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:247: lines 247-253
		$_g = 0;
		while ($_g < $path->length) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:247: characters 8-9
			$x = ($path->arr[$_g] ?? null);
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:247: lines 247-253
			++$_g;
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:248: lines 248-251
			if ($first) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:249: characters 5-18
				$first = false;
			} else {
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:251: characters 5-13
				$s = ($s??'null') . ".";
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:252: characters 9-19
			if ($x->nodeType !== Xml::$Element) {
				throw Exception::thrown("Bad node type, expected Element but found " . ((($x->nodeType === null ? "null" : XmlType_Impl_::toString($x->nodeType)))??'null'));
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:252: characters 4-19
			$s = ($s??'null') . ($x->nodeName??'null');
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Check.hx:254: characters 3-18
		return ($s??'null') . ": ";
	}

	/**
	 * @internal
	 * @access private
	 */
	static public function __hx__init ()
	{
		static $called = false;
		if ($called) return;
		$called = true;


		self::$blanks = new EReg("^[ \x0D\x0A\x09]*\$", "");
	}
}

Boot::registerClass(Check::class, 'haxe.xml.Check');
Check::__hx__init();
