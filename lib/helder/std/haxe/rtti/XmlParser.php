<?php
/**
 */

namespace helder\std\haxe\rtti;

use \helder\std\php\_Boot\HxAnon;
use \helder\std\haxe\xml\_Access\HasAttribAccess_Impl_;
use \helder\std\php\Boot;
use \helder\std\haxe\Exception;
use \helder\std\Array_hx;
use \helder\std\Xml;
use \helder\std\haxe\xml\_Access\NodeListAccess_Impl_;
use \helder\std\haxe\xml\_Access\AttribAccess_Impl_;
use \helder\std\haxe\xml\_Access\HasNodeAccess_Impl_;
use \helder\std\Std;
use \helder\std\_Xml\XmlType_Impl_;
use \helder\std\php\_Boot\HxString;
use \helder\std\Type;
use \helder\std\php\_Boot\HxClosure;
use \helder\std\haxe\ds\StringMap;
use \helder\std\haxe\xml\_Access\NodeAccess_Impl_;
use \helder\std\haxe\xml\_Access\Access_Impl_;
use \helder\std\haxe\iterators\ArrayIterator;

/**
 * XmlParser processes the runtime type information (RTTI) which
 * is stored as a XML string in a static field `__rtti`.
 * @see <https://haxe.org/manual/cr-rtti.html>
 */
class XmlParser {
	/**
	 * @var string
	 */
	public $curplatform;
	/**
	 * @var \Closure
	 */
	public $newField;
	/**
	 * @var TypeTree[]|Array_hx
	 */
	public $root;

	/**
	 * @return void
	 */
	public function __construct () {
		if (!$this->__hx__default__newField) {
			$this->__hx__default__newField = new HxClosure($this, 'newField');
			if ($this->newField === null) $this->newField = $this->__hx__default__newField;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:40: characters 3-21
		$this->root = new Array_hx();
	}

	/**
	 * @return string[]|Array_hx
	 */
	public function defplat () {
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:632: characters 3-23
		$l = new Array_hx();
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:633: lines 633-634
		if ($this->curplatform !== null) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:634: characters 4-23
			$l->arr[$l->length++] = $this->curplatform;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:635: characters 3-11
		return $l;
	}

	/**
	 * @param TypeTree $t
	 * 
	 * @return void
	 */
	public function merge ($t) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:204: characters 3-34
		$inf = TypeApi::typeInfos($t);
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:205: characters 3-34
		$pack = HxString::split($inf->path, ".");
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:206: characters 3-18
		$cur = $this->root;
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:207: characters 3-29
		$curpack = new Array_hx();
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:208: characters 3-13
		if ($pack->length > 0) {
			$pack->length--;
		}
		\array_pop($pack->arr);
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:209: lines 209-227
		$_g = 0;
		while ($_g < $pack->length) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:209: characters 8-9
			$p = ($pack->arr[$_g] ?? null);
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:209: lines 209-227
			++$_g;
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:210: characters 4-22
			$found = false;
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:211: lines 211-220
			$_g1 = 0;
			while ($_g1 < $cur->length) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:211: characters 9-11
				$pk = ($cur->arr[$_g1] ?? null);
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:211: lines 211-220
				++$_g1;
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:212: lines 212-220
				if ($pk->index === 0) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:213: characters 27-28
					$_g2 = $pk->params[1];
					#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:213: characters 20-25
					$pname = $pk->params[0];
					#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:213: characters 30-34
					$subs = $pk->params[2];
					#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:214: lines 214-218
					if ($pname === $p) {
						#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:215: characters 8-20
						$found = true;
						#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:216: characters 8-18
						$cur = $subs;
						#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:217: characters 8-13
						break;
					}
				}
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:221: characters 4-19
			$curpack->arr[$curpack->length++] = $p;
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:222: lines 222-226
			if (!$found) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:223: characters 5-26
				$pk1 = new Array_hx();
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:224: characters 5-49
				$x = TypeTree::TPackage($p, $curpack->join("."), $pk1);
				$cur->arr[$cur->length++] = $x;
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:225: characters 5-13
				$cur = $pk1;
			}
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:228: lines 228-291
		$_g = 0;
		while ($_g < $cur->length) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:228: characters 8-10
			$ct = ($cur->arr[$_g] ?? null);
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:228: lines 228-291
			++$_g;
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:229: characters 8-16
			$tmp = null;
			if ($ct->index === 0) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:229: characters 26-27
				$_g1 = $ct->params[0];
				$_g2 = $ct->params[1];
				$_g3 = $ct->params[2];
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:229: characters 8-16
				$tmp = true;
			} else {
				$tmp = false;
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:229: lines 229-230
			if ($tmp) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:230: characters 5-13
				continue;
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:231: characters 4-37
			$tinf = TypeApi::typeInfos($ct);
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:234: lines 234-290
			if ($tinf->path === $inf->path) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:235: characters 5-25
				$sameType = true;
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:236: lines 236-241
				if (($tinf->doc === null) !== ($inf->doc === null)) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:237: lines 237-240
					if ($inf->doc === null) {
						#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:238: characters 7-25
						$inf->doc = $tinf->doc;
					} else {
						#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:240: characters 7-25
						$tinf->doc = $inf->doc;
					}
				}
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:242: lines 242-243
				if ($tinf->path === "haxe._Int64.NativeInt64") {
					#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:243: characters 6-14
					continue;
				}
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:244: lines 244-279
				if (($tinf->module === $inf->module) && ($tinf->doc === $inf->doc) && ($tinf->isPrivate === $inf->isPrivate)) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:245: lines 245-279
					$__hx__switch = ($ct->index);
					if ($__hx__switch === 0) {
						#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:277: characters 21-22
						$_g4 = $ct->params[0];
						#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:277: characters 24-25
						$_g5 = $ct->params[1];
						#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:277: characters 27-28
						$_g6 = $ct->params[2];
						#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:278: characters 8-24
						$sameType = false;
					} else if ($__hx__switch === 1) {
						#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:246: characters 23-24
						$c = $ct->params[0];
						#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:247: lines 247-253
						if ($t->index === 1) {
							#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:248: characters 25-27
							$c2 = $t->params[0];
							#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:249: lines 249-250
							if ($this->mergeClasses($c, $c2)) {
								#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:250: characters 11-17
								return;
							}
						} else {
							#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:252: characters 10-26
							$sameType = false;
						}
					} else if ($__hx__switch === 2) {
						#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:254: characters 22-23
						$e = $ct->params[0];
						#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:255: lines 255-261
						if ($t->index === 2) {
							#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:256: characters 24-26
							$e2 = $t->params[0];
							#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:257: lines 257-258
							if ($this->mergeEnums($e, $e2)) {
								#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:258: characters 11-17
								return;
							}
						} else {
							#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:260: characters 10-26
							$sameType = false;
						}
					} else if ($__hx__switch === 3) {
						#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:262: characters 22-24
						$td = $ct->params[0];
						#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:263: lines 263-268
						if ($t->index === 3) {
							#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:264: characters 24-27
							$td2 = $t->params[0];
							#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:265: lines 265-266
							if ($this->mergeTypedefs($td, $td2)) {
								#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:266: characters 11-17
								return;
							}
						}
					} else if ($__hx__switch === 4) {
						#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:269: characters 26-27
						$a = $ct->params[0];
						#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:270: lines 270-276
						if ($t->index === 4) {
							#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:271: characters 28-30
							$a2 = $t->params[0];
							#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:272: lines 272-273
							if ($this->mergeAbstracts($a, $a2)) {
								#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:273: characters 11-17
								return;
							}
						} else {
							#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:275: characters 10-26
							$sameType = false;
						}
					}
				}
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:281: lines 281-288
				$msg = ($tinf->module !== $inf->module ? "module " . ($inf->module??'null') . " should be " . ($tinf->module??'null') : ($tinf->doc !== $inf->doc ? "documentation is different" : ($tinf->isPrivate !== $inf->isPrivate ? "private flag is different" : (!$sameType ? "type kind is different" : "could not merge definition"))));
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:289: characters 5-10
				throw Exception::thrown("Incompatibilities between " . ($tinf->path??'null') . " in " . ($tinf->platforms->join(",")??'null') . " and " . ($this->curplatform??'null') . " (" . ($msg??'null') . ")");
			}
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:292: characters 3-14
		$cur->arr[$cur->length++] = $t;
	}

	/**
	 * @param object $a
	 * @param object $a2
	 * 
	 * @return bool
	 */
	public function mergeAbstracts ($a, $a2) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:187: lines 187-188
		if ($this->curplatform === null) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:188: characters 4-16
			return false;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:189: lines 189-190
		if (($a->to->length !== $a2->to->length) || ($a->from->length !== $a2->from->length)) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:190: characters 4-16
			return false;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:191: characters 13-17
		$_g = 0;
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:191: characters 17-28
		$_g1 = $a->to->length;
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:191: lines 191-193
		while ($_g < $_g1) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:191: characters 13-28
			$i = $_g++;
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:192: lines 192-193
			if (!TypeApi::typeEq(($a->to->arr[$i] ?? null)->t, ($a2->to->arr[$i] ?? null)->t)) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:193: characters 5-17
				return false;
			}
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:194: characters 13-17
		$_g = 0;
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:194: characters 17-30
		$_g1 = $a->from->length;
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:194: lines 194-196
		while ($_g < $_g1) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:194: characters 13-30
			$i = $_g++;
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:195: lines 195-196
			if (!TypeApi::typeEq(($a->from->arr[$i] ?? null)->t, ($a2->from->arr[$i] ?? null)->t)) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:196: characters 5-17
				return false;
			}
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:197: lines 197-198
		if ($a2->impl !== null) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:198: characters 4-33
			$this->mergeClasses($a->impl, $a2->impl);
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:199: characters 3-32
		$_this = $a->platforms;
		$_this->arr[$_this->length++] = $this->curplatform;
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:200: characters 3-14
		return true;
	}

	/**
	 * @param object $c
	 * @param object $c2
	 * 
	 * @return bool
	 */
	public function mergeClasses ($c, $c2) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:122: lines 122-123
		if ($c->isInterface !== $c2->isInterface) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:123: characters 4-16
			return false;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:124: lines 124-125
		if ($this->curplatform !== null) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:125: characters 4-33
			$_this = $c->platforms;
			$_this->arr[$_this->length++] = $this->curplatform;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:126: lines 126-127
		if ($c->isExtern !== $c2->isExtern) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:127: characters 4-22
			$c->isExtern = false;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:129: lines 129-141
		$_g = 0;
		$_g1 = $c2->fields;
		while ($_g < $_g1->length) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:129: characters 8-10
			$f2 = ($_g1->arr[$_g] ?? null);
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:129: lines 129-141
			++$_g;
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:130: characters 4-21
			$found = null;
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:131: lines 131-135
			$_g2 = 0;
			$_g3 = $c->fields;
			while ($_g2 < $_g3->length) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:131: characters 9-10
				$f = ($_g3->arr[$_g2] ?? null);
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:131: lines 131-135
				++$_g2;
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:132: lines 132-135
				if ($this->mergeFields($f, $f2)) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:133: characters 6-15
					$found = $f;
					#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:134: characters 6-11
					break;
				}
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:136: lines 136-140
			if ($found === null) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:137: characters 5-20
				$this->newField($c, $f2);
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:138: characters 5-22
				$_this = $c->fields;
				$_this->arr[$_this->length++] = $f2;
			} else if ($this->curplatform !== null) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:140: characters 5-38
				$_this1 = $found->platforms;
				$_this1->arr[$_this1->length++] = $this->curplatform;
			}
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:142: lines 142-154
		$_g = 0;
		$_g1 = $c2->statics;
		while ($_g < $_g1->length) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:142: characters 8-10
			$f2 = ($_g1->arr[$_g] ?? null);
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:142: lines 142-154
			++$_g;
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:143: characters 4-21
			$found = null;
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:144: lines 144-148
			$_g2 = 0;
			$_g3 = $c->statics;
			while ($_g2 < $_g3->length) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:144: characters 9-10
				$f = ($_g3->arr[$_g2] ?? null);
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:144: lines 144-148
				++$_g2;
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:145: lines 145-148
				if ($this->mergeFields($f, $f2)) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:146: characters 6-15
					$found = $f;
					#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:147: characters 6-11
					break;
				}
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:149: lines 149-153
			if ($found === null) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:150: characters 5-20
				$this->newField($c, $f2);
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:151: characters 5-23
				$_this = $c->statics;
				$_this->arr[$_this->length++] = $f2;
			} else if ($this->curplatform !== null) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:153: characters 5-38
				$_this1 = $found->platforms;
				$_this1->arr[$_this1->length++] = $this->curplatform;
			}
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:155: characters 3-14
		return true;
	}

	/**
	 * @param object $f1
	 * @param object $f2
	 * 
	 * @return bool
	 */
	public function mergeDoc ($f1, $f2) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:106: lines 106-109
		if ($f1->doc === null) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:107: characters 4-19
			$f1->doc = $f2->doc;
		} else if ($f2->doc === null) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:109: characters 4-19
			$f2->doc = $f1->doc;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:110: characters 3-14
		return true;
	}

	/**
	 * @param object $e
	 * @param object $e2
	 * 
	 * @return bool
	 */
	public function mergeEnums ($e, $e2) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:159: lines 159-160
		if ($e->isExtern !== $e2->isExtern) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:160: characters 4-16
			return false;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:161: lines 161-162
		if ($this->curplatform !== null) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:162: characters 4-33
			$_this = $e->platforms;
			$_this->arr[$_this->length++] = $this->curplatform;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:163: lines 163-174
		$_g = 0;
		$_g1 = $e2->constructors;
		while ($_g < $_g1->length) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:163: characters 8-10
			$c2 = ($_g1->arr[$_g] ?? null);
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:163: lines 163-174
			++$_g;
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:164: characters 4-21
			$found = null;
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:165: lines 165-169
			$_g2 = 0;
			$_g3 = $e->constructors;
			while ($_g2 < $_g3->length) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:165: characters 9-10
				$c = ($_g3->arr[$_g2] ?? null);
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:165: lines 165-169
				++$_g2;
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:166: lines 166-169
				if (TypeApi::constructorEq($c, $c2)) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:167: characters 6-15
					$found = $c;
					#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:168: characters 6-11
					break;
				}
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:170: lines 170-173
			if ($found === null) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:171: characters 5-28
				$_this = $e->constructors;
				$_this->arr[$_this->length++] = $c2;
			} else if ($this->curplatform !== null) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:173: characters 5-38
				$_this1 = $found->platforms;
				$_this1->arr[$_this1->length++] = $this->curplatform;
			}
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:175: characters 3-14
		return true;
	}

	/**
	 * @param object $f
	 * @param object $f2
	 * 
	 * @return bool
	 */
	public function mergeFields ($f, $f2) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:114: lines 114-115
		if (!TypeApi::fieldEq($f, $f2)) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:115: characters 7-117
			if (($f->name === $f2->name) && ($this->mergeRights($f, $f2) || $this->mergeRights($f2, $f)) && $this->mergeDoc($f, $f2)) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:115: characters 94-116
				return TypeApi::fieldEq($f, $f2);
			} else {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:115: characters 7-117
				return false;
			}
		} else {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:114: lines 114-115
			return true;
		}
	}

	/**
	 * @param object $f1
	 * @param object $f2
	 * 
	 * @return bool
	 */
	public function mergeRights ($f1, $f2) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:97: lines 97-101
		if (($f1->get === Rights::RInline()) && ($f1->set === Rights::RNo()) && ($f2->get === Rights::RNormal()) && ($f2->set === Rights::RMethod())) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:98: characters 4-20
			$f1->get = Rights::RNormal();
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:99: characters 4-20
			$f1->set = Rights::RMethod();
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:100: characters 4-15
			return true;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:102: characters 10-68
		if (Type::enumEq($f1->get, $f2->get)) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:102: characters 41-68
			return Type::enumEq($f1->set, $f2->set);
		} else {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:102: characters 10-68
			return false;
		}
	}

	/**
	 * @param object $t
	 * @param object $t2
	 * 
	 * @return bool
	 */
	public function mergeTypedefs ($t, $t2) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:179: lines 179-180
		if ($this->curplatform === null) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:180: characters 4-16
			return false;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:181: characters 3-32
		$_this = $t->platforms;
		$_this->arr[$_this->length++] = $this->curplatform;
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:182: characters 3-36
		$t->types->data[$this->curplatform] = $t2->type;
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:183: characters 3-14
		return true;
	}

	/**
	 * @param string $p
	 * 
	 * @return string
	 */
	public function mkPath ($p) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:296: characters 3-11
		return $p;
	}

	/**
	 * @param string $r
	 * 
	 * @return Rights
	 */
	public function mkRights ($r) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:307: lines 307-313
		if ($r === "dynamic") {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:310: characters 20-28
			return Rights::RDynamic();
		} else if ($r === "inline") {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:311: characters 19-26
			return Rights::RInline();
		} else if ($r === "method") {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:309: characters 19-26
			return Rights::RMethod();
		} else if ($r === "null") {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:308: characters 17-20
			return Rights::RNo();
		} else {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:312: characters 13-21
			return Rights::RCall($r);
		}
	}

	/**
	 * @param string $p
	 * 
	 * @return string[]|Array_hx
	 */
	public function mkTypeParams ($p) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:300: characters 3-25
		$pl = HxString::split($p, ":");
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:301: lines 301-302
		if (($pl->arr[0] ?? null) === "") {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:302: characters 4-22
			return new Array_hx();
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:303: characters 3-12
		return $pl;
	}

	/**
	 * @param object $c
	 * @param object $f
	 * 
	 * @return void
	 */
	public function newField ($c, $f)
	{
		if ($this->newField !== $this->__hx__default__newField) return call_user_func_array($this->newField, func_get_args());
	}
	protected $__hx__default__newField;

	/**
	 * @param Xml $x
	 * @param string $platform
	 * 
	 * @return void
	 */
	public function process ($x, $platform) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:91: characters 3-25
		$this->curplatform = $platform;
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:92: characters 9-22
		if (($x->nodeType !== Xml::$Document) && ($x->nodeType !== Xml::$Element)) {
			throw Exception::thrown("Invalid nodeType " . ((($x->nodeType === null ? "null" : XmlType_Impl_::toString($x->nodeType)))??'null'));
		}
		$this1 = $x;
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:92: characters 3-23
		$this->xroot($this1);
	}

	/**
	 * @param Xml $x
	 * 
	 * @return TypeTree
	 */
	public function processElement ($x) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:326: characters 11-33
		if (($x->nodeType !== Xml::$Document) && ($x->nodeType !== Xml::$Element)) {
			throw Exception::thrown("Invalid nodeType " . ((($x->nodeType === null ? "null" : XmlType_Impl_::toString($x->nodeType)))??'null'));
		}
		$this1 = $x;
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:326: characters 3-34
		$c = $this1;
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:327: characters 18-24
		$_g = null;
		if ($c->nodeType === Xml::$Document) {
			$_g = "Document";
		} else {
			if ($c->nodeType !== Xml::$Element) {
				throw Exception::thrown("Bad node type, expected Element but found " . ((($c->nodeType === null ? "null" : XmlType_Impl_::toString($c->nodeType)))??'null'));
			}
			$_g = $c->nodeName;
		}
		if ($_g === "abstract") {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:331: characters 21-48
			return TypeTree::TAbstractdecl($this->xabstract($c));
		} else if ($_g === "class") {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:328: characters 18-39
			return TypeTree::TClassdecl($this->xclass($c));
		} else if ($_g === "enum") {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:329: characters 17-36
			return TypeTree::TEnumdecl($this->xenum($c));
		} else if ($_g === "typedef") {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:330: characters 20-42
			return TypeTree::TTypedecl($this->xtypedef($c));
		} else {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:332: characters 13-22
			return $this->xerror($c);
		}
	}

	/**
	 * @param TypeTree[]|Array_hx $l
	 * 
	 * @return void
	 */
	public function sort ($l = null) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:44: lines 44-45
		if ($l === null) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:45: characters 4-12
			$l = $this->root;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:46: lines 46-58
		\usort($l->arr, function ($e1, $e2) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:47: lines 47-50
			$n1 = null;
			if ($e1->index === 0) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:48: characters 22-23
				$_g = $e1->params[1];
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:48: characters 25-26
				$_g = $e1->params[2];
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:48: characters 19-20
				$p = $e1->params[0];
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:47: lines 47-50
				$n1 = " " . ($p??'null');
			} else {
				$n1 = TypeApi::typeInfos($e1)->path;
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:51: lines 51-54
			$n2 = null;
			if ($e2->index === 0) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:52: characters 22-23
				$_g = $e2->params[1];
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:52: characters 25-26
				$_g = $e2->params[2];
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:52: characters 19-20
				$p = $e2->params[0];
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:51: lines 51-54
				$n2 = " " . ($p??'null');
			} else {
				$n2 = TypeApi::typeInfos($e2)->path;
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:55: lines 55-56
			if (strcmp($n1, $n2) > 0) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:56: characters 5-13
				return 1;
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:57: characters 4-13
			return -1;
		});
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:59: lines 59-69
		$_g = 0;
		while ($_g < $l->length) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:59: characters 8-9
			$x = ($l->arr[$_g] ?? null);
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:59: lines 59-69
			++$_g;
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:60: lines 60-69
			$__hx__switch = ($x->index);
			if ($__hx__switch === 0) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:61: characters 19-20
				$_g1 = $x->params[0];
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:61: characters 22-23
				$_g2 = $x->params[1];
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:61: characters 25-26
				$l1 = $x->params[2];
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:62: characters 6-13
				$this->sort($l1);
			} else if ($__hx__switch === 1) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:63: characters 21-22
				$c = $x->params[0];
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:64: characters 6-26
				$this->sortFields($c->fields);
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:65: characters 6-27
				$this->sortFields($c->statics);
			} else if ($__hx__switch === 2) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:66: characters 20-21
				$_g3 = $x->params[0];
			} else if ($__hx__switch === 3) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:68: characters 20-21
				$_g4 = $x->params[0];
			} else if ($__hx__switch === 4) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:67: characters 24-25
				$_g5 = $x->params[0];
			}
		}
	}

	/**
	 * @param object[]|Array_hx $a
	 * 
	 * @return void
	 */
	public function sortFields ($a) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:73: lines 73-87
		\usort($a->arr, function ($f1, $f2) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:74: characters 4-36
			$v1 = TypeApi::isVar($f1->type);
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:75: characters 4-36
			$v2 = TypeApi::isVar($f2->type);
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:76: lines 76-77
			if ($v1 && !$v2) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:77: characters 5-14
				return -1;
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:78: lines 78-79
			if ($v2 && !$v1) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:79: characters 5-13
				return 1;
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:80: lines 80-81
			if ($f1->name === "new") {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:81: characters 5-14
				return -1;
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:82: lines 82-83
			if ($f2->name === "new") {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:83: characters 5-13
				return 1;
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:84: lines 84-85
			if (strcmp($f1->name, $f2->name) > 0) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:85: characters 5-13
				return 1;
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:86: characters 4-13
			return -1;
		});
	}

	/**
	 * @param Xml $x
	 * 
	 * @return object
	 */
	public function xabstract ($x) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:503: characters 3-45
		$doc = null;
		$impl = null;
		$athis = null;
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:504: characters 3-37
		$meta = new Array_hx();
		$to = new Array_hx();
		$from = new Array_hx();
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:505: characters 13-23
		$c = $x->elements();
		while ($c->hasNext()) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:505: lines 505-523
			$c1 = $c->next();
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:506: characters 12-18
			$_g = null;
			if ($c1->nodeType === Xml::$Document) {
				$_g = "Document";
			} else {
				if ($c1->nodeType !== Xml::$Element) {
					throw Exception::thrown("Bad node type, expected Element but found " . ((($c1->nodeType === null ? "null" : XmlType_Impl_::toString($c1->nodeType)))??'null'));
				}
				$_g = $c1->nodeName;
			}
			if ($_g === "from") {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:515: characters 16-26
				$t = $c1->elements();
				while ($t->hasNext()) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:515: lines 515-516
					$t1 = $t->next();
					#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:516: characters 27-57
					$x1 = $t1->firstElement();
					if (($x1->nodeType !== Xml::$Document) && ($x1->nodeType !== Xml::$Element)) {
						throw Exception::thrown("Invalid nodeType " . ((($x1->nodeType === null ? "null" : XmlType_Impl_::toString($x1->nodeType)))??'null'));
					}
					$this1 = $x1;
					#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:516: characters 21-58
					$x2 = $this->xtype($this1);
					#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:516: characters 67-99
					$x3 = (HasAttribAccess_Impl_::resolve($t1, "field") ? AttribAccess_Impl_::resolve($t1, "field") : null);
					#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:516: characters 7-101
					$from->arr[$from->length++] = new _HxAnon_XmlParser0($x2, $x3);
				}
			} else if ($_g === "haxe_doc") {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:508: characters 6-23
				$doc = Access_Impl_::get_innerData($c1);
			} else if ($_g === "impl") {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:518: characters 6-44
				$impl = $this->xclass(NodeAccess_Impl_::resolve($c1, "class"));
			} else if ($_g === "meta") {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:510: characters 6-21
				$meta = $this->xmeta($c1);
			} else if ($_g === "this") {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:520: characters 20-50
				$x4 = $c1->firstElement();
				if (($x4->nodeType !== Xml::$Document) && ($x4->nodeType !== Xml::$Element)) {
					throw Exception::thrown("Invalid nodeType " . ((($x4->nodeType === null ? "null" : XmlType_Impl_::toString($x4->nodeType)))??'null'));
				}
				$this2 = $x4;
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:520: characters 6-51
				$athis = $this->xtype($this2);
			} else if ($_g === "to") {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:512: characters 16-26
				$t2 = $c1->elements();
				while ($t2->hasNext()) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:512: lines 512-513
					$t3 = $t2->next();
					#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:513: characters 25-55
					$x5 = $t3->firstElement();
					if (($x5->nodeType !== Xml::$Document) && ($x5->nodeType !== Xml::$Element)) {
						throw Exception::thrown("Invalid nodeType " . ((($x5->nodeType === null ? "null" : XmlType_Impl_::toString($x5->nodeType)))??'null'));
					}
					$this3 = $x5;
					#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:513: characters 19-56
					$x6 = $this->xtype($this3);
					#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:513: characters 65-97
					$x7 = (HasAttribAccess_Impl_::resolve($t3, "field") ? AttribAccess_Impl_::resolve($t3, "field") : null);
					#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:513: characters 7-99
					$to->arr[$to->length++] = new _HxAnon_XmlParser0($x6, $x7);
				}
			} else {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:522: characters 6-15
				$this->xerror($c1);
			}
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:525: characters 10-46
		$tmp = (HasAttribAccess_Impl_::resolve($x, "file") ? AttribAccess_Impl_::resolve($x, "file") : null);
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:526: characters 10-28
		$tmp1 = $this->mkPath(AttribAccess_Impl_::resolve($x, "path"));
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:527: characters 12-60
		$tmp2 = (HasAttribAccess_Impl_::resolve($x, "module") ? $this->mkPath(AttribAccess_Impl_::resolve($x, "module")) : null);
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:529: characters 15-36
		$tmp3 = $x->exists("private");
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:530: characters 12-38
		$tmp4 = $this->mkTypeParams(AttribAccess_Impl_::resolve($x, "params"));
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:524: lines 524-537
		return new _HxAnon_XmlParser1($tmp, $tmp1, $tmp2, $doc, $tmp3, $tmp4, $this->defplat(), $meta, $athis, $to, $from, $impl);
	}

	/**
	 * @param Xml $x
	 * 
	 * @return object
	 */
	public function xclass ($x) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:367: characters 3-21
		$csuper = null;
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:368: characters 3-18
		$doc = null;
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:369: characters 3-23
		$tdynamic = null;
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:370: characters 3-32
		$interfaces = new Array_hx();
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:371: characters 3-28
		$fields = new Array_hx();
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:372: characters 3-29
		$statics = new Array_hx();
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:373: characters 3-17
		$meta = new Array_hx();
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:374: characters 3-45
		$isInterface = $x->exists("interface");
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:375: characters 13-23
		$c = $x->elements();
		while ($c->hasNext()) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:375: lines 375-396
			$c1 = $c->next();
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:376: characters 12-18
			$_g = null;
			if ($c1->nodeType === Xml::$Document) {
				$_g = "Document";
			} else {
				if ($c1->nodeType !== Xml::$Element) {
					throw Exception::thrown("Bad node type, expected Element but found " . ((($c1->nodeType === null ? "null" : XmlType_Impl_::toString($c1->nodeType)))??'null'));
				}
				$_g = $c1->nodeName;
			}
			if ($_g === "extends") {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:380: lines 380-384
				if ($isInterface) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:381: characters 7-32
					$x1 = $this->xpath($c1);
					$interfaces->arr[$interfaces->length++] = $x1;
				} else {
					#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:383: characters 7-24
					$csuper = $this->xpath($c1);
				}
			} else if ($_g === "haxe_doc") {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:378: characters 6-23
				$doc = Access_Impl_::get_innerData($c1);
			} else if ($_g === "haxe_dynamic") {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:388: characters 23-53
				$x2 = $c1->firstElement();
				if (($x2->nodeType !== Xml::$Document) && ($x2->nodeType !== Xml::$Element)) {
					throw Exception::thrown("Invalid nodeType " . ((($x2->nodeType === null ? "null" : XmlType_Impl_::toString($x2->nodeType)))??'null'));
				}
				$this1 = $x2;
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:388: characters 6-54
				$tdynamic = $this->xtype($this1);
			} else if ($_g === "implements") {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:386: characters 6-31
				$x3 = $this->xpath($c1);
				$interfaces->arr[$interfaces->length++] = $x3;
			} else if ($_g === "meta") {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:390: characters 6-21
				$meta = $this->xmeta($c1);
			} else {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:392: lines 392-395
				if ($c1->exists("static")) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:393: characters 7-35
					$x4 = $this->xclassfield($c1);
					$statics->arr[$statics->length++] = $x4;
				} else {
					#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:395: characters 7-34
					$x5 = $this->xclassfield($c1);
					$fields->arr[$fields->length++] = $x5;
				}
			}
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:398: characters 10-46
		$tmp = (HasAttribAccess_Impl_::resolve($x, "file") ? AttribAccess_Impl_::resolve($x, "file") : null);
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:399: characters 10-28
		$tmp1 = $this->mkPath(AttribAccess_Impl_::resolve($x, "path"));
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:400: characters 12-60
		$tmp2 = (HasAttribAccess_Impl_::resolve($x, "module") ? $this->mkPath(AttribAccess_Impl_::resolve($x, "module")) : null);
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:402: characters 15-36
		$tmp3 = $x->exists("private");
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:403: characters 14-34
		$tmp4 = $x->exists("extern");
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:404: characters 13-32
		$tmp5 = $x->exists("final");
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:406: characters 12-38
		$tmp6 = $this->mkTypeParams(AttribAccess_Impl_::resolve($x, "params"));
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:397: lines 397-414
		return new _HxAnon_XmlParser2($tmp, $tmp1, $tmp2, $doc, $tmp3, $tmp4, $tmp5, $isInterface, $tmp6, $csuper, $interfaces, $fields, $statics, $tdynamic, $this->defplat(), $meta);
	}

	/**
	 * @param Xml $x
	 * @param bool $defPublic
	 * 
	 * @return object
	 */
	public function xclassfield ($x, $defPublic = false) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:417: lines 417-444
		if ($defPublic === null) {
			$defPublic = false;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:418: characters 3-22
		$e = $x->elements();
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:419: characters 3-27
		$t = $this->xtype($e->next());
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:420: characters 3-18
		$doc = null;
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:421: characters 3-17
		$meta = new Array_hx();
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:422: characters 3-24
		$overloads = null;
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:423: characters 13-14
		$c = $e;
		while ($c->hasNext()) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:423: lines 423-433
			$c1 = $c->next();
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:424: characters 12-18
			$_g = null;
			if ($c1->nodeType === Xml::$Document) {
				$_g = "Document";
			} else {
				if ($c1->nodeType !== Xml::$Element) {
					throw Exception::thrown("Bad node type, expected Element but found " . ((($c1->nodeType === null ? "null" : XmlType_Impl_::toString($c1->nodeType)))??'null'));
				}
				$_g = $c1->nodeName;
			}
			if ($_g === "haxe_doc") {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:426: characters 6-23
				$doc = Access_Impl_::get_innerData($c1);
			} else if ($_g === "meta") {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:428: characters 6-21
				$meta = $this->xmeta($c1);
			} else if ($_g === "overloads") {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:430: characters 6-31
				$overloads = $this->xoverloads($c1);
			} else {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:432: characters 6-15
				$this->xerror($c1);
			}
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:435: characters 9-15
		$tmp = null;
		if ($x->nodeType === Xml::$Document) {
			$tmp = "Document";
		} else {
			if ($x->nodeType !== Xml::$Element) {
				throw Exception::thrown("Bad node type, expected Element but found " . ((($x->nodeType === null ? "null" : XmlType_Impl_::toString($x->nodeType)))??'null'));
			}
			$tmp = $x->nodeName;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:435: characters 34-67
		$tmp1 = $x->exists("public") || $defPublic;
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:435: characters 77-96
		$tmp2 = $x->exists("final");
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:435: characters 109-131
		$tmp3 = $x->exists("override");
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:436: characters 9-59
		$tmp4 = (HasAttribAccess_Impl_::resolve($x, "line") ? Std::parseInt(AttribAccess_Impl_::resolve($x, "line")) : null);
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:436: characters 74-121
		$tmp5 = (HasAttribAccess_Impl_::resolve($x, "get") ? $this->mkRights(AttribAccess_Impl_::resolve($x, "get")) : Rights::RNormal());
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:436: lines 436-439
		$tmp6 = (HasAttribAccess_Impl_::resolve($x, "set") ? $this->mkRights(AttribAccess_Impl_::resolve($x, "set")) : Rights::RNormal());
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:439: characters 21-73
		$tmp7 = (HasAttribAccess_Impl_::resolve($x, "params") ? $this->mkTypeParams(AttribAccess_Impl_::resolve($x, "params")) : new Array_hx());
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:439: characters 85-94
		$tmp8 = $this->defplat();
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:434: lines 434-443
		return new _HxAnon_XmlParser3($tmp, $t, $tmp1, $tmp2, $tmp3, $tmp4, $doc, $tmp5, $tmp6, $tmp7, $tmp8, $meta, $overloads, (HasAttribAccess_Impl_::resolve($x, "expr") ? AttribAccess_Impl_::resolve($x, "expr") : null));
	}

	/**
	 * @param Xml $x
	 * 
	 * @return object
	 */
	public function xenum ($x) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:447: characters 3-24
		$cl = new Array_hx();
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:448: characters 3-18
		$doc = null;
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:449: characters 3-17
		$meta = new Array_hx();
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:450: characters 13-23
		$c = $x->elements();
		while ($c->hasNext()) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:450: lines 450-456
			$c1 = $c->next();
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:451: characters 8-14
			$tmp = null;
			if ($c1->nodeType === Xml::$Document) {
				$tmp = "Document";
			} else {
				if ($c1->nodeType !== Xml::$Element) {
					throw Exception::thrown("Bad node type, expected Element but found " . ((($c1->nodeType === null ? "null" : XmlType_Impl_::toString($c1->nodeType)))??'null'));
				}
				$tmp = $c1->nodeName;
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:451: lines 451-456
			if ($tmp === "haxe_doc") {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:452: characters 5-22
				$doc = Access_Impl_::get_innerData($c1);
			} else {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:453: characters 13-19
				$tmp1 = null;
				if ($c1->nodeType === Xml::$Document) {
					$tmp1 = "Document";
				} else {
					if ($c1->nodeType !== Xml::$Element) {
						throw Exception::thrown("Bad node type, expected Element but found " . ((($c1->nodeType === null ? "null" : XmlType_Impl_::toString($c1->nodeType)))??'null'));
					}
					$tmp1 = $c1->nodeName;
				}
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:453: lines 453-456
				if ($tmp1 === "meta") {
					#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:454: characters 5-20
					$meta = $this->xmeta($c1);
				} else {
					#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:456: characters 5-27
					$x1 = $this->xenumfield($c1);
					$cl->arr[$cl->length++] = $x1;
				}
			}
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:458: characters 10-46
		$tmp = (HasAttribAccess_Impl_::resolve($x, "file") ? AttribAccess_Impl_::resolve($x, "file") : null);
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:459: characters 10-28
		$tmp1 = $this->mkPath(AttribAccess_Impl_::resolve($x, "path"));
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:460: characters 12-60
		$tmp2 = (HasAttribAccess_Impl_::resolve($x, "module") ? $this->mkPath(AttribAccess_Impl_::resolve($x, "module")) : null);
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:462: characters 15-36
		$tmp3 = $x->exists("private");
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:463: characters 14-34
		$tmp4 = $x->exists("extern");
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:464: characters 12-38
		$tmp5 = $this->mkTypeParams(AttribAccess_Impl_::resolve($x, "params"));
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:457: lines 457-468
		return new _HxAnon_XmlParser4($tmp, $tmp1, $tmp2, $doc, $tmp3, $tmp4, $tmp5, $cl, $this->defplat(), $meta);
	}

	/**
	 * @param Xml $x
	 * 
	 * @return object
	 */
	public function xenumfield ($x) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:472: characters 3-19
		$args = null;
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:473: characters 3-51
		$docElements = $x->elementsNamed("haxe_doc");
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:474: characters 3-70
		$xdoc = ($docElements->hasNext() ? $docElements->next() : null);
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:475: characters 3-61
		$meta = (HasNodeAccess_Impl_::resolve($x, "meta") ? $this->xmeta(NodeAccess_Impl_::resolve($x, "meta")) : new Array_hx());
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:476: lines 476-492
		if (HasAttribAccess_Impl_::resolve($x, "a")) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:477: characters 4-35
			$names = HxString::split(AttribAccess_Impl_::resolve($x, "a"), ":");
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:478: characters 4-26
			$elts = $x->elements();
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:479: characters 4-22
			$args = new Array_hx();
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:480: lines 480-491
			$_g = 0;
			while ($_g < $names->length) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:480: characters 9-10
				$c = ($names->arr[$_g] ?? null);
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:480: lines 480-491
				++$_g;
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:481: characters 5-21
				$opt = false;
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:482: lines 482-485
				if (\mb_substr($c, 0, 1) === "?") {
					#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:483: characters 6-16
					$opt = true;
					#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:484: characters 10-21
					$c = \mb_substr($c, 1, null);
				}
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:486: lines 486-490
				$x1 = new _HxAnon_XmlParser5($c, $opt, $this->xtype($elts->next()));
				$args->arr[$args->length++] = $x1;
			}
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:494: characters 10-16
		$tmp = null;
		if ($x->nodeType === Xml::$Document) {
			$tmp = "Document";
		} else {
			if ($x->nodeType !== Xml::$Element) {
				throw Exception::thrown("Bad node type, expected Element but found " . ((($x->nodeType === null ? "null" : XmlType_Impl_::toString($x->nodeType)))??'null'));
			}
			$tmp = $x->nodeName;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:496: characters 9-63
		$tmp1 = null;
		if ($xdoc === null) {
			$tmp1 = null;
		} else {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:496: characters 37-53
			if (($xdoc->nodeType !== Xml::$Document) && ($xdoc->nodeType !== Xml::$Element)) {
				throw Exception::thrown("Invalid nodeType " . ((($xdoc->nodeType === null ? "null" : XmlType_Impl_::toString($xdoc->nodeType)))??'null'));
			}
			$this1 = $xdoc;
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:496: characters 9-63
			$tmp1 = Access_Impl_::get_innerData($this1);
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:493: lines 493-499
		return new _HxAnon_XmlParser6($tmp, $args, $tmp1, $meta, $this->defplat());
	}

	/**
	 * @param Xml $c
	 * 
	 * @return mixed
	 */
	public function xerror ($c) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:317: characters 29-35
		$tmp = null;
		if ($c->nodeType === Xml::$Document) {
			$tmp = "Document";
		} else {
			if ($c->nodeType !== Xml::$Element) {
				throw Exception::thrown("Bad node type, expected Element but found " . ((($c->nodeType === null ? "null" : XmlType_Impl_::toString($c->nodeType)))??'null'));
			}
			$tmp = $c->nodeName;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:317: characters 10-15
		throw Exception::thrown("Invalid " . ($tmp??'null'));
	}

	/**
	 * @param Xml $x
	 * 
	 * @return object[]|Array_hx
	 */
	public function xmeta ($x) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:337: characters 3-15
		$ml = new Array_hx();
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:338: lines 338-343
		$_g = 0;
		$_g1 = NodeListAccess_Impl_::resolve($x, "m");
		while ($_g < $_g1->length) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:338: characters 8-9
			$m = ($_g1->arr[$_g] ?? null);
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:338: lines 338-343
			++$_g;
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:339: characters 4-16
			$pl = new Array_hx();
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:340: lines 340-341
			$_g2 = 0;
			$_g3 = NodeListAccess_Impl_::resolve($m, "e");
			while ($_g2 < $_g3->length) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:340: characters 9-10
				$p = ($_g3->arr[$_g2] ?? null);
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:340: lines 340-341
				++$_g2;
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:341: characters 5-25
				$x = Access_Impl_::get_innerHTML($p);
				$pl->arr[$pl->length++] = $x;
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:342: characters 4-40
			$x1 = new _HxAnon_XmlParser7(AttribAccess_Impl_::resolve($m, "n"), $pl);
			$ml->arr[$ml->length++] = $x1;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:344: characters 3-12
		return $ml;
	}

	/**
	 * @param Xml $x
	 * 
	 * @return object[]|Array_hx
	 */
	public function xoverloads ($x) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:348: characters 3-23
		$l = new Array_hx();
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:349: characters 13-23
		$m = $x->elements();
		while ($m->hasNext()) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:349: lines 349-351
			$m1 = $m->next();
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:350: characters 4-26
			$x = $this->xclassfield($m1);
			$l->arr[$l->length++] = $x;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:352: characters 3-11
		return $l;
	}

	/**
	 * @param Xml $x
	 * 
	 * @return object
	 */
	public function xpath ($x) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:356: characters 3-33
		$path = $this->mkPath(AttribAccess_Impl_::resolve($x, "path"));
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:357: characters 3-28
		$params = new Array_hx();
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:358: characters 13-23
		$c = $x->elements();
		while ($c->hasNext()) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:358: lines 358-359
			$c1 = $c->next();
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:359: characters 4-25
			$x = $this->xtype($c1);
			$params->arr[$params->length++] = $x;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:360: lines 360-363
		return new _HxAnon_XmlParser8($path, $params);
	}

	/**
	 * @param Xml $x
	 * 
	 * @return void
	 */
	public function xroot ($x) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:321: characters 13-27
		$c = $x->elements();
		while ($c->hasNext()) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:321: lines 321-322
			$c1 = $c->next();
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:322: characters 4-28
			$this->merge($this->processElement($c1));
		}
	}

	/**
	 * @param Xml $x
	 * 
	 * @return CType
	 */
	public function xtype ($x) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:569: characters 18-24
		$_g = null;
		if ($x->nodeType === Xml::$Document) {
			$_g = "Document";
		} else {
			if ($x->nodeType !== Xml::$Element) {
				throw Exception::thrown("Bad node type, expected Element but found " . ((($x->nodeType === null ? "null" : XmlType_Impl_::toString($x->nodeType)))??'null'));
			}
			$_g = $x->nodeName;
		}
		if ($_g === "a") {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:606: characters 5-30
			$fields = new Array_hx();
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:607: characters 15-25
			$f = $x->elements();
			while ($f->hasNext()) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:607: lines 607-611
				$f1 = $f->next();
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:608: characters 6-35
				$f2 = $this->xclassfield($f1, true);
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:609: characters 6-17
				$f2->platforms = new Array_hx();
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:610: characters 6-20
				$fields->arr[$fields->length++] = $f2;
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:612: characters 5-23
			return CType::CAnonymous($fields);
		} else if ($_g === "c") {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:575: characters 12-30
			$tmp = $this->mkPath(AttribAccess_Impl_::resolve($x, "path"));
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:575: characters 5-47
			return CType::CClass($tmp, $this->xtypeparams($x));
		} else if ($_g === "d") {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:614: characters 5-18
			$t = null;
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:615: characters 5-33
			$tx = $x->firstElement();
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:616: lines 616-617
			if ($tx !== null) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:617: characters 16-30
				if (($tx->nodeType !== Xml::$Document) && ($tx->nodeType !== Xml::$Element)) {
					throw Exception::thrown("Invalid nodeType " . ((($tx->nodeType === null ? "null" : XmlType_Impl_::toString($tx->nodeType)))??'null'));
				}
				$this1 = $tx;
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:617: characters 6-7
				$t = $this->xtype($this1);
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:618: characters 5-16
			return CType::CDynamic($t);
		} else if ($_g === "e") {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:573: characters 11-29
			$tmp = $this->mkPath(AttribAccess_Impl_::resolve($x, "path"));
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:573: characters 5-46
			return CType::CEnum($tmp, $this->xtypeparams($x));
		} else if ($_g === "f") {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:581: characters 5-28
			$args = new Array_hx();
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:582: characters 5-36
			$aname = HxString::split(AttribAccess_Impl_::resolve($x, "a"), ":");
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:583: characters 17-33
			$eargs_current = 0;
			$eargs_array = $aname;
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:584: characters 5-66
			$evalues = (HasAttribAccess_Impl_::resolve($x, "v") ? new ArrayIterator(HxString::split(AttribAccess_Impl_::resolve($x, "v"), ":")) : null);
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:585: characters 15-25
			$e = $x->elements();
			while ($e->hasNext()) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:585: lines 585-601
				$e1 = $e->next();
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:586: characters 6-22
				$opt = false;
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:587: characters 6-52
				$a = ($eargs_current < $eargs_array->length ? ($eargs_array->arr[$eargs_current++] ?? null) : null);
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:588: lines 588-589
				if ($a === null) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:589: characters 7-8
					$a = "";
				}
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:590: lines 590-593
				if (\mb_substr($a, 0, 1) === "?") {
					#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:591: characters 7-10
					$opt = true;
					#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:592: characters 11-22
					$a = \mb_substr($a, 1, null);
				}
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:594: characters 6-76
				$v = (($evalues === null) || ($evalues->current >= $evalues->array->length) ? null : ($evalues->array->arr[$evalues->current++] ?? null));
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:598: characters 10-18
				$x1 = $this->xtype($e1);
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:595: lines 595-600
				$args->arr[$args->length++] = new _HxAnon_XmlParser9($a, $opt, $x1, ($v === "" ? null : $v));
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:602: characters 5-37
			$ret = ($args->arr[$args->length - 1] ?? null);
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:603: characters 5-21
			$args->remove($ret);
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:604: characters 5-27
			return CType::CFunction($args, $ret->t);
		} else if ($_g === "t") {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:577: characters 14-32
			$tmp = $this->mkPath(AttribAccess_Impl_::resolve($x, "path"));
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:577: characters 5-49
			return CType::CTypedef($tmp, $this->xtypeparams($x));
		} else if ($_g === "unknown") {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:571: characters 5-13
			return CType::CUnknown();
		} else if ($_g === "x") {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:579: characters 15-33
			$tmp = $this->mkPath(AttribAccess_Impl_::resolve($x, "path"));
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:579: characters 5-50
			return CType::CAbstract($tmp, $this->xtypeparams($x));
		} else {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:620: characters 5-14
			return $this->xerror($x);
		}
	}

	/**
	 * @param Xml $x
	 * 
	 * @return object
	 */
	public function xtypedef ($x) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:541: characters 3-18
		$doc = null;
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:542: characters 3-16
		$t = null;
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:543: characters 3-17
		$meta = new Array_hx();
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:544: characters 13-23
		$c = $x->elements();
		while ($c->hasNext()) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:544: lines 544-550
			$c1 = $c->next();
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:545: characters 8-14
			$tmp = null;
			if ($c1->nodeType === Xml::$Document) {
				$tmp = "Document";
			} else {
				if ($c1->nodeType !== Xml::$Element) {
					throw Exception::thrown("Bad node type, expected Element but found " . ((($c1->nodeType === null ? "null" : XmlType_Impl_::toString($c1->nodeType)))??'null'));
				}
				$tmp = $c1->nodeName;
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:545: lines 545-550
			if ($tmp === "haxe_doc") {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:546: characters 5-22
				$doc = Access_Impl_::get_innerData($c1);
			} else {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:547: characters 13-19
				$tmp1 = null;
				if ($c1->nodeType === Xml::$Document) {
					$tmp1 = "Document";
				} else {
					if ($c1->nodeType !== Xml::$Element) {
						throw Exception::thrown("Bad node type, expected Element but found " . ((($c1->nodeType === null ? "null" : XmlType_Impl_::toString($c1->nodeType)))??'null'));
					}
					$tmp1 = $c1->nodeName;
				}
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:547: lines 547-550
				if ($tmp1 === "meta") {
					#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:548: characters 5-20
					$meta = $this->xmeta($c1);
				} else {
					#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:550: characters 5-17
					$t = $this->xtype($c1);
				}
			}
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:551: characters 3-39
		$types = new StringMap();
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:552: lines 552-553
		if ($this->curplatform !== null) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:553: characters 4-29
			$types->data[$this->curplatform] = $t;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:555: characters 10-46
		$tmp = (HasAttribAccess_Impl_::resolve($x, "file") ? AttribAccess_Impl_::resolve($x, "file") : null);
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:556: characters 10-28
		$tmp1 = $this->mkPath(AttribAccess_Impl_::resolve($x, "path"));
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:557: characters 12-60
		$tmp2 = (HasAttribAccess_Impl_::resolve($x, "module") ? $this->mkPath(AttribAccess_Impl_::resolve($x, "module")) : null);
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:559: characters 15-36
		$tmp3 = $x->exists("private");
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:560: characters 12-38
		$tmp4 = $this->mkTypeParams(AttribAccess_Impl_::resolve($x, "params"));
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:554: lines 554-565
		return new _HxAnon_XmlParser10($tmp, $tmp1, $tmp2, $doc, $tmp3, $tmp4, $t, $types, $this->defplat(), $meta);
	}

	/**
	 * @param Xml $x
	 * 
	 * @return CType[]|Array_hx
	 */
	public function xtypeparams ($x) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:625: characters 3-23
		$p = new Array_hx();
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:626: characters 13-23
		$c = $x->elements();
		while ($c->hasNext()) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:626: lines 626-627
			$c1 = $c->next();
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:627: characters 4-20
			$x = $this->xtype($c1);
			$p->arr[$p->length++] = $x;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/XmlParser.hx:628: characters 3-11
		return $p;
	}
}

class _HxAnon_XmlParser0 extends HxAnon {
	function __construct($t, $field) {
		$this->t = $t;
		$this->field = $field;
	}
}

class _HxAnon_XmlParser1 extends HxAnon {
	function __construct($file, $path, $module, $doc, $isPrivate, $params, $platforms, $meta, $athis, $to, $from, $impl) {
		$this->file = $file;
		$this->path = $path;
		$this->module = $module;
		$this->doc = $doc;
		$this->isPrivate = $isPrivate;
		$this->params = $params;
		$this->platforms = $platforms;
		$this->meta = $meta;
		$this->athis = $athis;
		$this->to = $to;
		$this->from = $from;
		$this->impl = $impl;
	}
}

class _HxAnon_XmlParser2 extends HxAnon {
	function __construct($file, $path, $module, $doc, $isPrivate, $isExtern, $isFinal, $isInterface, $params, $superClass, $interfaces, $fields, $statics, $tdynamic, $platforms, $meta) {
		$this->file = $file;
		$this->path = $path;
		$this->module = $module;
		$this->doc = $doc;
		$this->isPrivate = $isPrivate;
		$this->isExtern = $isExtern;
		$this->isFinal = $isFinal;
		$this->isInterface = $isInterface;
		$this->params = $params;
		$this->superClass = $superClass;
		$this->interfaces = $interfaces;
		$this->fields = $fields;
		$this->statics = $statics;
		$this->tdynamic = $tdynamic;
		$this->platforms = $platforms;
		$this->meta = $meta;
	}
}

class _HxAnon_XmlParser3 extends HxAnon {
	function __construct($name, $type, $isPublic, $isFinal, $isOverride, $line, $doc, $get, $set, $params, $platforms, $meta, $overloads, $expr) {
		$this->name = $name;
		$this->type = $type;
		$this->isPublic = $isPublic;
		$this->isFinal = $isFinal;
		$this->isOverride = $isOverride;
		$this->line = $line;
		$this->doc = $doc;
		$this->get = $get;
		$this->set = $set;
		$this->params = $params;
		$this->platforms = $platforms;
		$this->meta = $meta;
		$this->overloads = $overloads;
		$this->expr = $expr;
	}
}

class _HxAnon_XmlParser4 extends HxAnon {
	function __construct($file, $path, $module, $doc, $isPrivate, $isExtern, $params, $constructors, $platforms, $meta) {
		$this->file = $file;
		$this->path = $path;
		$this->module = $module;
		$this->doc = $doc;
		$this->isPrivate = $isPrivate;
		$this->isExtern = $isExtern;
		$this->params = $params;
		$this->constructors = $constructors;
		$this->platforms = $platforms;
		$this->meta = $meta;
	}
}

class _HxAnon_XmlParser5 extends HxAnon {
	function __construct($name, $opt, $t) {
		$this->name = $name;
		$this->opt = $opt;
		$this->t = $t;
	}
}

class _HxAnon_XmlParser6 extends HxAnon {
	function __construct($name, $args, $doc, $meta, $platforms) {
		$this->name = $name;
		$this->args = $args;
		$this->doc = $doc;
		$this->meta = $meta;
		$this->platforms = $platforms;
	}
}

class _HxAnon_XmlParser7 extends HxAnon {
	function __construct($name, $params) {
		$this->name = $name;
		$this->params = $params;
	}
}

class _HxAnon_XmlParser8 extends HxAnon {
	function __construct($path, $params) {
		$this->path = $path;
		$this->params = $params;
	}
}

class _HxAnon_XmlParser9 extends HxAnon {
	function __construct($name, $opt, $t, $value) {
		$this->name = $name;
		$this->opt = $opt;
		$this->t = $t;
		$this->value = $value;
	}
}

class _HxAnon_XmlParser10 extends HxAnon {
	function __construct($file, $path, $module, $doc, $isPrivate, $params, $type, $types, $platforms, $meta) {
		$this->file = $file;
		$this->path = $path;
		$this->module = $module;
		$this->doc = $doc;
		$this->isPrivate = $isPrivate;
		$this->params = $params;
		$this->type = $type;
		$this->types = $types;
		$this->platforms = $platforms;
		$this->meta = $meta;
	}
}

Boot::registerClass(XmlParser::class, 'haxe.rtti.XmlParser');
