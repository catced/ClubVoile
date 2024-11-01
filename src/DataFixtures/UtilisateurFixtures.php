<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Utilisateur;

class UtilisateurFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
      $utilisateur = new Utilisateur();
      $utilisateur -> setusername("catced");
      $utilisateur -> setPassword("$2a$12$9HAdy/ga9CTNVyCBOmjTg.wjcRSSMXJM6ShlUnlF/Ir1lvGnzrsG6");
      $utilisateur -> setEstActif("true");
      $utilisateur -> setRoles(["ROLE_ADMIN"]);
      $utilisateur -> setEmail("catced@gmail.com");
      $manager->persist($utilisateur);

        $manager->flush();
    }
}
