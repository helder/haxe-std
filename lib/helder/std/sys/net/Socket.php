<?php
/**
 */

namespace helder\std\sys\net;

use \helder\std\php\_Boot\HxAnon;
use \helder\std\sys\io\FileInput;
use \helder\std\php\Boot;
use \helder\std\haxe\Exception;
use \helder\std\Array_hx;
use \helder\std\haxe\io\Output;
use \helder\std\haxe\io\Error;
use \helder\std\sys\io\FileOutput;
use \helder\std\haxe\io\Input;
use \helder\std\haxe\ds\IntMap;

/**
 * A TCP socket class : allow you to both connect to a given server and exchange messages or start your own server and wait for connections.
 */
class Socket {
	/**
	 * @var mixed
	 */
	public $__s;
	/**
	 * @var mixed
	 * A custom value that can be associated with the socket. Can be used to retrieve your custom infos after a `select`.
	 *
	 */
	public $custom;
	/**
	 * @var Input
	 * The stream on which you can read available data. By default the stream is blocking until the requested data is available,
	 * use `setBlocking(false)` or `setTimeout` to prevent infinite waiting.
	 */
	public $input;
	/**
	 * @var Output
	 * The stream on which you can send data. Please note that in case the output buffer you will block while writing the data, use `setBlocking(false)` or `setTimeout` to prevent that.
	 */
	public $output;
	/**
	 * @var string
	 */
	public $protocol;
	/**
	 * @var mixed
	 */
	public $stream;

	/**
	 * @param bool $r
	 * @param int $code
	 * @param string $msg
	 * 
	 * @return void
	 */
	public static function checkError ($r, $code, $msg) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:150: lines 150-151
		if ($r !== false) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:151: characters 4-10
			return;
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:152: characters 3-8
		throw Exception::thrown(Error::Custom("Error [" . ($code??'null') . "]: " . ($msg??'null')));
	}

	/**
	 * Since PHP 8 sockets are represented as instances of class \Socket
	 * TODO:
	 * rewrite without `cast` after resolving https://github.com/HaxeFoundation/haxe/issues/9964
	 * 
	 * @param mixed $s
	 * 
	 * @return int
	 */
	public static function getSocketId ($s) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:163: characters 10-72
		if (\PHP_VERSION_ID < 80000) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:163: characters 35-48
			return (int)($s);
		} else {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:163: characters 51-72
			return \spl_object_id($s);
		}
	}

	/**
	 * Wait until one of the sockets group is ready for the given operation:
	 * - `read` contains sockets on which we want to wait for available data to be read,
	 * - `write` contains sockets on which we want to wait until we are allowed to write some data to their output buffers,
	 * - `others` contains sockets on which we want to wait for exceptional conditions.
	 * - `select` will block until one of the condition is met, in which case it will return the sockets for which the condition was true.
	 * In case a `timeout` (in seconds) is specified, select might wait at worst until the timeout expires.
	 * 
	 * @param Socket[]|Array_hx $read
	 * @param Socket[]|Array_hx $write
	 * @param Socket[]|Array_hx $others
	 * @param float $timeout
	 * 
	 * @return object
	 */
	public static function select ($read, $write, $others, $timeout = null) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:168: characters 3-40
		$map = new IntMap();
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:181: characters 3-19
		if ($read !== null) {
			$_g = 0;
			while ($_g < $read->length) {
				$s = ($read->arr[$_g] ?? null);
				++$_g;
				$s1 = $s->__s;
				$k = (\PHP_VERSION_ID < 80000 ? (int)($s1) : \spl_object_id($s1));
				$map->data[$k] = $s;
			}
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:182: characters 3-20
		if ($write !== null) {
			$_g = 0;
			while ($_g < $write->length) {
				$s = ($write->arr[$_g] ?? null);
				++$_g;
				$s1 = $s->__s;
				$k = (\PHP_VERSION_ID < 80000 ? (int)($s1) : \spl_object_id($s1));
				$map->data[$k] = $s;
			}
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:183: characters 3-21
		if ($others !== null) {
			$_g = 0;
			while ($_g < $others->length) {
				$s = ($others->arr[$_g] ?? null);
				++$_g;
				$s1 = $s->__s;
				$k = (\PHP_VERSION_ID < 80000 ? (int)($s1) : \spl_object_id($s1));
				$map->data[$k] = $s;
			}
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:186: lines 186-188
		$a = null;
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:186: characters 46-58
		if ($read === null) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:186: lines 186-188
			$a = new Array_hx();
		} else {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:186: characters 46-58
			$_g = new Array_hx();
			$_g1 = 0;
			while ($_g1 < $read->length) {
				$s = ($read->arr[$_g1] ?? null);
				++$_g1;
				$_g->arr[$_g->length++] = $s->__s;
			}
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:186: lines 186-188
			$a = $_g;
		}
		$rawRead = $a->arr;
		$a = null;
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:187: characters 44-57
		if ($write === null) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:186: lines 186-188
			$a = new Array_hx();
		} else {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:187: characters 44-57
			$_g = new Array_hx();
			$_g1 = 0;
			while ($_g1 < $write->length) {
				$s = ($write->arr[$_g1] ?? null);
				++$_g1;
				$_g->arr[$_g->length++] = $s->__s;
			}
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:186: lines 186-188
			$a = $_g;
		}
		$rawWrite = $a->arr;
		$a = null;
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:188: characters 45-59
		if ($others === null) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:186: lines 186-188
			$a = new Array_hx();
		} else {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:188: characters 45-59
			$_g = new Array_hx();
			$_g1 = 0;
			while ($_g1 < $others->length) {
				$s = ($others->arr[$_g1] ?? null);
				++$_g1;
				$_g->arr[$_g->length++] = $s->__s;
			}
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:186: lines 186-188
			$a = $_g;
		}
		$rawOthers = $a->arr;
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:189: characters 3-55
		$sec = ($timeout === null ? null : (int)($timeout));
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:190: characters 3-69
		$usec = ($timeout === null ? 0 : (int)((fmod($timeout, 1) * 1000000)));
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:191: characters 3-71
		$result = \socket_select($rawRead, $rawWrite, $rawOthers, $sec, $usec);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:192: characters 3-52
		Socket::checkError($result, 0, "Error during select call");
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:195: characters 10-30
		$result = Array_hx::wrap($rawRead);
		$_g = new Array_hx();
		$_g1 = 0;
		while ($_g1 < $result->length) {
			$r = ($result->arr[$_g1] ?? null);
			++$_g1;
			$key = (\PHP_VERSION_ID < 80000 ? (int)($r) : \spl_object_id($r));
			$x = ($map->data[$key] ?? null);
			$_g->arr[$_g->length++] = $x;
		}
		$tmp = $_g;
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:196: characters 11-32
		$result = Array_hx::wrap($rawWrite);
		$_g = new Array_hx();
		$_g1 = 0;
		while ($_g1 < $result->length) {
			$r = ($result->arr[$_g1] ?? null);
			++$_g1;
			$key = (\PHP_VERSION_ID < 80000 ? (int)($r) : \spl_object_id($r));
			$x = ($map->data[$key] ?? null);
			$_g->arr[$_g->length++] = $x;
		}
		$tmp1 = $_g;
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:197: characters 12-34
		$result = Array_hx::wrap($rawOthers);
		$_g = new Array_hx();
		$_g1 = 0;
		while ($_g1 < $result->length) {
			$r = ($result->arr[$_g1] ?? null);
			++$_g1;
			$key = (\PHP_VERSION_ID < 80000 ? (int)($r) : \spl_object_id($r));
			$x = ($map->data[$key] ?? null);
			$_g->arr[$_g->length++] = $x;
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:194: lines 194-198
		return new _HxAnon_Socket0($tmp, $tmp1, $_g);
	}

	/**
	 * Creates a new unconnected socket.
	 * 
	 * @return void
	 */
	public function __construct () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:43: characters 3-53
		$this->input = new FileInput(null);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:44: characters 3-55
		$this->output = new FileOutput(null);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:45: characters 3-15
		$this->initSocket();
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:46: characters 3-19
		$this->protocol = "tcp";
	}

	/**
	 * Accept a new connected client. This will return a connected socket on which you can read/write some data.
	 * 
	 * @return Socket
	 */
	public function accept () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:102: characters 3-30
		$r = \socket_accept($this->__s);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:103: characters 3-61
		Socket::checkError($r, 0, "Unable to accept connections on socket");
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:104: characters 3-24
		$s = new Socket();
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:106: characters 3-12
		$s->__s = $r;
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:107: characters 3-20
		$s->assignHandler();
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:108: characters 3-11
		return $s;
	}

	/**
	 * @return void
	 */
	public function assignHandler () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:54: characters 3-37
		$this->stream = \socket_export_stream($this->__s);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:55: characters 19-56
		$this->input->__f = $this->stream;
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:56: characters 19-58
		$this->output->__f = $this->stream;
	}

	/**
	 * Bind the socket to the given host/port so it can afterwards listen for connections there.
	 * 
	 * @param Host $host
	 * @param int $port
	 * 
	 * @return void
	 */
	public function bind ($host, $port) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:97: characters 3-45
		$r = \socket_bind($this->__s, $host->host, $port);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:98: characters 3-44
		Socket::checkError($r, 0, "Unable to bind socket");
	}

	/**
	 * Closes the socket : make sure to properly close all your sockets or you will crash when you run out of file descriptors.
	 * 
	 * @return void
	 */
	public function close () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:60: characters 3-20
		\socket_close($this->__s);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:61: characters 19-54
		$this->input->__f = null;
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:62: characters 19-56
		$this->output->__f = null;
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:63: characters 3-16
		$this->input->close();
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:64: characters 3-17
		$this->output->close();
	}

	/**
	 * Connect to the given server host/port. Throw an exception in case we couldn't successfully connect.
	 * 
	 * @param Host $host
	 * @param int $port
	 * 
	 * @return void
	 */
	public function connect ($host, $port) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:79: characters 3-48
		$r = \socket_connect($this->__s, $host->host, $port);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:80: characters 3-40
		Socket::checkError($r, 0, "Unable to connect");
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:81: characters 3-18
		$this->assignHandler();
	}

	/**
	 * Return the information about our side of a connected socket.
	 * 
	 * @return object
	 */
	public function host () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:119: characters 3-38
		$host = "";
		$port = 0;
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:120: characters 3-47
		$r = \socket_getsockname($this->__s, $host, $port);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:121: characters 3-55
		Socket::checkError($r, 0, "Unable to retrieve the host name");
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:122: characters 3-44
		return new _HxAnon_Socket1(new Host($host), $port);
	}

	/**
	 * @return void
	 */
	public function initSocket () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:50: characters 3-53
		$this->__s = \socket_create(\AF_INET, \SOCK_STREAM, \SOL_TCP);
	}

	/**
	 * Allow the socket to listen for incoming questions. The parameter tells how many pending connections we can have until they get refused. Use `accept()` to accept incoming connections.
	 * 
	 * @param int $connections
	 * 
	 * @return void
	 */
	public function listen ($connections) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:85: characters 3-43
		$r = \socket_listen($this->__s, $connections);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:86: characters 3-49
		Socket::checkError($r, 0, "Unable to listen on socket");
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:87: characters 3-18
		$this->assignHandler();
	}

	/**
	 * Return the information about the other side of a connected socket.
	 * 
	 * @return object
	 */
	public function peer () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:112: characters 3-38
		$host = "";
		$port = 0;
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:113: characters 3-47
		$r = \socket_getpeername($this->__s, $host, $port);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:114: characters 3-55
		Socket::checkError($r, 0, "Unable to retrieve the peer name");
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:115: characters 3-44
		return new _HxAnon_Socket1(new Host($host), $port);
	}

	/**
	 * Read the whole data available on the socket.
	 *Note*: this is **not** meant to be used together with `setBlocking(false)`,
	 * as it will always throw `haxe.io.Error.Blocked`. `input` methods should be used directly instead.
	 * 
	 * @return string
	 */
	public function read () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:68: characters 3-14
		$b = "";
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:69: lines 69-70
		while (!\feof($this->stream)) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:70: characters 4-22
			$b = ($b??'null') . (\fgets($this->stream)??'null');
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:71: characters 3-11
		return $b;
	}

	/**
	 * Change the blocking mode of the socket. A blocking socket is the default behavior. A non-blocking socket will abort blocking operations immediately by throwing a haxe.io.Error.Blocked value.
	 * 
	 * @param bool $b
	 * 
	 * @return void
	 */
	public function setBlocking ($b) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:136: characters 3-64
		$r = ($b ? \socket_set_block($this->__s) : \socket_set_nonblock($this->__s));
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:137: characters 3-45
		Socket::checkError($r, 0, "Unable to set blocking");
	}

	/**
	 * Allows the socket to immediately send the data when written to its output : this will cause less ping but might increase the number of packets / data size, especially when doing a lot of small writes.
	 * 
	 * @param bool $b
	 * 
	 * @return void
	 */
	public function setFastSend ($b) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:141: characters 3-62
		$r = \socket_set_option($this->__s, \SOL_TCP, \TCP_NODELAY, true);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:142: characters 3-58
		Socket::checkError($r, 0, "Unable to set TCP_NODELAY on socket");
	}

	/**
	 * Gives a timeout (in seconds) after which blocking socket operations (such as reading and writing) will abort and throw an exception.
	 * 
	 * @param float $timeout
	 * 
	 * @return void
	 */
	public function setTimeout ($timeout) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:126: characters 3-28
		$s = (int)($timeout);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:127: characters 3-45
		$ms = (int)((($timeout - $s) * 1000000));
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:128: characters 3-75
		$timeOut = [
			"sec" => $s,
			"usec" => $ms,
		];
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:129: characters 3-68
		$r = \socket_set_option($this->__s, \SOL_SOCKET, \SO_RCVTIMEO, $timeOut);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:130: characters 3-52
		Socket::checkError($r, 0, "Unable to set receive timeout");
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:131: characters 3-63
		$r = \socket_set_option($this->__s, \SOL_SOCKET, \SO_SNDTIMEO, $timeOut);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:132: characters 3-49
		Socket::checkError($r, 0, "Unable to set send timeout");
	}

	/**
	 * Shutdown the socket, either for reading or writing.
	 * 
	 * @param bool $read
	 * @param bool $write
	 * 
	 * @return void
	 */
	public function shutdown ($read, $write) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:91: characters 3-61
		$rw = ($read && $write ? 2 : ($write ? 1 : ($read ? 0 : 2)));
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:92: characters 3-36
		$r = \socket_shutdown($this->__s, $rw);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:93: characters 3-41
		Socket::checkError($r, 0, "Unable to shutdown");
	}

	/**
	 * Block until some data is available for read on the socket.
	 * 
	 * @return void
	 */
	public function waitForRead () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:146: characters 3-29
		Socket::select(Array_hx::wrap([$this]), null, null);
	}

	/**
	 * Write the whole data to the socket output.
	 *Note*: this is **not** meant to be used together with `setBlocking(false)`, as
	 * `haxe.io.Error.Blocked` may be thrown mid-write with no indication of how many bytes have been written.
	 * `output.writeBytes()` should be used instead as it returns this information.
	 * 
	 * @param string $content
	 * 
	 * @return void
	 */
	public function write ($content) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/net/Socket.hx:75: characters 3-26
		\fwrite($this->stream, $content);
	}
}

class _HxAnon_Socket0 extends HxAnon {
	function __construct($read, $write, $others) {
		$this->read = $read;
		$this->write = $write;
		$this->others = $others;
	}
}

class _HxAnon_Socket1 extends HxAnon {
	function __construct($host, $port) {
		$this->host = $host;
		$this->port = $port;
	}
}

Boot::registerClass(Socket::class, 'sys.net.Socket');
