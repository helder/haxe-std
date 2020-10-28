<?php
/**
 * Generated by Haxe 4.1.2
 */

namespace helder\std\sys\net;

use \helder\std\php\Boot;
use \helder\std\php\_Boot\HxString;
use \helder\std\EReg;

/**
 * A given IP host name.
 */
class Host {
	/**
	 * @var string
	 */
	public $_ip;
	/**
	 * @var string
	 * The provided host string.
	 */
	public $host;
	/**
	 * @var int
	 * The actual IP corresponding to the host.
	 */
	public $ip;

	/**
	 * Returns the local computer host name
	 * 
	 * @return string
	 */
	public static function localhost () {
		#/home/runner/haxe/versions/4.1.2/std/php/_std/sys/net/Host.hx:60: characters 3-64
		return ($_SERVER["HTTP_HOST"] ?? "localhost");
	}

	/**
	 * Creates a new Host : the name can be an IP in the form "127.0.0.1" or an host name such as "google.com", in which case
	 * the corresponding IP address is resolved using DNS. An exception occur if the host name could not be found.
	 * 
	 * @param string $name
	 * 
	 * @return void
	 */
	public function __construct ($name) {
		#/home/runner/haxe/versions/4.1.2/std/php/_std/sys/net/Host.hx:37: characters 3-14
		$this->host = $name;
		#/home/runner/haxe/versions/4.1.2/std/php/_std/sys/net/Host.hx:38: lines 38-46
		if ((new EReg("^(\\d{1,3}\\.){3}\\d{1,3}\$", ""))->match($name)) {
			#/home/runner/haxe/versions/4.1.2/std/php/_std/sys/net/Host.hx:39: characters 4-14
			$this->_ip = $name;
		} else {
			#/home/runner/haxe/versions/4.1.2/std/php/_std/sys/net/Host.hx:41: characters 4-29
			$this->_ip = gethostbyname($name);
			#/home/runner/haxe/versions/4.1.2/std/php/_std/sys/net/Host.hx:42: lines 42-45
			if ($this->_ip === $name) {
				#/home/runner/haxe/versions/4.1.2/std/php/_std/sys/net/Host.hx:43: characters 5-11
				$this->ip = 0;
				#/home/runner/haxe/versions/4.1.2/std/php/_std/sys/net/Host.hx:44: characters 5-11
				return;
			}
		}
		#/home/runner/haxe/versions/4.1.2/std/php/_std/sys/net/Host.hx:47: characters 3-26
		$p = HxString::split($this->_ip, ".");
		#/home/runner/haxe/versions/4.1.2/std/php/_std/sys/net/Host.hx:48: characters 3-71
		$this->ip = intval(sprintf("%02X%02X%02X%02X", ($p->arr[3] ?? null), ($p->arr[2] ?? null), ($p->arr[1] ?? null), ($p->arr[0] ?? null)), 16);
	}

	/**
	 * Perform a reverse-DNS query to resolve a host name from an IP.
	 * 
	 * @return string
	 */
	public function reverse () {
		#/home/runner/haxe/versions/4.1.2/std/php/_std/sys/net/Host.hx:56: characters 3-28
		return gethostbyaddr($this->_ip);
	}

	/**
	 * Returns the IP representation of the host
	 * 
	 * @return string
	 */
	public function toString () {
		#/home/runner/haxe/versions/4.1.2/std/php/_std/sys/net/Host.hx:52: characters 3-13
		return $this->_ip;
	}

	public function __toString() {
		return $this->toString();
	}
}

Boot::registerClass(Host::class, 'sys.net.Host');
