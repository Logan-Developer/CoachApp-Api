<?php

namespace App\Repository;

use App\Entity\WorkshopCommentary;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method WorkshopCommentary|null find($id, $lockMode = null, $lockVersion = null)
 * @method WorkshopCommentary|null findOneBy(array $criteria, array $orderBy = null)
 * @method WorkshopCommentary[]    findAll()
 * @method WorkshopCommentary[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WorkshopCommentaryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WorkshopCommentary::class);
    }

    // /**
    //  * @return WorkshopCommentary[] Returns an array of WorkshopCommentary objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?WorkshopCommentary
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
