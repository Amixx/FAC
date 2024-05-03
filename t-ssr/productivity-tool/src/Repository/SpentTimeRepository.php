<?php

namespace App\Repository;

use App\Entity\SpentTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SpentTime>
 */
class SpentTimeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SpentTime::class);
    }

    public function findAll(): array
    {
        return $this->createQueryBuilder('s')
            ->select('s')
            ->orderBy('s.createdAt', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function remove(SpentTime $spentTime): void
    {
        $this->getEntityManager()->remove($spentTime);
        $this->getEntityManager()->flush();
    }
}
