<?php

namespace Loreal\MenexpertBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class InvitationController extends Controller
{
	public function indexAction()
    {
        return $this->render('LorealMenexpertBundle:Invatation:index.html.twig');
    }

    public function errorAction()
    {
        return $this->render('LorealMenexpertBundle:Invatation:error.html.twig');
    }

    public function successAction()
    {
        return $this->render('LorealMenexpertBundle:Invatation:success.html.twig');
    }

    public function mainAction()
    {
        return $this->render('LorealMenexpertBundle:Invatation:main.html.twig');
    }
    
    public function interactionAction()
    {
        return $this->render('LorealMenexpertBundle:Invatation:interaction.html.twig');
    }
}
