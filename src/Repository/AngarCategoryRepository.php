<?php

namespace App\Repository;

use App\Entity\AngarCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AngarCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method AngarCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method AngarCategory[]    findAll()
 * @method AngarCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AngarCategoryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AngarCategory::class);
    }

//    /**
//     * @return AngarCategory[] Returns an array of AngarCategory objects
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
    public function findOneBySomeField($value): ?AngarCategory
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
