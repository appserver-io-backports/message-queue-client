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

use Guzzle\Http\Client;
use Guzzle\Http\Exception\CurlException;
use TechDivision\Server\Sockets\StreamSocket;
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
    const DEFAULT_SCHEME = 'http';

    /**
     * The default client sockets IP address.
     *
     * @var string
     */
    const DEFAULT_HOST = '127.0.0.1';

    /**
     * The default client sockets port.
     *
     * @var integer
     */
    const DEFAULT_PORT = 8587;

    /**
     * The name of the webapp using this client connection.
     *
     * @var string
     */
    protected $appName;

    /**
     * The default transport to use.
     *
     * @var string
     */
    protected $transport = QueueConnection::DEFAULT_SCHEME;

    /**
     * The client socket's IP address.
     *
     * @var string
     */
    protected $address = QueueConnection::DEFAULT_HOST;

    /**
     * The client socket's port.
     *
     * @var integer
     */
    protected $port = QueueConnection::DEFAULT_PORT;

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
     * The HTTP client we use for connection to the persistence container.
     *
     * @var \Guzzle\Http\Client
     */
    protected $client;

    /**
     * Initializes the connection.
     *
     * @param string $appName Name of the webapp using this client connection
     *
     * @return void
     */
    public function __construct($appName = '')
    {

        // set the application name
        $this->appName = $appName;

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
     * Sets the clients webapp name
     *
     * @param string $appName Name of the webapp using this client connection
     *
     * @return void
     */
    public function setAppName($appName)
    {
        $this->appName = $appName;
    }

    /**
     * Returns the name of the webapp this connection is for
     *
     * @return string The webapp name
     */
    public function getAppName()
    {
        return $this->appName;
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
     * Creates the connection to the container.
     *
     * @return void
     */
    public function connect()
    {
        $this->client = new Client($this->getBaseUrl());
    }

    /**
     * Shutdown the connection to the container.
     *
     * @return void
     */
    public function disconnect()
    {
        $this->client = null;
    }

    /**
     * Returns the socket the connection is based on.
     *
     * @return \Guzzle\Http\Client The socket instance
     */
    public function getSocket()
    {
        return $this->client;
    }

    /**
     * Sends a Message to the server by writing it to the socket.
     *
     * @param \TechDivision\MessageQueueClient\Interfaces\Message $message          Holds the message to send
     * @param boolean                                             $validateResponse If this flag is TRUE, the QueueConnection validates the response code
     *
     * @return \TechDivision\MessageQueueClient\QueueResponse The response of the MessageQueue, or null
     */
    public function send(Message $message, $validateResponse = false)
    {
        // connect to the server if necessary
        $this->connect();

        // serialize the message and write it to the socket
        $packed = MessageQueueProtocol::pack($message);

        // invoke the RMC with a number of retries
        $maxRetries = 0;
        $retry = true;
        while ($retry) {

            try {

                // send a POST request
                $request = $this->getSocket()->post($this->getPath(), array('timeout' => 5));
                $request->setBody($packed);
                $response = $request->send();

                $retry = false;

            } catch (CurlException $ce) {

                $maxRetries++;

                if ($maxRetries >= 5) {
                    $retry = false;
                    throw $ce;
                }
            }
        }

        // check if we should validate the response
        if ($validateResponse && $response->getStatusCode() !== 200) {
            throw new \Exception($response->getBody());
        }
    }

    /**
     * Prepares path for the connection to the persistence container.
     *
     * @return string The path to define the persistence container module
     */
    protected function getPath()
    {
        return sprintf('/%s/index.mq', $this->getAppName());
    }

    /**
     * Prepares the base URL we used for the connection
     * to the persistence container.
     *
     * @return string The default base URL
     */
    protected function getBaseUrl()
    {
        // initialize the requeste URL with the default connection values
        return $this->getTransport() . '://' . $this->getAddress() . ':' . $this->getPort();
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
