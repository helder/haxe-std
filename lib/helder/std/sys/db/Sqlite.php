<?php
/**
 * Generated by Haxe 4.1.4
 */

namespace helder\std\sys\db;

use \helder\std\php\Boot;
use \helder\std\sys\db\_Sqlite\SQLiteConnection;

class Sqlite {
	/**
	 * Opens a new SQLite connection on the specified path.
	 * (cs) You will need a SQLite ADO.NET Provider
	 * (see http://www.mono-project.com/docs/database-access/providers/sqlite/).
	 * Also note that this will try to open an assembly named `Mono.Data.Sqlite`
	 * if it wasn't loaded yet.
	 * (java) You will need a SQLite JDBC driver (e.g.
	 * https://bitbucket.org/xerial/sqlite-jdbc).
	 * 
	 * @param string $file
	 * 
	 * @return Connection
	 */
	public static function open ($file) {
		#/home/runner/haxe/versions/4.1.4/std/php/_std/sys/db/Sqlite.hx:31: characters 3-36
		return new SQLiteConnection($file);
	}
}

Boot::registerClass(Sqlite::class, 'sys.db.Sqlite');