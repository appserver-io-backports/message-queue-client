<?php
/**
 * TechDivision\MessageQueueClient\Messages\ArrayMessage
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

use TechDivision\MessageQueueClient\Messages\AbstractMessage;

/**
 * The implementation for sending a message containing
 * data encapsulated in an array.
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
class ArrayMessage extends AbstractMessage
{

    /**
     * The message id as hash value.
     * @var string
     */
    protected $messageId = null;

    /**
     * The message itself.
     * @var array
     */
    protected $message = null;

    /**
     * Initializes the message with the array
     * to send to the queue.
     *
     * @param array $message The array with the data to send
     */
    public function __construct(array $message)
    {
        // initialize the HashMap sent with the message
        $this->message = $message;
        // initialize the message id
        $this->messageId = md5(uniqid(rand(), true));
    }

    /**
     * Returns the message id.
     *
     * @return string The message id as hash value
     */
    public function getMessageId()
    {
        return $this->messageId;
    }

    /**
     * The message itself.
     *
     * @return array The message itself
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Returns the message as string.
     *
     * @return string The message as string
     */
    public function __toString()
    {
        return serialize($this->message);
    }
}
