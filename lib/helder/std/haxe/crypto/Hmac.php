<?php
/**
 */

namespace helder\std\haxe\crypto;

use \helder\std\haxe\io\_BytesData\Container;
use \helder\std\php\Boot;
use \helder\std\haxe\io\BytesBuffer;
use \helder\std\haxe\io\Bytes;

/**
 * Calculates a Hmac of the given Bytes using a HashMethod.
 */
class Hmac {
	/**
	 * @var int
	 */
	public $blockSize;
	/**
	 * @var int
	 */
	public $length;
	/**
	 * @var HashMethod
	 */
	public $method;

	/**
	 * @param HashMethod $hashMethod
	 * 
	 * @return void
	 */
	public function __construct ($hashMethod) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/Hmac.hx:43: characters 3-22
		$this->method = $hashMethod;
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/Hmac.hx:44: lines 44-46
		$this->blockSize = 64;
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/Hmac.hx:47: lines 47-51
		$tmp = null;
		$__hx__switch = ($hashMethod->index);
		if ($__hx__switch === 0) {
			$tmp = 16;
		} else if ($__hx__switch === 1) {
			$tmp = 20;
		} else if ($__hx__switch === 2) {
			$tmp = 32;
		}
		$this->length = $tmp;
	}

	/**
	 * @param Bytes $b
	 * 
	 * @return Bytes
	 */
	public function doHash ($b) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/Hmac.hx:55: characters 18-24
		$__hx__switch = ($this->method->index);
		if ($__hx__switch === 0) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/Hmac.hx:56: characters 14-25
			$b1 = new Container(\md5($b->b->s, true));
			return new Bytes(\strlen($b1->s), $b1);
		} else if ($__hx__switch === 1) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/Hmac.hx:57: characters 15-27
			$b1 = new Container(\sha1($b->b->s, true));
			return new Bytes(\strlen($b1->s), $b1);
		} else if ($__hx__switch === 2) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/Hmac.hx:58: characters 17-31
			return Sha256::make($b);
		}
	}

	/**
	 * @param Bytes $key
	 * @param Bytes $msg
	 * 
	 * @return Bytes
	 */
	public function make ($key, $msg) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/Hmac.hx:74: lines 74-76
		if ($key->length > $this->blockSize) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/Hmac.hx:75: characters 10-21
			$__hx__switch = ($this->method->index);
			if ($__hx__switch === 0) {
				$b = new Container(\md5($key->b->s, true));
				$key = new Bytes(\strlen($b->s), $b);
			} else if ($__hx__switch === 1) {
				$b = new Container(\sha1($key->b->s, true));
				$key = new Bytes(\strlen($b->s), $b);
			} else if ($__hx__switch === 2) {
				$key = Sha256::make($key);
			}
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/Hmac.hx:77: characters 3-32
		$key = $this->nullPad($key, $this->blockSize);
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/Hmac.hx:79: characters 3-38
		$Ki = new BytesBuffer();
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/Hmac.hx:80: characters 3-38
		$Ko = new BytesBuffer();
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/Hmac.hx:81: characters 13-17
		$_g = 0;
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/Hmac.hx:81: characters 17-27
		$_g1 = $key->length;
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/Hmac.hx:81: lines 81-84
		while ($_g < $_g1) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/Hmac.hx:81: characters 13-27
			$i = $_g++;
			#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/Hmac.hx:82: characters 4-33
			$byte = \ord($key->b->s[$i]) ^ 92;
			$Ko->b = ($Ko->b . \chr($byte));
			#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/Hmac.hx:83: characters 4-33
			$byte1 = \ord($key->b->s[$i]) ^ 54;
			$Ki->b = ($Ki->b . \chr($byte1));
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/Hmac.hx:86: characters 3-14
		$Ki->b = ($Ki->b . $msg->b->s);
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/Hmac.hx:87: characters 10-31
		$b = $Ki->getBytes();
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/Hmac.hx:87: characters 3-32
		$src = null;
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/Hmac.hx:87: characters 10-31
		$__hx__switch = ($this->method->index);
		if ($__hx__switch === 0) {
			$b1 = new Container(\md5($b->b->s, true));
			#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/Hmac.hx:87: characters 3-32
			$src = new Bytes(\strlen($b1->s), $b1);
		} else if ($__hx__switch === 1) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/Hmac.hx:87: characters 10-31
			$b1 = new Container(\sha1($b->b->s, true));
			#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/Hmac.hx:87: characters 3-32
			$src = new Bytes(\strlen($b1->s), $b1);
		} else if ($__hx__switch === 2) {
			$src = Sha256::make($b);
		}
		$Ko->b = ($Ko->b . $src->b->s);
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/Hmac.hx:88: characters 10-31
		$b = $Ko->getBytes();
		$__hx__switch = ($this->method->index);
		if ($__hx__switch === 0) {
			$b1 = new Container(\md5($b->b->s, true));
			return new Bytes(\strlen($b1->s), $b1);
		} else if ($__hx__switch === 1) {
			$b1 = new Container(\sha1($b->b->s, true));
			return new Bytes(\strlen($b1->s), $b1);
		} else if ($__hx__switch === 2) {
			return Sha256::make($b);
		}
	}

	/**
	 * @param Bytes $s
	 * @param int $chunkLen
	 * 
	 * @return Bytes
	 */
	public function nullPad ($s, $chunkLen) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/Hmac.hx:63: characters 3-44
		$r = $chunkLen - ($s->length % $chunkLen);
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/Hmac.hx:64: lines 64-65
		if (($r === $chunkLen) && ($s->length !== 0)) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/Hmac.hx:65: characters 4-12
			return $s;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/Hmac.hx:66: characters 3-38
		$sb = new BytesBuffer();
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/Hmac.hx:67: characters 3-12
		$sb->b = ($sb->b . $s->b->s);
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/Hmac.hx:68: characters 13-17
		$_g = 0;
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/Hmac.hx:68: characters 17-18
		$_g1 = $r;
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/Hmac.hx:68: lines 68-69
		while ($_g < $_g1) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/Hmac.hx:68: characters 13-18
			$x = $_g++;
			#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/Hmac.hx:69: characters 4-17
			$sb->b = ($sb->b . \chr(0));
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/crypto/Hmac.hx:70: characters 3-23
		return $sb->getBytes();
	}
}

Boot::registerClass(Hmac::class, 'haxe.crypto.Hmac');
