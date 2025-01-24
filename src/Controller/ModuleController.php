<?php

namespace App\Controller;

use App\Entity\Programme;
use App\Form\ProgrammeType;
use App\Repository\ModuleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class ModuleController extends AbstractController
{
    #[Route('/module', name: 'app_module')]
    public function index(ModuleRepository $moduleRepository): Response
    {
        $modules = $moduleRepository->findBy([]);
        return $this->render('session/show.html.twig', [
            'modules' => $modules,
        ]);
    }

    #[Route('/programme/new', name: 'new_programme')]
    #[Route('/programme/{id}/edit', name: 'edit_programme')]
    public function edit(Programme $programme = null, Request $request, EntityManagerInterface $entityManager): Response
    {   
        if(!$programme) {
            $programme = new Programme();
        }

        $form = $this->createForm(ProgrammeType::class, $programme);

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()){
            
            $programme = $form->getData();
            
            $entityManager->persist($programme);
            $entityManager->flush();

            return $this->redirectToRoute('#');
        }

        return $this->render('module/new.html.twig', [
            'formAddProgramme' => $form,
            'edit' => $programme->getId()
        ]);        
    }
}
