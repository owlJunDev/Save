<?php

namespace App\Repository;

use App\Entity\InvoiceV2;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method InvoiceV2|null find($id, $lockMode = null, $lockVersion = null)
 * @method InvoiceV2|null findOneBy(array $criteria, array $orderBy = null)
 * @method InvoiceV2[]    findAll()
 * @method InvoiceV2[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InvoiceV2Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InvoiceV2::class);
    }

    // /**
    //  * @return InvoiceV2[] Returns an array of InvoiceV2 objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?InvoiceV2
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
