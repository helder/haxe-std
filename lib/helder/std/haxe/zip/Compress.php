<?php
/**
 */

namespace helder\std\haxe\zip;

use \helder\std\php\_Boot\HxAnon;
use \helder\std\haxe\io\_BytesData\Container;
use \helder\std\php\Boot;
use \helder\std\haxe\Exception;
use \helder\std\haxe\io\Error;
use \helder\std\haxe\io\Bytes;

class Compress {
	/**
	 * @var int
	 */
	public $level;

	/**
	 * @param Bytes $s
	 * @param int $level
	 * 
	 * @return Bytes
	 */
	public static function run ($s, $level) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/zip/Compress.hx:50: characters 3-54
		$c = \gzcompress($s->toString(), $level);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/zip/Compress.hx:51: characters 10-35
		$tmp = \strlen($c);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/zip/Compress.hx:51: characters 3-35
		return new Bytes($tmp, new Container($c));
	}

	/**
	 * @param int $level
	 * 
	 * @return void
	 */
	public function __construct ($level) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/zip/Compress.hx:30: characters 3-21
		$this->level = $level;
	}

	/**
	 * @return void
	 */
	public function close () {
	}

	/**
	 * @param Bytes $src
	 * @param int $srcPos
	 * @param Bytes $dst
	 * @param int $dstPos
	 * 
	 * @return object
	 */
	public function execute ($src, $srcPos, $dst, $dstPos) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/zip/Compress.hx:34: characters 15-51
		$len = $src->length - $srcPos;
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/zip/Compress.hx:34: characters 3-52
		$input = null;
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/zip/Compress.hx:34: characters 15-51
		if (($srcPos < 0) || ($len < 0) || (($srcPos + $len) > $src->length)) {
			throw Exception::thrown(Error::OutsideBounds());
		} else {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/zip/Compress.hx:34: characters 3-52
			$input = new Bytes($len, new Container(\substr($src->b->s, $srcPos, $len)));
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/zip/Compress.hx:35: characters 3-32
		$data = Compress::run($input, $this->level);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/zip/Compress.hx:36: characters 3-41
		$len = $data->length;
		if (($dstPos < 0) || ($len < 0) || (($dstPos + $len) > $dst->length) || ($len > $data->length)) {
			throw Exception::thrown(Error::OutsideBounds());
		} else {
			$this1 = $dst->b;
			$src = $data->b;
			$this1->s = ((\substr($this1->s, 0, $dstPos) . \substr($src->s, 0, $len)) . \substr($this1->s, $dstPos + $len));
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/zip/Compress.hx:38: lines 38-42
		return new _HxAnon_Compress0(true, $input->length, $data->length);
	}

	/**
	 * @param FlushMode $f
	 * 
	 * @return void
	 */
	public function setFlushMode ($f) {
	}
}

class _HxAnon_Compress0 extends HxAnon {
	function __construct($done, $read, $write) {
		$this->done = $done;
		$this->read = $read;
		$this->write = $write;
	}
}

Boot::registerClass(Compress::class, 'haxe.zip.Compress');
