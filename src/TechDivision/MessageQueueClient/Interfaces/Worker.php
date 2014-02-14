<?php

/**
 * TechDivision\MessageQueueClient\Interfaces\Worker
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
 * The interface for all handlers.
 *
 * @category   Appserver
 * @package    TechDivision_MessageQueueClient
 * @subpackage Interfaces
 * @author     Tim Wagner <tw@techdivision.com>
 * @copyright  2013 TechDivision GmbH <info@techdivision.com>
 * @license    http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link       http://www.appserver.io
 */
interface Worker
{
    
    /**
     * Updates the message monitor.
     * 
     * @param Message $message The message to update the monitor for
     *
     * @return void
     */
    public function updateMonitor(Message $message);
}
