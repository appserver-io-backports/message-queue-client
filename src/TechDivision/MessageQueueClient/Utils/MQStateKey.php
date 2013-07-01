<?php

/**
 * TechDivision\MessageQueueClient\Utils\MQStateKey
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 */

namespace TechDivision\MessageQueueClient\Utils;

/**
 * This class holds the interface for all 
 * MQStateKeys used as message state.
 *
 * @package     TechDivision\MessageQueueClient
 * @copyright  	Copyright (c) 2010 <info@techdivision.com> - TechDivision GmbH
 * @license    	http://opensource.org/licenses/osl-3.0.php
 *              Open Software License (OSL 3.0)
 * @author      Markus Stockbauer <ms@techdivision.com>
 * @author      Tim Wagner <tw@techdivision.com>
 */
interface MQStateKey {
	
	/**
	 * Returns the key value of the
	 * StateKey instance.
	 * 
	 * @return integer The key value
	 */
	public function getState();
}