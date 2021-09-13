<?php
/**
 */

namespace helder\std\haxe\io;

use \helder\std\php\Boot;
use \helder\std\haxe\Exception;

class BufferInput extends Input {
	/**
	 * @var int
	 */
	public $available;
	/**
	 * @var Bytes
	 */
	public $buf;
	/**
	 * @var Input
	 */
	public $i;
	/**
	 * @var int
	 */
	public $pos;

	/**
	 * @param Input $i
	 * @param Bytes $buf
	 * @param int $pos
	 * @param int $available
	 * 
	 * @return void
	 */
	public function __construct ($i, $buf, $pos = 0, $available = 0) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/BufferInput.hx:31: lines 31-36
		if ($pos === null) {
			$pos = 0;
		}
		if ($available === null) {
			$available = 0;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/BufferInput.hx:32: characters 3-13
		$this->i = $i;
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/BufferInput.hx:33: characters 3-17
		$this->buf = $buf;
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/BufferInput.hx:34: characters 3-17
		$this->pos = $pos;
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/BufferInput.hx:35: characters 3-29
		$this->available = $available;
	}

	/**
	 * @return int
	 */
	public function readByte () {
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/BufferInput.hx:47: lines 47-48
		if ($this->available === 0) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/io/BufferInput.hx:48: characters 4-12
			$this->refill();
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/BufferInput.hx:49: characters 3-24
		$c = \ord($this->buf->b->s[$this->pos]);
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/BufferInput.hx:50: characters 3-8
		$this->pos++;
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/BufferInput.hx:51: characters 3-14
		$this->available--;
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/BufferInput.hx:52: characters 3-11
		return $c;
	}

	/**
	 * @param Bytes $buf
	 * @param int $pos
	 * @param int $len
	 * 
	 * @return int
	 */
	public function readBytes ($buf, $pos, $len) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/BufferInput.hx:56: lines 56-57
		if ($this->available === 0) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/io/BufferInput.hx:57: characters 4-12
			$this->refill();
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/BufferInput.hx:58: characters 3-54
		$size = ($len > $this->available ? $this->available : $len);
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/BufferInput.hx:59: characters 3-42
		$src = $this->buf;
		$srcpos = $this->pos;
		if (($pos < 0) || ($srcpos < 0) || ($size < 0) || (($pos + $size) > $buf->length) || (($srcpos + $size) > $src->length)) {
			throw Exception::thrown(Error::OutsideBounds());
		} else {
			$this1 = $buf->b;
			$src1 = $src->b;
			$this1->s = ((\substr($this1->s, 0, $pos) . \substr($src1->s, $srcpos, $size)) . \substr($this1->s, $pos + $size));
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/BufferInput.hx:60: characters 3-19
		$this->pos += $size;
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/BufferInput.hx:61: characters 3-25
		$this->available -= $size;
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/BufferInput.hx:62: characters 3-14
		return $size;
	}

	/**
	 * @return void
	 */
	public function refill () {
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/BufferInput.hx:39: lines 39-42
		if ($this->pos > 0) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/io/BufferInput.hx:40: characters 4-36
			$_this = $this->buf;
			$src = $this->buf;
			$srcpos = $this->pos;
			$len = $this->available;
			if (($srcpos < 0) || ($len < 0) || ($len > $_this->length) || (($srcpos + $len) > $src->length)) {
				throw Exception::thrown(Error::OutsideBounds());
			} else {
				$this1 = $_this->b;
				$src1 = $src->b;
				$this1->s = ((\substr($this1->s, 0, 0) . \substr($src1->s, $srcpos, $len)) . \substr($this1->s, $len));
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/io/BufferInput.hx:41: characters 4-11
			$this->pos = 0;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/BufferInput.hx:43: characters 3-12
		$tmp = $this;
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/BufferInput.hx:43: characters 3-67
		$tmp->available = $tmp->available + $this->i->readBytes($this->buf, $this->available, $this->buf->length - $this->available);
	}
}

Boot::registerClass(BufferInput::class, 'haxe.io.BufferInput');
