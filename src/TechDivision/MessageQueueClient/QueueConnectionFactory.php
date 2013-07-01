<?php
	 
namespace TechDivision\MessageQueueClient;
 
use TechDivision\MessageQueueClient\QueueConnection;

/**
 * @package	mqclient
 * @author	wagnert <tw@struts4php.org>
 * @version $Revision: 1.2 $ $Date: 2008-10-17 09:44:23 $
 * @copyright struts4php.org
 * @link www.struts4php.org
 */
class QueueConnectionFactory {
	
	/**
	 * Private constructor to use class only in static context.
	 * 
	 * @return  void
	 */
	protected function __construct() {}
	
	/**
	 * Returns the QueueConnection instance as singleton.
	 * 
	 * @return QueueConnection The singleton instance
	 */
	public static function createQueueConnection() {
		return new QueueConnection();
	}
}