<?php
/**
 * Generated by Haxe 4.0.2
 */

namespace helder\std\haxe;

use \helder\std\php\Boot;

interface IMap {
	/**
	 * @return void
	 */
	public function clear () ;

	/**
	 * @return IMap
	 */
	public function copy () ;

	/**
	 * @param mixed $k
	 * 
	 * @return bool
	 */
	public function exists ($k) ;

	/**
	 * @param mixed $k
	 * 
	 * @return mixed
	 */
	public function get ($k) ;

	/**
	 * @return object
	 */
	public function iterator () ;

	/**
	 * @return object
	 */
	public function keyValueIterator () ;

	/**
	 * @return object
	 */
	public function keys () ;

	/**
	 * @param mixed $k
	 * 
	 * @return bool
	 */
	public function remove ($k) ;

	/**
	 * @param mixed $k
	 * @param mixed $v
	 * 
	 * @return void
	 */
	public function set ($k, $v) ;

	/**
	 * @return string
	 */
	public function toString () ;
}

Boot::registerClass(IMap::class, 'haxe.IMap');
