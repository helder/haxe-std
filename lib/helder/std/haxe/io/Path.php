<?php
/**
 */

namespace helder\std\haxe\io;

use \helder\std\StringTools;
use \helder\std\php\Boot;
use \helder\std\Array_hx;
use \helder\std\Std;
use \helder\std\php\_Boot\HxString;
use \helder\std\StringBuf;
use \helder\std\EReg;

/**
 * This class provides a convenient way of working with paths. It supports the
 * common path formats:
 * - `directory1/directory2/filename.extension`
 * - `directory1\directory2\filename.extension`
 */
class Path {
	/**
	 * @var bool
	 * `true` if the last directory separator is a backslash, `false` otherwise.
	 */
	public $backslash;
	/**
	 * @var string
	 * The directory.
	 * This is the leading part of the path that is not part of the file name
	 * and the extension.
	 * Does not end with a `/` or `\` separator.
	 * If the path has no directory, the value is `null`.
	 */
	public $dir;
	/**
	 * @var string
	 * The file extension.
	 * It is separated from the file name by a dot. This dot is not part of
	 * the extension.
	 * If the path has no extension, the value is `null`.
	 */
	public $ext;
	/**
	 * @var string
	 * The file name.
	 * This is the part of the part between the directory and the extension.
	 * If there is no file name, e.g. for `".htaccess"` or `"/dir/"`, the value
	 * is the empty String `""`.
	 */
	public $file;

	/**
	 * Adds a trailing slash to `path`, if it does not have one already.
	 * If the last slash in `path` is a backslash, a backslash is appended to
	 * `path`.
	 * If the last slash in `path` is a slash, or if no slash is found, a slash
	 * is appended to `path`. In particular, this applies to the empty String
	 * `""`.
	 * If `path` is `null`, the result is unspecified.
	 * 
	 * @param string $path
	 * 
	 * @return string
	 */
	public static function addTrailingSlash ($path) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:272: lines 272-273
		if (mb_strlen($path) === 0) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:273: characters 4-14
			return "/";
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:274: characters 3-34
		$c1 = HxString::lastIndexOf($path, "/");
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:275: characters 3-35
		$c2 = HxString::lastIndexOf($path, "\\");
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:276: lines 276-286
		if ($c1 < $c2) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:277: lines 277-280
			if ($c2 !== (mb_strlen($path) - 1)) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:278: characters 5-16
				return ($path??'null') . "\\";
			} else {
				#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:280: characters 5-9
				return $path;
			}
		} else if ($c1 !== (mb_strlen($path) - 1)) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:283: characters 5-15
			return ($path??'null') . "/";
		} else {
			#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:285: characters 5-9
			return $path;
		}
	}

	/**
	 * Returns the directory of `path`.
	 * If the directory is `null`, the empty String `""` is returned.
	 * If `path` is `null`, the result is unspecified.
	 * 
	 * @param string $path
	 * 
	 * @return string
	 */
	public static function directory ($path) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:148: characters 3-26
		$s = new Path($path);
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:149: lines 149-150
		if ($s->dir === null) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:150: characters 4-13
			return "";
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:151: characters 3-15
		return $s->dir;
	}

	/**
	 * @param string $path
	 * @param bool $allowSlashes
	 * 
	 * @return string
	 */
	public static function escape ($path, $allowSlashes = false) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:329: lines 329-332
		if ($allowSlashes === null) {
			$allowSlashes = false;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:330: characters 3-76
		$regex = ($allowSlashes ? new EReg("[^A-Za-z0-9_/\\\\\\.]", "g") : new EReg("[^A-Za-z0-9_\\.]", "g"));
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:331: characters 3-79
		return $regex->map($path, function ($v) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:331: characters 38-78
			return "-x" . (HxString::charCodeAt($v->matched(0), 0)??'null');
		});
	}

	/**
	 * Returns the extension of `path`.
	 * If `path` has no extension, the empty String `""` is returned.
	 * If `path` is `null`, the result is unspecified.
	 * 
	 * @param string $path
	 * 
	 * @return string
	 */
	public static function extension ($path) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:162: characters 3-26
		$s = new Path($path);
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:163: lines 163-164
		if ($s->ext === null) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:164: characters 4-13
			return "";
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:165: characters 3-15
		return $s->ext;
	}

	/**
	 * Returns `true` if the path is an absolute path, and `false` otherwise.
	 * 
	 * @param string $path
	 * 
	 * @return bool
	 */
	public static function isAbsolute ($path) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:315: lines 315-316
		if (StringTools::startsWith($path, "/")) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:316: characters 4-15
			return true;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:317: lines 317-318
		if (\mb_substr($path, 1, 1) === ":") {
			#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:318: characters 4-15
			return true;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:319: lines 319-320
		if (StringTools::startsWith($path, "\\\\")) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:320: characters 4-15
			return true;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:321: characters 3-15
		return false;
	}

	/**
	 * Joins all paths in `paths` together.
	 * If `paths` is empty, the empty String `""` is returned. Otherwise the
	 * paths are joined with a slash between them.
	 * If `paths` is `null`, the result is unspecified.
	 * 
	 * @param string[]|Array_hx $paths
	 * 
	 * @return string
	 */
	public static function join ($paths) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:190: characters 15-68
		$result = [];
		$data = $paths->arr;
		$_g_current = 0;
		$_g_length = \count($data);
		$_g_data = $data;
		while ($_g_current < $_g_length) {
			$item = $_g_data[$_g_current++];
			if (($item !== null) && ($item !== "")) {
				$result[] = $item;
			}
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:190: characters 3-69
		$paths = Array_hx::wrap($result);
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:191: lines 191-193
		if ($paths->length === 0) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:192: characters 4-13
			return "";
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:194: characters 3-23
		$path = ($paths->arr[0] ?? null);
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:195: characters 13-17
		$_g = 1;
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:195: characters 17-29
		$_g1 = $paths->length;
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:195: lines 195-198
		while ($_g < $_g1) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:195: characters 13-29
			$i = $_g++;
			#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:196: characters 4-8
			$path = Path::addTrailingSlash($path);
			#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:197: characters 4-20
			$path = ($path??'null') . (($paths->arr[$i] ?? null)??'null');
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:199: characters 3-25
		return Path::normalize($path);
	}

	/**
	 * Normalize a given `path` (e.g. turn `'/usr/local/../lib'` into `'/usr/lib'`).
	 * Also replaces backslashes `\` with slashes `/` and afterwards turns
	 * multiple slashes into a single one.
	 * If `path` is `null`, the result is unspecified.
	 * 
	 * @param string $path
	 * 
	 * @return string
	 */
	public static function normalize ($path) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:211: characters 3-19
		$slash = "/";
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:212: characters 3-38
		$path = HxString::split($path, "\\")->join($slash);
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:213: lines 213-214
		if ($path === $slash) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:214: characters 4-16
			return $slash;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:216: characters 3-19
		$target = new Array_hx();
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:218: lines 218-228
		$_g = 0;
		$_g1 = HxString::split($path, $slash);
		while ($_g < $_g1->length) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:218: characters 8-13
			$token = ($_g1->arr[$_g] ?? null);
			#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:218: lines 218-228
			++$_g;
			#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:219: lines 219-227
			if (($token === "..") && ($target->length > 0) && (($target->arr[$target->length - 1] ?? null) !== "..")) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:220: characters 5-17
				if ($target->length > 0) {
					$target->length--;
				}
				\array_pop($target->arr);
			} else if ($token === "") {
				#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:222: lines 222-224
				if (($target->length > 0) || (HxString::charCodeAt($path, 0) === 47)) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:223: characters 6-24
					$target->arr[$target->length++] = $token;
				}
			} else if ($token !== ".") {
				#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:226: characters 5-23
				$target->arr[$target->length++] = $token;
			}
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:230: characters 3-32
		$tmp = $target->join($slash);
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:231: characters 3-29
		$acc = new StringBuf();
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:232: characters 3-21
		$colon = false;
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:233: characters 3-23
		$slashes = false;
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:238: characters 13-17
		$_g = 0;
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:238: characters 17-27
		$_g1 = mb_strlen($tmp);
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:238: lines 238-254
		while ($_g < $_g1) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:238: characters 13-27
			$i = $_g++;
			#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:239: characters 12-42
			$_g2 = StringTools::fastCodeAt($tmp, $i);
			if ($_g2 === 47) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:244: lines 244-252
				if (!$colon) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:245: characters 6-20
					$slashes = true;
				} else {
					#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:246: characters 10-15
					$i1 = $_g2;
					#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:247: characters 6-19
					$colon = false;
					#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:248: lines 248-251
					if ($slashes) {
						#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:249: characters 7-19
						$acc->add("/");
						#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:250: characters 7-22
						$slashes = false;
					}
					#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:252: characters 6-9
					$acc1 = $acc;
					#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:252: characters 6-20
					$acc1->b = ($acc1->b??'null') . (\mb_chr($i1)??'null');
				}
			} else if ($_g2 === 58) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:242: characters 6-18
				$acc->add(":");
				#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:243: characters 6-18
				$colon = true;
			} else {
				#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:246: characters 10-15
				$i2 = $_g2;
				#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:247: characters 6-19
				$colon = false;
				#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:248: lines 248-251
				if ($slashes) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:249: characters 7-19
					$acc->add("/");
					#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:250: characters 7-22
					$slashes = false;
				}
				#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:252: characters 6-9
				$acc2 = $acc;
				#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:252: characters 6-20
				$acc2->b = ($acc2->b??'null') . (\mb_chr($i2)??'null');
			}
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:256: characters 3-24
		return $acc->b;
	}

	/**
	 * Removes trailing slashes from `path`.
	 * If `path` does not end with a `/` or `\`, `path` is returned unchanged.
	 * Otherwise the substring of `path` excluding the trailing slashes or
	 * backslashes is returned.
	 * If `path` is `null`, the result is unspecified.
	 * 
	 * @param string $path
	 * 
	 * @return string
	 */
	public static function removeTrailingSlashes ($path) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:300: lines 300-307
		while (true) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:301: characters 12-44
			$_g = HxString::charCodeAt($path, mb_strlen($path) - 1);
			#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:301: lines 301-305
			if ($_g === null) {
				#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:305: characters 6-11
				break;
			} else {
				#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:301: characters 12-44
				if ($_g === 47 || $_g === 92) {
					#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:303: characters 6-31
					$path = \mb_substr($path, 0, -1);
				} else {
					#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:305: characters 6-11
					break;
				}
			}
		};
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:308: characters 3-14
		return $path;
	}

	/**
	 * @param string $path
	 * 
	 * @return string
	 */
	public static function unescape ($path) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:325: characters 3-34
		$regex = new EReg("-x([0-9][0-9])", "g");
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:326: characters 3-101
		return $regex->map($path, function ($regex) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:326: characters 49-100
			return \mb_chr(Std::parseInt($regex->matched(1)));
		});
	}

	/**
	 * Returns a String representation of `path` where the extension is `ext`.
	 * If `path` has no extension, `ext` is added as extension.
	 * If `path` or `ext` are `null`, the result is unspecified.
	 * 
	 * @param string $path
	 * @param string $ext
	 * 
	 * @return string
	 */
	public static function withExtension ($path, $ext) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:176: characters 3-26
		$s = new Path($path);
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:177: characters 3-14
		$s->ext = $ext;
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:178: characters 3-22
		return $s->toString();
	}

	/**
	 * Returns the String representation of `path` without the directory.
	 * If `path` is `null`, the result is unspecified.
	 * 
	 * @param string $path
	 * 
	 * @return string
	 */
	public static function withoutDirectory ($path) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:135: characters 3-26
		$s = new Path($path);
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:136: characters 3-15
		$s->dir = null;
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:137: characters 3-22
		return $s->toString();
	}

	/**
	 * Returns the String representation of `path` without the file extension.
	 * If `path` is `null`, the result is unspecified.
	 * 
	 * @param string $path
	 * 
	 * @return string
	 */
	public static function withoutExtension ($path) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:124: characters 3-26
		$s = new Path($path);
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:125: characters 3-15
		$s->ext = null;
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:126: characters 3-22
		return $s->toString();
	}

	/**
	 * Creates a new `Path` instance by parsing `path`.
	 * Path information can be retrieved by accessing the `dir`, `file` and `ext`
	 * properties.
	 * 
	 * @param string $path
	 * 
	 * @return void
	 */
	public function __construct ($path) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:77: lines 77-82
		if ($path === "." || $path === "..") {
			#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:79: characters 5-15
			$this->dir = $path;
			#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:80: characters 5-14
			$this->file = "";
			#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:81: characters 5-11
			return;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:83: characters 3-34
		$c1 = HxString::lastIndexOf($path, "/");
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:84: characters 3-35
		$c2 = HxString::lastIndexOf($path, "\\");
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:85: lines 85-93
		if ($c1 < $c2) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:86: characters 4-28
			$this->dir = \mb_substr($path, 0, $c2);
			#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:87: characters 11-30
			$path = \mb_substr($path, $c2 + 1, null);
			#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:88: characters 4-20
			$this->backslash = true;
		} else if ($c2 < $c1) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:90: characters 4-28
			$this->dir = \mb_substr($path, 0, $c1);
			#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:91: characters 11-30
			$path = \mb_substr($path, $c1 + 1, null);
		} else {
			#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:93: characters 4-14
			$this->dir = null;
		}
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:94: characters 3-34
		$cp = HxString::lastIndexOf($path, ".");
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:95: lines 95-101
		if ($cp !== -1) {
			#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:96: characters 4-29
			$this->ext = \mb_substr($path, $cp + 1, null);
			#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:97: characters 4-29
			$this->file = \mb_substr($path, 0, $cp);
		} else {
			#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:99: characters 4-14
			$this->ext = null;
			#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:100: characters 4-15
			$this->file = $path;
		}
	}

	/**
	 * Returns a String representation of `this` path.
	 * If `this.backslash` is `true`, backslash is used as directory separator,
	 * otherwise slash is used. This only affects the separator between
	 * `this.dir` and `this.file`.
	 * If `this.directory` or `this.extension` is `null`, their representation
	 * is the empty String `""`.
	 * 
	 * @return string
	 */
	public function toString () {
		#/home/runner/haxe/versions/4.2.3/std/haxe/io/Path.hx:115: characters 3-117
		return ((($this->dir === null ? "" : ($this->dir??'null') . ((($this->backslash ? "\\" : "/"))??'null')))??'null') . ($this->file??'null') . ((($this->ext === null ? "" : "." . ($this->ext??'null')))??'null');
	}

	public function __toString() {
		return $this->toString();
	}
}

Boot::registerClass(Path::class, 'haxe.io.Path');
