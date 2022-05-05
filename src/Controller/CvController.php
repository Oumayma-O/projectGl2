<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CvController extends AbstractController
{
    #[Route('/cv/{name}/{surname}/{age}/{section}', name: 'app_cv')]
    public function index($name,$surname,$age,$section): Response
    {
        return $this->render('cv/index.html.twig', [
            'controller_name' => 'CvController',
            'prénom'=>$name,
            'nom'=>$surname,
            'age'=>$age,
            'section'=>$section,
            'path'=> '         '
        ]);
    }
}
