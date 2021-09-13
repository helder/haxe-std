<?php
/**
 */

namespace helder\std\sys\db;

use \helder\std\php\Boot;
use \helder\std\Array_hx;
use \helder\std\haxe\ds\List_hx;

interface ResultSet {
	/**
	 * Get the list of column names.
	 * Depending on a database management system may return `null` if there's no
	 * more rows to fetch.
	 * 
	 * @return string[]|Array_hx
	 */
	public function getFieldsNames () ;

	/**
	 * Get the value of `n`-th column of the current row as a float value.
	 * 
	 * @param int $n
	 * 
	 * @return float
	 */
	public function getFloatResult ($n) ;

	/**
	 * Get the value of `n`-th column of the current row as an integer value.
	 * 
	 * @param int $n
	 * 
	 * @return int
	 */
	public function getIntResult ($n) ;

	/**
	 * Get the value of `n`-th column of the current row.
	 * Throws an exception if the re
	 * 
	 * @param int $n
	 * 
	 * @return string
	 */
	public function getResult ($n) ;

	/**
	 * @return int
	 */
	public function get_length () ;

	/**
	 * @return int
	 */
	public function get_nfields () ;

	/**
	 * Tells whether there is a row to be fetched.
	 * 
	 * @return bool
	 */
	public function hasNext () ;

	/**
	 * Fetch next row.
	 * 
	 * @return mixed
	 */
	public function next () ;

	/**
	 * Fetch all the rows not fetched yet.
	 * 
	 * @return List_hx
	 */
	public function results () ;
}

Boot::registerClass(ResultSet::class, 'sys.db.ResultSet');
Boot::registerGetters('helder\\std\\sys\\db\\ResultSet', [
	'nfields' => true,
	'length' => true
]);
