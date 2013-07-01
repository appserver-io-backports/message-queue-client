<?php
	 
namespace TechDivision\MessageQueueClient;

/**
 * @package	mqclient
 * @author	wagnert <tw@struts4php.org>
 * @version $Revision: 1.2 $ $Date: 2008-10-17 09:44:23 $
 * @copyright struts4php.org
 * @link www.struts4php.org
 */
class Queue {

	/**
	 * The queue name to use.
	 * @var string
	 */
	private $name = null;

	/**
	 * Initializes the queue with the name to use.
	 * 
	 * @param string $name Holds the queue name to use
	 * @return void
	 */
	private function __construct($name) {
		$this->name = $name;
	}

	/**
	 * Returns the queue name.
	 * 
	 * @return string The queue name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Initializes and returns a new Queue instance.
	 * 
	 * @param string Holds the queue name to use
	 * @return \TechDivision\MessageQueueClient\Queue The instance
	 */
	public static function createQueue($name) {
		return new Queue($name);
	}
}