<?php

namespace App\Repository;

use App\Entity\TheoreticalSequenceActivity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TheoreticalSequenceActivity |null find($id, $lockMode = null, $lockVersion = null)
 * @method TheoreticalSequenceActivity|null findOneBy(array $criteria, array $orderBy = null)
 * @method TheoreticalSequenceActivity[]    findAll()
 * @method TheoreticalSequenceActivity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TheoreticalSequenceActivityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TheoreticalSequenceActivity::class);
    }

    /**
     * @return TheoreticalSequenceActivity[]
     */
    public function findAllByTheoreticalSequence($theoreticalSequenceId): array
    {
        return $this->createQueryBuilder('TheoreticalSequenceActivity')
            ->andWhere('TheoreticalSequenceActivity.theoreticalSequenceId = :theoreticalSequenceId')
            ->setParameter('theoreticalSequenceId', $theoreticalSequenceId)
            ->orderBy('TheoreticalSequenceActivity.order', 'ASC')
            ->getQuery()
            ->execute();
    }

    /**
     * @return TheoreticalSequenceActivity[]
     */
    public function findOneByTheoreticalSequence($theoreticalSequenceId, $activityId): array
    {
        return $this->createQueryBuilder('TheoreticalSequenceActivity')
            ->andWhere('TheoreticalSequenceActivity.theoreticalSequenceId = :theoreticalSequenceId')
            ->andWhere('TheoreticalSequenceActivity.id = :id')
            ->setParameter('idTheoreticalSequence', $theoreticalSequenceId)
            ->setParameter('id', $activityId)
            ->orderBy('TheoreticalSequenceActivity.order', 'ASC')
            ->getQuery()
            ->execute();
    }
}