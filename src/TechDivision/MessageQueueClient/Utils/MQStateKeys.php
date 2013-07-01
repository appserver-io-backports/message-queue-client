<?php

/**
 * TechDivision\MessageQueueClient\Utils\MQStateKeys
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 */

namespace TechDivision\MessageQueueClient\Utils;

use TechDivision\MessageQueueClient\Utils\MQStateKeyActive;
use TechDivision\MessageQueueClient\Utils\MQStateKeyPaused;
use TechDivision\MessageQueueClient\Utils\MQStateKeyToProcess;
use TechDivision\MessageQueueClient\Utils\MQStateKeyInProgress;
use TechDivision\MessageQueueClient\Utils\MQStateKeyProcessed;
use TechDivision\MessageQueueClient\Utils\MQStateKeyFailed;
use TechDivision\MessageQueueClient\Utils\MQStateKeyUnknown;
	
/**
 * This class holds the priority keys used
 * as message state.
 *
 * @package     TechDivision\MessageQueueClient
 * @copyright  	Copyright (c) 2010 <info@techdivision.com> - TechDivision GmbH
 * @license    	http://opensource.org/licenses/osl-3.0.php
 *              Open Software License (OSL 3.0)
 * @author      Markus Stockbauer <ms@techdivision.com>
 * @author      Tim Wagner <tw@techdivision.com>
 */
class MQStateKeys {
	
	/**
	 * Private constructor for marking 
	 * the class as utiltiy.
	 *
	 * @return void
	 */
	protected final function __construct() { /* Class is a utility class */ }
	
	/**
	 * Returns the initialized MQStateKey for the
	 * passed priority key.
	 * 
	 * @param integer $key The state key to return the instance for
	 * @return MQStateKey The instance
	 */
	public static function get($key) {
		switch($key) { // check the passed key and return the requested MQStateKey instance
			case 1:
				return MQStateActive::get();
				break;
			case 2:
				return MQStatePaused::get();
				break;
			case 3:
				return MQStateToProcess::get();
				break;
			case 4:
				return MQStateInProgress::get();
				break;
			case 5:
				return MQStateProcessed::get();
				break;
			case 6:
				return MQStateFailed::get();
				break;
			case 7:
				return MQStateUnknown::get();
				break;
			default:
				throw new \Exception("MQStateKey with key $key doesn't exist");
		}
	}
}