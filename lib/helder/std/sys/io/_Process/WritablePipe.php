<?php
/**
 * Generated by Haxe 4.2.2
 */

namespace helder\std\sys\io\_Process;

use \helder\std\php\Boot;
use \helder\std\haxe\Exception;
use \helder\std\haxe\io\Output;
use \helder\std\haxe\io\Eof;
use \helder\std\haxe\io\Error;
use \helder\std\haxe\io\Bytes;

class WritablePipe extends Output {
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
		#/home/runner/haxe/versions/4.2.2/std/php/_std/sys/io/Process.hx:89: characters 3-19
		$this->pipe = $pipe;
		#/home/runner/haxe/versions/4.2.2/std/php/_std/sys/io/Process.hx:90: characters 3-28
		$this->tmpBytes = Bytes::alloc(1);
	}

	/**
	 * @return void
	 */
	public function close () {
		#/home/runner/haxe/versions/4.2.2/std/php/_std/sys/io/Process.hx:94: characters 3-16
		\fclose($this->pipe);
	}

	/**
	 * @param int $c
	 * 
	 * @return void
	 */
	public function writeByte ($c) {
		#/home/runner/haxe/versions/4.2.2/std/php/_std/sys/io/Process.hx:98: characters 3-21
		$this->tmpBytes->b->s[0] = \chr($c);
		#/home/runner/haxe/versions/4.2.2/std/php/_std/sys/io/Process.hx:99: characters 3-29
		$this->writeBytes($this->tmpBytes, 0, 1);
	}

	/**
	 * @param Bytes $b
	 * @param int $pos
	 * @param int $l
	 * 
	 * @return int
	 */
	public function writeBytes ($b, $pos, $l) {
		#/home/runner/haxe/versions/4.2.2/std/php/_std/sys/io/Process.hx:103: characters 3-31
		$s = null;
		#/home/runner/haxe/versions/4.2.2/std/php/_std/sys/io/Process.hx:103: characters 11-30
		if (($pos < 0) || ($l < 0) || (($pos + $l) > $b->length)) {
			throw Exception::thrown(Error::OutsideBounds());
		} else {
			#/home/runner/haxe/versions/4.2.2/std/php/_std/sys/io/Process.hx:103: characters 3-31
			$s = \substr($b->b->s, $pos, $l);
		}
		#/home/runner/haxe/versions/4.2.2/std/php/_std/sys/io/Process.hx:104: lines 104-105
		if (\feof($this->pipe)) {
			#/home/runner/haxe/versions/4.2.2/std/php/_std/sys/io/Process.hx:105: characters 4-9
			throw Exception::thrown(new Eof());
		}
		#/home/runner/haxe/versions/4.2.2/std/php/_std/sys/io/Process.hx:107: characters 3-42
		$result = \fwrite($this->pipe, $s, $l);
		#/home/runner/haxe/versions/4.2.2/std/php/_std/sys/io/Process.hx:108: lines 108-109
		if ($result === false) {
			#/home/runner/haxe/versions/4.2.2/std/php/_std/sys/io/Process.hx:109: characters 4-9
			throw Exception::thrown(Error::Custom("Failed to write to process input"));
		}
		#/home/runner/haxe/versions/4.2.2/std/php/_std/sys/io/Process.hx:110: characters 3-16
		return $result;
	}
}

Boot::registerClass(WritablePipe::class, 'sys.io._Process.WritablePipe');
