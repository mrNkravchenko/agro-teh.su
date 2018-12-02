<?php

namespace App\Repository;

use App\Entity\AngarImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use phpDocumentor\Reflection\Types\This;
use function PHPSTORM_META\elementType;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AngarImage|null find($id, $lockMode = null, $lockVersion = null)
 * @method AngarImage|null findOneBy(array $criteria, array $orderBy = null)
 * @method AngarImage[]    findAll()
 * @method AngarImage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AngarImageRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AngarImage::class);
    }

//    /**
//     * @return AngarImage[] Returns an array of AngarImage objects
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
    public function findOneBySomeField($value): ?AngarImage
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
     * @param AngarImage $image
     */
    public function setFirstImage(AngarImage $image):void
    {
        $firstImage = $this->findOneBy(['first' => true, 'angar' => $image->getAngar()->getId()]);
        if ($firstImage) {
            $firstImage->setFirst(false);
            $image->setFirst(true);
        } else {
            $image->setFirst(true);
        }

    }

    /*public function getFirstImageOfAngar()
    {
        return $this->createQueryBuilder('a')
            ->
    }*/

}
