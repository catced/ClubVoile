<?php

namespace App\Controller;

use App\Entity\Membre;
use App\Entity\CA;
use App\Entity\Planning;
use App\Form\MembreRegistrationType;
use App\Form\MembreType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;


#[Route('/membre')]
#[IsGranted('ROLE_USER')]
final class MembreController extends AbstractController
{
    #[Route(name: 'app_membre_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $membres = $entityManager
            ->getRepository(Membre::class)
            ->findAll();

        return $this->render('membre/mon_planning.html.twig', [
            'membres' => $membres,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_membre_edit', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_USER')]
    public function edit(Request $request, Membre $membre, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MembreType::class, $membre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_membre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('membre/edit.html.twig', [
            'membre' => $membre,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_membre_delete', methods: ['POST'])]
    #[IsGranted('ROLE_USER')]
    public function delete(Request $request, Membre $membre, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$membre->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($membre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_membre_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/membredashboard', name: 'membre_dashboard')]
    #[IsGranted('ROLE_USER')]
    public function dashboard(EntityManagerInterface $entityManager): Response
    {   
        $planning = $entityManager->getRepository(Planning::class)->findAll(); 
        $ca = $entityManager->getRepository(CA::class)->findAll(); 
        $membre = $entityManager->getRepository(Membre::class)->findAll(); 

        return $this->render('membre/dashboard.html.twig', [
            'membre' => $membre,
            'planning' => $planning,
            'ca' => $ca,
            
        ]);
    }

    #[Route('/membrelogin', name: 'membrelogin')]
    public function login(): Response
    {
        return $this->render('membre/membrelogin.html.twig');
    }

}
