<?php
/**
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
	 * @var array
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
	 * @param string[]|Array_hx $args
	 * @param bool $detached
	 * 
	 * @return void
	 */
	public function __construct ($cmd, $args = null, $detached = null) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:125: characters 22-24
		$this->_exitCode = -1;
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:124: characters 21-25
		$this->running = true;
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:123: characters 16-18
		$this->pid = -1;
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:128: lines 128-129
		if ($detached) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:129: characters 4-9
			throw Exception::thrown("Detached process is not supported on this platform");
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:130: characters 3-131
		$descriptors = [["pipe", "r"], ["pipe", "w"], ["pipe", "w"]];
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:131: characters 3-66
		$result = \proc_open($this->buildCmd($cmd, $args), $descriptors, $this->pipes);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:132: lines 132-133
		if ($result === false) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:133: characters 4-9
			throw Exception::thrown(Error::Custom("Failed to start process: " . ($cmd??'null')));
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:134: characters 3-19
		$this->process = $result;
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:136: characters 3-17
		$this->updateStatus();
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:138: characters 3-40
		$this->stdin = new WritablePipe($this->pipes[0]);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:139: characters 3-42
		$this->stdout = new ReadablePipe($this->pipes[1]);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:140: characters 3-42
		$this->stderr = new ReadablePipe($this->pipes[2]);
	}

	/**
	 * @param string $cmd
	 * @param string[]|Array_hx $args
	 * 
	 * @return string
	 */
	public function buildCmd ($cmd, $args = null) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:176: lines 176-177
		if ($args === null) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:177: characters 4-14
			return $cmd;
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:179: characters 18-34
		if (Sys::systemName() === "Windows") {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:181: characters 5-82
			$_this = (Array_hx::wrap([StringTools::replace($cmd, "/", "\\")]))->concat($args);
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:181: characters 76-80
			$escapeMetaCharacters = true;
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:181: characters 5-82
			$f = function ($argument) use (&$escapeMetaCharacters) {
				#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:181: characters 47-72
				return SysTools::quoteWinArg($argument, $escapeMetaCharacters);
			};
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:181: characters 5-82
			$result = [];
			$data = $_this->arr;
			$_g_current = 0;
			$_g_length = \count($data);
			$_g_data = $data;
			while ($_g_current < $_g_length) {
				$item = $_g_data[$_g_current++];
				$result[] = $f($item);
			}
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:181: characters 5-92
			return Array_hx::wrap($result)->join(" ");
		} else {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:183: characters 5-50
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
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:183: characters 5-60
			return Array_hx::wrap($result)->join(" ");
		}
	}

	/**
	 * @return void
	 */
	public function close () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:163: lines 163-164
		if (!$this->running) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:164: characters 4-10
			return;
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:166: characters 16-21
		$data = $this->pipes;
		$_g_current = 0;
		$_g_length = \count($data);
		$_g_data = $data;
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:166: lines 166-167
		while ($_g_current < $_g_length) {
			$pipe = $_g_data[$_g_current++];
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:167: characters 4-23
			\fclose($pipe);
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:168: characters 3-23
		\proc_close($this->process);
	}

	/**
	 * @param bool $block
	 * 
	 * @return int
	 */
	public function exitCode ($block = true) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:147: lines 147-160
		if ($block === null) {
			$block = true;
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:148: lines 148-151
		if (!$block) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:149: characters 4-18
			$this->updateStatus();
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:150: characters 11-39
			if ($this->running) {
				#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:150: characters 22-26
				return null;
			} else {
				#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:150: characters 29-38
				return $this->_exitCode;
			}
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:152: lines 152-158
		while ($this->running) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:153: characters 4-40
			$arr = [$this->process];
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:154: lines 154-156
			try {
				#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:155: characters 5-63
				@\stream_select($arr, $arr, $arr, null);
			} catch(\Throwable $_g) {
			}
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:157: characters 4-18
			$this->updateStatus();
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:159: characters 3-19
		return $this->_exitCode;
	}

	/**
	 * @return int
	 */
	public function getPid () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:144: characters 3-13
		return $this->pid;
	}

	/**
	 * @return void
	 */
	public function kill () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:172: characters 3-27
		\proc_terminate($this->process);
	}

	/**
	 * @return void
	 */
	public function updateStatus () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:188: lines 188-189
		if (!$this->running) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:189: characters 4-10
			return;
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:191: characters 3-42
		$status = \proc_get_status($this->process);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:192: lines 192-193
		if ($status === false) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:193: characters 4-9
			throw Exception::thrown(Error::Custom("Failed to obtain process status"));
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:194: characters 3-48
		$status1 = $status;
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:196: characters 3-22
		$this->pid = $status1["pid"];
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:197: characters 3-30
		$this->running = $status1["running"];
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/io/Process.hx:198: characters 3-33
		$this->_exitCode = $status1["exitcode"];
	}
}

Boot::registerClass(Process::class, 'sys.io.Process');
