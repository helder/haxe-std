<?php
/**
 * Generated by Haxe 4.1.4
 */

namespace helder\std\haxe;

use \helder\std\php\_Boot\HxAnon;
use \helder\std\php\Boot;
use \helder\std\Array_hx;
use \helder\std\haxe\format\JsonPrinter;

/**
 * Cross-platform JSON API: it will automatically use the optimized native API if available.
 * Use `-D haxeJSON` to force usage of the Haxe implementation even if a native API is found:
 * This will provide extra encoding features such as enums (replaced by their index) and StringMaps.
 * @see https://haxe.org/manual/std-Json.html
 */
class Json {
	/**
	 * @param mixed $value
	 * 
	 * @return mixed
	 */
	public static function convertAfterDecode ($value) {
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/Json.hx:55: lines 55-63
		if (\is_object($value)) {
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/Json.hx:56: characters 17-39
			$this1 = [];
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/Json.hx:56: characters 4-40
			$result = $this1;
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/Json.hx:57: characters 4-35
			$data = ((array)($value));
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/Json.hx:58: lines 58-60
			foreach ($data as $key => $value1) {
				#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/Json.hx:59: characters 5-55
				$result[$key] = Json::convertAfterDecode($value1);
			}
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/Json.hx:62: characters 4-34
			return new HxAnon($result);
		}
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/Json.hx:65: lines 65-72
		if (\is_array($value)) {
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/Json.hx:66: characters 17-41
			$this1 = [];
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/Json.hx:66: characters 4-42
			$result = $this1;
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/Json.hx:67: lines 67-69
			$collection = $value;
			foreach ($collection as $key => $value1) {
				#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/Json.hx:68: characters 5-45
				$result[$key] = Json::convertAfterDecode($value1);
			}
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/Json.hx:71: characters 4-45
			return Array_hx::wrap($result);
		}
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/Json.hx:74: characters 3-15
		return $value;
	}

	/**
	 * @param mixed $value
	 * 
	 * @return mixed
	 */
	public static function convertBeforeEncode ($value) {
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/Json.hx:90: lines 90-97
		if (($value instanceof Array_hx)) {
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/Json.hx:91: characters 17-41
			$this1 = [];
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/Json.hx:91: characters 4-42
			$result = $this1;
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/Json.hx:92: lines 92-94
			$collection = Boot::dynamicField($value, 'arr');
			foreach ($collection as $key => $value1) {
				#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/Json.hx:93: characters 5-46
				$result[$key] = Json::convertBeforeEncode($value1);
			}
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/Json.hx:96: characters 4-17
			return $result;
		}
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/Json.hx:99: lines 99-106
		if (\is_object($value)) {
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/Json.hx:100: characters 4-20
			$result = new HxAnon();
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/Json.hx:101: lines 101-103
			$collection = $value;
			foreach ($collection as $key => $value1) {
				#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/Json.hx:102: characters 5-72
				$result->{$key} = Json::convertBeforeEncode($value1);
			}
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/Json.hx:105: characters 4-17
			return $result;
		}
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/Json.hx:108: lines 108-110
		if (\is_float($value) && !\is_finite($value)) {
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/Json.hx:109: characters 4-15
			return null;
		}
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/Json.hx:112: characters 3-15
		return $value;
	}

	/**
	 * Parses given JSON-encoded `text` and returns the resulting object.
	 * JSON objects are parsed into anonymous structures and JSON arrays
	 * are parsed into `Array<Dynamic>`.
	 * If given `text` is not valid JSON, an exception will be thrown.
	 * @see https://haxe.org/manual/std-Json-parsing.html
	 * 
	 * @param string $text
	 * 
	 * @return mixed
	 */
	public static function parse ($text) {
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/Json.hx:34: characters 3-29
		return Json::phpJsonDecode($text);
	}

	/**
	 * @param string $json
	 * 
	 * @return mixed
	 */
	public static function phpJsonDecode ($json) {
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/Json.hx:47: characters 3-40
		$value = \json_decode($json);
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/Json.hx:48: lines 48-50
		if (($value === null) && (\json_last_error() !== \JSON_ERROR_NONE)) {
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/Json.hx:49: characters 4-9
			throw Exception::thrown(\json_last_error_msg());
		}
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/Json.hx:51: characters 3-35
		return Json::convertAfterDecode($value);
	}

	/**
	 * @param mixed $value
	 * @param \Closure $replacer
	 * @param string $space
	 * 
	 * @return string
	 */
	public static function phpJsonEncode ($value, $replacer = null, $space = null) {
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/Json.hx:78: lines 78-80
		if ((null !== $replacer) || (null !== $space)) {
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/Json.hx:79: characters 4-52
			return JsonPrinter::print($value, $replacer, $space);
		}
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/Json.hx:82: characters 3-61
		$json = \json_encode(Json::convertBeforeEncode($value));
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/Json.hx:83: lines 83-85
		if (\json_last_error() !== \JSON_ERROR_NONE) {
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/Json.hx:84: characters 11-16
			throw Exception::thrown(\json_last_error_msg());
		}
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/Json.hx:86: characters 3-14
		return $json;
	}

	/**
	 * Encodes the given `value` and returns the resulting JSON string.
	 * If `replacer` is given and is not null, it is used to retrieve the
	 * actual object to be encoded. The `replacer` function takes two parameters,
	 * the key and the value being encoded. Initial key value is an empty string.
	 * If `space` is given and is not null, the result will be pretty-printed.
	 * Successive levels will be indented by this string.
	 * @see https://haxe.org/manual/std-Json-encoding.html
	 * 
	 * @param mixed $value
	 * @param \Closure $replacer
	 * @param string $space
	 * 
	 * @return string
	 */
	public static function stringify ($value, $replacer = null, $space = null) {
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/Json.hx:42: characters 3-47
		return Json::phpJsonEncode($value, $replacer, $space);
	}
}

Boot::registerClass(Json::class, 'haxe.Json');
