<?php

namespace Loreal\MenexpertBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('LorealMenexpertBundle:Default:index.html.twig', array('name' => $name));
    }
}
