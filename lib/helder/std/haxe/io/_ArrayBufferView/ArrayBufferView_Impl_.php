<?php
/**
 */

namespace helder\std\haxe\io\_ArrayBufferView;

use \helder\std\php\Boot;
use \helder\std\haxe\Exception;
use \helder\std\haxe\io\Error;
use \helder\std\haxe\io\Bytes;
use \helder\std\haxe\io\ArrayBufferViewImpl;

final class ArrayBufferView_Impl_ {

	/**
	 * @param int $size
	 * 
	 * @return ArrayBufferViewImpl
	 */
	public static function _new ($size) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/ArrayBufferView.hx:60: character 2
		$this1 = new ArrayBufferViewImpl(Bytes::alloc($size), 0, $size);
		return $this1;
	}

	/**
	 * @param Bytes $bytes
	 * @param int $pos
	 * @param int $length
	 * 
	 * @return ArrayBufferViewImpl
	 */
	public static function fromBytes ($bytes, $pos = 0, $length = null) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/ArrayBufferView.hx:89: lines 89-95
		if ($pos === null) {
			$pos = 0;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/ArrayBufferView.hx:90: lines 90-91
		if ($length === null) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/io/ArrayBufferView.hx:91: characters 4-31
			$length = $bytes->length - $pos;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/ArrayBufferView.hx:92: lines 92-93
		if (($pos < 0) || ($length < 0) || (($pos + $length) > $bytes->length)) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/io/ArrayBufferView.hx:93: characters 4-9
			throw Exception::thrown(Error::OutsideBounds());
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/ArrayBufferView.hx:94: characters 10-63
		return new ArrayBufferViewImpl($bytes, $pos, $length);
	}

	/**
	 * @param ArrayBufferViewImpl $a
	 * 
	 * @return ArrayBufferViewImpl
	 */
	public static function fromData ($a) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/ArrayBufferView.hx:86: characters 3-16
		return $a;
	}

	/**
	 * @param ArrayBufferViewImpl $this
	 * 
	 * @return ArrayBufferViewImpl
	 */
	public static function getData ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/ArrayBufferView.hx:82: characters 3-14
		return $this1;
	}

	/**
	 * @param ArrayBufferViewImpl $this
	 * 
	 * @return Bytes
	 */
	public static function get_buffer ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/ArrayBufferView.hx:71: characters 3-20
		return $this1->bytes;
	}

	/**
	 * @param ArrayBufferViewImpl $this
	 * 
	 * @return int
	 */
	public static function get_byteLength ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/ArrayBufferView.hx:68: characters 3-25
		return $this1->byteLength;
	}

	/**
	 * @param ArrayBufferViewImpl $this
	 * 
	 * @return int
	 */
	public static function get_byteOffset ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/ArrayBufferView.hx:65: characters 3-25
		return $this1->byteOffset;
	}

	/**
	 * @param ArrayBufferViewImpl $this
	 * @param int $begin
	 * @param int $length
	 * 
	 * @return ArrayBufferViewImpl
	 */
	public static function sub ($this1, $begin, $length = null) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/ArrayBufferView.hx:74: characters 10-43
		return $this1->sub($begin, $length);
	}

	/**
	 * @param ArrayBufferViewImpl $this
	 * @param int $begin
	 * @param int $end
	 * 
	 * @return ArrayBufferViewImpl
	 */
	public static function subarray ($this1, $begin = null, $end = null) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/ArrayBufferView.hx:78: characters 10-45
		return $this1->subarray($begin, $end);
	}
}

Boot::registerClass(ArrayBufferView_Impl_::class, 'haxe.io._ArrayBufferView.ArrayBufferView_Impl_');
Boot::registerGetters('helder\\std\\haxe\\io\\_ArrayBufferView\\ArrayBufferView_Impl_', [
	'byteLength' => true,
	'byteOffset' => true,
	'buffer' => true
]);
