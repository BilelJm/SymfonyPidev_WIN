<?php

namespace App\Repository;

use App\Entity\Booking;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Booking|null find($id, $lockMode = null, $lockVersion = null)
 * @method Booking|null findOneBy(array $criteria, array $orderBy = null)
 * @method Booking[]    findAll()
 * @method Booking[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Booking::class);
    }

    // /**
    //  * @return Booking[] Returns an array of Booking objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Booking
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findByAct()
    {
        return $this->createQueryBuilder('booking')
            ->orderBy('booking.Prix_total','DESC')
            ->getQuery()
            ->getResult()
            ;
    }
    public function findByAct2()
    {
        return $this->createQueryBuilder('booking')
            ->orderBy('booking.Prix_total','ASC')
            ->getQuery()
            ->getResult()
            ;
    }


    public function stat1()
    {
        $query= $this->getEntityManager()
            ->createQuery('select a.nb_enfants as cat,count(a.nb_enfants) as nbcat from App\Entity\Booking a group by a.nb_enfants');
        return $query->getResult();
    }

    public function findActbyNom($nom){
        return $this->createQueryBuilder('booking')
            ->where('booking.remarques LIKE :nom')
            ->setParameter('nom', '%'.$nom.'%')
            ->getQuery()
            ->getResult();
    }
}
