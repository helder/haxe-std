<?php
/**
 */

namespace helder\std\_UnicodeString;

use \helder\std\haxe\io\Encoding;
use \helder\std\php\Boot;
use \helder\std\haxe\Exception;
use \helder\std\haxe\iterators\StringKeyValueIteratorUnicode;
use \helder\std\haxe\io\Bytes;
use \helder\std\haxe\iterators\StringIteratorUnicode;

final class UnicodeString_Impl_ {
	/**
	 * Creates an instance of UnicodeString.
	 * 
	 * @param string $string
	 * 
	 * @return string
	 */
	public static function _new ($string) {
		#/home/runner/haxe/versions/4.2.3/std/UnicodeString.hx:114: character 2
		$this1 = $string;
		return $this1;
	}

	/**
	 * Returns an iterator of the unicode code points.
	 * 
	 * @param string $this
	 * 
	 * @return StringIteratorUnicode
	 */
	public static function iterator ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/UnicodeString.hx:122: characters 3-41
		return new StringIteratorUnicode($this1);
	}

	/**
	 * Returns an iterator of the code point indices and unicode code points.
	 * 
	 * @param string $this
	 * 
	 * @return StringKeyValueIteratorUnicode
	 */
	public static function keyValueIterator ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/UnicodeString.hx:129: characters 3-49
		return new StringKeyValueIteratorUnicode($this1);
	}

	/**
	 * Tells if `b` is a correctly encoded UTF8 byte sequence.
	 * 
	 * @param Bytes $b
	 * @param Encoding $encoding
	 * 
	 * @return bool
	 */
	public static function validate ($b, $encoding) {
		#/home/runner/haxe/versions/4.2.3/std/UnicodeString.hx:40: lines 40-107
		$__hx__switch = ($encoding->index);
		if ($__hx__switch === 0) {
			#/home/runner/haxe/versions/4.2.3/std/UnicodeString.hx:44: characters 5-28
			$data = $b->b;
			#/home/runner/haxe/versions/4.2.3/std/UnicodeString.hx:45: characters 5-17
			$pos = 0;
			#/home/runner/haxe/versions/4.2.3/std/UnicodeString.hx:46: characters 5-24
			$max = $b->length;
			#/home/runner/haxe/versions/4.2.3/std/UnicodeString.hx:47: lines 47-105
			while ($pos < $max) {
				#/home/runner/haxe/versions/4.2.3/std/UnicodeString.hx:48: characters 6-45
				$c = \ord($data->s[$pos++]);
				#/home/runner/haxe/versions/4.2.3/std/UnicodeString.hx:49: lines 49-104
				if ($c >= 128) {
					if ($c < 194) {
						#/home/runner/haxe/versions/4.2.3/std/UnicodeString.hx:50: characters 7-19
						return false;
					} else if ($c < 224) {
						#/home/runner/haxe/versions/4.2.3/std/UnicodeString.hx:52: lines 52-54
						if (($pos + 1) > $max) {
							#/home/runner/haxe/versions/4.2.3/std/UnicodeString.hx:53: characters 8-20
							return false;
						}
						#/home/runner/haxe/versions/4.2.3/std/UnicodeString.hx:55: characters 7-47
						$c2 = \ord($data->s[$pos++]);
						#/home/runner/haxe/versions/4.2.3/std/UnicodeString.hx:56: lines 56-58
						if (($c2 < 128) || ($c2 > 191)) {
							#/home/runner/haxe/versions/4.2.3/std/UnicodeString.hx:57: characters 8-20
							return false;
						}
					} else if ($c < 240) {
						#/home/runner/haxe/versions/4.2.3/std/UnicodeString.hx:60: lines 60-62
						if (($pos + 2) > $max) {
							#/home/runner/haxe/versions/4.2.3/std/UnicodeString.hx:61: characters 8-20
							return false;
						}
						#/home/runner/haxe/versions/4.2.3/std/UnicodeString.hx:63: characters 7-47
						$c21 = \ord($data->s[$pos++]);
						#/home/runner/haxe/versions/4.2.3/std/UnicodeString.hx:64: lines 64-70
						if ($c === 224) {
							#/home/runner/haxe/versions/4.2.3/std/UnicodeString.hx:65: lines 65-66
							if (($c21 < 160) || ($c21 > 191)) {
								#/home/runner/haxe/versions/4.2.3/std/UnicodeString.hx:66: characters 9-21
								return false;
							}
						} else if (($c21 < 128) || ($c21 > 191)) {
							#/home/runner/haxe/versions/4.2.3/std/UnicodeString.hx:69: characters 9-21
							return false;
						}
						#/home/runner/haxe/versions/4.2.3/std/UnicodeString.hx:71: characters 7-47
						$c3 = \ord($data->s[$pos++]);
						#/home/runner/haxe/versions/4.2.3/std/UnicodeString.hx:72: lines 72-74
						if (($c3 < 128) || ($c3 > 191)) {
							#/home/runner/haxe/versions/4.2.3/std/UnicodeString.hx:73: characters 8-20
							return false;
						}
						#/home/runner/haxe/versions/4.2.3/std/UnicodeString.hx:75: characters 7-37
						$c = ($c << 16) | ($c21 << 8) | $c3;
						#/home/runner/haxe/versions/4.2.3/std/UnicodeString.hx:76: lines 76-78
						if ((15573120 <= $c) && ($c <= 15581119)) {
							#/home/runner/haxe/versions/4.2.3/std/UnicodeString.hx:77: characters 8-20
							return false;
						}
					} else if ($c > 244) {
						#/home/runner/haxe/versions/4.2.3/std/UnicodeString.hx:80: characters 7-19
						return false;
					} else {
						#/home/runner/haxe/versions/4.2.3/std/UnicodeString.hx:82: lines 82-84
						if (($pos + 3) > $max) {
							#/home/runner/haxe/versions/4.2.3/std/UnicodeString.hx:83: characters 8-20
							return false;
						}
						#/home/runner/haxe/versions/4.2.3/std/UnicodeString.hx:85: characters 7-47
						$c22 = \ord($data->s[$pos++]);
						#/home/runner/haxe/versions/4.2.3/std/UnicodeString.hx:86: lines 86-95
						if ($c === 240) {
							#/home/runner/haxe/versions/4.2.3/std/UnicodeString.hx:87: lines 87-88
							if (($c22 < 144) || ($c22 > 191)) {
								#/home/runner/haxe/versions/4.2.3/std/UnicodeString.hx:88: characters 9-21
								return false;
							}
						} else if ($c === 244) {
							#/home/runner/haxe/versions/4.2.3/std/UnicodeString.hx:90: lines 90-91
							if (($c22 < 128) || ($c22 > 143)) {
								#/home/runner/haxe/versions/4.2.3/std/UnicodeString.hx:91: characters 9-21
								return false;
							}
						} else if (($c22 < 128) || ($c22 > 191)) {
							#/home/runner/haxe/versions/4.2.3/std/UnicodeString.hx:94: characters 9-21
							return false;
						}
						#/home/runner/haxe/versions/4.2.3/std/UnicodeString.hx:96: characters 7-47
						$c31 = \ord($data->s[$pos++]);
						#/home/runner/haxe/versions/4.2.3/std/UnicodeString.hx:97: lines 97-99
						if (($c31 < 128) || ($c31 > 191)) {
							#/home/runner/haxe/versions/4.2.3/std/UnicodeString.hx:98: characters 8-20
							return false;
						}
						#/home/runner/haxe/versions/4.2.3/std/UnicodeString.hx:100: characters 7-47
						$c4 = \ord($data->s[$pos++]);
						#/home/runner/haxe/versions/4.2.3/std/UnicodeString.hx:101: lines 101-103
						if (($c4 < 128) || ($c4 > 191)) {
							#/home/runner/haxe/versions/4.2.3/std/UnicodeString.hx:102: characters 8-20
							return false;
						}
					}
				}
			}
			#/home/runner/haxe/versions/4.2.3/std/UnicodeString.hx:106: characters 5-16
			return true;
		} else if ($__hx__switch === 1) {
			#/home/runner/haxe/versions/4.2.3/std/UnicodeString.hx:42: characters 5-10
			throw Exception::thrown("UnicodeString.validate: RawNative encoding is not supported");
		}
	}
}

Boot::registerClass(UnicodeString_Impl_::class, '_UnicodeString.UnicodeString_Impl_');
