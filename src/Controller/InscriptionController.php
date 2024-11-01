<?php

namespace App\Controller;

use App\Entity\Inscription;
use App\Entity\DetailInscription;
use App\Form\InscriptionFormType;
use App\Repository\TarifRepository;
use App\Entity\Tarif;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class InscriptionController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/inscription', name: 'inscription')]
    public function register(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher, TarifRepository $tarifRepository): Response
    {
        $inscription = new Inscription();
        $form = $this->createForm(InscriptionFormType::class, $inscription);
    
        $form->handleRequest($request);
    
        // Récupérer tous les tarifs disponibles
        $tarifs = $tarifRepository->findAll();
        $tarifsParCategorie = [];
        foreach ($tarifs as $tarif) {
            $categorie = $tarif->getCategorie();
            if (!isset($tarifsParCategorie[$categorie])) {
                $tarifsParCategorie[$categorie] = [];
            }
            $tarifsParCategorie[$categorie][] = $tarif;
        }
           
        if ($form->isSubmitted() && $form->isValid()) {
            // Hachage du mot de passe
            $hashedPassword = $passwordHasher->hashPassword($inscription, $inscription->getPlainPassword());
            $inscription->setPassword($hashedPassword);
    
            // Ajouter la date de validation
            $inscription->setDateValidation(new \DateTime());
    
            // Enregistrer l'inscription pour obtenir son ID
            $entityManager->persist($inscription);
            // $entityManager->flush();
    
            // Récupérer les quantités des tarifs envoyées depuis le formulaire
            $montantTotal = 0;
            $quantites = $request->request->all('quantites');  // Utilise 'get' avec valeur par défaut de tableau vide
           
           
            
            // Parcourir les tarifs et enregistrer les quantités correspondantes
            if (!empty($quantites)) {
                foreach ($quantites as $tarifId => $quantite) {
                    if ($quantite > 0) { // Ne créer que si la quantité est > 0
                        $tarif = $tarifRepository->find($tarifId); // Trouver le tarif correspondant
                        if ($tarif) {
                            // Créer un nouveau DetailInscription
                            $detailInscription = new DetailInscription();
                            $detailInscription->setInscription($inscription);
                            $detailInscription->setTarif($tarif);
                            $detailInscription->setQuantite($quantite);
        
                            // Calculer le sous-total (quantité * tarif)
                            $sousTotal = $quantite * $tarif->getTarif();
                            $detailInscription->setSoustotal($sousTotal);

                            $montantTotal += $sousTotal;
                                                        
                            // Sauvegarder le détail de l'inscription
                            $entityManager->persist($detailInscription);
                        }
                       
                    }
                }
            }
            $inscription->setMontantTotal($montantTotal);
            // Finalement, sauvegarder tous les détails d'inscription
            $entityManager->flush();
            $this->addFlash('success', 'Votre inscription a été validée avec succès.');
            // Rediriger vers une page de succès ou accueil
            return $this->redirectToRoute('accueil');
        }
    
        return $this->render('inscription/index.html.twig', [
            'form' => $form->createView(),
            'tarifsParCategorie' => $tarifsParCategorie, // Passer les tarifs groupés par catégorie
        ]);
    }
}    
