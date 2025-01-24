<?php

namespace App\Controller;

use App\Entity\Stagiaire;
use App\Form\StagiaireType;
use App\Repository\StagiaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class PersonneController extends AbstractController
{
    #[Route('/personne', name: 'app_personne')]
    public function index(StagiaireRepository $stagiaireRepository): Response
    {
        $stagiaires = $stagiaireRepository->findBy([]);
        return $this->render('session/show.html.twig', [
            'stagiaires' => $stagiaires, 
        ]);
    }

    #[Route('/stagiaire', name: 'app_stagiaire')]
    public function indexStagiaire(StagiaireRepository $stagiaireRepository): Response
    {
        $stagiaires = $stagiaireRepository->findBy([]);
        return $this->render('personne/index.html.twig', [
            'stagiaires' => $stagiaires, 
        ]);
    }
    
    #[Route('/stagiaire/new', name: 'new_stagiaire')]
    #[Route('/stagiaire/{id}/edit', name: 'edit_stagiaire')]
    public function new_edit(Stagiaire $stagiaire = null, Request $request, EntityManagerInterface $entityManager): Response
    {   
        if(!$stagiaire) {
            $stagiaire = new Stagiaire();
        }
        
        $form = $this->createForm(StagiaireType::class, $stagiaire);

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()){
            
            $stagiaire = $form->getData();
            
            $entityManager->persist($stagiaire);
            $entityManager->flush();

            return $this->redirectToRoute('app_stagiaire');
        }

        return $this->render('personne/new.html.twig', [
            'formAddStagiaire' => $form,
            'edit' => $stagiaire->getId()
        ]);        
    }

    #[Route('/stagiaire/{id}/delete', name: 'delete_stagiaire')]
    public function delete(Stagiaire $stagiaire, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($stagiaire);
        $entityManager->flush();

        return $this->redirectToRoute('app_stagiaire');
    }


    # Toujours en dernier #
    #[Route('/stagiaire/{id}', name: 'show_stagiaire')]
    public function show(Stagiaire $stagiaire): Response
    {
        return $this->render('personne/index.html.twig', [
            'stagiaire' => $stagiaire
        ]);
    }
}
