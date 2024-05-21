<?php

namespace App\Repository;

use App\Entity\Video;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Video>
 */
class VideoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Video::class);
    }

    public function findVideos($maxItems = 20): array
    {
        return $this->createQueryBuilder('p')
            ->select('p')
            ->orderBy('p.createdAt', 'DESC')
            ->setMaxResults($maxItems)
            ->getQuery()
            ->getResult();
    }

    public function findVideosCount(): int
    {
        return $this->createQueryBuilder('p')
            ->select('count(p)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function save(Video $video): void
    {
        $this->getEntityManager()->persist($video);
        $this->getEntityManager()->flush();
    }

    public function remove(Video $video): void
    {
        $this->getEntityManager()->remove($video);
        $this->getEntityManager()->flush();
    }
}
