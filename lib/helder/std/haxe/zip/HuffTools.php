<?php
/**
 */

namespace helder\std\haxe\zip;

use \helder\std\php\Boot;
use \helder\std\haxe\Exception;
use \helder\std\Array_hx;
use \helder\std\haxe\ds\IntMap;

class HuffTools {
	/**
	 * @return void
	 */
	public function __construct () {
	}

	/**
	 * @param int[]|Array_hx $lengths
	 * @param int $pos
	 * @param int $nlengths
	 * @param int $maxbits
	 * 
	 * @return Huffman
	 */
	public function make ($lengths, $pos, $nlengths, $maxbits) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:87: lines 87-89
		if ($nlengths === 1) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:88: characters 4-38
			return Huffman::NeedBit(Huffman::Found(0), Huffman::Found(0));
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:90: characters 3-28
		$counts = new Array_hx();
		#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:91: characters 3-25
		$tmp = new Array_hx();
		#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:92: lines 92-93
		if ($maxbits > 32) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:93: characters 4-9
			throw Exception::thrown("Invalid huffman");
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:94: characters 13-17
		$_g = 0;
		#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:94: characters 17-24
		$_g1 = $maxbits;
		#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:94: lines 94-97
		while ($_g < $_g1) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:94: characters 13-24
			$i = $_g++;
			#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:95: characters 4-18
			$counts->arr[$counts->length++] = 0;
			#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:96: characters 4-15
			$tmp->arr[$tmp->length++] = 0;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:98: characters 13-17
		$_g = 0;
		#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:98: characters 17-25
		$_g1 = $nlengths;
		#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:98: lines 98-103
		while ($_g < $_g1) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:98: characters 13-25
			$i = $_g++;
			#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:99: characters 4-29
			$p = ($lengths->arr[$i + $pos] ?? null);
			#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:100: lines 100-101
			if ($p >= $maxbits) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:101: characters 5-10
				throw Exception::thrown("Invalid huffman");
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:102: characters 4-15
			$counts[$p]++;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:104: characters 3-16
		$code = 0;
		#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:105: characters 13-17
		$_g = 1;
		#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:105: characters 17-28
		$_g1 = $maxbits - 1;
		#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:105: lines 105-108
		while ($_g < $_g1) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:105: characters 13-28
			$i = $_g++;
			#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:106: characters 4-34
			$code = ($code + ($counts->arr[$i] ?? null)) << 1;
			#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:107: characters 4-17
			$tmp->offsetSet($i, $code);
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:109: characters 3-35
		$bits = new IntMap();
		#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:110: characters 13-17
		$_g = 0;
		#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:110: characters 17-25
		$_g1 = $nlengths;
		#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:110: lines 110-117
		while ($_g < $_g1) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:110: characters 13-25
			$i = $_g++;
			#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:111: characters 4-29
			$l = ($lengths->arr[$i + $pos] ?? null);
			#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:112: lines 112-116
			if ($l !== 0) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:113: characters 5-24
				$n = ($tmp->arr[$l - 1] ?? null);
				#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:114: characters 5-23
				$tmp->offsetSet($l - 1, $n + 1);
				#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:115: characters 5-30
				$bits->data[($n << 5) | $l] = $i;
			}
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:118: characters 31-60
		$tmp = $this->treeMake($bits, $maxbits, 0, 1);
		#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:118: characters 3-93
		return $this->treeCompress(Huffman::NeedBit($tmp, $this->treeMake($bits, $maxbits, 1, 1)));
	}

	/**
	 * @param Huffman $t
	 * 
	 * @return Huffman
	 */
	public function treeCompress ($t) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:46: characters 3-24
		$d = $this->treeDepth($t);
		#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:47: lines 47-48
		if ($d === 0) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:48: characters 4-12
			return $t;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:49: lines 49-53
		if ($d === 1) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:50: lines 50-53
			if ($t->index === 1) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:51: characters 18-19
				$a = $t->params[0];
				#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:51: characters 21-22
				$b = $t->params[1];
				#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:51: characters 33-48
				$tmp = $this->treeCompress($a);
				#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:51: characters 25-66
				return Huffman::NeedBit($tmp, $this->treeCompress($b));
			} else {
				#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:52: characters 14-19
				throw Exception::thrown("assert");
			}
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:54: characters 3-21
		$size = 1 << $d;
		#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:55: characters 3-27
		$table = new Array_hx();
		#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:56: characters 13-17
		$_g = 0;
		#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:56: characters 17-21
		$_g1 = $size;
		#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:56: lines 56-57
		while ($_g < $_g1) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:56: characters 13-21
			$i = $_g++;
			#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:57: characters 4-25
			$table->arr[$table->length++] = Huffman::Found(-1);
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:58: characters 3-30
		$this->treeWalk($table, 0, 0, $d, $t);
		#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:59: characters 3-28
		return Huffman::NeedBits($d, $table);
	}

	/**
	 * @param Huffman $t
	 * 
	 * @return int
	 */
	public function treeDepth ($t) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:35: lines 35-42
		$__hx__switch = ($t->index);
		if ($__hx__switch === 0) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:36: characters 15-16
			$_g = $t->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:36: characters 19-20
			return 0;
		} else if ($__hx__switch === 1) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:38: characters 17-18
			$a = $t->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:38: characters 20-21
			$b = $t->params[1];
			#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:39: characters 5-27
			$da = $this->treeDepth($a);
			#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:40: characters 5-27
			$db = $this->treeDepth($b);
			#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:41: characters 5-30
			return 1 + (($da < $db ? $da : $db));
		} else if ($__hx__switch === 2) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:37: characters 18-19
			$_g = $t->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:37: characters 21-22
			$_g = $t->params[1];
			#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:37: characters 25-30
			throw Exception::thrown("assert");
		}
	}

	/**
	 * @param IntMap $bits
	 * @param int $maxbits
	 * @param int $v
	 * @param int $len
	 * 
	 * @return Huffman
	 */
	public function treeMake ($bits, $maxbits, $v, $len) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:76: lines 76-77
		if ($len > $maxbits) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:77: characters 4-9
			throw Exception::thrown("Invalid huffman");
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:78: characters 3-28
		$idx = ($v << 5) | $len;
		#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:79: lines 79-80
		if (\array_key_exists($idx, $bits->data)) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:80: characters 4-31
			return Huffman::Found(($bits->data[$idx] ?? null));
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:81: characters 3-10
		$v <<= 1;
		#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:82: characters 3-11
		++$len;
		#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:83: characters 18-49
		$tmp = $this->treeMake($bits, $maxbits, $v, $len);
		#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:83: characters 3-87
		return Huffman::NeedBit($tmp, $this->treeMake($bits, $maxbits, $v | 1, $len));
	}

	/**
	 * @param Huffman[]|Array_hx $table
	 * @param int $p
	 * @param int $cd
	 * @param int $d
	 * @param Huffman $t
	 * 
	 * @return void
	 */
	public function treeWalk ($table, $p, $cd, $d, $t) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:63: lines 63-72
		if ($t->index === 1) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:64: characters 17-18
			$a = $t->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:64: characters 20-21
			$b = $t->params[1];
			#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:65: lines 65-69
			if ($d > 0) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:66: characters 6-42
				$this->treeWalk($table, $p, $cd + 1, $d - 1, $a);
				#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:67: characters 6-54
				$this->treeWalk($table, $p | (1 << $cd), $cd + 1, $d - 1, $b);
			} else {
				#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:69: characters 6-32
				$table->offsetSet($p, $this->treeCompress($t));
			}
		} else {
			#/home/runner/haxe/versions/4.2.3/std/haxe/zip/Huffman.hx:71: characters 5-31
			$table->offsetSet($p, $this->treeCompress($t));
		}
	}
}

Boot::registerClass(HuffTools::class, 'haxe.zip.HuffTools');
