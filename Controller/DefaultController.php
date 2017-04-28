<?php

namespace Climberdav\HPLayerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ClimberdavHPLayerBundle:Default:index.html.twig');
    }
}
