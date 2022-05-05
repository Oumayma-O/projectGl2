<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class NotesController extends AbstractController
{
    #[Route('/notes', name: 'app_notes')]
    public function index(SessionInterface $session): Response
    {
        if (!$session->has('notes')){
            $notes=[
                'maths'=>'20',
                'physique'=>'19',
                'français'=>'18'
            ];
            $session->set('notes',$notes);
            $this->addFlash('success',"Votre tableau a été initialisé");

        }

        return $this->render('notes/index.html.twig');
    }

    /**
     * @Route("/notes/add/{matiere}/{note?}", name="addNote")
     */

    public function addAction($matiere,$note,SessionInterface $session){
        if(!$session->has('notes')){
            $this->addFlash('error',"la liste n'est pas initialisé");


        }else{
            $notes=$session->get('notes');

            if (!array_search($matiere,$notes) ){
                $notes[$matiere]=$note;
                $session->set('notes',$notes);
                $this->addFlash("success","Note item has been added with success");

            }
            else{
                $notes[$matiere]=$note;
                $session->set('notes',$notes);
                $this->addFlash("success","Note item has been updated with success");

            }

        }
        return $this->redirectToRoute('app_notes');
    }

    /**
     *@Route("/notes/delete/{matiere}", name="deleteNote")
     */

    public function deleteAction($matiere,SessionInterface $session){

        if(!$session->has('notes')){
            $this->addFlash('error',"la liste n'est pas initialisé");


        }else{
            $notes=$session->get('notes');
            if (!isset($notes[$matiere]) ){
                $this->addFlash('error',"there's no note to be deleted");
            }else{

            unset($notes[$matiere]);
            $session->set('notes',$notes);
                $this->addFlash('success',"note deleted successfully");

            }
        }


        return $this->redirectToRoute('app_notes');
    }




}


