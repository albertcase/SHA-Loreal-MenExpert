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
        return $this->render('LorealMenexpertBundle:Interaction:map.html.twig');
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
