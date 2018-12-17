<?php

namespace App\Repository;

use App\Entity\TechFeedback;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TechFeedback|null find($id, $lockMode = null, $lockVersion = null)
 * @method TechFeedback|null findOneBy(array $criteria, array $orderBy = null)
 * @method TechFeedback[]    findAll()
 * @method TechFeedback[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TechFeedbackRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TechFeedback::class);
    }

//    /**
//     * @return TechFeedback[] Returns an array of TechFeedback objects
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
    public function findOneBySomeField($value): ?TechFeedback
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
