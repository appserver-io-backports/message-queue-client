<?php
/**
 * TechDivision\MessageQueueClient\QueueConnectionFactory
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

use TechDivision\MessageQueueClient\QueueConnection;

/**
 * Class QueueConnectionFactory
 *
 * @category  Library
 * @package   TechDivision_MessageQueueClient
 * @author    Tim Wagner <tw@techdivision.com>
 * @copyright 2014 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/TechDivision_MessageQueueClient
 * @link      http://www.appserver.io
 */
class QueueConnectionFactory
{

    /**
     * Private constructor to use class only in static context.
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
