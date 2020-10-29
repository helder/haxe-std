<?php
/**
 * Generated by Haxe 4.0.5
 */

namespace helder\std\sys\net;

use \helder\std\php\_Boot\HxAnon;
use \helder\std\sys\io\FileInput;
use \helder\std\php\Boot;
use \helder\std\Array_hx;
use \helder\std\haxe\io\Output;
use \helder\std\haxe\io\Error;
use \helder\std\sys\io\FileOutput;
use \helder\std\haxe\io\Input;
use \helder\std\haxe\ds\IntMap;
use \helder\std\php\_Boot\HxException;

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
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:150: lines 150-151
		if ($r !== false) {
			#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:151: characters 4-10
			return;
		}
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:152: characters 3-8
		throw new HxException(Error::Custom("Error [" . ($code??'null') . "]: " . ($msg??'null')));
	}

	/**
	 * Wait until one of the sockets group is ready for the given operation:
	 * - `read` contains sockets on which we want to wait for available data to be read,
	 * - `write` contains sockets on which we want to wait until we are allowed to write some data to their output buffers,
	 * - `others` contains sockets on which we want to wait for exceptional conditions.
	 * - `select` will block until one of the condition is met, in which case it will return the sockets for which the condition was true.
	 * In case a `timeout` (in seconds) is specified, select might wait at worst until the timeout expires.
	 * 
	 * @param Array_hx $read
	 * @param Array_hx $write
	 * @param Array_hx $others
	 * @param float $timeout
	 * 
	 * @return object
	 */
	public static function select ($read, $write, $others, $timeout = null) {
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:157: characters 3-40
		$map = new IntMap();
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:170: characters 3-19
		if ($read !== null) {
			$_g = 0;
			while ($_g < $read->length) {
				$s = ($read->arr[$_g] ?? null);
				++$_g;
				$k = (int)($s->__s);
				$map->data[$k] = $s;

			}
		}
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:171: characters 3-20
		if ($write !== null) {
			$_g1 = 0;
			while ($_g1 < $write->length) {
				$s1 = ($write->arr[$_g1] ?? null);
				++$_g1;
				$k1 = (int)($s1->__s);
				$map->data[$k1] = $s1;

			}
		}
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:172: characters 3-21
		if ($others !== null) {
			$_g2 = 0;
			while ($_g2 < $others->length) {
				$s2 = ($others->arr[$_g2] ?? null);
				++$_g2;
				$k2 = (int)($s2->__s);
				$map->data[$k2] = $s2;

			}
		}
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:175: lines 175-177
		$a = null;
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:175: characters 46-58
		if ($read === null) {
			#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:175: lines 175-177
			$a = new Array_hx();
		} else {
			#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:175: characters 46-58
			$_g3 = new Array_hx();
			$_g11 = 0;
			while ($_g11 < $read->length) {
				$s3 = ($read->arr[$_g11] ?? null);
				++$_g11;
				$_g3->arr[$_g3->length] = $s3->__s;
				++$_g3->length;

			}

			#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:175: lines 175-177
			$a = $_g3;
		}
		$rawRead = $a->arr;
		$a1 = null;
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:176: characters 44-57
		if ($write === null) {
			#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:175: lines 175-177
			$a1 = new Array_hx();
		} else {
			#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:176: characters 44-57
			$_g4 = new Array_hx();
			$_g12 = 0;
			while ($_g12 < $write->length) {
				$s4 = ($write->arr[$_g12] ?? null);
				++$_g12;
				$_g4->arr[$_g4->length] = $s4->__s;
				++$_g4->length;

			}

			#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:175: lines 175-177
			$a1 = $_g4;
		}
		$rawWrite = $a1->arr;
		$a2 = null;
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:177: characters 45-59
		if ($others === null) {
			#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:175: lines 175-177
			$a2 = new Array_hx();
		} else {
			#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:177: characters 45-59
			$_g5 = new Array_hx();
			$_g13 = 0;
			while ($_g13 < $others->length) {
				$s5 = ($others->arr[$_g13] ?? null);
				++$_g13;
				$_g5->arr[$_g5->length] = $s5->__s;
				++$_g5->length;

			}

			#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:175: lines 175-177
			$a2 = $_g5;
		}
		$rawOthers = $a2->arr;
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:178: characters 3-55
		$sec = ($timeout === null ? null : (int)($timeout));
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:179: characters 3-69
		$usec = ($timeout === null ? 0 : (int)((fmod($timeout, 1) * 1000000)));
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:180: characters 3-71
		$result = socket_select($rawRead, $rawWrite, $rawOthers, $sec, $usec);
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:181: characters 3-52
		Socket::checkError($result, 0, "Error during select call");
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:184: characters 10-30
		$result1 = Array_hx::wrap($rawRead);
		$_g6 = new Array_hx();
		$_g14 = 0;
		while ($_g14 < $result1->length) {
			$r = ($result1->arr[$_g14] ?? null);
			++$_g14;
			$key = (int)($r);
			$x = ($map->data[$key] ?? null);
			$_g6->arr[$_g6->length] = $x;
			++$_g6->length;

		}

		$tmp = $_g6;
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:185: characters 11-32
		$result2 = Array_hx::wrap($rawWrite);
		$_g7 = new Array_hx();
		$_g15 = 0;
		while ($_g15 < $result2->length) {
			$r1 = ($result2->arr[$_g15] ?? null);
			++$_g15;
			$key1 = (int)($r1);
			$x1 = ($map->data[$key1] ?? null);
			$_g7->arr[$_g7->length] = $x1;
			++$_g7->length;

		}

		$tmp1 = $_g7;
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:186: characters 12-34
		$result3 = Array_hx::wrap($rawOthers);
		$_g8 = new Array_hx();
		$_g16 = 0;
		while ($_g16 < $result3->length) {
			$r2 = ($result3->arr[$_g16] ?? null);
			++$_g16;
			$key2 = (int)($r2);
			$x2 = ($map->data[$key2] ?? null);
			$_g8->arr[$_g8->length] = $x2;
			++$_g8->length;

		}

		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:183: lines 183-187
		return new HxAnon([
			"read" => $tmp,
			"write" => $tmp1,
			"others" => $_g8,
		]);
	}

	/**
	 * Creates a new unconnected socket.
	 * 
	 * @return void
	 */
	public function __construct () {
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:43: characters 3-53
		$this->input = new FileInput(null);
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:44: characters 3-55
		$this->output = new FileOutput(null);
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:45: characters 3-15
		$this->initSocket();
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:46: characters 3-19
		$this->protocol = "tcp";
	}

	/**
	 * Accept a new connected client. This will return a connected socket on which you can read/write some data.
	 * 
	 * @return Socket
	 */
	public function accept () {
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:102: characters 3-30
		$r = socket_accept($this->__s);
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:103: characters 3-61
		Socket::checkError($r, 0, "Unable to accept connections on socket");
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:104: characters 3-24
		$s = new Socket();
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:106: characters 3-12
		$s->__s = $r;
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:107: characters 3-20
		$s->assignHandler();
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:108: characters 3-11
		return $s;
	}

	/**
	 * @return void
	 */
	public function assignHandler () {
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:54: characters 3-37
		$this->stream = socket_export_stream($this->__s);
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:55: characters 19-56
		$this->input->__f = $this->stream;
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:56: characters 19-58
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
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:97: characters 3-45
		$r = socket_bind($this->__s, $host->host, $port);
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:98: characters 3-44
		Socket::checkError($r, 0, "Unable to bind socket");
	}

	/**
	 * Closes the socket : make sure to properly close all your sockets or you will crash when you run out of file descriptors.
	 * 
	 * @return void
	 */
	public function close () {
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:60: characters 3-20
		socket_close($this->__s);
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:61: characters 19-54
		$this->input->__f = null;
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:62: characters 19-56
		$this->output->__f = null;
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:63: characters 3-16
		$this->input->close();
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:64: characters 3-17
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
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:79: characters 3-48
		$r = socket_connect($this->__s, $host->host, $port);
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:80: characters 3-40
		Socket::checkError($r, 0, "Unable to connect");
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:81: characters 3-18
		$this->assignHandler();
	}

	/**
	 * Return the information about our side of a connected socket.
	 * 
	 * @return object
	 */
	public function host () {
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:119: characters 3-38
		$host = "";
		$port = 0;
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:120: characters 3-47
		$r = socket_getsockname($this->__s, $host, $port);
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:121: characters 3-55
		Socket::checkError($r, 0, "Unable to retrieve the host name");
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:122: characters 3-44
		return new HxAnon([
			"host" => new Host($host),
			"port" => $port,
		]);
	}

	/**
	 * @return void
	 */
	public function initSocket () {
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:50: characters 3-53
		$this->__s = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
	}

	/**
	 * Allow the socket to listen for incoming questions. The parameter tells how many pending connections we can have until they get refused. Use `accept()` to accept incoming connections.
	 * 
	 * @param int $connections
	 * 
	 * @return void
	 */
	public function listen ($connections) {
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:85: characters 3-43
		$r = socket_listen($this->__s, $connections);
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:86: characters 3-49
		Socket::checkError($r, 0, "Unable to listen on socket");
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:87: characters 3-18
		$this->assignHandler();
	}

	/**
	 * Return the information about the other side of a connected socket.
	 * 
	 * @return object
	 */
	public function peer () {
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:112: characters 3-38
		$host = "";
		$port = 0;
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:113: characters 3-47
		$r = socket_getpeername($this->__s, $host, $port);
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:114: characters 3-55
		Socket::checkError($r, 0, "Unable to retrieve the peer name");
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:115: characters 3-44
		return new HxAnon([
			"host" => new Host($host),
			"port" => $port,
		]);
	}

	/**
	 * Read the whole data available on the socket.
	 *Note*: this is **not** meant to be used together with `setBlocking(false)`,
	 * as it will always throw `haxe.io.Error.Blocked`. `input` methods should be used directly instead.
	 * 
	 * @return string
	 */
	public function read () {
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:68: characters 3-14
		$b = "";
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:69: lines 69-70
		while (!feof($this->stream)) {
			#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:70: characters 4-22
			$b = ($b??'null') . (fgets($this->stream)??'null');
		}
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:71: characters 3-11
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
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:136: characters 3-64
		$r = ($b ? socket_set_block($this->__s) : socket_set_nonblock($this->__s));
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:137: characters 3-45
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
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:141: characters 3-62
		$r = socket_set_option($this->__s, SOL_TCP, TCP_NODELAY, true);
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:142: characters 3-58
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
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:126: characters 3-28
		$s = (int)($timeout);
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:127: characters 3-45
		$ms = (int)((($timeout - $s) * 1000000));
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:128: characters 3-75
		$timeOut = [
			"sec" => $s,
			"usec" => $ms,
		];
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:129: characters 3-68
		$r = socket_set_option($this->__s, SOL_SOCKET, SO_RCVTIMEO, $timeOut);
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:130: characters 3-52
		Socket::checkError($r, 0, "Unable to set receive timeout");
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:131: characters 3-63
		$r = socket_set_option($this->__s, SOL_SOCKET, SO_SNDTIMEO, $timeOut);
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:132: characters 3-49
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
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:91: characters 3-61
		$rw = ($read && $write ? 2 : ($write ? 1 : ($read ? 0 : 2)));
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:92: characters 3-36
		$r = socket_shutdown($this->__s, $rw);
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:93: characters 3-41
		Socket::checkError($r, 0, "Unable to shutdown");
	}

	/**
	 * Block until some data is available for read on the socket.
	 * 
	 * @return void
	 */
	public function waitForRead () {
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:146: characters 3-29
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
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/net/Socket.hx:75: characters 3-26
		fwrite($this->stream, $content);
	}
}

Boot::registerClass(Socket::class, 'sys.net.Socket');
