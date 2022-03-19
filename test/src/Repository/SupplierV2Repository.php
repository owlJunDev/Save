<?php

namespace App\Repository;

use App\Entity\SupplierV2;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SupplierV2|null find($id, $lockMode = null, $lockVersion = null)
 * @method SupplierV2|null findOneBy(array $criteria, array $orderBy = null)
 * @method SupplierV2[]    findAll()
 * @method SupplierV2[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SupplierV2Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SupplierV2::class);
    }

    // /**
    //  * @return SupplierV2[] Returns an array of SupplierV2 objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SupplierV2
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
