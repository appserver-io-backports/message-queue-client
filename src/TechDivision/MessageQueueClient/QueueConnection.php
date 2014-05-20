<?php

/**
 * TechDivision\MessageQueueClient\QueueConnection
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

use TechDivision\WebServer\Sockets\StreamSocket;
use TechDivision\MessageQueueProtocol\Message;
use TechDivision\MessageQueueProtocol\QueueResponse;
use TechDivision\MessageQueueProtocol\MessageQueueParser;
use TechDivision\MessageQueueProtocol\MessageQueueProtocol;
use TechDivision\MessageQueueClient\QueueSession;

/**
 * A connection implementation that handles the connection to the message queue.
 *
 * @category  Library
 * @package   TechDivision_MessageQueueClient
 * @author    Tim Wagner <tw@techdivision.com>
 * @copyright 2014 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/TechDivision_MessageQueueClient
 * @link      http://www.appserver.io
 */
class QueueConnection
{

    /**
     * The default transport to use.
     *
     * @var string
     */
    protected $transport = 'tcp';

    /**
     * Holds the IP address or domain name of the server the message queue is running on.
     *
     * @var string
     */
    protected $address = "127.0.0.1";

    /**
     * Holds the port for the connection.
     *
     * @var integer
     */
    protected $port = 8587;

    /**
     * Holds an ArrayList with the initialized sessions.
     *
     * @var ArrayList
     */
    protected $sessions = null;

    /**
     * The message queue parser instance.
     *
     * @var \TechDivision\MessageQueueProtocol\MessageQueueParser
     */
    protected $parser;

    /**
     * Initializes the QueueConnection and the socket.
     */
    public function __construct()
    {
        // initialize the message queue parser and the session
        $this->parser = new MessageQueueParser();
        $this->sessions = new \ArrayObject();
    }

    /**
     * Returns the parser to process the message.
     *
     * @return \TechDivision\MessageQueueProtocol\MessageQueueParser The parser instance
     */
    public function getParser()
    {
        return $this->parser;
    }

    /**
     * Sets the IP address or domain name of the server the
     * message queue is running on.
     *
     * @param string $address Holds the server to connect to
     *
     * @return void
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * Returns the IP address or domain name of the server the
     * message queue is running on.
     *
     * @return string Holds the server to connect to
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Sets  the port for the connection.
     *
     * @param integer $port Holds the port for the connection
     *
     * @return void
     */
    public function setPort($port)
    {
        $this->port = $port;
    }

    /**
     * Returns the port for the connection.
     *
     * @return integer The port to use
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     *  Sets the transport to use.
     *
     * @param integer $transport The transport to use
     *
     * @return void
     */
    public function setTransport($transport)
    {
        $this->transport = $transport;
    }

    /**
     * Returns the transport to use.
     *
     * @return integer The transport to use.
     */
    public function getTransport()
    {
        return $this->transport;
    }

    /**
     * Returns the client socket instance.
     *
     * @return \TechDivision\Socket\Client The socket instance
     */
    public function getSocket()
    {
    }

    /**
     * Initializes the connection by starting the socket.
     *
     * @return void
     */
    protected function connect()
    {
    }

    /**
     * Closes the connection to the server by closing the socket.
     *
     * @return void
     */
    public function disconnect()
    {
    }

    /**
     * Sends a Message to the server by writing it to the socket.
     *
     * @param \TechDivision\MessageQueueClient\Interfaces\Message $message          Holds the message to send
     * @param boolean                                             $validateResponse If this flag is true,
     *      the QueueConnection waits for the MessageQueue response and validates it
     *
     * @return \TechDivision\MessageQueueClient\QueueResponse The response of the MessageQueue, or null
     */
    public function send(Message $message, $validateResponse = false)
    {

        // connect to the persistence container
        $clientConnection = StreamSocket::getClientInstance(
            $this->getTransport() . '://' . $this->getAddress() . ':' . $this->getPort()
        );

        // serialize the message and write it to the socket
        $packed = MessageQueueProtocol::pack($message);

        // invoke the remote method call
        $clientConnection->write(MessageQueueProtocol::prepareMessageHeader($packed));
        $clientConnection->write($packed);

        // check if we should wait for the response and it has to be validated
        if ($validateResponse === true) {
            return $this->getParser()->parseResponse($clientConnection->readLine());
        }
    }

    /**
     * Initializes a new QueueSession instance, registers it
     * in the ArrayList with the open sessions and returns it.
     *
     * @return QueueSession The initialized QueueSession instance
     */
    public function createQueueSession()
    {
        return $this->sessions[] = new QueueSession($this);
    }
}
