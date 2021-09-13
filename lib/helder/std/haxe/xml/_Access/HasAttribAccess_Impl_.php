<?php
/**
 */

namespace helder\std\haxe\xml\_Access;

use \helder\std\php\Boot;
use \helder\std\haxe\Exception;
use \helder\std\Xml;

final class HasAttribAccess_Impl_ {
	/**
	 * @param Xml $this
	 * @param string $name
	 * 
	 * @return bool
	 */
	public static function resolve ($this1, $name) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Access.hx:60: lines 60-61
		if ($this1->nodeType === Xml::$Document) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Access.hx:61: characters 4-9
			throw Exception::thrown("Cannot access document attribute " . ($name??'null'));
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Access.hx:62: characters 3-27
		return $this1->exists($name);
	}
}

Boot::registerClass(HasAttribAccess_Impl_::class, 'haxe.xml._Access.HasAttribAccess_Impl_');
