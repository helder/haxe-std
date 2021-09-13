<?php
/**
 */

namespace helder\std\php;

use \helder\std\haxe\Exception;

/**
 * Session consists of a way to preserve certain data across
 * subsequent accesses.
 */
class Session {
	/**
	 * @var bool
	 */
	static public $started;

	/**
	 * @return void
	 */
	public static function clear () {
		#/home/runner/haxe/versions/4.2.3/std/php/Session.hx:170: characters 3-18
		\session_unset();
	}

	/**
	 * @return void
	 */
	public static function close () {
		#/home/runner/haxe/versions/4.2.3/std/php/Session.hx:174: characters 3-24
		\session_write_close();
		#/home/runner/haxe/versions/4.2.3/std/php/Session.hx:175: characters 3-18
		Session::$started = false;
	}

	/**
	 * @param string $name
	 * 
	 * @return bool
	 */
	public static function exists ($name) {
		#/home/runner/haxe/versions/4.2.3/std/php/Session.hx:151: characters 3-10
		Session::start();
		#/home/runner/haxe/versions/4.2.3/std/php/Session.hx:152: characters 3-42
		return \array_key_exists($name, $_SESSION);
	}

	/**
	 * @param string $name
	 * 
	 * @return mixed
	 */
	public static function get ($name) {
		#/home/runner/haxe/versions/4.2.3/std/php/Session.hx:118: characters 3-10
		Session::start();
		#/home/runner/haxe/versions/4.2.3/std/php/Session.hx:119: lines 119-120
		if (!isset($_SESSION[$name])) {
			#/home/runner/haxe/versions/4.2.3/std/php/Session.hx:120: characters 4-15
			return null;
		}
		#/home/runner/haxe/versions/4.2.3/std/php/Session.hx:121: characters 10-24
		return $_SESSION[$name];
	}

	/**
	 * @return int
	 */
	public static function getCacheExpire () {
		#/home/runner/haxe/versions/4.2.3/std/php/Session.hx:64: characters 3-32
		return \session_cache_expire();
	}

	/**
	 * @return CacheLimiter
	 */
	public static function getCacheLimiter () {
		#/home/runner/haxe/versions/4.2.3/std/php/Session.hx:35: characters 11-34
		$__hx__switch = (\session_cache_limiter());
		if ($__hx__switch === "nocache") {
			#/home/runner/haxe/versions/4.2.3/std/php/Session.hx:41: characters 5-19
			return CacheLimiter::NoCache();
		} else if ($__hx__switch === "private") {
			#/home/runner/haxe/versions/4.2.3/std/php/Session.hx:39: characters 5-19
			return CacheLimiter::Private();
		} else if ($__hx__switch === "private_no_expire") {
			#/home/runner/haxe/versions/4.2.3/std/php/Session.hx:43: characters 5-27
			return CacheLimiter::PrivateNoExpire();
		} else if ($__hx__switch === "public") {
			#/home/runner/haxe/versions/4.2.3/std/php/Session.hx:37: characters 5-18
			return CacheLimiter::Public();
		}
		#/home/runner/haxe/versions/4.2.3/std/php/Session.hx:45: characters 3-14
		return null;
	}

	/**
	 * @return object
	 */
	public static function getCookieParams () {
		#/home/runner/haxe/versions/4.2.3/std/php/Session.hx:142: characters 3-54
		return Boot::createAnon(\session_get_cookie_params());
	}

	/**
	 * @return string
	 */
	public static function getId () {
		#/home/runner/haxe/versions/4.2.3/std/php/Session.hx:84: characters 3-22
		return \session_id();
	}

	/**
	 * @return string
	 */
	public static function getModule () {
		#/home/runner/haxe/versions/4.2.3/std/php/Session.hx:104: characters 3-31
		return \session_module_name();
	}

	/**
	 * @return string
	 */
	public static function getName () {
		#/home/runner/haxe/versions/4.2.3/std/php/Session.hx:80: characters 3-24
		return \session_name();
	}

	/**
	 * @return string
	 */
	public static function getSavePath () {
		#/home/runner/haxe/versions/4.2.3/std/php/Session.hx:94: characters 3-29
		return \session_save_path();
	}

	/**
	 * @param bool $deleteold
	 * 
	 * @return bool
	 */
	public static function regenerateId ($deleteold = null) {
		#/home/runner/haxe/versions/4.2.3/std/php/Session.hx:114: characters 3-42
		return \session_regenerate_id($deleteold);
	}

	/**
	 * @param string $name
	 * 
	 * @return void
	 */
	public static function remove ($name) {
		#/home/runner/haxe/versions/4.2.3/std/php/Session.hx:156: characters 3-10
		Session::start();
		#/home/runner/haxe/versions/4.2.3/std/php/Session.hx:157: characters 3-24
		unset($_SESSION[$name]);
	}

	/**
	 * @param string $name
	 * @param mixed $value
	 * 
	 * @return mixed
	 */
	public static function set ($name, $value) {
		#/home/runner/haxe/versions/4.2.3/std/php/Session.hx:125: characters 3-10
		Session::start();
		#/home/runner/haxe/versions/4.2.3/std/php/Session.hx:126: characters 10-32
		return $_SESSION[$name] = $value;
	}

	/**
	 * @param int $minutes
	 * 
	 * @return void
	 */
	public static function setCacheExpire ($minutes) {
		#/home/runner/haxe/versions/4.2.3/std/php/Session.hx:68: lines 68-69
		if (Session::$started) {
			#/home/runner/haxe/versions/4.2.3/std/php/Session.hx:69: characters 4-9
			throw Exception::thrown("You can't set the cache expire time while the session is already in use");
		}
		#/home/runner/haxe/versions/4.2.3/std/php/Session.hx:70: characters 3-32
		\session_cache_expire($minutes);
	}

	/**
	 * @param CacheLimiter $l
	 * 
	 * @return void
	 */
	public static function setCacheLimiter ($l) {
		#/home/runner/haxe/versions/4.2.3/std/php/Session.hx:49: lines 49-50
		if (Session::$started) {
			#/home/runner/haxe/versions/4.2.3/std/php/Session.hx:50: characters 4-9
			throw Exception::thrown("You can't set the cache limiter while the session is already in use");
		}
		#/home/runner/haxe/versions/4.2.3/std/php/Session.hx:51: lines 51-60
		$__hx__switch = ($l->index);
		if ($__hx__switch === 0) {
			#/home/runner/haxe/versions/4.2.3/std/php/Session.hx:53: characters 5-36
			\session_cache_limiter("public");
		} else if ($__hx__switch === 1) {
			#/home/runner/haxe/versions/4.2.3/std/php/Session.hx:55: characters 5-37
			\session_cache_limiter("private");
		} else if ($__hx__switch === 2) {
			#/home/runner/haxe/versions/4.2.3/std/php/Session.hx:57: characters 5-37
			\session_cache_limiter("nocache");
		} else if ($__hx__switch === 3) {
			#/home/runner/haxe/versions/4.2.3/std/php/Session.hx:59: characters 5-47
			\session_cache_limiter("private_no_expire");
		}
	}

	/**
	 * @param int $lifetime
	 * @param string $path
	 * @param string $domain
	 * @param bool $secure
	 * @param bool $httponly
	 * 
	 * @return void
	 */
	public static function setCookieParams ($lifetime = null, $path = null, $domain = null, $secure = null, $httponly = null) {
		#/home/runner/haxe/versions/4.2.3/std/php/Session.hx:130: lines 130-131
		if (Session::$started) {
			#/home/runner/haxe/versions/4.2.3/std/php/Session.hx:131: characters 4-9
			throw Exception::thrown("You can't set the cookie params while the session is already in use");
		}
		#/home/runner/haxe/versions/4.2.3/std/php/Session.hx:132: characters 3-70
		\session_set_cookie_params($lifetime, $path, $domain, $secure, $httponly);
	}

	/**
	 * @param string $id
	 * 
	 * @return void
	 */
	public static function setId ($id) {
		#/home/runner/haxe/versions/4.2.3/std/php/Session.hx:88: lines 88-89
		if (Session::$started) {
			#/home/runner/haxe/versions/4.2.3/std/php/Session.hx:89: characters 4-9
			throw Exception::thrown("You can't set the session id while the session is already in use");
		}
		#/home/runner/haxe/versions/4.2.3/std/php/Session.hx:90: characters 3-17
		\session_id($id);
	}

	/**
	 * @param string $module
	 * 
	 * @return void
	 */
	public static function setModule ($module) {
		#/home/runner/haxe/versions/4.2.3/std/php/Session.hx:108: lines 108-109
		if (Session::$started) {
			#/home/runner/haxe/versions/4.2.3/std/php/Session.hx:109: characters 4-9
			throw Exception::thrown("You can't set the module while the session is already in use");
		}
		#/home/runner/haxe/versions/4.2.3/std/php/Session.hx:110: characters 3-30
		\session_module_name($module);
	}

	/**
	 * @param string $name
	 * 
	 * @return void
	 */
	public static function setName ($name) {
		#/home/runner/haxe/versions/4.2.3/std/php/Session.hx:74: lines 74-75
		if (Session::$started) {
			#/home/runner/haxe/versions/4.2.3/std/php/Session.hx:75: characters 4-9
			throw Exception::thrown("You can't set the name while the session is already in use");
		}
		#/home/runner/haxe/versions/4.2.3/std/php/Session.hx:76: characters 3-21
		\session_name($name);
	}

	/**
	 * @param \Closure $open
	 * @param \Closure $close
	 * @param \Closure $read
	 * @param \Closure $write
	 * @param \Closure $destroy
	 * @param \Closure $gc
	 * 
	 * @return bool
	 */
	public static function setSaveHandler ($open, $close, $read, $write, $destroy, $gc) {
		#/home/runner/haxe/versions/4.2.3/std/php/Session.hx:147: characters 3-73
		return \session_set_save_handler($open, $close, $read, $write, $destroy, $gc);
	}

	/**
	 * @param string $path
	 * 
	 * @return void
	 */
	public static function setSavePath ($path) {
		#/home/runner/haxe/versions/4.2.3/std/php/Session.hx:98: lines 98-99
		if (Session::$started) {
			#/home/runner/haxe/versions/4.2.3/std/php/Session.hx:99: characters 4-9
			throw Exception::thrown("You can't set the save path while the session is already in use");
		}
		#/home/runner/haxe/versions/4.2.3/std/php/Session.hx:100: characters 3-26
		\session_save_path($path);
	}

	/**
	 * @return void
	 */
	public static function start () {
		#/home/runner/haxe/versions/4.2.3/std/php/Session.hx:163: lines 163-164
		if (Session::$started) {
			#/home/runner/haxe/versions/4.2.3/std/php/Session.hx:164: characters 4-10
			return;
		}
		#/home/runner/haxe/versions/4.2.3/std/php/Session.hx:165: characters 3-17
		Session::$started = true;
		#/home/runner/haxe/versions/4.2.3/std/php/Session.hx:166: characters 3-18
		\session_start();
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

		#/home/runner/haxe/versions/4.2.3/std/php/Session.hx:179: characters 3-28
		Session::$started = isset($_SESSION);

	}
}

Boot::registerClass(Session::class, 'php.Session');
Session::__hx__init();
