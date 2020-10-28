<?php
/**
 * Generated by Haxe 4.1.4
 */

namespace helder\std\haxe\ds\_Vector;

use \helder\std\php\Boot;
use \helder\std\Array_hx;
use \helder\std\Std;

final class Vector_Impl_ {

	/**
	 * @param int $length
	 * 
	 * @return PhpVectorData
	 */
	public static function _new ($length) {
		#/home/runner/haxe/versions/4.1.4/std/php/_std/haxe/ds/Vector.hx:42: character 2
		$this1 = new PhpVectorData($length);
		return $this1;
	}

	/**
	 * @param PhpVectorData $src
	 * @param int $srcPos
	 * @param PhpVectorData $dest
	 * @param int $destPos
	 * @param int $len
	 * 
	 * @return void
	 */
	public static function blit ($src, $srcPos, $dest, $destPos, $len) {
		#/home/runner/haxe/versions/4.1.4/std/php/_std/haxe/ds/Vector.hx:59: lines 59-81
		if ($src === $dest) {
			#/home/runner/haxe/versions/4.1.4/std/php/_std/haxe/ds/Vector.hx:60: lines 60-76
			if ($srcPos < $destPos) {
				#/home/runner/haxe/versions/4.1.4/std/php/_std/haxe/ds/Vector.hx:61: characters 5-26
				$i = $srcPos + $len;
				#/home/runner/haxe/versions/4.1.4/std/php/_std/haxe/ds/Vector.hx:62: characters 5-27
				$j = $destPos + $len;
				#/home/runner/haxe/versions/4.1.4/std/php/_std/haxe/ds/Vector.hx:63: characters 15-19
				$_g = 0;
				#/home/runner/haxe/versions/4.1.4/std/php/_std/haxe/ds/Vector.hx:63: characters 19-22
				$_g1 = $len;
				#/home/runner/haxe/versions/4.1.4/std/php/_std/haxe/ds/Vector.hx:63: lines 63-67
				while ($_g < $_g1) {
					#/home/runner/haxe/versions/4.1.4/std/php/_std/haxe/ds/Vector.hx:63: characters 15-22
					$k = $_g++;
					#/home/runner/haxe/versions/4.1.4/std/php/_std/haxe/ds/Vector.hx:64: characters 6-9
					--$i;
					#/home/runner/haxe/versions/4.1.4/std/php/_std/haxe/ds/Vector.hx:65: characters 6-9
					--$j;
					#/home/runner/haxe/versions/4.1.4/std/php/_std/haxe/ds/Vector.hx:66: characters 6-21
					$val = ($src->data[$i] ?? null);
					$src->data[$j] = $val;
				}
			} else if ($srcPos > $destPos) {
				#/home/runner/haxe/versions/4.1.4/std/php/_std/haxe/ds/Vector.hx:69: characters 5-20
				$i = $srcPos;
				#/home/runner/haxe/versions/4.1.4/std/php/_std/haxe/ds/Vector.hx:70: characters 5-21
				$j = $destPos;
				#/home/runner/haxe/versions/4.1.4/std/php/_std/haxe/ds/Vector.hx:71: characters 15-19
				$_g = 0;
				#/home/runner/haxe/versions/4.1.4/std/php/_std/haxe/ds/Vector.hx:71: characters 19-22
				$_g1 = $len;
				#/home/runner/haxe/versions/4.1.4/std/php/_std/haxe/ds/Vector.hx:71: lines 71-75
				while ($_g < $_g1) {
					#/home/runner/haxe/versions/4.1.4/std/php/_std/haxe/ds/Vector.hx:71: characters 15-22
					$k = $_g++;
					#/home/runner/haxe/versions/4.1.4/std/php/_std/haxe/ds/Vector.hx:72: characters 6-21
					$val = ($src->data[$i] ?? null);
					$src->data[$j] = $val;
					#/home/runner/haxe/versions/4.1.4/std/php/_std/haxe/ds/Vector.hx:73: characters 6-9
					++$i;
					#/home/runner/haxe/versions/4.1.4/std/php/_std/haxe/ds/Vector.hx:74: characters 6-9
					++$j;
				}
			}
		} else {
			#/home/runner/haxe/versions/4.1.4/std/php/_std/haxe/ds/Vector.hx:78: characters 14-18
			$_g = 0;
			#/home/runner/haxe/versions/4.1.4/std/php/_std/haxe/ds/Vector.hx:78: characters 18-21
			$_g1 = $len;
			#/home/runner/haxe/versions/4.1.4/std/php/_std/haxe/ds/Vector.hx:78: lines 78-80
			while ($_g < $_g1) {
				#/home/runner/haxe/versions/4.1.4/std/php/_std/haxe/ds/Vector.hx:78: characters 14-21
				$i = $_g++;
				#/home/runner/haxe/versions/4.1.4/std/php/_std/haxe/ds/Vector.hx:79: characters 5-40
				$val = ($src->data[$srcPos + $i] ?? null);
				$dest->data[$destPos + $i] = $val;
			}
		}
	}

	/**
	 * @param PhpVectorData $this
	 * 
	 * @return PhpVectorData
	 */
	public static function copy ($this1) {
		#/home/runner/haxe/versions/4.1.4/std/php/_std/haxe/ds/Vector.hx:108: characters 3-33
		return (clone $this1);
	}

	/**
	 * @param Array_hx $array
	 * 
	 * @return PhpVectorData
	 */
	public static function fromArrayCopy ($array) {
		#/home/runner/haxe/versions/4.1.4/std/php/_std/haxe/ds/Vector.hx:102: characters 3-49
		$vectorData = new PhpVectorData($array->length);
		#/home/runner/haxe/versions/4.1.4/std/php/_std/haxe/ds/Vector.hx:103: characters 3-46
		$vectorData->data = $array->arr;
		#/home/runner/haxe/versions/4.1.4/std/php/_std/haxe/ds/Vector.hx:104: characters 3-25
		return $vectorData;
	}

	/**
	 * @param PhpVectorData $data
	 * 
	 * @return PhpVectorData
	 */
	public static function fromData ($data) {
		#/home/runner/haxe/versions/4.1.4/std/php/_std/haxe/ds/Vector.hx:98: characters 3-19
		return $data;
	}

	/**
	 * @param PhpVectorData $this
	 * @param int $index
	 * 
	 * @return mixed
	 */
	public static function get ($this1, $index) {
		#/home/runner/haxe/versions/4.1.4/std/php/_std/haxe/ds/Vector.hx:47: characters 3-49
		return ($this1->data[$index] ?? null);
	}

	/**
	 * @param PhpVectorData $this
	 * 
	 * @return int
	 */
	public static function get_length ($this1) {
		#/home/runner/haxe/versions/4.1.4/std/php/_std/haxe/ds/Vector.hx:55: characters 3-21
		return $this1->length;
	}

	/**
	 * @param PhpVectorData $this
	 * @param string $sep
	 * 
	 * @return string
	 */
	public static function join ($this1, $sep) {
		#/home/runner/haxe/versions/4.1.4/std/php/_std/haxe/ds/Vector.hx:112: lines 112-114
		if ($this1->length === 0) {
			#/home/runner/haxe/versions/4.1.4/std/php/_std/haxe/ds/Vector.hx:113: characters 4-13
			return "";
		}
		#/home/runner/haxe/versions/4.1.4/std/php/_std/haxe/ds/Vector.hx:115: characters 3-35
		$result = Std::string(($this1->data[0] ?? null));
		#/home/runner/haxe/versions/4.1.4/std/php/_std/haxe/ds/Vector.hx:116: characters 13-17
		$_g = 1;
		#/home/runner/haxe/versions/4.1.4/std/php/_std/haxe/ds/Vector.hx:116: characters 17-28
		$_g1 = $this1->length;
		#/home/runner/haxe/versions/4.1.4/std/php/_std/haxe/ds/Vector.hx:116: lines 116-118
		while ($_g < $_g1) {
			#/home/runner/haxe/versions/4.1.4/std/php/_std/haxe/ds/Vector.hx:116: characters 13-28
			$i = $_g++;
			#/home/runner/haxe/versions/4.1.4/std/php/_std/haxe/ds/Vector.hx:117: characters 13-74
			$result = ($result . ($sep . Std::string(($this1->data[$i] ?? null))));
		}
		#/home/runner/haxe/versions/4.1.4/std/php/_std/haxe/ds/Vector.hx:119: characters 3-16
		return $result;
	}

	/**
	 * @param PhpVectorData $this
	 * @param \Closure $f
	 * 
	 * @return PhpVectorData
	 */
	public static function map ($this1, $f) {
		#/home/runner/haxe/versions/4.1.4/std/php/_std/haxe/ds/Vector.hx:123: characters 16-39
		$this2 = new PhpVectorData($this1->length);
		#/home/runner/haxe/versions/4.1.4/std/php/_std/haxe/ds/Vector.hx:123: characters 3-40
		$result = $this2;
		#/home/runner/haxe/versions/4.1.4/std/php/_std/haxe/ds/Vector.hx:124: lines 124-126
		$collection = $this1->data;
		foreach ($collection as $key => $value) {
			#/home/runner/haxe/versions/4.1.4/std/php/_std/haxe/ds/Vector.hx:125: characters 4-26
			$val = $f($value);
			$result->data[$key] = $val;
		}
		#/home/runner/haxe/versions/4.1.4/std/php/_std/haxe/ds/Vector.hx:127: characters 3-16
		return $result;
	}

	/**
	 * @param PhpVectorData $this
	 * @param int $index
	 * @param mixed $val
	 * 
	 * @return mixed
	 */
	public static function set ($this1, $index, $val) {
		#/home/runner/haxe/versions/4.1.4/std/php/_std/haxe/ds/Vector.hx:51: characters 3-32
		return $this1->data[$index] = $val;
	}

	/**
	 * @param PhpVectorData $this
	 * @param \Closure $f
	 * 
	 * @return void
	 */
	public static function sort ($this1, $f) {
		#/home/runner/haxe/versions/4.1.4/std/php/_std/haxe/ds/Vector.hx:131: characters 3-29
		\usort($this1->data, $f);
	}

	/**
	 * @param PhpVectorData $this
	 * 
	 * @return Array_hx
	 */
	public static function toArray ($this1) {
		#/home/runner/haxe/versions/4.1.4/std/php/_std/haxe/ds/Vector.hx:85: characters 3-19
		$result = new Array_hx();
		#/home/runner/haxe/versions/4.1.4/std/php/_std/haxe/ds/Vector.hx:86: characters 19-41
		$result->length = $this1->length;
		#/home/runner/haxe/versions/4.1.4/std/php/_std/haxe/ds/Vector.hx:87: characters 13-17
		$_g = 0;
		#/home/runner/haxe/versions/4.1.4/std/php/_std/haxe/ds/Vector.hx:87: characters 17-23
		$_g1 = $this1->length;
		#/home/runner/haxe/versions/4.1.4/std/php/_std/haxe/ds/Vector.hx:87: lines 87-89
		while ($_g < $_g1) {
			#/home/runner/haxe/versions/4.1.4/std/php/_std/haxe/ds/Vector.hx:87: characters 13-23
			$i = $_g++;
			#/home/runner/haxe/versions/4.1.4/std/php/_std/haxe/ds/Vector.hx:88: characters 20-43
			$val = ($this1->data[$i] ?? null);
			$result->arr[] = $val;
		}
		#/home/runner/haxe/versions/4.1.4/std/php/_std/haxe/ds/Vector.hx:90: characters 3-16
		return $result;
	}

	/**
	 * @param PhpVectorData $this
	 * 
	 * @return PhpVectorData
	 */
	public static function toData ($this1) {
		#/home/runner/haxe/versions/4.1.4/std/php/_std/haxe/ds/Vector.hx:94: characters 3-14
		return $this1;
	}
}

Boot::registerClass(Vector_Impl_::class, 'haxe.ds._Vector.Vector_Impl_');
Boot::registerGetters('helder\\std\\haxe\\ds\\_Vector\\Vector_Impl_', [
	'length' => true
]);
