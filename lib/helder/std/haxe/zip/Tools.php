<?php
/**
 * Generated by Haxe 4.0.3
 */

namespace helder\std\haxe\zip;

use \helder\std\haxe\io\_BytesData\Container;
use \helder\std\php\Boot;
use \helder\std\haxe\io\Error;
use \helder\std\php\_Boot\HxException;
use \helder\std\haxe\io\Bytes;

class Tools {
	/**
	 * @param object $f
	 * @param int $level
	 * 
	 * @return void
	 */
	public static function compress ($f, $level) {
		#/home/runner/haxe/versions/4.0.3/std/haxe/zip/Tools.hx:27: lines 27-28
		if ($f->compressed) {
			#/home/runner/haxe/versions/4.0.3/std/haxe/zip/Tools.hx:28: characters 4-10
			return;
		}
		#/home/runner/haxe/versions/4.0.3/std/haxe/zip/Tools.hx:32: characters 3-51
		$data = Compress::run($f->data, $level);
		#/home/runner/haxe/versions/4.0.3/std/haxe/zip/Tools.hx:33: characters 3-22
		$f->compressed = true;
		#/home/runner/haxe/versions/4.0.3/std/haxe/zip/Tools.hx:34: characters 12-40
		$len = $data->length - 6;
		$tmp = null;
		if (($len < 0) || ((2 + $len) > $data->length)) {
			throw new HxException(Error::OutsideBounds());
		} else {
			$tmp = new Bytes($len, new Container(substr($data->b->s, 2, $len)));
		}
		#/home/runner/haxe/versions/4.0.3/std/haxe/zip/Tools.hx:34: characters 3-40
		$f->data = $tmp;
		#/home/runner/haxe/versions/4.0.3/std/haxe/zip/Tools.hx:35: characters 3-29
		$f->dataSize = $f->data->length;
	}
}

Boot::registerClass(Tools::class, 'haxe.zip.Tools');
