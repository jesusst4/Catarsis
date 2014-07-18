<?php

namespace RUGC\AutenticacionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('RUGCAutenticacionBundle:Default:index.html.twig', array('name' => $name));
    }
}
