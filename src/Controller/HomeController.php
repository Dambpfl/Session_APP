<?php

namespace App\Controller;

use App\Repository\FormationRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(FormationRepository $formationRepository): Response
    {

        $formations = $formationRepository->findBy([]);
        return $this->render('home/index.html.twig', [
            'formations' => $formations,
        ]);
    }

    #[Route('/formation/{id}', name: 'show_formation')]
    public function show(Formation $formation): Reponse
    {
        return $this->render('formation/show.html.twig', [
            'formation' => $formation
        ]);
    }
}
