<?php
/**
 * Generated by Haxe 4.1.4
 */

namespace helder\std\haxe\io;

use \helder\std\haxe\io\_BytesData\Container;
use \helder\std\php\Boot;
use \helder\std\haxe\Exception;

class BytesInput extends Input {
	/**
	 * @var Container
	 */
	public $b;
	/**
	 * @var int
	 */
	public $len;
	/**
	 * @var int
	 */
	public $pos;
	/**
	 * @var int
	 */
	public $totlen;

	/**
	 * @param Bytes $b
	 * @param int $pos
	 * @param int $len
	 * 
	 * @return void
	 */
	public function __construct ($b, $pos = null, $len = null) {
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/io/BytesInput.hx:36: lines 36-37
		if ($pos === null) {
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/io/BytesInput.hx:37: characters 4-11
			$pos = 0;
		}
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/io/BytesInput.hx:38: lines 38-39
		if ($len === null) {
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/io/BytesInput.hx:39: characters 4-24
			$len = $b->length - $pos;
		}
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/io/BytesInput.hx:40: lines 40-41
		if (($pos < 0) || ($len < 0) || (($pos + $len) > $b->length)) {
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/io/BytesInput.hx:41: characters 4-9
			throw Exception::thrown(Error::OutsideBounds());
		}
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/io/BytesInput.hx:43: characters 3-23
		$this->b = $b->b;
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/io/BytesInput.hx:44: characters 3-17
		$this->pos = $pos;
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/io/BytesInput.hx:45: characters 3-17
		$this->len = $len;
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/io/BytesInput.hx:46: characters 3-20
		$this->totlen = $len;
	}

	/**
	 * @return int
	 */
	public function get_length () {
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/io/BytesInput.hx:54: characters 3-16
		return $this->totlen;
	}

	/**
	 * @return int
	 */
	public function get_position () {
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/io/BytesInput.hx:50: characters 3-13
		return $this->pos;
	}

	/**
	 * @return int
	 */
	public function readByte () {
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/io/BytesInput.hx:67: lines 67-68
		if ($this->len === 0) {
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/io/BytesInput.hx:68: characters 4-9
			throw Exception::thrown(new Eof());
		}
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/io/BytesInput.hx:69: characters 3-8
		--$this->len;
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/io/BytesInput.hx:70: characters 10-18
		return \ord($this->b->s[$this->pos++]);
	}

	/**
	 * @param Bytes $buf
	 * @param int $pos
	 * @param int $len
	 * 
	 * @return int
	 */
	public function readBytes ($buf, $pos, $len) {
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/io/BytesInput.hx:74: lines 74-75
		if (($pos < 0) || ($len < 0) || (($pos + $len) > $buf->length)) {
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/io/BytesInput.hx:75: characters 4-9
			throw Exception::thrown(Error::OutsideBounds());
		}
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/io/BytesInput.hx:76: lines 76-77
		if (($this->len === 0) && ($len > 0)) {
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/io/BytesInput.hx:77: characters 4-9
			throw Exception::thrown(new Eof());
		}
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/io/BytesInput.hx:78: lines 78-79
		if ($this->len < $len) {
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/io/BytesInput.hx:79: characters 4-18
			$len = $this->len;
		}
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/io/BytesInput.hx:80: characters 3-44
		$this1 = $buf->b;
		$src = $this->b;
		$srcpos = $this->pos;
		$this1->s = ((\substr($this1->s, 0, $pos) . \substr($src->s, $srcpos, $len)) . \substr($this1->s, $pos + $len));
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/io/BytesInput.hx:81: characters 3-18
		$this->pos += $len;
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/io/BytesInput.hx:82: characters 3-18
		$this->len -= $len;
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/io/BytesInput.hx:84: characters 3-13
		return $len;
	}

	/**
	 * @param int $p
	 * 
	 * @return int
	 */
	public function set_position ($p) {
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/io/BytesInput.hx:58: lines 58-61
		if ($p < 0) {
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/io/BytesInput.hx:59: characters 4-9
			$p = 0;
		} else if ($p > $this->totlen) {
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/io/BytesInput.hx:61: characters 4-14
			$p = $this->totlen;
		}
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/io/BytesInput.hx:62: characters 3-19
		$this->len = $this->totlen - $p;
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/io/BytesInput.hx:63: characters 3-17
		return $this->pos = $p;
	}
}

Boot::registerClass(BytesInput::class, 'haxe.io.BytesInput');
Boot::registerGetters('helder\\std\\haxe\\io\\BytesInput', [
	'length' => true,
	'position' => true
]);
Boot::registerSetters('helder\\std\\haxe\\io\\BytesInput', [
	'position' => true
]);
