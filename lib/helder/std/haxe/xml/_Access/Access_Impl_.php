<?php
/**
 */

namespace helder\std\haxe\xml\_Access;

use \helder\std\php\Boot;
use \helder\std\haxe\Exception;
use \helder\std\Xml;
use \helder\std\_Xml\XmlType_Impl_;
use \helder\std\haxe\xml\Printer;
use \helder\std\StringBuf;

final class Access_Impl_ {

	/**
	 * @param Xml $x
	 * 
	 * @return Xml
	 */
	public static function _new ($x) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Access.hx:210: lines 210-211
		if (($x->nodeType !== Xml::$Document) && ($x->nodeType !== Xml::$Element)) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Access.hx:211: characters 4-9
			throw Exception::thrown("Invalid nodeType " . ((($x->nodeType === null ? "null" : XmlType_Impl_::toString($x->nodeType)))??'null'));
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Access.hx:209: character 2
		$this1 = $x;
		return $this1;
	}

	/**
	 * @param Xml $this
	 * 
	 * @return Xml
	 */
	public static function get_att ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Access.hx:175: characters 3-14
		return $this1;
	}

	/**
	 * @param Xml $this
	 * 
	 * @return object
	 */
	public static function get_elements ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Access.hx:207: characters 3-30
		return $this1->elements();
	}

	/**
	 * @param Xml $this
	 * 
	 * @return Xml
	 */
	public static function get_has ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Access.hx:183: characters 3-14
		return $this1;
	}

	/**
	 * @param Xml $this
	 * 
	 * @return Xml
	 */
	public static function get_hasNode ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Access.hx:199: characters 3-11
		return $this1;
	}

	/**
	 * @param Xml $this
	 * 
	 * @return string
	 */
	public static function get_innerData ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Access.hx:216: characters 12-27
		if (($this1->nodeType !== Xml::$Document) && ($this1->nodeType !== Xml::$Element)) {
			throw Exception::thrown("Bad node type, expected Element or Document but found " . ((($this1->nodeType === null ? "null" : XmlType_Impl_::toString($this1->nodeType)))??'null'));
		}
		$it_current = 0;
		$it_array = $this1->children;
		#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Access.hx:217: lines 217-218
		if ($it_current >= $it_array->length) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Access.hx:218: characters 10-14
			$tmp = null;
			if ($this1->nodeType === Xml::$Document) {
				$tmp = "Document";
			} else {
				if ($this1->nodeType !== Xml::$Element) {
					throw Exception::thrown("Bad node type, expected Element but found " . ((($this1->nodeType === null ? "null" : XmlType_Impl_::toString($this1->nodeType)))??'null'));
				}
				$tmp = $this1->nodeName;
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Access.hx:218: characters 4-9
			throw Exception::thrown(($tmp??'null') . " does not have data");
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Access.hx:219: characters 3-21
		$v = ($it_array->arr[$it_current++] ?? null);
		#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Access.hx:220: lines 220-231
		if ($it_current < $it_array->length) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Access.hx:221: characters 4-22
			$n = ($it_array->arr[$it_current++] ?? null);
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Access.hx:223: characters 8-98
			$tmp = null;
			if (($v->nodeType === Xml::$PCData) && ($n->nodeType === Xml::$CData)) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Access.hx:223: characters 80-91
				if (($v->nodeType === Xml::$Document) || ($v->nodeType === Xml::$Element)) {
					throw Exception::thrown("Bad node type, unexpected " . ((($v->nodeType === null ? "null" : XmlType_Impl_::toString($v->nodeType)))??'null'));
				}
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Access.hx:223: characters 8-98
				$tmp = \trim($v->nodeValue) === "";
			} else {
				$tmp = false;
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Access.hx:223: lines 223-229
			if ($tmp) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Access.hx:224: lines 224-225
				if ($it_current >= $it_array->length) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Access.hx:225: characters 13-24
					if (($n->nodeType === Xml::$Document) || ($n->nodeType === Xml::$Element)) {
						throw Exception::thrown("Bad node type, unexpected " . ((($n->nodeType === null ? "null" : XmlType_Impl_::toString($n->nodeType)))??'null'));
					}
					return $n->nodeValue;
				}
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Access.hx:226: characters 5-24
				$n2 = ($it_array->arr[$it_current++] ?? null);
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Access.hx:227: characters 9-74
				$tmp = null;
				if ($n2->nodeType === Xml::$PCData) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Access.hx:227: characters 55-67
					if (($n2->nodeType === Xml::$Document) || ($n2->nodeType === Xml::$Element)) {
						throw Exception::thrown("Bad node type, unexpected " . ((($n2->nodeType === null ? "null" : XmlType_Impl_::toString($n2->nodeType)))??'null'));
					}
					#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Access.hx:227: characters 9-74
					$tmp = \trim($n2->nodeValue) === "";
				} else {
					$tmp = false;
				}
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Access.hx:227: lines 227-228
				if ($tmp && ($it_current >= $it_array->length)) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Access.hx:228: characters 13-24
					if (($n->nodeType === Xml::$Document) || ($n->nodeType === Xml::$Element)) {
						throw Exception::thrown("Bad node type, unexpected " . ((($n->nodeType === null ? "null" : XmlType_Impl_::toString($n->nodeType)))??'null'));
					}
					return $n->nodeValue;
				}
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Access.hx:230: characters 10-14
			$tmp = null;
			if ($this1->nodeType === Xml::$Document) {
				$tmp = "Document";
			} else {
				if ($this1->nodeType !== Xml::$Element) {
					throw Exception::thrown("Bad node type, expected Element but found " . ((($this1->nodeType === null ? "null" : XmlType_Impl_::toString($this1->nodeType)))??'null'));
				}
				$tmp = $this1->nodeName;
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Access.hx:230: characters 4-9
			throw Exception::thrown(($tmp??'null') . " does not only have data");
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Access.hx:232: lines 232-233
		if (($v->nodeType !== Xml::$PCData) && ($v->nodeType !== Xml::$CData)) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Access.hx:233: characters 10-14
			$tmp = null;
			if ($this1->nodeType === Xml::$Document) {
				$tmp = "Document";
			} else {
				if ($this1->nodeType !== Xml::$Element) {
					throw Exception::thrown("Bad node type, expected Element but found " . ((($this1->nodeType === null ? "null" : XmlType_Impl_::toString($this1->nodeType)))??'null'));
				}
				$tmp = $this1->nodeName;
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Access.hx:233: characters 4-9
			throw Exception::thrown(($tmp??'null') . " does not have data");
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Access.hx:234: characters 10-21
		if (($v->nodeType === Xml::$Document) || ($v->nodeType === Xml::$Element)) {
			throw Exception::thrown("Bad node type, unexpected " . ((($v->nodeType === null ? "null" : XmlType_Impl_::toString($v->nodeType)))??'null'));
		}
		return $v->nodeValue;
	}

	/**
	 * @param Xml $this
	 * 
	 * @return string
	 */
	public static function get_innerHTML ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Access.hx:238: characters 3-27
		$s = new StringBuf();
		#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Access.hx:239: characters 13-17
		if (($this1->nodeType !== Xml::$Document) && ($this1->nodeType !== Xml::$Element)) {
			throw Exception::thrown("Bad node type, expected Element or Document but found " . ((($this1->nodeType === null ? "null" : XmlType_Impl_::toString($this1->nodeType)))??'null'));
		}
		$_g_current = 0;
		$_g_array = $this1->children;
		#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Access.hx:239: lines 239-240
		while ($_g_current < $_g_array->length) {
			$x = ($_g_array->arr[$_g_current++] ?? null);
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Access.hx:240: characters 4-23
			$s->add(Printer::print($x));
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Access.hx:241: characters 3-22
		return $s->b;
	}

	/**
	 * @param Xml $this
	 * 
	 * @return string
	 */
	public static function get_name ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Access.hx:99: characters 10-74
		if ($this1->nodeType === Xml::$Document) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Access.hx:99: characters 45-55
			return "Document";
		} else {
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Access.hx:99: characters 61-74
			if ($this1->nodeType !== Xml::$Element) {
				throw Exception::thrown("Bad node type, expected Element but found " . ((($this1->nodeType === null ? "null" : XmlType_Impl_::toString($this1->nodeType)))??'null'));
			}
			return $this1->nodeName;
		}
	}

	/**
	 * @param Xml $this
	 * 
	 * @return Xml
	 */
	public static function get_node ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Access.hx:134: characters 3-11
		return $this1;
	}

	/**
	 * @param Xml $this
	 * 
	 * @return Xml
	 */
	public static function get_nodes ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Access.hx:156: characters 3-14
		return $this1;
	}

	/**
	 * @param Xml $this
	 * 
	 * @return Xml
	 */
	public static function get_x ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Access.hx:91: characters 3-14
		return $this1;
	}
}

Boot::registerClass(Access_Impl_::class, 'haxe.xml._Access.Access_Impl_');
Boot::registerGetters('helder\\std\\haxe\\xml\\_Access\\Access_Impl_', [
	'elements' => true,
	'hasNode' => true,
	'has' => true,
	'att' => true,
	'nodes' => true,
	'node' => true,
	'innerHTML' => true,
	'innerData' => true,
	'name' => true,
	'x' => true
]);
