<?php
/**
 */

namespace helder\std\php\_Generator;

use \helder\std\php\Boot;

class GeneratorIterator {
	/**
	 * @var bool
	 * This field is required to maintain execution order of .next()/.valid()/.current() methods.
	 * @see http://php.net/manual/en/class.iterator.php
	 */
	public $first;
	/**
	 * @var \Generator
	 */
	public $generator;

	/**
	 * @param \Generator $generator
	 * 
	 * @return void
	 */
	public function __construct ($generator) {
		#/home/runner/haxe/versions/4.2.3/std/php/Generator.hx:73: characters 19-23
		$this->first = true;
		#/home/runner/haxe/versions/4.2.3/std/php/Generator.hx:76: characters 3-29
		$this->generator = $generator;
	}

	/**
	 * @return bool
	 */
	public function hasNext () {
		#/home/runner/haxe/versions/4.2.3/std/php/Generator.hx:80: lines 80-84
		if ($this->first) {
			#/home/runner/haxe/versions/4.2.3/std/php/Generator.hx:81: characters 4-17
			$this->first = false;
		} else {
			#/home/runner/haxe/versions/4.2.3/std/php/Generator.hx:83: characters 4-20
			$this->generator->next();
		}
		#/home/runner/haxe/versions/4.2.3/std/php/Generator.hx:85: characters 3-27
		return $this->generator->valid();
	}

	/**
	 * @return mixed
	 */
	public function next () {
		#/home/runner/haxe/versions/4.2.3/std/php/Generator.hx:89: characters 3-29
		return $this->generator->current();
	}
}

Boot::registerClass(GeneratorIterator::class, 'php._Generator.GeneratorIterator');
