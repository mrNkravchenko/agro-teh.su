<?php

namespace App\Repository;

use App\Entity\TechImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TechImage|null find($id, $lockMode = null, $lockVersion = null)
 * @method TechImage|null findOneBy(array $criteria, array $orderBy = null)
 * @method TechImage[]    findAll()
 * @method TechImage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TechImageRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TechImage::class);
    }

//    /**
//     * @return TechImage[] Returns an array of TechImage objects
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
    public function findOneBySomeField($value): ?TechImage
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
