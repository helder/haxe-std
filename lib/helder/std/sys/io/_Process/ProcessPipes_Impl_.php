<?php
/**
 */

namespace helder\std\sys\io\_Process;

use \helder\std\php\Boot;

final class ProcessPipes_Impl_ {

	/**
	 * @param mixed[] $this
	 * 
	 * @return mixed
	 */
	public static function get_stderr ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:45: characters 3-17
		return $this1[2];
	}

	/**
	 * @param mixed[] $this
	 * 
	 * @return mixed
	 */
	public static function get_stdin ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:39: characters 3-17
		return $this1[0];
	}

	/**
	 * @param mixed[] $this
	 * 
	 * @return mixed
	 */
	public static function get_stdout ($this1) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:42: characters 3-17
		return $this1[1];
	}
}

Boot::registerClass(ProcessPipes_Impl_::class, 'sys.io._Process.ProcessPipes_Impl_');
Boot::registerGetters('helder\\std\\sys\\io\\_Process\\ProcessPipes_Impl_', [
	'stderr' => true,
	'stdout' => true,
	'stdin' => true
]);
