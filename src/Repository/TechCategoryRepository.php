<?php

namespace App\Repository;

use App\Entity\TechCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TechCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method TechCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method TechCategory[]    findAll()
 * @method TechCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TechCategoryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TechCategory::class);
    }

//    /**
//     * @return TechCategory[] Returns an array of TechCategory objects
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
    public function findOneBySomeField($value): ?TechCategory
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
