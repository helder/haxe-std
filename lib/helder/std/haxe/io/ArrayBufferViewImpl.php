<?php
/**
 */

namespace helder\std\haxe\io;

use \helder\std\php\Boot;
use \helder\std\haxe\Exception;

class ArrayBufferViewImpl {
	/**
	 * @var int
	 */
	public $byteLength;
	/**
	 * @var int
	 */
	public $byteOffset;
	/**
	 * @var Bytes
	 */
	public $bytes;

	/**
	 * @param Bytes $bytes
	 * @param int $pos
	 * @param int $length
	 * 
	 * @return void
	 */
	public function __construct ($bytes, $pos, $length) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/ArrayBufferView.hx:33: characters 3-21
		$this->bytes = $bytes;
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/ArrayBufferView.hx:34: characters 3-24
		$this->byteOffset = $pos;
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/ArrayBufferView.hx:35: characters 3-27
		$this->byteLength = $length;
	}

	/**
	 * @param int $begin
	 * @param int $length
	 * 
	 * @return ArrayBufferViewImpl
	 */
	public function sub ($begin, $length = null) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/ArrayBufferView.hx:39: lines 39-40
		if ($length === null) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/io/ArrayBufferView.hx:40: characters 4-31
			$length = $this->byteLength - $begin;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/ArrayBufferView.hx:41: lines 41-42
		if (($begin < 0) || ($length < 0) || (($begin + $length) > $this->byteLength)) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/io/ArrayBufferView.hx:42: characters 4-9
			throw Exception::thrown(Error::OutsideBounds());
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/ArrayBufferView.hx:43: characters 3-68
		return new ArrayBufferViewImpl($this->bytes, $this->byteOffset + $begin, $length);
	}

	/**
	 * @param int $begin
	 * @param int $end
	 * 
	 * @return ArrayBufferViewImpl
	 */
	public function subarray ($begin = null, $end = null) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/ArrayBufferView.hx:47: lines 47-48
		if ($begin === null) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/io/ArrayBufferView.hx:48: characters 4-13
			$begin = 0;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/ArrayBufferView.hx:49: lines 49-50
		if ($end === null) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/io/ArrayBufferView.hx:50: characters 4-28
			$end = $this->byteLength - $begin;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/ArrayBufferView.hx:51: characters 3-33
		return $this->sub($begin, $end - $begin);
	}
}

Boot::registerClass(ArrayBufferViewImpl::class, 'haxe.io.ArrayBufferViewImpl');
