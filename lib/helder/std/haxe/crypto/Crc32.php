<?php
/**
 */

namespace helder\std\haxe\crypto;

use \helder\std\php\Boot;
use \helder\std\haxe\io\Bytes;

/**
 * Calculates the Crc32 of the given Bytes.
 */
class Crc32 {
	/**
	 * @var int
	 */
	public $crc;

	/**
	 * Calculates the CRC32 of the given data bytes
	 * 
	 * @param Bytes $data
	 * 
	 * @return int
	 */
	public static function make ($data) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/Crc32.hx:60: characters 11-22
		$c_crc = -1;
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/Crc32.hx:61: characters 3-33
		$b = $data->b;
		$_g = 0;
		$_g1 = $data->length;
		while ($_g < $_g1) {
			$i = $_g++;
			$tmp = ($c_crc ^ \ord($b->s[$i])) & 255;
			#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/Crc32.hx:47: characters 5-8
			$tmp = Boot::shiftRightUnsigned($tmp, 1) ^ (-($tmp & 1) & -306674912);
			$tmp = Boot::shiftRightUnsigned($tmp, 1) ^ (-($tmp & 1) & -306674912);
			$tmp = Boot::shiftRightUnsigned($tmp, 1) ^ (-($tmp & 1) & -306674912);
			$tmp = Boot::shiftRightUnsigned($tmp, 1) ^ (-($tmp & 1) & -306674912);
			$tmp = Boot::shiftRightUnsigned($tmp, 1) ^ (-($tmp & 1) & -306674912);
			$tmp = Boot::shiftRightUnsigned($tmp, 1) ^ (-($tmp & 1) & -306674912);
			$tmp = Boot::shiftRightUnsigned($tmp, 1) ^ (-($tmp & 1) & -306674912);
			$tmp = Boot::shiftRightUnsigned($tmp, 1) ^ (-($tmp & 1) & -306674912);
			#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/Crc32.hx:61: characters 3-33
			$c_crc = Boot::shiftRightUnsigned($c_crc, 8) ^ $tmp;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/Crc32.hx:62: characters 3-17
		return $c_crc ^ -1;
	}

	/**
	 * @return void
	 */
	public function __construct () {
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/Crc32.hx:32: characters 3-19
		$this->crc = -1;
	}

	/**
	 * @param int $b
	 * 
	 * @return void
	 */
	public function byte ($b) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/Crc32.hx:36: characters 3-30
		$tmp = ($this->crc ^ $b) & 255;
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/Crc32.hx:38: characters 4-49
		$tmp = Boot::shiftRightUnsigned($tmp, 1) ^ (-($tmp & 1) & -306674912);
		$tmp = Boot::shiftRightUnsigned($tmp, 1) ^ (-($tmp & 1) & -306674912);
		$tmp = Boot::shiftRightUnsigned($tmp, 1) ^ (-($tmp & 1) & -306674912);
		$tmp = Boot::shiftRightUnsigned($tmp, 1) ^ (-($tmp & 1) & -306674912);
		$tmp = Boot::shiftRightUnsigned($tmp, 1) ^ (-($tmp & 1) & -306674912);
		$tmp = Boot::shiftRightUnsigned($tmp, 1) ^ (-($tmp & 1) & -306674912);
		$tmp = Boot::shiftRightUnsigned($tmp, 1) ^ (-($tmp & 1) & -306674912);
		$tmp = Boot::shiftRightUnsigned($tmp, 1) ^ (-($tmp & 1) & -306674912);
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/Crc32.hx:39: characters 3-26
		$this->crc = Boot::shiftRightUnsigned($this->crc, 8) ^ $tmp;
	}

	/**
	 * @return int
	 */
	public function get () {
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/Crc32.hx:53: characters 3-26
		return $this->crc ^ -1;
	}

	/**
	 * @param Bytes $b
	 * @param int $pos
	 * @param int $len
	 * 
	 * @return void
	 */
	public function update ($b, $pos, $len) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/Crc32.hx:43: characters 3-23
		$b1 = $b->b;
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/Crc32.hx:44: characters 13-16
		$_g = $pos;
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/Crc32.hx:44: characters 19-28
		$_g1 = $pos + $len;
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/Crc32.hx:44: lines 44-49
		while ($_g < $_g1) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/Crc32.hx:44: characters 13-28
			$i = $_g++;
			#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/Crc32.hx:45: characters 4-57
			$tmp = ($this->crc ^ \ord($b1->s[$i])) & 255;
			#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/Crc32.hx:47: characters 5-50
			$tmp = Boot::shiftRightUnsigned($tmp, 1) ^ (-($tmp & 1) & -306674912);
			$tmp = Boot::shiftRightUnsigned($tmp, 1) ^ (-($tmp & 1) & -306674912);
			$tmp = Boot::shiftRightUnsigned($tmp, 1) ^ (-($tmp & 1) & -306674912);
			$tmp = Boot::shiftRightUnsigned($tmp, 1) ^ (-($tmp & 1) & -306674912);
			$tmp = Boot::shiftRightUnsigned($tmp, 1) ^ (-($tmp & 1) & -306674912);
			$tmp = Boot::shiftRightUnsigned($tmp, 1) ^ (-($tmp & 1) & -306674912);
			$tmp = Boot::shiftRightUnsigned($tmp, 1) ^ (-($tmp & 1) & -306674912);
			$tmp = Boot::shiftRightUnsigned($tmp, 1) ^ (-($tmp & 1) & -306674912);
			#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/Crc32.hx:48: characters 4-27
			$this->crc = Boot::shiftRightUnsigned($this->crc, 8) ^ $tmp;
		}
	}
}

Boot::registerClass(Crc32::class, 'haxe.crypto.Crc32');
