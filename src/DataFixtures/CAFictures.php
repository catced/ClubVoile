<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\CA;
use DateTimeImmutable;

class CAFictures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
      $ca = new CA();
      $ca -> setChemin("67059075d74cc119100277.pdf");
      $ca -> setSize("164");
      $ca -> setUpdatedAt(new DateTimeImmutable('2024-09-25 10:21:41'));
      $manager->persist($ca);

      $ca = new CA();
      $ca -> setChemin("67058eea47add884400052.pdf");
      $ca -> setSize("234");
      $ca -> setUpdatedAt(new DateTimeImmutable('2024-10-15 18:36:21'));
      $manager->persist($ca);

      $ca = new CA();
      $ca -> setChemin("67058dd19afb2978363946.pdf");
      $ca -> setSize("640");
      $ca -> setUpdatedAt(new DateTimeImmutable('2024-12-01 22:10:52'));
      $manager->persist($ca);

      $manager->flush();
    }
}
