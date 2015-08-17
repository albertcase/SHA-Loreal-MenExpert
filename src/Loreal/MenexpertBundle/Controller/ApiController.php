<?php

namespace Loreal\MenexpertBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use LV\Bundle\CvdBundle\Entity\Locks;

class ApiController extends Controller
{
    public function checkAction()
    {
        $request = $this->getRequest()->request;
        $vip = $this->getDoctrine()->getRepository('LorealMenexpertBundle:Vip')->findOneBy(array(
		    'name' => $request->get('name') ,
		    'mobile' => $request->get('mobile')
		));
		if(!$vip){
			$url = $this->generateUrl('loreal_menexpert_error');
			$status = array('status' => '2', 'url' => $url);
	        $response = new JsonResponse();
	        $response->setData($status);
	        return $response;
		}

		$session = $this->getRequest()->getSession();
      	$session->set('menexpert_user', $request->get('name'));

		$url = $this->generateUrl('loreal_menexpert_success');
		$status = array('status' => '1', 'url' => $url);
        $response = new JsonResponse();
        $response->setData($status);
        return $response;

    }
}
