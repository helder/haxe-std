<?php
/**
 */

namespace helder\std\haxe;

use \helder\std\Reflect;
use \helder\std\StringTools;
use \helder\std\php\_Boot\HxAnon;
use \helder\std\php\Boot;
use \helder\std\Array_hx;
use \helder\std\Std;
use \helder\std\php\_Boot\HxString;
use \helder\std\haxe\ds\List_hx;
use \helder\std\haxe\_Template\TemplateExpr;
use \helder\std\StringBuf;
use \helder\std\EReg;
use \helder\std\haxe\iterators\ArrayIterator;

/**
 * `Template` provides a basic templating mechanism to replace values in a source
 * String, and to have some basic logic.
 * A complete documentation of the supported syntax is available at:
 * <https://haxe.org/manual/std-template.html>
 */
class Template {
	/**
	 * @var EReg
	 */
	static public $expr_float;
	/**
	 * @var EReg
	 */
	static public $expr_int;
	/**
	 * @var EReg
	 */
	static public $expr_splitter;
	/**
	 * @var EReg
	 */
	static public $expr_trim;
	/**
	 * @var mixed
	 * Global replacements which are used across all `Template` instances. This
	 * has lower priority than the context argument of `execute()`.
	 */
	static public $globals;
	/**
	 * @var ArrayIterator
	 */
	static public $hxKeepArrayIterator;
	/**
	 * @var EReg
	 */
	static public $splitter;

	/**
	 * @var StringBuf
	 */
	public $buf;
	/**
	 * @var mixed
	 */
	public $context;
	/**
	 * @var TemplateExpr
	 */
	public $expr;
	/**
	 * @var mixed
	 */
	public $macros;
	/**
	 * @var List_hx
	 */
	public $stack;

	/**
	 * Creates a new `Template` instance from `str`.
	 * `str` is parsed into tokens, which are stored for internal use. This
	 * means that multiple `execute()` operations on a single `Template` instance
	 * are more efficient than one `execute()` operations on multiple `Template`
	 * instances.
	 * If `str` is `null`, the result is unspecified.
	 * 
	 * @param string $str
	 * 
	 * @return void
	 */
	public function __construct ($str) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:90: characters 3-33
		$tokens = $this->parseTokens($str);
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:91: characters 3-28
		$this->expr = $this->parseBlock($tokens);
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:92: lines 92-93
		if (!$tokens->isEmpty()) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:93: characters 4-9
			throw Exception::thrown("Unexpected '" . Std::string($tokens->first()->s) . "'");
		}
	}

	/**
	 * Executes `this` `Template`, taking into account `context` for
	 * replacements and `macros` for callback functions.
	 * If `context` has a field `name`, its value replaces all occurrences of
	 * `::name::` in the `Template`. Otherwise `Template.globals` is checked instead,
	 * If `name` is not a field of that either, `::name::` is replaced with `null`.
	 * If `macros` has a field `name`, all occurrences of `$$name(args)` are
	 * replaced with the result of calling that field. The first argument is
	 * always the `resolve()` method, followed by the given arguments.
	 * If `macros` has no such field, the result is unspecified.
	 * If `context` is `null`, the result is unspecified. If `macros` is `null`,
	 * no macros are used.
	 * 
	 * @param mixed $context
	 * @param mixed $macros
	 * 
	 * @return string
	 */
	public function execute ($context, $macros = null) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:113: characters 3-51
		$this->macros = ($macros === null ? new HxAnon() : $macros);
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:114: characters 3-25
		$this->context = $context;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:115: characters 3-21
		$this->stack = new List_hx();
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:116: characters 3-24
		$this->buf = new StringBuf();
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:117: characters 3-12
		$this->run($this->expr);
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:118: characters 3-24
		return $this->buf->b;
	}

	/**
	 * @param string $v
	 * 
	 * @return \Closure
	 */
	public function makeConst ($v) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:305: characters 3-21
		Template::$expr_trim->match($v);
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:306: characters 3-27
		$v = Template::$expr_trim->matched(1);
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:307: lines 307-310
		if (HxString::charCodeAt($v, 0) === 34) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:308: characters 4-40
			$str = \mb_substr($v, 1, mb_strlen($v) - 2);
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:309: characters 4-32
			return function () use (&$str) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:309: characters 22-32
				return $str;
			};
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:311: lines 311-316
		if (Template::$expr_int->match($v)) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:312: characters 4-28
			$i = Std::parseInt($v);
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:313: lines 313-315
			return function () use (&$i) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:314: characters 5-13
				return $i;
			};
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:317: lines 317-322
		if (Template::$expr_float->match($v)) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:318: characters 4-30
			$f = Std::parseFloat($v);
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:319: lines 319-321
			return function () use (&$f) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:320: characters 5-13
				return $f;
			};
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:323: characters 3-17
		$me = $this;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:324: lines 324-326
		return function () use (&$v, &$me) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:325: characters 4-24
			return $me->resolve($v);
		};
	}

	/**
	 * @param List_hx $l
	 * 
	 * @return \Closure
	 */
	public function makeExpr ($l) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:346: characters 3-35
		return $this->makePath($this->makeExpr2($l), $l);
	}

	/**
	 * @param List_hx $l
	 * 
	 * @return \Closure
	 */
	public function makeExpr2 ($l) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:363: characters 3-16
		$this->skipSpaces($l);
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:364: characters 3-19
		$p = $l->pop();
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:365: characters 3-16
		$this->skipSpaces($l);
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:366: lines 366-367
		if ($p === null) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:367: characters 4-9
			throw Exception::thrown("<eof>");
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:368: lines 368-369
		if ($p->s) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:369: characters 4-25
			return $this->makeConst($p->p);
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:370: characters 11-14
		$__hx__switch = ($p->p);
		if ($__hx__switch === "!") {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:427: characters 5-39
			$e = $this->makeExpr($l);
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:428: lines 428-431
			return function () use (&$e) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:429: characters 6-26
				$v = $e();
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:430: characters 13-38
				if ($v !== null) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:430: characters 27-37
					return $v === false;
				} else {
					#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:430: characters 13-38
					return true;
				}
			};
		} else if ($__hx__switch === "(") {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:372: characters 5-18
			$this->skipSpaces($l);
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:373: characters 5-34
			$e1 = $this->makeExpr($l);
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:374: characters 5-18
			$this->skipSpaces($l);
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:375: characters 5-21
			$p1 = $l->pop();
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:376: lines 376-377
			if (($p1 === null) || $p1->s) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:377: characters 6-11
				throw Exception::thrown($p1);
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:378: lines 378-379
			if ($p1->p === ")") {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:379: characters 6-15
				return $e1;
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:380: characters 5-18
			$this->skipSpaces($l);
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:381: characters 5-34
			$e2 = $this->makeExpr($l);
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:382: characters 5-18
			$this->skipSpaces($l);
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:383: characters 5-22
			$p2 = $l->pop();
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:384: characters 5-18
			$this->skipSpaces($l);
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:385: lines 385-386
			if (($p2 === null) || ($p2->p !== ")")) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:386: characters 6-11
				throw Exception::thrown($p2);
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:387: characters 20-23
			$__hx__switch = ($p1->p);
			if ($__hx__switch === "!=") {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:415: lines 415-417
				return function () use (&$e1, &$e2) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:416: characters 8-32
					return !Boot::equal($e1(), $e2());
				};
			} else if ($__hx__switch === "&&") {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:418: lines 418-420
				return function () use (&$e1, &$e2) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:419: characters 8-32
					return $e1() && $e2();
				};
			} else if ($__hx__switch === "*") {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:394: lines 394-396
				return function () use (&$e1, &$e2) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:395: characters 8-31
					return $e1() * $e2();
				};
			} else if ($__hx__switch === "+") {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:388: lines 388-390
				return function () use (&$e1, &$e2) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:389: characters 8-31
					return Boot::addOrConcat($e1(), $e2());
				};
			} else if ($__hx__switch === "-") {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:391: lines 391-393
				return function () use (&$e1, &$e2) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:392: characters 8-31
					return $e1() - $e2();
				};
			} else if ($__hx__switch === "/") {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:397: lines 397-399
				return function () use (&$e1, &$e2) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:398: characters 8-31
					return $e1() / $e2();
				};
			} else if ($__hx__switch === "<") {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:403: lines 403-405
				return function () use (&$e1, &$e2) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:404: characters 8-31
					return $e1() < $e2();
				};
			} else if ($__hx__switch === "<=") {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:409: lines 409-411
				return function () use (&$e1, &$e2) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:410: characters 8-32
					return $e1() <= $e2();
				};
			} else if ($__hx__switch === "==") {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:412: lines 412-414
				return function () use (&$e1, &$e2) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:413: characters 8-32
					return Boot::equal($e1(), $e2());
				};
			} else if ($__hx__switch === ">") {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:400: lines 400-402
				return function () use (&$e1, &$e2) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:401: characters 8-31
					return $e1() > $e2();
				};
			} else if ($__hx__switch === ">=") {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:406: lines 406-408
				return function () use (&$e1, &$e2) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:407: characters 8-32
					return $e1() >= $e2();
				};
			} else if ($__hx__switch === "||") {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:421: lines 421-423
				return function () use (&$e1, &$e2) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:422: characters 8-32
					return $e1() || $e2();
				};
			} else {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:424: characters 15-20
				throw Exception::thrown("Unknown operation " . ($p1->p??'null'));
			}
		} else if ($__hx__switch === "-") {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:433: characters 5-25
			$e3 = $this->makeExpr($l);
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:434: lines 434-436
			return function () use (&$e3) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:435: characters 6-17
				return -$e3();
			};
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:438: characters 3-8
		throw Exception::thrown($p->p);
	}

	/**
	 * @param \Closure $e
	 * @param List_hx $l
	 * 
	 * @return \Closure
	 */
	public function makePath ($e, $l) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:330: characters 3-21
		$p = $l->first();
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:331: lines 331-332
		if (($p === null) || ($p->p !== ".")) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:332: characters 4-12
			return $e;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:333: characters 3-10
		$l->pop();
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:334: characters 3-23
		$field = $l->pop();
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:335: lines 335-336
		if (($field === null) || !$field->s) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:336: characters 4-9
			throw Exception::thrown($field->p);
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:337: characters 3-19
		$f = $field->p;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:338: characters 3-21
		Template::$expr_trim->match($f);
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:339: characters 3-27
		$f = Template::$expr_trim->matched(1);
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:340: lines 340-342
		return $this->makePath(function () use (&$f, &$e) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:341: characters 4-32
			return Reflect::field($e(), $f);
		}, $l);
	}

	/**
	 * @param List_hx $tokens
	 * 
	 * @return TemplateExpr
	 */
	public function parse ($tokens) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:200: characters 3-24
		$t = $tokens->pop();
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:201: characters 3-15
		$p = $t->p;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:202: lines 202-203
		if ($t->s) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:203: characters 4-19
			return TemplateExpr::OpStr($p);
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:205: lines 205-210
		if ($t->l !== null) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:206: characters 4-24
			$pe = new List_hx();
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:207: lines 207-208
			$_g = 0;
			$_g1 = $t->l;
			while ($_g < $_g1->length) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:207: characters 9-10
				$p1 = ($_g1->arr[$_g] ?? null);
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:207: lines 207-208
				++$_g;
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:208: characters 5-39
				$pe->add($this->parseBlock($this->parseTokens($p1)));
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:209: characters 4-25
			return TemplateExpr::OpMacro($p, $pe);
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:211: lines 211-224
		$kwdEnd = function ($kwd) use (&$p) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:212: characters 4-17
			$pos = -1;
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:213: characters 4-28
			$length = mb_strlen($kwd);
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:214: lines 214-222
			if (\mb_substr($p, 0, $length) === $kwd) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:215: characters 5-8
				$pos = $length;
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:216: characters 15-31
				$_g_offset = 0;
				$_g_s = \mb_substr($p, $length, null);
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:216: lines 216-221
				while ($_g_offset < mb_strlen($_g_s)) {
					$c = StringTools::unsafeCodeAt($_g_s, $_g_offset++);
					#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:217: lines 217-220
					if ($c === 32) {
						#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:218: characters 22-27
						++$pos;
					} else {
						#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:219: characters 15-20
						break;
					}
				}
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:223: characters 4-14
			return $pos;
		};
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:226: characters 3-26
		$pos = $kwdEnd("if");
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:227: lines 227-249
		if ($pos > 0) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:228: characters 8-37
			$p = \mb_substr($p, $pos, mb_strlen($p) - $pos);
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:229: characters 4-25
			$e = $this->parseExpr($p);
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:230: characters 4-33
			$eif = $this->parseBlock($tokens);
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:231: characters 4-27
			$t = $tokens->first();
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:232: characters 4-14
			$eelse = null;
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:233: lines 233-234
			if ($t === null) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:234: characters 5-10
				throw Exception::thrown("Unclosed 'if'");
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:235: lines 235-247
			if ($t->p === "end") {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:236: characters 5-17
				$tokens->pop();
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:237: characters 5-10
				$eelse = null;
			} else if ($t->p === "else") {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:239: characters 5-17
				$tokens->pop();
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:240: characters 5-10
				$eelse = $this->parseBlock($tokens);
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:241: characters 5-6
				$t = $tokens->pop();
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:242: lines 242-243
				if (($t === null) || ($t->p !== "end")) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:243: characters 6-11
					throw Exception::thrown("Unclosed 'else'");
				}
			} else {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:245: characters 5-8
				$t->p = \mb_substr($t->p, 4, mb_strlen($t->p) - 4);
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:246: characters 5-10
				$eelse = $this->parse($tokens);
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:248: characters 4-30
			return TemplateExpr::OpIf($e, $eif, $eelse);
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:250: characters 3-31
		$pos = $kwdEnd("foreach");
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:251: lines 251-259
		if ($pos >= 0) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:252: characters 8-37
			$p = \mb_substr($p, $pos, mb_strlen($p) - $pos);
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:253: characters 4-25
			$e = $this->parseExpr($p);
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:254: characters 4-34
			$efor = $this->parseBlock($tokens);
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:255: characters 4-25
			$t = $tokens->pop();
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:256: lines 256-257
			if (($t === null) || ($t->p !== "end")) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:257: characters 5-10
				throw Exception::thrown("Unclosed 'foreach'");
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:258: characters 4-29
			return TemplateExpr::OpForeach($e, $efor);
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:260: lines 260-261
		if (Template::$expr_splitter->match($p)) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:261: characters 4-31
			return TemplateExpr::OpExpr($this->parseExpr($p));
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:262: characters 3-18
		return TemplateExpr::OpVar($p);
	}

	/**
	 * @param List_hx $tokens
	 * 
	 * @return TemplateExpr
	 */
	public function parseBlock ($tokens) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:185: characters 3-22
		$l = new List_hx();
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:186: lines 186-193
		while (true) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:187: characters 4-27
			$t = $tokens->first();
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:188: lines 188-189
			if ($t === null) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:189: characters 5-10
				break;
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:190: lines 190-191
			if (!$t->s && (($t->p === "end") || ($t->p === "else") || (\mb_substr($t->p, 0, 7) === "elseif "))) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:191: characters 5-10
				break;
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:192: characters 4-24
			$l->add($this->parse($tokens));
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:194: lines 194-195
		if ($l->length === 1) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:195: characters 4-20
			return $l->first();
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:196: characters 3-20
		return TemplateExpr::OpBlock($l);
	}

	/**
	 * @param string $data
	 * 
	 * @return \Closure
	 */
	public function parseExpr ($data) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:266: characters 3-33
		$l = new List_hx();
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:267: characters 3-19
		$expr = $data;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:268: lines 268-276
		while (Template::$expr_splitter->match($data)) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:269: characters 4-39
			$p = Template::$expr_splitter->matchedPos();
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:270: characters 4-26
			$k = $p->pos + $p->len;
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:271: lines 271-272
			if ($p->pos !== 0) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:272: characters 5-47
				$l->add(new _HxAnon_Template0(\mb_substr($data, 0, $p->pos), true));
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:273: characters 4-37
			$p1 = Template::$expr_splitter->matched(0);
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:274: characters 4-41
			$l->add(new _HxAnon_Template0($p1, HxString::indexOf($p1, "\"") >= 0));
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:275: characters 4-8
			$data = Template::$expr_splitter->matchedRight();
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:277: lines 277-286
		if (mb_strlen($data) !== 0) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:278: characters 19-23
			$_g_offset = 0;
			$_g_s = $data;
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:278: lines 278-285
			while ($_g_offset < mb_strlen($_g_s)) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:278: characters 19-23
				$_g1_key = $_g_offset;
				$_g1_value = StringTools::fastCodeAt($_g_s, $_g_offset++);
				$i = $_g1_key;
				$c = $_g1_value;
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:279: lines 279-284
				if ($c !== 32) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:282: characters 7-42
					$l->add(new _HxAnon_Template0(\mb_substr($data, $i, null), true));
					#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:283: characters 7-12
					break;
				}
			}
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:287: characters 3-23
		$e = null;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:288: lines 288-294
		try {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:289: characters 4-5
			$e = $this->makeExpr($l);
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:290: lines 290-291
			if (!$l->isEmpty()) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:291: characters 5-10
				throw Exception::thrown($l->first()->p);
			}
		} catch(\Throwable $_g) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:292: characters 12-13
			NativeStackTrace::saveStack($_g);
			$_g1 = Exception::caught($_g)->unwrap();
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:288: lines 288-294
			if (is_string($_g1)) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:292: characters 12-13
				$s = $_g1;
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:293: characters 4-9
				throw Exception::thrown("Unexpected '" . ($s??'null') . "' in " . ($expr??'null'));
			} else {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:288: lines 288-294
				throw $_g;
			}
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:295: lines 295-301
		return function () use (&$e, &$expr) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:296: lines 296-300
			try {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:297: characters 5-15
				return $e();
			} catch(\Throwable $_g) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:298: characters 13-16
				NativeStackTrace::saveStack($_g);
				$exc = Exception::caught($_g)->unwrap();
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:299: characters 5-10
				throw Exception::thrown("Error : " . Std::string($exc) . " in " . ($expr??'null'));
			}
		};
	}

	/**
	 * @param string $data
	 * 
	 * @return List_hx
	 */
	public function parseTokens ($data) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:138: characters 3-34
		$tokens = new List_hx();
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:139: lines 139-178
		while (Template::$splitter->match($data)) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:140: characters 4-34
			$p = Template::$splitter->matchedPos();
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:141: lines 141-142
			if ($p->pos > 0) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:142: characters 5-61
				$tokens->add(new _HxAnon_Template1(\mb_substr($data, 0, $p->pos), true, null));
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:145: lines 145-149
			if (HxString::charCodeAt($data, $p->pos) === 58) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:146: characters 5-74
				$tokens->add(new _HxAnon_Template1(\mb_substr($data, $p->pos + 2, $p->len - 4), false, null));
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:147: characters 5-35
				$data = Template::$splitter->matchedRight();
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:148: characters 5-13
				continue;
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:152: characters 4-29
			$parp = $p->pos + $p->len;
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:153: characters 4-17
			$npar = 1;
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:154: characters 4-20
			$params = new Array_hx();
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:155: characters 4-18
			$part = "";
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:156: lines 156-174
			while (true) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:157: characters 5-35
				$c = HxString::charCodeAt($data, $parp);
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:158: characters 5-11
				++$parp;
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:159: lines 159-167
				if ($c === 40) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:160: characters 6-12
					++$npar;
				} else if ($c === 41) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:162: characters 6-12
					--$npar;
					#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:163: lines 163-164
					if ($npar <= 0) {
						#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:164: characters 7-12
						break;
					}
				} else if ($c === null) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:166: characters 6-11
					throw Exception::thrown("Unclosed macro parenthesis");
				}
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:168: lines 168-173
				if (($c === 44) && ($npar === 1)) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:169: characters 6-23
					$params->arr[$params->length++] = $part;
					#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:170: characters 6-15
					$part = "";
				} else {
					#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:172: characters 6-36
					$part = ($part??'null') . (\mb_chr($c)??'null');
				}
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:175: characters 4-21
			$params->arr[$params->length++] = $part;
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:176: characters 4-61
			$tokens->add(new _HxAnon_Template1(Template::$splitter->matched(2), false, $params));
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:177: characters 11-48
			$data = \mb_substr($data, $parp, mb_strlen($data) - $parp);
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:179: lines 179-180
		if (mb_strlen($data) > 0) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:180: characters 4-43
			$tokens->add(new _HxAnon_Template1($data, true, null));
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:181: characters 3-16
		return $tokens;
	}

	/**
	 * @param string $v
	 * 
	 * @return mixed
	 */
	public function resolve ($v) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:122: lines 122-123
		if ($v === "__current__") {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:123: characters 4-18
			return $this->context;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:124: lines 124-128
		if (Reflect::isObject($this->context)) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:125: characters 4-48
			$value = Reflect::getProperty($this->context, $v);
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:126: lines 126-127
			if (($value !== null) || Reflect::hasField($this->context, $v)) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:127: characters 5-17
				return $value;
			}
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:129: characters 15-20
		$_g_head = $this->stack->h;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:129: lines 129-133
		while ($_g_head !== null) {
			$val = $_g_head->item;
			$_g_head = $_g_head->next;
			$ctx = $val;
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:130: characters 4-44
			$value = Reflect::getProperty($ctx, $v);
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:131: lines 131-132
			if (($value !== null) || Reflect::hasField($ctx, $v)) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:132: characters 5-17
				return $value;
			}
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:134: characters 3-35
		return Reflect::field(Template::$globals, $v);
	}

	/**
	 * @param TemplateExpr $e
	 * 
	 * @return void
	 */
	public function run ($e) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:442: lines 442-506
		$__hx__switch = ($e->index);
		if ($__hx__switch === 0) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:443: characters 15-16
			$v = $e->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:444: characters 5-36
			$this->buf->add(Std::string($this->resolve($v)));
		} else if ($__hx__switch === 1) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:445: characters 16-17
			$e1 = $e->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:446: characters 5-29
			$this->buf->add(Std::string($e1()));
		} else if ($__hx__switch === 2) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:447: characters 14-15
			$e1 = $e->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:447: characters 17-20
			$eif = $e->params[1];
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:447: characters 22-27
			$eelse = $e->params[2];
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:448: characters 5-25
			$v = $e1();
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:449: lines 449-453
			if (($v === null) || ($v === false)) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:450: lines 450-451
				if ($eelse !== null) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:451: characters 7-17
					$this->run($eelse);
				}
			} else {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:453: characters 6-14
				$this->run($eif);
			}
		} else if ($__hx__switch === 3) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:454: characters 15-18
			$str = $e->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:455: characters 5-17
			$this->buf->add($str);
		} else if ($__hx__switch === 4) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:456: characters 17-18
			$l = $e->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:457: characters 15-16
			$_g_head = $l->h;
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:457: lines 457-458
			while ($_g_head !== null) {
				$val = $_g_head->item;
				$_g_head = $_g_head->next;
				$e1 = $val;
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:458: characters 6-12
				$this->run($e1);
			}
		} else if ($__hx__switch === 5) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:459: characters 19-20
			$e1 = $e->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:459: characters 22-26
			$loop = $e->params[1];
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:460: characters 5-25
			$v = $e1();
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:461: lines 461-472
			try {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:462: characters 6-35
				$x = $v->iterator();
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:463: lines 463-464
				if (Boot::dynamicField($x, 'hasNext') === null) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:464: characters 7-12
					throw Exception::thrown(null);
				}
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:465: characters 6-7
				$v = $x;
			} catch(\Throwable $_g) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:466: characters 14-15
				NativeStackTrace::saveStack($_g);
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:467: lines 467-472
				try {
					#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:468: lines 468-469
					if (Boot::dynamicField($v, 'hasNext') === null) {
						#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:469: characters 8-13
						throw Exception::thrown(null);
					}
				} catch(\Throwable $_g) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:471: characters 7-12
					throw Exception::thrown("Cannot iter on " . Std::string($v));
				}
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:473: characters 5-24
			$this->stack->push($this->context);
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:474: characters 5-33
			$v1 = $v;
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:475: characters 17-18
			$ctx = $v1;
			while ($ctx->hasNext()) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:475: lines 475-478
				$ctx1 = $ctx->next();
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:476: characters 6-13
				$this->context = $ctx1;
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:477: characters 6-15
				$this->run($loop);
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:479: characters 5-12
			$this->context = $this->stack->pop();
		} else if ($__hx__switch === 6) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:480: characters 17-18
			$m = $e->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:480: characters 20-26
			$params = $e->params[1];
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:481: characters 5-46
			$v = Reflect::field($this->macros, $m);
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:482: characters 5-35
			$pl = new Array_hx();
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:483: characters 5-19
			$old = $this->buf;
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:484: characters 5-21
			$pl->arr[$pl->length++] = Boot::getInstanceClosure($this, 'resolve');
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:485: characters 15-21
			$_g_head = $params->h;
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:485: lines 485-493
			while ($_g_head !== null) {
				$val = $_g_head->item;
				$_g_head = $_g_head->next;
				$p = $val;
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:486: lines 486-492
				if ($p->index === 0) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:487: characters 18-19
					$v1 = $p->params[0];
					#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:487: characters 22-41
					$x = $this->resolve($v1);
					$pl->arr[$pl->length++] = $x;
				} else {
					#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:489: characters 8-11
					$this->buf = new StringBuf();
					#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:490: characters 8-14
					$this->run($p);
					#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:491: characters 8-31
					$pl->arr[$pl->length++] = $this->buf->b;
				}
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:494: characters 5-8
			$this->buf = $old;
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:495: lines 495-505
			try {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:496: characters 6-60
				$this->buf->add(Std::string(Reflect::callMethod($this->macros, $v, $pl)));
			} catch(\Throwable $_g) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:497: characters 14-15
				NativeStackTrace::saveStack($_g);
				$e = Exception::caught($_g)->unwrap();
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:498: characters 6-59
				$plstr = null;
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:498: characters 18-58
				try {
					#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:498: characters 6-59
					$plstr = $pl->join(",");
				} catch(\Throwable $_g) {
					$plstr = "???";
				}
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:499: characters 6-85
				$msg = "Macro call " . ($m??'null') . "(" . ($plstr??'null') . ") failed (" . Std::string($e) . ")";
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:503: characters 6-11
				throw Exception::thrown($msg);
			}
		}
	}

	/**
	 * @param List_hx $l
	 * 
	 * @return void
	 */
	public function skipSpaces ($l) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:350: characters 3-21
		$p = $l->first();
		#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:351: lines 351-359
		while ($p !== null) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:352: characters 14-17
			$_g_offset = 0;
			$_g_s = $p->p;
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:352: lines 352-356
			while ($_g_offset < mb_strlen($_g_s)) {
				$c = StringTools::unsafeCodeAt($_g_s, $_g_offset++);
				#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:353: lines 353-355
				if ($c !== 32) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:354: characters 6-12
					return;
				}
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:357: characters 4-11
			$l->pop();
			#/home/runner/haxe/versions/4.2.3/std/haxe/Template.hx:358: characters 4-5
			$p = $l->first();
		}
	}

	/**
	 * @internal
	 * @access private
	 */
	static public function __hx__init ()
	{
		static $called = false;
		if ($called) return;
		$called = true;


		self::$splitter = new EReg("(::[A-Za-z0-9_ ()&|!+=/><*.\"-]+::|\\\$\\\$([A-Za-z0-9_-]+)\\()", "");
		self::$expr_splitter = new EReg("(\\(|\\)|[ \x0D\x0A\x09]*\"[^\"]*\"[ \x0D\x0A\x09]*|[!+=/><*.&|-]+)", "");
		self::$expr_trim = new EReg("^[ ]*([^ ]+)[ ]*\$", "");
		self::$expr_int = new EReg("^[0-9]+\$", "");
		self::$expr_float = new EReg("^([+-]?)(?=\\d|,\\d)\\d*(,\\d*)?([Ee]([+-]?\\d+))?\$", "");
		self::$globals = new HxAnon();
		self::$hxKeepArrayIterator = new ArrayIterator(new Array_hx());
	}
}

class _HxAnon_Template0 extends HxAnon {
	function __construct($p, $s) {
		$this->p = $p;
		$this->s = $s;
	}
}

class _HxAnon_Template1 extends HxAnon {
	function __construct($p, $s, $l) {
		$this->p = $p;
		$this->s = $s;
		$this->l = $l;
	}
}

Boot::registerClass(Template::class, 'haxe.Template');
Template::__hx__init();
