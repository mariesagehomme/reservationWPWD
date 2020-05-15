<?php

namespace App\Repository;

use App\Entity\Representation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Representation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Representation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Representation[]    findAll()
 * @method Representation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RepresentationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Representation::class);
    }

    // /**
    //  * @return Representation[] Returns an array of Representation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Representation
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
