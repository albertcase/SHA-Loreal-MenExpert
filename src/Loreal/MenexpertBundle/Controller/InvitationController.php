<?php

namespace Loreal\MenexpertBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class InvitationController extends Controller
{
	public function indexAction()
    {
        return $this->render('LorealMenexpertBundle:Invitation:index.html.twig');
    }

    public function errorAction()
    {
        return $this->render('LorealMenexpertBundle:Invitation:error.html.twig');
    }

    public function successAction()
    {
        if (!$this->getRequest()->getSession()->get('menexpert_user')) {
           $this->redirect($this->generateUrl('loreal_menexpert_homepage'));
        }
        return $this->render('LorealMenexpertBundle:Invitation:success.html.twig');
    }

    public function mainAction()
    {
        if (!$this->getRequest()->getSession()->get('menexpert_user')) {
           $this->redirect($this->generateUrl('loreal_menexpert_homepage'));
        }
        return $this->render('LorealMenexpertBundle:Invitation:main.html.twig');
    }
    
    public function interactionAction()
    {
        if (!$this->getRequest()->getSession()->get('menexpert_user')) {
           $this->redirect($this->generateUrl('loreal_menexpert_homepage'));
        }
        return $this->render('LorealMenexpertBundle:Invitation:interaction.html.twig');
    }
}
