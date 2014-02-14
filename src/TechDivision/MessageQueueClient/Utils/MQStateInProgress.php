<?php
/**
 * TechDivision\MessageQueueClient\Utils\MQStateInProgress
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
 * This class holds the MQStateKey used
 * for messages in progress.
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
class MQStateInProgress implements MQStateKey
{

    /**
     * Holds the key for messages with an in progress state.
     * @var integer
     */
    const KEY = 4;

    /**
     * The string value for the 'inProgress' MQStateKey.
     * @var string
     */
    protected $state = "inProgress";

    /**
     * Private constructor for marking
     * the class as utiltiy.
     */
    final protected function __construct()
    {
        /* Class is a utility class */
    }

    /**
     * Returns a new instance of the MQStateKey.
     *
     * @return MQStateInProgress The instance
     */
    public static function get()
    {
        return new MQStateInProgress();
    }

    /**
     * Returns the key value of the
     * StateKey instance.
     *
     * @return integer The key value
     */
    public function getState()
    {
        return MQStateInProgress::KEY;
    }

    /**
     * Returns the string value for the high MQStateKey.
     *
     * @return string The string value
     */
    public function __toString()
    {
        return $this->state;
    }
}
