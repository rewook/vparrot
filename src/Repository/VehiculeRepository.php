<?php

namespace App\Repository;

use App\Entity\Vehicule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Vehicule>
 *
 * @method Vehicule|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vehicule|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vehicule[]    findAll()
 * @method Vehicule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VehiculeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vehicule::class);
    }

    public function findVehiculesByPriceRange($prixMin,$prixMax)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.prix BETWEEN :minPrice AND :maxPrice')
            ->setParameter('minPrice', $prixMin)
            ->setParameter('maxPrice', $prixMax)
            ->getQuery()
            ->getResult();
    }

    public function findVehiculesByKilometreRange($kilometreMin,$kilometreMax)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.kilometrage BETWEEN :minPrice AND :maxPrice')
            ->setParameter('minPrice', $kilometreMin)
            ->setParameter('maxPrice', $kilometreMax)
            ->getQuery()
            ->getResult();
    }

    public function findVehiculesByAnneeRange($anneeMin,$anneeMax)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.annee BETWEEN :minPrice AND :maxPrice')
            ->setParameter('minPrice', $anneeMin)
            ->setParameter('maxPrice', $anneeMax)
            ->getQuery()
            ->getResult();
    }

    public function findVehicules($prixMin,$prixMax,$kilometreMin,$kilometreMax,$anneeMin,$anneeMax)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.prix BETWEEN :minPrice AND :maxPrice')
            ->andWhere('v.kilometrage BETWEEN :minKilometre AND :maxKilometre')
            ->andWhere('v.annee BETWEEN :minAnnee AND :maxAnnee')
            ->setParameter('minPrice', $prixMin)
            ->setParameter('maxPrice', $prixMax)
            ->setParameter('minKilometre', $kilometreMin)
            ->setParameter('maxKilometre', $kilometreMax)
            ->setParameter('minAnnee', $anneeMin)
            ->setParameter('maxAnnee', $anneeMax)
            ->getQuery()
            ->getResult();
    }








//    /**
//     * @return Vehicule[] Returns an array of Vehicule objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Vehicule
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
