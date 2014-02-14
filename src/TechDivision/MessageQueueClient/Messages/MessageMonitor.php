<?php
/**
 * TechDivision\MessageQueueClient\MessageMonitor
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

/**
 * Class MessageMonitor
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
class MessageMonitor
{

    /**
     * The target counter for monitoring the message.
     * @var integer
     */
    protected $target = 0;

    /**
     * The row counter for monitoring the message.
     * @var integer
     */
    protected $rowCount = 0;

    /**
     * The log message for monitoring the message.
     * @var string
     */
    protected $logMessage = '';

    /**
     * Initializes the queue with the name to use.
     *
     * @param int    $target     The target
     * @param string $logMessage Holds the queue name to use
     */
    public function __construct($target, $logMessage)
    {
        $this->target = $target;
        $this->logMessage = $logMessage;
    }

    /**
     * Sets the log message.
     *
     * @param string $logMessage The log message
     *
     * @return void
     */
    public function setLogMessage($logMessage)
    {
        $this->logMessage = $logMessage;
    }

    /**
     * Returns the row counter.
     *
     * @param integer $rowCount The row counter
     *
     * @return void
     */
    public function setRowCount($rowCount)
    {
        $this->rowCount = $rowCount;
    }

    /**
     * Returns the log message.
     *
     * @return string The log message
     */
    public function getLogMessage()
    {
        return $this->logMessage;
    }

    /**
     * Returns the row counter.
     *
     * @return integer The row counter
     */
    public function getRowCount()
    {
        return $this->rowCount;
    }

    /**
     * Returns the target counter.
     *
     * @return integer The target counter
     */
    public function getTarget()
    {
        return $this->target;
    }
}
