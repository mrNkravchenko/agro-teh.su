<?php

namespace App\Repository;

use App\Entity\PartnerTechImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PartnerTechImage|null find($id, $lockMode = null, $lockVersion = null)
 * @method PartnerTechImage|null findOneBy(array $criteria, array $orderBy = null)
 * @method PartnerTechImage[]    findAll()
 * @method PartnerTechImage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PartnerTechImageRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PartnerTechImage::class);
    }

//    /**
//     * @return PartnerTechImage[] Returns an array of PartnerTechImage objects
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
    public function findOneBySomeField($value): ?PartnerTechImage
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
