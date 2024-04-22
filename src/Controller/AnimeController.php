<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnimeController extends AbstractController
{
    #[Route('/anime', name: 'anime')]
    public function index(): Response
    {
        return $this->render('anime/anime.html.twig', [
            'controller_name' => 'AnimeController',
        ]);
    }
}
