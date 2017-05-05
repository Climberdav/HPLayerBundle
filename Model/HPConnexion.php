<?php

namespace ClimberdavHPLayerBundle\Model;

use ClimberdavHPLayerBundle\Traits\AdminTrait;
use ClimberdavHPLayerBundle\Traits\StudentTrait;
use ClimberdavHPLayerBundle\Traits\SubjectTrait;

class HPConnexion
{
    use AdminTrait, StudentTrait, SubjectTrait;

    /**
     * @var string
     */
    private $host;
    /**
     * @var integer
     */
    private $port;
    /**
     * @var string
     */
    private $root;
    /**
     * @var string
     */
    private $login;
    /**
     * @var string
     */
    private $password;
    /**
     * @var string
     */
    private $protocol;
    /**
     * @var
     */
    private $wsdl;
    /**
     * @var boolean
     */
    private $connected = false;

    /**
     * @var mixed
     */
    protected $wsdlClient;

    /**
     * HPConnexion constructor.
     * @param array|null $options
     */
    public function __construct(array $options = null)
    {
        $this->host = $options['host'];
        $this->login = $options['login'];
        $this->protocol = $options['protocol'];
        $this->password = $options['password'];
        $this->root= $options['root'];
        $this->port = $options['port'];
        $this->setWsdl();
    }

    /**
     * @return mixed
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param mixed $host
     */
    public function setHost($host)
    {
        $this->host = $host;
        $this->setWsdl();
    }

    /**
     * @return mixed
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @param mixed $port
     */
    public function setPort($port)
    {
        $this->port = $port;
        $this->setWsdl();
    }

    /**
     * @return mixed
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * @param mixed $root
     */
    public function setRoot($root)
    {
        $this->root = $root;
        $this->setWsdl();

    }

    /**
     * @param mixed $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getProtocol()
    {
        return $this->protocol;
    }

    /**
     * @param mixed $protocol
     */
    public function setProtocol($protocol)
    {
        $this->protocole = $protocol;
        $this->setWsdl();
    }

    /**
     * @return mixed
     */
    public function getWsdl()
    {
        return $this->wsdl;
    }

    /**
     *
     */
    public function setWsdl()
    {
        $this->wsdl = $this->protocol.'://'.$this->host.':'.$this->port.'/'.$this->root.'/wsdl/RpcEncoded';
        $this->connected = $this->connect() == true ? true : false;
        $this->wsdlClient = $this->connect();
    }

    /**
     * @return bool
     */
    public function isConnected()
    {
        return $this->connected;
    }

    /**
     * @param bool $connected
     */
    public function setConnected($connected)
    {
        $this->connected = $connected;
    }

    private function connect()
    {
        try{
            return new \SoapClient($this->wsdl,array("login" => $this->login,"password" => $this->password));
        }catch (\SoapFault $e){
        }
    }

}