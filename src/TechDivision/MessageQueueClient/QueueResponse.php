<?php
	 
namespace TechDivision\MessageQueueClient;

/**
 * @package	mqclient
 * @author	wagnert <tw@struts4php.org>
 * @version $Revision: 1.1 $ $Date: 2008-12-31 12:39:41 $
 * @copyright struts4php.org
 * @link www.struts4php.org
 */
class QueueResponse {
	
	/**
	 * Holds the response parts.
	 * @var array
	 */
	private $regs = array();
	
	/**
	 * Initializes the QueueResponse with the parts 
	 * splitted from the MessageQueue response.
	 *  
	 * @param array $regs The respons parts
	 * @return void
	 */
	private function __construct($regs) {
		$this->regs = $regs;
	}
	
	/**
	 * Returns true if the Message was successfully delivered
	 * to the MessageQueue.
	 * 
	 * @return boolean True if the Message was successfully delivered, else false
	 */
	public function success() {
		// if the Message was delivered successfully return true
		if (($code = $this->regs[2]) == 200) {
			return true;
		}
		// else false
		return false;
	}
	
	/**
	 * Returns the status from the
	 * MessageQueue response.
	 * 
	 * @return integer The status itself
	 */
	public function getStatus() {
		return $this->regs[2];
	}
	
	/**
	 * Returns the status message from the
	 * MessageQueue response.
	 * 
	 * @return string The status message
	 */
	public function getMessage() {
		return $this->regs[3];
	}
	
	/**
	 * Parses the MessageQueue response passed as String and 
	 * initializes the QueueResponse with the splitted values.
	 * 
	 * @param string $response The response from the MessageQueue
	 * @return QueueResponse The initialized instance
	 * @static
	 * @throws Exception Is thrown if an invalid response was sent from the server
	 */
	public static function parse($response) {
		// initialize the array for the MessageQueue response parts
		$regs = array();
        // split lines
        $lines = explode("\r\n", $response->stringValue());
		// split the response into parts		
        if (!preg_match("'(MQ/[^ ]+) ([^ ]+) ([^ ]+)'", $lines[0], $regs)) {
            throw new Exception("Invalid MessageQueue response " . $response->stringValue());
        }
	    // initialize the QueueResponse with the response parts
	  	return new QueueResponse($regs);      
	}
}