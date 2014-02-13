<?php
/**
 * TechDivision\MessageQueueClient\Messages\AbstractMessage
 *
 * PHP version 5
 *
 * @category   Appserver
 * @package    TechDivision_MessageQueueClient
 * @subpackage Messages
 * @author     Tim Wagner <tw@techdivision.com>
 * @author     Markus Stockbauer <ms@techdivision.com>
 * @copyright  2013 TechDivision GmbH <info@techdivision.com>
 * @license    http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link       http://www.appserver.io
 */

namespace TechDivision\MessageQueueClient\Messages;
 
use TechDivision\MessageQueueClient\Queue;
use TechDivision\MessageQueueClient\Interfaces\Message;
use TechDivision\MessageQueueClient\Messages\MessageMonitor;
use TechDivision\MessageQueueClient\Utils\PriorityKey;
use TechDivision\MessageQueueClient\Utils\PriorityLow;
use TechDivision\MessageQueueClient\Utils\MQStateKey;
use TechDivision\MessageQueueClient\Utils\MQStateActive;

/**
 * The abstract superclass for all messages.
 *
 * @category   Appserver
 * @package    TechDivision_MessageQueueClient
 * @subpackage Messages
 * @author     Tim Wagner <tw@techdivision.com>
 * @author     Markus Stockbauer <ms@techdivision.com>
 * @copyright  2013 TechDivision GmbH <info@techdivision.com>
 * @license    http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link       http://www.appserver.io
 */
abstract class AbstractMessage implements Message
{

    /**
     * The unique session id.
     * @var string
     */
    protected $sessionId = "";

    /**
     * The destination Queue to send the message to.
     * @var Queue
     */
    protected $destination = null;

    /**
     * The parent message.
     * @var \TechDivision\MessageQueueClient\Interfaces\Message
     */
    protected $parentMessage = null;

    /**
     * The monitor for monitoring the message.
     * @var \TechDivision\MessageQueueClient\Messages\MessageMonitor
     */
    protected $messageMonitor = null;

    /**
     * The priority of the message, defaults to 'low'.
     * @var integer
     */
    protected $priority = PriorityLow::KEY;

    /**
     * The state of the message, defaults to 'active'.
     * @var integer
     */
    protected $state = MQStateActive::KEY;

    /**
     * The flag if the message should be deleted when finished or not.
     * @var boolean
     */
    protected $locked = false;

    /**
     * Sets the unique session id.
     *
     * @param string $sessionId The uniquid id
     *
     * @return void
     */
    public function setSessionId($sessionId)
    {
        $this->sessionId = $sessionId;
    }

    /**
     * Returns the unique session id.
     *
     * @return string The uniquid id
     */
    public function getSessionId()
    {
        return $this->sessionId;
    }

    /**
     * Sets the destination Queue.
     *
     * @param \TechDivision\MessageQueueClient\Queue $destination The destination
     *
     * @return void
     */
    public function setDestination(Queue $destination)
    {
        $this->destination = $destination;
    }

    /**
     * Returns the destination Queue.
     *
     * @return \TechDivision\MessageQueueClient\Queue The destination Queue
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * Sets the priority of the message.
     *
     * @param \TechDivision\MessageQueueClient\Utils\PriorityKey $priority The priority to set the message to
     *
     * @return void
     */
    public function setPriority(PriorityKey $priority)
    {
        $this->priority = $priority->getPriority();
    }

    /**
     * Returns the priority of the message.
     *
     * @return \TechDivision\MessageQueueClient\Utils\PriorityKey The priority of the message
     */
    public function getPriority()
    {
        return PriorityKeys::get($this->priority);
    }

    /**
     * Sets the state of the message.
     *
     * @param \TechDivision\MessageQueueClient\Utils\MQStateKey $state The new state
     *
     * @return void
     */
    public function setState(MQStateKey $state)
    {
        $this->state = $state->getState();
    }

    /**
     * Returns the state of the message.
     *
     * @return \TechDivision\MessageQueueClient\Utils\MQStateKey The message state
     */
    public function getState()
    {
        return MQStateKeys::get($this->state);
    }

    /**
     * Sets the parent message.
     *
     * @param \TechDivision\MessageQueueClient\Interfaces\Message $parentMessage The parent message
     *
     * @return void
     */
    public function setParentMessage(Message $parentMessage)
    {
        $this->parentMessage = $parentMessage;
    }

    /**
     * Returns the parent message.
     *
     * @return \TechDivision\MessageQueueClient\Interfaces\Message The parent message
     * @see Message::getParentMessage()
     */
    public function getParentMessage()
    {
        return $this->parentMessage;
    }

    /**
     * Sets the monitor for monitoring the
     * message itself.
     *
     * @param \TechDivision\MessageQueueClient\Messages\MessageMonitor $messageMonitor The monitor
     *
     * @return void
     */
    public function setMessageMonitor(MessageMonitor $messageMonitor)
    {
        $this->messageMonitor = $messageMonitor;
    }

    /**
     * Returns the message monitor.
     *
     * @return MessageMonitor The monitor
     * @see Message::getMessageMonitor()
     */
    public function getMessageMonitor()
    {
        return $this->messageMonitor;
    }

    /**
     * Locks the message.
     *
     * @return void
     */
    public function lock()
    {
        $this->locked = true;
    }

    /**
     * Unlocks the message.
     *
     * @return void
     */
    public function unlock()
    {
        $this->locked = false;
    }

    /**
     * Returns the message lock flag.
     *
     * @return boolean TRUE if the message is locked, else FALSE
     */
    public function isLocked()
    {
        return $this->locked;
    }
}
