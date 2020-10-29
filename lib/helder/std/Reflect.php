<?php
/**
 * Generated by Haxe 4.0.3
 */

namespace helder\std;

use \helder\std\php\_Boot\HxAnon;
use \helder\std\php\Boot;
use \helder\std\php\_Boot\HxClass;
use \helder\std\php\_Boot\HxClosure;
use \helder\std\php\_Boot\HxEnum;

/**
 * The Reflect API is a way to manipulate values dynamically through an
 * abstract interface in an untyped manner. Use with care.
 * @see https://haxe.org/manual/std-reflection.html
 */
class Reflect {
	/**
	 * Call a method `func` with the given arguments `args`.
	 * The object `o` is ignored in most cases. It serves as the `this`-context in the following
	 * situations:
	 * (neko) Allows switching the context to `o` in all cases.
	 * (macro) Same as neko for Haxe 3. No context switching in Haxe 4.
	 * (js, lua) Require the `o` argument if `func` does not, but should have a context.
	 * This can occur by accessing a function field natively, e.g. through `Reflect.field`
	 * or by using `(object : Dynamic).field`. However, if `func` has a context, `o` is
	 * ignored like on other targets.
	 * 
	 * @param mixed $o
	 * @param mixed $func
	 * @param Array_hx $args
	 * 
	 * @return mixed
	 */
	public static function callMethod ($o, $func, $args) {
		#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:113: characters 3-69
		return call_user_func_array($func, $args->arr);
	}

	/**
	 * Compares `a` and `b`.
	 * If `a` is less than `b`, the result is negative. If `b` is less than
	 * `a`, the result is positive. If `a` and `b` are equal, the result is 0.
	 * This function is only defined if `a` and `b` are of the same type.
	 * If that type is a function, the result is unspecified and
	 * `Reflect.compareMethods` should be used instead.
	 * For all other types, the result is 0 if `a` and `b` are equal. If they
	 * are not equal, the result depends on the type and is negative if:
	 * - Numeric types: a is less than b
	 * - String: a is lexicographically less than b
	 * - Other: unspecified
	 * If `a` and `b` are null, the result is 0. If only one of them is null,
	 * the result is unspecified.
	 * 
	 * @param mixed $a
	 * @param mixed $b
	 * 
	 * @return int
	 */
	public static function compare ($a, $b) {
		#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:128: lines 128-129
		if (Boot::equal($a, $b)) {
			#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:129: characters 4-12
			return 0;
		}
		#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:130: lines 130-134
		if (is_string($a)) {
			#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:131: characters 4-40
			return strcmp($a, $b);
		} else if ($a > $b) {
			#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:133: characters 34-35
			return 1;
		} else {
			#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:133: characters 38-40
			return -1;
		}
	}

	/**
	 * Compares the functions `f1` and `f2`.
	 * If `f1` or `f2` are null, the result is false.
	 * If `f1` or `f2` are not functions, the result is unspecified.
	 * Otherwise the result is true if `f1` and the `f2` are physically equal,
	 * false otherwise.
	 * If `f1` or `f2` are member method closures, the result is true if they
	 * are closures of the same method on the same object value, false otherwise.
	 * 
	 * @param mixed $f1
	 * @param mixed $f2
	 * 
	 * @return bool
	 */
	public static function compareMethods ($f1, $f2) {
		#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:138: lines 138-142
		if (($f1 instanceof HxClosure) && ($f2 instanceof HxClosure)) {
			#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:139: characters 4-24
			return $f1->equals($f2);
		} else {
			#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:141: characters 4-19
			return Boot::equal($f1, $f2);
		}
	}

	/**
	 * Copies the fields of structure `o`.
	 * This is only guaranteed to work on anonymous structures.
	 * If `o` is null, the result is `null`.
	 * 
	 * @param mixed $o
	 * 
	 * @return mixed
	 */
	public static function copy ($o) {
		#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:167: lines 167-171
		if (($o instanceof HxAnon)) {
			#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:168: characters 4-26
			return (clone $o);
		} else {
			#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:170: characters 4-15
			return null;
		}
	}

	/**
	 * Removes the field named `field` from structure `o`.
	 * This method is only guaranteed to work on anonymous structures.
	 * If `o` or `field` are null, the result is unspecified.
	 * 
	 * @param mixed $o
	 * @param string $field
	 * 
	 * @return bool
	 */
	public static function deleteField ($o, $field) {
		#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:158: lines 158-163
		if (Reflect::hasField($o, $field)) {
			#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:159: characters 30-31
			$tmp = $o;
			#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:159: characters 4-40
			unset($tmp->{$field});
			#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:160: characters 4-15
			return true;
		} else {
			#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:162: characters 4-16
			return false;
		}
	}

	/**
	 * Returns the value of the field named `field` on object `o`.
	 * If `o` is not an object or has no field named `field`, the result is
	 * null.
	 * If the field is defined as a property, its accessors are ignored. Refer
	 * to `Reflect.getProperty` for a function supporting property accessors.
	 * If `field` is null, the result is unspecified.
	 * (As3) If used on a property field, the getter will be invoked. It is
	 * not possible to obtain the value directly.
	 * 
	 * @param mixed $o
	 * @param string $field
	 * 
	 * @return mixed
	 */
	public static function field ($o, $field) {
		#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:50: lines 50-52
		if (is_string($o)) {
			#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:51: characters 24-45
			$tmp = Boot::dynamicString($o);
			#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:51: characters 4-53
			return $tmp->{$field};
		}
		#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:53: lines 53-54
		if (!is_object($o)) {
			#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:54: characters 4-15
			return null;
		}
		#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:56: lines 56-58
		if (($field === "") && (PHP_VERSION_ID < 70100)) {
			#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:57: characters 4-56
			return (((array)($o))[$field] ?? null);
		}
		#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:60: lines 60-62
		if (property_exists($o, $field)) {
			#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:61: characters 24-25
			$tmp1 = $o;
			#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:61: characters 4-33
			return $tmp1->{$field};
		}
		#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:63: lines 63-65
		if (method_exists($o, $field)) {
			#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:64: characters 4-44
			return Boot::getInstanceClosure($o, $field);
		}
		#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:67: lines 67-78
		if (($o instanceof HxClass)) {
			#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:68: characters 4-54
			$phpClassName = $o->phpClassName;
			#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:69: lines 69-71
			if (defined("" . ($phpClassName??'null') . "::" . ($field??'null'))) {
				#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:70: characters 5-52
				return constant("" . ($phpClassName??'null') . "::" . ($field??'null'));
			}
			#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:72: lines 72-74
			if (property_exists($phpClassName, $field)) {
				#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:73: characters 25-26
				$tmp2 = $o;
				#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:73: characters 5-34
				return $tmp2->{$field};
			}
			#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:75: lines 75-77
			if (method_exists($phpClassName, $field)) {
				#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:76: characters 5-54
				return Boot::getStaticClosure($phpClassName, $field);
			}
		}
		#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:80: characters 3-14
		return null;
	}

	/**
	 * Returns the fields of structure `o`.
	 * This method is only guaranteed to work on anonymous structures. Refer to
	 * `Type.getInstanceFields` for a function supporting class instances.
	 * If `o` is null, the result is unspecified.
	 * 
	 * @param mixed $o
	 * 
	 * @return Array_hx
	 */
	public static function fields ($o) {
		#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:117: lines 117-119
		if (is_object($o)) {
			#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:118: characters 4-77
			return Array_hx::wrap(array_keys(get_object_vars($o)));
		}
		#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:120: characters 3-12
		return new Array_hx();
	}

	/**
	 * Returns the value of the field named `field` on object `o`, taking
	 * property getter functions into account.
	 * If the field is not a property, this function behaves like
	 * `Reflect.field`, but might be slower.
	 * If `o` or `field` are null, the result is unspecified.
	 * 
	 * @param mixed $o
	 * @param string $field
	 * 
	 * @return mixed
	 */
	public static function getProperty ($o, $field) {
		#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:88: lines 88-97
		if (is_object($o)) {
			#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:89: lines 89-96
			if (($o instanceof HxClass)) {
				#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:90: characters 5-55
				$phpClassName = $o->phpClassName;
				#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:91: lines 91-93
				if (Boot::hasGetter($phpClassName, $field)) {
					#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:92: characters 31-43
					$tmp = $phpClassName;
					#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:92: characters 6-58
					return $tmp::{"get_" . ($field??'null')}();
				}
			} else if (Boot::hasGetter(get_class($o), $field)) {
				#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:95: characters 24-25
				$tmp1 = $o;
				#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:95: characters 5-40
				return $tmp1->{"get_" . ($field??'null')}();
			}
		}
		#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:99: characters 3-33
		return Reflect::field($o, $field);
	}

	/**
	 * Tells if structure `o` has a field named `field`.
	 * This is only guaranteed to work for anonymous structures. Refer to
	 * `Type.getInstanceFields` for a function supporting class instances.
	 * If `o` or `field` are null, the result is unspecified.
	 * 
	 * @param mixed $o
	 * @param string $field
	 * 
	 * @return bool
	 */
	public static function hasField ($o, $field) {
		#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:34: lines 34-35
		if (!is_object($o)) {
			#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:35: characters 4-16
			return false;
		}
		#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:36: lines 36-37
		if (property_exists($o, $field)) {
			#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:37: characters 4-15
			return true;
		}
		#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:39: lines 39-44
		if (($o instanceof HxClass)) {
			#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:40: characters 4-54
			$phpClassName = $o->phpClassName;
			#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:41: lines 41-43
			if (!(property_exists($phpClassName, $field) || method_exists($phpClassName, $field))) {
				#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:43: characters 8-47
				return defined("" . ($phpClassName??'null') . "::" . ($field??'null'));
			} else {
				#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:41: lines 41-43
				return true;
			}
		}
		#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:46: characters 3-15
		return false;
	}

	/**
	 * Tells if `v` is an enum value.
	 * The result is true if `v` is of type EnumValue, i.e. an enum
	 * constructor.
	 * Otherwise, including if `v` is null, the result is false.
	 * 
	 * @param mixed $v
	 * 
	 * @return bool
	 */
	public static function isEnumValue ($v) {
		#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:154: characters 3-29
		return ($v instanceof HxEnum);
	}

	/**
	 * Returns true if `f` is a function, false otherwise.
	 * If `f` is null, the result is false.
	 * 
	 * @param mixed $f
	 * 
	 * @return bool
	 */
	public static function isFunction ($f) {
		#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:124: characters 10-28
		if (!($f instanceof \Closure)) {
			return ($f instanceof HxClosure);
		} else {
			return true;
		}
	}

	/**
	 * Tells if `v` is an object.
	 * The result is true if `v` is one of the following:
	 * - class instance
	 * - structure
	 * - `Class<T>`
	 * - `Enum<T>`
	 * Otherwise, including if `v` is null, the result is false.
	 * 
	 * @param mixed $v
	 * 
	 * @return bool
	 */
	public static function isObject ($v) {
		#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:146: lines 146-150
		if (($v instanceof HxEnum)) {
			#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:147: characters 4-16
			return false;
		} else if (!is_object($v)) {
			#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:149: characters 28-41
			return is_string($v);
		} else {
			#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:149: characters 11-41
			return true;
		}
	}

	/**
	 * Transform a function taking an array of arguments into a function that can
	 * be called with any number of arguments.
	 * 
	 * @param \Closure $f
	 * 
	 * @return mixed
	 */
	public static function makeVarArgs ($f) {
		#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:176: lines 176-178
		return function ()  use (&$f) {
			#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:177: characters 52-86
			$tmp = Array_hx::wrap(func_get_args());
			#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:177: characters 4-87
			return call_user_func($f, $tmp);
		};
	}

	/**
	 * Sets the field named `field` of object `o` to value `value`.
	 * If `o` has no field named `field`, this function is only guaranteed to
	 * work for anonymous structures.
	 * If `o` or `field` are null, the result is unspecified.
	 * (As3) If used on a property field, the setter will be invoked. It is
	 * not possible to set the value directly.
	 * 
	 * @param mixed $o
	 * @param string $field
	 * @param mixed $value
	 * 
	 * @return void
	 */
	public static function setField ($o, $field, $value) {
		#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:84: characters 19-20
		$tmp = $o;
		#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:84: characters 3-35
		$tmp->{$field} = $value;
	}

	/**
	 * Sets the field named `field` of object `o` to value `value`, taking
	 * property setter functions into account.
	 * If the field is not a property, this function behaves like
	 * `Reflect.setField`, but might be slower.
	 * If `field` is null, the result is unspecified.
	 * 
	 * @param mixed $o
	 * @param string $field
	 * @param mixed $value
	 * 
	 * @return void
	 */
	public static function setProperty ($o, $field, $value) {
		#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:103: lines 103-109
		if (is_object($o)) {
			#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:104: lines 104-108
			if (Boot::hasSetter(get_class($o), $field)) {
				#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:105: characters 17-18
				$tmp = $o;
				#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:105: characters 5-40
				$tmp->{"set_" . ($field??'null')}($value);
			} else {
				#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:107: characters 21-22
				$tmp1 = $o;
				#/home/runner/haxe/versions/4.0.3/std/php/_std/Reflect.hx:107: characters 5-37
				$tmp1->{$field} = $value;
			}
		}
	}
}

Boot::registerClass(Reflect::class, 'Reflect');
