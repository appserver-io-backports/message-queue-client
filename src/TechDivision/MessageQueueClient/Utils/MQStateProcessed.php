<?php

/**
 * TechDivision\MessageQueueClient\Utils\MQStateProcessed
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 */

namespace TechDivision\MessageQueueClient\Utils;

use TechDivision\MessageQueueClient\Utils\MQStateKey;

/**
 * This class holds the MQStateKey used
 * for processed messages.
 *
 * @package     TechDivision\MessageQueueClient
 * @copyright  	Copyright (c) 2010 <info@techdivision.com> - TechDivision GmbH
 * @license    	http://opensource.org/licenses/osl-3.0.php
 *              Open Software License (OSL 3.0)
 * @author      Markus Stockbauer <ms@techdivision.com>
 * @author      Tim Wagner <tw@techdivision.com>
 */
class MQStateProcessed implements MQStateKey {
	
	/**
	 * Holds the key for messages with an processed state.
	 * @var integer
	 */
	const KEY = 5;
	
	/**
	 * The string value for the 'processed' MQStateKey.
	 * @var string
	 */
	protected $state = "processed";
	
	/**
	 * Private constructor for marking 
	 * the class as utiltiy.
	 *
	 * @return void
	 */
	protected final function __construct() { /* Class is a utility class */ }
	
	/**
	 * Returns a new instance of the MQStateKey.
	 * 
	 * @return MQStateProcessed The instance
	 */
	public static function get() {
		return new MQStateProcessed();
	}
	
	/**
	 * (non-PHPdoc)
	 * @see MQStateKey#getState()
	 */
	public function getState() {
		return MQStateProcessed::KEY;
	}
	
	/**
	 * Returns the string value for the high MQStateKey.
	 * 
	 * @return string The string value
	 */
	public function __toString() {
		return $this->state;
	}
}