<?php

namespace App\Repository;

use App\Entity\DeckCarte;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method DeckCarte|null find($id, $lockMode = null, $lockVersion = null)
 * @method DeckCarte|null findOneBy(array $criteria, array $orderBy = null)
 * @method DeckCarte[]    findAll()
 * @method DeckCarte[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DeckCarteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DeckCarte::class);
    }

    // /**
    //  * @return DeckCarte[] Returns an array of DeckCarte objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DeckCarte
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
