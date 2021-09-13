<?php
/**
 */

namespace helder\std\haxe\zip;

use \helder\std\haxe\io\_BytesData\Container;
use \helder\std\php\Boot;
use \helder\std\haxe\Exception;
use \helder\std\haxe\io\Error;
use \helder\std\haxe\io\Bytes;

class Tools {
	/**
	 * @param object $f
	 * @param int $level
	 * 
	 * @return void
	 */
	public static function compress ($f, $level) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Tools.hx:27: lines 27-28
		if ($f->compressed) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Tools.hx:28: characters 4-10
			return;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Tools.hx:32: characters 3-51
		$data = Compress::run($f->data, $level);
		#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Tools.hx:33: characters 3-22
		$f->compressed = true;
		#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Tools.hx:34: characters 12-40
		$len = $data->length - 6;
		$tmp = null;
		if (($len < 0) || ((2 + $len) > $data->length)) {
			throw Exception::thrown(Error::OutsideBounds());
		} else {
			$tmp = new Bytes($len, new Container(\substr($data->b->s, 2, $len)));
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Tools.hx:34: characters 3-40
		$f->data = $tmp;
		#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Tools.hx:35: characters 3-29
		$f->dataSize = $f->data->length;
	}

	/**
	 * @param object $f
	 * 
	 * @return void
	 */
	public static function uncompress ($f) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Tools.hx:39: lines 39-40
		if (!$f->compressed) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Tools.hx:40: characters 4-10
			return;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Tools.hx:42: characters 3-31
		$c = new Uncompress(-15);
		#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Tools.hx:43: characters 3-43
		$s = Bytes::alloc($f->fileSize);
		#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Tools.hx:44: characters 3-35
		$r = $c->execute($f->data, 0, $s, 0);
		#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Tools.hx:45: characters 3-12
		$c->close();
		#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Tools.hx:46: lines 46-47
		if (!$r->done || ($r->read !== $f->data->length) || ($r->write !== $f->fileSize)) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Tools.hx:47: characters 4-9
			throw Exception::thrown("Invalid compressed data for " . ($f->fileName??'null'));
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Tools.hx:48: characters 3-23
		$f->compressed = false;
		#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Tools.hx:49: characters 3-26
		$f->dataSize = $f->fileSize;
		#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Tools.hx:50: characters 3-13
		$f->data = $s;
	}
}

Boot::registerClass(Tools::class, 'haxe.zip.Tools');
