<?php
/**
 */

namespace helder\std\sys\db;

use \helder\std\php\Boot;
use \helder\std\sys\db\_Mysql\MysqlConnection;

class Mysql {
	/**
	 * @param object $params
	 * 
	 * @return Connection
	 */
	public static function connect ($params) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/db/Mysql.hx:39: characters 3-37
		return new MysqlConnection($params);
	}
}

Boot::registerClass(Mysql::class, 'sys.db.Mysql');
