<?php

namespace App\Repository;

use App\Entity\Tech;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Tech|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tech|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tech[]    findAll()
 * @method Tech[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TechRepository extends ServiceEntityRepository
{
    /**
     * TechRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Tech::class);
    }

//    /**
//     * @return Tech[] Returns an array of Tech objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Tech
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
