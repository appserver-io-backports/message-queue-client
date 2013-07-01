<?php

namespace TechDivision\MessageQueueClient\Interfaces;
	 
/**
 * The interface for all handlers.
 * 
 * @package	mqclient
 * @author	wagnert <tw@struts4php.org>
 * @version $Revision: 1.4 $ $Date: 2009-01-03 13:11:54 $
 * @copyright struts4php.org
 * @link www.struts4php.org
 */
interface Worker {
    
    /**
     * Updates the message monitor.
     * 
     * @param Message $message The message to update the monitor for
     * @return void
     */
	public function updateMonitor(Message $message);
}