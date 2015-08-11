<?php

namespace Loreal\MenexpertBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class InteractionController extends Controller
{
	public function indexAction()
    {
        return $this->render('LorealMenexpertBundle:Interaction:index.html.twig');
    }

    public function errorAction()
    {
        return $this->render('LorealMenexpertBundle:Interaction:error.html.twig');
    }

    public function successAction()
    {
        return $this->render('LorealMenexpertBundle:Interaction:success.html.twig');
    }

    public function mainAction()
    {
        return $this->render('LorealMenexpertBundle:Interaction:main.html.twig');
    }
    public function interactionAction()
    {
        return $this->render('LorealMenexpertBundle:Interaction:interaction.html.twig');
    }
}
