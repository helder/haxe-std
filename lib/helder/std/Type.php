<?php
/**
 */

namespace helder\std;

use \helder\std\php\_Boot\HxAnon;
use \helder\std\php\Boot;
use \helder\std\php\_Boot\HxClass;
use \helder\std\php\_Boot\HxString;
use \helder\std\haxe\Exception as HaxeException;
use \helder\std\php\_Boot\HxClosure;
use \helder\std\php\_Boot\HxEnum;
use \helder\std\haxe\NativeStackTrace;

/**
 * The Haxe Reflection API allows retrieval of type information at runtime.
 * This class complements the more lightweight Reflect class, with a focus on
 * class and enum instances.
 * @see https://haxe.org/manual/types.html
 * @see https://haxe.org/manual/std-reflection.html
 */
class Type {
	/**
	 * Returns a list of all constructors of enum `e` that require no
	 * arguments.
	 * This may return the empty Array `[]` if all constructors of `e` require
	 * arguments.
	 * Otherwise an instance of `e` constructed through each of its non-
	 * argument constructors is returned, in the order of the constructor
	 * declaration.
	 * If `e` is null, the result is unspecified.
	 * 
	 * @param Enum $e
	 * 
	 * @return mixed[]|Array_hx
	 */
	public static function allEnums ($e) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:341: lines 341-342
		if ($e === null) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:342: characters 4-15
			return null;
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:344: characters 3-43
		$phpName = $e->phpClassName;
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:346: characters 3-19
		$result = new Array_hx();
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:348: lines 348-353
		$_g = 0;
		$_g1 = Type::getEnumConstructs($e);
		while ($_g < $_g1->length) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:348: characters 8-12
			$name = ($_g1->arr[$_g] ?? null);
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:348: lines 348-353
			++$_g;
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:349: characters 4-57
			$reflection = new \ReflectionMethod($phpName, $name);
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:350: lines 350-352
			if ($reflection->getNumberOfParameters() === 0) {
				#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:351: characters 5-41
				$x = $reflection->invoke(null);
				$result->arr[$result->length++] = $x;
			}
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:355: characters 3-16
		return $result;
	}

	/**
	 * Creates an instance of class `cl`.
	 * This function guarantees that the class constructor is not called.
	 * If `cl` is null, the result is unspecified.
	 * 
	 * @param Class $cl
	 * 
	 * @return mixed
	 */
	public static function createEmptyInstance ($cl) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:135: lines 135-136
		if (Boot::getClass('String') === $cl) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:136: characters 4-18
			return "";
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:137: lines 137-138
		if (Boot::getClass(Array_hx::class) === $cl) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:138: characters 4-18
			return new Array_hx();
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:140: characters 3-68
		$reflection = new \ReflectionClass($cl->phpClassName);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:141: characters 3-52
		return $reflection->newInstanceWithoutConstructor();
	}

	/**
	 * Creates an instance of enum `e` by calling its constructor `constr` with
	 * arguments `params`.
	 * If `e` or `constr` is null, or if enum `e` has no constructor named
	 * `constr`, or if the number of elements in `params` does not match the
	 * expected number of constructor arguments, or if any argument has an
	 * invalid type, the result is unspecified.
	 * 
	 * @param Enum $e
	 * @param string $constr
	 * @param mixed[]|Array_hx $params
	 * 
	 * @return mixed
	 */
	public static function createEnum ($e, $constr, $params = null) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:145: lines 145-146
		if (($e === null) || ($constr === null)) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:146: characters 4-15
			return null;
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:148: characters 3-43
		$phpName = $e->phpClassName;
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:150: lines 150-152
		if (!in_array($constr, $phpName::__hx__list())) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:151: characters 4-9
			throw HaxeException::thrown("No such constructor " . ($constr??'null'));
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:154: characters 3-92
		$paramsCounts = $phpName::__hx__paramsCount();
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:155: lines 155-157
		if ((($params === null) && ($paramsCounts[$constr] !== 0)) || (($params !== null) && ($params->length !== $paramsCounts[$constr]))) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:156: characters 4-9
			throw HaxeException::thrown("Provided parameters count does not match expected parameters count");
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:159: lines 159-164
		if ($params === null) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:160: characters 4-45
			return $phpName::{$constr}();
		} else {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:162: characters 4-60
			$nativeArgs = $params->arr;
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:163: characters 4-71
			return $phpName::{$constr}(...$nativeArgs);
		}
	}

	/**
	 * Creates an instance of enum `e` by calling its constructor number
	 * `index` with arguments `params`.
	 * The constructor indices are preserved from Haxe syntax, so the first
	 * declared is index 0, the next index 1 etc.
	 * If `e` or `constr` is null, or if enum `e` has no constructor named
	 * `constr`, or if the number of elements in `params` does not match the
	 * expected number of constructor arguments, or if any argument has an
	 * invalid type, the result is unspecified.
	 * 
	 * @param Enum $e
	 * @param int $index
	 * @param mixed[]|Array_hx $params
	 * 
	 * @return mixed
	 */
	public static function createEnumIndex ($e, $index, $params = null) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:168: lines 168-169
		if (($e === null) || ($index === null)) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:169: characters 4-15
			return null;
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:171: characters 3-43
		$phpName = $e->phpClassName;
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:173: characters 3-90
		$constructors = $phpName::__hx__list();
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:174: lines 174-176
		if (($index < 0) || ($index >= count($constructors))) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:175: characters 4-9
			throw HaxeException::thrown("" . ($index??'null') . " is not a valid enum constructor index");
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:178: characters 3-36
		$constr = $constructors[$index];
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:179: characters 3-92
		$paramsCounts = $phpName::__hx__paramsCount();
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:180: lines 180-182
		if ((($params === null) && ($paramsCounts[$constr] !== 0)) || (($params !== null) && ($params->length !== $paramsCounts[$constr]))) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:181: characters 4-9
			throw HaxeException::thrown("Provided parameters count does not match expected parameters count");
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:184: lines 184-189
		if ($params === null) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:185: characters 4-45
			return $phpName::{$constr}();
		} else {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:187: characters 4-60
			$nativeArgs = $params->arr;
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:188: characters 4-71
			return $phpName::{$constr}(...$nativeArgs);
		}
	}

	/**
	 * Creates an instance of class `cl`, using `args` as arguments to the
	 * class constructor.
	 * This function guarantees that the class constructor is called.
	 * Default values of constructors arguments are not guaranteed to be
	 * taken into account.
	 * If `cl` or `args` are null, or if the number of elements in `args` does
	 * not match the expected number of constructor arguments, or if any
	 * argument has an invalid type,  or if `cl` has no own constructor, the
	 * result is unspecified.
	 * In particular, default values of constructor arguments are not
	 * guaranteed to be taken into account.
	 * 
	 * @param Class $cl
	 * @param mixed[]|Array_hx $args
	 * 
	 * @return mixed
	 */
	public static function createInstance ($cl, $args) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:127: lines 127-128
		if (Boot::getClass('String') === $cl) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:128: characters 4-18
			return ($args->arr[0] ?? null);
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:130: characters 3-57
		$nativeArgs = $args->arr;
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:131: characters 27-53
		$tmp = $cl->phpClassName;
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:131: characters 3-80
		return new $tmp(...$nativeArgs);
	}

	/**
	 * Returns the constructor name of enum instance `e`.
	 * The result String does not contain any constructor arguments.
	 * If `e` is null, the result is unspecified.
	 * 
	 * @param mixed $e
	 * 
	 * @return string
	 */
	public static function enumConstructor ($e) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:329: characters 3-35
		return $e->tag;
	}

	/**
	 * Recursively compares two enum instances `a` and `b` by value.
	 * Unlike `a == b`, this function performs a deep equality check on the
	 * arguments of the constructors, if exists.
	 * If `a` or `b` are null, the result is unspecified.
	 * 
	 * @param mixed $a
	 * @param mixed $b
	 * 
	 * @return bool
	 */
	public static function enumEq ($a, $b) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:297: lines 297-298
		if (($a === $b)) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:298: characters 4-15
			return true;
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:299: lines 299-300
		if (($a === null) || ($b === null)) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:300: characters 4-16
			return false;
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:302: lines 302-325
		try {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:303: characters 30-63
			$tmp = get_class($b);
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:303: lines 303-304
			if (!($a instanceof $tmp)) {
				#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:304: characters 5-17
				return false;
			}
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:305: lines 305-306
			if ($a->index !== $b->index) {
				#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:306: characters 5-17
				return false;
			}
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:308: characters 4-75
			$aParams = $a->params;
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:309: characters 4-75
			$bParams = $b->params;
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:310: characters 14-18
			$_g = 0;
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:310: characters 18-39
			$_g1 = count($aParams);
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:310: lines 310-320
			while ($_g < $_g1) {
				#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:310: characters 14-39
				$i = $_g++;
				#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:312: lines 312-319
				if (($aParams[$i] instanceof HxEnum)) {
					#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:313: lines 313-315
					if (!Type::enumEq($aParams[$i], $bParams[$i])) {
						#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:314: characters 7-19
						return false;
					}
				} else {
					#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:317: characters 17-58
					$left = $aParams[$i];
					$right = $bParams[$i];
					#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:317: lines 317-319
					if (!(((is_int($left) || is_float($left)) && (is_int($right) || is_float($right)) ? ($left == $right) : (($left instanceof HxClosure) && ($right instanceof HxClosure) ? $left->equals($right) : ($left === $right))))) {
						#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:318: characters 6-18
						return false;
					}
				}
			}
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:322: characters 4-15
			return true;
		} catch(\Throwable $_g) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:323: characters 12-13
			NativeStackTrace::saveStack($_g);
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:324: characters 4-16
			return false;
		}
	}

	/**
	 * Returns the index of enum instance `e`.
	 * This corresponds to the original syntactic position of `e`. The index of
	 * the first declared constructor is 0, the next one is 1 etc.
	 * If `e` is null, the result is unspecified.
	 * 
	 * @param mixed $e
	 * 
	 * @return int
	 */
	public static function enumIndex ($e) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:337: characters 3-37
		return $e->index;
	}

	/**
	 * Returns a list of the constructor arguments of enum instance `e`.
	 * If `e` has no arguments, the result is [].
	 * Otherwise the result are the values that were used as arguments to `e`,
	 * in the order of their declaration.
	 * If `e` is null, the result is unspecified.
	 * 
	 * @param mixed $e
	 * 
	 * @return mixed[]|Array_hx
	 */
	public static function enumParameters ($e) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:333: characters 3-66
		return Array_hx::wrap($e->params);
	}

	/**
	 * Returns the class of `o`, if `o` is a class instance.
	 * If `o` is null or of a different type, null is returned.
	 * In general, type parameter information cannot be obtained at runtime.
	 * 
	 * @param mixed $o
	 * 
	 * @return Class
	 */
	public static function getClass ($o) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:43: lines 43-50
		if (is_object($o) && !($o instanceof HxClass) && !($o instanceof HxEnum)) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:44: characters 4-54
			$cls = Boot::getClass(get_class($o));
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:45: characters 11-45
			if (($o instanceof HxAnon)) {
				#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:45: characters 29-33
				return null;
			} else {
				#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:45: characters 36-44
				return $cls;
			}
		} else if (is_string($o)) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:47: characters 4-22
			return Boot::getClass('String');
		} else {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:49: characters 4-15
			return null;
		}
	}

	/**
	 * Returns a list of static fields of class `c`.
	 * This does not include static fields of parent classes.
	 * The order of the fields in the returned Array is unspecified.
	 * If `c` is null, the result is unspecified.
	 * 
	 * @param Class $c
	 * 
	 * @return string[]|Array_hx
	 */
	public static function getClassFields ($c) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:230: lines 230-231
		if ($c === null) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:231: characters 4-15
			return null;
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:232: lines 232-233
		if ($c === Boot::getClass('String')) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:233: characters 4-27
			return Array_hx::wrap(["fromCharCode"]);
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:235: characters 3-43
		$phpName = $c->phpClassName;
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:237: characters 3-49
		$reflection = new \ReflectionClass($phpName);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:239: characters 17-34
		$this1 = [];
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:239: characters 3-35
		$methods = $this1;
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:240: characters 13-62
		$data = $reflection->getMethods(\ReflectionMethod::IS_STATIC);
		$_g_current = 0;
		$_g_length = count($data);
		$_g_data = $data;
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:240: lines 240-245
		while ($_g_current < $_g_length) {
			$m = $_g_data[$_g_current++];
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:241: characters 4-27
			$name = $m->getName();
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:242: lines 242-244
			if (!(($name === "__construct") || (HxString::indexOf($name, "__hx_") === 0)) && ($phpName === $m->getDeclaringClass()->getName())) {
				#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:243: characters 5-29
				array_push($methods, $name);
			}
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:247: characters 20-37
		$this1 = [];
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:247: characters 3-38
		$properties = $this1;
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:248: characters 13-67
		$data = $reflection->getProperties(\ReflectionProperty::IS_STATIC);
		$_g1_current = 0;
		$_g1_length = count($data);
		$_g1_data = $data;
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:248: lines 248-253
		while ($_g1_current < $_g1_length) {
			$p = $_g1_data[$_g1_current++];
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:249: characters 4-27
			$name = $p->getName();
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:250: lines 250-252
			if (!(($name === "__construct") || (HxString::indexOf($name, "__hx_") === 0)) && ($phpName === $p->getDeclaringClass()->getName())) {
				#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:251: characters 5-32
				array_push($properties, $name);
			}
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:254: characters 3-13
		$properties = array_diff($properties, $methods);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:255: characters 3-56
		$fields = array_merge($properties, $methods);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:257: characters 3-44
		return Array_hx::wrap($fields);
	}

	/**
	 * Returns the name of class `c`, including its path.
	 * If `c` is inside a package, the package structure is returned dot-
	 * separated, with another dot separating the class name:
	 * `pack1.pack2.(...).packN.ClassName`
	 * If `c` is a sub-type of a Haxe module, that module is not part of the
	 * package structure.
	 * If `c` has no package, the class name is returned.
	 * If `c` is null, the result is unspecified.
	 * The class name does not include any type parameters.
	 * 
	 * @param Class $c
	 * 
	 * @return string
	 */
	public static function getClassName ($c) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:73: lines 73-74
		if ($c === null) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:74: characters 4-15
			return null;
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:75: characters 3-34
		return Boot::getHaxeName($c);
	}

	/**
	 * Returns the enum of enum instance `o`.
	 * An enum instance is the result of using an enum constructor. Given an
	 * `enum Color { Red; }`, `getEnum(Red)` returns `Enum<Color>`.
	 * If `o` is null, null is returned.
	 * In general, type parameter information cannot be obtained at runtime.
	 * 
	 * @param mixed $o
	 * 
	 * @return Enum
	 */
	public static function getEnum ($o) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:54: lines 54-55
		if ($o === null) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:55: characters 4-15
			return null;
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:56: characters 3-54
		return Boot::getClass(get_class($o));
	}

	/**
	 * Returns a list of the names of all constructors of enum `e`.
	 * The order of the constructor names in the returned Array is preserved
	 * from the original syntax.
	 * If `e` is null, the result is unspecified.
	 * 
	 * @param Enum $e
	 * 
	 * @return string[]|Array_hx
	 */
	public static function getEnumConstructs ($e) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:261: lines 261-262
		if ($e === null) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:262: characters 4-15
			return null;
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:263: characters 3-66
		return Array_hx::wrap($e->__hx__list());
	}

	/**
	 * Returns the name of enum `e`, including its path.
	 * If `e` is inside a package, the package structure is returned dot-
	 * separated, with another dot separating the enum name:
	 * `pack1.pack2.(...).packN.EnumName`
	 * If `e` is a sub-type of a Haxe module, that module is not part of the
	 * package structure.
	 * If `e` has no package, the enum name is returned.
	 * If `e` is null, the result is unspecified.
	 * The enum name does not include any type parameters.
	 * 
	 * @param Enum $e
	 * 
	 * @return string
	 */
	public static function getEnumName ($e) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:79: characters 3-30
		return Type::getClassName($e);
	}

	/**
	 * Returns a list of the instance fields of class `c`, including
	 * inherited fields.
	 * This only includes fields which are known at compile-time. In
	 * particular, using `getInstanceFields(getClass(obj))` will not include
	 * any fields which were added to `obj` at runtime.
	 * The order of the fields in the returned Array is unspecified.
	 * If `c` is null, the result is unspecified.
	 * 
	 * @param Class $c
	 * 
	 * @return string[]|Array_hx
	 */
	public static function getInstanceFields ($c) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:193: lines 193-194
		if ($c === null) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:194: characters 4-15
			return null;
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:195: lines 195-199
		if ($c === Boot::getClass('String')) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:196: lines 196-198
			return Array_hx::wrap([
				"substr",
				"charAt",
				"charCodeAt",
				"indexOf",
				"lastIndexOf",
				"split",
				"toLowerCase",
				"toUpperCase",
				"toString",
				"length",
			]);
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:201: characters 3-67
		$reflection = new \ReflectionClass($c->phpClassName);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:203: characters 17-34
		$this1 = [];
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:203: characters 3-35
		$methods = $this1;
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:204: characters 18-41
		$data = $reflection->getMethods();
		$_g_current = 0;
		$_g_length = count($data);
		$_g_data = $data;
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:204: lines 204-211
		while ($_g_current < $_g_length) {
			$method = $_g_data[$_g_current++];
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:205: lines 205-210
			if (!$method->isStatic()) {
				#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:206: characters 5-33
				$name = $method->getName();
				#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:207: lines 207-209
				if (!(($name === "__construct") || (HxString::indexOf($name, "__hx_") === 0))) {
					#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:208: characters 6-30
					array_push($methods, $name);
				}
			}
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:213: characters 20-37
		$this1 = [];
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:213: characters 3-38
		$properties = $this1;
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:214: characters 20-46
		$data = $reflection->getProperties();
		$_g1_current = 0;
		$_g1_length = count($data);
		$_g1_data = $data;
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:214: lines 214-221
		while ($_g1_current < $_g1_length) {
			$property = $_g1_data[$_g1_current++];
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:215: lines 215-220
			if (!$property->isStatic()) {
				#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:216: characters 5-35
				$name = $property->getName();
				#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:217: lines 217-219
				if (!(($name === "__construct") || (HxString::indexOf($name, "__hx_") === 0))) {
					#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:218: characters 6-33
					array_push($properties, $name);
				}
			}
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:222: characters 3-13
		$properties = array_diff($properties, $methods);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:224: characters 3-56
		$fields = array_merge($properties, $methods);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:226: characters 3-44
		return Array_hx::wrap($fields);
	}

	/**
	 * Returns the super-class of class `c`.
	 * If `c` has no super class, null is returned.
	 * If `c` is null, the result is unspecified.
	 * In general, type parameter information cannot be obtained at runtime.
	 * 
	 * @param Class $c
	 * 
	 * @return Class
	 */
	public static function getSuperClass ($c) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:60: lines 60-61
		if ($c === null) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:61: characters 4-15
			return null;
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:62: lines 62-66
		$parentClass = null;
		try {
			$parentClass = get_parent_class($c->phpClassName);
		} catch(\Throwable $_g) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:65: characters 4-15
			return null;
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:67: lines 67-68
		if (!$parentClass) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:68: characters 4-15
			return null;
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:69: characters 3-41
		return Boot::getClass($parentClass);
	}

	/**
	 * check if specified `name` is a special field name generated by compiler.
	 * 
	 * @param string $name
	 * 
	 * @return bool
	 */
	public static function isServiceFieldName ($name) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:362: characters 10-63
		if ($name !== "__construct") {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:362: characters 36-62
			return HxString::indexOf($name, "__hx_") === 0;
		} else {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:362: characters 10-63
			return true;
		}
	}

	/**
	 * Resolves a class by name.
	 * If `name` is the path of an existing class, that class is returned.
	 * Otherwise null is returned.
	 * If `name` is null or the path to a different type, the result is
	 * unspecified.
	 * The class name must not include any type parameters.
	 * 
	 * @param string $name
	 * 
	 * @return Class
	 */
	public static function resolveClass ($name) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:83: lines 83-84
		if ($name === null) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:84: characters 4-15
			return null;
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:85: lines 85-100
		if ($name === "Bool") {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:93: characters 5-21
			return Boot::getClass('Bool');
		} else if ($name === "Class") {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:97: characters 5-22
			return Boot::getClass('Class');
		} else if ($name === "Dynamic") {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:87: characters 5-24
			return Boot::getClass('Dynamic');
		} else if ($name === "Enum") {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:99: characters 5-21
			return Boot::getClass('Enum');
		} else if ($name === "Float") {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:91: characters 5-22
			return Boot::getClass('Float');
		} else if ($name === "Int") {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:89: characters 5-20
			return Boot::getClass('Int');
		} else if ($name === "String") {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:95: characters 5-18
			return Boot::getClass('String');
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:102: characters 3-40
		$phpClass = Boot::getPhpName($name);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:103: lines 103-104
		if (!class_exists($phpClass) && !interface_exists($phpClass)) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:104: characters 4-15
			return null;
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:106: characters 3-41
		$hxClass = Boot::getClass($phpClass);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:108: characters 3-22
		return $hxClass;
	}

	/**
	 * Resolves an enum by name.
	 * If `name` is the path of an existing enum, that enum is returned.
	 * Otherwise null is returned.
	 * If `name` is null the result is unspecified.
	 * If `name` is the path to a different type, null is returned.
	 * The enum name must not include any type parameters.
	 * 
	 * @param string $name
	 * 
	 * @return Enum
	 */
	public static function resolveEnum ($name) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:112: lines 112-113
		if ($name === null) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:113: characters 4-15
			return null;
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:114: lines 114-115
		if ($name === "Bool") {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:115: characters 4-20
			return Boot::getClass('Bool');
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:117: characters 3-40
		$phpClass = Boot::getPhpName($name);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:118: lines 118-119
		if (!class_exists($phpClass)) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:119: characters 4-15
			return null;
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:121: characters 3-41
		$hxClass = Boot::getClass($phpClass);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:123: characters 3-22
		return $hxClass;
	}

	/**
	 * Returns the runtime type of value `v`.
	 * The result corresponds to the type `v` has at runtime, which may vary
	 * per platform. Assumptions regarding this should be minimized to avoid
	 * surprises.
	 * 
	 * @param mixed $v
	 * 
	 * @return ValueType
	 */
	public static function typeof ($v) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:267: lines 267-268
		if ($v === null) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:268: characters 4-16
			return ValueType::TNull();
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:270: lines 270-282
		if (is_object($v)) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:271: lines 271-272
			if (($v instanceof \Closure) || ($v instanceof HxClosure)) {
				#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:272: characters 5-21
				return ValueType::TFunction();
			}
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:273: lines 273-274
			if (($v instanceof \StdClass)) {
				#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:274: characters 5-19
				return ValueType::TObject();
			}
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:275: lines 275-276
			if (($v instanceof HxClass)) {
				#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:276: characters 5-19
				return ValueType::TObject();
			}
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:278: characters 4-53
			$hxClass = Boot::getClass(get_class($v));
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:279: lines 279-280
			if (($v instanceof HxEnum)) {
				#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:280: characters 5-31
				return ValueType::TEnum($hxClass);
			}
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:281: characters 4-31
			return ValueType::TClass($hxClass);
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:284: lines 284-285
		if (is_bool($v)) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:285: characters 4-16
			return ValueType::TBool();
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:286: lines 286-287
		if (is_int($v)) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:287: characters 4-15
			return ValueType::TInt();
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:288: lines 288-289
		if (is_float($v)) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:289: characters 4-17
			return ValueType::TFloat();
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:290: lines 290-291
		if (is_string($v)) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:291: characters 4-25
			return ValueType::TClass(Boot::getClass('String'));
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Type.hx:293: characters 3-18
		return ValueType::TUnknown();
	}
}

Boot::registerClass(Type::class, 'Type');
