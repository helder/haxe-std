<?php
/**
 * Generated by Haxe 4.1.4
 */

namespace helder\std\sys\io;

use \helder\std\StringTools;
use \helder\std\sys\io\_Process\WritablePipe;
use \helder\std\php\Boot;
use \helder\std\haxe\Exception;
use \helder\std\Array_hx;
use \helder\std\haxe\io\Output;
use \helder\std\haxe\io\Error;
use \helder\std\haxe\io\Input;
use \helder\std\Sys;
use \helder\std\haxe\SysTools;
use \helder\std\sys\io\_Process\ReadablePipe;

class Process {
	/**
	 * @var int
	 */
	public $_exitCode;
	/**
	 * @var int
	 */
	public $pid;
	/**
	 * @var mixed
	 */
	public $pipes;
	/**
	 * @var mixed
	 */
	public $process;
	/**
	 * @var bool
	 */
	public $running;
	/**
	 * @var Input
	 */
	public $stderr;
	/**
	 * @var Output
	 */
	public $stdin;
	/**
	 * @var Input
	 */
	public $stdout;

	/**
	 * @param string $cmd
	 * @param Array_hx $args
	 * @param bool $detached
	 * 
	 * @return void
	 */
	public function __construct ($cmd, $args = null, $detached = null) {
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/sys/io/Process.hx:125: characters 22-24
		$this->_exitCode = -1;
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/sys/io/Process.hx:124: characters 21-25
		$this->running = true;
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/sys/io/Process.hx:123: characters 16-18
		$this->pid = -1;
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/sys/io/Process.hx:128: lines 128-129
		if ($detached) {
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/sys/io/Process.hx:129: characters 4-9
			throw Exception::thrown("Detached process is not supported on this platform");
		}
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/sys/io/Process.hx:130: characters 3-131
		$descriptors = [["pipe", "r"], ["pipe", "w"], ["pipe", "w"]];
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/sys/io/Process.hx:131: characters 3-66
		$result = \proc_open($this->buildCmd($cmd, $args), $descriptors, $this->pipes);
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/sys/io/Process.hx:132: lines 132-133
		if ($result === false) {
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/sys/io/Process.hx:133: characters 4-9
			throw Exception::thrown(Error::Custom("Failed to start process: " . ($cmd??'null')));
		}
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/sys/io/Process.hx:134: characters 3-19
		$this->process = $result;
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/sys/io/Process.hx:136: characters 3-17
		$this->updateStatus();
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/sys/io/Process.hx:138: characters 3-40
		$this->stdin = new WritablePipe($this->pipes[0]);
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/sys/io/Process.hx:139: characters 3-42
		$this->stdout = new ReadablePipe($this->pipes[1]);
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/sys/io/Process.hx:140: characters 3-42
		$this->stderr = new ReadablePipe($this->pipes[2]);
	}

	/**
	 * @param string $cmd
	 * @param Array_hx $args
	 * 
	 * @return string
	 */
	public function buildCmd ($cmd, $args = null) {
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/sys/io/Process.hx:174: lines 174-175
		if ($args === null) {
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/sys/io/Process.hx:175: characters 4-14
			return $cmd;
		}
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/sys/io/Process.hx:177: characters 18-34
		if (Sys::systemName() === "Windows") {
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/sys/io/Process.hx:179: characters 5-82
			$_this = (Array_hx::wrap([StringTools::replace($cmd, "/", "\\")]))->concat($args);
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/sys/io/Process.hx:179: characters 76-80
			$escapeMetaCharacters = true;
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/sys/io/Process.hx:179: characters 5-82
			$f = function ($argument) use (&$escapeMetaCharacters) {
				#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/sys/io/Process.hx:179: characters 47-72
				return SysTools::quoteWinArg($argument, $escapeMetaCharacters);
			};
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/sys/io/Process.hx:179: characters 5-82
			$result = [];
			$data = $_this->arr;
			$_g_current = 0;
			$_g_length = \count($data);
			$_g_data = $data;
			while ($_g_current < $_g_length) {
				$item = $_g_data[$_g_current++];
				$result[] = $f($item);
			}
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/sys/io/Process.hx:179: characters 5-92
			return Array_hx::wrap($result)->join(" ");
		} else {
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/sys/io/Process.hx:181: characters 5-50
			$_this = (Array_hx::wrap([$cmd]))->concat($args);
			$f = Boot::getStaticClosure(SysTools::class, 'quoteUnixArg');
			$result = [];
			$data = $_this->arr;
			$_g_current = 0;
			$_g_length = \count($data);
			$_g_data = $data;
			while ($_g_current < $_g_length) {
				$item = $_g_data[$_g_current++];
				$result[] = $f($item);
			}
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/sys/io/Process.hx:181: characters 5-60
			return Array_hx::wrap($result)->join(" ");
		}
	}

	/**
	 * @return void
	 */
	public function close () {
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/sys/io/Process.hx:161: lines 161-162
		if (!$this->running) {
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/sys/io/Process.hx:162: characters 4-10
			return;
		}
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/sys/io/Process.hx:164: characters 16-21
		$data = $this->pipes;
		$_g_current = 0;
		$_g_length = \count($data);
		$_g_data = $data;
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/sys/io/Process.hx:164: lines 164-165
		while ($_g_current < $_g_length) {
			$pipe = $_g_data[$_g_current++];
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/sys/io/Process.hx:165: characters 4-23
			\fclose($pipe);
		}
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/sys/io/Process.hx:166: characters 3-23
		\proc_close($this->process);
	}

	/**
	 * @param bool $block
	 * 
	 * @return int
	 */
	public function exitCode ($block = true) {
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/sys/io/Process.hx:147: lines 147-158
		if ($block === null) {
			$block = true;
		}
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/sys/io/Process.hx:148: lines 148-151
		if (!$block) {
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/sys/io/Process.hx:149: characters 4-18
			$this->updateStatus();
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/sys/io/Process.hx:150: characters 11-39
			if ($this->running) {
				#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/sys/io/Process.hx:150: characters 22-26
				return null;
			} else {
				#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/sys/io/Process.hx:150: characters 29-38
				return $this->_exitCode;
			}
		}
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/sys/io/Process.hx:152: lines 152-156
		while ($this->running) {
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/sys/io/Process.hx:153: characters 4-40
			$arr = [$this->process];
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/sys/io/Process.hx:154: characters 4-62
			@\stream_select($arr, $arr, $arr, null);
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/sys/io/Process.hx:155: characters 4-18
			$this->updateStatus();
		}
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/sys/io/Process.hx:157: characters 3-19
		return $this->_exitCode;
	}

	/**
	 * @return int
	 */
	public function getPid () {
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/sys/io/Process.hx:144: characters 3-13
		return $this->pid;
	}

	/**
	 * @return void
	 */
	public function kill () {
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/sys/io/Process.hx:170: characters 3-27
		\proc_terminate($this->process);
	}

	/**
	 * @return void
	 */
	public function updateStatus () {
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/sys/io/Process.hx:186: lines 186-187
		if (!$this->running) {
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/sys/io/Process.hx:187: characters 4-10
			return;
		}
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/sys/io/Process.hx:189: characters 3-42
		$status = \proc_get_status($this->process);
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/sys/io/Process.hx:190: lines 190-191
		if ($status === false) {
			#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/sys/io/Process.hx:191: characters 4-9
			throw Exception::thrown(Error::Custom("Failed to obtain process status"));
		}
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/sys/io/Process.hx:192: characters 3-48
		$status1 = $status;
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/sys/io/Process.hx:194: characters 3-22
		$this->pid = $status1["pid"];
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/sys/io/Process.hx:195: characters 3-30
		$this->running = $status1["running"];
		#C:\Users\ben\AppData\Roaming/haxe/versions/4.1.4/std/php/_std/sys/io/Process.hx:196: characters 3-33
		$this->_exitCode = $status1["exitcode"];
	}
}

Boot::registerClass(Process::class, 'sys.io.Process');
