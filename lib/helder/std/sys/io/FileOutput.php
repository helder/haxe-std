<?php
/**
 */

namespace helder\std\sys\io;

use \helder\std\php\Boot;
use \helder\std\haxe\Exception;
use \helder\std\haxe\io\Output;
use \helder\std\haxe\io\Eof;
use \helder\std\haxe\io\Error;
use \helder\std\haxe\io\Bytes;

/**
 * Use `sys.io.File.write` to create a `FileOutput`.
 */
class FileOutput extends Output {
	/**
	 * @var mixed
	 */
	public $__f;

	/**
	 * @param mixed $f
	 * 
	 * @return void
	 */
	public function __construct ($f) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/FileOutput.hx:34: characters 3-10
		$this->__f = $f;
	}

	/**
	 * @return void
	 */
	public function close () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/FileOutput.hx:60: characters 3-16
		parent::close();
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/FileOutput.hx:61: lines 61-62
		if ($this->__f !== null) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/FileOutput.hx:62: characters 4-15
			\fclose($this->__f);
		}
	}

	/**
	 * @return void
	 */
	public function flush () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/FileOutput.hx:54: characters 3-23
		$r = \fflush($this->__f);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/FileOutput.hx:55: lines 55-56
		if ($r === false) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/FileOutput.hx:56: characters 4-9
			throw Exception::thrown(Error::Custom("An error occurred"));
		}
	}

	/**
	 * @param int $p
	 * @param FileSeek $pos
	 * 
	 * @return void
	 */
	public function seek ($p, $pos) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/FileOutput.hx:66: characters 3-9
		$w = null;
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/FileOutput.hx:67: lines 67-74
		$__hx__switch = ($pos->index);
		if ($__hx__switch === 0) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/FileOutput.hx:69: characters 5-17
			$w = \SEEK_SET;
		} else if ($__hx__switch === 1) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/FileOutput.hx:71: characters 5-17
			$w = \SEEK_CUR;
		} else if ($__hx__switch === 2) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/FileOutput.hx:73: characters 5-17
			$w = \SEEK_END;
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/FileOutput.hx:75: characters 3-28
		$r = \fseek($this->__f, $p, $w);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/FileOutput.hx:76: lines 76-77
		if ($r === -1) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/FileOutput.hx:77: characters 4-9
			throw Exception::thrown(Error::Custom("An error occurred"));
		}
	}

	/**
	 * @return int
	 */
	public function tell () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/FileOutput.hx:81: characters 3-22
		$r = \ftell($this->__f);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/FileOutput.hx:82: lines 82-83
		if ($r === false) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/FileOutput.hx:83: characters 4-9
			throw Exception::thrown(Error::Custom("An error occurred"));
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/FileOutput.hx:84: characters 3-11
		return $r;
	}

	/**
	 * @param int $c
	 * 
	 * @return void
	 */
	public function writeByte ($c) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/FileOutput.hx:38: characters 3-31
		$r = \fwrite($this->__f, \chr($c));
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/FileOutput.hx:39: lines 39-40
		if ($r === false) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/FileOutput.hx:40: characters 4-9
			throw Exception::thrown(Error::Custom("An error occurred"));
		}
	}

	/**
	 * @param Bytes $b
	 * @param int $p
	 * @param int $l
	 * 
	 * @return int
	 */
	public function writeBytes ($b, $p, $l) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/FileOutput.hx:44: characters 3-29
		$s = null;
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/FileOutput.hx:44: characters 11-28
		if (($p < 0) || ($l < 0) || (($p + $l) > $b->length)) {
			throw Exception::thrown(Error::OutsideBounds());
		} else {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/FileOutput.hx:44: characters 3-29
			$s = \substr($b->b->s, $p, $l);
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/FileOutput.hx:45: lines 45-46
		if (\feof($this->__f)) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/FileOutput.hx:46: characters 4-9
			throw Exception::thrown(new Eof());
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/FileOutput.hx:47: characters 3-29
		$r = \fwrite($this->__f, $s, $l);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/FileOutput.hx:48: lines 48-49
		if ($r === false) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/FileOutput.hx:49: characters 4-9
			throw Exception::thrown(Error::Custom("An error occurred"));
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/FileOutput.hx:50: characters 3-11
		return $r;
	}
}

Boot::registerClass(FileOutput::class, 'sys.io.FileOutput');
