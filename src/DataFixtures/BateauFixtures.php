<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Bateau;
use App\Entity\BateauType;
use App\Entity\Planning;
use App\Entity\Membre;
use DateTime;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class BateauFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
      $bateautype = new Bateautype();
      $bateautype -> setBateauType("B25");
      $manager->persist($bateautype);
 
      $bateau = new Bateau();
      $bateau->setBateauType($bateautype);
      $bateau -> setNom("Hello Kitty");
      $bateau -> setDescription("Voilier habitable, vif et sportif. Pour sortie à la journée.");
      $bateau -> setLongueur("7.5");
      $bateau -> setLargeur("2.76");
      $bateau -> setTirantEau("1.55");
      $bateau -> setSurfGV("24.86");
      $bateau -> setGenois("17.24");
      $bateau -> setSpi("45.25");
      $bateau -> setImagePath("B25.jpeg");
      $manager->persist($bateau);

      $planning = new Planning();
      $planning->setBateauType($bateautype);
      $planning -> setTypeJournee("matin");
      $planning -> setDate(new DateTime('2024-09-29'));
      $manager->persist($planning);

      $planning = new Planning();
      $planning->setBateauType($bateautype);
      $planning -> setTypeJournee("matin");
      $planning -> setDate(new DateTime('2024-12-14'));
      $manager->persist($planning);
      
      $planning = new Planning();
      $planning->setBateauType($bateautype);
      $planning -> setTypeJournee("après midi");
      $planning -> setDate(new DateTime('2024-12-14'));
      $manager->persist($planning);
     

      $bateautype = new Bateautype();
      $bateautype -> setBateauType("First32");
      $manager->persist($bateautype);

      $bateau = new Bateau();
      $bateau->setBateauType($bateautype);
      $bateau -> setNom("Mer-Veille");
      $bateau -> setDescription("Voilier habitable. Idéal pour les sorties familiales.");
      $bateau -> setLongueur("10");
      $bateau -> setLargeur("3.1");
      $bateau -> setTirantEau("1.65");
      $bateau -> setSurfGV("36.45");
      $bateau -> setSpi("0");
      $bateau -> setGenois("20.50");
      $bateau -> setImagePath("F32.jpeg");
      $manager->persist($bateau);

      $planning = new Planning();
      $planning->setBateauType($bateautype);
      $planning -> setTypeJournee("après midi");
      $planning -> setDate(new DateTime('2024-12-14'));
      $manager->persist($planning);

      $bateautype = new Bateautype();
      $bateautype -> setBateauType("Dufour405");
      $manager->persist($bateautype);

      $bateau = new Bateau();
      $bateau->setBateauType($bateautype);
      $bateau -> setNom("Chocalota");
      $bateau -> setDescription("Voilier habitable. Idéal pour les grandes excursions. Apte à affronter toutes les mers.");
      $bateau -> setLongueur("11.93");
      $bateau -> setLargeur("3.85");
      $bateau -> setTirantEau("1.85");
      $bateau -> setSurfGV("45.17");
      $bateau -> setGenois("25.50");
      $bateau -> setSpi("90.50");
      $bateau -> setImagePath("D405.jpeg");
      $manager->persist($bateau);

      $planning = new Planning();
      $planning->setBateauType($bateautype);
      $planning -> setTypeJournee("journée");
      $planning -> setDate(new DateTime('2024-12-14'));
      $manager->persist($planning);

      $planning = new Planning();
      $planning->setBateauType($bateautype);
      $planning -> setTypeJournee("journée");
      $planning -> setDate(new DateTime('2024-12-21'));
      $manager->persist($planning);

      $membre = new Membre();
      $membre -> setNom("TOTO");
      $membre -> setPrenom("Michel");
      $membre->setPassword("$2a$12\$Rb5C5UkreCRzKba6bZ.M8O/qtcwUI7mlqQSd1XdZuzcDT3ab.mibq");
      $membre->setEmail("toto@gmail.com");
      $membre->setTelephone("04.66.47.58.69");
      $membre->setActif(true);
      $membre->setRoles(['ROLE_USER']);
      $membre->setMontantTotal(50);
      
      $manager->persist($membre);
  
      $membre = new Membre();
      $membre -> setNom("TITO");
      $membre -> setPrenom("Marc");
      $membre->setPassword("$2a$12\$Rb5C5UkreCRzKba6bZ.M8O/qtcwUI7mlqQSd1XdZuzcDT3ab.mibq");
      $membre->setEmail("tito@gmail.com");
      $membre->setTelephone("04.68.25.36.32");
      $membre->setActif(true);
      $membre->setRoles(['ROLE_USER']);
      $membre->setMontantTotal(90);
      
      $manager->persist($membre);

      $membre = new Membre();
      $membre -> setNom("MOMO");
      $membre -> setPrenom("Henri");
      $membre->setPassword("$2a$12\$Sl9gfEJe7v/di4KTB0fU/.e1MlPvFJr1PkgrEf.11HSSeQmoPPvRa");
      $membre->setEmail("momo@gmail.com");
      $membre->setTelephone("04.66.98.65.23");
      $membre->setActif(true);
      $membre->setRoles(['ROLE_USER']);
      $membre->setMontantTotal(290);
      
      $manager->persist($membre);
  
      $membre = new Membre();
      $membre -> setNom("LOLO");
      $membre -> setPrenom("Michel");
      $membre->setPassword("$2a$12$9HAdy/ga9CTNVyCBOmjTg.wjcRSSMXJM6ShlUnlF/Ir1lvGnzrsG6");
      $membre->setEmail("lolo@gmail.com");
      $membre->setTelephone("06.12.36.25.47");
      $membre->setActif(true);
      $membre->setRoles(['ROLE_USER']);
      $membre->setMontantTotal(100);
      
      $manager->persist($membre);
  
      $membre = new Membre();
      $membre -> setNom("BOBO");
      $membre -> setPrenom("Michel");
      $membre->setPassword("$2a$12\$KrYoqY42GUqm8OxAF/uBzekPY/PKmMjGv0vdMJNzM/EpdedJJ.iFW");
      $membre->setEmail("bobo@gmail.com");
      $membre->setTelephone("07.25.47.36.36");
      $membre->setActif(true);
      $membre->setRoles(['ROLE_USER']);
      $membre->setMontantTotal(140);
      
      $manager->persist($membre);
      
      $manager->flush();
    }

 
}


