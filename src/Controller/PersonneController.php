<?php

namespace App\Controller;

use App\Entity\Formateur;
use App\Entity\Stagiaire;
use App\Form\FormateurType;
use App\Form\StagiaireType;
use App\Repository\FormateurRepository;
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


    # STAGIAIRE #
    #[Route('/stagiaire', name: 'app_stagiaire')]
    public function indexStagiaire(StagiaireRepository $stagiaireRepository): Response
    {
        $stagiaires = $stagiaireRepository->findBy([]);
        return $this->render('personne/stagiaire.html.twig', [
            'stagiaires' => $stagiaires, 
        ]);
    }
    
    #[Route('/stagiaire/new', name: 'new_stagiaire')]
    #[Route('/stagiaire/{id}/edit', name: 'edit_stagiaire')]
    public function new_edit_stagiaire(Stagiaire $stagiaire = null, Request $request, EntityManagerInterface $entityManager): Response
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

        return $this->render('personne/newStagiaire.html.twig', [
            'formAddStagiaire' => $form,
            'edit' => $stagiaire->getId()
        ]);        
    }

    #[Route('/stagiaire/{id}/delete', name: 'delete_stagiaire')]
    public function delete_stagiaire(Stagiaire $stagiaire, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($stagiaire);
        $entityManager->flush();

        return $this->redirectToRoute('app_stagiaire');
    }


    # Toujours en dernier #
    #[Route('/stagiaire/{id}', name: 'show_stagiaire')]
    public function show_stagiaire(Stagiaire $stagiaire): Response
    {
        return $this->render('personne/stagiaire.html.twig', [
            'stagiaire' => $stagiaire
        ]);
    }



    # FORMATEUR #
    #[Route('/formateur', name: 'app_formateur')]
    public function indexFormateur(FormateurRepository $formateurRepository): Response
    {
        $formateurs = $formateurRepository->findBy([]);
        return $this->render('personne/formateur.html.twig', [
            'formateurs' => $formateurs, 
        ]);
    }

    #[Route('/formateur/new', name: 'new_formateur')]
    #[Route('/formateur/{id}/edit', name: 'edit_formateur')]
    public function new_edit_formateur(Formateur $formateur = null, Request $request, EntityManagerInterface $entityManager): Response
    {   
        if(!$formateur) {
            $formateur = new Formateur();
        }
        
        $form = $this->createForm(FormateurType::class, $formateur);

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()){
            
            $formateur = $form->getData();
            
            $entityManager->persist($formateur);
            $entityManager->flush();

            return $this->redirectToRoute('app_formateur');
        }

        return $this->render('personne/newFormateur.html.twig', [
            'formAddFormateur' => $form,
            'edit' => $formateur->getId()
        ]);        
    }

    #[Route('/formateur/{id}/delete', name: 'delete_formateur')]
    public function delete_formateur(Formateur $formateur, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($formateur);
        $entityManager->flush();

        return $this->redirectToRoute('app_formateur');
    }

    #[Route('/formateur/{id}', name: 'show_formateur')]
    public function show_formateur(Formateur $formateur): Response
    {
        return $this->render('personne/formateur.html.twig', [
            'formateur' => $formateur
        ]);
    }
}
