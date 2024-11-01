<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BateauTypeController extends AbstractController
{
    #[Route('/type/bateau', name: 'app_bateautype')]
    public function index(): Response
    {
        return $this->render('bateautype/index.html.twig', [
            'controller_name' => 'BateauTypeController',
        ]);
    }
}
