<?php

namespace App\Controller\Admin;

use \App\Entity\Bateau;
use \App\Entity\BateauType;
use \App\Entity\Membre;
use \App\Entity\Inscription;
use \App\Entity\Utilisateur;
use \App\Entity\Planning;
use \App\Entity\Activite;
use \App\Entity\CA;
use \App\Entity\Tarif;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class DashboardController extends AbstractDashboardController 
{
   #[Route('/admin', name: 'admin')]
   #[IsGranted('ROLE_ADMIN')]
    public function index(): Response
    {
        
        return $this->render('admin/dashboard.html.twig');
               
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Club Voile');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Type de bateau', 'fas fa-person', BateauType::class);
        yield MenuItem::linkToCrud('Bateau', 'fas fa-car', Bateau::class);
        yield MenuItem::linkToCrud('Inscription', 'fa-solid fa-dollar-sign', Inscription::class);
        yield MenuItem::linkToCrud('Membre', 'fas fa-clock', Membre::class);
        yield MenuItem::linkToCrud('Utilisateur', 'fas fa-comment', Utilisateur::class);
        yield MenuItem::linkToCrud('Planning', 'fas fa-user-secret', Planning::class);
        yield MenuItem::linkToCrud('Activite', 'fas fa-user-secret', Activite::class);
        yield MenuItem::linkToCrud('CA', 'fas fa-user-secret', CA::class);
        yield MenuItem::linkToCrud('MAJ tarif', 'fa-solid fa-dollar-sign', Tarif::class);
        yield MenuItem::linkToLogout('Déconnexion', 'fa-solid fa-person-walking-arrow-right');
    }
}
