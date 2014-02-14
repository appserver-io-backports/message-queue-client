<?php
/**
 * TechDivision\MessageQueueClient\Utils\MQStateUnknown
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

use TechDivision\MessageQueueClient\Utils\MQStateKey;

/**
 * This class holds the MQStateKey used for
 * messages with unknown state.
 * 
 * Messages are turned to this state when they 
 * are running longer than ten minutes.
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
class MQStateUnknown implements MQStateKey
{

    /**
     * Holds the state key for failed messages.
     * @var integer
     */
    const KEY = 7;

    /**
     * The string value for the 'unknown' MQStateKey.
     * @var string
     */
    protected $state = "unknown";

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
     * Returns a new instance of the MQStateKey.
     *
     * @return MQStateUnknown The instance
     */
    public static function get()
    {
        return new MQStateUnknown();
    }

    /**
     * Returns the key value of the
     * StateKey instance.
     *
     * @return integer The key value
     */
    public function getState()
    {
        return MQStateUnknown::KEY;
    }

    /**
     * Returns the string value for the MQStateKey.
     *
     * @return string The string value
     */
    public function __toString()
    {
        return $this->state;
    }
}
