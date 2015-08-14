<?php

namespace Loreal\MenexpertBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
        return $this->render('LorealMenexpertBundle:Interaction:photolist.html.twig');
    }

    public function mapAction()
    {
        return $this->render('LorealMenexpertBundle:Interaction:map.html.twig');
    }

    public function redAction()
    {
        return $this->render('LorealMenexpertBundle:Interaction:question.html.twig');
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
