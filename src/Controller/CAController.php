<?php

namespace App\Controller;

use App\Entity\CA;
use App\Form\CAType;
use App\Repository\CARepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class CAController extends AbstractController
{
    #[Route('/ca', name: 'ca_list')]
    #[IsGranted('ROLE_USER')]
    public function index(CARepository $caRepository): Response
    {
        $compteRendus = $caRepository->findAll();

        return $this->render('ca/index.html.twig', [
            'compteRendus' => $compteRendus,
        ]);
    }

    #[Route('/ca/nouveau', name: 'ca_nouveau')]
    #[IsGranted('ROLE_USER')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $compteRendu = new CA();
        $form = $this->createForm(CAType::class, $compteRendu);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Gestion du fichier
            $fichier = $form->get('fichier')->getData();
            
            if ($fichier) {
                $fichierNom = uniqid() . '.' . $fichier->guessExtension();

                try {
                    // Déplacer le fichier dans le répertoire configuré
                    $fichier->move(
                        $this->getParameter('fichier_directory'),
                        $fichierNom
                    );
                } catch (FileException $e) {
                    // Gérer les erreurs pendant l'upload
                    $this->addFlash('error', 'Erreur lors du téléchargement du fichier.');
                    return $this->redirectToRoute('ca_nouveau');
                }

                // Enregistrer le nom du fichier dans l'entité
                $compteRendu->setFichier($fichierNom);
            }

            $em->persist($compteRendu);
            $em->flush();

            return $this->redirectToRoute('ca_list');
        }

        return $this->render('ca/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
