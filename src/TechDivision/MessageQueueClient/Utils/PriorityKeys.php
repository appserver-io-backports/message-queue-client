<?php

/**
 * TechDivision\MessageQueueClient\Utils\PriorityKeys
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 */

namespace TechDivision\MessageQueueClient\Utils;

use TechDivision\MessageQueueClient\Utils\PriorityLow;
use TechDivision\MessageQueueClient\Utils\PriorityMedium;
use TechDivision\MessageQueueClient\Utils\PriorityHigh;

/**
 * This class holds the priority keys used
 * as message priority.
 *
 * @package     TechDivision\MessageQueueClient
 * @copyright  	Copyright (c) 2010 <info@techdivision.com> - TechDivision GmbH
 * @license    	http://opensource.org/licenses/osl-3.0.php
 *              Open Software License (OSL 3.0)
 * @author      Markus Stockbauer <ms@techdivision.com>
 * @author      Tim Wagner <tw@techdivision.com>
 */
class PriorityKeys {
	
	/**
	 * Private constructor for marking 
	 * the class as utiltiy.
	 *
	 * @return void
	 */
	protected final function __construct() { /* Class is a utility class */ }
	
	/**
	 * Returns the initialized PriorityKey for the
	 * passed priority key.
	 * 
	 * @param integer $key The priority key to return the instance for
	 * @return PriorityKey The instance
	 */
	public static function get($key) {
		switch($key) { // check the passed key and return the requested PriorityKey instance
			case 1:
				return PriorityLow::get();
				break;
			case 2:
				return PriorityMedium::get();
				break;
			case 3:
				return PriorityHigh::get();
				break;
			default:
				throw new Exception("PriorityKey with key $key doesn't exist");
		}
	}
}