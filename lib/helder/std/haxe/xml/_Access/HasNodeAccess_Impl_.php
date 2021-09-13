<?php
/**
 */

namespace helder\std\haxe\xml\_Access;

use \helder\std\php\Boot;
use \helder\std\Xml;

final class HasNodeAccess_Impl_ {
	/**
	 * @param Xml $this
	 * @param string $name
	 * 
	 * @return bool
	 */
	public static function resolve ($this1, $name) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/xml/Access.hx:69: characters 3-44
		return $this1->elementsNamed($name)->hasNext();
	}
}

Boot::registerClass(HasNodeAccess_Impl_::class, 'haxe.xml._Access.HasNodeAccess_Impl_');
