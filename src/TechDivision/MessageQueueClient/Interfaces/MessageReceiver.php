<?php
/**
 * TechDivision\MessageQueueClient\Interfaces\MessageReceiver
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

use TechDivision\MessageQueueClient\Interfaces\Message;

/**
 * The interface for all message receivers.
 *
 * @category   Appserver
 * @package    TechDivision_MessageQueueClient
 * @subpackage Interfaces
 * @author     Tim Wagner <tw@techdivision.com>
 * @copyright  2013 TechDivision GmbH <info@techdivision.com>
 * @license    http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link       http://www.appserver.io
 */
interface MessageReceiver
{

    /**
     * This function is invoked by the MessageQueue if a message
     * related to the receiver was received.
     *
     * @param \TechDivision\MessageQueueClient\Interfaces\Message $message   The message itself
     * @param string                                              $sessionId The session ID
     *
     * @return void
     */
    public function onMessage(Message $message, $sessionId);
}
