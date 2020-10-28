<?php
/**
 * Generated by Haxe 4.1.4
 */

namespace helder\std;

use \helder\std\php\Boot;
use \helder\std\haxe\iterators\StringIterator;
use \helder\std\php\_Boot\HxString;
use \helder\std\haxe\iterators\StringKeyValueIterator;
use \helder\std\haxe\SysTools;

/**
 * This class provides advanced methods on Strings. It is ideally used with
 * `using StringTools` and then acts as an [extension](https://haxe.org/manual/lf-static-extension.html)
 * to the `String` class.
 * If the first argument to any of the methods is null, the result is
 * unspecified.
 */
class StringTools {
	/**
	 * @var Array_hx
	 * Character codes of the characters that will be escaped by `quoteWinArg(_, true)`.
	 */
	static public $winMetaCharacters;

	/**
	 * Returns `true` if `s` contains `value` and  `false` otherwise.
	 * When `value` is `null`, the result is unspecified.
	 * 
	 * @param string $s
	 * @param string $value
	 * 
	 * @return bool
	 */
	public static function contains ($s, $value) {
		#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:45: characters 3-32
		return HxString::indexOf($s, $value) !== -1;
	}

	/**
	 * Tells if the string `s` ends with the string `end`.
	 * If `end` is `null`, the result is unspecified.
	 * If `end` is the empty String `""`, the result is true.
	 * 
	 * @param string $s
	 * @param string $end
	 * 
	 * @return bool
	 */
	public static function endsWith ($s, $end) {
		#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:53: characters 10-67
		if ($end !== "") {
			#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:53: characters 23-67
			return substr($s, -strlen($end)) === $end;
		} else {
			#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:53: characters 10-67
			return true;
		}
	}

	/**
	 * Returns the character code at position `index` of String `s`, or an
	 * end-of-file indicator at if `position` equals `s.length`.
	 * This method is faster than `String.charCodeAt()` on some platforms, but
	 * the result is unspecified if `index` is negative or greater than
	 * `s.length`.
	 * End of file status can be checked by calling `StringTools.isEof()` with
	 * the returned value as argument.
	 * This operation is not guaranteed to work if `s` contains the `\0`
	 * character.
	 * 
	 * @param string $s
	 * @param int $index
	 * 
	 * @return int
	 */
	public static function fastCodeAt ($s, $index) {
		#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:121: characters 3-76
		$char = ($index === 0 ? $s : mb_substr($s, $index, 1));
		#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:122: lines 122-123
		if ($char === "") {
			#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:123: characters 4-12
			return 0;
		}
		#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:124: characters 10-30
		$code = ord($char[0]);
		if ($code < 192) {
			return $code;
		} else if ($code < 224) {
			return (($code - 192) << 6) + ord($char[1]) - 128;
		} else if ($code < 240) {
			return (($code - 224) << 12) + ((ord($char[1]) - 128) << 6) + ord($char[2]) - 128;
		} else {
			return (($code - 240) << 18) + ((ord($char[1]) - 128) << 12) + ((ord($char[2]) - 128) << 6) + ord($char[3]) - 128;
		}
	}

	/**
	 * Encodes `n` into a hexadecimal representation.
	 * If `digits` is specified, the resulting String is padded with "0" until
	 * its `length` equals `digits`.
	 * 
	 * @param int $n
	 * @param int $digits
	 * 
	 * @return string
	 */
	public static function hex ($n, $digits = null) {
		#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:111: characters 3-28
		$s = dechex($n);
		#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:112: characters 3-15
		$len = 8;
		#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:113: characters 7-23
		$tmp = strlen($s);
		#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:113: characters 26-86
		$tmp1 = null;
		if (null === $digits) {
			$tmp1 = $len;
		} else {
			#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:113: characters 57-84
			if ($digits > $len) {
				#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:113: characters 72-78
				$len = $digits;
			}
			#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:113: characters 26-86
			$tmp1 = $len;
		}
		#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:113: lines 113-116
		if ($tmp > $tmp1) {
			#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:114: characters 8-22
			$s = mb_substr($s, -$len, null);
		} else if ($digits !== null) {
			#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:116: characters 4-28
			$s = StringTools::lpad($s, "0", $digits);
		}
		#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:117: characters 3-25
		return mb_strtoupper($s);
	}

	/**
	 * Escapes HTML special characters of the string `s`.
	 * The following replacements are made:
	 * - `&` becomes `&amp`;
	 * - `<` becomes `&lt`;
	 * - `>` becomes `&gt`;
	 * If `quotes` is true, the following characters are also replaced:
	 * - `"` becomes `&quot`;
	 * - `'` becomes `&#039`;
	 * 
	 * @param string $s
	 * @param bool $quotes
	 * 
	 * @return string
	 */
	public static function htmlEscape ($s, $quotes = null) {
		#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:37: characters 3-106
		return htmlspecialchars($s, ($quotes ? ENT_QUOTES | ENT_HTML401 : ENT_NOQUOTES));
	}

	/**
	 * Unescapes HTML special characters of the string `s`.
	 * This is the inverse operation to htmlEscape, i.e. the following always
	 * holds: `htmlUnescape(htmlEscape(s)) == s`
	 * The replacements follow:
	 * - `&amp;` becomes `&`
	 * - `&lt;` becomes `<`
	 * - `&gt;` becomes `>`
	 * - `&quot;` becomes `"`
	 * - `&#039;` becomes `'`
	 * 
	 * @param string $s
	 * 
	 * @return string
	 */
	public static function htmlUnescape ($s) {
		#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:41: characters 3-61
		return htmlspecialchars_decode($s, ENT_QUOTES);
	}

	/**
	 * Tells if `c` represents the end-of-file (EOF) character.
	 * 
	 * @param int $c
	 * 
	 * @return bool
	 */
	public static function isEof ($c) {
		#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:136: characters 3-16
		return $c === 0;
	}

	/**
	 * Tells if the character in the string `s` at position `pos` is a space.
	 * A character is considered to be a space character if its character code
	 * is 9,10,11,12,13 or 32.
	 * If `s` is the empty String `""`, or if pos is not a valid position within
	 * `s`, the result is false.
	 * 
	 * @param string $s
	 * @param int $pos
	 * 
	 * @return bool
	 */
	public static function isSpace ($s, $pos) {
		#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:57: characters 3-29
		$c = HxString::charCodeAt($s, $pos);
		#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:58: characters 10-40
		if (!(($c >= 9) && ($c <= 13))) {
			#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:58: characters 33-40
			return $c === 32;
		} else {
			#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:58: characters 10-40
			return true;
		}
	}

	/**
	 * Returns an iterator of the char codes.
	 * Note that char codes may differ across platforms because of different
	 * internal encoding of strings in different runtimes.
	 * For the consistent cross-platform UTF8 char codes see `haxe.iterators.StringIteratorUnicode`.
	 * 
	 * @param string $s
	 * 
	 * @return StringIterator
	 */
	public static function iterator ($s) {
		#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:128: characters 3-31
		return new StringIterator($s);
	}

	/**
	 * Returns an iterator of the char indexes and codes.
	 * Note that char codes may differ across platforms because of different
	 * internal encoding of strings in different of runtimes.
	 * For the consistent cross-platform UTF8 char codes see `haxe.iterators.StringKeyValueIteratorUnicode`.
	 * 
	 * @param string $s
	 * 
	 * @return StringKeyValueIterator
	 */
	public static function keyValueIterator ($s) {
		#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:132: characters 3-39
		return new StringKeyValueIterator($s);
	}

	/**
	 * Concatenates `c` to `s` until `s.length` is at least `l`.
	 * If `c` is the empty String `""` or if `l` does not exceed `s.length`,
	 * `s` is returned unchanged.
	 * If `c.length` is 1, the resulting String length is exactly `l`.
	 * Otherwise the length may exceed `l`.
	 * If `c` is null, the result is unspecified.
	 * 
	 * @param string $s
	 * @param string $c
	 * @param int $l
	 * 
	 * @return string
	 */
	public static function lpad ($s, $c, $l) {
		#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:89: characters 3-26
		$cLength = mb_strlen($c);
		#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:90: characters 3-26
		$sLength = mb_strlen($s);
		#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:91: lines 91-92
		if (($cLength === 0) || ($sLength >= $l)) {
			#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:92: characters 4-12
			return $s;
		}
		#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:93: characters 3-31
		$padLength = $l - $sLength;
		#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:94: characters 3-50
		$padCount = (int)(($padLength / $cLength));
		#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:95: lines 95-100
		if ($padCount > 0) {
			#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:96: characters 4-106
			$result = str_pad($s, strlen($s) + $padCount * strlen($c), $c, STR_PAD_LEFT);
			#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:97: characters 11-80
			if (($padCount * $cLength) >= $padLength) {
				#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:97: characters 47-53
				return $result;
			} else {
				#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:97: characters 56-80
				return ($c . $result);
			}
		} else {
			#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:99: characters 4-30
			return ($c . $s);
		}
	}

	/**
	 * Removes leading space characters of `s`.
	 * This function internally calls `isSpace()` to decide which characters to
	 * remove.
	 * If `s` is the empty String `""` or consists only of space characters, the
	 * result is the empty String `""`.
	 * 
	 * @param string $s
	 * 
	 * @return string
	 */
	public static function ltrim ($s) {
		#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:62: characters 3-25
		return ltrim($s);
	}

	/**
	 * Returns a String that can be used as a single command line argument
	 * on Unix.
	 * The input will be quoted, or escaped if necessary.
	 * 
	 * @param string $argument
	 * 
	 * @return string
	 */
	public static function quoteUnixArg ($argument) {
		#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:142: characters 10-53
		if ($argument === "") {
			return "''";
		} else if (!(new EReg("[^a-zA-Z0-9_@%+=:,./-]", ""))->match($argument)) {
			#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:142: characters 44-52
			return $argument;
		} else {
			#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:142: characters 10-53
			return "'" . (StringTools::replace($argument, "'", "'\"'\"'")??'null') . "'";
		}
	}

	/**
	 * Returns a String that can be used as a single command line argument
	 * on Windows.
	 * The input will be quoted, or escaped if necessary, such that the output
	 * will be parsed as a single argument using the rule specified in
	 * http://msdn.microsoft.com/en-us/library/ms880421
	 * Examples:
	 * ```haxe
	 * quoteWinArg("abc") == "abc";
	 * quoteWinArg("ab c") == '"ab c"';
	 * ```
	 * 
	 * @param string $argument
	 * @param bool $escapeMetaCharacters
	 * 
	 * @return string
	 */
	public static function quoteWinArg ($argument, $escapeMetaCharacters) {
		#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:152: characters 10-74
		$argument1 = $argument;
		if (!(new EReg("^[^ \x09\\\\\"]+\$", ""))->match($argument1)) {
			$result = new StringBuf();
			$needquote = (HxString::indexOf($argument1, " ") !== -1) || (HxString::indexOf($argument1, "\x09") !== -1) || ($argument1 === "");
			if ($needquote) {
				$result->add("\"");
			}
			$bs_buf = new StringBuf();
			$_g = 0;
			$_g1 = mb_strlen($argument1);
			while ($_g < $_g1) {
				$i = $_g++;
				$_g2 = HxString::charCodeAt($argument1, $i);
				if ($_g2 === null) {
					$c = $_g2;
					if (mb_strlen($bs_buf->b) > 0) {
						$result->add($bs_buf->b);
						$bs_buf = new StringBuf();
					}
					$result1 = $result;
					$result1->b = ($result1->b??'null') . (mb_chr($c)??'null');
				} else {
					if ($_g2 === 34) {
						$bs = $bs_buf->b;
						$result->add($bs);
						$result->add($bs);
						$bs_buf = new StringBuf();
						$result->add("\\\"");
					} else if ($_g2 === 92) {
						$bs_buf->add("\\");
					} else {
						$c1 = $_g2;
						if (mb_strlen($bs_buf->b) > 0) {
							$result->add($bs_buf->b);
							$bs_buf = new StringBuf();
						}
						$result2 = $result;
						$result2->b = ($result2->b??'null') . (mb_chr($c1)??'null');
					}
				}
			}
			$result->add($bs_buf->b);
			if ($needquote) {
				$result->add($bs_buf->b);
				$result->add("\"");
			}
			$argument1 = $result->b;
		}
		if ($escapeMetaCharacters) {
			$result = new StringBuf();
			$_g = 0;
			$_g1 = mb_strlen($argument1);
			while ($_g < $_g1) {
				$i = $_g++;
				$c = HxString::charCodeAt($argument1, $i);
				if (SysTools::$winMetaCharacters->indexOf($c) >= 0) {
					$result1 = $result;
					$result1->b = ($result1->b??'null') . (mb_chr(94)??'null');
				}
				$result2 = $result;
				$result2->b = ($result2->b??'null') . (mb_chr($c)??'null');
			}
			return $result->b;
		} else {
			return $argument1;
		}
	}

	/**
	 * Replace all occurrences of the String `sub` in the String `s` by the
	 * String `by`.
	 * If `sub` is the empty String `""`, `by` is inserted after each character
	 * of `s` except the last one. If `by` is also the empty String `""`, `s`
	 * remains unchanged.
	 * If `sub` or `by` are null, the result is unspecified.
	 * 
	 * @param string $s
	 * @param string $sub
	 * @param string $by
	 * 
	 * @return string
	 */
	public static function replace ($s, $sub, $by) {
		#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:104: lines 104-106
		if ($sub === "") {
			#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:105: characters 4-89
			return implode($by, preg_split("//u", $s, -1, PREG_SPLIT_NO_EMPTY));
		}
		#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:107: characters 3-40
		return str_replace($sub, $by, $s);
	}

	/**
	 * Appends `c` to `s` until `s.length` is at least `l`.
	 * If `c` is the empty String `""` or if `l` does not exceed `s.length`,
	 * `s` is returned unchanged.
	 * If `c.length` is 1, the resulting String length is exactly `l`.
	 * Otherwise the length may exceed `l`.
	 * If `c` is null, the result is unspecified.
	 * 
	 * @param string $s
	 * @param string $c
	 * @param int $l
	 * 
	 * @return string
	 */
	public static function rpad ($s, $c, $l) {
		#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:74: characters 3-26
		$cLength = mb_strlen($c);
		#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:75: characters 3-26
		$sLength = mb_strlen($s);
		#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:76: lines 76-77
		if (($cLength === 0) || ($sLength >= $l)) {
			#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:77: characters 4-12
			return $s;
		}
		#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:78: characters 3-31
		$padLength = $l - $sLength;
		#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:79: characters 3-50
		$padCount = (int)(($padLength / $cLength));
		#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:80: lines 80-85
		if ($padCount > 0) {
			#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:81: characters 4-107
			$result = str_pad($s, strlen($s) + $padCount * strlen($c), $c, STR_PAD_RIGHT);
			#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:82: characters 11-80
			if (($padCount * $cLength) >= $padLength) {
				#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:82: characters 47-53
				return $result;
			} else {
				#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:82: characters 56-80
				return ($result . $c);
			}
		} else {
			#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:84: characters 4-30
			return ($s . $c);
		}
	}

	/**
	 * Removes trailing space characters of `s`.
	 * This function internally calls `isSpace()` to decide which characters to
	 * remove.
	 * If `s` is the empty String `""` or consists only of space characters, the
	 * result is the empty String `""`.
	 * 
	 * @param string $s
	 * 
	 * @return string
	 */
	public static function rtrim ($s) {
		#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:66: characters 3-25
		return rtrim($s);
	}

	/**
	 * Tells if the string `s` starts with the string `start`.
	 * If `start` is `null`, the result is unspecified.
	 * If `start` is the empty String `""`, the result is true.
	 * 
	 * @param string $s
	 * @param string $start
	 * 
	 * @return bool
	 */
	public static function startsWith ($s, $start) {
		#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:49: characters 10-75
		if ($start !== "") {
			#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:49: characters 25-75
			return substr($s, 0, strlen($start)) === $start;
		} else {
			#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:49: characters 10-75
			return true;
		}
	}

	/**
	 * Removes leading and trailing space characters of `s`.
	 * This is a convenience function for `ltrim(rtrim(s))`.
	 * 
	 * @param string $s
	 * 
	 * @return string
	 */
	public static function trim ($s) {
		#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:70: characters 3-24
		return trim($s);
	}

	/**
	 * Decode an URL using the standard format.
	 * 
	 * @param string $s
	 * 
	 * @return string
	 */
	public static function urlDecode ($s) {
		#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:33: characters 3-29
		return urldecode($s);
	}

	/**
	 * Encode an URL by using the standard format.
	 * 
	 * @param string $s
	 * 
	 * @return string
	 */
	public static function urlEncode ($s) {
		#/home/runner/haxe/versions/4.1.4/std/php/_std/StringTools.hx:29: characters 3-32
		return rawurlencode($s);
	}

	/**
	 * @internal
	 * @access private
	 */
	static public function __hx__init ()
	{
		static $called = false;
		if ($called) return;
		$called = true;


		self::$winMetaCharacters = SysTools::$winMetaCharacters;
	}
}

Boot::registerClass(StringTools::class, 'StringTools');
StringTools::__hx__init();
