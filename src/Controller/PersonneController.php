<?php

namespace App\Controller;

use App\Entity\Personne;
use App\Form\PersonneType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('personne')]
class PersonneController extends AbstractController
{
    #[Route('/{page<\d+>?1}/{nbre<\d+>?12}', name: 'app_personne')]
    public function index(ManagerRegistry $doctrine,$page,$nbre): Response
    {
        $repository=$doctrine->getRepository(Personne::class);
        $personnes=$repository->findBy([],['age'=>'ASC'],limit:$nbre ,offset: $nbre*($page-1));
        $nbrePersonne = $repository->count([]);
        $nbrePage=ceil($nbrePersonne / $nbre);
        return $this->render('personne/detail.html.twig',['personnes'=> $personnes,'nbre'=>$nbre,'page'=>$page,'nbrePages'=>$nbrePage]);

    }

    #[Route('/age/{ageMin<\d+>?0}/{ageMax<\d+>?100}', name: 'age_personne')]
    public function age(ManagerRegistry $doctrine,$ageMin,$ageMax): Response
    {
        $repository=$doctrine->getRepository(Personne::class);
        $personnes=$repository->findPersonneByIntervelle($ageMin,$ageMax);
        $count=$repository->StatsfindPersonneByIntervelle($ageMin,$ageMax);
        return $this->render('personne/detail.html.twig',['personnes'=> $personnes,'count'=>$count[0]]);


    }

   /* #[Route('/alls/{page?1}/{nbre?12}', name: 'alls_personne')]
    public function Alls(ManagerRegistry $doctrine,$page,$nbre): Response
    {
        $repository=$doctrine->getRepository(Personne::class);

        $personnes=$repository->findBy([],['age'=>'ASC'],limit:$nbre ,offset: $nbre*($page-1));

        return $this->render('personne/detail.html.twig',['personnes'=>$personnes]);


    }

*/
    #[Route('/{id<\d+>}', name: 'personne_détail')]
    public function détail(personne $personne): Response
    {
        if(!$personne){
            $this->addFlash('error',"la personne que vous cherchez n'existe pas");
            return $this->redirectToRoute('app_personne');
        }

        return $this->render('personne/index.html.twig',['personne'=> $personne]);

    }


    #[Route('/delete/{id<\d+>}', name: 'personne_delete')]
    public function delete(personne $personne=null,ManagerRegistry $doctrine): RedirectResponse{
        $manager=$doctrine->getManager();
        if($personne){
            $manager->remove($personne);
            $manager->flush();
            $this->addFlash('success',"personne a ete supprimée avec succés");
        }else{

            $this->addFlash('error',"personne inexistante");
        }

        return $this->redirectToRoute('app_personne');
    }


    #[Route('/add', name: 'personne_add')]
    public function addPersonne(ManagerRegistry $doctrine,Request $request): Response
    {
        $entityManager=$doctrine->getManager();

       /* $personne =new Personne();
        $personne->setFirstname('Oumayma');
        $personne->setName('Ouerfelli');
        $personne->setAge('20');
        $personne->setJob('');

        //on doit ajouter l'operation à la transaction

        $entityManager->persist($personne);

        $entityManager->flush();*/
        //exécuter la transaction

        $personne=new Personne();
        $form =$this->createForm(PersonneType::class, $personne);
        $form->remove('createdAt');
        $form->remove('updatesAt');
        $form->handleRequest($request);
        dump($request);

        return $this->render('personne/add-personne.html.twig', [
            'form'=>$form->createView(),
            ]);
    }
}
