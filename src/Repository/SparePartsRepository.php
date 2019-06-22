<?php

namespace App\Repository;

use App\Entity\SpareParts;
use App\Entity\Tech;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SpareParts|null find($id, $lockMode = null, $lockVersion = null)
 * @method SpareParts|null findOneBy(array $criteria, array $orderBy = null)
 * @method SpareParts[]    findAll()
 * @method SpareParts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SparePartsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SpareParts::class);
    }

//    /**
//     * @return SpareParts[] Returns an array of SpareParts objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SpareParts
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function getBy($condition = [], $orderBy = [], $limit = null, $offset = null)
    {
//        $techName = Tech::class;
        $techName = "Techs";
//        $spareName = SpareParts::class;
        $spareName = 'SpareParts';
        $qb = $this->createQueryBuilder($spareName);

        if (!empty($condition['tech_id'])) {
            $qb->leftJoin("$spareName.techs", $techName);
            $qb->andWhere("$techName.id = :tech_id");
            $qb->setParameter('tech_id', $condition['tech_id']);
        }

        if (!empty($orderBy)) {
            foreach ($orderBy as $key => $order) {
                if ($key === 'short_name' && in_array(strtolower($order), ['asc', 'desc'])) {
                    $qb->addOrderBy($key, $order);
                }
            }
        }

        if($limit) {
            $qb->setMaxResults($limit);
        }
        if($offset) {
            $qb->setFirstResult($offset);
        }



        return $qb->getQuery()->getResult();

    }

}
