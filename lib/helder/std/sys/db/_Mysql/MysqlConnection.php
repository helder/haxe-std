<?php
/**
 */

namespace helder\std\sys\db\_Mysql;

use \helder\std\php\Boot;
use \helder\std\haxe\Exception;
use \helder\std\sys\db\Connection;
use \helder\std\sys\db\ResultSet;
use \helder\std\Std;
use \helder\std\php\_Boot\HxString;
use \helder\std\StringBuf;

class MysqlConnection implements Connection {
	/**
	 * @var \Mysqli
	 */
	public $db;

	/**
	 * @param object $params
	 * 
	 * @return void
	 */
	public function __construct ($params) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/db/Mysql.hx:54: lines 54-55
		if ($params->port === null) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/db/Mysql.hx:55: characters 4-69
			$params->port = Std::parseInt(\ini_get("mysqli.default_port"));
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/db/Mysql.hx:56: lines 56-57
		if ($params->socket === null) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/db/Mysql.hx:57: characters 4-59
			$params->socket = \ini_get("mysqli.default_socket");
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/db/Mysql.hx:58: lines 58-59
		if ($params->database === null) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/db/Mysql.hx:59: characters 4-24
			$params->database = "";
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/db/Mysql.hx:61: characters 3-102
		$this->db = new \Mysqli($params->host, $params->user, $params->pass, $params->database, $params->port, $params->socket);
	}

	/**
	 * @param StringBuf $s
	 * @param mixed $v
	 * 
	 * @return void
	 */
	public function addValue ($s, $v) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/db/Mysql.hx:90: lines 90-96
		if (\is_int($v) || \is_null($v)) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/db/Mysql.hx:91: characters 4-12
			$s->add($v);
		} else if (\is_bool($v)) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/db/Mysql.hx:93: characters 4-20
			$s->add(($v ? 1 : 0));
		} else {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/db/Mysql.hx:95: characters 4-31
			$s->add($this->quote(Std::string($v)));
		}
	}

	/**
	 * @return void
	 */
	public function close () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/db/Mysql.hx:76: characters 3-13
		$this->db->close();
	}

	/**
	 * @return void
	 */
	public function commit () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/db/Mysql.hx:114: characters 3-29
		$success = $this->db->commit();
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/db/Mysql.hx:115: lines 115-116
		if (!$success) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/db/Mysql.hx:116: characters 4-9
			throw Exception::thrown("Failed to commit transaction: " . ($this->db->error??'null'));
		}
	}

	/**
	 * @return string
	 */
	public function dbName () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/db/Mysql.hx:104: characters 3-17
		return "MySQL";
	}

	/**
	 * @param string $s
	 * 
	 * @return string
	 */
	public function escape ($s) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/db/Mysql.hx:80: characters 3-29
		return $this->db->escape_string($s);
	}

	/**
	 * @return int
	 */
	public function lastInsertId () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/db/Mysql.hx:100: characters 3-22
		return $this->db->insert_id;
	}

	/**
	 * @param string $s
	 * 
	 * @return string
	 */
	public function quote ($s) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/db/Mysql.hx:84: lines 84-85
		if (HxString::indexOf($s, "\x00") >= 0) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/db/Mysql.hx:85: characters 4-41
			return "x'" . (\bin2hex($s)??'null') . "'";
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/db/Mysql.hx:86: characters 3-41
		return "'" . ($this->db->escape_string($s)??'null') . "'";
	}

	/**
	 * @param string $s
	 * 
	 * @return ResultSet
	 */
	public function request ($s) {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/db/Mysql.hx:65: characters 3-28
		$result = $this->db->query($s);
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/db/Mysql.hx:66: lines 66-67
		if ($result === false) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/db/Mysql.hx:67: characters 4-9
			throw Exception::thrown("Failed to perform db query: " . ($this->db->error??'null'));
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/db/Mysql.hx:68: lines 68-70
		if ($result === true) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/db/Mysql.hx:69: characters 4-52
			return new WriteMysqlResultSet($this->db->affected_rows);
		}
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/db/Mysql.hx:72: characters 3-36
		return new MysqlResultSet($result);
	}

	/**
	 * @return void
	 */
	public function rollback () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/db/Mysql.hx:120: characters 3-31
		$success = $this->db->rollback();
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/db/Mysql.hx:121: lines 121-122
		if (!$success) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/db/Mysql.hx:122: characters 4-9
			throw Exception::thrown("Failed to rollback transaction: " . ($this->db->error??'null'));
		}
	}

	/**
	 * @return void
	 */
	public function startTransaction () {
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/db/Mysql.hx:108: characters 3-40
		$success = $this->db->begin_transaction();
		#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/db/Mysql.hx:109: lines 109-110
		if (!$success) {
			#/home/runner/haxe/versions/4.2.3/std/php/_std/sys/db/Mysql.hx:110: characters 4-9
			throw Exception::thrown("Failed to start transaction: " . ($this->db->error??'null'));
		}
	}
}

Boot::registerClass(MysqlConnection::class, 'sys.db._Mysql.MysqlConnection');
