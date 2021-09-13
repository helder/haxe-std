<?php
/**
 */

namespace helder\std\haxe\format;

use \helder\std\Reflect;
use \helder\std\php\_Boot\HxAnon;
use \helder\std\StringTools;
use \helder\std\php\Boot;
use \helder\std\Array_hx;
use \helder\std\Date;
use \helder\std\Std;
use \helder\std\Type;
use \helder\std\php\_Boot\HxClosure;
use \helder\std\haxe\ds\StringMap;
use \helder\std\StringBuf;

/**
 * An implementation of JSON printer in Haxe.
 * This class is used by `haxe.Json` when native JSON implementation
 * is not available.
 * @see https://haxe.org/manual/std-Json-encoding.html
 */
class JsonPrinter {
	/**
	 * @var StringBuf
	 */
	public $buf;
	/**
	 * @var string
	 */
	public $indent;
	/**
	 * @var int
	 */
	public $nind;
	/**
	 * @var bool
	 */
	public $pretty;
	/**
	 * @var \Closure
	 */
	public $replacer;

	/**
	 * Encodes `o`'s value and returns the resulting JSON string.
	 * If `replacer` is given and is not null, it is used to retrieve
	 * actual object to be encoded. The `replacer` function takes two parameters,
	 * the key and the value being encoded. Initial key value is an empty string.
	 * If `space` is given and is not null, the result will be pretty-printed.
	 * Successive levels will be indented by this string.
	 * 
	 * @param mixed $o
	 * @param \Closure $replacer
	 * @param string $space
	 * 
	 * @return string
	 */
	public static function print ($o, $replacer = null, $space = null) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:45: characters 3-50
		$printer = new JsonPrinter($replacer, $space);
		#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:46: characters 3-23
		$printer->write("", $o);
		#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:47: characters 3-32
		return $printer->buf->b;
	}

	/**
	 * @param \Closure $replacer
	 * @param string $space
	 * 
	 * @return void
	 */
	public function __construct ($replacer, $space) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:57: characters 3-27
		$this->replacer = $replacer;
		#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:58: characters 3-22
		$this->indent = $space;
		#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:59: characters 3-30
		$this->pretty = $space !== null;
		#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:60: characters 3-16
		$this->nind = 0;
		#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:67: characters 3-24
		$this->buf = new StringBuf();
	}

	/**
	 * @param mixed $v
	 * 
	 * @return void
	 */
	public function classString ($v) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:158: characters 3-60
		$this->fieldsString($v, Type::getInstanceFields(Type::getClass($v)));
	}

	/**
	 * @param mixed $v
	 * @param string[]|Array_hx $fields
	 * 
	 * @return void
	 */
	public function fieldsString ($v, $fields) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:166: characters 3-20
		$_this = $this->buf;
		$_this->b = ($_this->b??'null') . (\mb_chr(123)??'null');
		#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:167: characters 3-27
		$len = $fields->length;
		#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:168: characters 3-22
		$last = $len - 1;
		#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:169: characters 3-20
		$first = true;
		#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:170: characters 13-17
		$_g = 0;
		#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:170: characters 17-20
		$_g1 = $len;
		#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:170: lines 170-192
		while ($_g < $_g1) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:170: characters 13-20
			$i = $_g++;
			#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:171: characters 4-22
			$f = ($fields->arr[$i] ?? null);
			#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:172: characters 4-36
			$value = Reflect::field($v, $f);
			#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:173: characters 8-33
			$f1 = $value;
			#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:173: lines 173-174
			if (($f1 instanceof \Closure) || ($f1 instanceof HxClosure)) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:174: characters 5-13
				continue;
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:175: lines 175-179
			if ($first) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:176: characters 5-11
				$this->nind++;
				#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:177: characters 5-18
				$first = false;
			} else {
				#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:179: characters 5-22
				$_this = $this->buf;
				$_this->b = ($_this->b??'null') . (\mb_chr(44)??'null');
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:180: characters 4-10
			if ($this->pretty) {
				$_this1 = $this->buf;
				$_this1->b = ($_this1->b??'null') . (\mb_chr(10)??'null');
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:181: characters 4-10
			if ($this->pretty) {
				$v1 = StringTools::lpad("", $this->indent, $this->nind * mb_strlen($this->indent));
				$this->buf->add($v1);
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:182: characters 4-12
			$this->quote($f);
			#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:183: characters 4-21
			$_this2 = $this->buf;
			$_this2->b = ($_this2->b??'null') . (\mb_chr(58)??'null');
			#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:184: lines 184-185
			if ($this->pretty) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:185: characters 5-22
				$_this3 = $this->buf;
				$_this3->b = ($_this3->b??'null') . (\mb_chr(32)??'null');
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:186: characters 4-19
			$this->write($f, $value);
			#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:187: lines 187-191
			if ($i === $last) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:188: characters 5-11
				$this->nind--;
				#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:189: characters 5-11
				if ($this->pretty) {
					$_this4 = $this->buf;
					$_this4->b = ($_this4->b??'null') . (\mb_chr(10)??'null');
				}
				#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:190: characters 5-11
				if ($this->pretty) {
					$v2 = StringTools::lpad("", $this->indent, $this->nind * mb_strlen($this->indent));
					$this->buf->add($v2);
				}
			}
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:193: characters 3-20
		$_this = $this->buf;
		$_this->b = ($_this->b??'null') . (\mb_chr(125)??'null');
	}

	/**
	 * @return void
	 */
	public function ipad () {
		#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:72: lines 72-73
		if ($this->pretty) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:73: characters 4-59
			$v = StringTools::lpad("", $this->indent, $this->nind * mb_strlen($this->indent));
			$this->buf->add($v);
		}
	}

	/**
	 * @return void
	 */
	public function newl () {
		#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:77: lines 77-78
		if ($this->pretty) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:78: characters 4-22
			$_this = $this->buf;
			$_this->b = ($_this->b??'null') . (\mb_chr(10)??'null');
		}
	}

	/**
	 * @param mixed $v
	 * 
	 * @return void
	 */
	public function objString ($v) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:162: characters 3-37
		$this->fieldsString($v, Reflect::fields($v));
	}

	/**
	 * @param string $s
	 * 
	 * @return void
	 */
	public function quote ($s) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:203: characters 3-20
		$_this = $this->buf;
		$_this->b = ($_this->b??'null') . (\mb_chr(34)??'null');
		#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:204: characters 3-13
		$i = 0;
		#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:205: characters 3-25
		$length = mb_strlen($s);
		#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:209: lines 209-251
		while ($i < $length) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:210: characters 4-45
			$c = StringTools::unsafeCodeAt($s, $i++);
			#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:211: lines 211-250
			if ($c === 8) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:223: characters 6-16
				$this->buf->add("\\b");
			} else if ($c === 9) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:221: characters 6-16
				$this->buf->add("\\t");
			} else if ($c === 10) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:217: characters 6-16
				$this->buf->add("\\n");
			} else if ($c === 12) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:225: characters 6-16
				$this->buf->add("\\f");
			} else if ($c === 13) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:219: characters 6-16
				$this->buf->add("\\r");
			} else if ($c === 34) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:213: characters 6-16
				$this->buf->add("\\\"");
			} else if ($c === 92) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:215: characters 6-17
				$this->buf->add("\\\\");
			} else {
				#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:248: characters 6-16
				$_this = $this->buf;
				$_this->b = ($_this->b??'null') . (\mb_chr($c)??'null');
			}
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:256: characters 3-20
		$_this = $this->buf;
		$_this->b = ($_this->b??'null') . (\mb_chr(34)??'null');
	}

	/**
	 * @param mixed $k
	 * @param mixed $v
	 * 
	 * @return void
	 */
	public function write ($k, $v) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:82: lines 82-83
		if ($this->replacer !== null) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:83: characters 4-5
			$v = ($this->replacer)($k, $v);
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:84: characters 11-25
		$_g = Type::typeof($v);
		$__hx__switch = ($_g->index);
		if ($__hx__switch === 0) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:136: characters 5-16
			$this->buf->add("null");
		} else if ($__hx__switch === 1) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:90: characters 5-52
			$this->buf->add($v);
		} else if ($__hx__switch === 2) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:92: characters 5-51
			$v1 = (\is_finite($v) ? Std::string($v) : "null");
			$this->buf->add($v1);
		} else if ($__hx__switch === 3) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:134: characters 5-68
			$this->buf->add(($v ? "true" : "false"));
		} else if ($__hx__switch === 4) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:88: characters 5-17
			$this->fieldsString($v, Reflect::fields($v));
		} else if ($__hx__switch === 5) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:94: characters 5-19
			$this->buf->add("\"<fun>\"");
		} else if ($__hx__switch === 6) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:95: characters 16-17
			$c = $_g->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:96: lines 96-129
			if ($c === Boot::getClass('String')) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:97: characters 6-14
				$this->quote($v);
			} else if ($c === Boot::getClass(Array_hx::class)) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:99: characters 6-31
				$v1 = $v;
				#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:100: characters 6-23
				$_this = $this->buf;
				$_this->b = ($_this->b??'null') . (\mb_chr(91)??'null');
				#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:102: characters 6-25
				$len = $v1->length;
				#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:103: characters 6-25
				$last = $len - 1;
				#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:104: characters 16-20
				$_g1 = 0;
				#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:104: characters 20-23
				$_g2 = $len;
				#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:104: lines 104-117
				while ($_g1 < $_g2) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:104: characters 16-23
					$i = $_g1++;
					#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:105: lines 105-108
					if ($i > 0) {
						#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:106: characters 8-25
						$_this = $this->buf;
						$_this->b = ($_this->b??'null') . (\mb_chr(44)??'null');
					} else {
						#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:108: characters 8-14
						$this->nind++;
					}
					#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:109: characters 7-13
					if ($this->pretty) {
						$_this1 = $this->buf;
						$_this1->b = ($_this1->b??'null') . (\mb_chr(10)??'null');
					}
					#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:110: characters 7-13
					if ($this->pretty) {
						$v2 = StringTools::lpad("", $this->indent, $this->nind * mb_strlen($this->indent));
						$this->buf->add($v2);
					}
					#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:111: characters 7-21
					$this->write($i, ($v1->arr[$i] ?? null));
					#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:112: lines 112-116
					if ($i === $last) {
						#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:113: characters 8-14
						$this->nind--;
						#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:114: characters 8-14
						if ($this->pretty) {
							$_this2 = $this->buf;
							$_this2->b = ($_this2->b??'null') . (\mb_chr(10)??'null');
						}
						#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:115: characters 8-14
						if ($this->pretty) {
							$v3 = StringTools::lpad("", $this->indent, $this->nind * mb_strlen($this->indent));
							$this->buf->add($v3);
						}
					}
				}
				#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:118: characters 6-23
				$_this = $this->buf;
				$_this->b = ($_this->b??'null') . (\mb_chr(93)??'null');
			} else if ($c === Boot::getClass(StringMap::class)) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:120: characters 6-43
				$v1 = $v;
				#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:121: characters 6-17
				$o = new HxAnon();
				#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:122: characters 16-24
				$data = \array_values(\array_map("strval", \array_keys($v1->data)));
				$_g_current = 0;
				$_g_length = \count($data);
				$_g_data = $data;
				#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:122: lines 122-123
				while ($_g_current < $_g_length) {
					$k = $_g_data[$_g_current++];
					#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:123: characters 7-39
					Reflect::setField($o, $k, ($v1->data[$k] ?? null));
				}
				#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:124: characters 6-18
				$v1 = $o;
				$this->fieldsString($v1, Reflect::fields($v1));
			} else if ($c === Boot::getClass(Date::class)) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:126: characters 6-21
				$v1 = $v;
				#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:127: characters 6-25
				$this->quote($v1->toString());
			} else {
				#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:129: characters 6-20
				$this->classString($v);
			}
		} else if ($__hx__switch === 7) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:130: characters 15-16
			$_g1 = $_g->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:131: characters 5-39
			$i = $v->index;
			#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:132: characters 5-11
			$this->buf->add($i);
		} else if ($__hx__switch === 8) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/format/JsonPrinter.hx:86: characters 5-17
			$this->buf->add("\"???\"");
		}
	}
}

Boot::registerClass(JsonPrinter::class, 'haxe.format.JsonPrinter');
