<?php
/**
 * TechDivision\MessageQueueClient\QueueSession
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

use \TechDivision\MessageQueueProtocol\Queue;
use \TechDivision\MessageQueueProtocol\Message;
use \TechDivision\MessageQueueClient\QueueSender;
use \TechDivision\MessageQueueClient\QueueConnection;

/**
 * Class QueueSession
 *
 * @category  Library
 * @package   TechDivision_MessageQueueClient
 * @author    Tim Wagner <tw@techdivision.com>
 * @copyright 2014 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/TechDivision_MessageQueueClient
 * @link      http://www.appserver.io
 */
class QueueSession
{

    /**
     * Holds the QueueConnection instance to use for the server connect.
     *
     * @var \TechDivision\MessageQueueClient\QueueConnection
     */
    protected $connection = null;

    /**
     * Holds the unique session id.
     *
     * @var string
     */
    protected $id = null;

    /**
     * Initializes the session with the QueueConnection instance
     * to use for the server connection.
     *
     * @param \TechDivision\MessageQueueClient\QueueConnection $connection Holds the QueueConnection instance to use
     */
    public function __construct(QueueConnection $connection)
    {
        // initialize the internal connection
        $this->connection = $connection;
        // generate and return the unique session id
        return $this->id = md5(uniqid(rand(), true));
    }

    /**
     * Sends the passed Message instance to the server,
     * using the QueueConnection instance.
     *
     * @param \TechDivision\MessageQueueClient\Interfaces\Message $message          The message to send
     * @param boolean                                             $validateResponse If this flag is true, the QueueConnection waits for the MessageQueue response and validates it
     *
     * @return \TechDivision\MessageQueueClient\QueueResponse The response of the MessageQueue, or null
     */
    public function send(Message $message, $validateResponse)
    {
        return $this->connection->send($message, $validateResponse);
    }

    /**
     * Creates and returns a new QueueSender instance for sending
     * the Message to the server.
     *
     * @param \TechDivision\MessageQueueClient\Queue $queue the Queue instance to use for sending the message
     *
     * @return \TechDivision\MessageQueueClient\QueueSender The initialized QueueSender instance
     */
    public function createSender(Queue $queue)
    {
        return new QueueSender($this, $queue);
    }

    /**
     * Returns the session id.
     *
     * @return string The unique id
     */
    public function getId()
    {
        return $this->id;
    }
}
