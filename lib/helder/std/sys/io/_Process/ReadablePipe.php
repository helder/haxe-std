<?php
/**
 */

namespace helder\std\sys\io\_Process;

use \helder\std\haxe\io\_BytesData\Container;
use \helder\std\php\Boot;
use \helder\std\haxe\Exception;
use \helder\std\haxe\io\Eof;
use \helder\std\haxe\io\Error;
use \helder\std\haxe\io\Input;
use \helder\std\haxe\io\Bytes;

class ReadablePipe extends Input {
	/**
	 * @var mixed
	 */
	public $pipe;
	/**
	 * @var Bytes
	 */
	public $tmpBytes;

	/**
	 * @param mixed $pipe
	 * 
	 * @return void
	 */
	public function __construct ($pipe) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:53: characters 3-19
		$this->pipe = $pipe;
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:54: characters 3-28
		$this->tmpBytes = Bytes::alloc(1);
	}

	/**
	 * @return void
	 */
	public function close () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:58: characters 3-16
		\fclose($this->pipe);
	}

	/**
	 * @return int
	 */
	public function readByte () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:62: lines 62-63
		if ($this->readBytes($this->tmpBytes, 0, 1) === 0) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:63: characters 4-9
			throw Exception::thrown(Error::Blocked());
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:64: characters 10-25
		return \ord($this->tmpBytes->b->s[0]);
	}

	/**
	 * @param Bytes $s
	 * @param int $pos
	 * @param int $len
	 * 
	 * @return int
	 */
	public function readBytes ($s, $pos, $len) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:68: lines 68-69
		if (\feof($this->pipe)) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:69: characters 4-9
			throw Exception::thrown(new Eof());
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:71: characters 3-32
		$result = \fread($this->pipe, $len);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:72: lines 72-73
		if ($result === "") {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:73: characters 4-9
			throw Exception::thrown(new Eof());
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:74: lines 74-75
		if ($result === false) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:75: characters 11-16
			throw Exception::thrown(Error::Custom("Failed to read process output"));
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:76: characters 3-30
		$result1 = $result;
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:78: characters 15-37
		$bytes = \strlen($result1);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:78: characters 3-38
		$bytes1 = new Bytes($bytes, new Container($result1));
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:79: characters 3-41
		$len = \strlen($result1);
		if (($pos < 0) || ($len < 0) || (($pos + $len) > $s->length) || ($len > $bytes1->length)) {
			throw Exception::thrown(Error::OutsideBounds());
		} else {
			$this1 = $s->b;
			$src = $bytes1->b;
			$this1->s = ((\substr($this1->s, 0, $pos) . \substr($src->s, 0, $len)) . \substr($this1->s, $pos + $len));
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:80: characters 3-25
		return \strlen($result1);
	}
}

Boot::registerClass(ReadablePipe::class, 'sys.io._Process.ReadablePipe');
