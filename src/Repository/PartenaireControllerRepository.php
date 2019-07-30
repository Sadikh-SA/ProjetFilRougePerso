<?php

namespace App\Repository;

use App\Entity\PartenaireController;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PartenaireController|null find($id, $lockMode = null, $lockVersion = null)
 * @method PartenaireController|null findOneBy(array $criteria, array $orderBy = null)
 * @method PartenaireController[]    findAll()
 * @method PartenaireController[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PartenaireControllerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PartenaireController::class);
    }

    // /**
    //  * @return PartenaireController[] Returns an array of PartenaireController objects
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
    public function findOneBySomeField($value): ?PartenaireController
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
