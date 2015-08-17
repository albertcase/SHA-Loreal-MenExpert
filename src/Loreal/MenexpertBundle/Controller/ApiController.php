<?php

namespace Loreal\MenexpertBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Loreal\MenexpertBundle\Entity\Vip;

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

    public function insertAction()
    {
    	$handle = fopen ("files/loreal.txt", "r");
        $ln= 0;
        while (!feof($handle)) {
            $line = fgets($handle, 4096);  
            $lineary = explode(',', $line);
            if(count($lineary) == 2){
                $name = str_replace(array("\r\n", "\r", "\n"), "", trim($lineary[0]));
                $mobile = str_replace(array("\r\n", "\r", "\n"), "", trim($lineary[1]));
                $vip = new Vip();
                $vip->setName($name);
                $vip->setMobile($mobile);
                $vip->setCreated(time());
		        $doctrine = $this->getDoctrine()->getManager();
		        $doctrine->persist($vip);
		        $doctrine->flush();
                $ln++;
            }    
        }
        fclose($handle);
        echo $ln;exit;
    }
}
