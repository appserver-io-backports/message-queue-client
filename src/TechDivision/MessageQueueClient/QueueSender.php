<?php
	 
namespace TechDivision\MessageQueueClient;

use \TechDivision\MessageQueueClient\Queue;
use \TechDivision\MessageQueueClient\QueueSession;
use \TechDivision\MessageQueueClient\Interfaces\Message;

/**
 * @package	mqclient
 * @author	wagnert <tw@struts4php.org>
 * @version $Revision: 1.4 $ $Date: 2009-01-03 13:11:54 $
 * @copyright struts4php.org
 * @link www.struts4php.org
 */
class QueueSender {

	/**
	 * Holds the Queue instance used for sending the message.
	 * @var \TechDivision\MessageQueue\Queue
	 */
	protected $queue = null;
	
	/**
	 * Holds the QueueSession instance for sending the message.
	 * @var \TechDivision\MessageQueue\QueueSession
	 */
	protected $session = null;

	/**
	 * Initializes the QueueSender with the QueueSession and Queue instance
	 * to use for sending the Message to the server.
	 * 
	 * @param \TechDivision\MessageQueueClient\QueueSession $session The QueueSession instance for sending the message
	 * @param \TechDivision\MessageQueueClient\Queue $queue The Queue instance used for sending the message
	 * @return void
	 */
	public function __construct(QueueSession $session, Queue $queue) {
		$this->session = $session;
		$this->queue = $queue;
	}

	/**
	 * Sends the passed Message to the server.
	 * 
	 * @param \TechDivision\MessageQueueClient\Message $message the Message to send
	 * @param boolean $validateResponse If this flag is true, the QueueConnection waits for the MessageQueue response and validates it 
	 * @return \TechDivision\MessageQueueClient\QueueResponse The response of the MessageQueue, or null
	 */
	public function send(Message $message, $validateResponse = false) {
		$message->setDestination($this->queue);
		$message->setSessionId($this->session->getId());
		return $this->session->send($message, $validateResponse);
	}
}