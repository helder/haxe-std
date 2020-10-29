<?php
/**
 * Generated by Haxe 4.0.5
 */

namespace helder\std\sys\db\_Mysql;

use \helder\std\php\_Boot\HxAnon;
use \helder\std\php\Boot;
use \helder\std\Array_hx;
use \helder\std\sys\db\ResultSet;
use \helder\std\haxe\ds\List_hx;

class MysqlResultSet implements ResultSet {
	/**
	 * @var string
	 */
	static public $hxAnonClassName;

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
	 * @var int
	 */
	public $nfields;
	/**
	 * @var \Myslqi_result
	 */
	public $result;

	/**
	 * @param \Myslqi_result $result
	 * 
	 * @return void
	 */
	public function __construct ($result) {
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:137: characters 3-23
		$this->result = $result;
	}

	/**
	 * @param mixed $row
	 * 
	 * @return mixed
	 */
	public function correctArrayTypes ($row) {
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:199: lines 199-205
		$_gthis = $this;
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:200: characters 20-35
		$_gthis1 = $this;
		if ($this->fieldsInfo === null) {
			$this->fieldsInfo = [];
			$collection = $this->result->fetch_fields();
			foreach ($collection as $key => $value) {
				$_gthis1->fieldsInfo[$value->name] = $value;
			}

		}
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:200: characters 3-36
		$fieldsInfo = $this->fieldsInfo;
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:201: lines 201-203
		foreach ($row as $key1 => $value1) {
			#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:202: characters 4-59
			$row[$key1] = $_gthis->correctType($value1, $fieldsInfo[$key1]->type);
		}
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:204: characters 3-18
		return $row;
	}

	/**
	 * @param object $row
	 * 
	 * @return object
	 */
	public function correctObjectTypes ($row) {
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:207: lines 207-214
		$_gthis = $this;
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:208: characters 20-35
		$_gthis1 = $this;
		if ($this->fieldsInfo === null) {
			$this->fieldsInfo = [];
			$collection = $this->result->fetch_fields();
			foreach ($collection as $key => $value) {
				$_gthis1->fieldsInfo[$value->name] = $value;
			}

		}
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:208: characters 3-36
		$fieldsInfo = $this->fieldsInfo;
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:209: lines 209-212
		foreach ($row as $key1 => $value1) {
			$value2 = $value1;
			#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:210: characters 4-54
			$value2 = $_gthis->correctType($value2, $fieldsInfo[$key1]->type);
			#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:211: characters 20-23
			$tmp = $row;
			#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:211: characters 4-38
			$tmp->{$key1} = $value2;

		}
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:213: characters 3-13
		return $row;
	}

	/**
	 * @param string $value
	 * @param int $type
	 * 
	 * @return mixed
	 */
	public function correctType ($value, $type) {
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:227: lines 227-228
		if ($value === null) {
			#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:228: characters 4-15
			return null;
		}
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:229: lines 229-232
		if (($type === MYSQLI_TYPE_BIT) || ($type === MYSQLI_TYPE_TINY) || ($type === MYSQLI_TYPE_SHORT) || ($type === MYSQLI_TYPE_LONG) || ($type === MYSQLI_TYPE_INT24) || ($type === MYSQLI_TYPE_CHAR)) {
			#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:231: characters 4-28
			return (int)($value);
		}
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:233: lines 233-238
		if (($type === MYSQLI_TYPE_DECIMAL) || ($type === MYSQLI_TYPE_NEWDECIMAL) || ($type === MYSQLI_TYPE_FLOAT) || ($type === MYSQLI_TYPE_DOUBLE)) {
			#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:237: characters 4-30
			return (float)($value);
		}
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:239: characters 3-15
		return $value;
	}

	/**
	 * @return void
	 */
	public function fetchNext () {
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:186: characters 3-34
		$row = $this->result->fetch_assoc();
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:187: lines 187-188
		if ($row !== null) {
			#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:188: characters 4-39
			$this->fetchedRow = $this->correctArrayTypes($row);
		}
	}

	/**
	 * @return mixed
	 */
	public function getFieldsInfo () {
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:216: lines 216-224
		$_gthis = $this;
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:217: lines 217-222
		if ($this->fieldsInfo === null) {
			#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:218: characters 4-40
			$this->fieldsInfo = [];
			#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:219: lines 219-221
			$collection = $this->result->fetch_fields();
			foreach ($collection as $key => $value) {
				#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:220: characters 5-33
				$_gthis->fieldsInfo[$value->name] = $value;
			}

		}
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:223: characters 3-20
		return $this->fieldsInfo;
	}

	/**
	 * @return Array_hx
	 */
	public function getFieldsNames () {
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:181: characters 3-38
		$fields = $this->result->fetch_fields();
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:182: characters 10-44
		$_g = new Array_hx();
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:182: characters 25-31
		$data = $fields;
		$_g1_current = 0;
		$_g1_length = count($data);
		$_g1_data = $data;
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:182: characters 11-43
		while ($_g1_current < $_g1_length) {
			$field = $_g1_data[$_g1_current++];
			#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:182: characters 33-43
			$_g->arr[$_g->length] = $field->name;
			++$_g->length;

		}

		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:182: characters 10-44
		return $_g;
	}

	/**
	 * @param int $n
	 * 
	 * @return float
	 */
	public function getFloatResult ($n) {
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:177: characters 10-36
		return (float)($this->getResult($n));
	}

	/**
	 * @param int $n
	 * 
	 * @return int
	 */
	public function getIntResult ($n) {
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:173: characters 10-34
		return (int)($this->getResult($n));
	}

	/**
	 * @param int $n
	 * 
	 * @return string
	 */
	public function getResult ($n) {
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:167: lines 167-168
		if ($this->fetchedRow === null) {
			#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:168: characters 4-15
			$this->fetchNext();
		}
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:169: characters 10-44
		return array_values($this->fetchedRow)[$n];
	}

	/**
	 * @return int
	 */
	public function get_length () {
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:243: characters 3-25
		return $this->result->num_rows;
	}

	/**
	 * @return int
	 */
	public function get_nfields () {
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:246: characters 3-28
		return $this->result->field_count;
	}

	/**
	 * @return bool
	 */
	public function hasNext () {
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:141: lines 141-142
		if ($this->fetchedRow === null) {
			#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:142: characters 4-15
			$this->fetchNext();
		}
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:143: characters 3-28
		return $this->fetchedRow !== null;
	}

	/**
	 * @return mixed
	 */
	public function next () {
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:147: lines 147-148
		if ($this->fetchedRow === null) {
			#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:148: characters 4-15
			$this->fetchNext();
		}
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:149: characters 3-27
		return $this->withdrawFetched();
	}

	/**
	 * @return List_hx
	 */
	public function results () {
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:153: characters 3-25
		$list = new List_hx();
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:155: characters 3-22
		$this->result->data_seek(0);
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:156: characters 3-50
		$row = $this->result->fetch_object(MysqlResultSet::$hxAnonClassName);
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:157: lines 157-161
		while ($row !== null) {
			#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:158: characters 4-33
			$row = $this->correctObjectTypes($row);
			#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:159: characters 4-17
			$list->add($row);
			#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:160: characters 4-46
			$row = $this->result->fetch_object(MysqlResultSet::$hxAnonClassName);
		}
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:163: characters 3-14
		return $list;
	}

	/**
	 * @return mixed
	 */
	public function withdrawFetched () {
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:192: lines 192-193
		if ($this->fetchedRow === null) {
			#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:193: characters 4-15
			return null;
		}
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:194: characters 3-24
		$row = $this->fetchedRow;
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:195: characters 3-20
		$this->fetchedRow = null;
		#/home/runner/haxe/versions/4.0.5/std/php/_std/sys/db/Mysql.hx:196: characters 3-30
		return new HxAnon($row);
	}

	/**
	 * @internal
	 * @access private
	 */
	static public function __hx__init ()
	{
		static $called = false;
		if ($called) return;
		$called = true;


		self::$hxAnonClassName = Boot::getClass(HxAnon::class)->phpClassName;
	}
}

Boot::registerClass(MysqlResultSet::class, 'sys.db._Mysql.MysqlResultSet');
Boot::registerGetters('helder\\std\\sys\\db\\_Mysql\\MysqlResultSet', [
	'nfields' => true,
	'length' => true
]);
MysqlResultSet::__hx__init();
