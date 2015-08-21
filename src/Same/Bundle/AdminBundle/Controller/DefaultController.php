<?php

namespace Same\Bundle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Loreal\MenexpertBundle\Entity\Photos;
class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SameAdminBundle:Default:index.html.twig');
    }

    public function loginAction()
    {
        $username = $this->getRequest()->query->get('account');
        $password = $this->getRequest()->query->get('password');
        $msg = array();
        if($username == 'admin' && $password == 'lv2015'){
            //$this->container->get('session')->set('same_admin_name',$username);
            $msg = array('code'=> 1, "msg"=>'file');
        }else if($username == 'admin' && $password == '1qazxsw2'){
            //$this->container->get('session')->set('same_admin_name',$username);
            $msg = array('code'=> 1, "msg"=>'list');
        }else if($username == 'admin' && $password == 'samesame123'){
            //$this->container->get('session')->set('same_admin_name',$username);
            $msg = array('code'=> 1, "msg"=>'dbtocsv');
        }else{
            $msg = array('code'=> 0, "msg"=>'登录失败');
        }
        $response = new JsonResponse();
        $response->setData($msg);
        return $response;
    }

    public function fileAction()
    {
        return $this->render('SameAdminBundle:Default:file.html.twig');
    }

    public function fakeAction()
    {
        return $this->render('SameAdminBundle:Default:fake.html.twig');
    }

    public function clearAction()
    {
        session_unset();
        session_destroy();
        print '清除成功';
        exit;
    }

    public function uploadAction()
    {
        $files = $this->getRequest()->files->get('file');
        $fs = new Filesystem();
        $filedir = $this->container->getParameter('files_base_dir');
        $imageurl = array();
        if(!$fs->exists($filedir . '/Upload'))
           $fs->mkdir($filedir . '/Upload', 0700);
        
        for($i = 0; $i < count($files); $i++) {
            $filename = 'Upload/' .time() . rand(100,999) . '.jpg';
            $fs->rename($files[$i], $this->container->getParameter('files_base_dir') . $filename);
            $imageurl[]= $this->container->getParameter('files_base_dir') . $filename;
        }
        $response = new JsonResponse();
        $response->setData($imageurl);
        return $response;
    }

    public function submitAction()
    {
        $files = $this->getRequest()->get('files');
        if(!$files) {
            $response = new JsonResponse();
            $response->setData(array('code'=> 0, 'msg'=> '请上传图片'));
            return $response;
        }
        $doctrine = $this->getDoctrine()->getManager();
        $files = json_decode($files);
        foreach($files as $file){
            $photo = new Photos();
            $photo->setUrl($file);
            $photo->setCreated(time());
            $doctrine->persist($photo);
            $doctrine->flush();
        }
        $response = new JsonResponse();
        $response->setData(array('code'=> 1, 'msg'=> '提交成功'));
        return $response;
    }
}
