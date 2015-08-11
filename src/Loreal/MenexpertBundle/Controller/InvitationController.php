<?php

namespace Loreal\MenexpertBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class InvitationController extends Controller
{
	public function indexAction()
    {
        echo 'This is Interaction Page';exit;
        return $this->render('LorealMenexpertBundle:Invitation:index.html.twig');
    }

}
