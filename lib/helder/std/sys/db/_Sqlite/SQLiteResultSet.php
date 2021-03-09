<?php
/**
 * Generated by Haxe 4.1.5
 */

namespace helder\std\sys\db\_Sqlite;

use \helder\std\php\_Boot\HxAnon;
use \helder\std\php\Boot;
use \helder\std\Array_hx;
use \helder\std\sys\db\ResultSet;
use \helder\std\haxe\ds\List_hx;

class SQLiteResultSet implements ResultSet {
	/**
	 * @var int
	 */
	public $_length;
	/**
	 * @var int
	 */
	public $_nfields;
	/**
	 * @var int
	 */
	public $currentIndex;
	/**
	 * @var mixed
	 */
	public $fetchedRow;
	/**
	 * @var mixed
	 */
	public $fieldsInfo;
	/**
	 * @var int
	 */
	public $length;
	/**
	 * @var bool
	 */
	public $loaded;
	/**
	 * @var int
	 */
	public $nfields;
	/**
	 * @var \SQLite3Result
	 */
	public $result;
	/**
	 * @var mixed
	 */
	public $rows;

	/**
	 * @param \SQLite3Result $result
	 * 
	 * @return void
	 */
	public function __construct ($result) {
		#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:101: characters 25-26
		$this->currentIndex = 0;
		#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:100: characters 20-25
		$this->loaded = false;
		#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:98: characters 21-22
		$this->_nfields = 0;
		#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:97: characters 20-21
		$this->_length = 0;
		#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:108: characters 3-23
		$this->result = $result;
	}

	/**
	 * @param mixed $row
	 * 
	 * @return mixed
	 */
	public function correctArrayTypes ($row) {
		#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:153: lines 153-159
		$_gthis = $this;
		#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:154: characters 20-35
		if ($this->fieldsInfo === null) {
			$this->fieldsInfo = [];
			$_g = 0;
			$_g1 = $this->get_nfields();
			while ($_g < $_g1) {
				$i = $_g++;
				$key = $this->result->columnName($i);
				$val = $this->result->columnType($i);
				$this->fieldsInfo[$key] = $val;
			}
		}
		#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:154: characters 3-36
		$fieldsInfo = $this->fieldsInfo;
		#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:155: lines 155-157
		foreach ($row as $key => $value) {
			#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:156: characters 4-54
			$row[$key] = $_gthis->correctType($value, $fieldsInfo[$key]);
		}
		#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:158: characters 3-18
		return $row;
	}

	/**
	 * @param string $value
	 * @param int $type
	 * 
	 * @return mixed
	 */
	public function correctType ($value, $type) {
		#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:179: lines 179-180
		if ($value === null) {
			#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:180: characters 4-15
			return null;
		}
		#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:181: lines 181-182
		if ($type === \SQLITE3_INTEGER) {
			#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:182: characters 4-28
			return (int)($value);
		}
		#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:183: lines 183-184
		if ($type === \SQLITE3_FLOAT) {
			#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:184: characters 4-30
			return (float)($value);
		}
		#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:185: characters 3-15
		return $value;
	}

	/**
	 * @return void
	 */
	public function fetchAll () {
		#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:189: characters 3-28
		$this->rows = [];
		#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:190: characters 3-17
		$index = 0;
		#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:191: characters 3-52
		$row = $this->result->fetchArray(\SQLITE3_ASSOC);
		#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:192: lines 192-196
		while ($row !== false) {
			#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:193: characters 4-40
			$val = $this->correctArrayTypes($row);
			$this->rows[$index] = $val;
			#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:194: characters 4-48
			$row = $this->result->fetchArray(\SQLITE3_ASSOC);
			#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:195: characters 4-11
			++$index;
		}
		#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:197: characters 3-18
		$this->_length = $index;
	}

	/**
	 * @return mixed
	 */
	public function getFieldsInfo () {
		#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:162: lines 162-167
		if ($this->fieldsInfo === null) {
			#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:163: characters 4-40
			$this->fieldsInfo = [];
			#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:164: characters 14-18
			$_g = 0;
			#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:164: characters 18-25
			$_g1 = $this->get_nfields();
			#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:164: lines 164-166
			while ($_g < $_g1) {
				#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:164: characters 14-25
				$i = $_g++;
				#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:165: characters 5-60
				$key = $this->result->columnName($i);
				$val = $this->result->columnType($i);
				$this->fieldsInfo[$key] = $val;
			}
		}
		#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:168: characters 3-20
		return $this->fieldsInfo;
	}

	/**
	 * @return Array_hx
	 */
	public function getFieldsNames () {
		#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:149: characters 20-35
		if ($this->fieldsInfo === null) {
			$this->fieldsInfo = [];
			$_g = 0;
			$_g1 = $this->get_nfields();
			while ($_g < $_g1) {
				$i = $_g++;
				$key = $this->result->columnName($i);
				$val = $this->result->columnType($i);
				$this->fieldsInfo[$key] = $val;
			}
		}
		#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:149: characters 3-36
		$fieldsInfo = $this->fieldsInfo;
		#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:150: characters 3-39
		return Array_hx::wrap(\array_keys($fieldsInfo));
	}

	/**
	 * @param int $n
	 * 
	 * @return float
	 */
	public function getFloatResult ($n) {
		#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:145: characters 10-36
		return (float)($this->getResult($n));
	}

	/**
	 * @param int $n
	 * 
	 * @return int
	 */
	public function getIntResult ($n) {
		#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:141: characters 10-34
		return (int)($this->getResult($n));
	}

	/**
	 * @param int $n
	 * 
	 * @return string
	 */
	public function getResult ($n) {
		#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:133: lines 133-134
		if (!$this->loaded) {
			#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:134: characters 4-10
			$this->load();
		}
		#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:135: lines 135-136
		if (!$this->hasNext()) {
			#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:136: characters 4-15
			return null;
		}
		#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:137: characters 10-52
		return \array_values($this->rows[$this->currentIndex])[$n];
	}

	/**
	 * @return int
	 */
	public function get_length () {
		#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:201: characters 3-17
		return $this->_length;
	}

	/**
	 * @return int
	 */
	public function get_nfields () {
		#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:204: characters 3-18
		return $this->_nfields;
	}

	/**
	 * @return bool
	 */
	public function hasNext () {
		#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:112: lines 112-113
		if (!$this->loaded) {
			#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:113: characters 4-10
			$this->load();
		}
		#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:114: characters 3-32
		return $this->currentIndex < $this->_length;
	}

	/**
	 * @return void
	 */
	public function load () {
		#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:172: characters 3-16
		$this->loaded = true;
		#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:173: characters 3-33
		$this->_nfields = $this->result->numColumns();
		#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:174: characters 3-18
		if ($this->fieldsInfo === null) {
			$this->fieldsInfo = [];
			$_g = 0;
			$_g1 = $this->get_nfields();
			while ($_g < $_g1) {
				$i = $_g++;
				$key = $this->result->columnName($i);
				$val = $this->result->columnType($i);
				$this->fieldsInfo[$key] = $val;
			}
		}
		#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:175: characters 3-13
		$this->fetchAll();
	}

	/**
	 * @return mixed
	 */
	public function next () {
		#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:118: lines 118-119
		if (!$this->loaded) {
			#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:119: characters 4-10
			$this->load();
		}
		#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:120: characters 3-43
		$next = $this->rows[$this->currentIndex++];
		#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:121: characters 10-50
		return new HxAnon($this->correctArrayTypes($next));
	}

	/**
	 * @return List_hx
	 */
	public function results () {
		#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:124: lines 124-130
		$_gthis = $this;
		#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:125: lines 125-126
		if (!$this->loaded) {
			#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:126: characters 4-10
			$this->load();
		}
		#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:127: characters 3-25
		$list = new List_hx();
		#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:128: characters 3-91
		$collection = $this->rows;
		foreach ($collection as $key => $value) {
			#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:128: characters 41-90
			$list->add(new HxAnon($_gthis->correctArrayTypes($value)));
		}
		#/home/runner/haxe/versions/4.1.5/std/php/_std/sys/db/Sqlite.hx:129: characters 3-14
		return $list;
	}
}

Boot::registerClass(SQLiteResultSet::class, 'sys.db._Sqlite.SQLiteResultSet');
Boot::registerGetters('helder\\std\\sys\\db\\_Sqlite\\SQLiteResultSet', [
	'nfields' => true,
	'length' => true
]);
