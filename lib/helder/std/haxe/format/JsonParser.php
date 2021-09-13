<?php
/**
 */

namespace helder\std\haxe\format;

use \helder\std\Reflect;
use \helder\std\php\_Boot\HxAnon;
use \helder\std\php\Boot;
use \helder\std\haxe\Exception;
use \helder\std\Array_hx;
use \helder\std\Std;

class JsonParser {
	/**
	 * @var int
	 */
	public $pos;
	/**
	 * @var mixed
	 */
	public $str;

	/**
	 * @param mixed $buf
	 * @param mixed $s
	 * @param int $pos
	 * @param int $length
	 * 
	 * @return mixed
	 */
	public static function addSub ($buf, $s, $pos, $length) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:271: characters 10-59
		return ($buf . \substr($s, $pos, $length));
	}

	/**
	 * @param mixed $s
	 * @param int $pos
	 * 
	 * @return int
	 */
	public static function fastCodeAt ($s, $pos) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:263: characters 10-58
		if ($pos >= \strlen($s)) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:263: characters 36-37
			return 0;
		} else {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:263: characters 40-58
			return \ord($s[$pos]);
		}
	}

	/**
	 * @param string $str
	 * 
	 * @return mixed
	 */
	public static function parse ($str) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:33: characters 3-39
		return (new JsonParser($str))->doParse();
	}

	/**
	 * @param mixed $s
	 * @param int $pos
	 * @param int $length
	 * 
	 * @return mixed
	 */
	public static function substr ($s, $pos, $length = null) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:267: characters 3-39
		return \substr($s, $pos, $length);
	}

	/**
	 * @param string $str
	 * 
	 * @return void
	 */
	public function __construct ($str) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:40: characters 3-17
		$this->str = $str;
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:41: characters 3-15
		$this->pos = 0;
	}

	/**
	 * @return mixed
	 */
	public function doParse () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:45: characters 3-27
		$result = $this->parseRec();
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:46: characters 3-9
		$c = null;
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:47: lines 47-54
		while (true) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:47: characters 33-43
			$s = $this->str;
			$pos = $this->pos++;
			$c = ($pos >= \strlen($s) ? 0 : \ord($s[$pos]));
			#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:47: lines 47-54
			if (!($c !== 0)) {
				break;
			}
			#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:48: lines 48-53
			if ($c === 9 || $c === 10 || $c === 13 || $c === 32) {
			} else {
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:52: characters 6-19
				$this->invalidChar();
			}
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:55: characters 3-16
		return $result;
	}

	/**
	 * @return void
	 */
	public function invalidChar () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:253: characters 3-8
		$this->pos--;
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:254: characters 27-47
		$s = $this->str;
		$pos = $this->pos;
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:254: characters 3-8
		throw Exception::thrown("Invalid char " . ((($pos >= \strlen($s) ? 0 : \ord($s[$pos])))??'null') . " at position " . ($this->pos??'null'));
	}

	/**
	 * @param int $start
	 * 
	 * @return void
	 */
	public function invalidNumber ($start) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:258: characters 3-8
		throw Exception::thrown("Invalid number at position " . ($start??'null') . ": " . (\substr($this->str, $start, $this->pos - $start)??'null'));
	}

	/**
	 * @return int
	 */
	public function nextChar () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:249: characters 10-32
		$s = $this->str;
		$pos = $this->pos++;
		if ($pos >= \strlen($s)) {
			return 0;
		} else {
			return \ord($s[$pos]);
		}
	}

	/**
	 * @param int $c
	 * 
	 * @return mixed
	 */
	public function parseNumber ($c) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:197: characters 3-23
		$start = $this->pos - 1;
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:198: characters 3-67
		$minus = $c === 45;
		$digit = !$minus;
		$zero = $c === 48;
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:199: characters 3-57
		$point = false;
		$e = false;
		$pm = false;
		$end = false;
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:200: lines 200-241
		while (true) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:201: characters 8-18
			$s = $this->str;
			$pos = $this->pos++;
			$c = ($pos >= \strlen($s) ? 0 : \ord($s[$pos]));
			#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:202: lines 202-238
			if ($c === 43 || $c === 45) {
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:229: lines 229-230
				if (!$e || $pm) {
					#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:230: characters 7-27
					$this->invalidNumber($start);
				}
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:231: characters 6-19
				$digit = false;
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:232: characters 6-15
				$pm = true;
			} else if ($c === 46) {
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:219: lines 219-220
				if ($minus || $point || $e) {
					#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:220: characters 7-27
					$this->invalidNumber($start);
				}
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:221: characters 6-19
				$digit = false;
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:222: characters 6-18
				$point = true;
			} else if ($c === 48) {
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:204: lines 204-205
				if ($zero && !$point) {
					#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:205: characters 7-27
					$this->invalidNumber($start);
				}
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:206: lines 206-209
				if ($minus) {
					#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:207: characters 7-20
					$minus = false;
					#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:208: characters 7-18
					$zero = true;
				}
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:210: characters 6-18
				$digit = true;
			} else if ($c === 49 || $c === 50 || $c === 51 || $c === 52 || $c === 53 || $c === 54 || $c === 55 || $c === 56 || $c === 57) {
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:212: lines 212-213
				if ($zero && !$point) {
					#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:213: characters 7-27
					$this->invalidNumber($start);
				}
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:214: lines 214-215
				if ($minus) {
					#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:215: characters 7-20
					$minus = false;
				}
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:216: characters 6-18
				$digit = true;
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:217: characters 6-18
				$zero = false;
			} else if ($c === 69 || $c === 101) {
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:224: lines 224-225
				if ($minus || $zero || $e) {
					#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:225: characters 7-27
					$this->invalidNumber($start);
				}
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:226: characters 6-19
				$digit = false;
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:227: characters 6-14
				$e = true;
			} else {
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:234: lines 234-235
				if (!$digit) {
					#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:235: characters 7-27
					$this->invalidNumber($start);
				}
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:236: characters 6-11
				$this->pos--;
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:237: characters 6-16
				$end = true;
			}
			#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:239: lines 239-240
			if ($end) {
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:240: characters 5-10
				break;
			}
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:243: characters 3-58
		$f = Std::parseFloat(\substr($this->str, $start, $this->pos - $start));
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:244: characters 3-22
		$i = (int)($f);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:245: characters 10-30
		if (Boot::equal($i, $f)) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:245: characters 22-23
			return $i;
		} else {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:245: characters 29-30
			return $f;
		}
	}

	/**
	 * @return mixed
	 */
	public function parseRec () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:59: lines 59-137
		while (true) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:60: characters 12-22
			$s = $this->str;
			$pos = $this->pos++;
			#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:60: characters 4-23
			$c = ($pos >= \strlen($s) ? 0 : \ord($s[$pos]));
			#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:61: lines 61-136
			if ($c === 9 || $c === 10 || $c === 13 || $c === 32) {
			} else if ($c === 34) {
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:131: characters 6-26
				return $this->parseString();
			} else if ($c === 45 || $c === 48 || $c === 49 || $c === 50 || $c === 51 || $c === 52 || $c === 53 || $c === 54 || $c === 55 || $c === 56 || $c === 57) {
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:133: characters 13-27
				$c1 = $c;
				$start = $this->pos - 1;
				$minus = $c1 === 45;
				$digit = !$minus;
				$zero = $c1 === 48;
				$point = false;
				$e = false;
				$pm = false;
				$end = false;
				while (true) {
					$s1 = $this->str;
					$pos1 = $this->pos++;
					$c1 = ($pos1 >= \strlen($s1) ? 0 : \ord($s1[$pos1]));
					if ($c1 === 43 || $c1 === 45) {
						if (!$e || $pm) {
							$this->invalidNumber($start);
						}
						$digit = false;
						$pm = true;
					} else if ($c1 === 46) {
						if ($minus || $point || $e) {
							$this->invalidNumber($start);
						}
						$digit = false;
						$point = true;
					} else if ($c1 === 48) {
						if ($zero && !$point) {
							$this->invalidNumber($start);
						}
						if ($minus) {
							$minus = false;
							$zero = true;
						}
						$digit = true;
					} else if ($c1 === 49 || $c1 === 50 || $c1 === 51 || $c1 === 52 || $c1 === 53 || $c1 === 54 || $c1 === 55 || $c1 === 56 || $c1 === 57) {
						if ($zero && !$point) {
							$this->invalidNumber($start);
						}
						if ($minus) {
							$minus = false;
						}
						$digit = true;
						$zero = false;
					} else if ($c1 === 69 || $c1 === 101) {
						if ($minus || $zero || $e) {
							$this->invalidNumber($start);
						}
						$digit = false;
						$e = true;
					} else {
						if (!$digit) {
							$this->invalidNumber($start);
						}
						$this->pos--;
						$end = true;
					}
					if ($end) {
						break;
					}
				}
				$f = Std::parseFloat(\substr($this->str, $start, $this->pos - $start));
				$i = (int)($f);
				if (Boot::equal($i, $f)) {
					return $i;
				} else {
					return $f;
				}
			} else if ($c === 91) {
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:91: characters 6-44
				$arr = new Array_hx();
				$comma = null;
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:92: lines 92-108
				while (true) {
					#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:93: characters 15-25
					$s2 = $this->str;
					$pos2 = $this->pos++;
					#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:93: characters 7-26
					$c2 = ($pos2 >= \strlen($s2) ? 0 : \ord($s2[$pos2]));
					#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:94: lines 94-107
					if ($c2 === 9 || $c2 === 10 || $c2 === 13 || $c2 === 32) {
					} else if ($c2 === 44) {
						#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:101: characters 9-52
						if ($comma) {
							#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:101: characters 20-33
							$comma = false;
						} else {
							#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:101: characters 39-52
							$this->invalidChar();
						}
					} else if ($c2 === 93) {
						#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:98: characters 9-42
						if ($comma === false) {
							#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:98: characters 29-42
							$this->invalidChar();
						}
						#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:99: characters 9-19
						return $arr;
					} else {
						#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:103: characters 9-33
						if ($comma) {
							#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:103: characters 20-33
							$this->invalidChar();
						}
						#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:104: characters 9-14
						$this->pos--;
						#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:105: characters 9-29
						$x = $this->parseRec();
						$arr->arr[$arr->length++] = $x;
						#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:106: characters 9-21
						$comma = true;
					}
				}
			} else if ($c === 102) {
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:117: characters 6-21
				$save = $this->pos;
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:118: characters 10-110
				$tmp = null;
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:118: characters 10-84
				$tmp1 = null;
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:118: characters 10-58
				$tmp2 = null;
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:118: characters 10-20
				$s3 = $this->str;
				$pos3 = $this->pos++;
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:118: characters 10-58
				if ((($pos3 >= \strlen($s3) ? 0 : \ord($s3[$pos3]))) === 97) {
					#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:118: characters 36-46
					$s4 = $this->str;
					$pos4 = $this->pos++;
					#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:118: characters 10-58
					$tmp2 = (($pos4 >= \strlen($s4) ? 0 : \ord($s4[$pos4]))) !== 108;
				} else {
					$tmp2 = true;
				}
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:118: characters 10-84
				if (!$tmp2) {
					#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:118: characters 62-72
					$s5 = $this->str;
					$pos5 = $this->pos++;
					#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:118: characters 10-84
					$tmp1 = (($pos5 >= \strlen($s5) ? 0 : \ord($s5[$pos5]))) !== 115;
				} else {
					$tmp1 = true;
				}
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:118: characters 10-110
				if (!$tmp1) {
					#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:118: characters 88-98
					$s6 = $this->str;
					$pos6 = $this->pos++;
					#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:118: characters 10-110
					$tmp = (($pos6 >= \strlen($s6) ? 0 : \ord($s6[$pos6]))) !== 101;
				} else {
					$tmp = true;
				}
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:118: lines 118-121
				if ($tmp) {
					#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:119: characters 7-17
					$this->pos = $save;
					#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:120: characters 7-20
					$this->invalidChar();
				}
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:122: characters 6-18
				return false;
			} else if ($c === 110) {
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:124: characters 6-21
				$save1 = $this->pos;
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:125: characters 10-84
				$tmp3 = null;
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:125: characters 10-58
				$tmp4 = null;
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:125: characters 10-20
				$s7 = $this->str;
				$pos7 = $this->pos++;
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:125: characters 10-58
				if ((($pos7 >= \strlen($s7) ? 0 : \ord($s7[$pos7]))) === 117) {
					#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:125: characters 36-46
					$s8 = $this->str;
					$pos8 = $this->pos++;
					#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:125: characters 10-58
					$tmp4 = (($pos8 >= \strlen($s8) ? 0 : \ord($s8[$pos8]))) !== 108;
				} else {
					$tmp4 = true;
				}
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:125: characters 10-84
				if (!$tmp4) {
					#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:125: characters 62-72
					$s9 = $this->str;
					$pos9 = $this->pos++;
					#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:125: characters 10-84
					$tmp3 = (($pos9 >= \strlen($s9) ? 0 : \ord($s9[$pos9]))) !== 108;
				} else {
					$tmp3 = true;
				}
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:125: lines 125-128
				if ($tmp3) {
					#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:126: characters 7-17
					$this->pos = $save1;
					#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:127: characters 7-20
					$this->invalidChar();
				}
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:129: characters 6-17
				return null;
			} else if ($c === 116) {
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:110: characters 6-21
				$save2 = $this->pos;
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:111: characters 10-84
				$tmp5 = null;
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:111: characters 10-58
				$tmp6 = null;
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:111: characters 10-20
				$s10 = $this->str;
				$pos10 = $this->pos++;
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:111: characters 10-58
				if ((($pos10 >= \strlen($s10) ? 0 : \ord($s10[$pos10]))) === 114) {
					#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:111: characters 36-46
					$s11 = $this->str;
					$pos11 = $this->pos++;
					#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:111: characters 10-58
					$tmp6 = (($pos11 >= \strlen($s11) ? 0 : \ord($s11[$pos11]))) !== 117;
				} else {
					$tmp6 = true;
				}
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:111: characters 10-84
				if (!$tmp6) {
					#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:111: characters 62-72
					$s12 = $this->str;
					$pos12 = $this->pos++;
					#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:111: characters 10-84
					$tmp5 = (($pos12 >= \strlen($s12) ? 0 : \ord($s12[$pos12]))) !== 101;
				} else {
					$tmp5 = true;
				}
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:111: lines 111-114
				if ($tmp5) {
					#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:112: characters 7-17
					$this->pos = $save2;
					#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:113: characters 7-20
					$this->invalidChar();
				}
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:115: characters 6-17
				return true;
			} else if ($c === 123) {
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:65: characters 6-58
				$obj = new HxAnon();
				$field = null;
				$comma1 = null;
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:66: lines 66-89
				while (true) {
					#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:67: characters 15-25
					$s13 = $this->str;
					$pos13 = $this->pos++;
					#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:67: characters 7-26
					$c3 = ($pos13 >= \strlen($s13) ? 0 : \ord($s13[$pos13]));
					#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:68: lines 68-88
					if ($c3 === 9 || $c3 === 10 || $c3 === 13 || $c3 === 32) {
					} else if ($c3 === 34) {
						#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:84: characters 9-50
						if (($field !== null) || $comma1) {
							#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:84: characters 37-50
							$this->invalidChar();
						}
						#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:85: characters 9-30
						$field = $this->parseString();
					} else if ($c3 === 44) {
						#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:82: characters 9-52
						if ($comma1) {
							#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:82: characters 20-33
							$comma1 = false;
						} else {
							#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:82: characters 39-52
							$this->invalidChar();
						}
					} else if ($c3 === 58) {
						#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:76: lines 76-77
						if ($field === null) {
							#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:77: characters 10-23
							$this->invalidChar();
						}
						#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:78: characters 9-49
						Reflect::setField($obj, $field, $this->parseRec());
						#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:79: characters 9-21
						$field = null;
						#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:80: characters 9-21
						$comma1 = true;
					} else if ($c3 === 125) {
						#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:72: lines 72-73
						if (($field !== null) || ($comma1 === false)) {
							#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:73: characters 10-23
							$this->invalidChar();
						}
						#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:74: characters 9-19
						return $obj;
					} else {
						#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:87: characters 9-22
						$this->invalidChar();
					}
				}
			} else {
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:135: characters 6-19
				$this->invalidChar();
			}
		}
	}

	/**
	 * @return mixed
	 */
	public function parseString () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:141: characters 3-19
		$start = $this->pos;
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:142: characters 3-31
		$buf = null;
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:143: lines 143-188
		while (true) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:144: characters 12-22
			$s = $this->str;
			$pos = $this->pos++;
			#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:144: characters 4-23
			$c = ($pos >= \strlen($s) ? 0 : \ord($s[$pos]));
			#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:145: lines 145-146
			if ($c === 34) {
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:146: characters 5-10
				break;
			}
			#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:147: lines 147-187
			if ($c === 92) {
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:148: lines 148-150
				if ($buf === null) {
					#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:149: characters 6-14
					$buf = "";
				}
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:151: characters 11-50
				$buf = ($buf . \substr($this->str, $start, $this->pos - $start - 1));
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:152: characters 9-19
				$s1 = $this->str;
				$pos1 = $this->pos++;
				$c = ($pos1 >= \strlen($s1) ? 0 : \ord($s1[$pos1]));
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:153: lines 153-172
				if ($c === 34 || $c === 47 || $c === 92) {
					#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:165: characters 13-49
					$buf = ($buf . \mb_chr($c));
				} else if ($c === 98) {
					#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:161: characters 13-46
					$buf = ($buf . \chr(8));
				} else if ($c === 102) {
					#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:163: characters 13-47
					$buf = ($buf . \chr(12));
				} else if ($c === 110) {
					#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:157: characters 7-37
					$buf = ($buf . "\x0A");
				} else if ($c === 114) {
					#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:155: characters 7-37
					$buf = ($buf . "\x0D");
				} else if ($c === 116) {
					#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:159: characters 7-37
					$buf = ($buf . "\x09");
				} else if ($c === 117) {
					#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:167: characters 7-56
					$uc = Std::parseInt("0x" . (\substr($this->str, $this->pos, 4)??'null'));
					#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:168: characters 7-15
					$this->pos += 4;
					#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:169: characters 13-50
					$buf = ($buf . \mb_chr($uc));
				} else {
					#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:171: characters 7-12
					throw Exception::thrown("Invalid escape sequence \\" . (\mb_chr($c)??'null') . " at position " . ($this->pos - 1));
				}
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:173: characters 5-16
				$start = $this->pos;
			} else if ($c >= 128) {
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:177: characters 5-10
				$this->pos++;
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:178: lines 178-185
				if ($c >= 252) {
					#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:179: characters 6-14
					$this->pos += 4;
				} else if ($c >= 248) {
					#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:181: characters 6-14
					$this->pos += 3;
				} else if ($c >= 240) {
					#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:183: characters 6-14
					$this->pos += 2;
				} else if ($c >= 224) {
					#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:185: characters 6-11
					$this->pos++;
				}
			} else if ($c === 0) {
				#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:187: characters 5-10
				throw Exception::thrown("Unclosed string");
			}
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:189: lines 189-193
		if ($buf === null) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:190: characters 11-45
			return \substr($this->str, $start, $this->pos - $start - 1);
		} else {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/haxe/format/JsonParser.hx:192: characters 11-50
			return ($buf . \substr($this->str, $start, $this->pos - $start - 1));
		}
	}
}

Boot::registerClass(JsonParser::class, 'haxe.format.JsonParser');
