<?php
/**
 * Generated by Haxe 4.1.4
 */

namespace helder\std\haxe\io;

use \helder\std\php\Boot;
use \helder\std\haxe\Exception;

class BytesOutput extends Output {
	/**
	 * @var BytesBuffer
	 */
	public $b;

	/**
	 * @return void
	 */
	public function __construct () {
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/io/BytesOutput.hx:31: characters 3-24
		$this->b = new BytesBuffer();
	}

	/**
	 * @return Bytes
	 */
	public function getBytes () {
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/io/BytesOutput.hx:44: characters 3-22
		return $this->b->getBytes();
	}

	/**
	 * @return int
	 */
	public function get_length () {
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/io/BytesOutput.hx:48: characters 10-18
		return \strlen($this->b->b);
	}

	/**
	 * @param int $c
	 * 
	 * @return void
	 */
	public function writeByte ($c) {
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/io/BytesOutput.hx:35: characters 3-15
		$_this = $this->b;
		$_this->b = ($_this->b . \chr($c));
	}

	/**
	 * @param Bytes $buf
	 * @param int $pos
	 * @param int $len
	 * 
	 * @return int
	 */
	public function writeBytes ($buf, $pos, $len) {
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/io/BytesOutput.hx:39: characters 3-28
		$_this = $this->b;
		if (($pos < 0) || ($len < 0) || (($pos + $len) > $buf->length)) {
			throw Exception::thrown(Error::OutsideBounds());
		} else {
			$left = $_this->b;
			$this_s = \substr($buf->b->s, $pos, $len);
			$_this->b = ($left . $this_s);
		}
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/haxe/io/BytesOutput.hx:40: characters 3-13
		return $len;
	}
}

Boot::registerClass(BytesOutput::class, 'haxe.io.BytesOutput');
Boot::registerGetters('helder\\std\\haxe\\io\\BytesOutput', [
	'length' => true
]);
