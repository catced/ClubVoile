<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'accueil')]
    public function index(): Response
    {
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
        ]);
    }

    #[Route('/club_contacts', name: 'club_contacts')]
    public function contact(): Response
    {
        return $this->render('club/contact.html.twig', [
            'controller_name' => 'AccueilController',
        ]);
    }

    #[Route('/club_equipe', name: 'club_equipe')]
    public function equipe(): Response
    {
        return $this->render('club/dirigeant.html.twig', [
            'controller_name' => 'AccueilController',
        ]);
    }

    #[Route('/club_histoire', name: 'club_histoire')]
    public function histoire(): Response
    {
        return $this->render('club/histoire.html.twig', [
            'controller_name' => 'AccueilController',
        ]);
    }
}
