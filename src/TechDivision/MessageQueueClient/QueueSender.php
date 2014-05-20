<?php
/**
 * TechDivision\MessageQueueClient\QueueSender
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * PHP version 5
 *
 * @category  Library
 * @package   TechDivision_MessageQueueClient
 * @author    Tim Wagner <tw@techdivision.com>
 * @copyright 2014 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/TechDivision_MessageQueueClient
 * @link      http://www.appserver.io
 */

namespace TechDivision\MessageQueueClient;

use \TechDivision\MessageQueueProtocol\Message;
use \TechDivision\MessageQueueProtocol\Queue;
use \TechDivision\MessageQueueClient\QueueSession;

/**
 * Class QueueSender
 *
 * @category  Library
 * @package   TechDivision_MessageQueueClient
 * @author    Tim Wagner <tw@techdivision.com>
 * @copyright 2014 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/TechDivision_MessageQueueClient
 * @link      http://www.appserver.io
 */
class QueueSender
{

    /**
     * Holds the Queue instance used for sending the message.
     *
     * @var \TechDivision\MessageQueue\Queue
     */
    protected $queue = null;

    /**
     * Holds the QueueSession instance for sending the message.
     *
     * @var \TechDivision\MessageQueueClient\QueueSession
     */
    protected $session = null;

    /**
     * Initializes the QueueSender with the QueueSession and Queue instance
     * to use for sending the Message to the server.
     *
     * @param \TechDivision\MessageQueueClient\QueueSession $session The QueueSession instance for sending the message
     * @param \TechDivision\MessageQueueClient\Queue        $queue   The Queue instance used for sending the message
     */
    public function __construct(QueueSession $session, Queue $queue)
    {
        $this->session = $session;
        $this->queue = $queue;
    }

    /**
     * Sends the passed Message to the server.
     *
     * @param \TechDivision\MessageQueueProtocol\Message $message          the Message to send
     * @param boolean                                    $validateResponse If this flag is true, the QueueConnection waits for the MessageQueue response and validates it
     *
     * @return \TechDivision\MessageQueueClient\QueueResponse The response of the MessageQueue, or null
     */
    public function send(Message $message, $validateResponse = false)
    {
        $message->setDestination($this->queue);
        $message->setSessionId($this->session->getId());
        return $this->session->send($message, $validateResponse);
    }
}
