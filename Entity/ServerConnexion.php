<?php

namespace Climberdav\HPLayerBundle\Entity;


/**
 * Class ServerConnexion
 *
 * @author David Dessertine <dessertine.david@gmail.com>
 * @package Climberdav\HPLayerBundle\Entity
 */
class ServerConnexion
{
    /**
     * @var
     */
    private $client;

    /**
     * @var mixed
     */
    protected $wsdlClient;

    /**
     * @var Server $server
     */
    protected $server;


    /**
     * ServerConnexion constructor.
     * @param Server $server
     * @throws \Exception|\SoapFault
     */
    public function __construct(Server $server)
    {
        $this->server = $server;
        $this->setClient();
        $this->connect();
    }


    /**
     * @return mixed
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @throws \Exception
     */
    public function setClient()
    {
        $this->client = $this->server->getProtocol().'://'.$this->server->getIp().':'.$this->server->getPort()
            .'/'.$this->server->getRoot().'/wsdl/RpcEncoded';
        $this->wsdlClient = $this->connect();
    }

    /**
     * @return mixed
     */
    public function getWsdlClient()
    {
        return $this->wsdlClient;
    }

    /**
     * @param mixed $wsdlClient
     */
    public function setWsdlClient($wsdlClient)
    {
        $this->wsdlClient = $wsdlClient;
    }

    /**
     * @return \SoapClient
     * @throws \Exception
     * @throws \SoapFault
     */
    private function connect()
    {
        try{
            // test if url exist
            $headers = @get_headers($this->client);
            if(!strpos($headers[0],'503') === false){
                // URL don't exist, exiting loop
                throw new \Exception('url '.$this->client.' does not exists');
                return false;
            }
            $client = new \SoapClient($this->client,array("login" => $this->server->getLogin(),"password" => $this->server->getPassword()));
            // test if credentials are valid
            $client->DatePremierJourBase();
            return $client;
        }catch (\SoapFault $e){
            throw new \SoapFault($e->faultcode, "connection error : ".$e->faultstring);
        }
    }

}