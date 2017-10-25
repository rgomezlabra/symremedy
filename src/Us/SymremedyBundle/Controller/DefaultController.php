<?php

namespace Us\SymremedyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('UsSymremedyBundle:Default:index.html.twig');
    }

    // Ruta /symremedy/home/{name}
    public function homeAction($name='')
    {
        return $this->render('UsSymremedyBundle:Default:greetings.html.twig', array('name' => $name));
    }
}
