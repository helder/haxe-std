<?php
/**
 */

namespace helder\std\php\net;

use \helder\std\php\Boot;

class SslSocket extends Socket {
	/**
	 * @return void
	 */
	public function __construct () {
		#/home/runner/haxe/versions/4.2.3/std/php/net/SslSocket.hx:27: characters 3-10
		parent::__construct();
		#/home/runner/haxe/versions/4.2.3/std/php/net/SslSocket.hx:28: characters 3-19
		$this->protocol = "ssl";
	}
}

Boot::registerClass(SslSocket::class, 'php.net.SslSocket');
