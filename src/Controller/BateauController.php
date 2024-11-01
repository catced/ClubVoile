<?php

namespace App\Controller;

use App\Entity\Bateau;
use App\Repository\BateauRepository;
// use App\Form\BateauType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BateauController extends AbstractController
{
    #[Route('/bateaux', name: 'bateaux_liste')]
public function index(BateauRepository $bateauRepository): Response
    {
        // Récupération de tous les bateaux
        $bateaux = $bateauRepository->findAll();

        // Rendu du template avec les bateaux
        return $this->render('bateau/liste.html.twig', [
            'bateaux' => $bateaux,
        ]);
    }

    #[Route('/bateaux/{id}', name: 'bateau_detail')]
public function detail(Bateau $bateau): Response
{
    // Le bateau est automatiquement injecté grâce au param converter
    return $this->render('bateau/detail.html.twig', [
        'bateau' => $bateau,
    ]);
}
}