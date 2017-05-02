<?php

namespace HPLayerBundle\Model;


abstract class Admin extends Config
{
    public function getVersion(){
        return $this->wsdlClient->Version()  ;
    }
}