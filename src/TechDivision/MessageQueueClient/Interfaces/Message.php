<?php
/**
 * TechDivision\MessageQueueClient\Interfaces\Message
 *
 * PHP version 5
 *
 * @category   Appserver
 * @package    TechDivision_MessageQueueClient
 * @subpackage Interfaces
 * @author     Tim Wagner <tw@techdivision.com>
 * @copyright  2013 TechDivision GmbH <info@techdivision.com>
 * @license    http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link       http://www.appserver.io
 */

namespace TechDivision\MessageQueueClient\Interfaces;

/**
 * The interface for all messages.
 *
 * @category   Appserver
 * @package    TechDivision_MessageQueueClient
 * @subpackage Interfaces
 * @author     Tim Wagner <tw@techdivision.com>
 * @copyright  2013 TechDivision GmbH <info@techdivision.com>
 * @license    http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link       http://www.appserver.io
 */
interface Message
{

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
     *
     * @return void
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
