<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CountController extends AbstractController
{
    #[Route('/count', name: 'app_count')]
    public function index(SessionInterface $session): Response
    {

        $session->set('nbre',$session->get('nbre')+1);
        return $this->render('count/index.html.twig', [
            'controller_name' => 'CountController',
            'nbre'=>$session->get('nbre')
        ]);
    }
}
