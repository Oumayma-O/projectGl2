<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;


class ToDoController extends AbstractController
{
    #[Route('/to/do', name: 'app_to_do')]
    public function index(SessionInterface $session): Response
    {   if(!$session->has('todos'))
    {
        $todos=[];
          $todos=[
              'lundi'=> 'HTML',
            'mardi'=> 'CSS',
            'mercredi'=>'JS'];

        $session->set('todos',$todos);
        $this->addFlash('info',"Bienvenue dans votre plateforme de ToDos");
    }


           return $this->render('to_do/index.html.twig');
    }

    /**
     * @Route("/to/do/add/{name}/{content?rien}", name="addToDo")
     */

    public function addToDoAction($name,$content,SessionInterface $session){
        if(!$session->has('todos')){
            $this->addFlash('error',"la liste n'est pas initialisé");


}else{
            $todos=$session->get('todos');

        if(!array_search($name,$todos) )/*(isset($todos[$name])*/{
        $todos[$name]=$content;
        $session->set('todos',$todos);
        $this->addFlash("success","TODO item has been added with success");
        $this->redirectToRoute('app_to_do');
}
else{
    $todos[$name]=$content;
    $session->set('todos',$todos);
    $this->addFlash("success","TODO item has been updated with success");
    $this->redirectToRoute('app_to_do');
}

        }
        return $this->redirectToRoute('app_to_do');
    }

    /**
     * @Route("/to/do/delete/{name}")
     */

   public function deleteToDo($name,SessionInterface $session){
       $todos=$session->get('todos');
        if(!isset($todos[$name])){
            $this->addFlash('error',"cannot delete a nonexistent item");

        }else{
            unset($todos[$name]);
            $session->set('todos',$todos);
            $this->addFlash('success',"ToDo item deleted successfully");
        }
        return $this->redirectToRoute('app_to_do');
}
    /**
     * @Route("/to/do/reset")
     */
public function reset(SessionInterface $session){

        if(!$session->has('todos')){
       $this->addFlash('error',"the list isn't initialised");
           }
        else{
            $session->set('todos',[
                'lundi'=> 'HTML',
                'mardi'=> 'CSS',
                'mercredi'=>'JS']);

            $this->addFlash('success',"the list has been reset");
        }
        return $this->redirectToRoute('app_to_do');
}
}
