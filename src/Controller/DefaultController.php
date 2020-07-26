<?php

namespace App\Controller;

use App\Entity\User;
use App\Services\GiftServices;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


class DefaultController extends AbstractController
{
    public function __construct($logger)
    {

    }

    /**
     * @Route("/home", name="home")
     */
    public function index(GiftServices $gifts, Request $request)
    {
        $users = [];
        $users= $this->getDoctrine()->getRepository(User::class)->findAll();

        $entityManager =$this->getDoctrine()->getManager();
        return $this->render('default/index.html.twig',[
            'controller_name'=>'DefaultController',
            'users'=>$users,
            'random_gift'=>$gifts->gifts

        ]);
    }




    /**
     * @Route("/generate-url/{param?}",name="generate-url")
     */

    public function generate_url()
    {
        exit($this->generateUrl(
            'generate-url',
            array('param'=>10),
            UrlGeneratorInterface::ABSOLUTE_URL
        ));
    }

    /**
     * @Route("/download")
     */
    public function download()
    {
        $path = $this->getParameter('download');
        return $this->file($path,'file.pdf');
    }
    /**
     * @Route("/redirect-test")
     */
    public function redirectTest()
    {
        return $this->redirectToRoute('route_to_redirect', array('param' => 10));
    }

    /**
     * @Route("/url-to-redirect/{param?}", name="route_to_redirect")
     */
    public function methodToRedirect()
    {
        exit('Test redirection');
    }

    /**
     * @Route("/forward-to-controller")
     */

    public function forwardingToController()
    {
        $response = $this->forward(
            'App\Controller\DefaultController::methodToForwardTo',
            array('param'=>'1')
        );
        return $response;
    }
    /**
     * @Route("/url-to-forward-to/{param?}", name="route to forward to")
     */

    public function methodToForwardTo($param)
    {
        exit('Test controller forwarding - '.$param);
    }

}


