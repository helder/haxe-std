<?php
/**
 * Generated by Haxe 4.0.5
 */

namespace helder\std\haxe\zip;

use \helder\std\php\_Boot\HxAnon;
use \helder\std\php\Boot;
use \helder\std\haxe\io\BytesBuffer;
use \helder\std\haxe\io\Error;
use \helder\std\haxe\io\Input;
use \helder\std\Date;
use \helder\std\haxe\ds\List_hx;
use \helder\std\php\_Boot\HxException;
use \helder\std\haxe\io\Bytes;

class Reader {
	/**
	 * @var Input
	 */
	public $i;

	/**
	 * @param Input $i
	 * 
	 * @return List_hx
	 */
	public static function readZip ($i) {
		#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:195: characters 3-25
		$r = new Reader($i);
		#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:196: characters 3-18
		return $r->read();
	}

	/**
	 * @param object $f
	 * 
	 * @return Bytes
	 */
	public static function unzip ($f) {
		#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:200: lines 200-201
		if (!$f->compressed) {
			#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:201: characters 4-17
			return $f->data;
		}
		#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:202: characters 3-40
		$c = new Uncompress(-15);
		#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:203: characters 3-43
		$s = Bytes::alloc($f->fileSize);
		#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:204: characters 3-38
		$r = $c->execute($f->data, 0, $s, 0);
		#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:205: characters 3-12
		$c->close();
		#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:206: lines 206-207
		if (!$r->done || ($r->read !== $f->data->length) || ($r->write !== $f->fileSize)) {
			#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:207: characters 4-9
			throw new HxException("Invalid compressed data for " . ($f->fileName??'null'));
		}
		#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:208: characters 3-23
		$f->compressed = false;
		#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:209: characters 3-26
		$f->dataSize = $f->fileSize;
		#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:210: characters 3-13
		$f->data = $s;
		#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:211: characters 3-16
		return $f->data;
	}

	/**
	 * @param Input $i
	 * 
	 * @return void
	 */
	public function __construct ($i) {
		#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:33: characters 3-13
		$this->i = $i;
	}

	/**
	 * @return List_hx
	 */
	public function read () {
		#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:122: characters 3-22
		$l = new List_hx();
		#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:123: characters 3-18
		$buf = null;
		#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:124: characters 3-18
		$tmp = null;
		#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:125: lines 125-190
		while (true) {
			#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:126: characters 4-30
			$e = $this->readEntryHeader();
			#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:127: lines 127-128
			if ($e === null) {
				#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:128: characters 5-10
				break;
			}
			#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:130: lines 130-188
			if ($e->crc32 === null) {
				#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:131: lines 131-178
				if ($e->compressed) {
					#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:164: characters 6-26
					$bufSize = 65536;
					#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:165: lines 165-166
					if ($tmp === null) {
						#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:166: characters 7-10
						$tmp = Bytes::alloc($bufSize);
					}
					#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:167: characters 6-42
					$out = new BytesBuffer();
					#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:168: characters 6-47
					$z = new InflateImpl($this->i, false, false);
					#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:169: lines 169-174
					while (true) {
						#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:170: characters 7-44
						$n = $z->readBytes($tmp, 0, $bufSize);
						#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:171: characters 7-30
						if (($n < 0) || ($n > $tmp->length)) {
							throw new HxException(Error::OutsideBounds());
						} else {
							$left = $out->b;
							$this_s = substr($tmp->b->s, 0, $n);
							$out->b = ($left . $this_s);
						}
						#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:172: lines 172-173
						if ($n < $bufSize) {
							#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:173: characters 8-13
							break;
						}
					}
					#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:175: characters 6-12
					$e->data = $out->getBytes();
				} else {
					#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:178: characters 6-12
					$e->data = $this->i->read($e->dataSize);
				}
				#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:179: characters 5-12
				$e->crc32 = $this->i->readInt32();
				#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:180: lines 180-181
				if ($e->crc32 === 134695760) {
					#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:181: characters 6-13
					$e->crc32 = $this->i->readInt32();
				}
				#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:182: characters 5-15
				$e->dataSize = $this->i->readInt32();
				#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:183: characters 5-15
				$e->fileSize = $this->i->readInt32();
				#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:185: characters 5-15
				$e->dataSize = $e->fileSize;
				#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:186: characters 5-17
				$e->compressed = false;
			} else {
				#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:188: characters 5-11
				$e->data = $this->i->read($e->dataSize);
			}
			#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:189: characters 4-12
			$l->add($e);
		}
		#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:191: characters 3-11
		return $l;
	}

	/**
	 * @return object
	 */
	public function readEntryHeader () {
		#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:79: characters 3-18
		$i = $this->i;
		#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:80: characters 3-25
		$h = $i->readInt32();
		#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:81: lines 81-82
		if (($h === 33639248) || ($h === 101010256)) {
			#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:82: characters 4-15
			return null;
		}
		#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:83: lines 83-84
		if ($h !== 67324752) {
			#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:84: characters 4-9
			throw new HxException("Invalid Zip Data");
		}
		#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:85: characters 3-32
		$version = $i->readUInt16();
		#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:86: characters 3-30
		$flags = $i->readUInt16();
		#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:87: characters 3-33
		$utf8 = ($flags & 2048) !== 0;
		#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:88: lines 88-89
		if (($flags & 63473) !== 0) {
			#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:89: characters 4-9
			throw new HxException("Unsupported flags " . ($flags??'null'));
		}
		#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:90: characters 3-36
		$compression = $i->readUInt16();
		#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:91: characters 3-39
		$compressed = $compression !== 0;
		#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:92: lines 92-93
		if ($compressed && ($compression !== 8)) {
			#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:93: characters 4-9
			throw new HxException("Unsupported compression " . ($compression??'null'));
		}
		#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:94: characters 3-29
		$mtime = $this->readZipDate();
		#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:95: characters 3-39
		$crc32 = $i->readInt32();
		#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:96: characters 3-29
		$csize = $i->readInt32();
		#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:97: characters 3-29
		$usize = $i->readInt32();
		#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:98: characters 3-32
		$fnamelen = $i->readInt16();
		#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:99: characters 3-28
		$elen = $i->readInt16();
		#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:100: characters 3-38
		$fname = $i->readString($fnamelen);
		#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:101: characters 3-38
		$fields = $this->readExtraFields($elen);
		#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:102: lines 102-103
		if ($utf8) {
			#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:103: characters 4-22
			$fields->push(ExtraField::FUtf8());
		}
		#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:104: characters 3-19
		$data = null;
		#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:107: lines 107-108
		if (($flags & 8) !== 0) {
			#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:108: characters 4-16
			$crc32 = null;
		}
		#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:109: lines 109-118
		return new HxAnon([
			"fileName" => $fname,
			"fileSize" => $usize,
			"fileTime" => $mtime,
			"compressed" => $compressed,
			"dataSize" => $csize,
			"data" => $data,
			"crc32" => $crc32,
			"extraFields" => $fields,
		]);
	}

	/**
	 * @param int $length
	 * 
	 * @return List_hx
	 */
	public function readExtraFields ($length) {
		#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:49: characters 3-27
		$fields = new List_hx();
		#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:50: lines 50-74
		while ($length > 0) {
			#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:51: lines 51-52
			if ($length < 4) {
				#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:52: characters 5-10
				throw new HxException("Invalid extra fields data");
			}
			#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:53: characters 4-29
			$tag = $this->i->readUInt16();
			#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:54: characters 4-29
			$len = $this->i->readUInt16();
			#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:55: lines 55-56
			if ($length < $len) {
				#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:56: characters 5-10
				throw new HxException("Invalid extra fields data");
			}
			#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:57: lines 57-72
			if ($tag === 28789) {
				#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:59: characters 6-33
				$version = $this->i->readByte();
				#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:60: lines 60-69
				if ($version !== 1) {
					#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:61: characters 7-44
					$data = new BytesBuffer();
					#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:62: characters 7-28
					$data->b = ($data->b . chr($version));
					#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:63: characters 7-32
					$src = $this->i->read($len - 1);
					$data->b = ($data->b . $src->b->s);

					#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:64: characters 7-49
					$fields->add(ExtraField::FUnknown($tag, $data->getBytes()));
				} else {
					#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:66: characters 7-31
					$crc = $this->i->readInt32();
					#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:67: characters 7-45
					$name = $this->i->read($len - 5)->toString();
					#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:68: characters 7-49
					$fields->add(ExtraField::FInfoZipUnicodePath($name, $crc));
				}
			} else {
				#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:71: characters 6-44
				$fields->add(ExtraField::FUnknown($tag, $this->i->read($len)));
			}
			#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:73: characters 4-21
			$length -= 4 + $len;
		}
		#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:75: characters 3-16
		return $fields;
	}

	/**
	 * @return Date
	 */
	public function readZipDate () {
		#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:37: characters 3-26
		$t = $this->i->readUInt16();
		#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:38: characters 3-29
		$hour = ($t >> 11) & 31;
		#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:39: characters 3-27
		$min = ($t >> 5) & 63;
		#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:40: characters 3-20
		$sec = $t & 31;
		#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:41: characters 3-26
		$d = $this->i->readUInt16();
		#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:42: characters 3-21
		$year = $d >> 9;
		#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:43: characters 3-29
		$month = ($d >> 5) & 15;
		#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:44: characters 3-20
		$day = $d & 31;
		#/home/runner/haxe/versions/4.0.5/std/haxe/zip/Reader.hx:45: characters 3-68
		return new Date($year + 1980, $month - 1, $day, $hour, $min, $sec << 1);
	}
}

Boot::registerClass(Reader::class, 'haxe.zip.Reader');
