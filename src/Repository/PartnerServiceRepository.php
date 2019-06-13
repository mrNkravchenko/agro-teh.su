<?php

namespace App\Repository;

use App\Entity\PartnerService;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PartnerService|null find($id, $lockMode = null, $lockVersion = null)
 * @method PartnerService|null findOneBy(array $criteria, array $orderBy = null)
 * @method PartnerService[]    findAll()
 * @method PartnerService[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PartnerServiceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PartnerService::class);
    }

//    /**
//     * @return PartnerService[] Returns an array of PartnerService objects
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
    public function findOneBySomeField($value): ?PartnerService
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
