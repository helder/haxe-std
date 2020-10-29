<?php
/**
 * Generated by Haxe 4.1.4
 */

namespace helder\std\haxe\rtti;

use \helder\std\Reflect;
use \helder\std\Lambda;
use \helder\std\php\Boot;
use \helder\std\haxe\Exception;
use \helder\std\Xml;
use \helder\std\Std;
use \helder\std\Type;

/**
 * Rtti is a helper class which supplements the `@:rtti` metadata.
 * @see <https://haxe.org/manual/cr-rtti.html>
 */
class Rtti {
	/**
	 * Returns the `haxe.rtti.CType.Classdef` corresponding to class `c`.
	 * If `c` has no runtime type information, e.g. because no `@:rtti` was
	 * added, an exception of type `String` is thrown.
	 * If `c` is `null`, the result is unspecified.
	 * 
	 * @param Class $c
	 * 
	 * @return object
	 */
	public static function getRtti ($c) {
		#/home/runner/haxe/versions/4.1.4/std/haxe/rtti/Rtti.hx:42: characters 3-41
		$rtti = Reflect::field($c, "__rtti");
		#/home/runner/haxe/versions/4.1.4/std/haxe/rtti/Rtti.hx:43: lines 43-45
		if ($rtti === null) {
			#/home/runner/haxe/versions/4.1.4/std/haxe/rtti/Rtti.hx:44: characters 4-9
			throw Exception::thrown("Class " . (Type::getClassName($c)??'null') . " has no RTTI information, consider adding @:rtti");
		}
		#/home/runner/haxe/versions/4.1.4/std/haxe/rtti/Rtti.hx:46: characters 3-42
		$x = Xml::parse($rtti)->firstElement();
		#/home/runner/haxe/versions/4.1.4/std/haxe/rtti/Rtti.hx:47: characters 3-59
		$infos = (new XmlParser())->processElement($x);
		#/home/runner/haxe/versions/4.1.4/std/haxe/rtti/Rtti.hx:48: lines 48-53
		if ($infos->index === 1) {
			#/home/runner/haxe/versions/4.1.4/std/haxe/rtti/Rtti.hx:49: characters 20-21
			$c = $infos->params[0];
			#/home/runner/haxe/versions/4.1.4/std/haxe/rtti/Rtti.hx:50: characters 5-13
			return $c;
		} else {
			#/home/runner/haxe/versions/4.1.4/std/haxe/rtti/Rtti.hx:51: characters 9-14
			$t = $infos;
			#/home/runner/haxe/versions/4.1.4/std/haxe/rtti/Rtti.hx:52: characters 5-10
			throw Exception::thrown("Enum mismatch: expected TClassDecl but found " . (Std::string($t)??'null'));
		}
	}

	/**
	 * Tells if `c` has runtime type information.
	 * If `c` is `null`, the result is unspecified.
	 * 
	 * @param Class $c
	 * 
	 * @return bool
	 */
	public static function hasRtti ($c) {
		#/home/runner/haxe/versions/4.1.4/std/haxe/rtti/Rtti.hx:62: characters 3-54
		return Lambda::has(Type::getClassFields($c), "__rtti");
	}
}

Boot::registerClass(Rtti::class, 'haxe.rtti.Rtti');
