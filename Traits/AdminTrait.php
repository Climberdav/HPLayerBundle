<?php

namespace Climberdav\HPLayerBundle\Traits;


trait AdminTrait
{
    public function getVersion(){
        return $this->wsdlClient->Version();
    }

    public function getAnneeComplete(){
        return $this->wsdlClient->AnneeComplete();
    }
}