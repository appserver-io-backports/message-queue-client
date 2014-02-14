<?php
/**
 * TechDivision\MessageQueueClient\Queue
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
 * Class Queue
 *
 * @category  Appserver
 * @package   TechDivision_MessageQueueClient
 * @author    Tim Wagner <tw@techdivision.com>
 * @copyright 2013 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      http://www.appserver.io
 */
class Queue
{

    /**
     * The queue name to use.
     * @var string
     */
    private $name = null;

    /**
     * Initializes the queue with the name to use.
     *
     * @param string $name Holds the queue name to use
     *
     * @return void
     */
    private function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * Returns the queue name.
     *
     * @return string The queue name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Initializes and returns a new Queue instance.
     *
     * @param string $name Holds the queue name to use
     *
     * @return \TechDivision\MessageQueueClient\Queue The instance
     */
    public static function createQueue($name)
    {
        return new Queue($name);
    }
}
