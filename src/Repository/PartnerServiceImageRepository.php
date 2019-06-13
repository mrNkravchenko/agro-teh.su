<?php

namespace App\Repository;

use App\Entity\PartnerServiceImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PartnerServiceImage|null find($id, $lockMode = null, $lockVersion = null)
 * @method PartnerServiceImage|null findOneBy(array $criteria, array $orderBy = null)
 * @method PartnerServiceImage[]    findAll()
 * @method PartnerServiceImage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PartnerServiceImageRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PartnerServiceImage::class);
    }

//    /**
//     * @return PartnerServiceImage[] Returns an array of PartnerServiceImage objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PartnerServiceImage
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
