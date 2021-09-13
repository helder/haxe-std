<?php
/**
 */

namespace helder\std\php;

use \helder\std\haxe\io\_BytesData\Container;
use \helder\std\StringTools;
use \helder\std\php\_Boot\HxAnon;
use \helder\std\haxe\Exception;
use \helder\std\Array_hx;
use \helder\std\Date;
use \helder\std\Std;
use \helder\std\php\_Boot\HxString;
use \helder\std\haxe\ds\List_hx;
use \helder\std\haxe\ds\StringMap;
use \helder\std\haxe\io\Bytes;
use \helder\std\EReg;
use \helder\std\StringBuf;

/**
 * This class is used for accessing the local Web server and the current
 * client request and information.
 */
class Web {
	/**
	 * @var StringMap
	 */
	static public $_clientHeaders;
	/**
	 * @var bool
	 */
	static public $isModNeko;

	/**
	 * Flush the data sent to the client. By default on Apache, outgoing data is buffered so
	 * this can be useful for displaying some long operation progress.
	 * 
	 * @return void
	 */
	public static function flush () {
		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:464: characters 3-17
		\flush();
	}

	/**
	 * Returns an object with the authorization sent by the client (Basic scheme only).
	 * 
	 * @return object
	 */
	public static function getAuthorization () {
		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:361: lines 361-362
		if (!isset($_SERVER["PHP_AUTH_USER"])) {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:362: characters 4-15
			return null;
		}
		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:363: characters 17-41
		$tmp = $_SERVER["PHP_AUTH_USER"];
		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:363: characters 3-72
		return new _HxAnon_Web0($tmp, $_SERVER["PHP_AUTH_PW"]);
	}

	/**
	 * Retrieve a client header value sent with the request.
	 * 
	 * @param string $k
	 * 
	 * @return string
	 */
	public static function getClientHeader ($k) {
		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:231: characters 10-71
		$this1 = Web::loadClientHeaders();
		$key = \str_replace("-", "_", \strtoupper($k));
		return ($this1->data[$key] ?? null);
	}

	/**
	 * Retrieve all the client headers.
	 * 
	 * @return List_hx
	 */
	public static function getClientHeaders () {
		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:285: characters 3-37
		$headers = Web::loadClientHeaders();
		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:286: characters 3-27
		$result = new List_hx();
		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:287: characters 15-29
		$data = \array_values(\array_map("strval", \array_keys($headers->data)));
		$key_current = 0;
		$key_length = \count($data);
		$key_data = $data;
		while ($key_current < $key_length) {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:287: lines 287-289
			$key = $key_data[$key_current++];
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:288: characters 4-55
			$result->push(new _HxAnon_Web1(($headers->data[$key] ?? null), $key));
		}
		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:290: characters 3-16
		return $result;
	}

	/**
	 * Retrieve all the client headers as `haxe.ds.Map`.
	 * 
	 * @return StringMap
	 */
	public static function getClientHeadersMap () {
		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:297: characters 10-36
		return (clone Web::loadClientHeaders());
	}

	/**
	 * Surprisingly returns the client IP address.
	 * 
	 * @return string
	 */
	public static function getClientIP () {
		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:108: characters 10-32
		return $_SERVER["REMOTE_ADDR"];
	}

	/**
	 * Returns an hashtable of all Cookies sent by the client.
	 * Modifying the hashtable will not modify the cookie, use `php.Web.setCookie()`
	 * instead.
	 * 
	 * @return StringMap
	 */
	public static function getCookies () {
		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:338: characters 3-45
		return Lib::hashOfAssociativeArray($_COOKIE);
	}

	/**
	 * Get the current script directory in the local filesystem.
	 * 
	 * @return string
	 */
	public static function getCwd () {
		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:370: characters 3-51
		return (\dirname($_SERVER["SCRIPT_FILENAME"])??'null') . "/";
	}

	/**
	 * Returns the local server host name.
	 * 
	 * @return string
	 */
	public static function getHostName () {
		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:101: characters 10-32
		return $_SERVER["SERVER_NAME"];
	}

	/**
	 * Get the HTTP method used by the client.
	 * 
	 * @return string
	 */
	public static function getMethod () {
		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:471: lines 471-474
		if (isset($_SERVER["REQUEST_METHOD"])) {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:472: characters 11-36
			return $_SERVER["REQUEST_METHOD"];
		} else {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:474: characters 4-15
			return null;
		}
	}

	/**
	 * Get the multipart parameters as an hashtable. The data
	 * cannot exceed the maximum size specified.
	 * 
	 * @param int $maxSize
	 * 
	 * @return StringMap
	 */
	public static function getMultipart ($maxSize) {
		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:378: characters 3-35
		$h = new StringMap();
		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:379: characters 3-28
		$buf = null;
		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:380: characters 3-22
		$curname = null;
		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:381: lines 381-394
		Web::parseMultipart(function ($p, $_) use (&$buf, &$maxSize, &$curname, &$h) {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:382: lines 382-383
			if ($curname !== null) {
				#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:383: characters 5-35
				$h->data[$curname] = $buf->b;
			}
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:384: characters 4-15
			$curname = $p;
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:385: characters 4-25
			$buf = new StringBuf();
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:386: characters 4-31
			$maxSize = $maxSize - \strlen($p);
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:387: lines 387-388
			if ($maxSize < 0) {
				#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:388: characters 5-10
				throw Exception::thrown("Maximum size reached");
			}
		}, function ($str, $pos, $len) use (&$buf, &$maxSize) {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:390: characters 4-18
			$maxSize -= $len;
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:391: lines 391-392
			if ($maxSize < 0) {
				#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:392: characters 5-10
				throw Exception::thrown("Maximum size reached");
			}
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:393: characters 4-40
			$s = $str->toString();
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:393: characters 4-7
			$buf1 = $buf;
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:393: characters 4-40
			$buf1->b = ($buf1->b??'null') . (\mb_substr($s, $pos, $len)??'null');
		});
		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:395: lines 395-396
		if ($curname !== null) {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:396: characters 4-34
			$h->data[$curname] = $buf->b;
		}
		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:397: characters 3-11
		return $h;
	}

	/**
	 * Returns an Array of Strings built using GET / POST values.
	 * If you have in your URL the parameters `a[]=foo;a[]=hello;a[5]=bar;a[3]=baz` then
	 * `php.Web.getParamValues("a")` will return `["foo","hello",null,"baz",null,"bar"]`.
	 * 
	 * @param string $param
	 * 
	 * @return string[]|Array_hx
	 */
	public static function getParamValues ($param) {
		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:63: characters 3-78
		$reg = new EReg("^" . ($param??'null') . "(\\[|%5B)([0-9]*?)(\\]|%5D)=(.*?)\$", "");
		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:64: characters 3-33
		$res = new Array_hx();
		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:65: lines 65-78
		$explore = function ($data) use (&$reg, &$res) {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:66: lines 66-67
			if (($data === null) || (\strlen($data) === 0)) {
				#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:67: characters 5-11
				return;
			}
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:68: lines 68-77
			$_g = 0;
			$_g1 = HxString::split($data, "&");
			while ($_g < $_g1->length) {
				#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:68: characters 9-13
				$part = ($_g1->arr[$_g] ?? null);
				#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:68: lines 68-77
				++$_g;
				#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:69: lines 69-76
				if ($reg->match($part)) {
					#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:70: characters 6-31
					$idx = $reg->matched(2);
					#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:71: characters 6-54
					$val = \urldecode($reg->matched(4));
					#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:72: lines 72-75
					if ($idx === "") {
						#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:73: characters 7-20
						$res->arr[$res->length++] = $val;
					} else {
						#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:75: characters 7-35
						$res->offsetSet(Std::parseInt($idx), $val);
					}
				}
			}
		};
		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:79: characters 3-60
		$explore(StringTools::replace(Web::getParamsString(), ";", "&"));
		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:80: characters 3-25
		$explore(Web::getPostData());
		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:82: lines 82-90
		if ($res->length === 0) {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:83: characters 4-76
			$post = Lib::hashOfAssociativeArray($_POST);
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:84: characters 4-31
			$data = ($post->data[$param] ?? null);
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:85: lines 85-89
			if (\is_array($data)) {
				#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:86: lines 86-88
				$collection = $data;
				foreach ($collection as $key => $value) {
					#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:87: characters 6-22
					$res->offsetSet($key, $value);
				}
			}
		}
		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:92: lines 92-93
		if ($res->length === 0) {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:93: characters 4-15
			return null;
		}
		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:94: characters 3-13
		return $res;
	}

	/**
	 * Returns the GET and POST parameters.
	 * 
	 * @return StringMap
	 */
	public static function getParams () {
		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:53: characters 3-62
		return Lib::hashOfAssociativeArray(\array_merge($_GET, $_POST));
	}

	/**
	 * Returns all the GET parameters `String`
	 * 
	 * @return string
	 */
	public static function getParamsString () {
		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:304: lines 304-307
		if (isset($_SERVER["QUERY_STRING"])) {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:305: characters 11-34
			return $_SERVER["QUERY_STRING"];
		} else {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:307: characters 4-13
			return "";
		}
	}

	/**
	 * Returns all the POST data. POST Data is always parsed as
	 * being application/x-www-form-urlencoded and is stored into
	 * the getParams hashtable. POST Data is maximimized to 256K
	 * unless the content type is multipart/form-data. In that
	 * case, you will have to use `php.Web.getMultipart()` or
	 * `php.Web.parseMultipart()` methods.
	 * 
	 * @return string
	 */
	public static function getPostData () {
		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:319: characters 3-37
		$h = \fopen("php://input", "r");
		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:320: characters 3-20
		$bsize = 8192;
		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:321: characters 3-16
		$max = 32;
		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:322: characters 3-26
		$data = null;
		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:323: characters 3-19
		$counter = 0;
		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:324: lines 324-327
		while (!\feof($h) && ($counter < $max)) {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:325: characters 11-47
			$data = ($data . \fread($h, $bsize));
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:326: characters 4-13
			++$counter;
		}
		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:328: characters 3-12
		\fclose($h);
		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:329: characters 3-14
		return $data;
	}

	/**
	 * Returns the original request URL (before any server internal redirections).
	 * 
	 * @return string
	 */
	public static function getURI () {
		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:115: characters 3-41
		$s = $_SERVER["REQUEST_URI"];
		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:116: characters 3-25
		return (HxString::split($s, "?")->arr[0] ?? null);
	}

	/**
	 * Based on https://github.com/ralouphie/getallheaders
	 * 
	 * @return StringMap
	 */
	public static function loadClientHeaders () {
		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:240: lines 240-241
		if (Web::$_clientHeaders !== null) {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:241: characters 4-25
			return Web::$_clientHeaders;
		}
		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:243: characters 3-29
		Web::$_clientHeaders = new StringMap();
		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:245: lines 245-250
		if (\function_exists("getallheaders")) {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:246: lines 246-248
			$collection = \getallheaders();
			foreach ($collection as $key => $value) {
				#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:247: characters 5-82
				$this1 = Web::$_clientHeaders;
				$key1 = \str_replace("-", "_", \strtoupper($key));
				$value1 = Std::string($value);
				$this1->data[$key1] = $value1;
			}
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:249: characters 4-25
			return Web::$_clientHeaders;
		}
		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:252: lines 252-256
		$copyServer = [
			"CONTENT_TYPE" => "Content-Type",
			"CONTENT_LENGTH" => "Content-Length",
			"CONTENT_MD5" => "Content-Md5",
		];
		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:257: lines 257-266
		$collection = $_SERVER;
		foreach ($collection as $key => $value) {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:258: lines 258-265
			$key1 = $key;
			$value1 = $value;
			if (\substr($key1, 0, 5) === "HTTP_") {
				#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:259: characters 5-25
				$key1 = \substr($key1, 5);
				#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:260: lines 260-262
				if (!isset($copyServer[$key1]) || !isset($_SERVER[$key1])) {
					#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:261: characters 6-45
					$this1 = Web::$_clientHeaders;
					$v = Std::string($value1);
					$this1->data[$key1] = $v;
				}
			} else if (isset($copyServer[$key1])) {
				#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:264: characters 5-44
				$this2 = Web::$_clientHeaders;
				$v1 = Std::string($value1);
				$this2->data[$key1] = $v1;
			}
		}
		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:267: lines 267-276
		if (!\array_key_exists("AUTHORIZATION", Web::$_clientHeaders->data)) {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:268: lines 268-275
			if (isset($_SERVER["REDIRECT_HTTP_AUTHORIZATION"])) {
				#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:269: characters 5-89
				$this1 = Web::$_clientHeaders;
				$v = Std::string($_SERVER["REDIRECT_HTTP_AUTHORIZATION"]);
				$this1->data["AUTHORIZATION"] = $v;
			} else if (isset($_SERVER["PHP_AUTH_USER"])) {
				#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:271: characters 5-94
				$basic_pass = (isset($_SERVER["PHP_AUTH_PW"]) ? Std::string($_SERVER["PHP_AUTH_PW"]) : "");
				#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:272: characters 5-108
				$this1 = Web::$_clientHeaders;
				$v = "Basic " . (\base64_encode(Std::string($_SERVER["PHP_AUTH_USER"]) . ":" . ($basic_pass??'null'))??'null');
				$this1->data["AUTHORIZATION"] = $v;
			} else if (isset($_SERVER["PHP_AUTH_DIGEST"])) {
				#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:274: characters 5-77
				$this1 = Web::$_clientHeaders;
				$v = Std::string($_SERVER["PHP_AUTH_DIGEST"]);
				$this1->data["AUTHORIZATION"] = $v;
			}
		}
		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:278: characters 3-24
		return Web::$_clientHeaders;
	}

	/**
	 * Parse the multipart data. Call `onPart` when a new part is found
	 * with the part name and the filename if present
	 * and `onData` when some part data is readed. You can this way
	 * directly save the data on hard drive in the case of a file upload.
	 * 
	 * @param \Closure $onPart
	 * @param \Closure $onData
	 * 
	 * @return void
	 */
	public static function parseMultipart ($onPart, $onData) {
		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:407: lines 407-410
		$collection = $_POST;
		foreach ($collection as $key => $value) {
			$value1 = $value;
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:408: characters 4-19
			$onPart($key, "");
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:409: characters 4-10
			$onData1 = $onData;
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:409: characters 11-32
			$s = $value1;
			$tmp = \strlen($s);
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:409: characters 4-51
			$onData1(new Bytes($tmp, new Container($s)), 0, \strlen($value1));
		}
		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:412: lines 412-413
		if (!isset($_FILES)) {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:413: characters 4-10
			return;
		}
		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:414: lines 414-456
		$collection = $_FILES;
		foreach ($collection as $key => $value) {
			unset($part);
			$part = $key;
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:415: lines 415-448
			$handleFile = function ($tmp, $file, $err) use (&$onData, &$part, &$onPart) {
				#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:416: characters 5-29
				$fileUploaded = true;
				#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:417: lines 417-434
				if ($err > 0) {
					#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:418: lines 418-433
					if ($err === 1) {
						#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:420: characters 8-13
						throw Exception::thrown("The uploaded file exceeds the max size of " . (\ini_get("upload_max_filesize")??'null'));
					} else if ($err === 2) {
						#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:422: characters 8-13
						throw Exception::thrown("The uploaded file exceeds the max file size directive specified in the HTML form (max is" . (\ini_get("post_max_size")??'null') . ")");
					} else if ($err === 3) {
						#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:424: characters 8-13
						throw Exception::thrown("The uploaded file was only partially uploaded");
					} else if ($err === 4) {
						#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:426: characters 8-20
						$fileUploaded = false;
					} else if ($err === 6) {
						#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:428: characters 8-13
						throw Exception::thrown("Missing a temporary folder");
					} else if ($err === 7) {
						#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:430: characters 8-13
						throw Exception::thrown("Failed to write file to disk");
					} else if ($err === 8) {
						#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:432: characters 8-13
						throw Exception::thrown("File upload stopped by extension");
					}
				}
				#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:435: lines 435-447
				if ($fileUploaded) {
					#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:436: characters 6-24
					$onPart($part, $file);
					#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:437: lines 437-446
					if ("" !== $file) {
						#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:438: characters 7-31
						$h = \fopen($tmp, "r");
						#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:439: characters 7-24
						$bsize = 8192;
						#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:440: lines 440-444
						while (!\feof($h)) {
							#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:441: characters 8-41
							$buf = \fread($h, $bsize);
							#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:442: characters 8-35
							$size = \strlen($buf);
							#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:443: characters 8-14
							$onData1 = $onData;
							#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:443: characters 15-34
							$handleFile = \strlen($buf);
							#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:443: characters 8-44
							$onData1(new Bytes($handleFile, new Container($buf)), 0, $size);
						}
						#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:445: characters 7-16
						\fclose($h);
					}
				}
			};
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:449: lines 449-455
			if (\is_array($value["name"])) {
				#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:450: characters 19-43
				$data = \array_keys($value["name"]);
				$_g_current = 0;
				$_g_length = \count($data);
				$_g_data = $data;
				#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:450: lines 450-452
				while ($_g_current < $_g_length) {
					$index = $_g_data[$_g_current++];
					#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:451: characters 6-84
					$handleFile($value["tmp_name"][$index], $value["name"][$index], $value["error"][$index]);
				}
			} else {
				#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:454: characters 5-62
				$handleFile($value["tmp_name"], $value["name"], $value["error"]);
			}
		}
	}

	/**
	 * Tell the client to redirect to the given url ("Location" header).
	 * 
	 * @param string $url
	 * 
	 * @return void
	 */
	public static function redirect ($url) {
		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:123: characters 3-29
		\header("Location: " . ($url??'null'));
	}

	/**
	 * Set a Cookie value in the HTTP headers. Same remark as `php.Web.setHeader()`.
	 * 
	 * @param string $key
	 * @param string $value
	 * @param Date $expire
	 * @param string $domain
	 * @param string $path
	 * @param bool $secure
	 * @param bool $httpOnly
	 * 
	 * @return void
	 */
	public static function setCookie ($key, $value, $expire = null, $domain = null, $path = null, $secure = null, $httpOnly = null) {
		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:345: characters 3-67
		$t = ($expire === null ? 0 : (int)(($expire->getTime() / 1000.0)));
		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:346: lines 346-347
		if ($path === null) {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:347: characters 4-14
			$path = "/";
		}
		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:348: lines 348-349
		if ($domain === null) {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:349: characters 4-15
			$domain = "";
		}
		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:350: lines 350-351
		if ($secure === null) {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:351: characters 4-18
			$secure = false;
		}
		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:352: lines 352-353
		if ($httpOnly === null) {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:353: characters 4-20
			$httpOnly = false;
		}
		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:354: characters 3-59
		\setcookie($key, $value, $t, $path, $domain, $secure, $httpOnly);
	}

	/**
	 * Set an output header value. If some data have been printed, the headers have
	 * already been sent so this will raise an exception.
	 * 
	 * @param string $h
	 * @param string $v
	 * 
	 * @return void
	 */
	public static function setHeader ($h, $v) {
		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:131: characters 3-19
		\header("" . ($h??'null') . ": " . ($v??'null'));
	}

	/**
	 * Set the HTTP return code. Same remark as `php.Web.setHeader()`.
	 * See status code explanation here: http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html
	 * 
	 * @param int $r
	 * 
	 * @return void
	 */
	public static function setReturnCode ($r) {
		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:139: characters 3-19
		$code = null;
		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:140: lines 140-223
		if ($r === 100) {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:142: characters 5-26
			$code = "100 Continue";
		} else if ($r === 101) {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:144: characters 5-37
			$code = "101 Switching Protocols";
		} else if ($r === 200) {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:146: characters 5-20
			$code = "200 OK";
		} else if ($r === 201) {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:148: characters 5-25
			$code = "201 Created";
		} else if ($r === 202) {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:150: characters 5-26
			$code = "202 Accepted";
		} else if ($r === 203) {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:152: characters 5-47
			$code = "203 Non-Authoritative Information";
		} else if ($r === 204) {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:154: characters 5-28
			$code = "204 No Content";
		} else if ($r === 205) {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:156: characters 5-31
			$code = "205 Reset Content";
		} else if ($r === 206) {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:158: characters 5-33
			$code = "206 Partial Content";
		} else if ($r === 300) {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:160: characters 5-34
			$code = "300 Multiple Choices";
		} else if ($r === 301) {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:162: characters 5-35
			$code = "301 Moved Permanently";
		} else if ($r === 302) {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:164: characters 5-23
			$code = "302 Found";
		} else if ($r === 303) {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:166: characters 5-27
			$code = "303 See Other";
		} else if ($r === 304) {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:168: characters 5-30
			$code = "304 Not Modified";
		} else if ($r === 305) {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:170: characters 5-27
			$code = "305 Use Proxy";
		} else if ($r === 307) {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:172: characters 5-36
			$code = "307 Temporary Redirect";
		} else if ($r === 400) {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:174: characters 5-29
			$code = "400 Bad Request";
		} else if ($r === 401) {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:176: characters 5-30
			$code = "401 Unauthorized";
		} else if ($r === 402) {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:178: characters 5-34
			$code = "402 Payment Required";
		} else if ($r === 403) {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:180: characters 5-27
			$code = "403 Forbidden";
		} else if ($r === 404) {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:182: characters 5-27
			$code = "404 Not Found";
		} else if ($r === 405) {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:184: characters 5-36
			$code = "405 Method Not Allowed";
		} else if ($r === 406) {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:186: characters 5-32
			$code = "406 Not Acceptable";
		} else if ($r === 407) {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:188: characters 5-47
			$code = "407 Proxy Authentication Required";
		} else if ($r === 408) {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:190: characters 5-33
			$code = "408 Request Timeout";
		} else if ($r === 409) {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:192: characters 5-26
			$code = "409 Conflict";
		} else if ($r === 410) {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:194: characters 5-22
			$code = "410 Gone";
		} else if ($r === 411) {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:196: characters 5-33
			$code = "411 Length Required";
		} else if ($r === 412) {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:198: characters 5-37
			$code = "412 Precondition Failed";
		} else if ($r === 413) {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:200: characters 5-42
			$code = "413 Request Entity Too Large";
		} else if ($r === 414) {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:202: characters 5-38
			$code = "414 Request-URI Too Long";
		} else if ($r === 415) {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:204: characters 5-40
			$code = "415 Unsupported Media Type";
		} else if ($r === 416) {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:206: characters 5-49
			$code = "416 Requested Range Not Satisfiable";
		} else if ($r === 417) {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:208: characters 5-36
			$code = "417 Expectation Failed";
		} else if ($r === 500) {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:210: characters 5-39
			$code = "500 Internal Server Error";
		} else if ($r === 501) {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:212: characters 5-33
			$code = "501 Not Implemented";
		} else if ($r === 502) {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:214: characters 5-29
			$code = "502 Bad Gateway";
		} else if ($r === 503) {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:216: characters 5-37
			$code = "503 Service Unavailable";
		} else if ($r === 504) {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:218: characters 5-33
			$code = "504 Gateway Timeout";
		} else if ($r === 505) {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:220: characters 5-44
			$code = "505 HTTP Version Not Supported";
		} else {
			#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:222: characters 5-25
			$code = Std::string($r);
		}
		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:224: characters 3-38
		\header("HTTP/1.1 " . ($code??'null'), true, $r);
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

		#/home/runner/haxe/versions/4.2.3/std/php/Web.hx:480: characters 3-27
		Web::$isModNeko = 0 !== \strncasecmp(\PHP_SAPI, "cli", 3);

	}
}

class _HxAnon_Web0 extends HxAnon {
	function __construct($user, $pass) {
		$this->user = $user;
		$this->pass = $pass;
	}
}

class _HxAnon_Web1 extends HxAnon {
	function __construct($value, $header) {
		$this->value = $value;
		$this->header = $header;
	}
}

Boot::registerClass(Web::class, 'php.Web');
Web::__hx__init();
