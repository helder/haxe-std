<?php
/**
 */

namespace helder\std\sys\net;

use \helder\std\php\Boot;
use \helder\std\haxe\Exception;
use \helder\std\haxe\io\Bytes;

/**
 * A UDP socket class
 */
class UdpSocket extends Socket {
	/**
	 * @return void
	 */
	public function __construct () {
		#/home/runner/haxe/versions/4.2.3/std/sys/net/UdpSocket.hx:30: characters 3-8
		throw Exception::thrown("Not available on this platform");
	}

	/**
	 * Reads data from any incoming address and store the receiver address into the address parameter.
	 * 
	 * @param Bytes $buf
	 * @param int $pos
	 * @param int $len
	 * @param Address $addr
	 * 
	 * @return int
	 */
	public function readFrom ($buf, $pos, $len, $addr) {
		#/home/runner/haxe/versions/4.2.3/std/sys/net/UdpSocket.hx:52: characters 3-11
		return 0;
	}

	/**
	 * Sends data to the specified target host/port address.
	 * 
	 * @param Bytes $buf
	 * @param int $pos
	 * @param int $len
	 * @param Address $addr
	 * 
	 * @return int
	 */
	public function sendTo ($buf, $pos, $len, $addr) {
		#/home/runner/haxe/versions/4.2.3/std/sys/net/UdpSocket.hx:45: characters 3-11
		return 0;
	}

	/**
	 * Allows the socket to send to broadcast addresses.
	 * 
	 * @param bool $b
	 * 
	 * @return void
	 */
	public function setBroadcast ($b) {
		#/home/runner/haxe/versions/4.2.3/std/sys/net/UdpSocket.hx:38: characters 3-8
		throw Exception::thrown("Not available on this platform");
	}
}

Boot::registerClass(UdpSocket::class, 'sys.net.UdpSocket');
