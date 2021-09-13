<?php
/**
 */

namespace helder\std\haxe\io\_UInt32Array;

use \helder\std\php\Boot;
use \helder\std\haxe\Exception;
use \helder\std\Array_hx;
use \helder\std\haxe\io\Error;
use \helder\std\haxe\io\_ArrayBufferView\ArrayBufferView_Impl_;
use \helder\std\haxe\io\Bytes;
use \helder\std\haxe\io\ArrayBufferViewImpl;

final class UInt32Array_Impl_ {
	/**
	 * @var int
	 */
	const BYTES_PER_ELEMENT = 4;


	/**
	 * @param int $elements
	 * 
	 * @return ArrayBufferViewImpl
	 */
	public static function _new ($elements) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/UInt32Array.hx:34: characters 10-59
		$size = $elements * 4;
		$this1 = new ArrayBufferViewImpl(Bytes::alloc($size), 0, $size);
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/UInt32Array.hx:33: character 2
		$this2 = $this1;
		return $this2;
	}

	/**
	 * @param int[]|Array_hx $a
	 * @param int $pos
	 * @param int $length
	 * 
	 * @return ArrayBufferViewImpl
	 */
	public static function fromArray ($a, $pos = 0, $length = null) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/UInt32Array.hx:73: lines 73-82
		if ($pos === null) {
			$pos = 0;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/UInt32Array.hx:74: lines 74-75
		if ($length === null) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/io/UInt32Array.hx:75: characters 4-27
			$length = $a->length - $pos;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/UInt32Array.hx:76: lines 76-77
		if (($pos < 0) || ($length < 0) || (($pos + $length) > $a->length)) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/io/UInt32Array.hx:77: characters 4-9
			throw Exception::thrown(Error::OutsideBounds());
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/UInt32Array.hx:78: characters 11-36
		$size = $a->length * 4;
		$this1 = new ArrayBufferViewImpl(Bytes::alloc($size), 0, $size);
		$this2 = $this1;
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/UInt32Array.hx:78: characters 3-37
		$i = $this2;
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/UInt32Array.hx:79: characters 15-19
		$_g = 0;
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/UInt32Array.hx:79: characters 19-25
		$_g1 = $length;
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/UInt32Array.hx:79: lines 79-80
		while ($_g < $_g1) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/io/UInt32Array.hx:79: characters 15-25
			$idx = $_g++;
			#/home/runner/haxe/versions/4.2.3/std/haxe/io/UInt32Array.hx:80: characters 4-25
			$value = ($a->arr[$idx + $pos] ?? null);
			if (($idx >= 0) && ($idx < ($i->byteLength >> 2))) {
				$_this = $i->bytes;
				$pos1 = ($idx << 2) + $i->byteOffset;
				$_this->b->s[$pos1] = \chr($value);
				$_this->b->s[$pos1 + 1] = \chr($value >> 8);
				$_this->b->s[$pos1 + 2] = \chr($value >> 16);
				$_this->b->s[$pos1 + 3] = \chr(Boot::shiftRightUnsigned($value, 24));
			}
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/UInt32Array.hx:81: characters 3-11
		return $i;
	}

	/**
	 * @param Bytes $bytes
	 * @param int $bytePos
	 * @param int $length
	 * 
	 * @return ArrayBufferViewImpl
	 */
	public static function fromBytes ($bytes, $bytePos = 0, $length = null) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/UInt32Array.hx:85: characters 3-135
		if ($bytePos === null) {
			$bytePos = 0;
		}
		return UInt32Array_Impl_::fromData(ArrayBufferView_Impl_::fromBytes($bytes, $bytePos, (($length === null ? ($bytes->length - $bytePos) >> 2 : $length)) << 2));
	}

	/**
	 * @param ArrayBufferViewImpl $d
	 * 
	 * @return ArrayBufferViewImpl
	 */
	public static function fromData ($d) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/UInt32Array.hx:70: characters 3-16
		return $d;
	}

	/**
	 * @param ArrayBufferViewImpl $this
	 * @param int $index
	 * 
	 * @return int
	 */
	public static function get ($this1, $index) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/UInt32Array.hx:46: characters 10-61
		$_this = $this1->bytes;
		$pos = ($index << 2) + $this1->byteOffset;
		$v = \ord($_this->b->s[$pos]) | (\ord($_this->b->s[$pos + 1]) << 8) | (\ord($_this->b->s[$pos + 2]) << 16) | (\ord($_this->b->s[$pos + 3]) << 24);
		if (($v & ((int)-2147483648)) !== 0) {
			return $v | ((int)-2147483648);
		} else {
			return $v;
		}
	}

	/**
	 * @param ArrayBufferViewImpl $this
	 * 
	 * @return ArrayBufferViewImpl
	 */
	public static function getData ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/UInt32Array.hx:66: characters 3-14
		return $this1;
	}

	/**
	 * @param ArrayBufferViewImpl $this
	 * 
	 * @return int
	 */
	public static function get_length ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/UInt32Array.hx:38: characters 3-30
		return $this1->byteLength >> 2;
	}

	/**
	 * @param ArrayBufferViewImpl $this
	 * 
	 * @return ArrayBufferViewImpl
	 */
	public static function get_view ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/UInt32Array.hx:42: characters 3-40
		return $this1;
	}

	/**
	 * @param ArrayBufferViewImpl $this
	 * @param int $index
	 * @param int $value
	 * 
	 * @return int
	 */
	public static function set ($this1, $index, $value) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/UInt32Array.hx:50: lines 50-53
		if (($index >= 0) && ($index < ($this1->byteLength >> 2))) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/io/UInt32Array.hx:51: characters 4-62
			$_this = $this1->bytes;
			$pos = ($index << 2) + $this1->byteOffset;
			$_this->b->s[$pos] = \chr($value);
			$_this->b->s[$pos + 1] = \chr($value >> 8);
			$_this->b->s[$pos + 2] = \chr($value >> 16);
			$_this->b->s[$pos + 3] = \chr(Boot::shiftRightUnsigned($value, 24));
			#/home/runner/haxe/versions/4.2.3/std/haxe/io/UInt32Array.hx:52: characters 4-16
			return $value;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/UInt32Array.hx:54: characters 3-11
		return 0;
	}

	/**
	 * @param ArrayBufferViewImpl $this
	 * @param int $begin
	 * @param int $length
	 * 
	 * @return ArrayBufferViewImpl
	 */
	public static function sub ($this1, $begin, $length = null) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/UInt32Array.hx:58: characters 3-77
		return UInt32Array_Impl_::fromData($this1->sub($begin << 2, ($length === null ? null : $length << 2)));
	}

	/**
	 * @param ArrayBufferViewImpl $this
	 * @param int $begin
	 * @param int $end
	 * 
	 * @return ArrayBufferViewImpl
	 */
	public static function subarray ($this1, $begin = null, $end = null) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/UInt32Array.hx:62: characters 3-99
		return UInt32Array_Impl_::fromData($this1->subarray(($begin === null ? null : $begin << 2), ($end === null ? null : $end << 2)));
	}
}

Boot::registerClass(UInt32Array_Impl_::class, 'haxe.io._UInt32Array.UInt32Array_Impl_');
Boot::registerGetters('helder\\std\\haxe\\io\\_UInt32Array\\UInt32Array_Impl_', [
	'view' => true,
	'length' => true
]);
