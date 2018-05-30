<?php

namespace Climberdav\HPLayerBundle\Model;

use Climberdav\HPLayerBundle\Entity\Server;

class Connexion
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
     * Connexion constructor.
     * @param Server $server
     * @throws \Exception|\SoapFault
     */
    public function __construct(Server $server = null)
    {
        if (null !== $server)
        {
            $this->setClient($server);
        }
    }


    /**
     * @return mixed
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param Server $server
     * @throws \Exception
     */
    public function setClient(Server $server)
    {
        $this->client = $server->getProtocol().'://'.$server->getHost().':'.$server->getPort()
            .'/'.$server->getRoot().'/wsdl/RpcEncoded';
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
     * @throws \Exception|\SoapFault
     */
    private function connect()
    {
        try{
            // test if url exist
            $headers = @get_headers($this->client);
            if(!strpos($headers[0],'503') === false){
                // URL don't exist, exiting loop
                throw new \Exception('url '.$this->client.' does not exists');
            }
            return new \SoapClient($this->client,array("login" => $this->login,"password" => $this->password));
        }catch (\SoapFault $e){
            throw new \SoapFault("connection error : ".$e->getMessage());
        }
    }

}