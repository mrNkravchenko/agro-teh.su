<?php

namespace App\Repository;

use App\Entity\Angar;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Angar|null find($id, $lockMode = null, $lockVersion = null)
 * @method Angar|null findOneBy(array $criteria, array $orderBy = null)
 * @method Angar[]    findAll()
 * @method Angar[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AngarRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Angar::class);
    }

//    /**
//     * @return Angar[] Returns an array of Angar objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Angar
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
