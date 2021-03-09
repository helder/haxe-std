<?php
/**
 * Generated by Haxe 4.2.1+bf9ff69
 */

namespace helder\std;

use \helder\std\php\Boot;

/**
 * A String buffer is an efficient way to build a big string by appending small
 * elements together.
 * Unlike String, an instance of StringBuf is not immutable in the sense that
 * it can be passed as argument to functions which modify it by appending more
 * values.
 */
class StringBuf {
	/**
	 * @var string
	 */
	public $b;

	/**
	 * Creates a new StringBuf instance.
	 * This may involve initialization of the internal buffer.
	 * 
	 * @return void
	 */
	public function __construct () {
		#/home/runner/haxe/versions/4.2.1/std/php/_std/StringBuf.hx:32: characters 3-9
		$this->b = "";
	}

	/**
	 * Appends the representation of `x` to `this` StringBuf.
	 * The exact representation of `x` may vary per platform. To get more
	 * consistent behavior, this function should be called with
	 * Std.string(x).
	 * If `x` is null, the String "null" is appended.
	 * 
	 * @param mixed $x
	 * 
	 * @return void
	 */
	public function add ($x) {
		#/home/runner/haxe/versions/4.2.1/std/php/_std/StringBuf.hx:40: lines 40-48
		if ($x === null) {
			#/home/runner/haxe/versions/4.2.1/std/php/_std/StringBuf.hx:41: characters 4-32
			$this->b = ($this->b . "null");
		} else if (is_bool($x)) {
			#/home/runner/haxe/versions/4.2.1/std/php/_std/StringBuf.hx:43: characters 4-60
			$this->b = ($this->b . ($x ? "true" : "false"));
		} else if (is_string($x)) {
			#/home/runner/haxe/versions/4.2.1/std/php/_std/StringBuf.hx:45: characters 4-32
			$this->b = ($this->b . $x);
		} else {
			#/home/runner/haxe/versions/4.2.1/std/php/_std/StringBuf.hx:47: characters 4-5
			$tmp = $this;
			#/home/runner/haxe/versions/4.2.1/std/php/_std/StringBuf.hx:47: characters 4-10
			$tmp->b = ($tmp->b??'null') . Std::string($x);
		}
	}

	/**
	 * Appends the character identified by `c` to `this` StringBuf.
	 * If `c` is negative or has another invalid value, the result is
	 * unspecified.
	 * 
	 * @param int $c
	 * 
	 * @return void
	 */
	public function addChar ($c) {
		#/home/runner/haxe/versions/4.2.1/std/php/_std/StringBuf.hx:56: characters 3-4
		$tmp = $this;
		#/home/runner/haxe/versions/4.2.1/std/php/_std/StringBuf.hx:56: characters 3-30
		$tmp->b = ($tmp->b??'null') . (mb_chr($c)??'null');
	}

	/**
	 * Appends a substring of `s` to `this` StringBuf.
	 * This function expects `pos` and `len` to describe a valid substring of
	 * `s`, or else the result is unspecified. To get more robust behavior,
	 * `this.add(s.substr(pos,len))` can be used instead.
	 * If `s` or `pos` are null, the result is unspecified.
	 * If `len` is omitted or null, the substring ranges from `pos` to the end
	 * of `s`.
	 * 
	 * @param string $s
	 * @param int $pos
	 * @param int $len
	 * 
	 * @return void
	 */
	public function addSub ($s, $pos, $len = null) {
		#/home/runner/haxe/versions/4.2.1/std/php/_std/StringBuf.hx:52: characters 3-4
		$tmp = $this;
		#/home/runner/haxe/versions/4.2.1/std/php/_std/StringBuf.hx:52: characters 3-26
		$tmp->b = ($tmp->b??'null') . (mb_substr($s, $pos, $len)??'null');
	}

	/**
	 * @return int
	 */
	public function get_length () {
		#/home/runner/haxe/versions/4.2.1/std/php/_std/StringBuf.hx:36: characters 3-18
		return mb_strlen($this->b);
	}

	/**
	 * Returns the content of `this` StringBuf as String.
	 * The buffer is not emptied by this operation.
	 * 
	 * @return string
	 */
	public function toString () {
		#/home/runner/haxe/versions/4.2.1/std/php/_std/StringBuf.hx:60: characters 3-11
		return $this->b;
	}

	public function __toString() {
		return $this->toString();
	}
}

Boot::registerClass(StringBuf::class, 'StringBuf');
Boot::registerGetters('helder\\std\\StringBuf', [
	'length' => true
]);
