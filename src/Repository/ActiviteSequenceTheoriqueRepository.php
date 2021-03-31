<?php

namespace App\Repository;

use App\Entity\Activitesequencetheorique;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Activitesequencetheorique |null find($id, $lockMode = null, $lockVersion = null)
 * @method Activitesequencetheorique|null findOneBy(array $criteria, array $orderBy = null)
 * @method Activitesequencetheorique[]    findAll()
 * @method Activitesequencetheorique[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActiviteSequenceTheoriqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Activitesequencetheorique::class);
    }

    /**
     * @return Activitesequencetheorique[]
     */
    public function findAllBySequencetheorique($idSequenceTheorique)
    {
        return $this->createQueryBuilder('Activitesequencetheorique')
            ->andWhere('Activitesequencetheorique.idsequencetheorique = :idsequencetheorique')
            ->setParameter('idsequencetheorique', $idSequenceTheorique)
            ->orderBy('Activitesequencetheorique.ordre', 'ASC')
//            ->leftJoin('genus.genusScientists', 'genusScientist')
//            ->addSelect('genusScientist')
            ->getQuery()
            ->execute();
    }

    /**
     * @return Activitesequencetheorique[]
     */
    public function findOneBySequenceTheorique($idSequenceTheorique, $idActivite)
    {
        return $this->createQueryBuilder('Activitesequencetheorique')
            ->andWhere('Activitesequencetheorique.idsequencetheorique = :idsequencetheorique')
            ->andWhere('Activitesequencetheorique.id = :id')
            ->setParameter('idsequencetheorique', $idSequenceTheorique)
            ->setParameter('id', $idActivite)
            ->orderBy('Activitesequencetheorique.ordre', 'ASC')
//            ->leftJoin('genus.genusScientists', 'genusScientist')
//            ->addSelect('genusScientist')
            ->getQuery()
            ->execute();
    }
}