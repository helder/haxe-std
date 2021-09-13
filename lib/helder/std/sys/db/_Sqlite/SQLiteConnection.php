<?php
/**
 */

namespace helder\std\sys\db\_Sqlite;

use \helder\std\php\Boot;
use \helder\std\sys\db\Connection;
use \helder\std\sys\db\ResultSet;
use \helder\std\Std;
use \helder\std\php\_Boot\HxString;
use \helder\std\StringBuf;

class SQLiteConnection implements Connection {
	/**
	 * @var \SQLite3
	 */
	public $db;

	/**
	 * @param string $file
	 * 
	 * @return void
	 */
	public function __construct ($file) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/db/Sqlite.hx:40: characters 3-25
		$this->db = new \SQLite3($file);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/db/Sqlite.hx:41: characters 3-28
		$this->db->enableExceptions(true);
	}

	/**
	 * @param StringBuf $s
	 * @param mixed $v
	 * 
	 * @return void
	 */
	public function addValue ($s, $v) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/db/Sqlite.hx:64: lines 64-70
		if (\is_int($v) || \is_null($v)) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/db/Sqlite.hx:65: characters 4-12
			$s->add($v);
		} else if (\is_bool($v)) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/db/Sqlite.hx:67: characters 4-20
			$s->add(($v ? 1 : 0));
		} else {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/db/Sqlite.hx:69: characters 4-31
			$s->add($this->quote(Std::string($v)));
		}
	}

	/**
	 * @return void
	 */
	public function close () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/db/Sqlite.hx:50: characters 3-13
		$this->db->close();
	}

	/**
	 * @return void
	 */
	public function commit () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/db/Sqlite.hx:86: characters 3-21
		$this->db->query("COMMIT");
	}

	/**
	 * @return string
	 */
	public function dbName () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/db/Sqlite.hx:78: characters 3-18
		return "SQLite";
	}

	/**
	 * @param string $s
	 * 
	 * @return string
	 */
	public function escape ($s) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/db/Sqlite.hx:54: characters 3-33
		return \SQLite3::escapeString($s);
	}

	/**
	 * @return int
	 */
	public function lastInsertId () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/db/Sqlite.hx:74: characters 10-42
		return (int)($this->db->lastInsertRowID());
	}

	/**
	 * @param string $s
	 * 
	 * @return string
	 */
	public function quote ($s) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/db/Sqlite.hx:58: lines 58-59
		if (HxString::indexOf($s, "\x00") >= 0) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/db/Sqlite.hx:59: characters 4-41
			return "x'" . (\bin2hex($s)??'null') . "'";
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/db/Sqlite.hx:60: characters 3-45
		return "'" . (\SQLite3::escapeString($s)??'null') . "'";
	}

	/**
	 * @param string $s
	 * 
	 * @return ResultSet
	 */
	public function request ($s) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/db/Sqlite.hx:45: characters 3-28
		$result = $this->db->query($s);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/db/Sqlite.hx:46: characters 3-37
		return new SQLiteResultSet($result);
	}

	/**
	 * @return void
	 */
	public function rollback () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/db/Sqlite.hx:90: characters 3-23
		$this->db->query("ROLLBACK");
	}

	/**
	 * @return void
	 */
	public function startTransaction () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/db/Sqlite.hx:82: characters 3-32
		$this->db->query("BEGIN TRANSACTION");
	}
}

Boot::registerClass(SQLiteConnection::class, 'sys.db._Sqlite.SQLiteConnection');
