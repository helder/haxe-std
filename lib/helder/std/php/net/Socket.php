<?php
/**
 */

namespace helder\std\php\net;

use \helder\std\php\_Boot\HxAnon;
use \helder\std\php\Boot;
use \helder\std\sys\net\Socket as NetSocket;
use \helder\std\Array_hx;
use \helder\std\Std;
use \helder\std\php\_Boot\HxString;
use \helder\std\sys\net\Host;
use \helder\std\haxe\exceptions\NotImplementedException;

class Socket extends NetSocket {
	/**
	 * @var bool
	 */
	public $connected;
	/**
	 * @var float
	 */
	public $timeout;

	/**
	 * @param bool $r
	 * @param int $code
	 * @param string $msg
	 * 
	 * @return void
	 */
	public static function checkError ($r, $code, $msg) {
		#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:163: characters 10-49
		NetSocket::checkError($r, $code, $msg);
	}

	/**
	 * @param string $protocol
	 * 
	 * @return int
	 */
	public static function getProtocol ($protocol) {
		#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:153: characters 3-34
		return \getprotobyname($protocol);
	}

	/**
	 * @param bool $isUdp
	 * 
	 * @return int
	 */
	public static function getType ($isUdp) {
		#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:149: characters 10-42
		if ($isUdp) {
			#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:149: characters 18-28
			return \SOCK_DGRAM;
		} else {
			#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:149: characters 31-42
			return \SOCK_STREAM;
		}
	}

	/**
	 * @param Socket[]|Array_hx $read
	 * @param Socket[]|Array_hx $write
	 * @param Socket[]|Array_hx $others
	 * @param float $timeout
	 * 
	 * @return object
	 */
	public static function select ($read, $write, $others, $timeout = null) {
		#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:158: characters 3-8
		throw new NotImplementedException(null, null, new _HxAnon_Socket0("php/net/Socket.hx", 158, "php.net.Socket", "select"));
	}

	/**
	 * @return void
	 */
	public function __construct () {
		#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:34: characters 28-32
		$this->timeout = null;
		#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:33: characters 18-23
		$this->connected = false;
		#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:37: characters 3-10
		parent::__construct();
		#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:38: characters 3-19
		$this->protocol = "tcp";
	}

	/**
	 * @return Socket
	 */
	public function accept () {
		#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:108: characters 3-37
		$r = \stream_socket_accept($this->__s);
		#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:109: characters 3-61
		NetSocket::checkError($r, 0, "Unable to accept connections on socket");
		#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:110: characters 3-24
		$s = new Socket();
		#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:111: characters 3-12
		$s->__s = $r;
		#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:112: characters 3-20
		$s->assignHandler();
		#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:113: characters 3-11
		return $s;
	}

	/**
	 * @return void
	 */
	public function assignHandler () {
		#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:46: characters 19-53
		$this->input->__f = $this->__s;
		#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:47: characters 19-55
		$this->output->__f = $this->__s;
		#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:48: characters 3-19
		$this->connected = true;
		#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:49: lines 49-51
		if ($this->timeout !== null) {
			#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:50: characters 4-23
			$this->setTimeout($this->timeout);
		}
	}

	/**
	 * @param Host $host
	 * @param int $port
	 * 
	 * @return void
	 */
	public function bind ($host, $port) {
		#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:98: characters 3-31
		$errs = Boot::deref(null);
		#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:99: characters 3-31
		$errn = Boot::deref(null);
		#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:100: lines 100-101
		$r = \stream_socket_server(($this->protocol??'null') . "://" . ($host->host??'null') . ":" . ($port??'null'), $errn, $errs, ($this->protocol === "udp" ? \STREAM_SERVER_BIND : \STREAM_SERVER_BIND | \STREAM_SERVER_LISTEN));
		#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:102: characters 3-35
		NetSocket::checkError($r, $errn, $errs);
		#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:103: characters 3-15
		$this->__s = $r;
		#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:104: characters 3-18
		$this->assignHandler();
	}

	/**
	 * @return void
	 */
	public function close () {
		#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:55: characters 3-20
		$this->connected = false;
		#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:56: characters 3-14
		\fclose($this->__s);
		#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:57: characters 19-54
		$this->input->__f = null;
		#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:58: characters 19-56
		$this->output->__f = null;
		#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:59: characters 3-16
		$this->input->close();
		#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:60: characters 3-17
		$this->output->close();
	}

	/**
	 * @param Host $host
	 * @param int $port
	 * 
	 * @return void
	 */
	public function connect ($host, $port) {
		#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:75: characters 3-19
		$errs = null;
		#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:76: characters 3-19
		$errn = null;
		#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:77: characters 3-87
		$r = \stream_socket_client(($this->protocol??'null') . "://" . ($host->host??'null') . ":" . ($port??'null'), $errn, $errs);
		#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:78: characters 3-28
		NetSocket::checkError($r, $errn, $errs);
		#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:79: characters 3-10
		$this->__s = $r;
		#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:80: characters 3-18
		$this->assignHandler();
	}

	/**
	 * @return object
	 */
	public function host () {
		#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:132: characters 3-46
		$r = \stream_socket_get_name($this->__s, false);
		#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:133: characters 3-55
		NetSocket::checkError($r, 0, "Unable to retrieve the host name");
		#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:134: characters 3-23
		return $this->hpOfString($r);
	}

	/**
	 * @param string $s
	 * 
	 * @return object
	 */
	public function hpOfString ($s) {
		#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:117: characters 3-28
		$parts = HxString::split($s, ":");
		#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:118: lines 118-122
		if ($parts->length === 2) {
			#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:119: characters 18-36
			$tmp = new Host(($parts->arr[0] ?? null));
			#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:119: characters 4-67
			return new _HxAnon_Socket1($tmp, Std::parseInt(($parts->arr[1] ?? null)));
		} else {
			#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:121: characters 18-46
			$tmp = new Host(\mb_substr(($parts->arr[1] ?? null), 2, null));
			#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:121: characters 4-77
			return new _HxAnon_Socket1($tmp, Std::parseInt(($parts->arr[2] ?? null)));
		}
	}

	/**
	 * @return void
	 */
	public function initSocket () {
	}

	/**
	 * @param int $connections
	 * 
	 * @return void
	 */
	public function listen ($connections) {
		#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:84: characters 3-8
		throw new NotImplementedException(null, null, new _HxAnon_Socket0("php/net/Socket.hx", 84, "php.net.Socket", "listen"));
	}

	/**
	 * @return object
	 */
	public function peer () {
		#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:126: characters 3-45
		$r = \stream_socket_get_name($this->__s, true);
		#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:127: characters 3-55
		NetSocket::checkError($r, 0, "Unable to retrieve the peer name");
		#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:128: characters 3-23
		return $this->hpOfString($r);
	}

	/**
	 * @return string
	 */
	public function read () {
		#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:64: characters 3-14
		$b = "";
		#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:65: lines 65-66
		while (!\feof($this->__s)) {
			#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:66: characters 4-19
			$b = ($b??'null') . (\fgets($this->__s)??'null');
		}
		#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:67: characters 3-11
		return $b;
	}

	/**
	 * @param float $timeout
	 * 
	 * @return void
	 */
	public function setTimeout ($timeout) {
		#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:138: lines 138-141
		if (!$this->connected) {
			#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:139: characters 4-26
			$this->timeout = $timeout;
			#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:140: characters 4-10
			return;
		}
		#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:142: characters 3-28
		$s = (int)($timeout);
		#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:143: characters 3-45
		$ms = (int)((($timeout - $s) * 1000000));
		#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:144: characters 3-42
		$r = \stream_set_timeout($this->__s, $s, $ms);
		#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:145: characters 3-44
		NetSocket::checkError($r, 0, "Unable to set timeout");
	}

	/**
	 * @param bool $read
	 * @param bool $write
	 * 
	 * @return void
	 */
	public function shutdown ($read, $write) {
		#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:92: characters 3-61
		$rw = ($read && $write ? 2 : ($write ? 1 : ($read ? 0 : 2)));
		#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:93: characters 3-43
		$r = \stream_socket_shutdown($this->__s, $rw);
		#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:94: characters 3-41
		NetSocket::checkError($r, 0, "Unable to Shutdown");
	}

	/**
	 * @param string $content
	 * 
	 * @return void
	 */
	public function write ($content) {
		#/home/runner/haxe/versions/4.2.3/std/php/net/Socket.hx:71: characters 3-23
		\fwrite($this->__s, $content);
	}
}

class _HxAnon_Socket0 extends HxAnon {
	function __construct($fileName, $lineNumber, $className, $methodName) {
		$this->fileName = $fileName;
		$this->lineNumber = $lineNumber;
		$this->className = $className;
		$this->methodName = $methodName;
	}
}

class _HxAnon_Socket1 extends HxAnon {
	function __construct($host, $port) {
		$this->host = $host;
		$this->port = $port;
	}
}

Boot::registerClass(Socket::class, 'php.net.Socket');
