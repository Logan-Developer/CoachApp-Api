<?php

namespace App\Repository;

use App\Entity\DrinkComment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DrinkComment|null find($id, $lockMode = null, $lockVersion = null)
 * @method DrinkComment|null findOneBy(array $criteria, array $orderBy = null)
 * @method DrinkComment[]    findAll()
 * @method DrinkComment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DrinkCommentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DrinkComment::class);
    }
}