<?php
/**
 * Generated by Haxe 4.1.1
 */

namespace helder\std\haxe\iterators;

use \helder\std\StringTools;
use \helder\std\php\Boot;

/**
 * This iterator can be used to iterate over char codes in a string.
 * Note that char codes may differ across platforms because of different
 * internal encoding of strings in different of runtimes.
 */
class StringIterator {
	/**
	 * @var int
	 */
	public $offset;
	/**
	 * @var string
	 */
	public $s;

	/**
	 * Create a new `StringIterator` over String `s`.
	 * 
	 * @param string $s
	 * 
	 * @return void
	 */
	public function __construct ($s) {
		#/home/runner/haxe/versions/4.1.1/std/haxe/iterators/StringIterator.hx:32: characters 18-19
		$this->offset = 0;
		#/home/runner/haxe/versions/4.1.1/std/haxe/iterators/StringIterator.hx:39: characters 9-19
		$this->s = $s;
	}

	/**
	 * See `Iterator.hasNext`
	 * 
	 * @return bool
	 */
	public function hasNext () {
		#/home/runner/haxe/versions/4.1.1/std/haxe/iterators/StringIterator.hx:46: characters 9-33
		return $this->offset < mb_strlen($this->s);
	}

	/**
	 * See `Iterator.next`
	 * 
	 * @return int
	 */
	public function next () {
		#/home/runner/haxe/versions/4.1.1/std/haxe/iterators/StringIterator.hx:53: characters 9-51
		return StringTools::fastCodeAt($this->s, $this->offset++);
	}
}

Boot::registerClass(StringIterator::class, 'haxe.iterators.StringIterator');