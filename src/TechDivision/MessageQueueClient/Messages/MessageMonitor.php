<?php

/**
 * TechDivision\MessageQueueClient\MessageMonitor
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 */

namespace TechDivision\MessageQueueClient\Messages;
 
/**
 *
 * @package     TechDivision\MessageQueueClient
 * @copyright  	Copyright (c) 2010 <info@techdivision.com> - TechDivision GmbH
 * @license    	http://opensource.org/licenses/osl-3.0.php
 *              Open Software License (OSL 3.0)
 * @author      Markus Stockbauer <ms@techdivision.com>
 * @author      Tim Wagner <tw@techdivision.com>
 */
class MessageMonitor {
	
	/**
	 * The target counter for monitoring the message.
	 * @var integer
	 */
	protected $target = 0;
	
	/**
	 * The row counter for monitoring the message.
	 * @var integer
	 */
	protected $rowCount = 0;
	
	/**
	 * The log message for monitoring the message.
	 * @var string
	 */
	protected $logMessage = '';

	/**
	 * Initializes the queue with the name to use.
	 * 
	 * @param 
	 * @param string $name Holds the queue name to use
	 * @return void
	 */
	public function __construct($target, $logMessage) {
		$this->target = $target;
		$this->logMessage = $logMessage;
	}

	/**
	 * Sets the log message.
	 * 
	 * @param string $logMessage The log message
	 * @return void
	 */
	public function setLogMessage($logMessage) {
		$this->logMessage = $logMessage;
	}

	/**
	 * Returns the row counter.
	 * 
	 * @param integer $rowCount The row counter
	 * @return void
	 */
	public function setRowCount($rowCount) {
		$this->rowCount = $rowCount;
	}

	/**
	 * Returns the log message.
	 * 
	 * @return string The log message
	 */
	public function getLogMessage() {
		return $this->logMessage;
	}

	/**
	 * Returns the row counter.
	 * 
	 * @return integer The row counter
	 */
	public function getRowCount() {
		return $this->rowCount;
	}

	/**
	 * Returns the target counter.
	 * 
	 * @return integer The target counter
	 */
	public function getTarget() {
		return $this->target;
	}
}