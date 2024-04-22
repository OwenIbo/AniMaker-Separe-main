<?php

namespace App\Controller;

use App\Repository\StudioDanimationRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudioAnimationController extends AbstractController
{
    #[Route('/studio_animation', name: 'studioAnimation', methods:['GET'])]
    public function ListeStudioAnimation(StudioDanimationRepository $repo, PaginatorInterface $paginator, Request $request): Response
    {
        $listeStudioAnimation = $paginator->paginate(
            $repo->listeStudioAnimationComplete(), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            16 /*limit per page*/
        );
       
        return $this->render('studioAnimation/listeStudio.html.twig', [
            'listeStudioAnimation' => $listeStudioAnimation,
        ]);
    }
}
