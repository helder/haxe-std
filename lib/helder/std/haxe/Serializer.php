<?php
/**
 */

namespace helder\std\haxe;

use \helder\std\Reflect;
use \helder\std\php\Boot;
use \helder\std\haxe\ds\ObjectMap;
use \helder\std\Array_hx;
use \helder\std\Date;
use \helder\std\Std;
use \helder\std\haxe\ds\IntMap;
use \helder\std\Type;
use \helder\std\haxe\ds\List_hx;
use \helder\std\haxe\ds\StringMap;
use \helder\std\haxe\io\Bytes;
use \helder\std\StringBuf;

/**
 * The Serializer class can be used to encode values and objects into a `String`,
 * from which the `Unserializer` class can recreate the original representation.
 * This class can be used in two ways:
 * - create a `new Serializer()` instance, call its `serialize()` method with
 * any argument and finally retrieve the String representation from
 * `toString()`
 * - call `Serializer.run()` to obtain the serialized representation of a
 * single argument
 * Serialization is guaranteed to work for all haxe-defined classes, but may
 * or may not work for instances of external/native classes.
 * The specification of the serialization format can be found here:
 * <https://haxe.org/manual/std-serialization-format.html>
 */
class Serializer {
	/**
	 * @var string
	 */
	static public $BASE64 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789%:";
	/**
	 * @var mixed
	 */
	static public $BASE64_CODES = null;
	/**
	 * @var bool
	 * If the values you are serializing can contain circular references or
	 * objects repetitions, you should set `USE_CACHE` to true to prevent
	 * infinite loops.
	 * This may also reduce the size of serialization Strings at the expense of
	 * performance.
	 * This value can be changed for individual instances of `Serializer` by
	 * setting their `useCache` field.
	 */
	static public $USE_CACHE = false;
	/**
	 * @var bool
	 * Use constructor indexes for enums instead of names.
	 * This may reduce the size of serialization Strings, but makes them less
	 * suited for long-term storage: If constructors are removed or added from
	 * the enum, the indices may no longer match.
	 * This value can be changed for individual instances of `Serializer` by
	 * setting their `useEnumIndex` field.
	 */
	static public $USE_ENUM_INDEX = false;

	/**
	 * @var StringBuf
	 */
	public $buf;
	/**
	 * @var mixed[]|Array_hx
	 */
	public $cache;
	/**
	 * @var int
	 */
	public $scount;
	/**
	 * @var StringMap
	 */
	public $shash;
	/**
	 * @var bool
	 * The individual cache setting for `this` Serializer instance.
	 * See `USE_CACHE` for a complete description.
	 */
	public $useCache;
	/**
	 * @var bool
	 * The individual enum index setting for `this` Serializer instance.
	 * See `USE_ENUM_INDEX` for a complete description.
	 */
	public $useEnumIndex;

	/**
	 * Serializes `v` and returns the String representation.
	 * This is a convenience function for creating a new instance of
	 * Serializer, serialize `v` into it and obtain the result through a call
	 * to `toString()`.
	 * 
	 * @param mixed $v
	 * 
	 * @return string
	 */
	public static function run ($v) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:583: characters 3-28
		$s = new Serializer();
		#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:584: characters 3-17
		$s->serialize($v);
		#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:585: characters 3-22
		return $s->toString();
	}

	/**
	 * Creates a new Serializer instance.
	 * Subsequent calls to `this.serialize` will append values to the
	 * internal buffer of this String. Once complete, the contents can be
	 * retrieved through a call to `this.toString`.
	 * Each `Serializer` instance maintains its own cache if `this.useCache` is
	 * `true`.
	 * 
	 * @return void
	 */
	public function __construct () {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:104: characters 3-24
		$this->buf = new StringBuf();
		#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:105: characters 3-22
		$this->cache = new Array_hx();
		#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:106: characters 3-23
		$this->useCache = Serializer::$USE_CACHE;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:107: characters 3-32
		$this->useEnumIndex = Serializer::$USE_ENUM_INDEX;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:108: characters 3-34
		$this->shash = new StringMap();
		#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:109: characters 3-13
		$this->scount = 0;
	}

	/**
	 * Serializes `v`.
	 * All haxe-defined values and objects with the exception of functions can
	 * be serialized. Serialization of external/native objects is not
	 * guaranteed to work.
	 * The values of `this.useCache` and `this.useEnumIndex` may affect
	 * serialization output.
	 * 
	 * @param mixed $v
	 * 
	 * @return void
	 */
	public function serialize ($v) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:230: characters 11-25
		$_g = Type::typeof($v);
		$__hx__switch = ($_g->index);
		if ($__hx__switch === 0) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:232: characters 5-17
			$this->buf->add("n");
		} else if ($__hx__switch === 1) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:234: characters 5-19
			$v1 = $v;
			#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:235: lines 235-238
			if ($v1 === 0) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:236: characters 6-18
				$this->buf->add("z");
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:237: characters 6-12
				return;
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:239: characters 5-17
			$this->buf->add("i");
			#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:240: characters 5-15
			$this->buf->add($v1);
		} else if ($__hx__switch === 2) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:242: characters 5-21
			$v1 = $v;
			#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:243: lines 243-250
			if (\is_nan($v1)) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:244: characters 6-18
				$this->buf->add("k");
			} else if (!\is_finite($v1)) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:246: characters 6-38
				$this->buf->add(($v1 < 0 ? "m" : "p"));
			} else {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:248: characters 6-18
				$this->buf->add("d");
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:249: characters 6-16
				$this->buf->add($v1);
			}
		} else if ($__hx__switch === 3) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:252: characters 5-33
			$this->buf->add(($v ? "t" : "f"));
		} else if ($__hx__switch === 4) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:413: lines 413-432
			if (Boot::isOfType($v, Boot::getClass('Class'))) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:414: characters 6-43
				$className = Type::getClassName($v);
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:422: characters 6-18
				$this->buf->add("A");
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:423: characters 6-32
				$this->serializeString($className);
			} else if (Boot::isOfType($v, Boot::getClass('Enum'))) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:425: characters 6-18
				$this->buf->add("B");
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:426: characters 6-42
				$this->serializeString(Type::getEnumName($v));
			} else {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:428: lines 428-429
				if ($this->useCache && $this->serializeRef($v)) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:429: characters 7-13
					return;
				}
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:430: characters 6-18
				$this->buf->add("o");
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:431: characters 6-24
				$this->serializeFields($v);
			}
		} else if ($__hx__switch === 5) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:543: characters 5-10
			throw Exception::thrown("Cannot serialize function");
		} else if ($__hx__switch === 6) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:253: characters 16-17
			$c = $_g->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:254: lines 254-257
			if ($c === Boot::getClass('String')) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:255: characters 6-24
				$this->serializeString($v);
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:256: characters 6-12
				return;
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:258: lines 258-259
			if ($this->useCache && $this->serializeRef($v)) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:259: characters 6-12
				return;
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:260: lines 260-411
			if ($c === Boot::getClass(Array_hx::class)) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:262: characters 7-22
				$ucount = 0;
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:263: characters 7-19
				$this->buf->add("a");
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:267: lines 267-268
				$l = Boot::dynamicField($v, 'length');
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:269: characters 17-21
				$_g1 = 0;
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:269: characters 21-22
				$_g2 = $l;
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:269: lines 269-284
				while ($_g1 < $_g2) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:269: characters 17-22
					$i = $_g1++;
					#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:270: lines 270-283
					if ($v[$i] === null) {
						#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:271: characters 9-17
						++$ucount;
					} else {
						#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:273: lines 273-281
						if ($ucount > 0) {
							#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:274: lines 274-279
							if ($ucount === 1) {
								#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:275: characters 11-23
								$this->buf->add("n");
							} else {
								#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:277: characters 11-23
								$this->buf->add("u");
								#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:278: characters 11-26
								$this->buf->add($ucount);
							}
							#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:280: characters 10-16
							$ucount = 0;
						}
						#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:282: characters 9-24
						$this->serialize($v[$i]);
					}
				}
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:285: lines 285-292
				if ($ucount > 0) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:286: lines 286-291
					if ($ucount === 1) {
						#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:287: characters 9-21
						$this->buf->add("n");
					} else {
						#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:289: characters 9-21
						$this->buf->add("u");
						#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:290: characters 9-24
						$this->buf->add($ucount);
					}
				}
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:293: characters 7-19
				$this->buf->add("h");
			} else if ($c === Boot::getClass(Date::class)) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:301: characters 7-22
				$d = $v;
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:302: characters 7-19
				$this->buf->add("v");
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:303: characters 7-27
				$this->buf->add($d->getTime());
			} else if ($c === Boot::getClass(IntMap::class)) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:313: characters 7-19
				$this->buf->add("q");
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:314: characters 7-41
				$v1 = $v;
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:315: characters 17-25
				$data = \array_keys($v1->data);
				$_g_current = 0;
				$_g_length = \count($data);
				$_g_data = $data;
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:315: lines 315-319
				while ($_g_current < $_g_length) {
					$k = $_g_data[$_g_current++];
					#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:316: characters 8-20
					$this->buf->add(":");
					#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:317: characters 8-18
					$this->buf->add($k);
					#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:318: characters 8-27
					$this->serialize(($v1->data[$k] ?? null));
				}
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:320: characters 7-19
				$this->buf->add("h");
			} else if ($c === Boot::getClass(List_hx::class)) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:295: characters 7-19
				$this->buf->add("l");
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:296: characters 7-31
				$v1 = $v;
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:297: characters 17-18
				$_g_head = $v1->h;
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:297: lines 297-298
				while ($_g_head !== null) {
					$val = $_g_head->item;
					$_g_head = $_g_head->next;
					$i = $val;
					#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:298: characters 8-20
					$this->serialize($i);
				}
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:299: characters 7-19
				$this->buf->add("h");
			} else if ($c === Boot::getClass(ObjectMap::class)) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:322: characters 7-19
				$this->buf->add("M");
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:323: characters 7-53
				$v1 = $v;
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:324: characters 17-25
				$data = \array_values($v1->_keys);
				$_g_current = 0;
				$_g_length = \count($data);
				$_g_data = $data;
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:324: lines 324-334
				while ($_g_current < $_g_length) {
					$k = $_g_data[$_g_current++];
					#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:331: characters 8-20
					$this->serialize($k);
					#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:333: characters 8-27
					$this->serialize($v1->get($k));
				}
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:335: characters 7-19
				$this->buf->add("h");
			} else if ($c === Boot::getClass(StringMap::class)) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:305: characters 7-19
				$this->buf->add("b");
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:306: characters 7-44
				$v1 = $v;
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:307: characters 17-25
				$data = \array_values(\array_map("strval", \array_keys($v1->data)));
				$_g_current = 0;
				$_g_length = \count($data);
				$_g_data = $data;
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:307: lines 307-310
				while ($_g_current < $_g_length) {
					$k = $_g_data[$_g_current++];
					#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:308: characters 8-26
					$this->serializeString($k);
					#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:309: characters 8-27
					$this->serialize(($v1->data[$k] ?? null));
				}
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:311: characters 7-19
				$this->buf->add("h");
			} else if ($c === Boot::getClass(Bytes::class)) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:337: characters 7-31
				$v1 = $v;
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:345: characters 7-69
				$chars = \base64_encode($v1->b->s);
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:346: characters 7-12
				$chars = \strtr($chars, "+/", "%:");
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:347: characters 7-19
				$this->buf->add("s");
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:348: characters 7-28
				$this->buf->add(mb_strlen($chars));
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:349: characters 7-19
				$this->buf->add(":");
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:350: characters 7-21
				$this->buf->add($chars);
			} else {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:388: characters 7-32
				if ($this->useCache) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:388: characters 21-32
					$_this = $this->cache;
					if ($_this->length > 0) {
						$_this->length--;
					}
					\array_pop($_this->arr);
				}
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:389: lines 389-410
				if (\method_exists($v, "hxSerialize")) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:394: characters 8-20
					$this->buf->add("C");
					#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:395: characters 8-45
					$this->serializeString(Type::getClassName($c));
					#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:396: lines 396-397
					if ($this->useCache) {
						#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:397: characters 9-22
						$_this = $this->cache;
						$_this->arr[$_this->length++] = $v;
					}
					#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:398: characters 8-27
					$v->hxSerialize($this);
					#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:399: characters 8-20
					$this->buf->add("g");
				} else {
					#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:401: characters 8-20
					$this->buf->add("c");
					#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:402: characters 8-45
					$this->serializeString(Type::getClassName($c));
					#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:403: lines 403-404
					if ($this->useCache) {
						#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:404: characters 9-22
						$_this = $this->cache;
						$_this->arr[$_this->length++] = $v;
					}
					#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:408: characters 8-26
					$this->serializeFields($v);
				}
			}
		} else if ($__hx__switch === 7) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:433: characters 15-16
			$e = $_g->params[0];
			#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:434: lines 434-438
			if ($this->useCache) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:435: lines 435-436
				if ($this->serializeRef($v)) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:436: characters 7-13
					return;
				}
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:437: characters 6-17
				$_this = $this->cache;
				if ($_this->length > 0) {
					$_this->length--;
				}
				\array_pop($_this->arr);
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:439: characters 5-38
			$this->buf->add(($this->useEnumIndex ? "j" : "w"));
			#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:440: characters 5-41
			$this->serializeString(Type::getEnumName($e));
			#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:485: lines 485-489
			if ($this->useEnumIndex) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:486: characters 6-18
				$this->buf->add(":");
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:487: characters 6-22
				$this->buf->add(Boot::dynamicField($v, 'index'));
			} else {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:489: characters 6-28
				$this->serializeString(Boot::dynamicField($v, 'tag'));
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:490: characters 5-17
			$this->buf->add(":");
			#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:491: characters 5-57
			$l = count(Boot::dynamicField($v, 'params'));
			#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:492: lines 492-501
			if (($l === 0) || (Boot::dynamicField($v, 'params') === null)) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:493: characters 6-16
				$this->buf->add(0);
			} else {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:495: characters 6-16
				$this->buf->add($l);
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:496: characters 16-20
				$_g = 0;
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:496: characters 20-21
				$_g1 = $l;
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:496: lines 496-500
				while ($_g < $_g1) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:496: characters 16-21
					$i = $_g++;
					#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:498: characters 7-29
					$this->serialize(Boot::dynamicField($v, 'params')[$i]);
				}
			}
			#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:540: lines 540-541
			if ($this->useCache) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:541: characters 6-19
				$_this = $this->cache;
				$_this->arr[$_this->length++] = $v;
			}
		} else {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:552: characters 5-10
			throw Exception::thrown("Cannot serialize " . Std::string($v));
		}
	}

	/**
	 * @param mixed $e
	 * 
	 * @return void
	 */
	public function serializeException ($e) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:560: characters 3-15
		$this->buf->add("x");
		#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:572: characters 3-15
		$this->serialize($e);
	}

	/**
	 * @param object $v
	 * 
	 * @return void
	 */
	public function serializeFields ($v) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:212: lines 212-215
		$_g = 0;
		$_g1 = Reflect::fields($v);
		while ($_g < $_g1->length) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:212: characters 8-9
			$f = ($_g1->arr[$_g] ?? null);
			#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:212: lines 212-215
			++$_g;
			#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:213: characters 4-22
			$this->serializeString($f);
			#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:214: characters 4-34
			$this->serialize(Reflect::field($v, $f));
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:216: characters 3-15
		$this->buf->add("g");
	}

	/**
	 * @param mixed $v
	 * 
	 * @return bool
	 */
	public function serializeRef ($v) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:178: characters 13-17
		$_g = 0;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:178: characters 17-29
		$_g1 = $this->cache->length;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:178: lines 178-189
		while ($_g < $_g1) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:178: characters 13-29
			$i = $_g++;
			#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:183: lines 183-188
			if (Boot::equal(($this->cache->arr[$i] ?? null), $v)) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:185: characters 5-17
				$this->buf->add("r");
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:186: characters 5-15
				$this->buf->add($i);
				#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:187: characters 5-16
				return true;
			}
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:190: characters 3-16
		$_this = $this->cache;
		$_this->arr[$_this->length++] = $v;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:191: characters 3-15
		return false;
	}

	/**
	 * @param string $s
	 * 
	 * @return void
	 */
	public function serializeString ($s) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:155: characters 3-24
		$x = ($this->shash->data[$s] ?? null);
		#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:156: lines 156-160
		if ($x !== null) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:157: characters 4-16
			$this->buf->add("R");
			#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:158: characters 4-14
			$this->buf->add($x);
			#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:159: characters 4-10
			return;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:161: characters 3-25
		$this->shash->data[$s] = $this->scount++;
		#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:167: characters 3-15
		$this->buf->add("y");
		#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:168: characters 3-31
		$s = \rawurlencode($s);
		#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:169: characters 3-20
		$this->buf->add(mb_strlen($s));
		#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:170: characters 3-15
		$this->buf->add(":");
		#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:171: characters 3-13
		$this->buf->add($s);
	}

	/**
	 * Return the String representation of `this` Serializer.
	 * The exact format specification can be found here:
	 * https://haxe.org/manual/serialization/format
	 * 
	 * @return string
	 */
	public function toString () {
		#/home/runner/haxe/versions/4.2.3/std/haxe/Serializer.hx:119: characters 3-24
		return $this->buf->b;
	}

	public function __toString() {
		return $this->toString();
	}
}

Boot::registerClass(Serializer::class, 'haxe.Serializer');
