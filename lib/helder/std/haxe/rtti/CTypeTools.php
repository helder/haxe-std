<?php
/**
 */

namespace helder\std\haxe\rtti;

use \helder\std\php\Boot;
use \helder\std\Array_hx;

/**
 * The `CTypeTools` class contains some extra functionalities for handling
 * `CType` instances.
 */
class CTypeTools {
	/**
	 * @param object $cf
	 * 
	 * @return string
	 */
	public static function classField ($cf) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:593: characters 3-43
		return ($cf->name??'null') . ":" . (CTypeTools::toString($cf->type)??'null');
	}

	/**
	 * @param object $arg
	 * 
	 * @return string
	 */
	public static function functionArgumentName ($arg) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:586: lines 586-589
		return ((($arg->opt ? "?" : ""))??'null') . ((($arg->name === "" ? "" : ($arg->name??'null') . ":"))??'null') . (CTypeTools::toString($arg->t)??'null') . ((($arg->value === null ? "" : " = " . ($arg->value??'null')))??'null');
	}

	/**
	 * @param string $name
	 * @param CType[]|Array_hx $params
	 * 
	 * @return string
	 */
	public static function nameWithParams ($name, $params) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:579: lines 579-581
		if ($params->length === 0) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:580: characters 4-15
			return $name;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:582: characters 10-20
		$tmp = ($name??'null') . "<";
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:582: characters 23-43
		$f = Boot::getStaticClosure(CTypeTools::class, 'toString');
		$result = [];
		$data = $params->arr;
		$_g_current = 0;
		$_g_length = \count($data);
		$_g_data = $data;
		while ($_g_current < $_g_length) {
			$item = $_g_data[$_g_current++];
			$result[] = $f($item);
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:582: characters 3-60
		return ($tmp??'null') . (Array_hx::wrap($result)->join(", ")??'null') . ">";
	}

	/**
	 * Get the string representation of `CType`.
	 * 
	 * @param CType $t
	 * 
	 * @return string
	 */
	public static function toString ($t) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:556: lines 556-575
		$__hx__switch = ($t->index);
		if ($__hx__switch === 0) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:558: characters 5-14
			return "unknown";
		} else if ($__hx__switch === 1) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:559: characters 37-41
			$name = $t->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:559: characters 43-49
			$params = $t->params[1];
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:560: characters 5-33
			return CTypeTools::nameWithParams($name, $params);
		} else if ($__hx__switch === 2) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:559: characters 16-20
			$name = $t->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:559: characters 22-28
			$params = $t->params[1];
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:560: characters 5-33
			return CTypeTools::nameWithParams($name, $params);
		} else if ($__hx__switch === 3) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:559: characters 61-65
			$name = $t->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:559: characters 67-73
			$params = $t->params[1];
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:560: characters 5-33
			return CTypeTools::nameWithParams($name, $params);
		} else if ($__hx__switch === 4) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:561: characters 19-23
			$args = $t->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:561: characters 25-28
			$ret = $t->params[1];
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:562: lines 562-566
			if ($args->length === 0) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:563: characters 6-32
				return "Void -> " . (CTypeTools::toString($ret)??'null');
			} else {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:565: characters 6-36
				$f = Boot::getStaticClosure(CTypeTools::class, 'functionArgumentName');
				$result = [];
				$data = $args->arr;
				$_g_current = 0;
				$_g_length = \count($data);
				$_g_data = $data;
				while ($_g_current < $_g_length) {
					$item = $_g_data[$_g_current++];
					$result[] = $f($item);
				}
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:565: characters 6-74
				return (Array_hx::wrap($result)->join(" -> ")??'null') . " -> " . (CTypeTools::toString($ret)??'null');
			}
		} else if ($__hx__switch === 5) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:573: characters 20-26
			$fields = $t->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:574: characters 12-34
			$f = Boot::getStaticClosure(CTypeTools::class, 'classField');
			$result = [];
			$data = $fields->arr;
			$_g_current = 0;
			$_g_length = \count($data);
			$_g_data = $data;
			while ($_g_current < $_g_length) {
				$item = $_g_data[$_g_current++];
				$result[] = $f($item);
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:574: characters 5-51
			return "{ " . (Array_hx::wrap($result)->join(", ")??'null') . "}";
		} else if ($__hx__switch === 6) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:567: characters 18-19
			$d = $t->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:568: lines 568-572
			if ($d === null) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:569: characters 6-15
				return "Dynamic";
			} else {
				#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:571: characters 6-36
				return "Dynamic<" . (CTypeTools::toString($d)??'null') . ">";
			}
		} else if ($__hx__switch === 7) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:559: characters 86-90
			$name = $t->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:559: characters 92-98
			$params = $t->params[1];
			#/home/runner/haxe/versions/4.2.3/std/haxe/rtti/CType.hx:560: characters 5-33
			return CTypeTools::nameWithParams($name, $params);
		}
	}
}

Boot::registerClass(CTypeTools::class, 'haxe.rtti.CTypeTools');
