<?php

namespace App\Repository;

use App\Entity\Complectation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Complectation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Complectation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Complectation[]    findAll()
 * @method Complectation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ComplectationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Complectation::class);
    }

//    /**
//     * @return Complectation[] Returns an array of Complectation objects
//     */
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
    public function findOneBySomeField($value): ?Complectation
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
