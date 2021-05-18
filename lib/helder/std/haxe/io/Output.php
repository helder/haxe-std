<?php
/**
 * Generated by Haxe 4.2.2
 */

namespace helder\std\haxe\io;

use \helder\std\haxe\io\_BytesData\Container;
use \helder\std\php\_Boot\HxAnon;
use \helder\std\php\Boot;
use \helder\std\haxe\Exception;
use \helder\std\haxe\exceptions\NotImplementedException;
use \helder\std\haxe\NativeStackTrace;

/**
 * An Output is an abstract write. A specific output implementation will only
 * have to override the `writeByte` and maybe the `write`, `flush` and `close`
 * methods. See `File.write` and `String.write` for two ways of creating an
 * Output.
 */
class Output {
	/**
	 * @var bool
	 * Endianness (word byte order) used when writing numbers.
	 * If `true`, big-endian is used, otherwise `little-endian` is used.
	 */
	public $bigEndian;

	/**
	 * Close the output.
	 * Behaviour while writing after calling this method is unspecified.
	 * 
	 * @return void
	 */
	public function close () {
	}

	/**
	 * Flush any buffered data.
	 * 
	 * @return void
	 */
	public function flush () {
	}

	/**
	 * Inform that we are about to write at least `nbytes` bytes.
	 * The underlying implementation can allocate proper working space depending
	 * on this information, or simply ignore it. This is not a mandatory call
	 * but a tip and is only used in some specific cases.
	 * 
	 * @param int $nbytes
	 * 
	 * @return void
	 */
	public function prepare ($nbytes) {
	}

	/**
	 * @param bool $b
	 * 
	 * @return bool
	 */
	public function set_bigEndian ($b) {
		#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:95: characters 3-16
		$this->bigEndian = $b;
		#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:96: characters 3-11
		return $b;
	}

	/**
	 * Write all bytes stored in `s`.
	 * 
	 * @param Bytes $s
	 * 
	 * @return void
	 */
	public function write ($s) {
		#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:104: characters 3-20
		$l = $s->length;
		#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:105: characters 3-13
		$p = 0;
		#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:106: lines 106-112
		while ($l > 0) {
			#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:107: characters 4-32
			$k = $this->writeBytes($s, $p, $l);
			#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:108: lines 108-109
			if ($k === 0) {
				#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:109: characters 5-10
				throw Exception::thrown(Error::Blocked());
			}
			#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:110: characters 4-10
			$p += $k;
			#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:111: characters 4-10
			$l -= $k;
		}
	}

	/**
	 * Write one byte.
	 * 
	 * @param int $c
	 * 
	 * @return void
	 */
	public function writeByte ($c) {
		#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:47: characters 3-8
		throw new NotImplementedException(null, null, new _HxAnon_Output0("haxe/io/Output.hx", 47, "haxe.io.Output", "writeByte"));
	}

	/**
	 * Write `len` bytes from `s` starting by position specified by `pos`.
	 * Returns the actual length of written data that can differ from `len`.
	 * See `writeFullBytes` that tries to write the exact amount of specified bytes.
	 * 
	 * @param Bytes $s
	 * @param int $pos
	 * @param int $len
	 * 
	 * @return int
	 */
	public function writeBytes ($s, $pos, $len) {
		#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:59: lines 59-60
		if (($pos < 0) || ($len < 0) || (($pos + $len) > $s->length)) {
			#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:60: characters 4-9
			throw Exception::thrown(Error::OutsideBounds());
		}
		#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:62: characters 3-61
		$b = $s->b;
		#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:63: characters 3-15
		$k = $len;
		#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:64: lines 64-78
		while ($k > 0) {
			#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:68: characters 4-25
			$this->writeByte(\ord($b->s[$pos]));
			#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:76: characters 4-9
			++$pos;
			#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:77: characters 4-7
			--$k;
		}
		#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:79: characters 3-13
		return $len;
	}

	/**
	 * Write `x` as 64-bit double-precision floating point number.
	 * Endianness is specified by the `bigEndian` property.
	 * 
	 * @param float $x
	 * 
	 * @return void
	 */
	public function writeDouble ($x) {
		#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:143: characters 3-37
		$i64 = FPHelper::doubleToI64($x);
		#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:144: lines 144-150
		if ($this->bigEndian) {
			#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:145: characters 4-24
			$this->writeInt32($i64->high);
			#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:146: characters 4-23
			$this->writeInt32($i64->low);
		} else {
			#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:148: characters 4-23
			$this->writeInt32($i64->low);
			#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:149: characters 4-24
			$this->writeInt32($i64->high);
		}
	}

	/**
	 * Write `x` as 32-bit floating point number.
	 * Endianness is specified by the `bigEndian` property.
	 * 
	 * @param float $x
	 * 
	 * @return void
	 */
	public function writeFloat ($x) {
		#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:134: characters 3-37
		$this->writeInt32(\unpack("l", \pack("f", $x))[1]);
	}

	/**
	 * Write `len` bytes from `s` starting by position specified by `pos`.
	 * Unlike `writeBytes`, this method tries to write the exact `len` amount of bytes.
	 * 
	 * @param Bytes $s
	 * @param int $pos
	 * @param int $len
	 * 
	 * @return void
	 */
	public function writeFullBytes ($s, $pos, $len) {
		#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:121: lines 121-125
		while ($len > 0) {
			#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:122: characters 4-36
			$k = $this->writeBytes($s, $pos, $len);
			#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:123: characters 4-12
			$pos += $k;
			#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:124: characters 4-12
			$len -= $k;
		}
	}

	/**
	 * Read all available data from `i` and write it.
	 * The `bufsize` optional argument specifies the size of chunks by
	 * which data is read and written. Its default value is 4096.
	 * 
	 * @param Input $i
	 * @param int $bufsize
	 * 
	 * @return void
	 */
	public function writeInput ($i, $bufsize = null) {
		#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:255: lines 255-256
		if ($bufsize === null) {
			#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:256: characters 4-18
			$bufsize = 4096;
		}
		#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:257: characters 3-34
		$buf = Bytes::alloc($bufsize);
		#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:258: lines 258-272
		try {
			#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:259: lines 259-271
			while (true) {
				#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:260: characters 5-44
				$len = $i->readBytes($buf, 0, $bufsize);
				#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:261: lines 261-262
				if ($len === 0) {
					#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:262: characters 6-11
					throw Exception::thrown(Error::Blocked());
				}
				#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:263: characters 5-15
				$p = 0;
				#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:264: lines 264-270
				while ($len > 0) {
					#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:265: characters 6-38
					$k = $this->writeBytes($buf, $p, $len);
					#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:266: lines 266-267
					if ($k === 0) {
						#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:267: characters 7-12
						throw Exception::thrown(Error::Blocked());
					}
					#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:268: characters 6-12
					$p += $k;
					#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:269: characters 6-14
					$len -= $k;
				}
			}
		} catch(\Throwable $_g) {
			#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:272: characters 12-13
			NativeStackTrace::saveStack($_g);
			#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:258: lines 258-272
			if (!(Exception::caught($_g)->unwrap() instanceof Eof)) {
				throw $_g;
			}
		}
	}

	/**
	 * Write `x` as 16-bit signed integer.
	 * Endianness is specified by the `bigEndian` property.
	 * 
	 * @param int $x
	 * 
	 * @return void
	 */
	public function writeInt16 ($x) {
		#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:168: lines 168-169
		if (($x < -32768) || ($x >= 32768)) {
			#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:169: characters 4-9
			throw Exception::thrown(Error::Overflow());
		}
		#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:170: characters 3-26
		$this->writeUInt16($x & 65535);
	}

	/**
	 * Write `x` as 24-bit signed integer.
	 * Endianness is specified by the `bigEndian` property.
	 * 
	 * @param int $x
	 * 
	 * @return void
	 */
	public function writeInt24 ($x) {
		#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:196: lines 196-197
		if (($x < -8388608) || ($x >= 8388608)) {
			#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:197: characters 4-9
			throw Exception::thrown(Error::Overflow());
		}
		#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:198: characters 3-28
		$this->writeUInt24($x & 16777215);
	}

	/**
	 * Write `x` as 32-bit signed integer.
	 * Endianness is specified by the `bigEndian` property.
	 * 
	 * @param int $x
	 * 
	 * @return void
	 */
	public function writeInt32 ($x) {
		#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:226: lines 226-236
		if ($this->bigEndian) {
			#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:227: characters 4-23
			$this->writeByte(Boot::shiftRightUnsigned($x, 24));
			#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:228: characters 4-31
			$this->writeByte(($x >> 16) & 255);
			#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:229: characters 4-30
			$this->writeByte(($x >> 8) & 255);
			#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:230: characters 4-23
			$this->writeByte($x & 255);
		} else {
			#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:232: characters 4-23
			$this->writeByte($x & 255);
			#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:233: characters 4-30
			$this->writeByte(($x >> 8) & 255);
			#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:234: characters 4-31
			$this->writeByte(($x >> 16) & 255);
			#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:235: characters 4-23
			$this->writeByte(Boot::shiftRightUnsigned($x, 24));
		}
	}

	/**
	 * Write `x` as 8-bit signed integer.
	 * 
	 * @param int $x
	 * 
	 * @return void
	 */
	public function writeInt8 ($x) {
		#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:157: lines 157-158
		if (($x < -128) || ($x >= 128)) {
			#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:158: characters 4-9
			throw Exception::thrown(Error::Overflow());
		}
		#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:159: characters 3-22
		$this->writeByte($x & 255);
	}

	/**
	 * Write `s` string.
	 * 
	 * @param string $s
	 * @param Encoding $encoding
	 * 
	 * @return void
	 */
	public function writeString ($s, $encoding = null) {
		#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:282: characters 11-38
		$b = \strlen($s);
		#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:282: characters 3-39
		$b1 = new Bytes($b, new Container($s));
		#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:284: characters 3-33
		$this->writeFullBytes($b1, 0, $b1->length);
	}

	/**
	 * Write `x` as 16-bit unsigned integer.
	 * Endianness is specified by the `bigEndian` property.
	 * 
	 * @param int $x
	 * 
	 * @return void
	 */
	public function writeUInt16 ($x) {
		#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:179: lines 179-180
		if (($x < 0) || ($x >= 65536)) {
			#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:180: characters 4-9
			throw Exception::thrown(Error::Overflow());
		}
		#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:181: lines 181-187
		if ($this->bigEndian) {
			#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:182: characters 4-21
			$this->writeByte($x >> 8);
			#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:183: characters 4-23
			$this->writeByte($x & 255);
		} else {
			#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:185: characters 4-23
			$this->writeByte($x & 255);
			#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:186: characters 4-21
			$this->writeByte($x >> 8);
		}
	}

	/**
	 * Write `x` as 24-bit unsigned integer.
	 * Endianness is specified by the `bigEndian` property.
	 * 
	 * @param int $x
	 * 
	 * @return void
	 */
	public function writeUInt24 ($x) {
		#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:207: lines 207-208
		if (($x < 0) || ($x >= 16777216)) {
			#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:208: characters 4-9
			throw Exception::thrown(Error::Overflow());
		}
		#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:209: lines 209-217
		if ($this->bigEndian) {
			#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:210: characters 4-22
			$this->writeByte($x >> 16);
			#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:211: characters 4-30
			$this->writeByte(($x >> 8) & 255);
			#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:212: characters 4-23
			$this->writeByte($x & 255);
		} else {
			#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:214: characters 4-23
			$this->writeByte($x & 255);
			#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:215: characters 4-30
			$this->writeByte(($x >> 8) & 255);
			#/home/runner/haxe/versions/4.2.2/std/haxe/io/Output.hx:216: characters 4-22
			$this->writeByte($x >> 16);
		}
	}
}

class _HxAnon_Output0 extends HxAnon {
	function __construct($fileName, $lineNumber, $className, $methodName) {
		$this->fileName = $fileName;
		$this->lineNumber = $lineNumber;
		$this->className = $className;
		$this->methodName = $methodName;
	}
}

Boot::registerClass(Output::class, 'haxe.io.Output');
Boot::registerSetters('helder\\std\\haxe\\io\\Output', [
	'bigEndian' => true
]);
