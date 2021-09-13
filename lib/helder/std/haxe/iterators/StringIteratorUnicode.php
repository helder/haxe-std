<?php
/**
 */

namespace helder\std\haxe\iterators;

use \helder\std\php\Boot;

class StringIteratorUnicode {
	/**
	 * @var int
	 */
	public $byteOffset;
	/**
	 * @var mixed
	 */
	public $s;
	/**
	 * @var int
	 */
	public $totalBytes;

	/**
	 * @param string $s
	 * 
	 * @return StringIteratorUnicode
	 */
	public static function unicodeIterator ($s) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/iterators/StringIteratorUnicode.hx:64: characters 3-38
		return new StringIteratorUnicode($s);
	}

	/**
	 * @param string $s
	 * 
	 * @return void
	 */
	public function __construct ($s) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/iterators/StringIteratorUnicode.hx:29: characters 23-24
		$this->byteOffset = 0;
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/iterators/StringIteratorUnicode.hx:34: characters 3-13
		$this->s = $s;
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/iterators/StringIteratorUnicode.hx:35: characters 3-25
		$this->totalBytes = \strlen($s);
	}

	/**
	 * @return bool
	 */
	public function hasNext () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/iterators/StringIteratorUnicode.hx:39: characters 3-33
		return $this->byteOffset < $this->totalBytes;
	}

	/**
	 * @return int
	 */
	public function next () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/iterators/StringIteratorUnicode.hx:43: characters 3-33
		$code = \ord($this->s[$this->byteOffset]);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/iterators/StringIteratorUnicode.hx:44: lines 44-59
		if ($code < 192) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/iterators/StringIteratorUnicode.hx:45: characters 4-16
			$this->byteOffset++;
		} else if ($code < 224) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/iterators/StringIteratorUnicode.hx:47: characters 4-63
			$code = (($code - 192) << 6) + \ord($this->s[$this->byteOffset + 1]) - 128;
			#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/iterators/StringIteratorUnicode.hx:48: characters 4-19
			$this->byteOffset += 2;
		} else if ($code < 240) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/iterators/StringIteratorUnicode.hx:50: characters 4-105
			$code = (($code - 224) << 12) + ((\ord($this->s[$this->byteOffset + 1]) - 128) << 6) + \ord($this->s[$this->byteOffset + 2]) - 128;
			#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/iterators/StringIteratorUnicode.hx:51: characters 4-19
			$this->byteOffset += 3;
		} else {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/iterators/StringIteratorUnicode.hx:53: lines 53-57
			$code = (($code - 240) << 18) + ((\ord($this->s[$this->byteOffset + 1]) - 128) << 12) + ((\ord($this->s[$this->byteOffset + 2]) - 128) << 6) + \ord($this->s[$this->byteOffset + 3]) - 128;
			#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/iterators/StringIteratorUnicode.hx:58: characters 4-19
			$this->byteOffset += 4;
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/iterators/StringIteratorUnicode.hx:60: characters 3-14
		return $code;
	}
}

Boot::registerClass(StringIteratorUnicode::class, 'haxe.iterators.StringIteratorUnicode');
