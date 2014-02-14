<?php
/**
 * TechDivision\MessageQueueClient\QueueConnectionFactory
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
 
use TechDivision\MessageQueueClient\QueueConnection;

/**
 * Class QueueConnectionFactory
 *
 * @category  Appserver
 * @package   TechDivision_MessageQueueClient
 * @author    Tim Wagner <tw@techdivision.com>
 * @copyright 2013 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      http://www.appserver.io
 */
class QueueConnectionFactory
{

    /**
     * Private constructor to use class only in static context.
     *
     * @return  void
     */
    protected function __construct()
    {

    }

    /**
     * Returns the QueueConnection instance as singleton.
     *
     * @return QueueConnection The singleton instance
     */
    public static function createQueueConnection()
    {
        return new QueueConnection();
    }
}
