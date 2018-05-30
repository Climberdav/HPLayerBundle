<?php

namespace Climberdav\HPLayerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class BaseController
 *
 * @author David Dessertine <dessertine.david@gmail.com>
 * @package Climberdav\HPLayerBundle\Controller
 */
abstract class BaseController extends Controller
{
    /**
     * @return \Doctrine\Common\Persistence\ObjectManager|object
     */
    protected function getDoctrineManager()
    {
        $manager = $this->container->hasParameter('climberdav_hp_layer.doctrine_manager')
            ? $this->container->getParameter('climberdav_hp_layer.doctrine_manager')
            : 'default';
        return $this->getDoctrine()->getManager($manager);
    }
}
