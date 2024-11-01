<?php

 // PlanningController.php

// namespace App\Controller;

// use App\Entity\Planning;
// use App\Coontroller\membreController;
// use App\Repository\PlanningRepository;
// use Doctrine\ORM\EntityManagerInterface;
// use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// use Symfony\Component\Security\Core\User\UserInterface;
// use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\Routing\Annotation\Route;
// use App\Repository\MembreRepository;



// class PlanningController extends AbstractController
// {
//     #[Route('/planning', name: 'membre_planning')]
//     public function planning(PlanningRepository $planningRepository): Response
//     {
//         $plannings = $planningRepository->findAll();

//         return $this->render('planning/planning.html.twig', [
//             'plannings' => $plannings,
//         ]);
//     }

//     #[Route('/planning/confirm/{id}', name: 'confirm_inscription', methods: ['POST'])]
//     public function confirmInscription(int $id, EntityManagerInterface $em, PlanningRepository $planningRepository): Response
//     {
//         $planning = $planningRepository->find($id);

//         if (!$planning) {
//             throw $this->createNotFoundException('Sortie non trouvée.');
//         }

//         $planning->setIsConfirmed(true);
//         $em->flush();

//         return $this->redirectToRoute('membre_planning');
//     }

//     #[Route('/membre/planning', name: 'membre_planning')]
//     public function planningmembre(PlanningRepository $planningRepository): Response
// {
//     $plannings = $planningRepository->findAll();

//     return $this->render('membre/planning.html.twig', [
//         'plannings' => $plannings,
//     ]);
// }
//     #[Route('/mon-planning', name: 'app_planning')]
//     public function index(PlanningRepository $planningRepository): Response
//     {
//         $utilisateur = $this->getUser();

//         if (!$utilisateur) {
//             return $this->redirectToRoute('app_login');
//         }

//         // Récupérer toutes les sorties proposées
//         $plannings = $planningRepository->findAllWithDetails();

//         return $this->render('membre/mon_planning.html.twig', [
//             'plannings' => $plannings,
//         ]);
//     }
// }

namespace App\Controller;

use App\Entity\Planning;
use App\Form\PlanningType;
use App\Entity\Membre;
use App\Repository\MembreRepository;
use App\Repository\PlanningRepository;
use App\Repository\BateauTypeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class PlanningController extends AbstractController
{
    // #[Route('/planning/create', name: 'create_planning')]
    // public function create(Request $request, EntityManagerInterface $entityManager): Response
    // {
    //     $planning = new Planning();
    //     $form = $this->createForm(PlanningType::class, $planning);

    //     $form->handleRequest($request);
    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $admin = $this->getUser(); // Assure-toi que l'utilisateur est un admin
    //         $planning->setAdmin($admin);

    //         $entityManager->persist($planning);
    //         $entityManager->flush();

    //         return $this->redirectToRoute('planning_list');
    //     }

    //     return $this->render('planning/create.html.twig', [
    //         'form' => $form->createView(),
    //     ]);
    // }

    #[Route('/planning/{id}/inscription', name: 'inscription_planning', methods: ['POST'])]
    public function inscrire(Planning $planning, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        if (!$user instanceof Membre) {
            $this->addFlash('error', 'Vous devez être membre pour vous inscrire à cette sortie.');
            return $this->redirectToRoute('accueil');
        }
    
        if ($planning->getParticipants()->contains($user)) {
            $this->addFlash('error', 'Vous êtes déjà inscrit à cette sortie.');
            return $this->redirectToRoute('planning');
        }
    
        $planning->addParticipant($user);
        dump($planning->getParticipants());

        $entityManager->persist($planning);
        $entityManager->flush();
    
        return $this->redirectToRoute('planning');
    }
    

    public function index(PlanningRepository $planningRepository, MembreRepository $membreRepository): Response
    {
        // Récupérer tous les plannings
        $plannings = $planningRepository->findAll();

        // Récupérer tous les membres actifs (selon ta logique)
        $membresActifs = $membreRepository->findAll();

        // Récupérer les participants inscrits à chaque planning
        $inscriptions = [];
        foreach ($plannings as $planning) {
            $inscriptions[$planning->getId()] = $planning->getParticipants(); // Les participants à chaque planning
        }

        // Récupérer le membre actuellement connecté
        $membreActif = $this->getUser();

        return $this->render('planning/index.html.twig', [
            'plannings' => $plannings,
            'inscriptions' => $inscriptions, // Tableau des participants inscrits
            'membresActifs' => $membresActifs,
            'membreActif' => $membreActif, // Le membre connecté
        ]);
    }
 
   
    #[Route("/annuler/inscription/planning/{id}/{membreId}", name: 'annuler_inscription_planning', methods: ['POST'])]
    // public function annulerInscription(
        public function annulerInscription(
            $id, 
            $membreId, 
            PlanningRepository $planningRepository, 
            MembreRepository $membreRepository,  // Injecter le repository ici
            EntityManagerInterface $em
        ): Response {
            $planning = $planningRepository->find($id);
            $membre = $membreRepository->find($membreId); 
        // Récupérer le planning et le membre
        // $planning = $planningRepository->find($id);
        // $membre = $this->getDoctrine()->getRepository(Membre::class)->find($membreId);

        // Si le planning ou le membre n'existe pas, on lance une exception
        if (!$planning || !$membre) {
            throw $this->createNotFoundException('Planning ou membre non trouvé');
        }

        // Vérifier que le membre connecté est le même que celui dont on veut annuler l'inscription
        if ($this->getUser()->getId() !== $membre->getId()) {
            throw new AccessDeniedException('Vous ne pouvez pas annuler l\'inscription d\'un autre membre.');
        }
        
        // Retirer le membre de la liste des participants
        $planning->removeParticipant($membre);
        $em->persist($planning);
        $em->flush();
        
        // Rediriger vers la liste des plannings
        return $this->redirectToRoute('planning');
        

    }
}

