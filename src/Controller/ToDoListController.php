<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ToDoListController extends AbstractController
{
    #[Route('/to/do/list', name: 'app_to_do_list')]
    public function index(SessionInterface $session): Response
    {
        if(!$session->has('todos')){
            $todos=[
                'lundi'=> 'HTML',
                'mardi'=> 'CSS',
                'mercredi'=>'JS'
            ];
            $session->set('todos',$todos);
            $this->addFlash('info',"Bienvenue dans votre plateforme de ToDos");

        }

        return $this->render('to_do_list/index.html.twig');
    }
}
