<?php

namespace TechDivision\MessageQueueClient\Interfaces;
	 
/**
 * The interface for all messages.
 * 
 * @package	mqclient
 * @author	wagnert <tw@struts4php.org>
 * @version $Revision: 1.2 $ $Date: 2008-10-17 09:44:23 $
 * @copyright struts4php.org
 * @link www.struts4php.org
 */
interface Message {
	
	/**
	* Returns the message id as an
	* hash value..
	* 
	* @return string The message id as hash value
	*/
	public function getMessageId();
	
	/**
	 * Returns the message itself.
	 * 
	 * @return Object The message depending on the type of the Message object
	 */
	public function getMessage();
	
	/**
	 * Sets the unique session id.
	 * 
	 * @param string $sessionId The uniquid id
	 */
	public function setSessionId($sessionId);
	
	/**
	 * Returns the unique session id.
	 * 
	 * @return string The uniquid id
	 */
	public function getSessionId();
	
	/**
	 * Returns the parent message.
	 * 
	 * @return Message The parent message
	 */
	public function getParentMessage();
	
	/**
	 * Returns the message monitor.
	 * 
	 * @return MessageMonitor The monitor
	 */
	public function getMessageMonitor();
}