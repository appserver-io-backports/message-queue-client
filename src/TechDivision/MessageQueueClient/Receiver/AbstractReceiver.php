<?php
	 
namespace TechDivision\MessageQueueClient\Receiver;

use TechDivision\ApplicationServer\Interfaces\ContainerInterface;
use TechDivision\MessageQueueClient\Interfaces\Message;
use TechDivision\MessageQueueClient\Interfaces\MessageReceiver;

/**
 * The abstract superclass for all receivers.
 *
 * @package     TechDivision\MessageQueueClient
 * @copyright  	Copyright (c) 2010 <info@techdivision.com> - TechDivision GmbH
 * @license    	http://opensource.org/licenses/osl-3.0.php
 *              Open Software License (OSL 3.0)
 * @author      Markus Stockbauer <ms@techdivision.com>
 * @author      Tim Wagner <tw@techdivision.com>
 */
abstract class AbstractReceiver implements MessageReceiver {
	
	/**
	 * The Worker that initialized the receiver.
	 * @var ContainerInterface
	 */
	protected $container = null;
	
	/**
	 * Initializes the receiver with the initializing Worker.
	 *  
	 * @param ContainerInterface $container The container
	 * @return \TechDivision\MessageQueueClient\Interfaces\MessageReceiver
	 */
	public function setContainer(ContainerInterface $container) {
	    $this->container = $container;
	    return $this;
	}
	
	/**
	 * Updates the message monitor over the 
	 * Worker's method.
	 * 
	 * @param Message $message The message to update the monitor for
	 * @return void
	 * @throws \Exception Is thrown if no Worker exists
	 */
	protected function updateMonitor(Message $message) {
		if (!empty($this->container)) {
		    // if a Worker exists update the monitor
			$this->container->updateMonitor($message);
		} else { 
		    // else, throw an exception
			throw new \Exception("Necessary Worker does not exist");
		}
	}
}