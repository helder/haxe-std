<?php
/**
 * Generated by Haxe 4.1.0
 */

namespace helder\std\haxe\zip;

use \helder\std\haxe\zip\_InflateImpl\Window;
use \helder\std\haxe\zip\_InflateImpl\State;
use \helder\std\php\Boot;
use \helder\std\haxe\Exception;
use \helder\std\Array_hx;
use \helder\std\haxe\io\BytesBuffer;
use \helder\std\haxe\io\Error;
use \helder\std\haxe\io\Input;
use \helder\std\haxe\crypto\Adler32;
use \helder\std\haxe\io\Bytes;

/**
 * A pure Haxe implementation of the ZLIB Inflate algorithm which allows reading compressed data without any platform-specific support.
 */
class InflateImpl {
	/**
	 * @var Array_hx
	 */
	static public $CODE_LENGTHS_POS;
	/**
	 * @var Array_hx
	 */
	static public $DIST_BASE_VAL_TBL;
	/**
	 * @var Array_hx
	 */
	static public $DIST_EXTRA_BITS_TBL;
	/**
	 * @var Huffman
	 */
	static public $FIXED_HUFFMAN = null;
	/**
	 * @var Array_hx
	 */
	static public $LEN_BASE_VAL_TBL;
	/**
	 * @var Array_hx
	 */
	static public $LEN_EXTRA_BITS_TBL;

	/**
	 * @var int
	 */
	public $bits;
	/**
	 * @var int
	 */
	public $dist;
	/**
	 * @var HuffTools
	 */
	public $htools;
	/**
	 * @var Huffman
	 */
	public $huffdist;
	/**
	 * @var Huffman
	 */
	public $huffman;
	/**
	 * @var Input
	 */
	public $input;
	/**
	 * @var bool
	 */
	public $isFinal;
	/**
	 * @var int
	 */
	public $len;
	/**
	 * @var Array_hx
	 */
	public $lengths;
	/**
	 * @var int
	 */
	public $nbits;
	/**
	 * @var int
	 */
	public $needed;
	/**
	 * @var int
	 */
	public $outpos;
	/**
	 * @var Bytes
	 */
	public $output;
	/**
	 * @var State
	 */
	public $state;
	/**
	 * @var Window
	 */
	public $window;

	/**
	 * @param Input $i
	 * @param int $bufsize
	 * 
	 * @return Bytes
	 */
	public static function run ($i, $bufsize = 65536) {
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:388: lines 388-399
		if ($bufsize === null) {
			$bufsize = 65536;
		}
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:389: characters 3-42
		$buf = Bytes::alloc($bufsize);
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:390: characters 3-42
		$output = new BytesBuffer();
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:391: characters 3-36
		$inflate = new InflateImpl($i);
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:392: lines 392-397
		while (true) {
			#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:393: characters 4-49
			$len = $inflate->readBytes($buf, 0, $bufsize);
			#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:394: characters 4-32
			if (($len < 0) || ($len > $buf->length)) {
				throw Exception::thrown(Error::OutsideBounds());
			} else {
				$left = $output->b;
				$this_s = substr($buf->b->s, 0, $len);
				$output->b = ($left . $this_s);
			}
			#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:395: lines 395-396
			if ($len < $bufsize) {
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:396: characters 5-10
				break;
			}
		}
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:398: characters 3-27
		return $output->getBytes();
	}

	/**
	 * @param Input $i
	 * @param bool $header
	 * @param bool $crc
	 * 
	 * @return void
	 */
	public function __construct ($i, $header = true, $crc = true) {
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:129: lines 129-147
		if ($header === null) {
			$header = true;
		}
		if ($crc === null) {
			$crc = true;
		}
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:130: characters 3-18
		$this->isFinal = false;
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:131: characters 3-27
		$this->htools = new HuffTools();
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:132: characters 3-32
		$this->huffman = $this->buildFixedHuffman();
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:133: characters 3-18
		$this->huffdist = null;
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:134: characters 3-10
		$this->len = 0;
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:135: characters 3-11
		$this->dist = 0;
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:136: characters 3-32
		$this->state = ($header ? State::Head() : State::Block());
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:137: characters 3-12
		$this->input = $i;
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:138: characters 3-11
		$this->bits = 0;
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:139: characters 3-12
		$this->nbits = 0;
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:140: characters 3-13
		$this->needed = 0;
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:141: characters 3-16
		$this->output = null;
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:142: characters 3-13
		$this->outpos = 0;
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:143: characters 3-24
		$this->lengths = new Array_hx();
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:145: characters 4-20
		$_this = $this->lengths;
		$_this->arr[$_this->length++] = -1;
		$_this = $this->lengths;
		$_this->arr[$_this->length++] = -1;
		$_this = $this->lengths;
		$_this->arr[$_this->length++] = -1;
		$_this = $this->lengths;
		$_this->arr[$_this->length++] = -1;
		$_this = $this->lengths;
		$_this->arr[$_this->length++] = -1;
		$_this = $this->lengths;
		$_this->arr[$_this->length++] = -1;
		$_this = $this->lengths;
		$_this->arr[$_this->length++] = -1;
		$_this = $this->lengths;
		$_this->arr[$_this->length++] = -1;
		$_this = $this->lengths;
		$_this->arr[$_this->length++] = -1;
		$_this = $this->lengths;
		$_this->arr[$_this->length++] = -1;
		$_this = $this->lengths;
		$_this->arr[$_this->length++] = -1;
		$_this = $this->lengths;
		$_this->arr[$_this->length++] = -1;
		$_this = $this->lengths;
		$_this->arr[$_this->length++] = -1;
		$_this = $this->lengths;
		$_this->arr[$_this->length++] = -1;
		$_this = $this->lengths;
		$_this->arr[$_this->length++] = -1;
		$_this = $this->lengths;
		$_this->arr[$_this->length++] = -1;
		$_this = $this->lengths;
		$_this->arr[$_this->length++] = -1;
		$_this = $this->lengths;
		$_this->arr[$_this->length++] = -1;
		$_this = $this->lengths;
		$_this->arr[$_this->length++] = -1;
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:146: characters 3-27
		$this->window = new Window($crc);
	}

	/**
	 * @param int $b
	 * 
	 * @return void
	 */
	public function addByte ($b) {
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:212: characters 3-20
		$this->window->addByte($b);
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:213: characters 3-24
		$this->output->b->s[$this->outpos] = chr($b);
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:214: characters 3-11
		$this->needed--;
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:215: characters 3-11
		$this->outpos++;
	}

	/**
	 * @param Bytes $b
	 * @param int $p
	 * @param int $len
	 * 
	 * @return void
	 */
	public function addBytes ($b, $p, $len) {
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:205: characters 3-29
		$this->window->addBytes($b, $p, $len);
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:206: characters 3-33
		$_this = $this->output;
		$pos = $this->outpos;
		if (($pos < 0) || ($p < 0) || ($len < 0) || (($pos + $len) > $_this->length) || (($p + $len) > $b->length)) {
			throw Exception::thrown(Error::OutsideBounds());
		} else {
			$this1 = $_this->b;
			$src = $b->b;
			$this1->s = ((substr($this1->s, 0, $pos) . substr($src->s, $p, $len)) . substr($this1->s, $pos + $len));
		}
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:207: characters 3-16
		$this->needed -= $len;
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:208: characters 3-16
		$this->outpos += $len;
	}

	/**
	 * @param int $d
	 * @param int $len
	 * 
	 * @return void
	 */
	public function addDist ($d, $len) {
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:225: characters 3-47
		$this->addBytes($this->window->buffer, $this->window->pos - $d, $len);
	}

	/**
	 * @param int $n
	 * 
	 * @return void
	 */
	public function addDistOne ($n) {
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:219: characters 3-32
		$c = $this->window->getLastChar();
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:220: characters 13-17
		$_g = 0;
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:220: characters 17-18
		$_g1 = $n;
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:220: lines 220-221
		while ($_g < $_g1) {
			#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:220: characters 13-18
			$i = $_g++;
			#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:221: characters 4-14
			$this->addByte($c);
		}
	}

	/**
	 * @param Huffman $h
	 * 
	 * @return int
	 */
	public function applyHuffman ($h) {
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:229: lines 229-233
		$__hx__switch = ($h->index);
		if ($__hx__switch === 0) {
			#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:230: characters 15-16
			$n = $h->params[0];
			#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:230: characters 19-20
			return $n;
		} else if ($__hx__switch === 1) {
			#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:231: characters 20-21
			$b = $h->params[1];
			#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:231: characters 17-18
			$a = $h->params[0];
			#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:231: characters 24-54
			return $this->applyHuffman(($this->getBit() ? $b : $a));
		} else if ($__hx__switch === 2) {
			#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:232: characters 21-24
			$tbl = $h->params[1];
			#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:232: characters 18-19
			$n = $h->params[0];
			#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:232: characters 27-56
			return $this->applyHuffman(($tbl->arr[$this->getBits($n)] ?? null));
		}
	}

	/**
	 * @return Huffman
	 */
	public function buildFixedHuffman () {
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:150: lines 150-151
		if (InflateImpl::$FIXED_HUFFMAN !== null) {
			#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:151: characters 4-24
			return InflateImpl::$FIXED_HUFFMAN;
		}
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:152: characters 3-23
		$a = new Array_hx();
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:153: characters 13-17
		$_g = 0;
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:153: lines 153-154
		while ($_g < 288) {
			#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:153: characters 13-20
			$n = $_g++;
			#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:154: characters 4-76
			$a->arr[$a->length++] = ($n <= 143 ? 8 : ($n <= 255 ? 9 : ($n <= 279 ? 7 : 8)));
		}
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:155: characters 3-45
		InflateImpl::$FIXED_HUFFMAN = $this->htools->make($a, 0, 288, 10);
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:156: characters 3-23
		return InflateImpl::$FIXED_HUFFMAN;
	}

	/**
	 * @return bool
	 */
	public function getBit () {
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:180: lines 180-183
		if ($this->nbits === 0) {
			#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:181: characters 4-13
			$this->nbits = 8;
			#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:182: characters 4-27
			$this->bits = $this->input->readByte();
		}
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:184: characters 3-25
		$b = ($this->bits & 1) === 1;
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:185: characters 3-10
		$this->nbits--;
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:186: characters 3-13
		$this->bits >>= 1;
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:187: characters 3-11
		return $b;
	}

	/**
	 * @param int $n
	 * 
	 * @return int
	 */
	public function getBits ($n) {
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:169: lines 169-172
		while ($this->nbits < $n) {
			#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:170: characters 4-8
			$tmp = $this;
			#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:170: characters 4-37
			$tmp->bits = $tmp->bits | ($this->input->readByte() << $this->nbits);
			#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:171: characters 4-14
			$this->nbits += 8;
		}
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:173: characters 3-33
		$b = $this->bits & ((1 << $n) - 1);
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:174: characters 3-13
		$this->nbits -= $n;
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:175: characters 3-13
		$this->bits >>= $n;
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:176: characters 3-11
		return $b;
	}

	/**
	 * @param int $n
	 * 
	 * @return int
	 */
	public function getRevBits ($n) {
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:191: lines 191-196
		if ($n === 0) {
			#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:192: characters 4-5
			return 0;
		} else if ($this->getBit()) {
			#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:194: characters 4-38
			return (1 << ($n - 1)) | $this->getRevBits($n - 1);
		} else {
			#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:196: characters 4-21
			return $this->getRevBits($n - 1);
		}
	}

	/**
	 * @param Array_hx $a
	 * @param int $max
	 * 
	 * @return void
	 */
	public function inflateLengths ($a, $max) {
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:237: characters 3-13
		$i = 0;
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:238: characters 3-16
		$prev = 0;
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:239: lines 239-265
		while ($i < $max) {
			#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:240: characters 4-34
			$n = $this->applyHuffman($this->huffman);
			#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:241: lines 241-264
			if ($n === 0 || $n === 1 || $n === 2 || $n === 3 || $n === 4 || $n === 5 || $n === 6 || $n === 7 || $n === 8 || $n === 9 || $n === 10 || $n === 11 || $n === 12 || $n === 13 || $n === 14 || $n === 15) {
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:243: characters 6-14
				$prev = $n;
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:244: characters 6-14
				$a->offsetSet($i, $n);
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:245: characters 6-9
				++$i;
			} else if ($n === 16) {
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:247: characters 6-35
				$end = $i + 3 + $this->getBits(2);
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:248: lines 248-249
				if ($end > $max) {
					#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:249: characters 7-12
					throw Exception::thrown("Invalid data");
				}
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:250: lines 250-253
				while ($i < $end) {
					#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:251: characters 7-18
					$a->offsetSet($i, $prev);
					#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:252: characters 7-10
					++$i;
				}
			} else if ($n === 17) {
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:255: characters 6-25
				$i += 3 + $this->getBits(3);
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:256: lines 256-257
				if ($i > $max) {
					#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:257: characters 7-12
					throw Exception::thrown("Invalid data");
				}
			} else if ($n === 18) {
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:259: characters 6-26
				$i += 11 + $this->getBits(7);
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:260: lines 260-261
				if ($i > $max) {
					#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:261: characters 7-12
					throw Exception::thrown("Invalid data");
				}
			} else {
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:263: characters 6-11
				throw Exception::thrown("Invalid data");
			}
		}
	}

	/**
	 * @return bool
	 */
	public function inflateLoop () {
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:269: characters 11-16
		$__hx__switch = ($this->state->index);
		if ($__hx__switch === 0) {
			#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:271: characters 5-32
			$cmf = $this->input->readByte();
			#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:272: characters 5-23
			$cm = $cmf & 15;
			#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:273: characters 5-26
			$cinfo = $cmf >> 4;
			#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:274: lines 274-275
			if ($cm !== 8) {
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:275: characters 6-11
				throw Exception::thrown("Invalid data");
			}
			#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:276: characters 5-32
			$flg = $this->input->readByte();
			#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:278: characters 5-31
			$fdict = ($flg & 32) !== 0;
			#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:280: lines 280-281
			if (((($cmf << 8) + $flg) % 31) !== 0) {
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:281: characters 6-11
				throw Exception::thrown("Invalid data");
			}
			#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:282: lines 282-283
			if ($fdict) {
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:283: characters 6-11
				throw Exception::thrown("Unsupported dictionary");
			}
			#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:284: characters 5-18
			$this->state = State::Block();
			#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:285: characters 5-16
			return true;
		} else if ($__hx__switch === 1) {
			#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:301: characters 5-23
			$this->isFinal = $this->getBit();
			#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:302: characters 13-23
			$__hx__switch = ($this->getBits(2));
			if ($__hx__switch === 0) {
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:304: characters 7-31
				$this->len = $this->input->readUInt16();
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:305: characters 7-37
				$nlen = $this->input->readUInt16();
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:306: characters 7-38
				if ($nlen !== (65535 - $this->len)) {
					#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:306: characters 33-38
					throw Exception::thrown("Invalid data");
				}
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:307: characters 7-19
				$this->state = State::Flat();
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:308: characters 7-29
				$r = $this->inflateLoop();
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:309: characters 7-18
				$this->resetBits();
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:310: characters 7-15
				return $r;
			} else if ($__hx__switch === 1) {
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:312: characters 7-36
				$this->huffman = $this->buildFixedHuffman();
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:313: characters 7-22
				$this->huffdist = null;
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:314: characters 7-20
				$this->state = State::CData();
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:315: characters 7-18
				return true;
			} else if ($__hx__switch === 2) {
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:317: characters 7-35
				$hlit = $this->getBits(5) + 257;
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:318: characters 7-34
				$hdist = $this->getBits(5) + 1;
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:319: characters 7-34
				$hclen = $this->getBits(4) + 4;
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:320: characters 17-21
				$_g = 0;
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:320: characters 21-26
				$_g1 = $hclen;
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:320: lines 320-321
				while ($_g < $_g1) {
					#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:320: characters 17-26
					$i = $_g++;
					#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:321: characters 8-49
					$this->lengths->offsetSet((InflateImpl::$CODE_LENGTHS_POS->arr[$i] ?? null), $this->getBits(3));
				}
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:322: characters 17-22
				$_g = $hclen;
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:322: characters 25-27
				$_g1 = 19;
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:322: lines 322-323
				while ($_g < $_g1) {
					#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:322: characters 17-27
					$i = $_g++;
					#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:323: characters 8-40
					$this->lengths->offsetSet((InflateImpl::$CODE_LENGTHS_POS->arr[$i] ?? null), 0);
				}
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:324: characters 7-47
				$this->huffman = $this->htools->make($this->lengths, 0, 19, 8);
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:325: characters 7-33
				$lengths = new Array_hx();
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:326: characters 17-21
				$_g = 0;
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:326: characters 21-33
				$_g1 = $hlit + $hdist;
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:326: lines 326-327
				while ($_g < $_g1) {
					#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:326: characters 17-33
					$i = $_g++;
					#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:327: characters 8-23
					$lengths->arr[$lengths->length++] = 0;
				}
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:328: characters 7-44
				$this->inflateLengths($lengths, $hlit + $hdist);
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:329: characters 7-55
				$this->huffdist = $this->htools->make($lengths, $hlit, $hdist, 16);
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:330: characters 7-50
				$this->huffman = $this->htools->make($lengths, 0, $hlit, 16);
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:331: characters 7-20
				$this->state = State::CData();
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:332: characters 7-18
				return true;
			} else {
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:334: characters 7-12
				throw Exception::thrown("Invalid data");
			}
		} else if ($__hx__switch === 2) {
			#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:362: characters 5-35
			$n = $this->applyHuffman($this->huffman);
			#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:363: lines 363-384
			if ($n < 256) {
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:364: characters 6-16
				$this->addByte($n);
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:365: characters 6-23
				return $this->needed > 0;
			} else if ($n === 256) {
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:367: characters 6-35
				$this->state = ($this->isFinal ? State::Crc() : State::Block());
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:368: characters 6-17
				return true;
			} else {
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:370: characters 6-14
				$n -= 257;
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:371: characters 6-45
				$extra_bits = (InflateImpl::$LEN_EXTRA_BITS_TBL->arr[$n] ?? null);
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:372: lines 372-373
				if ($extra_bits === -1) {
					#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:373: characters 7-12
					throw Exception::thrown("Invalid data");
				}
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:374: characters 6-53
				$this->len = (InflateImpl::$LEN_BASE_VAL_TBL->arr[$n] ?? null) + $this->getBits($extra_bits);
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:375: characters 6-86
				$dist_code = ($this->huffdist === null ? $this->getRevBits(5) : $this->applyHuffman($this->huffdist));
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:376: characters 6-49
				$extra_bits = (InflateImpl::$DIST_EXTRA_BITS_TBL->arr[$dist_code] ?? null);
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:377: lines 377-378
				if ($extra_bits === -1) {
					#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:378: characters 7-12
					throw Exception::thrown("Invalid data");
				}
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:379: characters 6-63
				$this->dist = (InflateImpl::$DIST_BASE_VAL_TBL->arr[$dist_code] ?? null) + $this->getBits($extra_bits);
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:380: lines 380-381
				if ($this->dist > $this->window->available()) {
					#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:381: characters 7-12
					throw Exception::thrown("Invalid data");
				}
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:382: characters 6-42
				$this->state = ($this->dist === 1 ? State::DistOne() : State::Dist());
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:383: characters 6-17
				return true;
			}
		} else if ($__hx__switch === 3) {
			#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:337: characters 5-46
			$rlen = ($this->len < $this->needed ? $this->len : $this->needed);
			#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:338: characters 5-34
			$bytes = $this->input->read($rlen);
			#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:339: characters 5-16
			$this->len -= $rlen;
			#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:340: characters 5-29
			$this->addBytes($bytes, 0, $rlen);
			#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:341: lines 341-342
			if ($this->len === 0) {
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:342: characters 6-35
				$this->state = ($this->isFinal ? State::Crc() : State::Block());
			}
			#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:343: characters 5-22
			return $this->needed > 0;
		} else if ($__hx__switch === 4) {
			#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:287: characters 5-34
			$calc = $this->window->checksum();
			#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:288: lines 288-291
			if ($calc === null) {
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:289: characters 6-18
				$this->state = State::Done();
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:290: characters 6-17
				return true;
			}
			#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:292: characters 5-35
			$crc = Adler32::read($this->input);
			#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:293: lines 293-294
			if (!$calc->equals($crc)) {
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:294: characters 6-11
				throw Exception::thrown("Invalid CRC");
			}
			#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:295: characters 5-17
			$this->state = State::Done();
			#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:296: characters 5-16
			return true;
		} else if ($__hx__switch === 5) {
			#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:352: lines 352-357
			while (($this->len > 0) && ($this->needed > 0)) {
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:353: characters 6-44
				$rdist = ($this->len < $this->dist ? $this->len : $this->dist);
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:354: characters 6-51
				$rlen = ($this->needed < $rdist ? $this->needed : $rdist);
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:355: characters 6-25
				$this->addDist($this->dist, $rlen);
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:356: characters 6-17
				$this->len -= $rlen;
			}
			#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:358: lines 358-359
			if ($this->len === 0) {
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:359: characters 6-19
				$this->state = State::CData();
			}
			#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:360: characters 5-22
			return $this->needed > 0;
		} else if ($__hx__switch === 6) {
			#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:345: characters 5-46
			$rlen = ($this->len < $this->needed ? $this->len : $this->needed);
			#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:346: characters 5-21
			$this->addDistOne($rlen);
			#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:347: characters 5-16
			$this->len -= $rlen;
			#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:348: lines 348-349
			if ($this->len === 0) {
				#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:349: characters 6-19
				$this->state = State::CData();
			}
			#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:350: characters 5-22
			return $this->needed > 0;
		} else if ($__hx__switch === 7) {
			#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:299: characters 5-17
			return false;
		}
	}

	/**
	 * @param Bytes $b
	 * @param int $pos
	 * @param int $len
	 * 
	 * @return int
	 */
	public function readBytes ($b, $pos, $len) {
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:160: characters 3-15
		$this->needed = $len;
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:161: characters 3-15
		$this->outpos = $pos;
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:162: characters 3-13
		$this->output = $b;
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:163: lines 163-164
		if ($len > 0) {
			#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:164: characters 4-28
			while ($this->inflateLoop()) {
			}
		}
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:165: characters 3-22
		return $len - $this->needed;
	}

	/**
	 * @return void
	 */
	public function resetBits () {
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:200: characters 3-11
		$this->bits = 0;
		#/home/runner/haxe/versions/4.1.0/std/haxe/zip/InflateImpl.hx:201: characters 3-12
		$this->nbits = 0;
	}

	/**
	 * @internal
	 * @access private
	 */
	static public function __hx__init ()
	{
		static $called = false;
		if ($called) return;
		$called = true;


		self::$LEN_EXTRA_BITS_TBL = Array_hx::wrap([
			0,
			0,
			0,
			0,
			0,
			0,
			0,
			0,
			1,
			1,
			1,
			1,
			2,
			2,
			2,
			2,
			3,
			3,
			3,
			3,
			4,
			4,
			4,
			4,
			5,
			5,
			5,
			5,
			0,
			-1,
			-1,
		]);
		self::$LEN_BASE_VAL_TBL = Array_hx::wrap([
			3,
			4,
			5,
			6,
			7,
			8,
			9,
			10,
			11,
			13,
			15,
			17,
			19,
			23,
			27,
			31,
			35,
			43,
			51,
			59,
			67,
			83,
			99,
			115,
			131,
			163,
			195,
			227,
			258,
		]);
		self::$DIST_EXTRA_BITS_TBL = Array_hx::wrap([
			0,
			0,
			0,
			0,
			1,
			1,
			2,
			2,
			3,
			3,
			4,
			4,
			5,
			5,
			6,
			6,
			7,
			7,
			8,
			8,
			9,
			9,
			10,
			10,
			11,
			11,
			12,
			12,
			13,
			13,
			-1,
			-1,
		]);
		self::$DIST_BASE_VAL_TBL = Array_hx::wrap([
			1,
			2,
			3,
			4,
			5,
			7,
			9,
			13,
			17,
			25,
			33,
			49,
			65,
			97,
			129,
			193,
			257,
			385,
			513,
			769,
			1025,
			1537,
			2049,
			3073,
			4097,
			6145,
			8193,
			12289,
			16385,
			24577,
		]);
		self::$CODE_LENGTHS_POS = Array_hx::wrap([
			16,
			17,
			18,
			0,
			8,
			7,
			9,
			6,
			10,
			5,
			11,
			4,
			12,
			3,
			13,
			2,
			14,
			1,
			15,
		]);
	}
}

Boot::registerClass(InflateImpl::class, 'haxe.zip.InflateImpl');
InflateImpl::__hx__init();
