<?php

namespace RUGC\ProgramacionCatarsisBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('RUGCProgramacionCatarsisBundle:Default:index.html.twig', array('name' => $name));
    }
}
