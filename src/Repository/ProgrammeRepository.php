<?php

namespace App\Repository;

use App\Entity\Programme;
use App\filter\Search;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Programme|null find($id, $lockMode = null, $lockVersion = null)
 * @method Programme|null findOneBy(array $criteria, array $orderBy = null)
 * @method Programme[]    findAll()
 * @method Programme[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProgrammeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Programme::class);
    }

    /**
      * @return void
     */
    public function countByDate(){
        $query= $this->createQueryBuilder('a')
            ->select('SUBSTRING(a.date,1,10) as date,COUNT(a) as count')
            ->groupBy('date');
        return $query->getQuery()->getResult();
    }


    public function findSearch(Search $search)
    {
        $query= $this->createQueryBuilder('p')
            ->select('c','p')
            ->join('p.category','c');

        if (!empty($search->q)){
          $query=$query->andWhere('p.Titre LIKE :q')
              ->setParameter('q',"%{$search->q}%");
        }

        if (!empty($search->min)){
            $query=$query->andWhere('p.prix >= (:min)')
                ->setParameter('min',$search->min);
        }
        if (!empty($search->max)){
            $query=$query->andWhere('p.prix <= :max')
                ->setParameter('max',$search->max);
        }

        if (!empty($search->category)){
            $query=$query->andWhere('c.id IN  (:category)')
                ->setParameter('category',$search->category);
        }

        return $query->getQuery()->getResult();
    }

    // /**
    //  * @return Programme[] Returns an array of Programme objects
    //  */
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
    public function findOneBySomeField($value): ?Programme
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
