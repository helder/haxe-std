<?php
/**
 */

namespace helder\std;

use \helder\std\php\Boot;
use \helder\std\php\_Boot\HxString;
use \helder\std\haxe\Exception as HaxeException;

/**
 * The Date class provides a basic structure for date and time related
 * information. Date instances can be created by
 * - `new Date()` for a specific date,
 * - `Date.now()` to obtain information about the current time,
 * - `Date.fromTime()` with a given timestamp or
 * - `Date.fromString()` by parsing from a String.
 * There are some extra functions available in the `DateTools` class.
 * In the context of Haxe dates, a timestamp is defined as the number of
 * milliseconds elapsed since 1st January 1970 UTC.
 * ## Supported range
 * Due to platform limitations, only dates in the range 1970 through 2038 are
 * supported consistently. Some targets may support dates outside this range,
 * depending on the OS at runtime. The `Date.fromTime` method will not work with
 * timestamps outside the range on any target.
 */
final class Date {
	/**
	 * @var float
	 */
	public $__t;

	/**
	 * @param float $t
	 * 
	 * @return Date
	 */
	public static function fromPhpTime ($t) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Date.hx:112: characters 3-41
		$d = new Date(2000, 1, 1, 0, 0, 0);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Date.hx:113: characters 3-12
		$d->__t = $t;
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Date.hx:114: characters 3-11
		return $d;
	}

	/**
	 * Creates a Date from the formatted string `s`. The following formats are
	 * accepted by the function:
	 * - `"YYYY-MM-DD hh:mm:ss"`
	 * - `"YYYY-MM-DD"`
	 * - `"hh:mm:ss"`
	 * The first two formats expressed a date in local time. The third is a time
	 * relative to the UTC epoch.
	 * 
	 * @param string $s
	 * 
	 * @return Date
	 */
	public static function fromString ($s) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Date.hx:124: characters 11-19
		$__hx__switch = (mb_strlen($s));
		if ($__hx__switch === 8) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Date.hx:126: characters 5-26
			$k = HxString::split($s, ":");
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Date.hx:127: characters 5-115
			return Date::fromTime(Std::parseInt(($k->arr[0] ?? null)) * 3600000. + Std::parseInt(($k->arr[1] ?? null)) * 60000. + Std::parseInt(($k->arr[2] ?? null)) * 1000.);
		} else if ($__hx__switch === 10) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Date.hx:129: characters 5-26
			$k = HxString::split($s, "-");
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Date.hx:130: characters 21-39
			$tmp = Std::parseInt(($k->arr[0] ?? null));
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Date.hx:130: characters 41-63
			$tmp1 = Std::parseInt(($k->arr[1] ?? null)) - 1;
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Date.hx:130: characters 5-93
			return new Date($tmp, $tmp1, Std::parseInt(($k->arr[2] ?? null)), 0, 0, 0);
		} else if ($__hx__switch === 19) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Date.hx:132: characters 5-26
			$k = HxString::split($s, " ");
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Date.hx:133: characters 5-29
			$y = HxString::split(($k->arr[0] ?? null), "-");
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Date.hx:134: characters 5-29
			$t = HxString::split(($k->arr[1] ?? null), ":");
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Date.hx:135: characters 21-39
			$tmp = Std::parseInt(($y->arr[0] ?? null));
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Date.hx:135: characters 41-63
			$tmp1 = Std::parseInt(($y->arr[1] ?? null)) - 1;
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Date.hx:135: characters 65-83
			$tmp2 = Std::parseInt(($y->arr[2] ?? null));
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Date.hx:135: characters 85-103
			$tmp3 = Std::parseInt(($t->arr[0] ?? null));
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Date.hx:135: characters 105-123
			$tmp4 = Std::parseInt(($t->arr[1] ?? null));
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Date.hx:135: characters 5-144
			return new Date($tmp, $tmp1, $tmp2, $tmp3, $tmp4, Std::parseInt(($t->arr[2] ?? null)));
		} else {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/Date.hx:137: characters 5-10
			throw HaxeException::thrown("Invalid date format : " . ($s??'null'));
		}
	}

	/**
	 * Creates a Date from the timestamp (in milliseconds) `t`.
	 * 
	 * @param float $t
	 * 
	 * @return Date
	 */
	public static function fromTime ($t) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Date.hx:118: characters 3-41
		$d = new Date(2000, 1, 1, 0, 0, 0);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Date.hx:119: characters 3-19
		$d->__t = $t / 1000;
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Date.hx:120: characters 3-11
		return $d;
	}

	/**
	 * Returns a Date representing the current local time.
	 * 
	 * @return Date
	 */
	public static function now () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Date.hx:108: characters 3-48
		return Date::fromPhpTime(round(microtime(true), 3));
	}

	/**
	 * Creates a new date object from the given arguments.
	 * The behaviour of a Date instance is only consistent across platforms if
	 * the the arguments describe a valid date.
	 * - month: 0 to 11 (note that this is zero-based)
	 * - day: 1 to 31
	 * - hour: 0 to 23
	 * - min: 0 to 59
	 * - sec: 0 to 59
	 * 
	 * @param int $year
	 * @param int $month
	 * @param int $day
	 * @param int $hour
	 * @param int $min
	 * @param int $sec
	 * 
	 * @return void
	 */
	public function __construct ($year, $month, $day, $hour, $min, $sec) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Date.hx:30: characters 3-53
		$this->__t = mktime($hour, $min, $sec, $month + 1, $day, $year);
	}

	/**
	 * Returns the day of `this` Date (1-31 range) in the local timezone.
	 * 
	 * @return int
	 */
	public function getDate () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Date.hx:51: characters 10-34
		return (int)(date("j", (int)($this->__t)));
	}

	/**
	 * Returns the day of the week of `this` Date (0-6 range, where `0` is Sunday)
	 * in the local timezone.
	 * 
	 * @return int
	 */
	public function getDay () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Date.hx:67: characters 10-34
		return (int)(date("w", (int)($this->__t)));
	}

	/**
	 * Returns the full year of `this` Date (4 digits) in the local timezone.
	 * 
	 * @return int
	 */
	public function getFullYear () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Date.hx:42: characters 10-34
		return (int)(date("Y", (int)($this->__t)));
	}

	/**
	 * Returns the hours of `this` Date (0-23 range) in the local timezone.
	 * 
	 * @return int
	 */
	public function getHours () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Date.hx:55: characters 10-34
		return (int)(date("G", (int)($this->__t)));
	}

	/**
	 * Returns the minutes of `this` Date (0-59 range) in the local timezone.
	 * 
	 * @return int
	 */
	public function getMinutes () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Date.hx:59: characters 10-34
		return (int)(date("i", (int)($this->__t)));
	}

	/**
	 * Returns the month of `this` Date (0-11 range) in the local timezone.
	 * Note that the month number is zero-based.
	 * 
	 * @return int
	 */
	public function getMonth () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Date.hx:46: characters 3-40
		$m = (int)(date("n", (int)($this->__t)));
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Date.hx:47: characters 3-16
		return -1 + $m;
	}

	/**
	 * @return float
	 */
	public function getPhpTime () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Date.hx:38: characters 3-13
		return $this->__t;
	}

	/**
	 * Returns the seconds of `this` Date (0-59 range) in the local timezone.
	 * 
	 * @return int
	 */
	public function getSeconds () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Date.hx:63: characters 10-34
		return (int)(date("s", (int)($this->__t)));
	}

	/**
	 * Returns the timestamp (in milliseconds) of `this` date.
	 * On cpp and neko, this function only has a second resolution, so the
	 * result will always be a multiple of `1000.0`, e.g. `1454698271000.0`.
	 * To obtain the current timestamp with better precision on cpp and neko,
	 * see the `Sys.time` API.
	 * For measuring time differences with millisecond accuracy on
	 * all platforms, see `haxe.Timer.stamp`.
	 * 
	 * @return float
	 */
	public function getTime () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Date.hx:34: characters 3-22
		return $this->__t * 1000.0;
	}

	/**
	 * Returns the time zone difference of `this` Date in the current locale
	 * to UTC, in minutes.
	 * Assuming the function is executed on a machine in a UTC+2 timezone,
	 * `Date.now().getTimezoneOffset()` will return `-120`.
	 * 
	 * @return int
	 */
	public function getTimezoneOffset () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Date.hx:100: characters 3-49
		return -(int)(((int)(date("Z", (int)($this->__t))) / 60));
	}

	/**
	 * Returns the day of `this` Date (1-31 range) in UTC.
	 * 
	 * @return int
	 */
	public function getUTCDate () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Date.hx:80: characters 10-36
		return (int)(gmdate("j", (int)($this->__t)));
	}

	/**
	 * Returns the day of the week of `this` Date (0-6 range, where `0` is Sunday)
	 * in UTC.
	 * 
	 * @return int
	 */
	public function getUTCDay () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Date.hx:96: characters 10-36
		return (int)(gmdate("w", (int)($this->__t)));
	}

	/**
	 * Returns the full year of `this` Date (4 digits) in UTC.
	 * 
	 * @return int
	 */
	public function getUTCFullYear () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Date.hx:71: characters 10-36
		return (int)(gmdate("Y", (int)($this->__t)));
	}

	/**
	 * Returns the hours of `this` Date (0-23 range) in UTC.
	 * 
	 * @return int
	 */
	public function getUTCHours () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Date.hx:84: characters 10-36
		return (int)(gmdate("G", (int)($this->__t)));
	}

	/**
	 * Returns the minutes of `this` Date (0-59 range) in UTC.
	 * 
	 * @return int
	 */
	public function getUTCMinutes () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Date.hx:88: characters 10-36
		return (int)(gmdate("i", (int)($this->__t)));
	}

	/**
	 * Returns the month of `this` Date (0-11 range) in UTC.
	 * Note that the month number is zero-based.
	 * 
	 * @return int
	 */
	public function getUTCMonth () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Date.hx:75: characters 3-42
		$m = (int)(gmdate("n", (int)($this->__t)));
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Date.hx:76: characters 3-16
		return -1 + $m;
	}

	/**
	 * Returns the seconds of `this` Date (0-59 range) in UTC.
	 * 
	 * @return int
	 */
	public function getUTCSeconds () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Date.hx:92: characters 10-36
		return (int)(gmdate("s", (int)($this->__t)));
	}

	/**
	 * Returns a string representation of `this` Date in the local timezone
	 * using the standard format `YYYY-MM-DD HH:MM:SS`. See `DateTools.format` for
	 * other formatting rules.
	 * 
	 * @return string
	 */
	public function toString () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/Date.hx:104: characters 3-39
		return date("Y-m-d H:i:s", (int)($this->__t));
	}

	public function __toString() {
		return $this->toString();
	}
}

Boot::registerClass(Date::class, 'Date');
