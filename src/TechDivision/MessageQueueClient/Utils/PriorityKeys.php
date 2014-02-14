<?php
/**
 * TechDivision\MessageQueueClient\Utils\PriorityKeys
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

use TechDivision\MessageQueueClient\Utils\PriorityLow;
use TechDivision\MessageQueueClient\Utils\PriorityMedium;
use TechDivision\MessageQueueClient\Utils\PriorityHigh;

/**
 * This class holds the priority keys used
 * as message priority.
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
class PriorityKeys
{

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
     * Returns the initialized PriorityKey for the
     * passed priority key.
     *
     * @param integer $key The priority key to return the instance for
     *
     * @return PriorityKey The instance
     */
    public static function get($key)
    {
        switch($key) { // check the passed key and return the requested PriorityKey instance
            case 1:
                return PriorityLow::get();
                break;
            case 2:
                return PriorityMedium::get();
                break;
            case 3:
                return PriorityHigh::get();
                break;
            default:
                throw new Exception("PriorityKey with key $key doesn't exist");
        }
    }
}
