<?php
/**
 * TechDivision\MessageQueueClient\QueueResponse
 *
 * PHP version 5
 *
 * @category  Appserver
 * @package   TechDivision_MessageQueueClient
 * @author    Tim Wagner <tw@techdivision.com>
 * @copyright 2013 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      http://www.appserver.io
 */

namespace TechDivision\MessageQueueClient;

/**
 * Class QueueResponse
 *
 * @category  Appserver
 * @package   TechDivision_MessageQueueClient
 * @author    Tim Wagner <tw@techdivision.com>
 * @copyright 2013 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      http://www.appserver.io
 */
class QueueResponse
{

    /**
     * Holds the response parts.
     * @var array
     */
    private $regs = array();

    /**
     * Initializes the QueueResponse with the parts splitted from the MessageQueue response.
     *
     * @param array $regs The respons parts
     */
    private function __construct($regs)
    {
        $this->regs = $regs;
    }

    /**
     * Returns true if the Message was successfully delivered
     * to the MessageQueue.
     *
     * @return boolean True if the Message was successfully delivered, else false
     */
    public function success()
    {
        // if the Message was delivered successfully return true
        if (($code = $this->regs[2]) == 200) {
            return true;
        }
        // else false
        return false;
    }

    /**
     * Returns the status from the
     * MessageQueue response.
     *
     * @return integer The status itself
     */
    public function getStatus()
    {
        return $this->regs[2];
    }

    /**
     * Returns the status message from the
     * MessageQueue response.
     *
     * @return string The status message
     */
    public function getMessage()
    {
        return $this->regs[3];
    }

    /**
     * Parses the MessageQueue response passed as String and
     * initializes the QueueResponse with the split values.
     *
     * @param string $response The response from the MessageQueue
     *
     * @return QueueResponse The initialized instance
     * @throws Exception Is thrown if an invalid response was sent from the server
     * @static
     */
    public static function parse($response)
    {
        // initialize the array for the MessageQueue response parts
        $regs = array();
        // split lines
        $lines = explode("\r\n", $response->stringValue());
        // split the response into parts
        if (!preg_match("'(MQ/[^ ]+) ([^ ]+) ([^ ]+)'", $lines[0], $regs)) {
            throw new Exception("Invalid MessageQueue response " . $response->stringValue());
        }
        // initialize the QueueResponse with the response parts
        return new QueueResponse($regs);
    }
}
