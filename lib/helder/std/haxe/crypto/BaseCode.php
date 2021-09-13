<?php
/**
 */

namespace helder\std\haxe\crypto;

use \helder\std\haxe\io\_BytesData\Container;
use \helder\std\php\Boot;
use \helder\std\haxe\Exception;
use \helder\std\Array_hx;
use \helder\std\haxe\io\Bytes;

/**
 * Allows one to encode/decode String and bytes using a power of two base dictionary.
 */
class BaseCode {
	/**
	 * @var Bytes
	 */
	public $base;
	/**
	 * @var int
	 */
	public $nbits;
	/**
	 * @var int[]|Array_hx
	 */
	public $tbl;

	/**
	 * @param string $s
	 * @param string $base
	 * 
	 * @return string
	 */
	public static function decode ($s, $base) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:134: characters 24-52
		$b = \strlen($base);
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:134: characters 3-54
		$b1 = new BaseCode(new Bytes($b, new Container($base)));
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:135: characters 3-27
		return $b1->decodeString($s);
	}

	/**
	 * @param string $s
	 * @param string $base
	 * 
	 * @return string
	 */
	public static function encode ($s, $base) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:129: characters 24-52
		$b = \strlen($base);
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:129: characters 3-54
		$b1 = new BaseCode(new Bytes($b, new Container($base)));
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:130: characters 3-27
		return $b1->encodeString($s);
	}

	/**
	 * @param Bytes $base
	 * 
	 * @return void
	 */
	public function __construct ($base) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:34: characters 3-25
		$len = $base->length;
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:35: characters 3-17
		$nbits = 1;
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:36: lines 36-37
		while ($len > (1 << $nbits)) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:37: characters 4-11
			++$nbits;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:38: lines 38-39
		if (($nbits > 8) || ($len !== (1 << $nbits))) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:39: characters 4-9
			throw Exception::thrown("BaseCode : base length must be a power of two.");
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:40: characters 3-19
		$this->base = $base;
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:41: characters 3-21
		$this->nbits = $nbits;
	}

	/**
	 * @param Bytes $b
	 * 
	 * @return Bytes
	 */
	public function decodeBytes ($b) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:85: characters 3-26
		$nbits = $this->nbits;
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:86: characters 3-24
		$base = $this->base;
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:87: lines 87-88
		if ($this->tbl === null) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:88: characters 4-15
			$this->initTable();
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:89: characters 3-22
		$tbl = $this->tbl;
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:90: characters 3-38
		$size = ($b->length * $nbits) >> 3;
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:91: characters 3-39
		$out = Bytes::alloc($size);
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:92: characters 3-15
		$buf = 0;
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:93: characters 3-19
		$curbits = 0;
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:94: characters 3-15
		$pin = 0;
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:95: characters 3-16
		$pout = 0;
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:96: lines 96-107
		while ($pout < $size) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:97: lines 97-104
			while ($curbits < 8) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:98: characters 5-21
				$curbits += $nbits;
				#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:99: characters 5-18
				$buf <<= $nbits;
				#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:100: characters 5-31
				$i = ($tbl->arr[\ord($b->b->s[$pin++])] ?? null);
				#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:101: lines 101-102
				if ($i === -1) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:102: characters 6-11
					throw Exception::thrown("BaseCode : invalid encoded char");
				}
				#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:103: characters 5-13
				$buf |= $i;
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:105: characters 4-16
			$curbits -= 8;
			#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:106: characters 4-44
			$out->b->s[$pout++] = \chr(($buf >> $curbits) & 255);
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:108: characters 3-13
		return $out;
	}

	/**
	 * @param string $s
	 * 
	 * @return string
	 */
	public function decodeString ($s) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:124: characters 22-47
		$tmp = \strlen($s);
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:124: characters 3-59
		return $this->decodeBytes(new Bytes($tmp, new Container($s)))->toString();
	}

	/**
	 * @param Bytes $b
	 * 
	 * @return Bytes
	 */
	public function encodeBytes ($b) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:48: characters 3-26
		$nbits = $this->nbits;
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:49: characters 3-24
		$base = $this->base;
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:50: characters 3-44
		$size = (int)(($b->length * 8 / $nbits));
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:51: characters 3-81
		$out = Bytes::alloc($size + (((($b->length * 8) % $nbits) === 0 ? 0 : 1)));
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:52: characters 3-15
		$buf = 0;
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:53: characters 3-19
		$curbits = 0;
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:54: characters 3-31
		$mask = (1 << $nbits) - 1;
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:55: characters 3-15
		$pin = 0;
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:56: characters 3-16
		$pout = 0;
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:57: lines 57-65
		while ($pout < $size) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:58: lines 58-62
			while ($curbits < $nbits) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:59: characters 5-17
				$curbits += 8;
				#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:60: characters 5-14
				$buf <<= 8;
				#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:61: characters 5-24
				$buf |= \ord($b->b->s[$pin++]);
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:63: characters 4-20
			$curbits -= $nbits;
			#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:64: characters 4-54
			$v = \ord($base->b->s[($buf >> $curbits) & $mask]);
			$out->b->s[$pout++] = \chr($v);
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:66: lines 66-67
		if ($curbits > 0) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:67: characters 4-64
			$v = \ord($base->b->s[($buf << ($nbits - $curbits)) & $mask]);
			$out->b->s[$pout++] = \chr($v);
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:68: characters 3-13
		return $out;
	}

	/**
	 * @param string $s
	 * 
	 * @return string
	 */
	public function encodeString ($s) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:116: characters 22-47
		$tmp = \strlen($s);
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:116: characters 3-59
		return $this->encodeBytes(new Bytes($tmp, new Container($s)))->toString();
	}

	/**
	 * @return void
	 */
	public function initTable () {
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:73: characters 3-25
		$tbl = new Array_hx();
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:74: characters 13-17
		$_g = 0;
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:74: lines 74-75
		while ($_g < 256) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:74: characters 13-20
			$i = $_g++;
			#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:75: characters 4-15
			$tbl->offsetSet($i, -1);
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:76: characters 13-17
		$_g = 0;
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:76: characters 17-28
		$_g1 = $this->base->length;
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:76: lines 76-77
		while ($_g < $_g1) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:76: characters 13-28
			$i = $_g++;
			#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:77: characters 4-24
			$tbl->offsetSet(\ord($this->base->b->s[$i]), $i);
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/BaseCode.hx:78: characters 3-17
		$this->tbl = $tbl;
	}
}

Boot::registerClass(BaseCode::class, 'haxe.crypto.BaseCode');
