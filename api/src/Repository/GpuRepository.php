<?php

namespace App\Repository;

use App\Entity\Gpu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Gpu|null find($id, $lockMode = null, $lockVersion = null)
 * @method Gpu|null findOneBy(array $criteria, array $orderBy = null)
 * @method Gpu[]    findAll()
 * @method Gpu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GpuRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Gpu::class);
    }

    public function getGpuByCompany(){
        return $this->createQueryBuilder('g')
            ->select('g.company, COUNT(g) as count')
            ->groupBy('g.company')
            ->getQuery()
            ->getScalarResult();
    }

    // /**
    //  * @return Gpu[] Returns an array of Gpu objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Gpu
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
