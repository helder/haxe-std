<?php
/**
 */

namespace helder\std\sys;

use \helder\std\php\_Boot\HxAnon;
use \helder\std\sys\_FileSystem\FileKind;
use \helder\std\php\Boot;
use \helder\std\haxe\Exception;
use \helder\std\Array_hx;
use \helder\std\Date;
use \helder\std\Sys;
use \helder\std\haxe\io\Path;

/**
 * This class provides information about files and directories.
 * If `null` is passed as a file path to any function in this class, the
 * result is unspecified, and may differ from target to target.
 * See `sys.io.File` for the complementary file API.
 */
class FileSystem {
	/**
	 * Returns the full path of the file or directory specified by `relPath`,
	 * which is relative to the current working directory. The path doesn't
	 * have to exist.
	 * 
	 * @param string $relPath
	 * 
	 * @return string
	 */
	public static function absolutePath ($relPath) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/FileSystem.hx:72: lines 72-73
		if (Path::isAbsolute($relPath)) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/FileSystem.hx:73: characters 4-18
			return $relPath;
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/FileSystem.hx:74: characters 3-44
		return Path::join(Array_hx::wrap([
			Sys::getCwd(),
			$relPath,
		]));
	}

	/**
	 * Creates a directory specified by `path`.
	 * This method is recursive: The parent directories don't have to exist.
	 * If the directory cannot be created, an exception is thrown.
	 * 
	 * @param string $path
	 * 
	 * @return void
	 */
	public static function createDirectory ($path) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/FileSystem.hx:99: characters 3-36
		\clearstatcache(true, $path);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/FileSystem.hx:100: lines 100-101
		if (!\is_dir($path)) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/FileSystem.hx:101: characters 4-33
			\mkdir($path, 493, true);
		}
	}

	/**
	 * Deletes the directory specified by `path`. Only empty directories can
	 * be deleted.
	 * If `path` does not denote a valid directory, or if that directory cannot
	 * be deleted, an exception is thrown.
	 * 
	 * @param string $path
	 * 
	 * @return void
	 */
	public static function deleteDirectory ($path) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/FileSystem.hx:109: characters 3-21
		\rmdir($path);
	}

	/**
	 * Deletes the file specified by `path`.
	 * If `path` does not denote a valid file, or if that file cannot be
	 * deleted, an exception is thrown.
	 * 
	 * @param string $path
	 * 
	 * @return void
	 */
	public static function deleteFile ($path) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/FileSystem.hx:105: characters 3-22
		\unlink($path);
	}

	/**
	 * Returns `true` if the file or directory specified by `path` exists.
	 * 
	 * @param string $path
	 * 
	 * @return bool
	 */
	public static function exists ($path) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/FileSystem.hx:37: characters 3-36
		\clearstatcache(true, $path);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/FileSystem.hx:38: characters 3-34
		return \file_exists($path);
	}

	/**
	 * Returns the full path of the file or directory specified by `relPath`,
	 * which is relative to the current working directory. Symlinks will be
	 * followed and the path will be normalized.
	 * 
	 * @param string $relPath
	 * 
	 * @return string
	 */
	public static function fullPath ($relPath) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/FileSystem.hx:68: characters 10-61
		return (\realpath($relPath) ?: null);
	}

	/**
	 * Returns `true` if the file or directory specified by `path` is a directory.
	 * If `path` is not a valid file system entry or if its destination is not
	 * accessible, an exception is thrown.
	 * 
	 * @param string $path
	 * 
	 * @return bool
	 */
	public static function isDirectory ($path) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/FileSystem.hx:94: characters 3-36
		\clearstatcache(true, $path);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/FileSystem.hx:95: characters 3-29
		return \is_dir($path);
	}

	/**
	 * @param string $path
	 * 
	 * @return FileKind
	 */
	public static function kind ($path) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/FileSystem.hx:78: characters 3-36
		\clearstatcache(true, $path);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/FileSystem.hx:79: characters 3-36
		$kind = \filetype($path);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/FileSystem.hx:80: lines 80-81
		if ($kind === false) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/FileSystem.hx:81: characters 4-9
			throw Exception::thrown("Failed to check file type " . ($path??'null'));
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/FileSystem.hx:83: lines 83-90
		if ($kind === "dir") {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/FileSystem.hx:87: characters 5-16
			return FileKind::kdir();
		} else if ($kind === "file") {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/FileSystem.hx:85: characters 5-17
			return FileKind::kfile();
		} else {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/FileSystem.hx:89: characters 5-24
			return FileKind::kother($kind);
		}
	}

	/**
	 * Returns the names of all files and directories in the directory specified
	 * by `path`. `"."` and `".."` are not included in the output.
	 * If `path` does not denote a valid directory, an exception is thrown.
	 * 
	 * @param string $path
	 * 
	 * @return string[]|Array_hx
	 */
	public static function readDirectory ($path) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/FileSystem.hx:113: characters 3-17
		$list = new Array_hx();
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/FileSystem.hx:114: characters 3-34
		$dir = \opendir($path);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/FileSystem.hx:115: characters 3-12
		$file = null;
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/FileSystem.hx:116: lines 116-120
		while (true) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/FileSystem.hx:116: characters 10-38
			$file = \readdir($dir);
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/FileSystem.hx:116: lines 116-120
			if (!($file !== false)) {
				break;
			}
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/FileSystem.hx:117: lines 117-119
			if (($file !== ".") && ($file !== "..")) {
				#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/FileSystem.hx:118: characters 5-20
				$list->arr[$list->length++] = $file;
			}
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/FileSystem.hx:121: characters 3-23
		\closedir($dir);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/FileSystem.hx:122: characters 3-14
		return $list;
	}

	/**
	 * Renames/moves the file or directory specified by `path` to `newPath`.
	 * If `path` is not a valid file system entry, or if it is not accessible,
	 * or if `newPath` is not accessible, an exception is thrown.
	 * 
	 * @param string $path
	 * @param string $newPath
	 * 
	 * @return void
	 */
	public static function rename ($path, $newPath) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/FileSystem.hx:42: characters 3-31
		\rename($path, $newPath);
	}

	/**
	 * Returns `FileStat` information for the file or directory specified by
	 * `path`.
	 * 
	 * @param string $path
	 * 
	 * @return object
	 */
	public static function stat ($path) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/FileSystem.hx:46: characters 3-36
		\clearstatcache(true, $path);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/FileSystem.hx:47: characters 3-32
		$info = \stat($path);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/FileSystem.hx:48: lines 48-49
		if ($info === false) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/FileSystem.hx:49: characters 4-9
			throw Exception::thrown("Unable to stat " . ($path??'null'));
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/FileSystem.hx:50: characters 3-31
		$info1 = $info;
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/FileSystem.hx:55: characters 11-46
		$tmp = Date::fromTime($info1["atime"] * 1000);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/FileSystem.hx:56: characters 11-46
		$tmp1 = Date::fromTime($info1["mtime"] * 1000);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/FileSystem.hx:57: characters 11-46
		$tmp2 = Date::fromTime($info1["ctime"] * 1000);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/FileSystem.hx:52: lines 52-64
		return new _HxAnon_FileSystem0($info1["gid"], $info1["uid"], $tmp, $tmp1, $tmp2, $info1["dev"], $info1["ino"], $info1["nlink"], $info1["rdev"], $info1["size"], $info1["mode"]);
	}
}

class _HxAnon_FileSystem0 extends HxAnon {
	function __construct($gid, $uid, $atime, $mtime, $ctime, $dev, $ino, $nlink, $rdev, $size, $mode) {
		$this->gid = $gid;
		$this->uid = $uid;
		$this->atime = $atime;
		$this->mtime = $mtime;
		$this->ctime = $ctime;
		$this->dev = $dev;
		$this->ino = $ino;
		$this->nlink = $nlink;
		$this->rdev = $rdev;
		$this->size = $size;
		$this->mode = $mode;
	}
}

Boot::registerClass(FileSystem::class, 'sys.FileSystem');
