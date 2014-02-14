<?php
/**
 * TechDivision\MessageQueueClient\Utils\PriorityKeyLow
 *
 * PHP version 5
 *
 * @category   Appserver
 * @package    TechDivision_MessageQueueClient
 * @subpackage Utils
 * @author     Markus Stockbauer <ms@techdivision.com>
 * @author     Tim Wagner <tw@techdivision.com>
 * @copyright  2013 TechDivision GmbH <info@techdivision.com>
 * @license    http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link       http://www.appserver.io
 */

namespace TechDivision\MessageQueueClient\Utils;

use TechDivision\MessageQueueClient\Utils\PriorityKey;

/**
 * This class holds the PriorityKey used
 * for low priority messages.
 *
 * @category   Appserver
 * @package    TechDivision_MessageQueueClient
 * @subpackage Utils
 * @author     Markus Stockbauer <ms@techdivision.com>
 * @author     Tim Wagner <tw@techdivision.com>
 * @copyright  2013 TechDivision GmbH <info@techdivision.com>
 * @license    http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link       http://www.appserver.io
 */
class PriorityLow implements PriorityKey
{

    /**
     * Holds the key for messages with a low priority.
     * @var integer
     */
    const KEY = 1;

    /**
     * The string value for the low PriorityKey.
     * @var string
     */
    protected $priority = "low";

    /**
     * Private constructor for marking
     * the class as utiltiy.
     *
     * @return void
     */
    final protected function __construct()
    {
        /* Class is a utility class */
    }

    /**
     * Returns a new instance of the PriorityKey.
     *
     * @return PriorityLow The instance
     */
    public static function get()
    {
        return new PriorityLow();
    }

    /**
     * Returns the key value of the
     * PriorityKey instance.
     *
     * @return integer The key value
     */
    public function getPriority()
    {
        return PriorityLow::KEY;
    }

    /**
     * Returns the string value for the low PriorityKey.
     *
     * @return string The string value
     */
    public function __toString()
    {
        return $this->priority;
    }
}
