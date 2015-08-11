<?php

namespace Loreal\MenexpertBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class InteractionController extends Controller
{
	public function indexAction()
    {
        echo 'This is Interaction Page';exit;
        return $this->render('LorealMenexpertBundle:Interaction:index.html.twig');
    }

}
