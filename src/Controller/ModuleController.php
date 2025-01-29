<?php

namespace App\Controller;

use App\Entity\Module;
use App\Entity\Session;
use App\Form\ModuleType;
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
        return $this->render('module/index.html.twig', [
            'modules' => $modules,
        ]);
    }

    #[Route('/programme/new', name: 'new_programme')]
    #[Route('/programme/{id}/edit', name: 'edit_programme')]
    public function new_edit(Programme $programme = null, Request $request, EntityManagerInterface $entityManager): Response
    {   
        if(!$programme) {
            $programme = new Programme();
        }
        
        $form = $this->createForm(ProgrammeType::class, $programme);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()){
            
            $programme = $form->getData();
            $sessionId = $programme->getSession()->getId();

            $entityManager->persist($programme);
            $entityManager->flush();

            return $this->redirectToRoute('show_session', ['id' => $sessionId]);
        }
        return $this->render('module/new.html.twig', [
            'formAddProgramme' => $form,
            'edit' => $programme
        ]);        
    }

    #[Route('/module/new', name: 'new_module')]
    public function new_module(Module $module = null, Request $request, EntityManagerInterface $entityManager): Response
    {   
        $module = new Module();
        
        $form = $this->createForm(ModuleType::class, $module);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()){
            
            $module = $form->getData();

            $entityManager->persist($module);
            $entityManager->flush();

            return $this->redirectToRoute('app_module');
        }
        return $this->render('module/newModule.html.twig', [
            'formAddModule' => $form,
        ]);        
    }

    #[Route('/module/{id}/delete', name: 'delete_module')]
    public function delete(Module $module, EntityManagerInterface $entityManager): Response
    {
       
        $entityManager->remove($module);
        $entityManager->flush();

        return $this->redirectToRoute('app_module');
    }

    // Retirer un programme d'une session
    #[Route('/module/{programme}', name: 'remove_programme')]
    public function remove(Programme $programme, EntityManagerInterface $entityManager): Response
    {
        $sessionId = $programme->getSession()->getId();
        $entityManager->remove($programme);
        $entityManager->flush();

        return $this->redirectToRoute('show_session', ['id' => $sessionId]);
    }
}
