<?php

namespace App\Repository;

use App\Entity\Complection;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Complection|null find($id, $lockMode = null, $lockVersion = null)
 * @method Complection|null findOneBy(array $criteria, array $orderBy = null)
 * @method Complection[]    findAll()
 * @method Complection[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ComplectionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Complection::class);
    }

//    /**
//     * @return Complection[] Returns an array of Complection objects
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
    public function findOneBySomeField($value): ?Complection
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
