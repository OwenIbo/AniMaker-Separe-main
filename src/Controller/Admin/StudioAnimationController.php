<?php

namespace App\Controller\Admin;

use App\Entity\StudioDanimation;
use App\Form\StudioAnimationType;
use App\Form\FiltreStudioAnimationType;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\StudioDanimationRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StudioAnimationController extends AbstractController
{
    #[Route('/admin/studio_animation', name: 'admin_studioAnimation', methods:'GET')]
    public function ListeStudioAnimation(StudioDanimationRepository $repo, PaginatorInterface $paginator, Request $request): Response
    {
        $nom=null;
        $formFiltreStudio=$this->createForm(FiltreStudioAnimationType::class);
        $formFiltreStudio->handleRequest($request);
        if($formFiltreStudio->isSubmitted() && $formFiltreStudio->isValid())
        {
            $nom=$formFiltreStudio->get('nom')->getData();
        }
        $listeStudioAnimation = $paginator->paginate(
            $repo->listeStudioAnimationComplete($nom), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );
        return $this->render('admin/studioAnimation/listeStudio.html.twig', [
            'listeStudioAnimation' => $listeStudioAnimation,
            'formFiltreStudio'=>$formFiltreStudio->createView()
        ]);
    }

    #[Route('/admin/studio_animation/ajouter', name: 'admin_studioAnimation_ajouter', methods:['GET','POST'])]
    #[Route('/admin/studio_animation/modifier/{id}', name: 'admin_studioAnimation_modifier', methods:['GET','POST'])]
    public function AjouterModifierStudioAnimation(StudioDanimation $studio=null, Request $request, EntityManagerInterface $manager)
    {
        if($studio==null)
        {
            $studio=new StudioDanimation();
        }
        $form=$this->createForm(StudioAnimationType::class, $studio);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($studio);
            $manager->flush();
            return $this->redirectToRoute('admin_studioAnimation');
        }
        return $this->render('admin/studioAnimation/formAjoutModifStudio.html.twig', [
            'formStudioAnimation' => $form->createView(),
        ]);
    }

    #[Route('/admin/studio_animation/supprimer/{id}', name: 'admin_studioAnimation_supprimer', methods:['GET'])]
    public function supprimerStudioAnimation(StudioDanimation $studio, EntityManagerInterface $manager)
    {
            $manager->remove($studio);
            $manager->flush();
            return $this->redirectToRoute('admin_studioAnimation');
    }
}
