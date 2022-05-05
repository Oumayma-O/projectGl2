<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class SecondController extends AbstractController
{
    #[Route('/second', name: 'app_second')]
    public function index(Request $request): Response
    {
        $name=$request->query->get('name');
        return $this->render ('second/index.html.twig', [
            'controller_name' => 'SecondController',
            'esm' =>$name
        ]);
    }



    /**
     * @Route("/hello/{name}",name="hello")
     */
    public function hello($name)
    {
        return $this->render ('second/hello.index.html.twig', [
            'name' => $name,
        ]);
    }

    /**
     * @Route("/helloOuma")
     */

    public function Ouma(){
        return $this->forward('App\Controller\SecondController::hello',['name'=>'Ouma']);
    }




   /* /**
     * @Route('/cv/{name}/{surname}/{age}/{section}',name: 'app_cv')
     */
  /*  public function cv(){

    }*/



}
