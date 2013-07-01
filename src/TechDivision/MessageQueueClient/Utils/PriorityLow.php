<?php

/**
 * TechDivision\MessageQueueClient\Utils\PriorityKeyLow
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 */

namespace TechDivision\MessageQueueClient\Utils;

use TechDivision\MessageQueueClient\Utils\PriorityKey;

/**
 * This class holds the PriorityKey used
 * for low priority messages.
 *
 * @package     TechDivision\MessageQueueClient
 * @copyright  	Copyright (c) 2010 <info@techdivision.com> - TechDivision GmbH
 * @license    	http://opensource.org/licenses/osl-3.0.php
 *              Open Software License (OSL 3.0)
 * @author      Markus Stockbauer <ms@techdivision.com>
 * @author      Tim Wagner <tw@techdivision.com>
 */
class PriorityLow implements PriorityKey {
	
	/**
	 * Holds the key for messages with a low priority.
	 * @var integer
	 */
	const KEY = 1;
	
	/**
	 * The string value for the low PriorityKey.
	 * @var string
	 */
	protected $priority = "low";
	
	/**
	 * Private constructor for marking 
	 * the class as utiltiy.
	 *
	 * @return void
	 */
	protected final function __construct() { /* Class is a utility class */ }
	
	/**
	 * Returns a new instance of the PriorityKey.
	 * 
	 * @return PriorityLow The instance
	 */
	public static function get() {
		return new PriorityLow();
	}
	
	/**
	 * (non-PHPdoc)
	 * @see PriorityKey#getPriority()
	 */
	public function getPriority() {
		return PriorityLow::KEY;
	}
	
	/**
	 * Returns the string value for the low PriorityKey.
	 * 
	 * @return string The string value
	 */
	public function __toString() {
		return $this->priority;
	}
}