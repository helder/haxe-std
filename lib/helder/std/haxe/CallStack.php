<?php
/**
 * Generated by Haxe 4.0.3
 */

namespace helder\std\haxe;

use \helder\std\php\Boot;
use \helder\std\Array_hx;
use \helder\std\php\_Boot\HxString;
use \helder\std\StringBuf;

class CallStack {
	/**
	 * @var mixed
	 */
	static public $lastExceptionTrace;
	/**
	 * @var \Closure
	 * If defined this function will be used to transform call stack entries.
	 * @param String - generated php file name.
	 * @param Int - Line number in generated file.
	 */
	static public $mapPosition;

	/**
	 * @return Array_hx
	 */
	public static function callStack () {
		#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:49: characters 3-78
		return CallStack::makeStack(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS));
	}

	/**
	 * @return Array_hx
	 */
	public static function exceptionStack () {
		#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:53: characters 20-94
		$tmp = null;
		if (CallStack::$lastExceptionTrace === null) {
			#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:53: characters 49-73
			$this1 = [];
			#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:53: characters 20-94
			$tmp = $this1;
		} else {
			$tmp = CallStack::$lastExceptionTrace;
		}
		#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:53: characters 3-95
		return CallStack::makeStack($tmp);
	}

	/**
	 * @param StringBuf $b
	 * @param StackItem $s
	 * 
	 * @return void
	 */
	public static function itemToString ($b, $s) {
		#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:66: lines 66-88
		$__hx__switch = ($s->index);
		if ($__hx__switch === 0) {
			#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:68: characters 5-26
			$b->add("a C function");
		} else if ($__hx__switch === 1) {
			#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:69: characters 16-17
			$m = $s->params[0];
			#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:70: characters 5-21
			$b->add("module ");
			#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:71: characters 5-13
			$b->add($m);

		} else if ($__hx__switch === 2) {
			#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:72: characters 32-33
			$_g3 = $s->params[3];
			#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:72: characters 26-30
			$line = $s->params[2];
			#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:72: characters 20-24
			$file = $s->params[1];
			#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:72: characters 17-18
			$s1 = $s->params[0];
			#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:73: lines 73-76
			if ($s1 !== null) {
				#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:74: characters 6-24
				CallStack::itemToString($b, $s1);
				#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:75: characters 6-17
				$b->add(" (");
			}
			#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:77: characters 5-16
			$b->add($file);
			#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:78: characters 5-20
			$b->add(" line ");
			#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:79: characters 5-16
			$b->add($line);
			#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:80: lines 80-81
			if ($s1 !== null) {
				#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:81: characters 6-16
				$b->add(")");
			}


		} else if ($__hx__switch === 3) {
			#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:82: characters 23-27
			$meth = $s->params[1];
			#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:82: characters 16-21
			$cname = $s->params[0];
			#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:83: characters 5-47
			$b->add(($cname === null ? "<unknown>" : $cname));
			#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:84: characters 5-15
			$b->add(".");
			#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:85: characters 5-16
			$b->add($meth);

		} else if ($__hx__switch === 4) {
			#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:86: characters 23-24
			$n = $s->params[0];
			#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:87: characters 5-28
			$b->add("local function");
		}
	}

	/**
	 * @param mixed $native
	 * 
	 * @return Array_hx
	 */
	public static function makeStack ($native) {
		#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:127: characters 3-19
		$result = new Array_hx();
		#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:128: characters 3-36
		$count = count($native);
		#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:130: lines 130-161
		$_g = 0;
		$_g1 = $count;
		while ($_g < $_g1) {
			$i = $_g++;
			#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:131: characters 4-26
			$entry = $native[$i];
			#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:132: characters 4-20
			$item = null;
			#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:134: lines 134-148
			if (($i + 1) < $count) {
				#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:135: characters 5-30
				$next = $native[$i + 1];
				#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:137: lines 137-138
				if (!isset($next["function"])) {
					#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:138: characters 6-27
					$next["function"] = "";
				}
				#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:139: lines 139-140
				if (!isset($next["class"])) {
					#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:140: characters 6-24
					$next["class"] = "";
				}
				#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:142: lines 142-147
				if (HxString::indexOf($next["function"], "{closure}") >= 0) {
					#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:143: characters 6-28
					$item = StackItem::LocalFunction();
				} else if ((strlen($next["class"]) > 0) && (strlen($next["function"]) > 0)) {
					#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:145: characters 6-49
					$cls = Boot::getClassName($next["class"]);
					#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:146: characters 6-42
					$item = StackItem::Method($cls, $next["function"]);
				}
			}
			#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:149: lines 149-160
			if (isset($entry["file"])) {
				#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:150: lines 150-156
				if (CallStack::$mapPosition !== null) {
					#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:151: characters 6-58
					$pos = (CallStack::$mapPosition)($entry["file"], $entry["line"]);
					#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:152: lines 152-155
					if (($pos !== null) && ($pos->source !== null) && ($pos->originalLine !== null)) {
						#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:153: characters 7-33
						$entry["file"] = $pos->source;
						#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:154: characters 7-39
						$entry["line"] = $pos->originalLine;
					}
				}
				#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:157: characters 5-61
				$result->arr[$result->length] = StackItem::FilePos($item, $entry["file"], $entry["line"]);
				++$result->length;

			} else if ($item !== null) {
				#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:159: characters 5-22
				$result->arr[$result->length] = $item;
				++$result->length;
			}
		}

		#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:163: characters 3-16
		return $result;
	}

	/**
	 * @param \Throwable $e
	 * 
	 * @return void
	 */
	public static function saveExceptionTrace ($e) {
		#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:93: characters 3-36
		CallStack::$lastExceptionTrace = $e->getTrace();
		#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:96: characters 3-80
		$currentTrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
		#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:97: characters 3-42
		$count = count($currentTrace);
		#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:99: lines 99-109
		$_g = -($count - 1);
		$_g1 = 1;
		while ($_g < $_g1) {
			$i = $_g++;
			#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:100: characters 4-82
			$exceptionEntry = end(CallStack::$lastExceptionTrace);
			#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:102: lines 102-108
			if (!isset($exceptionEntry["file"]) || !isset($currentTrace[-$i]["file"])) {
				#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:103: characters 5-41
				array_pop(CallStack::$lastExceptionTrace);
			} else if (Boot::equal($currentTrace[-$i]["file"], $exceptionEntry["file"]) && Boot::equal($currentTrace[-$i]["line"], $exceptionEntry["line"])) {
				#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:105: characters 5-41
				array_pop(CallStack::$lastExceptionTrace);
			} else {
				#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:107: characters 5-10
				break;
			}
		}

		#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:112: characters 3-48
		$count1 = count(CallStack::$lastExceptionTrace);
		#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:113: lines 113-115
		$_g2 = 0;
		$_g3 = $count1;
		while ($_g2 < $_g3) {
			$i1 = $_g2++;
			#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:114: characters 36-53
			$this1 = [];
			#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:114: characters 4-53
			CallStack::$lastExceptionTrace[$i1]["args"] = $this1;

		}

		#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:117: characters 18-49
		$this2 = [];
		#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:117: characters 3-50
		$thrownAt = $this2;
		#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:118: characters 3-28
		$thrownAt["function"] = "";
		#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:119: characters 3-33
		$thrownAt["line"] = $e->getLine();
		#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:120: characters 3-33
		$thrownAt["file"] = $e->getFile();
		#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:121: characters 3-25
		$thrownAt["class"] = "";
		#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:122: characters 22-39
		$this3 = [];
		#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:122: characters 3-39
		$thrownAt["args"] = $this3;

		#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:123: characters 3-53
		array_unshift(CallStack::$lastExceptionTrace, $thrownAt);
	}

	/**
	 * @param Array_hx $stack
	 * 
	 * @return string
	 */
	public static function toString ($stack) {
		#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:57: characters 3-27
		$b = new StringBuf();
		#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:58: lines 58-61
		$_g = 0;
		while ($_g < $stack->length) {
			#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:58: characters 8-9
			$s = ($stack->arr[$_g] ?? null);
			#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:58: lines 58-61
			++$_g;
			#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:59: characters 4-27
			$b->add("\x0ACalled from ");
			#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:60: characters 4-22
			CallStack::itemToString($b, $s);
		}

		#/home/runner/haxe/versions/4.0.3/std/php/_std/haxe/CallStack.hx:62: characters 3-22
		return $b->b;
	}
}

Boot::registerClass(CallStack::class, 'haxe.CallStack');
