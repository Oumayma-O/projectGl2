<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;


class AlternateController extends AbstractController
{
    #[Route('/alternate', name: 'app_alternate')]
    public function index(SessionInterface $session): Response
    {
        if(!$session->has('liste')){
            $liste=[
                'oumayma'=>'ouerfelli',
                'Mohammed'=>'Lasswed',
                'Arij'=>'Kouki',
                'Hmaza'=>'Ben Ammar'
            ];
            $session->set('liste',$liste);
            $this->addFlash('success',"la liste est initialisé");
        }
        return $this->render('alternate/index.html.twig');
    }

    /**
     * @Route("/alternate/{name}/{surname?rien}", name="addList")
     */

    public function addToDoAction($name,$surname,SessionInterface $session){
        if ($session->has('liste')){

        $liste=$session->get('liste');
        if(!isset($liste[$name])){
        $liste[$name]=$surname;
        $session->set('liste',$liste);
            $this->addFlash('success',"un élément est ajouté à la liste");
        }elseif($surname!=$liste[$name]){
            $liste[$name]=$surname;
            $session->set('liste',$liste);
            $this->addFlash('success',"un élément a été mise à jour");
        }else{
            $this->addFlash('success',"l'élément existe déja");
        }
        }

        return $this->redirectToRoute('app_alternate');
    }

}
