<?php
/**
 * TechDivision\MessageQueueClient\Utils\PriorityKeyMedium
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
 * for medium priority messages.
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
class PriorityMedium implements PriorityKey
{

    /**
     * Holds the key for messages with a medium priority.
     * @var integer
     */
    const KEY = 2;

    /**
     * The string value for the medium PriorityKey.
     * @var string
     */
    protected $priority = "medium";

    /**
     * Private constructor for marking
     * the class as utiltiy.
     */
    final protected function __construct()
    {
        /* Class is a utility class */
    }

    /**
     * Returns a new instance of the PriorityKey.
     *
     * @return PriorityMedium The instance
     */
    public static function get()
    {
        return new PriorityMedium();
    }

    /**
     * Returns the key value of the
     * PriorityKey instance.
     *
     * @return integer The key value
     */
    public function getPriority()
    {
        return PriorityMedium::KEY;
    }

    /**
     * Returns the string value for the medium PriorityKey.
     *
     * @return string The string value
     */
    public function __toString()
    {
        return $this->priority;
    }
}
