<?php

namespace App\Controller;

use App\Entity\Session;
use App\Form\SessionType;
use App\Repository\SessionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class SessionController extends AbstractController
{
    #[Route('/session', name: 'app_session')]
    public function index(SessionRepository $sessionRepository): Response
    {
        $sessions = $sessionRepository->findBy([]);
        return $this->render('session/index.html.twig', [
            'sessions' => $sessions
        ]);
    }

    #[Route('/session/new', name: 'new_session')]
    #[Route('/session/{id}/edit', name: 'edit_session')]
    public function new_edit_session(Session $session = null, Request $request, EntityManagerInterface $entityManager): Response
    {   
        if(!$session) {
            $session = new Session();
        }
        
        $form = $this->createForm(SessionType::class, $session);

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()){
            
            $session = $form->getData();
        
            $formationId = $session->getFormation()->getId();
            $sessionId = $session->getId();
            //($sessionId);
            
            $entityManager->persist($session);
            $entityManager->flush();

            if($request->attributes->get('_route') === 'new_session') { 
                return $this->redirectToRoute('show_formation', ['id' => $formationId ]);
            } else {
                return $this->redirectToRoute('show_session', ['id' => $sessionId ]);
            }
        }

        return $this->render('session/new.html.twig', [
            'formAddSession' => $form,
            'edit' => $session->getId()
        ]);        
    }

    #[Route('/session/{id}/delete', name: 'delete_session')]
    public function delete_session(Session $session, EntityManagerInterface $entityManager): Response
    {
        $formationId = $session->getFormation()->getId();

        $entityManager->remove($session);
        $entityManager->flush();

        return $this->redirectToRoute('show_formation', ['id' => $formationId]);
    }


    #[Route('/session/{id}', name: 'show_session')]
    public function show(Session $session): Response
    {
        return $this->render('session/show.html.twig', [
            'session' => $session
        ]);
    }
}
