<?php

namespace App\Repository;

use App\Entity\Planning;
use App\Entity\Membre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Planning>
 */
class PlanningRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Planning::class);
    }

    //    /**
    //     * @return Planning[] Returns an array of Planning objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Planning
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
//     public function findByMembre(Membre $membre): array
//     {
//         return $this->createQueryBuilder('p')
//             ->andWhere('p.membre = :membre')
//             ->setParameter('membre', $membre)
//             ->getQuery()
//             ->getResult();
//     }
//     public function findAllWithDetails(): array
// {
//     return $this->createQueryBuilder('p')
//         ->leftJoin('p.bateautype', 'tb')
//         ->addSelect('tb')
//         ->leftJoin('p.participants', 'part')
//         ->addSelect('part')
//         ->getQuery()
//         ->getResult();
// }
    public function findAllWithDetails(): array
    {
        return $this->createQueryBuilder('p')
            ->leftJoin('p.bateautype', 'tb')
            ->addSelect('tb')
            ->leftJoin('p.participants', 'part')
            ->addSelect('part')
            ->getQuery()
            ->getResult();
    }
}