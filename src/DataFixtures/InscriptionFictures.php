<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Inscription;
use DateTime;

class InscriptionFictures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
      $inscription = new Inscription();
      $inscription -> setEmail("furland@gmail.com");
      $inscription -> setPassword("$2a$12\$Rb5C5UkreCRzKba6bZ.M8O/qtcwUI7mlqQSd1XdZuzcDT3ab.mibq");
      $inscription -> setNomAdherent("FURLAND");
      $inscription -> setPrenom("Rolland");
      $inscription -> setTelephone("04.67.45.25.12");
      $inscription -> setDateValidation(new DateTime('2024-09-30 17:45:12'));
      $inscription -> setMontantTotal("90");
      $manager->persist($inscription);

      $inscription = new Inscription();
      $inscription -> setEmail("balard@gmail.com");
      $inscription -> setPassword("$2a$12\$Rb5C5UkreCRzKba6bZ.M8O/qtcwUI7mlqQSd1XdZuzcDT3ab.mibq");
      $inscription -> setNomAdherent("BALARD");
      $inscription -> setPrenom("Stéphanie");
      $inscription -> setTelephone("06.17.55.52.74");
      $inscription -> setDateValidation(new DateTime('2024-10-15 10:21:41'));
      $inscription -> setMontantTotal("600");
      $manager->persist($inscription);

      $inscription = new Inscription();
      $inscription -> setEmail("remond@gmail.com");
      $inscription -> setPassword("$2a$12\$Rb5C5UkreCRzKba6bZ.M8O/qtcwUI7mlqQSd1XdZuzcDT3ab.mibq");
      $inscription -> setNomAdherent("REMOND");
      $inscription -> setPrenom("Florent");
      $inscription -> setTelephone("07.27.65.58.55");
      $inscription -> setDateValidation(new DateTime('2024-12-15 13:22:36'));
      $inscription -> setMontantTotal("360");
      $manager->persist($inscription);

      $manager->flush();
    }
}
