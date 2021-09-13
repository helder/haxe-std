<?php
/**
 */

namespace helder\std\haxe\xml\_Access;

use \helder\std\php\Boot;
use \helder\std\haxe\Exception;
use \helder\std\Xml;
use \helder\std\_Xml\XmlType_Impl_;

final class NodeAccess_Impl_ {
	/**
	 * @param Xml $this
	 * @param string $name
	 * 
	 * @return Xml
	 */
	public static function resolve ($this1, $name) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Access.hx:28: characters 3-43
		$x = $this1->elementsNamed($name)->next();
		#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Access.hx:29: lines 29-32
		if ($x === null) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Access.hx:30: characters 4-81
			$xname = null;
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Access.hx:30: characters 16-80
			if ($this1->nodeType === Xml::$Document) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Access.hx:30: characters 4-81
				$xname = "Document";
			} else {
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Access.hx:30: characters 67-80
				if ($this1->nodeType !== Xml::$Element) {
					throw Exception::thrown("Bad node type, expected Element but found " . ((($this1->nodeType === null ? "null" : XmlType_Impl_::toString($this1->nodeType)))??'null'));
				}
				#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Access.hx:30: characters 4-81
				$xname = $this1->nodeName;
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Access.hx:31: characters 4-9
			throw Exception::thrown(($xname??'null') . " is missing element " . ($name??'null'));
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Access.hx:33: characters 10-23
		if (($x->nodeType !== Xml::$Document) && ($x->nodeType !== Xml::$Element)) {
			throw Exception::thrown("Invalid nodeType " . ((($x->nodeType === null ? "null" : XmlType_Impl_::toString($x->nodeType)))??'null'));
		}
		$this1 = $x;
		return $this1;
	}
}

Boot::registerClass(NodeAccess_Impl_::class, 'haxe.xml._Access.NodeAccess_Impl_');
