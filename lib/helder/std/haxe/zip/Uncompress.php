<?php
/**
 * Generated by Haxe 4.0.3
 */

namespace helder\std\haxe\zip;

use \helder\std\php\_Boot\HxAnon;
use \helder\std\haxe\io\_BytesData\Container;
use \helder\std\php\Boot;
use \helder\std\haxe\io\Error;
use \helder\std\php\_Boot\HxException;
use \helder\std\haxe\io\Bytes;

class Uncompress {
	/**
	 * @param Bytes $src
	 * @param int $bufsize
	 * 
	 * @return Bytes
	 */
	public static function run ($src, $bufsize = null) {
		#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/zip/Uncompress.hx:45: characters 3-51
		$c = gzuncompress($src->toString());
		#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/zip/Uncompress.hx:46: characters 10-35
		$tmp = strlen($c);
		#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/zip/Uncompress.hx:46: characters 3-35
		return new Bytes($tmp, new Container($c));
	}

	/**
	 * @param int $windowBits
	 * 
	 * @return void
	 */
	public function __construct ($windowBits = null) {
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
		#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/zip/Uncompress.hx:29: characters 15-51
		$len = $src->length - $srcPos;
		#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/zip/Uncompress.hx:29: characters 3-52
		$input = null;
		#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/zip/Uncompress.hx:29: characters 15-51
		if (($srcPos < 0) || ($len < 0) || (($srcPos + $len) > $src->length)) {
			throw new HxException(Error::OutsideBounds());
		} else {
			#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/zip/Uncompress.hx:29: characters 3-52
			$input = new Bytes($len, new Container(substr($src->b->s, $srcPos, $len)));
		}
		#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/zip/Uncompress.hx:30: characters 3-25
		$data = Uncompress::run($input);
		#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/zip/Uncompress.hx:31: characters 3-41
		$len1 = $data->length;
		if (($dstPos < 0) || ($len1 < 0) || (($dstPos + $len1) > $dst->length) || ($len1 > $data->length)) {
			throw new HxException(Error::OutsideBounds());
		} else {
			$this1 = $dst->b;
			$src1 = $data->b;
			$this1->s = ((substr($this1->s, 0, $dstPos) . substr($src1->s, 0, $len1)) . substr($this1->s, $dstPos + $len1));
		}

		#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/zip/Uncompress.hx:33: lines 33-37
		return new HxAnon([
			"done" => true,
			"read" => $input->length,
			"write" => $data->length,
		]);
	}

	/**
	 * @param FlushMode $f
	 * 
	 * @return void
	 */
	public function setFlushMode ($f) {
	}
}

Boot::registerClass(Uncompress::class, 'haxe.zip.Uncompress');
