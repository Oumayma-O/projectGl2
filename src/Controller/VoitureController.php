<?php

namespace App\Controller;

use App\Entity\Voiture;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('voiture')]
class VoitureController extends AbstractController
{
    #[Route('/{page<\d+>?1}/{nbre?10}', name: 'app_voiture')]
    public function index(ManagerRegistry $doctrine,$nbre, $page): Response
    {
        $repository = $doctrine->getRepository(Voiture::class);
        $voitures=$repository->findBy([],limit:$nbre,offset:$nbre*($page-1) );
        $nbreVoiture=$repository->count([]);
        $nbrePage=ceil($nbreVoiture/ $nbre);
        return $this->render('voiture/index.html.twig', [
            'isPaginated' => true,
            'voitures'=>$voitures,
            'nbreVoiture'=>$nbreVoiture,
            'nbre'=>$nbre,
            'page'=>$page,
            'nbrePage'=>$nbrePage
        ]);
    }
    #[Route('/delete/{id<\d+>}', name: 'delete_voiture')]
    public function delete(voiture $voiture=null,ManagerRegistry $doctrine): RedirectResponse
    {
        $manager=$doctrine->getManager();
        if($voiture){
            $manager->remove($voiture);
            $manager->flush();
            $this->addFlash('success','suppression exécuté avec succés');
        }else{
            $this->addFlash('error','personne inexistante');
        }
        return $this->redirectToRoute('app_voiture');
    }

    }
