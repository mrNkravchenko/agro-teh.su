<?php

namespace App\Repository;

use App\Entity\SparePartsImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SparePartsImage|null find($id, $lockMode = null, $lockVersion = null)
 * @method SparePartsImage|null findOneBy(array $criteria, array $orderBy = null)
 * @method SparePartsImage[]    findAll()
 * @method SparePartsImage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SparePartsImageRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SparePartsImage::class);
    }

//    /**
//     * @return SparePartsImage[] Returns an array of SparePartsImage objects
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
    public function findOneBySomeField($value): ?SparePartsImage
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
     * @param SparePartsImage $image
     */
    public function setFirstImage(SparePartsImage $image):void
    {
        $firstImage = $this->findOneBy(['first' => true, 'spare' => $image->getSpare()->getId()]);
        if ($firstImage) {
            $firstImage->setFirst(false);
            $image->setFirst(true);
        } else {
            $image->setFirst(true);
        }

    }
}
