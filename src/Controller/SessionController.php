<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class SessionController extends AbstractController
{


    /**
     * @Route("/session", name="app_session")
     */
    public function index(SessionInterface $session ): Response
    {
        if(!$session->has('user')){
            $msg="Bienvenue c votre premiére visite :)";
            $this->addFlash('welcome',$msg);
            $session->set('user','NewUser');

        }

        return $this->render('session/index.html.twig');
    }
}
