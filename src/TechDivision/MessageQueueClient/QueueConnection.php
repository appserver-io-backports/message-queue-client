<?php
	 
namespace TechDivision\MessageQueueClient;

use TechDivision\Socket\Client;
use TechDivision\MessageQueueClient\QueueSession;
use TechDivision\MessageQueueClient\QueueResponse;
use TechDivision\MessageQueueClient\Interfaces\Message;

/**
 * @package	mqclient
 * @author	wagnert <tw@struts4php.org>
 * @version $Revision: 1.5 $ $Date: 2009-01-03 13:11:54 $
 * @copyright struts4php.org
 * @link www.struts4php.org
 */
class QueueConnection {
	
	/**
	 * TREU if the connection was already established, else FALSE.
	 * @var boolean
	 */
	private $connected = false;

	/**
	 * Holds the IP address or domain name of the server the message queue is running on.
	 * @var string
	 */
	private $address = "127.0.0.1";
	
	/**
	 * Holds the port for the connection.
	 * @var integer
	 */
	private $port = 8587;
	
	/**
	 * Holds the flag to use a persistent server connection, if yes the flag is TRUE.
	 * @var boolean
	 */
	private $persistent = true;
	
	/**
	 * Holds the connection timeout in seconds or null for no timeout.
	 * @var integer
	 */
	private $timeout = null;

	/**
	 * Holds an ArrayList with the initialized sessions.
	 * @var ArrayList
	 */
	private $sessions = null;
	
	/**
	 * Holds the socket for the connection.
	 * @var Net_Socket
	 */
	private $socket = null;
	
	/**
	 * The actual connection id.
	 * @var integer
	 */
	private $id = 0;
	
	/**
	 * Is TRUE if the connection should be validated, else FALSE.
	 * @var boolean
	 */
	private $validate = false;
	
	/**
	 * Initializes the QueueConnection and the
	 * socket.
	 * 
	 * @return void
	 */
	public function __construct() {
		$this->sessions = new \ArrayObject();
	}

	/**
	 * Initializes the connection by starting
	 * the socket.
	 * 
	 * @return void
	 * @throws Exception Is thrown if connection can't be established
	 */
	protected function connect() {
	    
		// check if the connection was already established
		if ($this->connected === false) {
		    
			// if not, try to connect to the MessageQueue
            $socket = new Client($this->getAddress(), $this->getPort());
            
            $this->setSocket($socket->start()->setBlock());
			
			// check if the connection should be validated
			if ($this->validate === true) {
            
    			// read the response from the Socket
    			$response = $this->getSocket()->readLine();
			    
				// check the QueueResponse
				$queueResponse = QueueResponse::parse($response);
				
				// parse and return the connection id
				$this->id = $queueResponse->getMessage();
			}
			
			// set the the connected flag
			$this->connected = true;
		}
	}

	/**
	 * Sets the IP address or domain name of the server the 
	 * message queue is running on.
	 * 
	 * @param string $server Holds the server to connect to
	 * @return void
	 */
	public function setAddress($address) {
		$this->address = $address;
	}

	/**
	 * Returns the IP address or domain name of the server the 
	 * message queue is running on.
	 * 
	 * @return string Holds the server to connect to
	 */
	public function getAddress() {
	    return $this->address;
	}

	/**
	 * Sets  the port for the connection.
	 * 
	 * @param integer $port Holds the port for the connection
	 * @return void
	 */
	public function setPort($port) {
		$this->port = $port;
	}
	
	/**
	 * Return's the port for the connection.
	 * 
	 * @return integer The port to use
	 */
	public function getPort() {
	    return $this->port;
	}
	
	/**
	 * Set's the client socket instance.
	 * 
	 * @param \TechDivision\Socket\Client $socket The client socket instance 
	 * @return \TechDivision\MessageQueueClient\QueueConnection The connection instance
	 */
	public function setSocket($socket) {
	    $this->socket = $socket;
	}
	
	/**
	 * Return's the client socket instance.
	 * 
	 * @return \TechDivision\Socket\Client The socket instance
	 */
	public function getSocket() {
	    return $this->socket;
	}

	/**
	 * Sets  the connection timeout in seconds.
	 * 
	 * @param integer $port Holds the connection timeout
	 * @return void
	 */
	public function setTimeout($timeout) {
		$this->timeout = $timeout;
	}

	/**
	 * Sets  the flag to use a persistent server 
	 * connection to TRUE.
	 * 
	 * @param boolean $persistent Holds  the flag to use a persistent server connection or not
	 * @return void
	 */
	public function setPersistent($persistent = true) {
		$this->persistent = $persistent;
	}
	
	/**
	 * Closes the connection to the server by
	 * closing the socket.
	 * 
	 * @return void
	 * @throws Exception Is thrown if connection can't be closed
	 */
	public function disconnect() {
		
	    // close the connection
	    $this->getSocket()->close();
	    
		// set the disconnected flag to false
		$this->connected = false;
	}
	
	/**
	 * Has to be invoked to validate that the 
	 * connection was successfully established.
	 * 
	 * @return void
	 */
	public function validate() {
		$this->validate = true;
	}

	/**
	 * Sends a Message to the server by writing
	 * it to the socket.
	 * 
	 * @param \TechDivision\MessageQueueClient\Interfaces\Message $message Holds the message to send
	 * @param boolean $validateResponse If this flag is true, the QueueConnection waits for the MessageQueue response and validates it 
	 * @return \TechDivision\MessageQueueClient\QueueResponse The response of the MessageQueue, or null
	 */
	public function send(Message $message, $validateResponse) {

        // init connection
        $this->connect();

		// throw an exception if the connection is not established
		if ($this->connected === false) {
			throw new Exception("Can't send message because connection is not established");
		}
		
		// write the Message to the MessageQueue
		$this->getSocket()->sendLine(serialize($message));
		
		// check if the QueueResponse has to be validated
		if ($validateResponse === true) {
		    
			// read the response from the Socket
			$response = $this->getSocket()->readLine();
			
			// return the QueueResponse
			return QueueResponse::parse($response);
		}

        // disconnect connection
        $this->disconnect();
		
		// return without to wait and validate the QueueResponse
		return;
	}

	/**
	 * Initializes a new QueueSession instance, registers it 
	 * in the ArrayList with the open sessions and returns it.
	 * 
	 * @return QueueSession The initialized QueueSession instance
	 */
	public function createQueueSession() {
        /**
         * Disabled session stream socket type of connection.
         *
         * @author  Johann Zelger <jz@techdivision.com>
         */
        // establish a connection
		// $this->connect();
		
		// initialize and register the session
		$session = new QueueSession($this);
		
		// return the session
		return $this->sessions[] = $session;
	}
	
	/**
	 * Returns the connection id.
	 * 
	 * @return integer The unique id
	 */
	public function getId() {
		return $this->id;	
	}
	
	/**
	 * Returns TRUE if the connection is established,
	 * else FALSE.
	 * 
	 * @return boolean TRUE if the connection is established, else FALSE
	 */
	public function isConnected() {
		return $this->connected;		
	}
}
