<?php
/**
 * Generated by Haxe 4.2.2
 */

namespace helder\std\sys\db\_Mysql;

use \helder\std\php\Boot;

class WriteMysqlResultSet extends MysqlResultSet {
	/**
	 * @var int
	 */
	public $affectedRows;

	/**
	 * @param int $affectedRows
	 * 
	 * @return void
	 */
	public function __construct ($affectedRows) {
		#/home/runner/haxe/versions/4.2.2/std/php/_std/sys/db/Mysql.hx:250: characters 25-26
		$this->affectedRows = 0;
		#/home/runner/haxe/versions/4.2.2/std/php/_std/sys/db/Mysql.hx:253: characters 3-14
		parent::__construct(null);
		#/home/runner/haxe/versions/4.2.2/std/php/_std/sys/db/Mysql.hx:254: characters 3-35
		$this->affectedRows = $affectedRows;
	}

	/**
	 * @return void
	 */
	public function fetchNext () {
	}

	/**
	 * @return int
	 */
	public function get_length () {
		#/home/runner/haxe/versions/4.2.2/std/php/_std/sys/db/Mysql.hx:264: characters 3-22
		return $this->affectedRows;
	}

	/**
	 * @return int
	 */
	public function get_nfields () {
		#/home/runner/haxe/versions/4.2.2/std/php/_std/sys/db/Mysql.hx:267: characters 3-11
		return 0;
	}

	/**
	 * @return bool
	 */
	public function hasNext () {
		#/home/runner/haxe/versions/4.2.2/std/php/_std/sys/db/Mysql.hx:258: characters 3-15
		return false;
	}
}

Boot::registerClass(WriteMysqlResultSet::class, 'sys.db._Mysql.WriteMysqlResultSet');
