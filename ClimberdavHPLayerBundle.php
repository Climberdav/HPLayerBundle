<?php

namespace Climberdav\HPLayerBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Climberdav\HPLayerBundle\DependencyInjection\ClimberdavHPLayerExtension;

class ClimberdavHPLayerBundle extends Bundle
{

    /**
     * @inheritDoc
     */
    public function getContainerExtension()
    {
        $class = $this->getContainerExtensionClass();
        return new $class;
    }

    /**
     * @inheritDoc
     */
    protected function getContainerExtensionClass()
    {
        return ClimberdavHPLayerExtension::class;
    }
}
