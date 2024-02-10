<?php

namespace App\Repository;

use App\Entity\JourOuvert;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<JourOuvert>
 *
 * @method JourOuvert|null find($id, $lockMode = null, $lockVersion = null)
 * @method JourOuvert|null findOneBy(array $criteria, array $orderBy = null)
 * @method JourOuvert[]    findAll()
 * @method JourOuvert[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JourOuvertRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, JourOuvert::class);
    }

//    /**
//     * @return JourOuvert[] Returns an array of JourOuvert objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('j')
//            ->andWhere('j.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('j.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?JourOuvert
//    {
//        return $this->createQueryBuilder('j')
//            ->andWhere('j.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
