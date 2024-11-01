<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Tarif;
use DateTimeImmutable;

class TarifFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
      $tarif = new Tarif();
      $tarif -> setLibelle("Adhésion individuelle");
      $tarif -> setTarif("90");
      $tarif -> setCategorie("adhésion");
      $manager->persist($tarif);

      $tarif = new Tarif();
      $tarif -> setLibelle("Adhésion famille");
      $tarif -> setTarif("130");
      $tarif -> setCategorie("adhésion");
      $manager->persist($tarif);

      $tarif = new Tarif();
      $tarif -> setLibelle("Adhésion fin d'année");
      $tarif -> setTarif("50");
      $tarif -> setCategorie("adhésion");
      $manager->persist($tarif);

      $tarif = new Tarif();
      $tarif -> setLibelle("Licence annuelle");
      $tarif -> setTarif("70");
      $tarif -> setCategorie("licence");
      $manager->persist($tarif);

      $tarif = new Tarif();
      $tarif -> setLibelle("Licence jeune - 18 ans");
      $tarif -> setTarif("30");
      $tarif -> setCategorie("licence");
      $manager->persist($tarif);

      $tarif = new Tarif();
      $tarif -> setLibelle("Licence 1 jour");
      $tarif -> setTarif("25");
      $tarif -> setCategorie("licence");
      $manager->persist($tarif);

      $tarif = new Tarif();
      $tarif -> setLibelle("Licence 4 jours");
      $tarif -> setTarif("48");
      $tarif -> setCategorie("licence");
      $manager->persist($tarif);

      $tarif = new Tarif();
      $tarif -> setLibelle("Sortie découverte (Licence comprise)");
      $tarif -> setTarif("45");
      $tarif -> setCategorie("forfait");
      $manager->persist($tarif);

      $tarif = new Tarif();
      $tarif -> setLibelle("Sortie occasionnelle");
      $tarif -> setTarif("50");
      $tarif -> setCategorie("forfait");
      $manager->persist($tarif);

      $tarif = new Tarif();
      $tarif -> setLibelle("Forfait navigation annuel");
      $tarif -> setTarif("450");
      $tarif -> setCategorie("forfait");
      $manager->persist($tarif);

      $tarif = new Tarif();
      $tarif -> setLibelle("Forfait navigation fin d'année");
      $tarif -> setTarif("200");
      $tarif -> setCategorie("forfait");
      $manager->persist($tarif);

      $tarif = new Tarif();
      $tarif -> setLibelle("Formation théorique pour adhérent avec forfait navigation");
      $tarif -> setTarif("100");
      $tarif -> setCategorie("formation theorique");
      $manager->persist($tarif);

      $tarif = new Tarif();
      $tarif -> setLibelle("Formation théorique pour adhérent sans forfait navigation");
      $tarif -> setTarif("200");
      $tarif -> setCategorie("formation theorique");
      $manager->persist($tarif);

      $tarif = new Tarif();
      $tarif -> setLibelle("Formation théorique à la séance");
      $tarif -> setTarif("30");
      $tarif -> setCategorie("formation theorique");
      $manager->persist($tarif);

      $tarif = new Tarif();
      $tarif -> setLibelle("Régate");
      $tarif -> setTarif("10");
      $tarif -> setCategorie("regate/cabotage");
      $manager->persist($tarif);

      $tarif = new Tarif();
      $tarif -> setLibelle("Sortie Cabotage ou flotille");
      $tarif -> setTarif("15");
      $tarif -> setCategorie("regate/cabotage");
      $manager->persist($tarif);

      $manager->flush();
    }
}
