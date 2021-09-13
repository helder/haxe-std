<?php
/**
 */

namespace helder\std\haxe\io;

use \helder\std\haxe\io\_BytesData\Container;
use \helder\std\haxe\_Int64\___Int64;
use \helder\std\php\Boot;
use \helder\std\haxe\Exception;

class Bytes {
	/**
	 * @var Container
	 */
	public $b;
	/**
	 * @var int
	 */
	public $length;

	/**
	 * @param int $length
	 * 
	 * @return Bytes
	 */
	public static function alloc ($length) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/io/Bytes.hx:147: characters 3-52
		return new Bytes($length, new Container(\str_repeat(\chr(0), $length)));
	}

	/**
	 * @param Container $b
	 * @param int $pos
	 * 
	 * @return int
	 */
	public static function fastGet ($b, $pos) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/io/Bytes.hx:167: characters 3-20
		return \ord($b->s[$pos]);
	}

	/**
	 * @param Container $b
	 * 
	 * @return Bytes
	 */
	public static function ofData ($b) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/io/Bytes.hx:155: characters 3-32
		return new Bytes(\strlen($b->s), $b);
	}

	/**
	 * @param string $s
	 * 
	 * @return Bytes
	 */
	public static function ofHex ($s) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/io/Bytes.hx:159: characters 3-30
		$len = \strlen($s);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/io/Bytes.hx:160: lines 160-161
		if (($len & 1) !== 0) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/io/Bytes.hx:161: characters 4-9
			throw Exception::thrown("Not a hex string (odd number of digits)");
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/io/Bytes.hx:162: characters 3-40
		$b = \hex2bin($s);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/io/Bytes.hx:163: characters 20-36
		$tmp = \strlen($b);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/io/Bytes.hx:163: characters 3-40
		return new Bytes($tmp, new Container($b));
	}

	/**
	 * @param string $s
	 * @param Encoding $encoding
	 * 
	 * @return Bytes
	 */
	public static function ofString ($s, $encoding = null) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/io/Bytes.hx:151: characters 20-40
		$tmp = \strlen($s);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/io/Bytes.hx:151: characters 3-44
		return new Bytes($tmp, new Container($s));
	}

	/**
	 * @param int $length
	 * @param Container $b
	 * 
	 * @return void
	 */
	public function __construct ($length, $b) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/io/Bytes.hx:34: characters 3-23
		$this->length = $length;
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/io/Bytes.hx:35: characters 3-13
		$this->b = $b;
	}

	/**
	 * @param int $pos
	 * @param Bytes $src
	 * @param int $srcpos
	 * @param int $len
	 * 
	 * @return void
	 */
	public function blit ($pos, $src, $srcpos, $len) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/io/Bytes.hx:47: lines 47-51
		if (($pos < 0) || ($srcpos < 0) || ($len < 0) || (($pos + $len) > $this->length) || (($srcpos + $len) > $src->length)) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/io/Bytes.hx:48: characters 4-9
			throw Exception::thrown(Error::OutsideBounds());
		} else {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/io/Bytes.hx:50: characters 4-35
			$this1 = $this->b;
			$src1 = $src->b;
			$this1->s = ((\substr($this1->s, 0, $pos) . \substr($src1->s, $srcpos, $len)) . \substr($this1->s, $pos + $len));
		}
	}

	/**
	 * @param Bytes $other
	 * 
	 * @return int
	 */
	public function compare ($other) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/io/Bytes.hx:67: characters 10-28
		return ($this->b->s <=> $other->b->s);
	}

	/**
	 * @param int $pos
	 * @param int $len
	 * @param int $value
	 * 
	 * @return void
	 */
	public function fill ($pos, $len, $value) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/io/Bytes.hx:55: characters 3-26
		$this1 = $this->b;
		$this1->s = ((\substr($this1->s, 0, $pos) . \str_repeat(\chr($value), $len)) . \substr($this1->s, $pos + $len));
	}

	/**
	 * @param int $pos
	 * 
	 * @return int
	 */
	public function get ($pos) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/io/Bytes.hx:39: characters 10-20
		return \ord($this->b->s[$pos]);
	}

	/**
	 * @return Container
	 */
	public function getData () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/io/Bytes.hx:143: characters 3-11
		return $this->b;
	}

	/**
	 * @param int $pos
	 * 
	 * @return float
	 */
	public function getDouble ($pos) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/io/Bytes.hx:71: characters 31-44
		$v = \ord($this->b->s[$pos]) | (\ord($this->b->s[$pos + 1]) << 8) | (\ord($this->b->s[$pos + 2]) << 16) | (\ord($this->b->s[$pos + 3]) << 24);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/io/Bytes.hx:71: characters 10-64
		$low = (($v & ((int)-2147483648)) !== 0 ? $v | ((int)-2147483648) : $v);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/io/Bytes.hx:71: characters 46-63
		$pos1 = $pos + 4;
		$v = \ord($this->b->s[$pos1]) | (\ord($this->b->s[$pos1 + 1]) << 8) | (\ord($this->b->s[$pos1 + 2]) << 16) | (\ord($this->b->s[$pos1 + 3]) << 24);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/io/Bytes.hx:71: characters 10-64
		$high = (($v & ((int)-2147483648)) !== 0 ? $v | ((int)-2147483648) : $v);
		return \unpack("d", \pack("ii", (FPHelper::$isLittleEndian ? $low : $high), (FPHelper::$isLittleEndian ? $high : $low)))[1];
	}

	/**
	 * @param int $pos
	 * 
	 * @return float
	 */
	public function getFloat ($pos) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/io/Bytes.hx:75: characters 3-48
		$b = new BytesInput($this, $pos, 4);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/io/Bytes.hx:76: characters 3-23
		return $b->readFloat();
	}

	/**
	 * @param int $pos
	 * 
	 * @return int
	 */
	public function getInt32 ($pos) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/io/Bytes.hx:99: characters 3-88
		$v = \ord($this->b->s[$pos]) | (\ord($this->b->s[$pos + 1]) << 8) | (\ord($this->b->s[$pos + 2]) << 16) | (\ord($this->b->s[$pos + 3]) << 24);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/io/Bytes.hx:100: characters 10-56
		if (($v & ((int)-2147483648)) !== 0) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/io/Bytes.hx:100: characters 35-49
			return $v | ((int)-2147483648);
		} else {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/io/Bytes.hx:100: characters 55-56
			return $v;
		}
	}

	/**
	 * @param int $pos
	 * 
	 * @return ___Int64
	 */
	public function getInt64 ($pos) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/io/Bytes.hx:104: characters 26-43
		$pos1 = $pos + 4;
		$v = \ord($this->b->s[$pos1]) | (\ord($this->b->s[$pos1 + 1]) << 8) | (\ord($this->b->s[$pos1 + 2]) << 16) | (\ord($this->b->s[$pos1 + 3]) << 24);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/io/Bytes.hx:104: characters 45-58
		$v1 = \ord($this->b->s[$pos]) | (\ord($this->b->s[$pos + 1]) << 8) | (\ord($this->b->s[$pos + 2]) << 16) | (\ord($this->b->s[$pos + 3]) << 24);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/io/Bytes.hx:104: characters 10-59
		$this1 = new ___Int64((($v & ((int)-2147483648)) !== 0 ? $v | ((int)-2147483648) : $v), (($v1 & ((int)-2147483648)) !== 0 ? $v1 | ((int)-2147483648) : $v1));
		return $this1;
	}

	/**
	 * @param int $pos
	 * @param int $len
	 * @param Encoding $encoding
	 * 
	 * @return string
	 */
	public function getString ($pos, $len, $encoding = null) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/io/Bytes.hx:120: lines 120-125
		if (($pos < 0) || ($len < 0) || (($pos + $len) > $this->length)) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/io/Bytes.hx:121: characters 4-9
			throw Exception::thrown(Error::OutsideBounds());
		} else {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/io/Bytes.hx:124: characters 11-32
			return \substr($this->b->s, $pos, $len);
		}
	}

	/**
	 * @param int $pos
	 * 
	 * @return int
	 */
	public function getUInt16 ($pos) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/io/Bytes.hx:90: characters 3-40
		return \ord($this->b->s[$pos]) | (\ord($this->b->s[$pos + 1]) << 8);
	}

	/**
	 * @param int $pos
	 * @param int $len
	 * 
	 * @return string
	 */
	public function readString ($pos, $len) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/io/Bytes.hx:131: characters 10-29
		if (($pos < 0) || ($len < 0) || (($pos + $len) > $this->length)) {
			throw Exception::thrown(Error::OutsideBounds());
		} else {
			return \substr($this->b->s, $pos, $len);
		}
	}

	/**
	 * @param int $pos
	 * @param int $v
	 * 
	 * @return void
	 */
	public function set ($pos, $v) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/io/Bytes.hx:43: characters 3-16
		$this->b->s[$pos] = \chr($v);
	}

	/**
	 * @param int $pos
	 * @param float $v
	 * 
	 * @return void
	 */
	public function setDouble ($pos, $v) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/io/Bytes.hx:80: characters 3-35
		$i = FPHelper::doubleToI64($v);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/io/Bytes.hx:81: characters 3-23
		$v = $i->low;
		$this->b->s[$pos] = \chr($v);
		$this->b->s[$pos + 1] = \chr($v >> 8);
		$this->b->s[$pos + 2] = \chr($v >> 16);
		$this->b->s[$pos + 3] = \chr(Boot::shiftRightUnsigned($v, 24));
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/io/Bytes.hx:82: characters 3-28
		$pos1 = $pos + 4;
		$v = $i->high;
		$this->b->s[$pos1] = \chr($v);
		$this->b->s[$pos1 + 1] = \chr($v >> 8);
		$this->b->s[$pos1 + 2] = \chr($v >> 16);
		$this->b->s[$pos1 + 3] = \chr(Boot::shiftRightUnsigned($v, 24));
	}

	/**
	 * @param int $pos
	 * @param float $v
	 * 
	 * @return void
	 */
	public function setFloat ($pos, $v) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/io/Bytes.hx:86: characters 3-40
		$v1 = \unpack("l", \pack("f", $v))[1];
		$this->b->s[$pos] = \chr($v1);
		$this->b->s[$pos + 1] = \chr($v1 >> 8);
		$this->b->s[$pos + 2] = \chr($v1 >> 16);
		$this->b->s[$pos + 3] = \chr(Boot::shiftRightUnsigned($v1, 24));
	}

	/**
	 * @param int $pos
	 * @param int $v
	 * 
	 * @return void
	 */
	public function setInt32 ($pos, $v) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/io/Bytes.hx:108: characters 3-14
		$this->b->s[$pos] = \chr($v);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/io/Bytes.hx:109: characters 3-23
		$this->b->s[$pos + 1] = \chr($v >> 8);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/io/Bytes.hx:110: characters 3-24
		$this->b->s[$pos + 2] = \chr($v >> 16);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/io/Bytes.hx:111: characters 3-25
		$this->b->s[$pos + 3] = \chr(Boot::shiftRightUnsigned($v, 24));
	}

	/**
	 * @param int $pos
	 * @param ___Int64 $v
	 * 
	 * @return void
	 */
	public function setInt64 ($pos, $v) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/io/Bytes.hx:115: characters 3-23
		$v1 = $v->low;
		$this->b->s[$pos] = \chr($v1);
		$this->b->s[$pos + 1] = \chr($v1 >> 8);
		$this->b->s[$pos + 2] = \chr($v1 >> 16);
		$this->b->s[$pos + 3] = \chr(Boot::shiftRightUnsigned($v1, 24));
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/io/Bytes.hx:116: characters 3-28
		$pos1 = $pos + 4;
		$v1 = $v->high;
		$this->b->s[$pos1] = \chr($v1);
		$this->b->s[$pos1 + 1] = \chr($v1 >> 8);
		$this->b->s[$pos1 + 2] = \chr($v1 >> 16);
		$this->b->s[$pos1 + 3] = \chr(Boot::shiftRightUnsigned($v1, 24));
	}

	/**
	 * @param int $pos
	 * @param int $v
	 * 
	 * @return void
	 */
	public function setUInt16 ($pos, $v) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/io/Bytes.hx:94: characters 3-14
		$this->b->s[$pos] = \chr($v);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/io/Bytes.hx:95: characters 3-23
		$this->b->s[$pos + 1] = \chr($v >> 8);
	}

	/**
	 * @param int $pos
	 * @param int $len
	 * 
	 * @return Bytes
	 */
	public function sub ($pos, $len) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/io/Bytes.hx:59: lines 59-63
		if (($pos < 0) || ($len < 0) || (($pos + $len) > $this->length)) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/io/Bytes.hx:60: characters 4-9
			throw Exception::thrown(Error::OutsideBounds());
		} else {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/io/Bytes.hx:62: characters 4-42
			return new Bytes($len, new Container(\substr($this->b->s, $pos, $len)));
		}
	}

	/**
	 * @return string
	 */
	public function toHex () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/io/Bytes.hx:139: characters 3-42
		return \bin2hex($this->b->s);
	}

	/**
	 * @return string
	 */
	public function toString () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/io/Bytes.hx:135: characters 3-11
		return $this->b->s;
	}

	public function __toString() {
		return $this->toString();
	}
}

Boot::registerClass(Bytes::class, 'haxe.io.Bytes');
