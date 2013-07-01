<?php

namespace TechDivision\MessageQueueClient\Interfaces;

use TechDivision\MessageQueueClient\Interfaces\Message;

/**
 * The interface for all message receivers.
 * 
 * @package	mqclient
 * @author	wagnert <tw@struts4php.org>
 * @version $Revision: 1.2 $ $Date: 2008-10-17 09:44:23 $
 * @copyright struts4php.org
 * @link www.struts4php.org
 */
interface MessageReceiver {
	
	/**
	 * This function is invoked by the MessageQueue if a message
	 * related to the receiver was received.
	 * 
	 * @param Message $message The message itself
	 * @param string $sessionId The session ID
	 * @return void
	 */
	function onMessage(Message $message, $sessionId);
}