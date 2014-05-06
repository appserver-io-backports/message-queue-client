<?php

/**
 * TechDivision\MessageQueueClient\Queue
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

use TechDivision\MessageQueueProtocol\Queue as MessageQueue;

/**
 * Class Queue
 *
 * @category  Library
 * @package   TechDivision_MessageQueueClient
 * @author    Tim Wagner <tw@techdivision.com>
 * @copyright 2014 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/TechDivision_MessageQueueClient
 * @link      http://www.appserver.io
 */
class Queue implements MessageQueue
{

    /**
     * The queue name to use.
     *
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
