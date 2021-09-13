<?php
/**
 */

namespace helder\std\haxe\exceptions;

use \helder\std\php\Boot;
use \helder\std\haxe\Exception;

/**
 * An exception that is thrown when an invalid value provided for an argument of a function.
 */
class ArgumentException extends PosException {
	/**
	 * @var string
	 * An argument name.
	 */
	public $argument;

	/**
	 * @param string $argument
	 * @param string $message
	 * @param Exception $previous
	 * @param object $pos
	 * 
	 * @return void
	 */
	public function __construct ($argument, $message = null, $previous = null, $pos = null) {
		#/home/runner/haxe/versions/4.2.3/std/haxe/exceptions/ArgumentException.hx:13: characters 3-83
		parent::__construct(($message === null ? "Invalid argument \"" . ($argument??'null') . "\"" : $message), $previous, $pos);
		#/home/runner/haxe/versions/4.2.3/std/haxe/exceptions/ArgumentException.hx:14: characters 3-27
		$this->argument = $argument;
	}
}

Boot::registerClass(ArgumentException::class, 'haxe.exceptions.ArgumentException');
