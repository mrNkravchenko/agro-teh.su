<?php

namespace App\Repository;

use App\Entity\PartnerTech;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PartnerTech|null find($id, $lockMode = null, $lockVersion = null)
 * @method PartnerTech|null findOneBy(array $criteria, array $orderBy = null)
 * @method PartnerTech[]    findAll()
 * @method PartnerTech[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PartnerTechRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PartnerTech::class);
    }

//    /**
//     * @return PartnerTech[] Returns an array of PartnerTech objects
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
    public function findOneBySomeField($value): ?PartnerTech
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
