<?php

/**
 * TechDivision\MessageQueueClient\Utils\MQStateUnknown
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
 * This class holds the MQStateKey used for
 * messages with unknown state.
 * 
 * Messages are turned to this state when they 
 * are running longer than ten minutes.
 *
 * @package     TechDivision\MessageQueueClient
 * @copyright  	Copyright (c) 2010 <info@techdivision.com> - TechDivision GmbH
 * @license    	http://opensource.org/licenses/osl-3.0.php
 *              Open Software License (OSL 3.0)
 * @author      Markus Stockbauer <ms@techdivision.com>
 * @author      Tim Wagner <tw@techdivision.com>
 */
class MQStateUnknown implements MQStateKey {
	
	/**
	 * Holds the state key for failed messages.
	 * @var integer
	 */
	const KEY = 7;
	
	/**
	 * The string value for the 'unknown' MQStateKey.
	 * @var string
	 */
	protected $state = "unknown";
	
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
	 * @return MQStateUnknown The instance
	 */
	public static function get() {
		return new MQStateUnknown();
	}
	
	/**
	 * (non-PHPdoc)
	 * @see MQStateKey#getState()
	 */
	public function getState() {
		return MQStateUnknown::KEY;
	}
	
	/**
	 * Returns the string value for the MQStateKey.
	 * 
	 * @return string The string value
	 */
	public function __toString() {
		return $this->state;
	}
}