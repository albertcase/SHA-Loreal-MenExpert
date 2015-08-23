<?php

namespace Loreal\MenexpertBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Loreal\MenexpertBundle\Entity\Photos;

class InteractionController extends Controller
{
	public function indexAction()
    {
        return $this->render('LorealMenexpertBundle:Interaction:index.html.twig');
    }

    public function chooseAction()
    {
        return $this->render('LorealMenexpertBundle:Interaction:choose.html.twig');
    }

    public function photolistAction()
    {
        $photos = $this->getDoctrine()->getRepository('LorealMenexpertBundle:Photos')->findAll();
        return $this->render('LorealMenexpertBundle:Interaction:photolist.html.twig', array('photos' => $photos));
    }

    public function mapAction()
    {

        $session = $this->getRequest()->getSession();
        $tips = $session->get('menexpert_red')+$session->get('menexpert_blue')+
        $session->get('menexpert_orange')+$session->get('menexpert_purple')+
        $session->get('menexpert_green');
        if ($tips == 5) {
            $session->set('menexpert_red', null);
            $session->set('menexpert_blue', null);
            $session->set('menexpert_orange', null);
            $session->set('menexpert_purple', null);
            $session->set('menexpert_green', null);
            return $this->redirect($this->generateUrl('loreal_menexpert_interaction_result'));
        }
        $answerList = array('red' => $session->get('menexpert_red'),
                            'blue' => $session->get('menexpert_blue'),
                            'orange' => $session->get('menexpert_orange'),
                            'purple' => $session->get('menexpert_purple'),
                            'green' => $session->get('menexpert_green'));
        return $this->render('LorealMenexpertBundle:Interaction:map.html.twig', array('answerList' => $answerList, 'tips' => $tips));
    }

    public function redAction()
    {
        return $this->render('LorealMenexpertBundle:Interaction:red.html.twig');
    }

    public function blueAction()
    {
        return $this->render('LorealMenexpertBundle:Interaction:blue.html.twig');
    }

    public function orangeAction()
    {
        return $this->render('LorealMenexpertBundle:Interaction:orange.html.twig');
    }

    public function purpleAction()
    {
        return $this->render('LorealMenexpertBundle:Interaction:purple.html.twig');
    }

    public function greenAction()
    {
        return $this->render('LorealMenexpertBundle:Interaction:green.html.twig');
    }

    public function resultAction()
    {
        return $this->render('LorealMenexpertBundle:Interaction:result.html.twig');
    }

}
