<?php

namespace App\Repository;

use App\Entity\CarouselHotel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CarouselHotel>
 *
 * @method CarouselHotel|null find($id, $lockMode = null, $lockVersion = null)
 * @method CarouselHotel|null findOneBy(array $criteria, array $orderBy = null)
 * @method CarouselHotel[]    findAll()
 * @method CarouselHotel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarouselHotelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CarouselHotel::class);
    }

//    /**
//     * @return CarouselHotel[] Returns an array of CarouselHotel objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CarouselHotel
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
