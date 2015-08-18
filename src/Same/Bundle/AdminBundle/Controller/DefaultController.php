<?php

namespace Same\Bundle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use LV\Bundle\FondationBundle\Entity\Photos;
use LV\Bundle\FondationBundle\Entity\UserDream;
use LV\Bundle\FondationBundle\Entity\UserPhotoCode;
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

    public function fakedataAction()
    {
        print_r($_POST);die;
    }

    public function tableAction()
    {   
        $page = $this->getRequest()->query->get('page') ? $this->getRequest()->query->get('page') : 1;
        $row  = $this->getRequest()->query->get('row') ? $this->getRequest()->query->get('row') : 10;
        $repository = $this->getDoctrine()->getRepository('LVFondationBundle:UserDream');
        $list = $repository->findBy(array(), array('id'=>'desc'), $row, ($page-1)*$row);
        $totalRs = $this->getDoctrine()->getEntityManager()->createQuery('select count(p) from LVFondationBundle:UserDream p')->getSingleResult();
        $total = $totalRs[1];
        $totalpage = ceil($total/$row);
        return $this->render('SameAdminBundle:Default:table.html.twig', array('list' => $list, 'page' => $page, 'total' => $total, 'totalpage' => $totalpage));
    }

    public function reviewAction()
    {
        $id = $this->getRequest()->query->get('id');
        $repository = $this->getDoctrine()->getRepository('LVFondationBundle:UserDream');
        $userDream = $repository->findOneById($id);
        $status = $userDream->getStatus();
        $newStatus = abs($status - 1);
        $em = $this->getDoctrine()->getManager();
        $userDream->setStatus($newStatus);
        $em->flush();
        $returnMsg = array('code'=>1, 'msg'=>$newStatus);
        $response = new JsonResponse();
        $response->setData($returnMsg);
        return $response;
    }

    public function dbtocsvAction()
    {
        if($this->getRequest()->getMethod() == 'POST') {
            $files = $this->getRequest()->files->get('file');
            $fs = new Filesystem();
            $filedir = $this->container->getParameter('files_base_dir');
            if(!$fs->exists($filedir . '/Txt'))
               $fs->mkdir($filedir . '/Txt', 0700);
            $filename = '/Txt/' .time() . rand(100,999) . '.txt';
            $fs->rename($files, $this->container->getParameter('files_base_dir') . $filename);
            $handle = fopen ($this->container->getParameter('files_base_dir') . $filename, "r");
            $ln= 0;
            $userservice = $this->get('lv.user.service');
            while (!feof($handle)) {
                $line = fgets($handle, 4096);  
                $lineary = explode('|', $line);
                if(count($lineary) == 2){
                    $nickname = str_replace(array("\r\n", "\r", "\n"), "", trim($lineary[0]));
                    $content = str_replace(array("\r\n", "\r", "\n"), "", trim($lineary[1]));
                    $userservice->createFakeUserDream($nickname, $content);
                    $ln++;
                }    
            }
            fclose($handle);
            print 'insert '. $ln .' rows';
            exit;
        }
        return $this->render('SameAdminBundle:Default:upload.html.twig');
    }

    public function clearAction()
    {
        session_unset();
        session_destroy();
        print '清除成功';
        exit;
    }

    public function lookAction()
    {
        $code = $this->getRequest()->get('code');
        $repository = $this->getDoctrine()->getRepository('LVFondationBundle:UserPhotoCode');
        $userPhotoCode = $repository->findOneByCode($code);
        if(!$userPhotoCode){
            $response = new JsonResponse();
            $response->setData(array('code'=> 0, 'msg'=> '该code不存在'));
            return $response;
        }
        $photos = $userPhotoCode->getPhotos();
        return $this->render('SameAdminBundle:Default:look.html.twig',array('photos'=> $photos));
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
            $filename = '/Upload/' .time() . rand(100,999) . '.jpg';
            $fs->rename($files[$i], $this->container->getParameter('files_base_dir') . '/' .$filename);
            $image = $this->container->get('lv.image.service');
            $imageurl[]= $image->ImageCreateForOffline($this->container->getParameter('files_base_dir') . '/' .$filename);
        }
        $response = new JsonResponse();
        $response->setData($imageurl);
        return $response;
    }

    public function submitAction()
    {
        $code = $this->getRequest()->get('code');
        $files = $this->getRequest()->get('files');
        if(!$files) {
            $response = new JsonResponse();
            $response->setData(array('code'=> 0, 'msg'=> '请上传图片'));
            return $response;
        }
        $repository = $this->getDoctrine()->getRepository('LVFondationBundle:UserPhotoCode');
        $userPhotoCode = $repository->findOneByCode($code);
        if(!$userPhotoCode){
            $response = new JsonResponse();
            $response->setData(array('code'=> 0, 'msg'=> '该code不存在'));
            return $response;
        }
        $doctrine = $this->getDoctrine()->getManager();
        $files = json_decode($files);
        foreach($files as $file){
            $photo = new Photos();
            $photo->setUrl($file);
            $photo->setCreated(time());
            $photo->setUserphotocode($userPhotoCode);
            $doctrine->persist($photo);
            $doctrine->flush();
        }
        $response = new JsonResponse();
        $response->setData(array('code'=> 1, 'msg'=> '提交成功'));
        return $response;
    }
}
