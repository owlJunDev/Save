<?php

namespace App\Repository;

use App\Entity\MaterialV2;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MaterialV2|null find($id, $lockMode = null, $lockVersion = null)
 * @method MaterialV2|null findOneBy(array $criteria, array $orderBy = null)
 * @method MaterialV2[]    findAll()
 * @method MaterialV2[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MaterialV2Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MaterialV2::class);
    }

    // /**
    //  * @return MaterialV2[] Returns an array of MaterialV2 objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MaterialV2
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
